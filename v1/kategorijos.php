<?php

require_once("db.php");

if (!empty($_POST["kategorija"])){
  $kategorija = $_POST["kategorija"];
  $sth = $dbh->prepare('INSERT INTO kategorijos (kategorija) VALUES (?);');
  $sth->execute(array($kategorija));
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Categories</title>
  </head>
  <body>
    <a href="read.php">Read</a>
    <br>
    <br>
    <h3>Add new category</h3>
    <form class="" action="kategorijos.php" method="post">
      <input type="text" name="kategorija" placeholder="Category" required>
      <button type="submit" name="Submit">Submit</button>
    </form>
    <?php
    $sth = $dbh->prepare('SELECT * FROM kategorijos ORDER BY kategorija;');
    $sth->execute();
    $rez = $sth->fetchAll();
    echo "<h3>Category list</h3>";
    foreach ($rez AS $val){
      echo $val['Kategorija'];
      echo "<br>";
    }

    ?>

  </body>
</html>
