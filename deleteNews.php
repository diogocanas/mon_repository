<!--
    Titre       : revision_forum | deleteNews.php
    Auteur      : Diogo Canas Almeida
    Date        : 03.09.2018
    Version     : 1.0
    Description : Page de suppression de posts
-->

<?php
session_start();
include('inc/fonctions.php');
$_SESSION['idNews'] = filter_input(INPUT_GET, 'idNews', FILTER_VALIDATE_INT);
$_SESSION['suppression'] = filter_input(INPUT_POST, 'suppression', FILTER_SANITIZE_STRING);
$btn_suppression = filter_input(INPUT_POST, 'btn_suppression');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="./css/style.css" />
        <title>Page de suppression d'un post</title>
    </head>
    <body>
        <h1>Suppression d'une nouvelle</h1>
        <form method="POST" action="deleteNews.php?idNews=<?= $_SESSION['idNews'] ?>">
            <p>Êtes-vous sûr de vouloir supprimer le post intitulé : "<?= getPostById($bdd, $_SESSION['idNews'])[0] ?>"?</p>
            <input type="radio" name="suppression" id="oui-suppression" value="oui" /> <label for="oui-suppression">Oui</label>
            <input type="radio" name="suppression" id="non-suppression" value="non" checked/> <label for="non-suppression">Non</label>
            <input type="submit" name="btn_suppression" value="Valider" />
        </form>
        <?php
        if ($btn_suppression) {
            if ($_SESSION['suppression'] === "oui") {
                deletePost($bdd, $_SESSION['idNews']);
                echo "Le post a bien été supprimé !";
            } elseif ($_SESSION['suppression'] === "non") {
                echo "Le post n'a pas été supprimé.";
            }
        }
        ?>
        <a href = "main.php">Retour</a>
    </body>
</html>