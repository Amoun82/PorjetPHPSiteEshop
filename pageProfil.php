<?php
require_once "./inc/init.inc.php";
require_once "./inc/function.inc.php";


if (isConnect()) {
    header('location:./_index.php');
    exit();
}
// var_dump($_SESSION);
require_once "./inc/header.inc.php";
require_once "./inc/nav.inc.php";
?>


<main class="container">
    <div class="row g-3 mb-5">
        <div class="col-md-6">
            <div>
                <label for="Pseudo" class="form-label">Pseudo :</label>
                <input type="text" class="form-control" aria-label="First name" value="<?= $_SESSION['menbre']['pseudo'] ?>" name="Pseudo" id="Pseudo">
            </div>
            <div>
                <label for="email" class="form-label">Email :</label>
                <input type="text" class="form-control" aria-label="Last name" value="<?= $_SESSION['menbre']['email'] ?>" name="email" id="email">
            </div>
            <div>
                <label for="nom" class="form-label">Nom :</label>
                <input type="text" class="form-control" aria-label="Last name" value="<?= $_SESSION['menbre']['nom'] ?>" name="nom" id="nom">
            </div>
            <div>
                <label for="prenom" class="form-label">Prenom :</label>
                <input type="text" class="form-control" aria-label="Last name" value="<?= $_SESSION['menbre']['prenom'] ?>" name="Prenom" id="Prenom">
            </div>
            <div>
                <label for="sexe" class="form-label">Sexe :</label>
                <input type="text" class="form-control" aria-label="Last name" value="<?php echo ($_SESSION['menbre']['sexe'] == 'm') ? "Homme" : "femme"; ?>" name="sexe" id="sexe">
            </div>
            <div>
                <label for="adresse" class="form-label">Adresse :</label>
                <input type="text" class="form-control" aria-label="Last name" value="<?= $_SESSION['menbre']['adresse'] ?>" name="adresse" id="adresse">
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="ville" class="form-label">Ville :</label>
                    <input type="text" class="form-control" aria-label="Last name" value="<?= $_SESSION['menbre']['ville'] ?>" name="ville" id="ville">
                </div>
                <div class="col-md-6">
                    <label for="cp" class="form-label">CP :</label>
                    <input type="text" class="form-control" aria-label="Last name" value="<?= $_SESSION['menbre']['cp'] ?>" name="cp" id="cp">
                </div>
            </div>


        </div>
        <div class="col-md-6">
        </div>
    </div>

</main>

<?php require_once "./inc/footer.inc.php" ?>