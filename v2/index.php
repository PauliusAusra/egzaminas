<?php

require_once("db.php");

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="index.css">
    <title>Index</title>
  </head>

  <ul class="nav justify-content-end">
  <li class="nav-item">
    <a class="nav-link active" href="#">Apie mus</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Paslaugos</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Kontaktai</a>
  </li>
</ul>
  <body>

<div class="jumbotron">
  <h1 class="display-4">Paslaugos</h1>
  <p>Užpildyti savo sugalvotu tekstu. Žemiau pateiktas mygtukas turi vesti į atsiliepimų formos puslapį.</p>
  <p class="lead">
    <a class="btn btn-primary btn-lg" href="atsiliepimu_puslapis.php" role="button">Palikite atsiliepimą</a>
  </p>
</div>

<div class="row">

<div class="col-6">
  <h2>Statistika</h2>
  <p>
    Užpildyti savo sugalvotu tekstu. Lorem ipsum dolor sit amet, consectetur adipiscing elit. In venenatis tincidunt quam, placerat pretium urna dignissim a. Vestibulum auctor faucibus risus at tincidunt. Sed tincidunt diam ex. Morbi ut convallis libero. In risus ex, tempor in orci nec, imperdiet porta mi. Sed scelerisque fermentum purus ac consequat.
  </p>
<div class="progress">
  <div class="progress-bar" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">Skrydžiai 75%</div>
</div>
<br>
<div class="progress">
  <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Autobusų nuoma 25%</div>
</div>
<br>
<div class="progress">
  <div class="progress-bar" role="progressbar" style="width: 55%;" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100">Automobilių nuoma 55%</div>
</div>
<br>
<div class="progress">
  <div class="progress-bar" role="progressbar" style="width: 30%;" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">Dviračių nuoma 30%</div>
</div>
<br>
<button type="button" class="btn btn-primary">Plačiau...</button>
</div>

<div class="col-3">
<div class="card" style="width: 18rem;">
  <img class="card-img-top" src="images/skrydziai.jpg" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title">Skrydžiai</h5>
    <p class="card-text">Užpildyti savo sugalvotu paslaugos aprašymu. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
    <a href="#" class="btn btn-primary">Plačiau...</a>
  </div>
</div>
</div>

<div class="col-3">
<div class="card" style="width: 18rem;">
  <img class="card-img-top" src="images/automobiliu_nuoma.jpg" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title">Automobilių nuoma</h5>
    <p class="card-text">Internete suraskite paslaugom skirtus paveiksliukus.</p>
    <a href="#" class="btn btn-primary">Plačiau...</a>
  </div>
</div>
</div>

</div>

<br>
<br>

<footer class="footer-1">
    <div class="container">
        <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-12 text-center">
            <img src="images/dviraciu_nuoma.png" class="img-2" width="75" height="75" alt="...">
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 text-center">
                <img src="images/automobiliu_nuoma.png" class="img-2" width="75" height="75" alt="...">
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 text-center">
                    <img src="images/lektuvu_bilietai.png" class="img-2" width="75" height="75" alt="...">
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 text-center">
                        <img src="images/keliones_autobusu.png" class="img-2" width="75" height="75" alt="...">
                        </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-12 text-center">
                <h4 class="h4-1">Dviračių nuoma</h4>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 text-center">
                    <h4 class="h4-1">Automobilių nuoma</h4>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 text-center">
                        <h4 class="h4-1">Lėktuvų bilietai</h4>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 text-center">
                            <h4 class="h4-1">Kelionės autobusu</h4>
                            </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-12 text-center">
                    <button type="button" class="btn btn-primary">Ieškoti</button>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 text-center">
                        <button type="button" class="btn btn-primary">Ieškoti</button>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 text-center">
                            <button type="button" class="btn btn-primary">Ieškoti</button>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 text-center">
                                <button type="button" class="btn btn-primary">Ieškoti</button>
                                </div>
                </div>
    </div>
    </footer>

    <br>
    <br>

    <div class="copyright"> &copy; 2017-2020 - Paulius Aušra, 14 PHP gr. </div>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
