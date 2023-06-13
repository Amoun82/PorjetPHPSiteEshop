<?php
require_once "../inc/init.inc.php";
require_once "../inc/header.inc.php";
require_once "../inc/nav.inc.php";


// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

$erreur = false;

// [email] => dufstef@hotmail.fr
// [pseudo] => Sephirot
// [mdp] => test
// [confirmeMdp] => test
// [nom] => dufour
// [prenom] => stephane
// [sexe] => m
// [adresse] => 34 RUE RENE LIEBERT
// [ville] => LAON
// [cp] => 02000

if (isset($_POST['email'], $_POST['pseudo'], $_POST['mdp'], $_POST['confirmeMdp'], $_POST['nom'], $_POST['prenom'], $_POST['sexe'], $_POST['adresse'], $_POST['ville'], $_POST['cp'])) {

    // controler le champs email
    $email = trim($_POST['email']);
    $email = stripslashes($email);

    // controler le champs pseudo
    $pseudo = trim($_POST['pseudo']);
    $pseudo = stripslashes($pseudo);

    // controler le champs mdp
    $mdp = trim($_POST['mdp']);

    // controler le champs mdp
    $confirmeMdp = trim($_POST['confirmeMdp']);

    // controler le champs nom
    $nom = trim($_POST['nom']);
    $nom = stripslashes($nom);

    // controler le champs prenom
    $prenom = trim($_POST['prenom']);
    $prenom = stripslashes($prenom);

    $sexe = $_POST['sexe'];

    $adresse = trim($_POST['adresse']);

    $ville = trim($_POST['ville']);

    // echo "la ville : $ville<br>";

    $cp = trim($_POST['cp']);

    // echo "le sexe est : $sexe<br>";

    //password_hash("rasmuslerdorf", PASSWORD_DEFAULT);

    // echo "mot de passe : $mdp<br>" ;
    // echo "confirmé le mot de passe : $confirmeMdp<br>" ;

    // echo strcmp($mdp, $confirmeMdp)."<br>" ;
    // var_dump(empty($email));

    // var_dump(empty($sexe));

    // regarder si les variebles sont vide
    if (empty($email) || empty($pseudo) || empty($mdp) || empty($confirmeMdp) || empty($nom) || empty($prenom) || empty($sexe) || empty($adresse) || empty($ville) || empty($cp)) {
        $messageErreur .= '<div class="alert alert-danger" role="alert">
            Attention, un des champs sont vides</div>';
        $erreur = true;
    } else {

        $reponsePseudo = $pdo->query("SELECT pseudo from menbre");



        $verifPseudo = preg_match('#^[a-zA-Z0-9._-]+$#', $pseudo);
        $verifnom = preg_match('#^[a-zA-Z]+$#', $nom);
        $verifPrenom = preg_match('#^[a-zA-Z]+$#', $prenom);

        $verifVille = preg_match('#^[a-zA-Z]+$#', $ville);

        $verifCp = preg_match('#^[0-9]{5}$#', $cp);

        // echo "le code postal " . $verifCp . "<br>";

        // echo "la variable verfville :$verifVille<br>";

        // echo "l'email : ".filter_var($email, FILTER_VALIDATE_EMAIL)."<br>" ;


        // recuperer la liste des pseudos
        $reponse = $pdo->query("SELECT pseudo from menbre");

        // echo "<pre>";
        // print_r($reponse);
        // echo "</pre>";

        $pseudoBDD = $reponse->fetchAll(PDO::FETCH_ASSOC);
        // var_dump($pseudoBDD);

        // compare le pseudo envoyer par l'utilisateur par rapport au pseudo contenu dans la base
        foreach ($pseudoBDD as $key => $value) {

            if (strcmp($value['pseudo'], $pseudo) == 0) {
                $erreur = true;
                $messageErreur .= '<div class="alert alert-danger" role="alert">
            pseudo deja pris.</div>';
            }
        }


        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $erreur = true;
            $messageErreur .= '<div class="alert alert-danger" role="alert">
            Attention, l\'email nest pas valide.</div>';
        }

        if ($verifPseudo == false) {
            $erreur = true;
            $messageErreur .= '<div class="alert alert-danger" role="alert">
            Attention, le pseudo ne peut pas contenir autre chose que des minuscules, majuscules, point, tiret, underscore.</div>';
        }
        if ($verifnom == false) {
            $erreur = true;
            $messageErreur .= '<div class="alert alert-danger" role="alert">
            Attention, le nom ne peut pas contenir autre chose que des minuscules, majuscules.</div>';
        }
        if ($verifPrenom == false) {
            $erreur = true;
            $messageErreur .= '<div class="alert alert-danger" role="alert">
            Attention, le prenom ne peut pas contenir autre chose que des minuscules, majuscules.</div>';
        }

        if ($verifVille == false) {
            $erreur = true;
            $messageErreur .= '<div class="alert alert-danger" role="alert">
            Attention, la ville ne peut pas contenir autre chose que des minuscules, majuscules.</div>';
        }

        if ($verifCp == false) {
            $erreur = true;
            $messageErreur .= '<div class="alert alert-danger" role="alert">
            Attention, le code postal n\'est pas bon, il doit comporter 5 chiffres.</div>';
        }
    }

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
    // verifie la longueur du pseudo
    if (iconv_strlen($nom) > 20) {
        $messageErreur .= '<div class="alert alert-danger" role="alert">
        Attention votre pseudo est trop long</div>';
        $erreur = true;
    }
    // verifie la longueur du pseudo
    if (iconv_strlen($prenom) > 20) {
        $messageErreur .= '<div class="alert alert-danger" role="alert">
        Attention votre pseudo est trop long</div>';
        $erreur = true;
    }


    //pou hasher le mot de passe en vérifiant que mot de passe et confirme mot de passe soit identique
    if (strcmp($mdp, $confirmeMdp) !== 0) {
        $messageErreur .= '<div class="alert alert-danger" role="alert">
    Attention, les deux mots de passe ne correspondent pas</div>';
        $erreur = true;
    } else {
        $mdp = password_hash($mdp, PASSWORD_DEFAULT);
        // echo "les mots de passes sont modifié<br>";
    }

    // verification avant l'execution de la BDD
    if ($erreur == false) {
        $requete = $pdo->prepare("INSERT INTO menbre(id_menbre, pseudo, mdp, nom, prenom, email, sexe, ville, cp, adresse, status) VALUES (NULL,:pseudo, :mdp, :nom, :prenom, :email, :sexe, :ville, :cp, :adresse,'2')");
        $requete->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
        $requete->bindParam(':mdp', $mdp, PDO::PARAM_STR);
        $requete->bindParam(':nom', $nom, PDO::PARAM_STR);
        $requete->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $requete->bindParam(':email', $email, PDO::PARAM_STR);
        $requete->bindParam(':sexe', $sexe, PDO::PARAM_STR);
        $requete->bindParam(':ville', $ville, PDO::PARAM_STR);
        $requete->bindParam(':cp', $cp, PDO::PARAM_INT);
        $requete->bindParam(':adresse', $adresse, PDO::PARAM_STR);
        $requete->execute();

        // $arr = $requete->errorInfo();
        // print_r($arr);

        $messageErreur = '<div class="alert alert-success" role="alert">
    vous etes enregister, veuillez vous connectez</div>';
        header('location:form.connexion.php');
    }


    /* "INSERT INTO menbre (id_menbre ,pseudo , mdp , nom , prenom , email , sexe , ville , cp , adresse , status ) VALUES (NULL , 'test', 'test', 'test', 'test', 'test@test.test', 'm', 'test', 01221, 'test', 2)";

    INSERT INTO `menbre`(`id_menbre`, `pseudo`, `mdp`, `nom`, `prenom`, `email`, `sexe`, `ville`, `cp`, `adresse`, `status`) VALUES (NULL,'test2','test','test','test','test@test.test]','m','test','05000','test','2') */
}


