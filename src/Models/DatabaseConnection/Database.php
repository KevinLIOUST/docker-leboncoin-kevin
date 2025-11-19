<?php

/**
 * Nom virtuel qui regroupe des classes, fonctions, constantes et autres entités de code pour éviter les conflits de noms, notamment avec des bibliothèques tierces ou dans de grands projets.
 * Cette ligne doit être toujours en premier dans le code.
 */

namespace App\Models\DatabaseConnection;

use Dotenv\Dotenv;
use PDO;
use PDOException;

// Classe Database pour pouvoir se connecter à la base de données.
class Database
{

    /**
     * Fonction (méthode) pour se connecter à la base de données en question.
     * 
     * C'est pas nécessaire de fermer manuellement la connexion après avoir terminé d’utiliser un script PDO.
     * Elle est automatiquement fermée lorsque l’objet PDO est détruit ou lorsque le script se termine.
     * @return PDO Retourne un objet PDO pour pouvoir se connecter à la base de données.
     */
    public static function getConnection()
    {
        /**
         * Le DSN (Data Source Name) définit le type de base de données, le nom de la base de données et toute autre information relative à la base de données si nécessaire.
         * Ce sont les variables et les valeurs déclarées dans le fichier pdoconfig.php, référencées une fois par la ligne require_once dans le fichier Database.php.
         */

        // Variable d'environnement MYSQL_HOST

        // Le nom de la base de données
        // Variable d'environnement MYSQL_DATABASE

        // Le nom de l'utilisateur
        // Variable d'environnement MYSQL_USER

        // Le mot de passe de l'utilisateur
        // Variable d'environnement MYSQL_PASSWORD

        // Charger le fichier .env
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../../../');
        $dotenv->load();

        // Variables communes
        $dbHost = $_ENV['MYSQL_HOST'];
        $dbName = $_ENV['MYSQL_DATABASE'];
        $dbUser = $_ENV['MYSQL_USER'];
        $dbPass = $_ENV['MYSQL_PASSWORD'];
        $dbPort = $_ENV['MYSQL_PORT'];

        // On choisit la base selon APP_ENV
        // $db_name = $_ENV['APP_ENV'] === 'test' ? $_ENV['DB_NAME_TEST'] : $_ENV['DB_NAME_DEV'];

        // $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];

        // On essaye de se connecter.
        try {
            $dsn = "mysql:host=$dbHost;dbname=$dbName;port:$dbPort;";
            $pdo = new PDO($dsn, $dbUser, $dbPass);

            // Configurer PDO pour afficher les erreurs
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $pdo;

        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }
}
