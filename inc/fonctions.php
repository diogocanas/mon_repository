<?php
/*
 *  Titre       : revision_forum | fonctions.php
 *  Auteur      : Diogo Canas Almeida
 *  Date        : 30.08.2018
 *  Version     : 1.0
 *  Description : Page des fonctions
 */

const HOST = "localhost";
const DBNAME = "forum";
const USER = "root";
const PWD = "";

try {
    $bdd = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, USER, PWD);
} catch (Exception $ex) {
    die('Erreur : ' . $ex->getMessage());
}
