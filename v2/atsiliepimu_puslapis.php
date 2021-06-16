<?php

require_once("db.php");

if (!empty($_POST["vardas"]) && !empty($_POST["el_pastas"])){
  $vardas = $_POST["vardas"];
  $pavarde = $_POST["pavarde"];
  $el_pastas = $_POST["el_pastas"];
  $atsiliepimas = $_POST["atsiliepimas"];

  $valid = true;
  if ($vardas == ""){
    $valid = false;
  } elseif ($el_pastas == ""){
    $valid = false;
  }

  if ($valid){

    try {
      $sth = $dbh->prepare('INSERT INTO atsiliepimai (Vardas, Pavarde, El_pastas, Atsiliepimas) VALUES (?,?,?,?);');
      $sth->execute(array($vardas, $pavarde, $el_pastas, $atsiliepimas));
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="index.css">
    <title>Atsiliepimų puslapis</title>
  </head>
<a href="index.php">< < Grįžti atgal</a>

<br>
<br>

<form class="registerForm" action="atsiliepimu_puslapis.php" method="post">
  <div class="form-floating mb-3">
  <input type="text" class="form-control" id="floatingInput" name="vardas" placeholder="Įveskite savo vardą *" required>
  </div>
  <div class="form-floating mb-3">
  <input type="text" name="pavarde" class="form-control" id="floatingPassword" placeholder="Įveskite savo pavardę">
  </div>
  <div class="form-floating mb-3">
  <input type="email" name="el_pastas" class="form-control" id="floatingPassword" placeholder="Įveskite savo el. pašto adresą *" required>
  </div>
  <div class="form-floating mb-3">
  <textarea name="atsiliepimas" rows="8" cols="80" class="form-control" id="floatingPassword" placeholder="Jūsų nuomonė apie mus"></textarea>
  </div>
  * pažymėtus laukus privaloma užpildyti
  <br>
  <br>
  <button type="submit" class="btn btn-primary registerButton" name="Submit">Siųsti atsiliepimą</button>
</form>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
