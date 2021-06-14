<?php

require_once("db.php");

if (!empty($_POST["vartotojo_tipas"])){
  $vartotojo_tipas = $_POST["vartotojo_tipas"];
  $sth = $dbh->prepare('INSERT INTO vartotoju_tipai (Vartotojo_tipas) VALUES (?);');
  $sth->execute(array($vartotojo_tipas));
  //$yellow = $sth->fetchAll();
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>User types</title>
  </head>
  <body>
    <h3>Add new user type</h3>
    <form class="" action="vartotoju_tipai.php" method="post">
      <input type="text" name="vartotojo_tipas" placeholder="User type" required>
      <button type="submit" name="Submit">Submit</button>
    </form>

    <?php

    $sth = $dbh->prepare('SELECT * FROM vartotoju_tipai ORDER BY Vartotojo_tipas;');
    $sth->execute();
    $rez = $sth->fetchAll();
    //print_r($rez);
    echo "<h3>User type list</h3>";
    foreach ($rez AS $val){
      echo $val['Vartotojo_tipas'];
      echo "<br>";
    }

    ?>

  </body>
</html>
