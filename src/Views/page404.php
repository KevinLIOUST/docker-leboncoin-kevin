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

    <header class="border text-center p-3">
        <div class="d-flex justify-content-center align-items-center">
            <a href="index.php?url=home"><img src="assets/img/Logo_Site_2.png" alt="assets/img/Logo_Site_2.png"></a>
        </div>
        <div class="d-flex justify-content-center align-items-center">
            <a class="liens-design" href="index.php?url=register">Créer un compte</a>
        </div>
        <div class="d-flex justify-content-center align-items-center">
            <a class="liens-design" href="index.php?url=login">Se connecter</a>
        </div>
        <div class="d-flex justify-content-center align-items-center">
            <a class="liens-design" href="index.php?url=annonces">Voir les annonces disponibles</a>
        </div>
        <div class="d-flex justify-content-center align-items-center">
            <a class="liens-design" href="index.php?url=create">Créer une annonce</a>
        </div>
        <div class="d-flex justify-content-center align-items-center">
            <a class="liens-design" href="index.php?url=profil">Voir le profil de l'utilisateur</a>
        </div>
    </header>

    <div class="row m-0">
        <div class="col-6">
            <img src="../assets/img/error404.png" alt="erreur 404" class="img-fluid">
        </div>
        <div class="col-6 text-center d-flex flex-column justify-content-center">
            <p class="h3">La page demandée n'existe pas</p>
            <div>
                <a href="index.php" class="btn btn-lg btn-light col-4 mt-3">Home</a>
            </div>
        </div>
    </div>

    <footer class="mt-auto text-center p-5 mt-3">
        <p>Afpa - 2025 - MVC</p>
    </footer>

    <script src="../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>