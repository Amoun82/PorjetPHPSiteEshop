<?php
require_once "./inc/init.inc.php";
require_once "./inc/function.inc.php";


$requete = $pdo->query("SELECT * from article");

$listeArticle = $requete->fetchAll(PDO::FETCH_ASSOC);
require_once "./inc/header.inc.php";
require_once "./inc/nav.inc.php";
?>


<main class="container">
    <h1>page d'accueil</h1>

    <div class="row">




        <?php

        echo "la liste du tableau";
        var_dump($listeArticle);

        foreach ($listeArticle as $key => $value) {

            // $date = date('d-m-Y', strtotime($value['date_enregistrement']));

            // var_dump($value);
            // echo URL."assets/img/".$value['photo'] ;
        ?>
            <div class="col-md-3 me-3 mb-4">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="<?= URL . "assets/img_produits/" . $value['photo'] ?>" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><?= $value['titre'] ?></h5>
                        <p class="card-text overflow-y-auto"><?= $value['description'] ?></p>
                        <div class="row">
                            <div class="col-6">
                                <p>Prix : <?= $value['prix'] ?></p>
                            </div>
                            <div class="col-6">
                                <p>Stock : <?= $value['stock'] ?></p>
                            </div>
                        </div>
                        <a href="#" class="btn btn-primary">Détail du produits</a>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>



    </div>
</main>

<?php require_once "./inc/footer.inc.php" ?>