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
        <h1 class="d-flex justify-content-center mt-3">Annonces</h1>
        <div class="container">
            <?php foreach ($data as $annonce) { ?>
                <div class="div-article m-3 p-3">
                    <div class="card bg-article p-3">
                        <img src="/uploads/<?= $annonce["a_picture"] ?>" class="card-img-top"
                            alt="/uploads/<?= $annonce["a_picture"] ?>">
                        <div class="card-body">
                            <p class="card-title mt-2"><b>Nom : </b><br><?= $annonce["a_title"] ?></p>
                            <p class="mt-2"><b>Prix : </b><br><?= $annonce["a_price"] ?> €</p>
                            <p class="mt-2"><b>Publiée le : </b><br><?= $annonce["a_publication"] ?></p>
                        </div>
                        <div class="d-flex justify-content-center align-items-end">
                            <form action="index.php?url=details/<?= $annonce["a_id"] ?>" method="POST">
                                <button type="submit" class="btn btn-page p-3 mb-3 rounded-3">Voir les
                                    détails</button>
                            </form>
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