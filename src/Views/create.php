<?php
// var_dump($_POST);
// var_dump($_FILES);
if (!isset($_SESSION["user"])) {
    header("Location: index.php?url=login");
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer une annonce</title>

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
        <h1 class="text-center mt-3 mb-3">Créer une annonce</h1>
        <div class="d-flex justify-content-center align-items-center">
            <form action="" method="POST">
                <div class="d-flex justify-content-center mb-3">
                    <div>
                        <div>
                            <label class="text-left" for="titre">Titre <span class="text-danger">*</span>
                                <?php if (isset($errors['titre'])) { ?>
                                    <span class="text-danger"><?= $errors['titre'] ?></span>
                                <?php } else { ?>
                                    <?php if (isset($reussi["titre"])) { ?>
                                        <span class="text-success"><?= $reussi['titre'] ?></span>
                                    <?php } ?>
                                <?php } ?></label>
                        </div>
                        <div class="text-center">
                            <input class="mt-1 taille-input design-input" id="titre" type="text" name="titre"
                                placeholder="titre de l'annonce" value="<?= $_POST['titre'] ?? '' ?>">
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <div>
                        <div>
                            <label class="text-left" for="description">Description <span class="text-danger">*</span>
                                <?php if (isset($errors['description'])) { ?>
                                    <span class="text-danger"><?= $errors['description'] ?></span>
                                <?php } else { ?>
                                    <?php if (isset($reussi["description"])) { ?>
                                        <span class="text-success"><?= $reussi['description'] ?></span>
                                    <?php } ?>
                                <?php } ?></label>
                        </div>
                        <div class="text-center">
                            <input class="mt-1 taille-input design-input" id="description" type="text"
                                name="description" placeholder="description de l'annonce"
                                value="<?= $_POST['description'] ?? '' ?>">
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <div>
                        <div>
                            <label class="mt-3 text-left" for="prix">Prix <span class="text-danger">*</span>
                                <?php if (isset($errors['prix'])) { ?>
                                    <span class="text-danger"><?= $errors['prix'] ?></span>
                                <?php } else { ?>
                                    <?php if (isset($reussi["prix"])) { ?>
                                        <span class="text-success"><?= $reussi['prix'] ?></span>
                                    <?php } ?>
                                <?php } ?></label>
                        </div>
                        <div class="text-center">
                            <input class="mt-1 taille-input design-input" id="prix" type="number" name="prix"
                                placeholder="Prix de l'article" value="<?= $_POST['prix'] ?? '' ?>">
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <div>
                        <div>
                            <label class="mt-3 text-left" for="file">file <span class="text-danger">*</span>
                                <?php if (isset($errors['file'])) { ?>
                                    <span class="text-danger"><?= $errors['file'] ?></span>
                                <?php } else { ?>
                                    <?php if (isset($reussi["file"])) { ?>
                                        <span class="text-success"><?= $reussi['file'] ?></span>
                                    <?php } ?>
                                <?php } ?></label>
                        </div>
                        <div class="text-center">
                            <input class="mt-1 taille-input design-input" id="file" type="file" name="file"
                                enctype="multipart/form-data">
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    <input type="submit" class="btn btn-connexion" value="Créer une annonce">
                </div>
                <div class="d-flex justify-content-center mt-4">
                    <?php if (isset($reussi["createAnnonce"])) { ?>
                        <p class="text-success"><b><?= $reussi["createAnnonce"] ?></b></p>
                    <?php } ?>
                </div>
            </form>
        </div>
    </main>

    <footer class="mt-auto text-center p-5 mt-3">
        <p>Afpa - 2025 - MVC</p>
    </footer>
</body>

</html>