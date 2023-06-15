<?php
require_once "./inc/init.inc.php";
require_once "./inc/header.inc.php";
require_once "./inc/nav.inc.php";


$requete = $pdo->query("SELECT * from article");

$listeArticle = $requete->fetchAll(PDO::FETCH_ASSOC);

?>


<main>
    page d'accueil

    <?php

    echo "la liste du tableau";
    var_dump($listeArticle);

    foreach ($listeArticle as $key => $value) {

        // $date = date('d-m-Y', strtotime($value['date_enregistrement']));

        var_dump($value);
        echo URL."assets/img/".$value['photo'] ;
    ?>
        <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="<?= URL."assets/img_produits/".$value['photo'] ?>" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
    <?php
    }
    ?>
</main>

<?php require_once "./inc/footer.inc.php" ?>