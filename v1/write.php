<?php

session_start();
require_once("db.php");

if (!empty($_POST["Pavadinimas"]) && !empty($_POST["Tekstas"])){

  $pavadinimas = $_POST["Pavadinimas"];
  $tekstas = $_POST["Tekstas"];
  $vartotojo_id = $_POST["Vartotojo_id"];
  $kategorijos_id = $_POST["Kategorijos_id"];

  if ($_SESSION["user"]["id"] == $vartotojo_id){

    $valid = true;
    if ($pavadinimas == ""){
      $valid = false;
    } elseif ($tekstas == ""){
      $valid = false;
    }

    if ($valid){

      try {

        $sth = $dbh->prepare('INSERT INTO kuriniai (Pavadinimas, Tekstas, Vartotojo_id, Kategorijos_id) VALUES (?,?,?,?);');
        $sth->execute(array($pavadinimas, $tekstas, $vartotojo_id, $kategorijos_id));
      } catch (PDOException $e) {
          print "Error!: " . $e->getMessage() . "<br/>";
          die();
      }
    }
  }

  $sth = $dbh->prepare('SELECT MAX(id) FROM kuriniai;');
  $sth->execute();
  $rez = $sth->fetchAll();
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="write.css">
    <title>Write</title>
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

    if (isset($_SESSION["user"])){
      echo "<br>";
      echo "Author: ".$_SESSION["user"]["Vardas"]." ".$_SESSION["user"]["Pavarde"]."<br><br>";

    ?>

    <form class="" action="write.php" method="post">
      <input type="hidden" name="Vartotojo_id" value="<?php echo $_SESSION["user"]["id"]; ?>" required>
      <div class="form-floating mb-3">
      <input type="text" class="form-control" id="floatingInput" name="Pavadinimas" placeholder="Title" required>
      </div>
      <div class="form-floating mb-3">
      <textarea name="Tekstas" rows="8" cols="80" class="form-control" id="floatingPassword" placeholder="Write here" required></textarea>
      </div>
      <select class="" name="Kategorijos_id">

        <?php

        $sth = $dbh->prepare('SELECT * FROM kategorijos ORDER BY kategorija;');
        $sth->execute();
        $rez = $sth->fetchAll();
        foreach ($rez AS $val){
          echo "<option value=\"".$val['id']."\">".$val['Kategorija']."</option>";
        }

         ?>

      </select>
      <br>
      <br>
      <button type="submit" class="btn btn-primary" name="Submit">Submit</button>
    </form>

    <?php

    } else {
      echo '<a href="login.php" class="btn btn-primary btn-lg login" role="button">Log in to write</a>';
      echo '<a href="read.php" class="btn btn-secondary btn-lg read" role="button">Read</a>';
    }

    ?>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
