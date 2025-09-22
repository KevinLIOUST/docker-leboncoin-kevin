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

    <header class="border text-center p-3">
        <div class="d-flex justify-content-center align-items-center">
            <a href="index.php?url=home"><img src="assets/img/Logo_Site_2.png" alt="assets/img/Logo_Site_2.png"></a>
        </div>
        <div class="d-flex justify-content-center align-items-center">
            <a class="d-flex justify-content-center align-items-center liens-design" href="index.php?url=register">Créer
                un compte</a>
        </div>
        <?php if (isset($_SESSION["user"])) { ?>
            <div class="d-flex justify-content-center align-items-center">
                <a class="d-flex justify-content-center align-items-center liens-design" href="index.php?url=logout">Se
                    déconnecter</a>
            </div>
        <?php } else { ?>
            <div class="d-flex justify-content-center align-items-center">
                <a class="d-flex justify-content-center align-items-center liens-design" href="index.php?url=login">Se
                    connecter</a>
            </div>
        <?php } ?>
        <div class="d-flex justify-content-center align-items-center">
            <a class="d-flex justify-content-center align-items-center liens-design" href="index.php?url=annonces">Voir
                les annonces disponibles</a>
        </div>
        <?php if (isset($_SESSION["user"])) { ?>
            <div class="d-flex justify-content-center align-items-center">
                <a class="d-flex justify-content-center align-items-center liens-design" href="index.php?url=create">Créer
                    une annonce</a>
            </div>
        <?php } ?>
        <?php if (isset($_SESSION["user"])) { ?>
            <div class="d-flex justify-content-center align-items-center">
                <a class="d-flex justify-content-center align-items-center liens-design" href="index.php?url=profil">Voir le
                    profil de <?= $_SESSION["user"]["pseudo"] ?></a>
            </div>
        <?php } ?>
    </header>

    <main>
        <h1 class="text-center mt-3">Se connecter</h1>
        <div class="d-flex justify-content-center align-items-center">
            <form action="" method="POST">
                <div class="d-flex justify-content-center">
                    <div>
                        <div>
                            <label class="text-left" for="email">Adresse Email <span class="text-danger">*</span><span
                                    class="text-danger"><?= isset($errors['email']) ? $errors['email'] : '' ?></span></label>
                        </div>
                        <div class="text-center">
                            <input class="mt-1 taille-input-connexion design-input-connexion" id="email" type="text"
                                name="email" placeholder="email" value="<?= $_POST['email'] ?? '' ?>">
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <div>
                        <div>
                            <label class="mt-3 text-left" for="password">Mot de passe <span
                                    class="text-danger">*</span><span
                                    class="text-danger"><?= isset($errors['password']) ? $errors['password'] : '' ?></span></label>
                        </div>
                        <div class="text-center">
                            <input class="mt-1 taille-input-connexion design-input-connexion" id="password"
                                type="password" name="password" placeholder="mot de passe"
                                value="<?= $_POST['password'] ?? '' ?>">
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    <input type="submit" class="btn btn-connexion" value="Se connecter">
                </div>
            </form>
        </div>
    </main>

    <footer class="mt-auto text-center p-5 mt-3">
        <p>Afpa - 2025 - MVC</p>
    </footer>

</body>

</html>