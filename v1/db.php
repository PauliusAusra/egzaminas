<?php

try {
    $dbh = new PDO('mysql:host=localhost;dbname=kuriniai', "root", "");
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

?>
