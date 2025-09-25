<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

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
        <h1 class="text-center mt-3">Se connecter</h1>
        <div class="d-flex justify-content-center align-items-center">
            <form class="w-75" action="" method="POST">
                <div class="mb-3">
                    <label for="email" class="form-label">Adresse Email <span class="text-danger">*</span>
                        <?php if (isset($errors['email'])) { ?>
                            <span class="text-danger"><?= $errors['email'] ?></span>
                        <?php } else { ?>
                            <?php if (isset($reussi["email"])) { ?>
                                <span class="text-success"><?= $reussi['email'] ?></span>
                            <?php } ?>
                        <?php } ?></label>
                    <input class="form-control" id="email" type="text" name="email" placeholder="email"
                        value="<?= $_POST['email'] ?? '' ?>">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe <span class="text-danger">*</span>
                        <?php if (isset($errors['password'])) { ?>
                            <span class="text-danger"><?= $errors['password'] ?></span>
                        <?php } else { ?>
                            <?php if (isset($reussi["password"])) { ?>
                                <span class="text-success"><?= $reussi['password'] ?></span>
                            <?php } ?>
                        <?php } ?></label>
                    <input class="form-control" id="password" type="password" name="password" placeholder="Mot de passe"
                        value="<?= $_POST['password'] ?? '' ?>">
                </div>
                <!-- aria-describedby="registerHelp" -->
                <div class="d-flex justify-content-center m-4">
                    <button type="submit" class="btn btn-connexion">Se connecter</button>
                </div>
                <!-- <div id="registerHelp" class="form-text text-danger"> La connexion va vous servir à faire plein de
                    choses.
                </div> -->
            </form>
        </div>
    </main>

    <?php include_once __DIR__ . "/../Template/footer.php"; ?>

    <script src="../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>