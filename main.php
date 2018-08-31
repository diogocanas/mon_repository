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

$_SESSION['titre_post'] = filter_input(INPUT_POST, 'titre_post', FILTER_SANITIZE_STRING);
$_SESSION['description_post'] = filter_input(INPUT_POST, 'description_post', FILTER_SANITIZE_STRING);
$btn_publication = filter_input(INPUT_POST, 'btn_publication');
$btn_deconnexion = filter_input(INPUT_POST, 'btn_deconnexion');

if ($btn_publication) {
    if ($_SESSION['titre_post'] === "") {
        echo "<h1>";
        echo "La saisie d'un titre est obligatoire !";
        echo "</h1>";
    }
    if ($_SESSION['description_post'] === "") {
        echo "<h1>";
        echo "La saisie d'une description est obligatoire !";
        echo "</h1>";
    }
}

if ($btn_publication) {
    if (insertPost($_SESSION['titre_post'], $_SESSION['description_post'], getUserByLogin($_SESSION['id_connexion'], $bdd)[2], $bdd) === true) {
        echo "<h1>";
        echo "Votre post a bien été publié.";
        echo "</h1>";
        $_SESSION['titre_post'] = "";
        $_SESSION['description_post'] = "";
    } else {
        echo "<h1>";
        echo "La publication de votre post a rencontré un problème.";
        echo "</h1>";
    }
}

if ($_SESSION['connexion_reussie'] === true) {
    echo "<h1>";
    echo 'Bonjour ' . getUserByLogin($_SESSION['id_connexion'], $bdd)[0] . ' ' . getUserByLogin($_SESSION['id_connexion'], $bdd)[1] . ", voici votre fil d'actualité !";
    echo "</h1>";
}

if ($btn_deconnexion) {
    session_destroy();
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="./css/style.css" />
        <title>Page de confirmation de connexion</title>
    </head>
    <body>
        <form method="POST" action="main.php">
            <fieldset>
                <legend>Nouveau post</legend>
                <label for="titre-post">Titre :</label>
                <br />
                <input type="text" name="titre_post" id="titre-post" value="<?= $_SESSION['titre_post'] ?>" autofocus />
                <br />
                <label for="description-post">Description :</label>
                <br />
                <textarea rows="20" cols="100" name="description_post" id="description-post"><?= $_SESSION['description_post'] ?></textarea>
                <br />
                <input type="submit" name="btn_publication" value="Insérer" />
            </fieldset>
            <br />
            <input type="submit" name="btn_deconnexion" value="Déconnexion" />
        </form>
    </body>
</html>
<?php
for ($i = 0; $i < count(getPosts($bdd)); $i++) {
    foreach (getPosts($bdd)[$i] as $post) {
        echo "<div id=\"post\">";
        echo "<p>";
        echo "Auteur : " . getNamePoster($bdd, $post[4])[0] . " " . getNamePoster($bdd, $post[4])[1];
        echo "</p>";
        echo "<p>";
        echo "Posté le " . (new DateTime($post[2]))->format("d.m.Y à H:i:s. ");
        echo "Dernière modification le " . (new DateTime($post[3]))->format("d.m.Y à H:i:s.");
        echo "</p>";
        echo "<h1>";
        echo $post[0];
        echo "</h1>";
        echo "<p>";
        echo $post[1];
        echo "</p>";
        echo "</div>";
    }
}