<?php

/**
 * Nom virtuel qui regroupe des classes, fonctions, constantes et autres entités de code pour éviter les conflits de noms, notamment avec des bibliothèques tierces ou dans de grands projets.
 * Cette ligne doit être toujours en premier dans le code.
 */

namespace App\Models\DatabaseConnection;

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
        $host = "db";

        // Le nom de la base de données
        // Variable d'environnement MYSQL_DATABASE
        $dbname = "leboncoin";

        // Le nom de l'utilisateur
        // Variable d'environnement MYSQL_USER
        $usernameDatabase = "root";

        // Le mot de passe de l'utilisateur
        // Variable d'environnement MYSQL_PASSWORD
        $passwordDatabase = "root";

        // On essaye de se connecter.
        try {

            /**
             * Une connexion PDO à une base de données nécessite la création d’un nouvel objet PDO avec un nom de source de données (DSN), un nom d’utilisateur et un mot de passe.
             */
            $connection = new PDO("mysql:host=$host;dbname=$dbname", $usernameDatabase, $passwordDatabase);
            echo "Connection à la base de données $dbname avec $host réussie.";

            return $connection;

            /**
             * Un message d'erreur sera envoyé à l'utilisateur si la connection n'a pas marché.
             */
        } catch (PDOException $erreurPDOException) {
            die("Impossible de se connecter à la base de données $dbname :" . $erreurPDOException->getMessage());
        }
    }
}
