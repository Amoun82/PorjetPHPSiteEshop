<?php
require_once "../inc/init.inc.php";
require_once "../inc/header.inc.php";
require_once "../inc/nav.inc.php";



// couleur
// taille
// sexe
// photo
// prix
// stock

var_dump($_POST);
?>

<main class="container">
    <form class="row g-3" method="post" id="article">
        <div class="col-md-12">
            <label for="reference" class="form-label">Reference :</label>
            <input type="text" class="form-control" id="reference" name="reference">
        </div>

        <div class="col-md-12">
            <label for="categorie" class="form-label">categorie :</label>
            <select class="form-select" aria-label="Default select example" name="categorie" id="categorie">
                <option selected disabled>Open this select menu</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
        </div>
        <div class="col-md-12">
            <label for="couleur" class="form-label">Couleur :</label>
            <select class="form-select" aria-label="Default select example" name="couleur" id="couleur">
                <option selected disabled>Open this select menu</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
        </div>
        <div class="col-md-12">
            <label for="titre" class="form-label">Titre :</label>
            <input type="text" class="form-control" id="titre" name="titre">
        </div>


        <div class="col-md-12">
            <label for="description">Description :</label>
            <textarea class="form-control" placeholder="Leave a comment here" id="description" name="description" rows="5"></textarea>
        </div>
        <div class="col-6">
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </div>
    </form>
</main>

<?php require_once "../inc/footer.inc.php" ?>