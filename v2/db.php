<?php

try {
    $dbh = new PDO('mysql:host=localhost;dbname=atsiliepimai', "root", "");
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

?>
