<?php

namespace App\Controllers;

use App\Models\DatabaseConnection\Database;
use App\Models\User;

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

            // On regarde pour le nom de l'utilisateur.
            if (isset($_POST["username"])) {
                // on va vérifier si c'est vide
                if (empty($_POST["username"])) {
                    // si c'est vide, je créé une erreur dans mon tableau
                    $errors["username"] = "Pseudo obligatoire.";
                } else if (User::checkUsername($_POST["username"])) {
                    // si le pseudo déjà présent dans notre bdd, on créé un message d'erreur
                    $errors["username"] = "Pseudo déjà utilisé.";
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
                }
            }

            // On regarde pour les cgu (Conditions Générales de vente)
            if (!isset($_POST["cgu"])) {
                // si la case n'est pas cochée, on créé une erreur
                $errors["cgu"] = "Vous devez accepter les CGU.";
            }

            if (empty($errors)) {
                $user = new User();
                $user->createUser($_POST['username'], $_POST["email"], $_POST["password"]);
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
        require_once __DIR__ . "/../Views/login.php";
    }

    // Méthode pour pouvoir se déconnecter.
    public function logout()
    {
        unset($_SESSION['user']);
        session_destroy();
        header('Location: index.php?url=login');
    }
}
