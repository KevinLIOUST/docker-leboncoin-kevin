<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>C'est comme Leboncoin</title>

    <!-- Lien vers Bootstrap -->
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css" />

    <!-- Lien vers les icônes Bootstrap -->
    <link rel="stylesheet" href="../node_modules/bootstrap-icons/font/bootstrap-icons.min.css">

    <!-- Lien vers le fichier pour designer le site web -->
    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body class="d-flex flex-column vh-100">

    <!-- Test Navbar -->
    <!-- <nav id="nav" class="active">
        <a href="index.php?url=home"><img src="assets/img/Logo_Site_2.png" alt="assets/img/Logo_Site_2.png"></a>
        <ul>
            <li>
                <a class="ms-3 mx-3 fs-5" href="index.php?url=register">Créer un compte</a>
            </li>
            <li>
                <?php if (isset($_SESSION["user"])) { ?>
                    <a class="ms-3 mx-3 fs-5" href="index.php?url=logout">Se déconnecter</a>
                <?php } else { ?>
                    <a class="ms-3 mx-3 fs-5" href="index.php?url=login">Se connecter</a>
                <?php } ?>
            </li>
            <li>
                <a class="ms-3 mx-3 fs-5" href="index.php?url=annonces">Voir les annonces disponibles</a>
            </li>
            <?php if (isset($_SESSION["user"])) { ?>
                <li>
                    <a class="ms-3 mx-3 fs-5" href="index.php?url=create">Créer une annonce</a>
                </li>
            <?php } ?>
            <?php if (isset($_SESSION["user"])) { ?>
                <li>
                    <a class="ms-3 mx-3 fs-5" href="index.php?url=profil">Voir le
                        profil de <?= $_SESSION["user"]["pseudo"] ?></a>
                </li>
            <?php } ?>
        </ul>
        <div id="icons"></div>
    </nav> -->

    <header>
        <nav class="navbar navbar-expand-lg active">
            <div class="container-fluid">
                <button class="navbar-toggler couleur-burger-menu" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="index.php?url=home"><img src="assets/img/Logo_Site_2.png"
                        alt="assets/img/Logo_Site_2.png"></a>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="ms-3 mx-3 fs-5" href="index.php?url=register">Créer un compte</a>
                        </li>
                        <li class="nav-item">
                            <?php if (isset($_SESSION["user"])) { ?>
                                <a class="ms-3 mx-3 fs-5" href="index.php?url=logout">Se déconnecter</a>
                            <?php } else { ?>
                                <a class="ms-3 mx-3 fs-5" href="index.php?url=login">Se connecter</a>
                            <?php } ?>
                        </li>
                        <li class="nav-item">
                            <a class="ms-3 mx-3 fs-5" href="index.php?url=annonces">Voir les annonces disponibles</a>
                        </li>
                        <?php if (isset($_SESSION["user"])) { ?>
                            <li class="nav-item">
                                <a class="ms-3 mx-3 fs-5" href="index.php?url=create">Créer une annonce</a>
                            </li>
                        <?php } ?>
                        <?php if (isset($_SESSION["user"])) { ?>
                            <li class="nav-item">
                                <a class="ms-3 mx-3 fs-5" href="index.php?url=profil">Voir le
                                    profil de <?= $_SESSION["user"]["pseudo"] ?></a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <h1 class="text-center mt-3">Bienvenue au magasin de composants PC spécial geek !</h1>
        <h2 class="text-center mt-5">Ici, vous trouverez plein de composants pour PC, mais designer de façon geek comme
            par exemple une carte graphique NVIDIA GeForce RTX 5090 ASUS ROG ASTRAL PixelCore Galaxy Edition !</h2>
        <h2 class="text-center mt-5">Amusez-vous bien, mais faites gaffe à votre thune !</h2>
    </main>

    <footer class="mt-auto text-center p-5 mt-3">
        <p>Afpa - 2025 - MVC</p>
    </footer>

    <script src="../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>

    <script src="assets/js/script.js"></script>
</body>

</html>