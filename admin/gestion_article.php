<?php
require_once "../inc/init.inc.php";
require_once "../inc/header.inc.php";
require_once "../inc/nav.inc.php";




// photo
// prix
// stock

$reference = 45654654654 ;

var_dump($_POST);
if (isset($_FILES['photo'])) {

    var_dump($_FILES['photo']) ;
    $errors = array();
    $file_nom = $_FILES['photo']['name'];
    $file_taille = $_FILES['photo']['size'];
    $file_tmp = $_FILES['photo']['tmp_name'];
    $file_type = $_FILES['photo']['type'];

    //$file_ext = strtolower(end(explode('.', $file_nom)));
    
    $file_ext = (explode('.', $_FILES['photo']['name']));
    $file_ext = strtolower(end($file_ext)) ;

    //controle du file_nom
    
    var_dump($file_ext) ;
    $extensions = array("jpeg", "jpg", "png");

    //$extension = substr(strrchr($photo, '.'), 1);

    if (in_array($file_ext, $extensions) === false) {
        $errors[] = "extension non acceptée, choisir entre JPEG ou PNG.";
    }

    if ($file_taille > 2097152) {
        $errors[] = 'File size must be excately 2 MB';
    }

    if (empty($errors) == true) {
        move_uploaded_file($file_tmp, "../assets/img_produits/".$reference."_".$file_nom);
        echo "Success";
    } else {
        print_r($errors);
    }
}
?>

<main class="container">
    <form class="row g-3" method="post" enctype="multipart/form-data">
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
            <select class="form-select" name="sexe" id="sexe">
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
            <input class="form-control" type="file" name="photo" id="photo" accept="image/*">
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