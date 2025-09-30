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

<body class="d-flex flex-column vh-100 bg-dark text-white">

    <?php include_once __DIR__ . "/../Template/header.php"; ?>

    <main>
        <h1 class="text-center mt-3">Bienvenue au magasin de composants PC spécial geek !</h1>
        <h2 class="text-center mt-5">Ici, vous trouverez plein de composants pour PC, mais designer de façon geek comme
            par exemple une carte graphique NVIDIA GeForce RTX 5090 ASUS ROG ASTRAL PixelCore Galaxy Edition !</h2>
        <h2 class="text-center mt-5">Amusez-vous bien, mais faites attention à votre argent !</h2>
    </main>

    <?php include_once __DIR__ . "/../Template/footer.php"; ?>

    <script src="../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>

    <!-- <script src="assets/js/script.js"></script> -->
</body>

</html>