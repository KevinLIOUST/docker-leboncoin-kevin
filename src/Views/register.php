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
        <h1 class="text-center mt-3 mb-3">Créer un compte</h1>
        <div class="d-flex justify-content-center align-items-center">
            <!-- <form action="" method="POST">
                <div class="d-flex justify-content-center mb-3 input-group">
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
                            <input class="mt-1 taille-input-register design-input-register form-control" id="username"
                                type="text" name="username" placeholder="username"
                                value="<?= $_POST['username'] ?? '' ?>">
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
                            <input class="mt-1 taille-input-register design-input-register" id="email" type="text"
                                name="email" placeholder="email" value="<?= $_POST['email'] ?? '' ?>">
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
                            <input class="mt-1 taille-input-register design-input-register" id="password"
                                type="password" name="password" placeholder="mot de passe"
                                value="<?= $_POST['password'] ?? '' ?>">
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
                            <input class="mt-1 taille-input-register design-input-register" id="confirmPassword"
                                type="password" name="confirmPassword" placeholder="mot de passe"
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
                    <input type="submit" class="btn btn-connexion" value="Créer un compte">
                </div>
                <div class="d-flex justify-content-center mt-4">
                    <?php if (isset($reussi['createUser'])) { ?>
                        <p class="text-success"><b><?= $reussi['createUser'] ?></b></p>
                    <?php } ?>
                </div>
            </form> -->
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">pseudo <span class="text-danger">*</span>
                        <?php if (isset($errors['username'])) { ?>
                            <span class="text-danger"><?= $errors['username'] ?></span>
                        <?php } else { ?>
                            <?php if (isset($reussi["username"])) { ?>
                                <span class="text-success"><?= $reussi['username'] ?></span>
                            <?php } ?>
                        <?php } ?></label>
                    <input class="form-control" id="username" type="text" name="username"
                        placeholder="Nom d'utilisateur" value="<?= $_POST['username'] ?? '' ?>">
                </div>
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
                <div class="mb-3">
                    <label for="confirmPassword" class="form-label">Confirmer le mot de passe <span
                            class="text-danger">*</span>
                        <?php if (isset($errors['confirmPassword'])) { ?>
                            <span class="text-danger"><?= $errors['confirmPassword'] ?></span>
                        <?php } else { ?>
                            <?php if (isset($reussi["confirmPassword"])) { ?>
                                <span class="text-success"><?= $reussi['confirmPassword'] ?></span>
                            <?php } ?>
                        <?php } ?></label>
                    <input class="form-control" id="confirmPassword" type="password" name="confirmPassword"
                        placeholder="Confirmer le Mot de passe" value="<?= $_POST['confirmPassword'] ?? '' ?>">
                </div>
                <div class="mb-3 form-check">
                    <label class="form-check-label" for="cgu">J'accepte les CGU
                        <span class="text-danger">*</span>
                        <?php if (isset($errors['cgu'])) { ?>
                            <span class="text-danger"><?= $errors['cgu'] ?></span>
                        <?php } else { ?>
                            <?php if (isset($reussi["cgu"])) { ?>
                                <span class="text-success"><?= $reussi['cgu'] ?></span>
                            <?php } ?>
                        <?php } ?></label>
                    <input class="form-check-input" id="cgu" type="checkbox" name="cgu"
                        value="<?= $_POST['cgu'] ?? '' ?>">
                </div>
                <!-- <input type="submit" class="btn btn-connexion" value="Créer un compte"> -->
                <button type="submit" aria-describedby="registerHelp" class="btn btn-connexion">Créer un compte</button>
                <div class="d-flex justify-content-center mt-4">
                    <?php if (isset($reussi['createUser'])) { ?>
                        <p class="text-success"><b><?= $reussi['createUser'] ?></b></p>
                    <?php } ?>
                </div>
                <div id="registerHelp" class="form-text text-danger">Partagez pas votre mot de passe et votre
                    adresse mail.
                </div>
            </form>
        </div>
    </main>

    <?php include_once __DIR__ . "/../Template/footer.php"; ?>

    <script src="../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>