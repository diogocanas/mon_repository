<!--
    Titre       : revision_forum | index.php
    Auteur      : Diogo Canas Almeida
    Date        : 30.08.2018
    Version     : 1.0
    Description : Page de connexion d'un forum
-->
<?php
session_start();
if (!$_SESSION['inscription_reussie']) {
    $_SESSION['inscription_reussie'] = false;
}
$_SESSION['connexion_reussie'] = false;
$_SESSION['id_connexion'] = filter_input(INPUT_POST, 'id_connexion', FILTER_SANITIZE_STRING);
$_SESSION['mdp_connexion'] = filter_input(INPUT_POST, 'mdp_connexion', FILTER_SANITIZE_STRING);
$btn_connexion = filter_input(INPUT_POST, 'btn_connexion');

include('./inc/fonctions.php');
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="./css/style.css" />
        <title>Page de connexion</title>
    </head>
    <body>
        <?php
        if ($_SESSION['inscription_reussie'] == true) {
            echo "Votre inscription a été réussie. Connectez-vous !";
            $_SESSION['inscription_reussie'] = false;
        }
        ?>
        <form method="POST" action="index.php">
            <fieldset>
                <legend>Connexion</legend>
                <label for="id-connexion">Identifiant :</label>
                <br />
                <input type="text" name="id_connexion" id="id-connexion" autofocus />
                <br />
                <label for="mdp-connexion">Mot de passe :</label>
                <br />
                <input type="password" name="mdp_connexion" id="mdp-connexion" />
                <br />
                <input type="submit" name="btn_connexion" id="btn-placement" value="Valider" />
            </fieldset>
            <a href="./inscription.php">Pas encore inscrit?</a>
        </form>
    </body>
</html>
<?php
if ($btn_connexion) {
    if (!empty($_SESSION['id_connexion']) && !empty($_SESSION['mdp_connexion'])) {
        $req_connexion = $bdd->query('SELECT login, password FROM users');
        while ($donnees = $req_connexion->fetch()) {
            if ($_SESSION['id_connexion'] !== $donnees['login'] || $_SESSION['mdp_connexion'] !== $donnees['password']) {
                echo "Votre identifiant ou mot de passe est incorrect.";
            } else {
                $_SESSION['connexion_reussie'] = true;
                header('Location: confirmation.php');
            }
        }
    }
}