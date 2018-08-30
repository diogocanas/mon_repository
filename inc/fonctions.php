<?php

function connexionBDD($bdd, $host, $dbname, $user, $pwd) {
    try {
        $bdd = new PDO("mysql:host=$host;dbname=$dbname", $user, $pwd);
    } catch (Exception $ex) {
        die('Erreur : ' . $ex->getMessage());
    }
    return $bdd;
}
