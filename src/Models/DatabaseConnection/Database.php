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
        // On appelle les informations de configuration de l'utilisateur pour se connecter à la base de données.
        require_once __DIR__ . "/pdoconfig.php";
        var_dump($host);
        var_dump($dbname);
        var_dump($usernameDatabase);
        var_dump($passwordDatabase);

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
