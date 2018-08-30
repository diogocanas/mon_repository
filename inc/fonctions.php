<?php
const HOST = "localhost";
const DBNAME = "forum";
const USER = "root";
const PWD = "";

try {
    $bdd = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, USER , PWD);
} catch (Exception $ex) {
    die('Erreur : ' . $ex->getMessage());
}
