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
<?php } ?>bg-dark text-white">
    <?php include_once __DIR__ . "/../Template/header.php"; ?>

    <main>
        <h1 class="d-flex justify-content-center mt-3">Annonces de <?= $_SESSION["user"]["pseudo"] ?></h1>
        <?php if (empty($data)) { ?>
            <div class="d-flex justify-content-center mb-3 mt-3">
                <b>Il n'y a pas encore d'annonces publiées pour l'instant pour <?= $_SESSION["user"]["pseudo"] ?></b>
            </div>
        <?php } ?>
        <div class="container">
            <?php foreach ($data as $annonce) { ?>
                <div class="div-article m-3 p-3">
                    <div class="card bg-article p-3">
                        <img src="/uploads/<?= $annonce["a_picture"] ?>" class="card-img-top"
                            alt="/uploads/<?= $annonce["a_picture"] ?>">
                        <div class="card-body">
                            <p class="card-title mt-2"><b>Nom : </b><br><?= $annonce["a_title"] ?></p>
                            <div class="d-flex justify-content-center">
                                <form action="index.php?url=details/<?= $annonce["a_id"] ?>" method="POST">
                                    <button type="submit" class="btn btn-details p-3 m-3  rounded-3"><i
                                            class="bi bi-info-circle"></i></button>
                                </form>
                                <button
                                    class="d-flex align-items-center justify-content-center btn-modify p-3 m-3 rounded-3"
                                    type="submit" name="id" id="id"
                                    onclick="window.location.href='index.php?url=modifierAnnonce/<?= $annonce['a_id'] ?>';"><i
                                        class="bi bi-pen"></i></button>
                                <form action="index.php?url=profil/<?= $annonce["a_id"] ?>" method="POST">
                                    <button
                                        class="d-flex align-items-center justify-content-center btn-supprime-annonce p-3 m-3 rounded-3"
                                        type="submit" name="id" id="id"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </main>

    <?php include_once __DIR__ . "/../Template/footer.php"; ?>

    <script src="../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>