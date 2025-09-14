<?php

namespace App\Controllers;

use App\Models\DatabaseConnection\Database;
use App\Models\User;

// session_start();

// Classe UserController pour vérifier les actions de l'utilisateur pour se connecter, se déconnecter et se créer un compte
class UserController
{

    /**
     * Méthode pour se créer un compte
     * @return void
     */
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // On crée un tableau d'erreur vide pour l'instant.
            // Ce tableau va nous servir pour afficher les erreurs dans l'interface.
            $errors = [];

            // On crée un tableau pour afficher les message pour dire à l'utilisateur que c'est bon pour telle ou telle action.
            $reussi = [];

            // On regarde pour le nom de l'utilisateur.
            if (isset($_POST["username"])) {
                // on va vérifier si c'est vide
                if (empty($_POST["username"])) {
                    // si c'est vide, je créé une erreur dans mon tableau
                    $errors["username"] = "Pseudo obligatoire.";
                } else if (User::checkUsername($_POST["username"])) {
                    // si le pseudo déjà présent dans notre bdd, on créé un message d'erreur
                    $errors["username"] = "Pseudo déjà utilisé.";
                } else {
                    $reussi["username"] = "Pseudo valide.";
                }
            }

            // On regarde pour l'adresse email de l'utilisateur.
            if (isset($_POST["email"])) {
                // on va vérifier si c'est vide
                if (empty($_POST["email"])) {
                    // si c'est vide, je créé une erreur dans mon tableau
                    $errors["email"] = "Mail obligatoire.";
                } else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                    // si mail non valide, on créé une erreur
                    $errors["email"] = "Mail non valide.";
                } else if (User::checkMail($_POST["email"])) {
                    // si mail déjà utilisé, on créé un message d'erreur dans notre tableau
                    $errors["email"] = "Mail déjà utilisé.";
                } else {
                    $reussi["email"] = "Mail valide";
                }
            }

            // On regarde pour le mot de passe.
            if (isset($_POST["password"])) {
                // on va vérifier si c'est vide
                if (empty($_POST["password"])) {
                    // si c'est vide, je créé une erreur dans mon tableau
                    $errors["password"] = "Mot de passe obligatoire.";
                } else if (strlen($_POST["password"]) < 8) {
                    // si le mot de passe est trop court, on créé une erreur
                    $errors["password"] = "Mot de passe trop court (minimum 8 caractères).";
                } else {
                    $reussi["password"] = "Mot de passe valide.";
                }
            }

            // On regarde pour la confirmation du mot de passe.
            // Il faut retaper encore une fois le mot de passe pour bien être sur que c'est bien ce mot de passe que l'utilisateur a choisi pour la création de son compte.
            if (isset($_POST["confirmPassword"])) {
                // on va vérifier si c'est vide
                if (empty($_POST["confirmPassword"])) {
                    // si c'est vide, je créé une erreur dans mon tableau
                    $errors["confirmPassword"] = "Confirmation du mot de passe obligatoire.";
                } else if ($_POST["confirmPassword"] !== $_POST["password"]) {
                    // si les deux mots de passe ne sont pas identiques, on créé une erreur
                    $errors["confirmPassword"] = "Les mots de passe ne sont pas identiques.";
                } else {
                    $reussi["confirmPassword"] = "Les mots de passe sont identiques.";
                }
            }

            // On regarde pour les cgu (Conditions Générales de vente)
            if (!isset($_POST["cgu"])) {
                // si la case n'est pas cochée, on créé une erreur
                $errors["cgu"] = "Vous devez accepter les CGU.";
            } else {
                $reussi["cgu"] = "les CGU sont cochées.";
            }

            if (empty($errors)) {
                $user = new User();
                $user->createUser($_POST['username'], $_POST["email"], password_hash($_POST["password"], PASSWORD_DEFAULT));
                $reussi["createUser"] = "Un nouvel utilisateur viens d'être ajouté à la base de données.";
            }
        }
        require_once __DIR__ . "/../Views/register.php";
    }

    /**
     * Méthode pour aller sur le profil de l'utilisateur en question qui s'est connecté au site Internet.
     * @return void
     */
    public function profil()
    {
        require_once __DIR__ . "/../Views/profil.php";
    }

    /**
     * Méthode pour pouvoir se connecter.
     * @return void
     */
    public function login()
    {
        // On lance uniquement quand il y a un formulaire validé via la méthode SESSION
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // On fait un tableau d'erreurs pour gérer les erreurs
            $errors = [];

            // On crée un tableau pour afficher les message pour dire à l'utilisateur que c'est bon pour telle ou telle action.
            $reussi = [];

            if (isset($_POST['email'])) {
                // On va vérifier si c'est vide
                if (empty($_POST['email'])) {
                    // je crée une erreur dans mon tableau
                    $errors['email'] = 'Mail obligatoire';
                } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    $errors['email'] = 'Mail non valide';
                } elseif (User::checkMail($_POST['email'])) {
                    $reussi['email'] = "Mail correct";
                } else {
                    $errors['email'] = "Mail incorrect";
                }
            }

            // Test avec Lucy Heartfilia
            // lucy.heartfilia@fairytail.com
            // '$2y$10$cX6hw8zIYTqqtRNrthVKXuPAjPFZpa11BFEXlKw2CjR8w.3Kpz1Em';
            // FairyTail792

            if (isset($_POST['password'])) {
                $password = $_POST['password'];
                // On va vérifier si c'est vide
                if (empty($_POST['password'])) {
                    // je crée une erreur dans mon tableau
                    $errors['password'] = 'Mot de passe obligatoire';
                } elseif (password_verify($_POST['password'], '$2y$10$cX6hw8zIYTqqtRNrthVKXuPAjPFZpa11BFEXlKw2CjR8w.3Kpz1Em')) {
                    $reussi['password'] = "Mot de passe correct";
                } else {
                    $errors['password'] = "Mot de passe incorrect";
                }
            }

            if (empty($errors)) {
                $email = $_POST['email'];
                $password = $_POST['password'];

                $_SESSION["user"] = [
                    "email" => $email,
                    "password" => $password
                ];

                var_dump($errors);
                var_dump($_SESSION);

                $this->welcome();
            }
        }
        // Test : FairyTail792
        require_once __DIR__ . "/../Views/login.php";
    }

    public function welcome()
    {
        include_once __DIR__ . "/../Views/welcome.php";
    }

    // Méthode pour pouvoir se déconnecter.
    public function logout()
    {
        unset($_SESSION["user"]);
        session_destroy();
        header('Location: index.php?url=login');
    }
}
