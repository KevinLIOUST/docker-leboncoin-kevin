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
    <?php include_once __DIR__ . "/../Template/header.php"; ?>

    <main>
        <h1 class="d-flex justify-content-center mt-3">Détails de l'article</h1>
        <div class="d-flex justify-content-center">
            <?php foreach ($data as $annonce) { ?>
                <div class="div-article-details m-3 p-3">
                    <div class="d-flex justify-content-center">
                        <img src="/uploads/<?= $annonce["a_picture"] ?>"
                            alt="../../public/uploads/<?= $annonce["a_picture"] ?>">
                    </div>
                    <p class="mt-2"><b>Nom : </b><br><?= htmlspecialchars($annonce["a_title"]) ?></p>
                    <p class="mt-2"><b>Description : </b><br><?= htmlspecialchars($annonce["a_description"]) ?></p>
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

    <?php include_once __DIR__ . "/../Template/footer.php"; ?>

    <script src="../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>