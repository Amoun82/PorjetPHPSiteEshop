<?php
require_once "function.inc.php";
?>


<body>

    <div class="containeur_fluide">
        <header>
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Site commerce</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="<?= $_COOKIE['URL'] ?>_index.php">Accueil</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">produits</a>
                            </li>
                            <?php if (isConnect()) : ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= $_COOKIE['URL'] ?>form/form.connexion.php">connexion</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= $_COOKIE['URL'] ?>form/form.inscription.php">Inscription</a>
                                </li>
                            <?php endif; ?>
                            <?php if (!isConnect()) : ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= $_COOKIE['URL'] ?>pageProfil.php">Page Profil</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= $_COOKIE['URL'] ?>deconnexion.php">déconnexion</a>
                                </li>
                            <?php endif; ?>
                        </ul>
                        <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </div>
                </div>
            </nav>
        </header>