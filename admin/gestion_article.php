<?php
require_once "../inc/init.inc.php";
require_once "../inc/header.inc.php";
require_once "../inc/nav.inc.php";




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
            <label for="titre" class="form-label">Titre :</label>
            <input type="text" class="form-control" id="titre" name="titre">
        </div>

        <div class="col-md-6">
            <label for="categorie" class="form-label">categorie :</label>
            <select class="form-select" aria-label="Default select example" name="categorie" id="categorie">
                <option selected disabled>Selectionnez la catégorie</option>
                <option value="pull">Pull</option>
                <option value="chemise">Chemise</option>
                <option value="chaussette">Chaussette</option>
                <option value="jupe">Jupe</option>
            </select>
        </div>
        <div class="col-md-6">
            <label for="couleur" class="form-label">Couleur :</label>
            <select class="form-select" aria-label="Default select example" name="couleur" id="couleur">
                <option selected disabled>Selectionnez la couleur</option>
                <option value="noir">Noir</option>
                <option value="rouge">Rouge</option>
                <option value="bleu">Bleu</option>
                <option value="blanc">Blanc</option>
            </select>
        </div>
        <div class="col-md-6">
            <label for="taille" class="form-label">Taille :</label>
            <select class="form-select" aria-label="Default select example" name="taille" id="taille">
                <option selected disabled>Selectionnez la taille</option>
                <option value="XS">XS</option>
                <option value="S">S</option>
                <option value="M">M</option>
                <option value="L">L</option>
                <option value="XL">XL</option>
            </select>
        </div>

        <div class="col-md-6">
            <label for="sexe" class="form-label">Sexe :</label>
            <select class="form-select" name="sexe" id="sexe" required>
                <option value="" selected disabled>faite votre choix :</option>
                <option value="m">Homme</option>
                <option value="f">Femme</option>
            </select>
        </div>

        <div class="col-md-4">
            <label for="prix" class="form-label">Prix :</label>
            <input type="text" class="form-control" id="prix" name="prix">
        </div>

        <div class="col-md-4">
            <label for="stock" class="form-label">Stock :</label>
            <input type="text" class="form-control" id="stock" name="stock">
        </div>
        <div class="col-md-4">
            <label for="photo" class="form-label">Photo :</label>
            <input class="form-control" type="file" name="photo" id="photo" accept="image/png, image/jpeg">
        </div>

        <div class="col-md-12">
            <label for="description">Description :</label>
            <textarea class="form-control" placeholder="Mettez votre description" id="description" name="description" rows="5"></textarea>
        </div>
        <div class="col-6">
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </div>
    </form>
</main>

<?php require_once "../inc/footer.inc.php" ?>