<?php
// var_dump($_SESSION);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deconnexion</title>

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
        <h1 class="text-center mt-3">Vous avez été déconnecté avec succès !</h1>
        <div class="d-flex justify-content-center">
            <form action="index.php?url=home" method="POST">
                <button class="btn-deconnexion p-3 rounded-3">Retour à la page de connexion</button>
            </form>
        </div>
    </main>

    <?php include_once __DIR__ . "/../Template/footer.php"; ?>

    <script>
        setTimeout(() => {
            <?php unset($_SESSION["user"]); ?>
            <?php session_destroy(); ?>
            window.location.href = "index.php?url=home";
        }, 3000);
    </script>

    <script src="../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>