?>

<main class="container">
    <div>
        <?= $messageErreur ?>
    </div>
    <form class="row g-3" method="post">
        <div class="col-md-12">
            <label for="email" class="form-label">Email :</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="votre email" required>
        </div>
        <div class="col-md-12">
            <label for="pseudo" class="form-label">pseudo :</label>
            <input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="votre pseudo" required>
        </div>
        <div class="col-md-6">
            <label for="mdp" class="form-label">Mot de passe :</label>
            <input type="password" class="form-control" id="mdp" name="mdp" placeholder="votre mot de passe" required>
        </div>
        <div class="col-md-6">
            <label for="confirmeMdp" class="form-label">Confirmer mot de passe :</label>
            <input type="password" class="form-control" id="confirmeMdp" name="confirmeMdp" placeholder="confirmer votre mot de passe" required>
        </div>
        <div class="col-6">
            <label for="nom" class="form-label">Nom :</label>
            <input type="text" class="form-control" id="nom" placeholder="votre nom" name="nom" required>
        </div>
        <div class="col-6">
            <label for="prenom" class="form-label">Prenom :</label>
            <input type="text" class="form-control" id="prenom" placeholder="votre prenom" name="prenom" required>
        </div>
        <div class="col-md-6">
            <label for="inputState" class="form-label">sexe</label>
            <select id="inputState" class="form-select" name="sexe" id="sexe" required>
                <option value="" selected disabled>faite votre choix :</option>
                <option value="m">Homme</option>
                <option value="f">Femme</option>
            </select>
        </div>
        <div class="col-12">
            <label for="adresse" class="form-label">Adresse :</label>
            <input type="text" class="form-control" id="adresse" placeholder="votre adresse" name="adresse" required>
        </div>
        <div class="col-md-6">
            <label for="ville" class="form-label">Ville :</label>
            <input type="text" class="form-control" id="ville" name="ville" placeholder="votre ville" required>
        </div>
        <div class="col-md-6">
            <label for="cp" class="form-label">Code postal :</label>
            <input type="text" class="form-control" id="cp" name="cp" required>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Valider</button>
        </div>
    </form>
</main>

<?php require_once "../inc/footer.inc.php" ?>