<!--
    Titre       : revision_forum | main.php
    Auteur      : Diogo Canas Almeida
    Date        : 30.08.2018
    Version     : 1.0
    Description : Page de création de 
-->
<?php
session_start();

include('./inc/fonctions.php');
?>
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
if ($_SESSION['connexion_reussie'] === true) {
    $req_nom_prenom = $bdd->query("SELECT surname, name FROM users WHERE login = \"" . $_SESSION['id_connexion'] . "\"");
    $donnees = $req_nom_prenom->fetch();
    echo "<h1>";
    echo 'Bonjour ' . $donnees['surname'] . ' ' . $donnees['name'] . ", voici votre fil d'actualité !";
    echo "</h1>";
}