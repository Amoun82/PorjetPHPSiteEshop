<?php
require_once "../inc/init.inc.php";
require_once "../inc/function.inc.php";


if (!isConnect()) {
    header('location:'.URL.'index.php');
    exit();
}

//var_dump($_POST);

$erreur = false;

if (isset($_POST['pseudo'], $_POST['mdp'])) {
    $pseudo = $_POST['pseudo'];
    $mdp = $_POST['mdp'];


    if (empty($pseudo) || empty($mdp)) {
        $messageErreur .= '<div class="alert alert-danger" role="alert">des champs sont vides.</div>';
    } else {

        // verifie la longueur du pseudo
        if (iconv_strlen($mdp) > 35) {
            $messageErreur .= '<div class="alert alert-danger" role="alert">
        Attention votre mot de passe est trop long</div>';
            $erreur = true;
        }
        // verifie la longueur du pseudo
        if (iconv_strlen($mdp) < 3) {
            $messageErreur .= '<div class="alert alert-danger" role="alert">
        Attention votre mot de passe est trop court</div>';
            $erreur = true;
        }

        // verifie la longueur du pseudo
        if (iconv_strlen($pseudo) > 20) {
            $messageErreur .= '<div class="alert alert-danger" role="alert">
        Attention votre pseudo est trop long</div>';
            $erreur = true;
        }

        // verifie la longueur du pseudo
        if (iconv_strlen($pseudo) < 4) {
            $messageErreur .= '<div class="alert alert-danger" role="alert">
        Attention votre pseudo est trop court</div>';
            $erreur = true;
        }
        //echo "votre pseudo est : $pseudo, votre mot de passe est : $mdp<br>";

        // recuperer la liste des pseudos
        $requete = $pdo->query("SELECT * from menbre where pseudo = '$pseudo'");


        // echo "<pre>";
        // print_r($reponse);
        // echo "</pre>";

        $reponse = $requete->fetch(PDO::FETCH_ASSOC);

        //var_dump($reponse);
        // var_dump($pseudoBDD);


        // regarde si le pseudo est dans la base
        if (empty($reponse['pseudo'])) {
            $erreur = true;
            $messageErreur .= '<div class="alert alert-danger" role="alert">votre pseudo n\'existe pas veuillez vous s\'inscrire.</div>';
        } else {
            $messageErreur .= '<div class="alert alert-success" role="alert">votre pseudo est connu.</div>';
        }

        if (!empty($reponse['mdp'])) {
            if (password_verify($mdp, $reponse['mdp'])) {
                $messageErreur .= '<div class="alert alert-success" role="alert">les mots de passe correspondent.</div>';
                //var_dump(password_verify($mdp, $reponse['mdp']));
            } else {
                $erreur = true;
                $messageErreur .= '<div class="alert alert-danger" role="alert">les mots de passe ne correspondent pas.</div>';
            }
        }


        if ($erreur == false) {
            $_SESSION['menbre']['pseudo'] = $reponse['pseudo'];
            $_SESSION['menbre']['id_menbre'] = $reponse['id_menbre'];
            $_SESSION['menbre']['nom'] = $reponse['nom'];
            $_SESSION['menbre']['prenom'] = $reponse['prenom'];
            $_SESSION['menbre']['email'] = $reponse['email'];
            $_SESSION['menbre']['sexe'] = $reponse['sexe'];
            $_SESSION['menbre']['ville'] = $reponse['ville'];
            $_SESSION['menbre']['cp'] = $reponse['cp'];
            $_SESSION['menbre']['adresse'] = $reponse['adresse'];
            $_SESSION['menbre']['status'] = $reponse['status'];

            header('location:../index.php');
            //var_dump($_SESSION);
        }
    }
}

require_once "../inc/header.inc.php";
require_once "../inc/nav.inc.php";

?>


<main class="container">
    <div>
        <?= $messageErreur ?>
    </div>

    <form class="row g-3" method="post">
        <div class="col-md-12">
            <label for="pseudo" class="form-label">Pseudo :</label>
            <input type="text" class="form-control" id="pseudo" name="pseudo">
        </div>
        <div class="col-md-12">
            <label for="mdp" class="form-label">Mot de passe :</label>
            <input type="password" class="form-control" id="mdp" name="mdp">
        </div>
        <div class="col-6">
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </div>
    </form>
</main>

<?php require_once "../inc/footer.inc.php" ?>