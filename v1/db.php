<?php

try {
    $dbh = new PDO('mysql:host=localhost;dbname=egzaminas', "root", "");
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

?>
