<?php
// var_dump($data);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Annonces</title>

    <!-- Lien vers Bootstrap -->
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css" />

    <!-- Lien vers les icônes Bootstrap -->
    <link rel="stylesheet" href="../node_modules/bootstrap-icons/font/bootstrap-icons.min.css">

    <!-- Lien vers le fichier pour designer le site web -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="d-flex flex-column
<?php if (empty($data)) { ?>
    vh-100
<?php } else { ?>
    vh-auto
<?php } ?>">
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
        <h1 class="d-flex justify-content-center mt-3">Annonces</h1>
        <div class="div-produits">
            <?php foreach ($data as $annonce) { ?>
                <div class="div-article m-3 p-3">
                    <img src="/uploads/<?= $_SESSION["user"]["pseudo"] ?>/<?= $annonce["a_picture"] ?>"
                        alt="../../public/uploads/<?= $_SESSION["user"]["pseudo"] ?>/<?= $annonce["a_picture"] ?>">
                    <p class="mt-2 taille-champ-nom-article"><b>Nom : </b><br><?= $annonce["a_title"] ?></p>
                    <p class="mt-2"><b>Prix : </b><br><?= $annonce["a_price"] ?> €</p>
                    <p class="mt-2"><b>Publiée le : </b><br><?= $annonce["a_publication"] ?></p>
                    <form class="d-flex justify-content-center taille-champ-form-annonces"
                        action="index.php?url=details/<?= $annonce["a_id"] ?>" method="POST">
                        <button class="d-flex align-items-center btn-voir-details p-3 mb-3 rounded-3" type="submit"
                            name="id" id="id">Voir les détails</button>
                    </form>
                </div>
            <?php } ?>
        </div>
    </main>

    <footer class="mt-auto text-center p-5 mt-3">
        <p>Afpa - 2025 - MVC</p>
    </footer>
</body>

</html>