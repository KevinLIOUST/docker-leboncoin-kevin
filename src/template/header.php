<header>
    <nav class="navbar navbar-expand-lg">
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
                        <a class="ms-3 mx-3 fs-5" href="index.php?url=annonces">Voir les annonces
                            disponibles</a>
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