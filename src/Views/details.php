<?php

var_dump($data);
?>

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

<body class="d-flex flex-column vh-100 bg-dark text-white">
    <?php include_once __DIR__ . "/../Template/header.php"; ?>

    <main>
        <h1 class="d-flex justify-content-center mt-3">Détails de l'article</h1>
        <div class="container-details">
            <div class="div-article m-3 p-3">
                <div class="card bg-article p-3">
                    <img src="/uploads/<?= $data["a_picture"] ?>" class="card-img-top"
                        alt="/uploads/<?= $data["a_picture"] ?>">
                    <div class=" card-body">
                        <p class="card-title mt-2"><b>Nom : </b><br><?= $data["a_title"] ?></p>
                        <p class="mt-2"><b>Description : </b><br><?= $data["a_description"] ?></p>
                        <p class="mt-2"><b>Prix : </b><br><?= $data["a_price"] ?> €</p>
                        <p class="mt-2"><b>Publiée le : </b><br><?= $data["a_publication"] ?></p>
                        <div class="d-flex justify-content-center align-items-end">
                            <form action="index.php?url=annonces" method="POST">
                                <button type="submit" class="btn btn-page p-3 mb-3 rounded-3">Retour</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include_once __DIR__ . "/../Template/footer.php"; ?>

    <script src="../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>