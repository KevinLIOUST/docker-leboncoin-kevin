<?php
// var_dump($_POST);
// var_dump($_FILES);
// var_dump($_SESSION);
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

<body class="d-flex flex-column vh-100 bg-dark text-white">
    <?php include_once __DIR__ . "/../Template/header.php"; ?>

    <main>
        <h1 class="text-center mt-3 mb-3">Créer une annonce</h1>
        <div class="d-flex justify-content-center align-items-center">
            <form class="w-75" action="" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="titre" class="form-label">Titre <span class="text-danger">*</span>
                        <?php if (isset($errors['titre'])) { ?>
                            <span class="text-danger"><?= $errors['titre'] ?></span>
                        <?php } else { ?>
                            <?php if (isset($reussi["titre"])) { ?>
                                <span class="text-success"><?= $reussi['titre'] ?></span>
                            <?php } ?>
                        <?php } ?></label>
                    <div class="div-input p-2">
                        <input class="form-control" id="titre" type="text" name="titre" placeholder="Titre de l'annonce"
                            value="<?= $_POST['titre'] ?? '' ?>">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description <span class="text-danger">*</span>
                        <?php if (isset($errors['description'])) { ?>
                            <span class="text-danger"><?= $errors['description'] ?></span>
                        <?php } else { ?>
                            <?php if (isset($reussi["description"])) { ?>
                                <span class="text-success"><?= $reussi['description'] ?></span>
                            <?php } ?>
                        <?php } ?></label>
                    <div class="text-center">
                        <div class="div-input p-2">
                            <textarea class="form-control" name="description" id="description" rows="10"
                                placeholder="description de l'annonce"><?= $_POST['description'] ?? "" ?></textarea>
                        </div>
                    </div>
                </div>
                <div>
                    <label class="mt-3 text-left" for="prix">Prix <span class="text-danger">*</span>
                        <?php if (isset($errors['prix'])) { ?>
                            <span class="text-danger"><?= $errors['prix'] ?></span>
                        <?php } else { ?>
                            <?php if (isset($reussi["prix"])) { ?>
                                <span class="text-success"><?= $reussi['prix'] ?></span>
                            <?php } ?>
                        <?php } ?></label>
                    <div class="div-input p-2">
                        <input class="form-control" id="prix" type="number" name="prix" placeholder="Prix de l'article"
                            value="<?= $_POST['prix'] ?? '' ?>">
                    </div>
                </div>
                <div>
                    <label class="mt-3 text-left" for="file">Fichier <span class="text-danger">*</span>
                        <?php if (isset($errors['file'])) { ?>
                            <span class="text-danger"><?= $errors['file'] ?></span>
                        <?php } else { ?>
                            <?php if (isset($reussi["file"])) { ?>
                                <span class="text-success"><?= $reussi['file'] ?></span>
                            <?php } ?>
                        <?php } ?></label>
                    <div class="div-input p-2">
                        <input class="form-control" id="file" type="file" name="file"
                            value="<?= $_POST['file'] ?? '' ?>">
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-4 mb-4">
                    <input type="submit" class="btn btn-page" value="Créer une annonce">
                </div>
                <div class="d-flex justify-content-center mt-4">
                    <?php if (isset($reussi["createAnnonce"])) { ?>
                        <p class="text-success"><b><?= $reussi["createAnnonce"] ?></b></p>
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