<?php
session_start();

var_dump($_POST);

// On lance uniquement quand il y a un formulaire validé via la méthode SESSION
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // On fait un tableau d'erreurs pour gérer les erreurs
    $errors = [];

    if (isset($_POST['email'])) {
        // On va vérifier si c'est vide
        if (empty($_POST['email'])) {
            // je crée une erreur dans mon tableau
            $errors['email'] = 'Mail obligatoire';
        } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Mail non valide';
        } else {
            $email = '';
            $id = 0;
            $role = '';
            for ($i = 0; $i < count($users); $i++) {
                if ($_POST['email'] == $users[$i]['mail']) {
                    $email = $_POST['email'];
                    $_SESSION['email'] = $email;

                    $id = $users[$i]['id'];
                    $_SESSION['id'] = $id;
                    break;
                }
            }
            if ($_POST['email'] != $email) {
                $errors['email'] = 'Mail incorrect';
            }
        }
    }

    if (isset($_POST['mdp'])) {
        $mdp = $_POST['mdp'];
        // On va vérifier si c'est vide
        if (empty($_POST['mdp'])) {
            // je crée une erreur dans mon tableau
            $errors['mdp'] = 'Mot de passe obligatoire';
        } else {
            $mdp = '';
            for ($i = 0; $i < count($users); $i++) {
                if ($_POST['mdp'] == $users[$i]['password']) {
                    $mdp = $_POST['mdp'];
                    $_SESSION['mdp'] = $mdp;
                }
            }
            if ($_POST['mdp'] != $mdp) {
                $errors['mdp'] = 'Mot de passe incorrect';
            }
        }
    }
}
?>

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

    <main>
        <div class="d-flex justify-content-center align-items-center">
            <form action="" method="POST">
                <div class="d-flex justify-content-center">
                    <div>
                        <div>
                            <label class="text-left" for="email">Adresse Email <span class="text-danger">*</span><span class="text-danger"><?= isset($errors['email']) ? $errors['email'] : '' ?></span></label>
                        </div>
                        <div class="text-center">
                            <input class="mt-1 taille-email design-email" id="email" type="text" name="email" placeholder="email" value="<?= $_POST['email'] ?? '' ?>">
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <div>
                        <div>
                            <label class="mt-3 text-left" for="mdp">Mot de passe <span class="text-danger">*</span><span class="text-danger"><?= isset($errors['mdp']) ? $errors['mdp'] : '' ?></span></label>
                        </div>
                        <div class="text-center">
                            <input class="mt-1 taille-mdp design-mdp" id="mdp" type="password" name="mdp" placeholder="mot de passe" value="<?= $_POST['mdp'] ?? '' ?>">
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-3">
                    <span class="text-danger"><?= isset($errors['matchPas']) ? $errors['matchPas'] : '' ?></span>
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