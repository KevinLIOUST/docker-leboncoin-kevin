<?php
// var_dump($_POST);
// var_dump($_FILES);
// var_dump($_SESSION);
var_dump($infosAnnonce);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une annonce</title>

    <!-- Lien vers Bootstrap -->
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css" />

    <!-- Lien vers les icônes Bootstrap -->
    <link rel="stylesheet" href="../node_modules/bootstrap-icons/font/bootstrap-icons.min.css">

    <!-- Lien vers le fichier pour designer le site web -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="d-flex flex-column vh-100">
    <?php include_once __DIR__ . "/../Template/header.php"; ?>

    <main>
        <h1 class="text-center mt-3 mb-3">Modifier une annonce</h1>
        <div class="d-flex justify-content-center align-items-center">
            <form action="index.php?url=modifierAnnonce/<?= $infosAnnonce[0]["a_id"] ?>" method="POST"
                enctype="multipart/form-data">
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
                            <input class="mt-1 taille-input-create-annonce design-input-create-annonce" id="titre"
                                type="text" name="titre" placeholder="titre de l'annonce"
                                value="<?= $_SERVER['REQUEST_METHOD'] == 'POST' ? $_POST["titre"] : $infosAnnonce[0]["a_title"] ?>">
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
                            <textarea class="taille-input-create-annonce design-input-create-annonce-description"
                                name="description" id="description"
                                placeholder="description de l'annonce"><?= $_SERVER['REQUEST_METHOD'] == 'POST' ? $_POST["description"] : $infosAnnonce[0]["a_description"] ?></textarea>
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
                            <input class="mt-1 taille-input-create-annonce design-input-create-annonce" id="prix"
                                type="number" name="prix" placeholder="Prix de l'article"
                                value="<?= $_SERVER['REQUEST_METHOD'] == 'POST' ? $_POST["prix"] : $infosAnnonce[0]["a_price"] ?>">
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <div>
                        <div>
                            <label class="mt-3 text-left" for="file">Fichier<span class="text-danger">*</span>
                                <?php if (isset($errors['file'])) { ?>
                                    <span class="text-danger"><?= $errors['file'] ?></span>
                                <?php } else { ?>
                                    <?php if (isset($reussi["file"])) { ?>
                                        <span class="text-success"><?= $reussi['file'] ?></span>
                                    <?php } ?>
                                <?php } ?></label>
                        </div>
                        <div class="text-center">
                            <input class="mt-1 taille-input-create-annonce design-input-create-annonce" id="file"
                                type="file" name="file">
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    <input type="submit" class="btn btn-connexion" value="Modifier l'annonce">
                </div>
                <div class="d-flex justify-content-center mt-4">
                    <?php if (isset($reussi["modifieAnnonce"])) { ?>
                        <p class="text-success"><b><?= $reussi["modifieAnnonce"] ?></b></p>
                    <?php } ?>
                </div>
            </form>
        </div>
    </main>

    <?php include_once __DIR__ . "/../Template/footer.php"; ?>

    <script src="../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>