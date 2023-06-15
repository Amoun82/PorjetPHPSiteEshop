<?php
require_once "../inc/init.inc.php";
require_once "../inc/header.inc.php";
require_once "../inc/nav.inc.php";

if (!isAdmin()) {
    header('location:../_index.php');
    exit();
}

/* ############# la partie ajoute d'un article ############# */
$erreur = false;
$isGet = false;

// echo "je suis dans la page gestion article" ;

//var_dump(isset($_GET['id']));

if (!isset($_GET['id'])) {

    // echo "je suis sans le get" ;
    // var_dump(isset($_GET));
    // echo "voir le post";
    // var_dump($_POST);
    if (isset($_FILES['photo'], $_POST['reference'], $_POST['titre'], $_POST['categorie'], $_POST['couleur'], $_POST['taille'], $_POST['sexe'], $_POST['prix'], $_POST['stock'], $_POST['description'])) {

        // echo "je passe dans l'isset";
        $reference = trim($_POST['reference']);
        $titre = trim($_POST['titre']);
        $categorie =  $_POST['categorie'];
        $couleur =  $_POST['couleur'];
        $taille = $_POST['taille'];
        $sexe = $_POST['sexe'];
        $prix = trim($_POST['prix']);
        $stock = trim($_POST['stock']);
        $description = trim($_POST['description']);

        if (empty($reference) || empty($titre) || empty($categorie) || empty($couleur) || empty($taille) || empty($sexe) || empty($prix) || empty($stock) || empty($description)) {
            $messageErreur .= '<div class="alert alert-danger" role="alert">
            Attention, un des champs sont vides</div>';
            $erreur = true;
        } else {


            $verifReference = preg_match('#^[0-9]{4,10}$#', $reference);
            $verifPrix = preg_match('#^[0-9]{1,}$#', $prix);
            $verifStock = preg_match('#^[0-9]{1,}$#', $stock);

            //$verifTitre = preg_match('#^[a-zA-Z0-9._-]+ $#', $titre);
            //$verifDescription = preg_match('#^[a-zA-Z0-9._-]+$#', $description);

            // recuperer la liste des refrence
            $reponse = $pdo->query("SELECT reference from article");

            // echo "<pre>";
            // print_r($reponse);
            // echo "</pre>";

            $referenceBDD = $reponse->fetchAll(PDO::FETCH_ASSOC);
            // var_dump($pseudoBDD);

            // compare la reference envoyer par l'admin par rapport au refrence contenu dans la base
            foreach ($referenceBDD as $key => $value) {

                if (strcmp($value['reference'], $reference) == 0) {
                    $erreur = true;
                    $messageErreur .= '<div class="alert alert-danger" role="alert">
            reference deja utlisé.</div>';
                }
            }

            if ($verifReference == false) {
                $erreur = true;
                $messageErreur .= '<div class="alert alert-danger" role="alert">
            Attention, la reference ne peut contenir que des chiffres.</div>';
            }
            if ($verifPrix == false) {
                $erreur = true;
                $messageErreur .= '<div class="alert alert-danger" role="alert">
            Attention, le prix ne peut contenir que des chiffres.</div>';
            }
            if ($verifStock == false) {
                $erreur = true;
                $messageErreur .= '<div class="alert alert-danger" role="alert">
            Attention, le stock ne peut contenir que des chiffres.</div>';
            }


            // if ($verifTitre == false) {
            //     $erreur = true;
            //     $messageErreur .= '<div class="alert alert-danger" role="alert">
            //     Attention, le titre ne peut pas contenir autre chose que des minuscules, majuscules, point, tiret, underscore.</div>';
            // }
            // if ($verifDescription == false) {
            //     $erreur = true;
            //     $messageErreur .= '<div class="alert alert-danger" role="alert">
            //     Attention, la description ne peut pas contenir autre chose que des minuscules, majuscules, point, tiret, underscore.</div>';
            // }
        }


        // verifie la longueur de la reference
        if (iconv_strlen($reference) > 10) {
            $messageErreur .= '<div class="alert alert-danger" role="alert">
        Attention la reference est trop long</div>';
            $erreur = true;
        }

        // verifie la longueur de la reference
        if (iconv_strlen($reference) < 4) {
            $messageErreur .= '<div class="alert alert-danger" role="alert">
        Attention la reference est trop court</div>';
            $erreur = true;
        }


        // verifie la longueur de la reference
        if (iconv_strlen($titre) > 50) {
            $messageErreur .= '<div class="alert alert-danger" role="alert">
        Attention le titre est trop long</div>';
            $erreur = true;
        }

        // verifie la longueur de la reference
        if (iconv_strlen($titre) < 4) {
            $messageErreur .= '<div class="alert alert-danger" role="alert">
        Attention le titre est trop court</div>';
            $erreur = true;
        }


        if ($erreur == false) {

            echo "voir la piece jointe";
            var_dump($_FILES['photo']);

            if (empty($_FILES['photo']['name'])) {
                echo "attention la piece jointe est vide";
            } else {
                var_dump($_FILES['photo']);
                $file_nom = $_FILES['photo']['name'];
                $file_taille = $_FILES['photo']['size'];
                $file_tmp = $_FILES['photo']['tmp_name'];
                $file_type = $_FILES['photo']['type'];

                //$file_ext = strtolower(end(explode('.', $file_nom)));

                $file_ext = (explode('.', $_FILES['photo']['name']));
                $file_ext = strtolower(end($file_ext));

                //controle du file_nom

                var_dump($file_ext);
                $extensions = array("jpeg", "jpg", "png");

                //$extension = substr(strrchr($photo, '.'), 1);

                if (in_array($file_ext, $extensions) === false) {
                    $erreur = true;
                    $messageErreur .= '<div class="alert alert-danger" role="alert">
            Attention, extension non acceptée, choisir entre JPEG ou PNG.</div>';
                }

                if ($file_taille > 20971520) {
                    $erreur = true;
                    $messageErreur .= '<div class="alert alert-danger" role="alert">
            Attention, taille maximum 20 MB.</div>';
                }

                if ($erreur == false) {
                    move_uploaded_file($file_tmp, "../assets/img_produits/" . $reference . "_" . $file_nom);
                    echo "Success";
                } else {
                    print_r($errors);
                }

                // preparer ma requete demain
                /* INSERT INTO `article`(`id_article`, `reference`, `categorie`, `titre`, `description`, `couleur`, `taille`, `sexe`, `photo`, `prix`, `stock`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','[value-6]','[value-7]','[value-8]','[value-9]','[value-10]','[value-11]') */
                $requete = $pdo->prepare("INSERT INTO article(reference, categorie, titre, description, couleur, taille, sexe, photo, prix, stock) VALUES (:reference, :categorie, :titre, :description, :couleur, :taille, :sexe, :photo, :prix, :stock)");

                $file_nom = $reference . "_" . $file_nom;
                $requete->bindParam(':reference', $reference, PDO::PARAM_INT);
                $requete->bindParam(':categorie', $categorie, PDO::PARAM_STR);
                $requete->bindParam(':titre', $titre, PDO::PARAM_STR);
                $requete->bindParam(':description', $description, PDO::PARAM_STR);
                $requete->bindParam(':couleur', $couleur, PDO::PARAM_STR);
                $requete->bindParam(':taille', $taille, PDO::PARAM_STR);
                $requete->bindParam(':sexe', $sexe, PDO::PARAM_STR);
                $requete->bindParam(':photo', $file_nom, PDO::PARAM_STR);
                $requete->bindParam(':prix', $prix, PDO::PARAM_INT);
                $requete->bindParam(':stock', $stock, PDO::PARAM_STR);
                $requete->execute();

                // $arr = $requete->errorInfo();
                // print_r($arr);

                $messageErreur = '<div class="alert alert-success" role="alert">
    vous avez enregistrer un produit</div>';
                //header('location:form.connexion.php');
            }
        }
    }
} else {
    /* ############# Modification PRODUIT ############# */
    echo "je suis avec le get";
    $isGet = true;
    var_dump($_GET);
    $id = $_GET['id'];

    $requete = $pdo->query("SELECT * from article where id_article = $id");

    $article = $requete->fetch(PDO::FETCH_ASSOC);

    var_dump($article);

    var_dump($article['photo']);

    $file = SERVEUR_ROOT . "\PHPprojetDoranco\assets\img_produits\\" . $article['photo'];

    var_dump($file);

    //$photo = preg_replace('/[^A-Za-z0-9.\-]/', '', $photo);

    echo "<img src='{$file}'>";
    $isFile = file_exists($file);
    var_dump($isFile);

    if (isset($_FILES['photo'], $_POST['titre'], $_POST['categorie'], $_POST['couleur'], $_POST['taille'], $_POST['sexe'], $_POST['prix'], $_POST['stock'], $_POST['description'])) {

        // echo "je passe dans l'isset";
        $titre = trim($_POST['titre']);
        $categorie =  $_POST['categorie'];
        $couleur =  $_POST['couleur'];
        $taille = $_POST['taille'];
        $sexe = $_POST['sexe'];
        $prix = trim($_POST['prix']);
        $stock = trim($_POST['stock']);
        $description = trim($_POST['description']);

        if (empty($titre) || empty($categorie) || empty($couleur) || empty($taille) || empty($sexe) || empty($prix) || empty($stock) || empty($description)) {
            $messageErreur .= '<div class="alert alert-danger" role="alert">
        Attention, un des champs sont vides</div>';
            $erreur = true;
        } else {

            $verifPrix = preg_match('#^[0-9.]{1,}$#', $prix);
            $verifStock = preg_match('#^[0-9]{1,}$#', $stock);

            if ($verifPrix == false) {
                $erreur = true;
                $messageErreur .= '<div class="alert alert-danger" role="alert">
        Attention, le prix ne peut contenir que des chiffres.</div>';
            }
            if ($verifStock == false) {
                $erreur = true;
                $messageErreur .= '<div class="alert alert-danger" role="alert">
        Attention, le stock ne peut contenir que des chiffres.</div>';
            }
        }


        // verifie la longueur de la reference
        if (iconv_strlen($titre) > 50) {
            $messageErreur .= '<div class="alert alert-danger" role="alert">
    Attention le titre est trop long</div>';
            $erreur = true;
        }

        // verifie la longueur de la reference
        if (iconv_strlen($titre) < 4) {
            $messageErreur .= '<div class="alert alert-danger" role="alert">
    Attention le titre est trop court</div>';
            $erreur = true;
        }

        if ($erreur == false) {

            /*
            UPDATE `article` SET `id_article`='[value-1]',`reference`='[value-2]',`categorie`='[value-3]',`titre`='[value-4]',`description`='[value-5]',`couleur`='[value-6]',`taille`='[value-7]',`sexe`='[value-8]',`photo`='[value-9]',`prix`='[value-10]',`stock`='[value-11]' WHERE 1
            */

            // preparer ma requete demain
            $requete = $pdo->prepare("UPDATE article SET categorie= :categorie, titre= :titre, description= :description, couleur= :couleur, taille= :taille, sexe= :sexe, prix= :prix, stock= :stock WHERE id_article = $id");


            $requete->bindParam(':categorie', $categorie, PDO::PARAM_STR);
            $requete->bindParam(':titre', $titre, PDO::PARAM_STR);
            $requete->bindParam(':description', $description, PDO::PARAM_STR);
            $requete->bindParam(':couleur', $couleur, PDO::PARAM_STR);
            $requete->bindParam(':taille', $taille, PDO::PARAM_STR);
            $requete->bindParam(':sexe', $sexe, PDO::PARAM_STR);
            $requete->bindParam(':prix', $prix, PDO::PARAM_STR);
            $requete->bindParam(':stock', $stock, PDO::PARAM_STR);
            $requete->execute();


            $messageErreur = '<div class="alert alert-success" role="alert">
modification du produit réussis</div>';
            //header('location:form.connexion.php');
        }
    }
}


