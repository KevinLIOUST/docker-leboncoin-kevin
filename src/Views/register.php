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
        <div class="d-flex justify-content-center align-items-center">
            <a class="d-flex justify-content-center align-items-center liens-design" href="index.php?url=create">Créer
                une annonce</a>
        </div>
        <?php if (isset($_SESSION["user"])) { ?>
            <div class="d-flex justify-content-center align-items-center">
                <a class="d-flex justify-content-center align-items-center liens-design" href="index.php?url=profil">Voir le
                    profil de <?= $_SESSION["user"]["email"] ?></a>
            </div>
        <?php } ?>
    </header>

    <main>
        <h1 class="text-center mt-3 mb-3">Créer un compte</h1>
        <div class="d-flex justify-content-center align-items-center">
            <form action="" method="POST">
                <div class="d-flex justify-content-center mb-3">
                    <div>
                        <div>
                            <label class="text-left" for="username">Choisir un pseudo (nom d'utilisateur) <span
                                    class="text-danger">*</span>
                                <?php if (isset($errors['username'])) { ?>
                                    <span class="text-danger"><?= $errors['username'] ?></span>
                                <?php } else { ?>
                                    <?php if (isset($reussi["username"])) { ?>
                                        <span class="text-success"><?= $reussi['username'] ?></span>
                                    <?php } ?>
                                <?php } ?></label>
                        </div>
                        <div class="text-center">
                            <input class="mt-1 taille-input design-input" id="username" type="text" name="username"
                                placeholder="username" value="<?= $_POST['username'] ?? '' ?>">
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <div>
                        <div>
                            <label class="text-left" for="email">Adresse Email <span class="text-danger">*</span>
                                <?php if (isset($errors['email'])) { ?>
                                    <span class="text-danger"><?= $errors['email'] ?></span>
                                <?php } else { ?>
                                    <?php if (isset($reussi["email"])) { ?>
                                        <span class="text-success"><?= $reussi['email'] ?></span>
                                    <?php } ?>
                                <?php } ?></label>
                        </div>
                        <div class="text-center">
                            <input class="mt-1 taille-input design-input" id="email" type="text" name="email"
                                placeholder="email" value="<?= $_POST['email'] ?? '' ?>">
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <div>
                        <div>
                            <label class="mt-3 text-left" for="password">Mot de passe <span class="text-danger">*</span>
                                <?php if (isset($errors['password'])) { ?>
                                    <span class="text-danger"><?= $errors['password'] ?></span>
                                <?php } else { ?>
                                    <?php if (isset($reussi["password"])) { ?>
                                        <span class="text-success"><?= $reussi['password'] ?></span>
                                    <?php } ?>
                                <?php } ?></label>
                        </div>
                        <div class="text-center">
                            <input class="mt-1 taille-input design-input" id="password" type="password" name="password"
                                placeholder="mot de passe" value="<?= $_POST['password'] ?? '' ?>">
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <div>
                        <div>
                            <label class="mt-3 text-left" for="confirmPassword">Confirmer le mot de passe <span
                                    class="text-danger">*</span>
                                <?php if (isset($errors['confirmPassword'])) { ?>
                                    <span class="text-danger"><?= $errors['confirmPassword'] ?></span>
                                <?php } else { ?>
                                    <?php if (isset($reussi["confirmPassword"])) { ?>
                                        <span class="text-success"><?= $reussi['confirmPassword'] ?></span>
                                    <?php } ?>
                                <?php } ?></label>
                        </div>
                        <div class="text-center">
                            <input class="mt-1 taille-input design-input" id="confirmPassword" type="password"
                                name="confirmPassword" placeholder="mot de passe"
                                value="<?= $_POST['confirmPassword'] ?? '' ?>">
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <div>
                        <div>
                            <label class="mt-3 text-left" for="cgu">J'accepte les conditions générales d'utilisation
                                <span class="text-danger">*</span>
                                <?php if (isset($errors['cgu'])) { ?>
                                    <span class="text-danger"><?= $errors['cgu'] ?></span>
                                <?php } else { ?>
                                    <?php if (isset($reussi["cgu"])) { ?>
                                        <span class="text-success"><?= $reussi['cgu'] ?></span>
                                    <?php } ?>
                                <?php } ?></label>
                            <input class="mt-1" id="cgu" type="checkbox" name="cgu" placeholder="mot de passe"
                                value="<?= $_POST['cgu'] ?? '' ?>">
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    <input type="submit" class="btn btn-connexion" value="Se connecter">
                </div>
                <div class="d-flex justify-content-center mt-4">
                    <?php if (isset($reussi['createUser'])) { ?>
                        <p class="text-success"><b><?= $reussi['createUser'] ?></b></p>
                    <?php } ?>
                </div>
            </form>
        </div>
    </main>

    <footer class="mt-auto text-center p-5 mt-3">
        <p>Afpa - 2025 - MVC</p>
    </footer>

</body>

</html>