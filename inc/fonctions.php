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
    echo "<p class=\"warning\">";
    die('Erreur : ' . $ex->getMessage());
    echo "</p>";
}

function getUserByLogin($login, $bdd) {
    $req_nom_prenom = $bdd->query("SELECT idUser, surname, name FROM users WHERE login = \"" . $login . "\"");
    $donnees = $req_nom_prenom->fetch();
    return array($donnees['surname'], $donnees['name'], $donnees['idUser']);
}

function insertPost($title, $description, $idUser, $bdd) {
    try {
        $req_inscription = $bdd->prepare('INSERT INTO news(title, description, idUser) VALUES(?, ?, ?)');
        $req_inscription->execute(array(
            $title,
            $description,
            $idUser
        ));
        return true;
    } catch (Exception $ex) {
        echo "<p class=\"warning\">";
        echo "Erreur : " . $ex->getMessage();
        echo "</p>";
        return false;
    }
}

function getPosts($bdd) {
    $post_solo = [];
    $post_all = [];
    $req_posts = $bdd->query("SELECT idNews, title, description, creationDate, lastEditDate FROM news ORDER BY idNews DESC");
    while ($donnees = $req_posts->fetch()) {
    $post_solo[] = array($donnees['title'], $donnees['description'], $donnees['creationDate'], $donnees['lastEditDate'], $donnees['idNews']);
    $post_all[] = array($post_solo[count($post_solo) - 1]);
    }
    return $post_all;
}

function getNamePoster($bdd, $idNews) {
    $req_name = $bdd->query("SELECT surname, name FROM users AS u, news AS n WHERE u.idUser = n.idUser AND idNews = " . "\"$idNews\"");
    $donnees = $req_name->fetch();
    return array($donnees['surname'], $donnees['name']);
}

function canModifyDelete($bdd) {
    
}