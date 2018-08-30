<!--
    Titre       : revision_forum | confirmation.php
    Auteur      : Diogo Canas Almeida
    Date        : 30.08.2018
    Version     : 1.0
    Description : Page de confirmation de la connexion d'un forum
-->
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="./css/style.css" />
        <title>Page de confirmation de connexion</title>
    </head>
    <body></body>
</html>
<?php
session_start();
if ($_SESSION['connexion_reussie'] === true) {
    echo 'Bonjour ' . $_SESSION['prenom_inscription'] . ' ' . $_SESSION['nom_inscription'] . ", vous êtes connecté !";
}