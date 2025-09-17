<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails</title>

    <!-- Lien vers Bootstrap -->
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css" />

    <!-- Lien vers les icônes Bootstrap -->
    <link rel="stylesheet" href="../node_modules/bootstrap-icons/font/bootstrap-icons.min.css">

    <!-- Lien vers le fichier pour designer le site web -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="d-flex flex-column vh-100">
    <header class="border text-center p-3">
        <div class="d-flex justify-content-center align-items-center">
            <a href="index.php?url=home"><img src="assets/img/Logo_Site_2.png" alt="assets/img/Logo_Site_2.png"></a>
        </div>
        <div class="d-flex justify-content-center align-items-center">
            <a class="d-flex justify-content-center align-items-center liens-design" href="index.php?url=register">Créer
                un compte</a>
        </div>
        <?php if (isset($_SESSION["user"])) { ?>
            <div class="d-flex justify-content-center align-items-center">
                <a class="d-flex justify-content-center align-items-center liens-design" href="index.php?url=logout">Se
                    déconnecter</a>
            </div>
        <?php } else { ?>
            <div class="d-flex justify-content-center align-items-center">
                <a class="d-flex justify-content-center align-items-center liens-design" href="index.php?url=login">Se
                    connecter</a>
            </div>
        <?php } ?>
        <div class="d-flex justify-content-center align-items-center">
            <a class="d-flex justify-content-center align-items-center liens-design" href="index.php?url=annonces">Voir
                les annonces disponibles</a>
        </div>
        <div class="d-flex justify-content-center align-items-center">
            <a class="d-flex justify-content-center align-items-center liens-design" href="index.php?url=create">Créer
                une annonce</a>
        </div>
        <?php if (isset($_SESSION["user"])) { ?>
            <div class="d-flex justify-content-center align-items-center">
                <a class="d-flex justify-content-center align-items-center liens-design" href="index.php?url=profil">Voir le
                    profil de <?= $_SESSION["user"]["pseudo"] ?></a>
            </div>
        <?php } ?>
    </header>

    <main>
        <h1 class="d-flex justify-content-center mt-3">Détails de l'article</h1>
        <div class="d-flex justify-content-center">
            <?php foreach ($data as $annonce) { ?>
                <div class="div-article-details m-3 p-3">
                    <div class="d-flex justify-content-center">
                        <img src="/uploads/<?= $annonce["a_picture"] ?>"
                            alt="../../public/uploads/<?= $annonce["a_picture"] ?>">
                    </div>
                    <p class="mt-2"><b>Nom : </b><br><?= $annonce["a_title"] ?></p>
                    <p class="mt-2"><b>Description : </b><br><?= $annonce["a_description"] ?></p>
                    <p class="mt-2"><b>Prix : </b><br><?= $annonce["a_price"] ?> €</p>
                    <p class="mt-2"><b>Publiée le : </b><br><?= $annonce["a_publication"] ?></p>
                    <div class="d-flex justify-content-center">
                        <form action="index.php?url=annonces" method="POST">
                            <button class="btn-retour p-3 rounded-3">Retour</button>
                        </form>
                    </div>
                </div>
            <?php } ?>
        </div>
    </main>

    <footer class="mt-auto text-center p-5 mt-3">
        <p>Afpa - 2025 - MVC</p>
    </footer>
</body>

</html>