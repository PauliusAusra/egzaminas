<?php

require_once("db.php");

if (!empty($_POST["vardas"])){
  $vardas = $_POST["vardas"];
  $pavarde = $_POST["pavarde"];
  $el_pastas = $_POST["el_pastas"];
  $password1 = $_POST["password1"];
  $password2 = $_POST["password2"];

  $valid = true;
  if ($vardas == ""){
    $valid = false;
  } elseif ($pavarde == ""){
    $valid = false;
  } elseif ($el_pastas == ""){
    $valid = false;
  } elseif ($password1 == ""){
    $valid = false;
  } elseif ($password2 == ""){
    $valid = false;
  } elseif ($password1 !== $password2){
    $valid = false;
  }

  if ($valid){

    try {
      $sth = $dbh->prepare('INSERT INTO vartotojai (Vardas, Pavarde, El_pastas, Slaptazodis, Vartotoju_tipai_id) VALUES (?,?,?,?,?);');
      $sth->execute(array($vardas, $pavarde, $el_pastas, password_hash($password1, PASSWORD_DEFAULT), 1));
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
  }
  echo '<p class="login">Registration successful, you can now </p><a href="login.php" class="btn btn-secondary loginButton" role="button">Log in</a>';
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="register.css">
    <title>Register</title>
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

    <form class="registerForm" action="register.php" method="post">
      <div class="form-floating mb-3">
      <input type="text" class="form-control" id="floatingInput" name="vardas" placeholder="Name" required>
      </div>
      <div class="form-floating mb-3">
      <input type="text" name="pavarde" class="form-control" id="floatingPassword" placeholder="Surname" required>
      </div>
      <div class="form-floating mb-3">
      <input type="email" name="el_pastas" class="form-control" id="floatingPassword" placeholder="Email" required>
      </div>
      <div class="form-floating mb-3">
      <input type="password" name="password1" class="form-control" id="floatingPassword" placeholder="Password" required>
      </div>
      <div class="form-floating mb-3">
      <input type="password" name="password2" class="form-control" id="floatingPassword" placeholder="Repeat password" required>
      </div>
      <button type="submit" class="btn btn-primary registerButton" name="Submit">Register</button>
    </form>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
