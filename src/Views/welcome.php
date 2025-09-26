<?php
// var_dump($_SESSION);
if (!isset($_SESSION["user"])) {
    header("Location: index.php?url=login");
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue</title>

    <!-- Lien vers Bootstrap -->
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css" />

    <!-- Lien vers les icônes Bootstrap -->
    <link rel="stylesheet" href="../node_modules/bootstrap-icons/font/bootstrap-icons.min.css">

    <!-- Lien vers le fichier pour designer le site web -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="d-flex flex-column vh-100 bg-dark text-white">
    <?php include_once __DIR__ . "/../Template/header.php"; ?>

    <main class="vh-100">
        <h1 class="text-center mt-3">Bienvenue <?= $_SESSION["user"]["pseudo"] ?> !</h1>
        <div class="d-flex justify-content-center">
            <button class="btn-page p-3 rounded-3 mb-4" onclick="window.location.href='index.php?url=profil';">
                Profil de <?= $_SESSION["user"]["pseudo"] ?>
            </button>
        </div>
    </main>

    <?php include_once __DIR__ . "/../Template/footer.php"; ?>

    <script>
        setTimeout(() => {
            window.location.href = "index.php?url=profil";
        }, 3000);
    </script>

    <script src="../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>