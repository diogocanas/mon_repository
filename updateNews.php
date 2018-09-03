<!--
    Titre       : revision_forum | updateNews.php
    Auteur      : Diogo Canas Almeida
    Date        : 03.09.2018
    Version     : 1.0
    Description : Page de modification de posts
-->
<?php
session_start();
include('inc/fonctions.php');
$_SESSION['idNews'] = filter_input(INPUT_GET, 'idNews', FILTER_VALIDATE_INT);
$_SESSION['title_modif'] = filter_input(INPUT_POST, 'titre_modif', FILTER_SANITIZE_STRING);
$_SESSION['description_modif'] = filter_input(INPUT_POST, 'description_modif', FILTER_SANITIZE_STRING);
$btn_modification = filter_input(INPUT_POST, 'btn_modification');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="./css/style.css" />
        <title>Page de modification d'un post</title>
    </head>
    <body>
        <h1>Mise à jour d'une nouvelle</h1>
        <form method="POST" action="updateNews.php?idNews=<?= $_SESSION['idNews'] ?>">
            <fieldset>
                <legend>Données du post</legend>
                <label for="titre-modif">Titre :</label>
                <br />
                <input type="text" name="titre_modif" id="titre-modif" value="<?= getPostById($bdd, $_SESSION['idNews'])[0] ?>" autofocus />
                <br />
                <label for="description-modif">Description :</label>
                <br />
                <textarea rows="20" cols="100" name="description_modif" id="description-modif"><?= getPostById($bdd, $_SESSION['idNews'])[1] ?></textarea>
                <br />
                <input type="submit" name="btn_modification" value="Modifier" />
            </fieldset>
        </form>
        <?php
        if ($btn_modification) {
            if (updatePost($bdd, $_SESSION['idNews'], $_SESSION['title_modif'], $_SESSION['description_modif'])) {
                echo "Le post a été modifié !";
            } else {
                echo "La modification de ce post a rencontré un problème. Veuillez réessayez plus tard.";
            }
        }
        ?>
        <a href = "main.php">Retour</a>
    </body>
</html>