<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>C'est comme Leboncoin</title>

    <!-- Lien vers Bootstrap -->
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css" />

    <!-- Lien vers les icônes Bootstrap -->
    <link rel="stylesheet" href="../node_modules/bootstrap-icons/font/bootstrap-icons.min.css">

    <!-- Lien vers le fichier pour designer le site web -->
    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body class="bg-dark text-white">

    <?php include_once __DIR__ . "/../Template/header.php"; ?>

    <!-- <div class="row m-0">
        <div class="col-6">
            <img src="../assets/img/error404.png" alt="erreur 404" class="img-fluid">
        </div>
        <div class="col-6 text-center d-flex flex-column justify-content-center">
            <p class="h3">La page demandée n'existe pas</p>
            <div>
                <a href="index.php" class="btn btn-lg btn-page col-4 mt-3">Retour à l'accueil</a>
            </div>
        </div>
    </div> -->
    <div class="container">
        <div class="d-flex justify-content-center">
            <img class="w-100" src="../assets/img/error404.png" alt="erreur 404" class="img-fluid">
        </div>
        <div class="d-flex flex-column justify-content-center">
            <p class="h3 text-center">La page demandée n'existe pas</p>
            <div class="d-flex justify-content-center">
                <button onclick="window.location.href='index.php?url=home';"
                    class="btn btn-lg btn-page col-4 mt-3 p-3 mb-4">Retour à l'accueil</button>
            </div>
        </div>
    </div>

    <?php include_once __DIR__ . "/../Template/footer.php"; ?>

    <script src="../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>