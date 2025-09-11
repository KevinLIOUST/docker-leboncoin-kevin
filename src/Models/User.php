<?php

namespace App\Models;

use App\Models\DatabaseConnection\Database;
use PDO;
use PDOException;

$errors = [];

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
     * @return bool Retourne true si l'utilisateur peut être crée, false si l'utilisateur peut pas être crée.
     */
    public function createUser(string $pseudo, string $email, string $password)
    {
        try {
            $sql = "INSERT INTO users (u_email, u_password, u_username) VALUES ('$email', '$password', '$pseudo');";
            $pdo = Database::getConnection();
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            $peutCreerUtil = true;

            $errors["peutCreerUtil"] = "L'utilisateur a été crée.";

            // var_dump($errors);

            return $peutCreerUtil;
        }
        catch (PDOException $errorPDOException) {
            $errors["peutPasCreerUtil"] =  "La requête n'a pas pu être exécutée. Une adresse mail et un pseudo similaires sont déjà présents dans la base de données.";
            $peutCreerUtil = false;
            // var_dump($errors);
            return $peutCreerUtil;
        }
    }

    /**
     * Méthode pour trouver un utilisateur en fonction de l'email
     * @param string $email L'email de l'utilisateur à trouver
     * @return array Retourne un tableau associatif avec toutes les informations sur l'email de l'utilisateur.
     */
    public function findByEmail(string $email) {
        try {
            $sql = "SELECT u_email FROM users WHERE u_email = '$email';";
            $pdo = Database::getConnection();
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            if (empty($data)) {
                $errors["emailVide"] = "L'adresse mail $email n'a pas été trouvée.";
            } else {
                $errors["emailTrouve"] = "L'adresse mail $email a été trouvée.";
            }

            // var_dump($errors);

            return $data;

        }
        catch (PDOException $errorPDOException) {
            $errors["emailVide"] = "L'adresse mail $email n'a pas été trouvée.";
        }
    }

    /**
     * Méthode pour trouver un utilisateur en fonction de l'email
     * @param string $id L'id de l'utilisateur à trouver
     * @return array Retourne un tableau associatif avec toutes les informations sur l'email de l'utilisateur en fonction de son id.
     */
    public function findById(int $id) {
        try {
            $sql = "SELECT u_id FROM users WHERE u_id = '$id';";
            $pdo = Database::getConnection();
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            if (empty($data)) {
                $errors["idVide"] = "L'identifiant $id n'est pas trouvé.";
            } else {
                $errors["idTrouve"] = "Identifiant $id trouvé.";
            }

            // var_dump($errors);

            return $data;

        }
        catch (PDOException $errorPDOException) {
            $errors["idVide"] = "L'identifiant $id n'est pas trouvé.";
        }
    }
}