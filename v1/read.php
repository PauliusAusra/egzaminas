<?php

session_start();
require_once("db.php");
$kurinys = null;
$title = "Read";
if (isset($_GET['kurinys'])){
  $kurinio_id = $_GET['kurinys'];
  $sth = $dbh->prepare('SELECT kuriniai.id, kuriniai.Pavadinimas, kuriniai.Tekstas, kuriniai.Vartotojo_id, vartotojai.Vardas, vartotojai.Pavarde, kategorijos.Kategorija FROM kuriniai INNER JOIN vartotojai ON kuriniai.Vartotojo_id = vartotojai.id INNER JOIN kategorijos ON kuriniai.Kategorijos_id = kategorijos.id WHERE kuriniai.id = ? ORDER BY kuriniai.id DESC;');
  $sth->execute(array($kurinio_id));
  $kurinys = $sth->fetch();
  $title = $kurinys['Pavadinimas'];
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="read.css">
    <title><?php echo $title; ?></title>
  </head>
  <body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Home</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a class="nav-link" href="write.php">Write</a>
            <a class="nav-link" href="read.php">Read</a>
            <a class="nav-link" href="login.php">Login</a>
            <a class="nav-link" href="register.php">Register</a>
          </div>
        </div>
      </div>
    </nav>

<?php

if ($kurinys == null){
  echo "<br>";
  $sth = $dbh->prepare('SELECT kuriniai.id, kuriniai.Pavadinimas, vartotojai.Vardas, vartotojai.Pavarde, kategorijos.Kategorija FROM kuriniai INNER JOIN vartotojai ON kuriniai.Vartotojo_id = vartotojai.id INNER JOIN kategorijos ON kuriniai.Kategorijos_id = kategorijos.id ORDER BY kuriniai.id DESC;');
  $sth->execute();
  $rez = $sth->fetchAll();
  foreach ($rez AS $val){
    echo "Title: "."<a href=\"read.php?kurinys=".$val['id']."\">".$val['Pavadinimas']."</a>".", author: ".$val['Vardas']." ".$val['Pavarde'].", category: ".$val['Kategorija']."<br><br>";
  }
} else {
echo "<br>";

  if (!empty($_POST["Rating"]) && !empty($_POST["Comment"])){

    try {

      $sth = $dbh->prepare('INSERT INTO komentarai (Komentaras, Kurinio_id, Vartotojo_id) VALUES (?,?,?);');
      $sth->execute(array($_POST["Comment"], $_GET['kurinys'], $_SESSION["user"]["id"]));
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }

    try {

      $sth = $dbh->prepare('INSERT INTO vertinimai (Vertinimas, Kurinio_id, Vartotojo_id) VALUES (?,?,?);');
      $sth->execute(array($_POST["Rating"], $_GET['kurinys'], $_SESSION["user"]["id"]));
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
  }

  echo "Title: ";
  echo $kurinys['Pavadinimas'];
  echo "<br><br>";
  echo "Author: ";
  echo $kurinys['Vardas'];
  echo " ";
  echo $kurinys['Pavarde'];
  echo "<br><br>";
  echo "Category: ";
  echo $kurinys['Kategorija'];
  echo "<br><br><hr><br>";
  echo nl2br($kurinys['Tekstas']);
  echo "<br><br><hr><br>";
  echo "Average rating: ";

  $sth = $dbh->prepare('SELECT ROUND(AVG(Vertinimas)), COUNT(Vertinimas) FROM vertinimai WHERE vertinimai.Kurinio_id = ?;');
  $sth->execute(array($_GET['kurinys']));
  $rez = $sth->fetch();
  echo $rez['ROUND(AVG(Vertinimas))'];
  echo " from ";
  echo $rez['COUNT(Vertinimas)'];
  echo " ratings <br>";

  $q = 'SELECT *
        FROM komentarai
        WHERE komentarai.Kurinio_id = ? AND komentarai.Vartotojo_id = ?;';

if (isset($_SESSION["user"])){

  $sth = $dbh->prepare($q);
  $sth->execute(array($kurinys['id'], $_SESSION["user"]["id"]));
  $rez = $sth->rowCount();

  if ($rez == 0 && $kurinys['Vartotojo_id'] != $_SESSION["user"]["id"]){
    echo "<br><br>";
    echo "Reviewer: ";
    echo $_SESSION['user']['Vardas'];
    echo " ";
    echo $_SESSION['user']['Pavarde'];
    echo "<br>";
    echo "<form class='' action='#' method='post'>";
    echo "<br>";
    echo "Rating: ";
    echo "<input type='number' name='Rating' min='1' max='10' placeholder='1 - 10' required>";
    echo "<br><br>";
    echo "<div class='form-floating'>";
    echo "<textarea name='Comment' class='form-control' id='floatingPassword' style='width: 257.5px; height: 257.5px;' placeholder='Review' required></textarea></div>";
    echo "<br>";
    echo "<button type='submit' class='btn btn-primary' name='Submit'>Submit</button>";
    echo "</form><br>";
  }
}

  $q = 'SELECT vartotojai.Vardas, vartotojai.Pavarde, komentarai.Komentaras, vertinimai.Vertinimas
        FROM komentarai
        LEFT JOIN vartotojai ON komentarai.Vartotojo_id = vartotojai.id
        LEFT JOIN vertinimai ON komentarai.Kurinio_id = vertinimai.Kurinio_id AND komentarai.Vartotojo_id = vertinimai.Vartotojo_id
        LEFT JOIN kuriniai ON kuriniai.id = komentarai.Kurinio_id
        WHERE kuriniai.id = ?
        ORDER BY komentarai.id DESC;';

  $sth = $dbh->prepare($q);
  $sth->execute(array($kurinys['id']));
  $rez = $sth->fetchAll();

echo "<br><br>";
  foreach ($rez AS $val){
    echo $val['Vardas']." ".$val['Pavarde']."<br><br>"."Rating: ".$val['Vertinimas']."<br><br>"."Review: ".$val['Komentaras']."<br><br><br>";
  }
}

?>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
