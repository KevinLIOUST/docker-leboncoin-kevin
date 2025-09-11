<?php

// Nom du dossier où sont stockés les classes à utiliser pour l'appli.
namespace App\Models;

// On appelle des classes pour les utiliser.
use App\Models\DatabaseConnection\Database;
use PDO;
use PDOException;

// On déclare un tableau vide $errors pour stocker les messages d'erreurs pôur les afficher dans les vues en temps voulu.
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

    /**
     * Méthode pour créer un utilisateur pour l'enregistrer dans la base de données juste àprès qu'il ait crée son compte sur le FAUX site Internet leboncoin
     * @param string $pseudo Le pseudo de l'utilisateur (Son nom sur Internet)
     * @param string $email L'email de l'utilisateur
     * @param string $password Le mot de passe de l'utilisateur
     * @return bool Retourne true si l'utilisateur peut être crée, false si l'utilisateur peut pas être crée.
     */
    public function createUser(string $pseudo, string $email, string $password)
    {
        // On essaye de se connecter
        try {

            // On fait la requête SQL pour créer un utilisateur.
            $sql = "INSERT INTO users (u_email, u_password, u_username) VALUES ('$email', '$password', '$pseudo');";

            // On se connecte à la base de données.
            $pdo = Database::getConnection();

            // On prépare la requête pour l'utiliser.
            $stmt = $pdo->prepare($sql);

            // On exécute la requête SQL.
            $stmt->execute();

            // Variable booléenne $peutCreerUtil pour valeur true pour dire que l'utilisateur a été crée.
            $peutCreerUtil = true;

            // Message avertissant l'utilisateur que l'utilisateur est crée et ajouté dans la base de données.
            $errors["peutCreerUtil"] = "L'utilisateur a été crée, et ajouté dans la base de données.";

            // var_dump($errors);

            // Retourne true.
            return $peutCreerUtil;
        }

        // Si on n'arrive pas à se connecter à la base de données, alors on déclanche une Exception PDOException pour avertir l'utilisateur que l'utilisateur n'a pas été crée et donc n'a pas été ajouté à la base de données.
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

        // On essaye de se connnecter
        try {

            // On fait la requête SQL pour rechercher l'adresse mail de l'utilisateur en question.
            $sql = "SELECT u_email FROM users WHERE u_email = '$email';";

            // On se connecte à la base de données.
            $pdo = Database::getConnection();

            // On prépare la requête pour l'utiliser.
            $stmt = $pdo->prepare($sql);

            // On exécute la requête SQL.
            $stmt->execute();
            
            // On récupère les données sous forme de tableau associatif avec l'aide de la fonction fetchAll et de la constante FETCH_ASSOC de la classe PDO
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // On regarde s'il n'y a pas de données.
            // Si c'est vide alors l'adresse mail n'a pas été trouvée.
            if (empty($data)) {
                $errors["emailVide"] = "L'adresse mail $email n'a pas été trouvée.";

                // Sinon, l'adresse mail est trouvée.
            } else {
                $errors["emailTrouve"] = "L'adresse mail $email a été trouvée.";
            }

            // var_dump($errors);

            // On retourne les données sous forme d'array (Tableau associatif).
            return $data;

        }

        // Si on n'arrive pas à se connecter à la base de données, alors on déclanche une Exception PDOException pour avertir l'utilisateur que cette adresse mail n'a pas été trouvée dans la base de données.
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

        // On essaye de se connnecter
        try {

            // On fait la requête SQL pour rechercher l'identifiant de l'utilisateur en question.
            $sql = "SELECT u_id FROM users WHERE u_id = '$id';";

            // On se connecte à la base de données.
            $pdo = Database::getConnection();

            // On prépare la requête pour l'utiliser.
            $stmt = $pdo->prepare($sql);

            // On exécute la requête SQL.
            $stmt->execute();
            
            // On récupère les données sous forme de tableau associatif avec l'aide de la fonction fetchAll et de la constante FETCH_ASSOC de la classe PDO
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // On regarder s'il n'y a pas de données.
            // Si c'est vide, alors l'id n'a pas été trouvé.
            if (empty($data)) {
                $errors["idVide"] = "L'identifiant $id n'est pas trouvé.";

                // Sinon, l'id a bien été trouvé.
            } else {
                $errors["idTrouve"] = "Identifiant $id trouvé.";
            }

            // var_dump($errors);

            // Les données retournées sous forme de tableau associatif.
            return $data;

        }

        // Si on n'arrive pas à se connecter à la base de données, alors on déclanche une Exception PDOException pour avertir l'utilisateur que cet id n'a pas été trouvé dans la base de données.
        catch (PDOException $errorPDOException) {
            $errors["idVide"] = "L'identifiant $id n'est pas trouvé.";
        }
    }

    /**
     * Permet de vérifier si un mail existe déjà dans la table users
     * @param string $email L'email en question.
     * @return bool Retourne true si le mail existe, false s'il n'existe pas
     */
    public static function checkMail(string $email) {

        // On essaye de se connecter.
        try {
            // On se connecte à la base de données.
            $pdo = Database::getConnection();

            // test si la connexion est ok
            if (!$pdo) {
                // pas de connexion, on return false
                return false;
            }

            // Requête qui teste si un email existe déjà.
            // SELECT 1 → on ne demande qu’un "1" (pas besoin des infos de l’utilisateur).
            // LIMIT 1 → on arrête la recherche dès le premier résultat trouvé.
            $sql = "SELECT 1 FROM users WHERE u_email = :email LIMIT 1";

            // On prépare la requête avant de l'exécuter
            $stmt = $pdo->prepare($sql);

            // On associe le paramètre nommé :email avec la valeur contenue dans $email,
            // en précisant qu’il s’agit d’une chaîne (PDO::PARAM_STR).
            // Cela permet à PDO de traiter correctement la valeur et d’éviter toute injection SQL.
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);

            // On exécute la requête
            $stmt->execute();

            // Récupère la première colonne du premier résultat de la requête.
            // Ici, comme la requête fait "SELECT 1", on obtiendra soit 1 si l’email existe,
            // soit false si aucun résultat n’est trouvé.
            $result = $stmt->fetchColumn();

            if ($result !== false) {
                // une ligne a été trouvée -> l'email existe déjà
                $errors["MailExisteDeja"] = "Cette adresse mail existe déjà dans la base de données.";
                return true;
            } else {
                // aucune ligne trouvée -> l'email n'existe pas
                $errors["MailExistePas"] = "Cette adresse mail n'existe pas dans la base de données.";
                return false;
            }
        } catch (PDOException $e) {
            // test unitaire pour connaitre la raison de l'echec
            // echo 'Erreur : ' . $e->getMessage();
            return false;
        }
    }

    /**
     * Permet de vérifier si un nom d’utilisateur (username) existe déjà dans la table users
     * @param string $username Le nom de l'utilisateur.
     * @return bool true si le username existe, false s'il n'existe pas
     */
    public static function checkUsername(string $username): bool
    {
        // On essaye de se connecter
        try {
            // On se connecte à la base de données.
            $pdo = Database::getConnection();

            // Vérifie si la connexion est ok
            if (!$pdo) {
                // pas de connexion, on retourne false
                return false;
            }

            // Requête qui teste si un username existe déjà.
            // SELECT 1 → on ne demande qu’un "1" (pas besoin des infos de l’utilisateur).
            // LIMIT 1 → on arrête la recherche dès le premier résultat trouvé.
            $sql = "SELECT 1 FROM users WHERE u_username = :username LIMIT 1";

            // On prépare la requête avant de l'exécuter
            $stmt = $pdo->prepare($sql);

            // On associe le paramètre nommé :username avec la valeur contenue dans $username,
            // en précisant qu’il s’agit d’une chaîne (PDO::PARAM_STR).
            // Cela permet à PDO de traiter correctement la valeur et d’éviter toute injection SQL.
            $stmt->bindValue(':username', $username, PDO::PARAM_STR);

            // On exécute la requête
            $stmt->execute();

            // Récupère la première colonne du premier résultat de la requête.
            // Ici, comme la requête fait "SELECT 1", on obtiendra soit 1 si le username existe,
            // soit false si aucun résultat n’est trouvé.
            $result = $stmt->fetchColumn();

            if ($result !== false) {
                // une ligne a été trouvée -> le username existe déjà
                $errors["usernameExisteDeja"] = "Ce nom d'utilisateur existe déjà dans la base de données.";
                return true;
            } else {
                // aucune ligne trouvée -> le username n'existe pas
                $errors["usernameExistePas"] = "Ce nom d'utilisateur n'existe pas dans la base de données.";
                return false;
            }
        } catch (PDOException $e) {
            // Test unitaire pour connaître la raison de l’échec
            // echo 'Erreur : ' . $e->getMessage();
            return false;
        }
    }
}