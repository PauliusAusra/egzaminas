<?php

session_start();

require_once("db.php");

if (!empty($_POST["el_pastas"]) && !empty($_POST["password"])){

  $el_pastas = $_POST["el_pastas"];
  $password = $_POST["password"];

  try {
    $sth = $dbh->prepare('SELECT vartotojai.*, vt.Vartotojo_tipas, vt.id AS tipo_id FROM vartotojai
      LEFT JOIN vartotoju_tipai AS vt ON vt.id = vartotojai.Vartotoju_tipai_id
      WHERE vartotojai.El_pastas = ?;');

    $sth->execute(array($el_pastas));
    $vartotoju_kiekis = $sth->rowCount();

    if ($vartotoju_kiekis == 1){
      $vartotojas = $sth->fetch(PDO::FETCH_ASSOC);

      if (password_verify($password, $vartotojas["Slaptazodis"])){
        unset($vartotojas["Slaptazodis"]);
        $_SESSION["user"] = $vartotojas;
      }
    }
  } catch (PDOException $e) {
      print "Error!: " . $e->getMessage() . "<br/>";
      die();
  }
}

if (isset($_GET["logout"])){
  unset($_SESSION["user"]);
  header("Location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="login.css">
    <title>Login</title>
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
      echo '<p class="loginSuccessful">Login successful, you can now </p><a href="write.php" class="btn btn-primary write" role="button">Write</a><a href="read.php" class="btn btn-secondary read" role="button">Read</a><a href="login.php?logout=1" class="btn btn-danger logout" role="button">Log out</a>';
    } else {
      echo '<form class="login" action="login.php" method="post">
        <div class="form-floating mb-3">
        <input type="email" class="form-control" id="floatingInput" name="el_pastas" placeholder="Email" required>
        </div>
        <div class="form-floating">
        <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
        </div>
        <button type="submit" class="btn btn-primary loginButton" name="Submit">Log in</button>
        <a href="register.php" class="btn btn-secondary register" role="button">Register</a>
      </form>';
    }

?>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
