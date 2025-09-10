<?php

namespace App\Models;

use PDO;
use PDOException;

// Si la méthode utilisée pour envoyer des données depuis le formulaire de création de compte est POST, alors on récupère les informations que l'utilisateur à entrées
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pseudo = htmlspecialchars($_POST['pseudo']); // Protection contre les injections XSS
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hachage du mot de passe
    $email = htmlspecialchars($_POST['email']);
}

// Classe User pour gérer les utilisateurs avec la base de données
class User
{

    // // L'identifiant de l'utilisateur
    // private $id;

    // // Le pseudo de l'utilisateur
    // private $pseudo;

    // // L'email de l'utilisateur
    // private $email;

    // // Le mot de passe de l'utilisateur
    // private $password;

    /**
     * Méthode pour créer un utilisateur pour l'enregistrer dans la base de données juste àprès qu'il ait crée son compte sur le FAUX site Internet leboncoin
     * @param string $pseudo Le pseudo de l'utilisateur (Son nom sur Internet)
     * @param string $email L'email de l'utilisateur
     * @param string $password Le mot de passe de l'utilisateur
     * @return void
     */
    public function createUser(string $pseudo, string $email, string $password)
    {
        try {
            require_once __DIR__ . "/DatabaseConnection/pdoconfig.php";
        
            $sql = "INSERT INTO users (u_email, u_password, u_username) VALUES ('$email', '$password', '$pseudo');";
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $usernameDatabase, $passwordDatabase);
            $stmt = $pdo->prepare($sql);

            // Exécutez la requête
            $stmt->execute();
        }
        catch (PDOException $errorPDOException) {
            echo "La requête n'a pas pu être exécutée ". $errorPDOException->getMessage();
        }
    }

    /**
     * Méthode pour trouver un utilisateur en fonction de l'email
     * @param string $email L'email de l'utilisateur à trouver
     * @return void
     */
    public function findByEmail(string $email) {
        try {
            require_once __DIR__ . "/DatabaseConnection/pdoconfig.php";
        
            $sql = "SELECT u_email FROM users WHERE u_email = '$email';";
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $usernameDatabase, $passwordDatabase);
            $stmt = $pdo->prepare($sql);

            // Exécutez la requête
            $stmt->execute();

            $result = $stmt->execute();

            if (empty($result)) {
                echo "Pas de mail $email trouvé ! ):";
            } else {
                echo "Mail trouvé : $email";
            }
        }
        catch (PDOException $errorPDOException) {
            echo "L'email $email n'a pas été trouvé. " . $errorPDOException->getMessage();
        }
    }
}