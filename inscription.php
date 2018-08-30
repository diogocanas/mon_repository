<!--
    Titre       : revision_forum | inscription.php
    Auteur      : Diogo Canas Almeida
    Date        : 30.08.2018
    Version     : 1.0
    Description : Page d'inscription d'un forum
-->
<?php
// Initialisation des variables
session_start();
$_SESSION['inscription_reussie'] = false;
$donnees_vides = true;
$_SESSION['prenom_inscription'] = filter_input(INPUT_POST, 'prenom_inscription', FILTER_SANITIZE_STRING);
$_SESSION['nom_inscription'] = filter_input(INPUT_POST, 'nom_inscription', FILTER_SANITIZE_STRING);
$_SESSION['id_inscription'] = filter_input(INPUT_POST, 'id_inscription', FILTER_SANITIZE_STRING);
$_SESSION['mdp_inscription'] = filter_input(INPUT_POST, 'mdp_inscription', FILTER_SANITIZE_STRING);
$_SESSION['valid_mdp_inscription'] = filter_input(INPUT_POST, 'valid_mdp_inscription', FILTER_SANITIZE_STRING);
$btn_inscription = filter_input(INPUT_POST, 'btn_inscription');
$donnees_form = array($_SESSION['prenom_inscription'], $_SESSION['nom_inscription'],
    $_SESSION['id_inscription'], $_SESSION['mdp_inscription'],
    $_SESSION['valid_mdp_inscription']);

$bdd = null;

include('./inc/fonctions.php');
connexionBDD($bdd, 'localhost', 'forum', 'root', '');
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="./css/style.css" />
        <title>Page d'inscription</title>
    </head>
    <body>
        <form method="POST" action="inscription.php">
            <fieldset>
                <legend>Inscription</legend>
                <label for="prenom-inscription">Prénom :</label>
                <br />
                <input type="text" name="prenom_inscription" id="prenom-inscription" value="<?= $_SESSION['prenom_inscription'] ?>" autofocus />
                <br />
                <label for="nom-inscription">Nom :</label>
                <br />
                <input type="text" name="nom_inscription" id="nom-inscription" value="<?= $_SESSION['nom_inscription'] ?>" />
                <br />
                <label for="id-inscription">Identifiant :</label>
                <br />
                <input type="text" name="id_inscription" id="id-inscription" value="<?= $_SESSION['id_inscription'] ?>" />
                <br />
                <label for="mdp-inscription">Mot de passe :</label>
                <br />
                <input type="password" name="mdp_inscription" id="mdp-inscription" />
                <br />
                <label for="valid-mdp-inscription">Validation du mot de passe :</label>
                <br />
                <input type="password" name="valid_mdp_inscription" id="valid-mdp-inscription" />
                <br />
                <input type="submit" name="btn_inscription" id="btn-placement" value="Valider" />
            </fieldset>
            <a href="./index.php">Retour sur connexion</a>
        </form>
    </body>
</html>
<?php
// Si on clique sur le bouton
if ($btn_inscription) {
    foreach ($donnees_form as $donnee) {
        if (!empty($donnee)) {
            $donnees_vides = false;
        } else {
            // Si une des données du formulaire est vide, sortir de la boucle.
            $donnees_vides = true;
            break;
        }
    }
    if ($donnees_vides === false) {
        if ($_SESSION['mdp_inscription'] !== "" && $_SESSION['valid_mdp_inscription'] !== "" && $_SESSION['mdp_inscription'] === $_SESSION['valid_mdp_inscription']) {
            $_SESSION['inscription_reussie'] = true;
            $req = connexionBDD($bdd, $host, $dbname, $user, $pwd)->prepare('INSERT INTO users(surname, name, login, password) VALUES(?, ?, ?, ?)');
            $req->execute(array(
                $_SESSION['prenom_inscription'],
                $_SESSION['nom_inscription'],
                $_SESSION['id_inscription'],
                $_SESSION['mdp_inscription']
            ));
        } else {
            echo "Le mot de passe et sa validation sont vides ou ne sont pas identiques.";
        }
    } else {
        echo "Merci de remplir tous les champs !";
    }
}