/* ############# CRUUD PRODUIT ############# */
$requete = $pdo->query("SELECT * from article");

$nbrArticles = $requete->rowCount();

$listeArticles = $requete->fetchAll(PDO::FETCH_ASSOC);

?>

<main class="container">
    <div>
        <?= $messageErreur ?>
    </div>
    <form class="row g-3" method="post" enctype="multipart/form-data">
        <div class="col-md-12">
            <label for="reference" class="form-label">Reference :</label>
            <input type="text" class="form-control" id="reference" name="reference" value="<?= ($isGet == true) ? htmlentities($article['reference']) : "" ?>" <?= ($isGet == true) ? "disabled" : "" ?>>
        </div>
        <div class="col-md-12">
            <label for="titre" class="form-label">Titre :</label>
            <input type="text" class="form-control" id="titre" name="titre" value="<?= ($isGet == true) ? htmlentities($article['titre']) : "" ?>">
        </div>

        <div class="col-md-6">
            <label for="categorie" class="form-label">categorie :</label>
            <select class="form-select" aria-label="Default select example" name="categorie" id="categorie">
                <option <?= ($isGet == false) ? 'selected' : '' ?> disabled>Selectionnez la catégorie</option>
                <option <?= ($isGet == true && $article['categorie'] == 'pull') ? 'selected' : '' ?> value="pull">Pull</option>
                <option <?= ($isGet == true && $article['categorie'] == 'chemise') ? 'selected' : '' ?> value="chemise">Chemise</option>
                <option <?= ($isGet == true && $article['categorie'] == 'chaussette') ? 'selected' : '' ?> value="chaussette">Chaussette</option>
                <option <?= ($isGet == true && $article['categorie'] == 'jupe') ? 'selected' : '' ?> value="jupe">Jupe</option>
            </select>
        </div>
        <div class="col-md-6">
            <label for="couleur" class="form-label">Couleur :</label>
            <select class="form-select" aria-label="Default select example" name="couleur" id="couleur">
                <option <?= ($isGet == false) ? 'selected' : '' ?> disabled>Selectionnez la couleur</option>
                <option <?= ($isGet == true && $article['couleur'] == 'noir') ? 'selected' : '' ?> value="noir">Noir</option>
                <option <?= ($isGet == true && $article['couleur'] == 'rouge') ? 'selected' : '' ?> value="rouge">Rouge</option>
                <option <?= ($isGet == true && $article['couleur'] == 'bleu') ? 'selected' : '' ?> value="bleu">Bleu</option>
                <option <?= ($isGet == true && $article['couleur'] == 'blanc') ? 'selected' : '' ?> value="blanc">Blanc</option>
            </select>
        </div>
        <div class="col-md-6">
            <label for="taille" class="form-label">Taille :</label>
            <select class="form-select" aria-label="Default select example" name="taille" id="taille">
                <option <?= ($isGet == false) ? 'selected' : '' ?> disabled>Selectionnez la taille</option>
                <option <?= ($isGet == true && $article['taille'] == 'XS') ? 'selected' : '' ?> value="XS">XS</option>
                <option <?= ($isGet == true && $article['taille'] == 'S') ? 'selected' : '' ?> value="S">S</option>
                <option <?= ($isGet == true && $article['taille'] == 'M') ? 'selected' : '' ?> value="M">M</option>
                <option <?= ($isGet == true && $article['taille'] == 'L') ? 'selected' : '' ?> value="L">L</option>
                <option <?= ($isGet == true && $article['taille'] == 'XL') ? 'selected' : '' ?> value="XL">XL</option>
            </select>
        </div>

        <div class="col-md-6">
            <label for="sexe" class="form-label">Sexe :</label>
            <select class="form-select" name="sexe" id="sexe">
                <option <?= ($isGet == false) ? 'selected' : '' ?> disabled>faite votre choix :</option>
                <option <?= ($isGet == true && $article['sexe'] == 'm') ? 'selected' : '' ?> value="m">Homme</option>
                <option <?= ($isGet == true && $article['sexe'] == 'f') ? 'selected' : '' ?> value="f">Femme</option>
            </select>
        </div>

        <div class="col-md-4">
            <label for="prix" class="form-label">Prix :</label>
            <input type="text" class="form-control" id="prix" name="prix" value="<?= ($isGet == true) ? htmlentities($article['prix']) : "" ?>">
        </div>

        <div class="col-md-4">
            <label for="stock" class="form-label">Stock :</label>
            <input type="text" class="form-control" id="stock" name="stock" value="<?= ($isGet == true) ? htmlentities($article['stock']) : "" ?>">
        </div>
        <div class="col-md-4">
            <label for="photo" class="form-label">Photo :</label>
            <input class="form-control" type="file" name="photo" id="photo" accept="image/*">
        </div>

        <div class="col-md-12">
            <label for="description">Description :</label>
            <textarea class="form-control" placeholder="Mettez votre description" id="description" name="description" rows="5"><?= ($isGet == true) ? htmlentities($article['description']) : "" ?></textarea>
        </div>
        <div class="col-6">
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </div>
    </form>

    <hr>

    <?php
    // echo "la liste du tableau";
    // var_dump($listeArticles);
    // echo "nombre d'article";
    // var_dump($nbrArticles);
    ?>

    <h2>Listes des Articles</h2>
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <?php
                //var_dump($listeArticles[0]) ;
                foreach ($listeArticles[0] as $key => $value) {
                    //var_dump($key);

                ?>
                    <th scope="col"><?= ($key != 'id_article') ? $key : ""; ?></th>
                <?php
                } ?>
                <th scope="col">modification</th>
                <th scope="col">suppression</th>
            </tr>
        </thead>
        <tbody>
            <?php
            for ($i = 0; $i < $nbrArticles; $i++) :
                //echo $i;

            ?>
                <tr>
                    <th scope="row"><?= $i + 1 ?></th>
                    <td><?= $listeArticles[$i]['reference'] ?></td>
                    <td><?= $listeArticles[$i]['categorie'] ?></td>
                    <td><?= $listeArticles[$i]['titre'] ?></td>
                    <td><?= $listeArticles[$i]['description'] ?></td>
                    <td><?= $listeArticles[$i]['couleur'] ?></td>
                    <td><?= $listeArticles[$i]['taille'] ?></td>
                    <td><?= $listeArticles[$i]['sexe'] ?></td>
                    <td class="text-center">
                        <img style="height : 120px" src="<?= URL . "assets/img_produits/" . $listeArticles[$i]['photo'] ?>" alt="<?= $listeArticles[$i]['photo'] ?>">
                        <?= $listeArticles[$i]['photo'] ?>
                    </td>
                    <td><?= $listeArticles[$i]['prix'] ?></td>
                    <td><?= $listeArticles[$i]['stock'] ?></td>
                    <td><a href="<?= URL . "admin/gestion_article.php?id=" . $listeArticles[$i]['id_article'] ?>">modification</a></td>
                    <td>
                        <a type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $listeArticles[$i]['id_article'] ?>" href="<?= URL . "admin/gestion_article.php?id=" . $listeArticles[$i]['id_article'] ?>">supprimer</a>

                    </td>
                </tr>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal<?= $listeArticles[$i]['id_article'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Suppression Article</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body row">

                                <figure class="col-md-3 me-5 align-self-center">
                                    <img style="height : 160px" src="<?= URL . "assets/img_produits/" . $listeArticles[$i]['photo'] ?>" alt="<?= $listeArticles[$i]['photo'] ?>">
                                    <figcaption><?= $listeArticles[$i]['photo'] ?></figcaption>
                                </figure>
                                <div class="col-md-6">
                                    <?= "Ref : " . $listeArticles[$i]['reference'] . "<br>" ?>
                                    <?= "Categorie : " . $listeArticles[$i]['categorie'] . "<br>" ?>
                                    <?= "Titre : " . $listeArticles[$i]['titre'] . "<br>" ?>
                                    <?= "Description : " . $listeArticles[$i]['description'] . "<br>" ?>
                                    <?= "Couleur : " . $listeArticles[$i]['couleur'] . "<br>" ?>
                                    <?= "Taille : " . $listeArticles[$i]['taille'] . "<br>" ?>
                                    <?= "Sexe : " . $listeArticles[$i]['sexe'] . "<br>" ?>
                                    <?= "Prix : " . $listeArticles[$i]['prix'] . "<br>" ?>
                                    <?= "Stock : " . $listeArticles[$i]['stock'] . "<br>" ?>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                <a type="button" class="btn btn-primary" href="<?= URL . "admin/delete_article.php?id=" . $listeArticles[$i]['id_article'] ?>">Effacer</a>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endfor; ?>
        </tbody>
    </table>



</main>




<?php require_once "../inc/footer.inc.php" ?>