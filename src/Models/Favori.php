<?php

namespace App\Models;

use App\Models\DatabaseConnection\Database;
use PDO;
use PDOException;

$errors = [];

$reussi = [];

// Classe Favori pour gérer les les favoris avec la base de données
class Favori
{
    /**
     * Méthode pour ajouter un favori dans la base de données
     * @param int $userId L'identifiant de l'utilisateur en question qui a ajouté le favori.
     * @param int $annonceId L'identifiant de l'annonce en question ajouté aux favoris.
     * @return bool Retourne vrai si l'ajout a bien marché, faux si ça n'a pas marché.
     */
    public function addFavori(int $userId, int $annonceId)
    {
        // On essaye de se connnecter
        try {

            // On fait la requête SQL pour ajouter le favori en question.
            $sql = "INSERT INTO favoris (user_id, annonce_id) VALUES ($userId, $annonceId);";

            // On se connecte à la base de données.
            $pdo = Database::getConnection();

            // On prépare la requête pour l'utiliser.
            $stmt = $pdo->prepare($sql);

            // On exécute la requête SQL.
            $stmt->execute();

            // Variable booléenne $peutCreerFavori pour valeur true pour dire que le favori a été créé.
            $peutCreerFavori = true;

            // Message avertissant l'utilisateur que le favori est créé et ajouté dans la base de données.
            $reussi["peutCreerFavori"] = "L'article $annonceId a été ajouté aux favoris.";

            // var_dump($errors);

            // Retourne true.
            return $peutCreerFavori;

        }

        // Si on n'arrive pas à se connecter à la base de données, alors on déclanche une Exception PDOException pour avertir l'utilisateur que le favori n'a pas été crée et qu'il n'a pas été ajouté dans la base de données.
        catch (PDOException $errorPDOException) {
            $errors["peutPasCreerFavori"] = "L'article $annonceId n'a pas été ajouté aux favoris. " . $errorPDOException->getMessage();
            $peutCreerFavori = false;
            // var_dump($errors);
        }
    }

    /**
     * Méthode pour supprimer un favori de la base de données.
     * @param int $userId L'identifiant de l'utilisateur qui supprime le favori.
     * @param int $annonceId L'identifiant de l'annonce à supprimer des favoris.
     * @return bool Retourne vrai si le favoris est bien supprimé, faux si ça n'a pas marché.
     */
    public function removeFavori(int $userId, int $annonceId)
    {
        // On essaye de se connnecter
        try {

            // On fait la requête SQL pour supprimer le favori en question.
            $sql = "DELETE FROM favoris WHERE user_id = $userId AND annonce_id = $annonceId;";

            // On se connecte à la base de données.
            $pdo = Database::getConnection();

            // On prépare la requête pour l'utiliser.
            $stmt = $pdo->prepare($sql);

            // On exécute la requête SQL.
            $stmt->execute();

            // Variable booléenne $peutSupprimerFavori pour valeur true pour dire que le favori a été supprimé.
            $peutSupprimerFavori = true;

            // Message avertissant l'utilisateur que le favori est supprimé et ajouté dans la base de données.
            $reussi["peutSupprimerFavori"] = "Le favori a été supprimé de la base de données.";

            // var_dump($errors);

            // Retourne true.
            return $peutSupprimerFavori;

        }

        // Si on n'arrive pas à se connecter à la base de données, alors on déclanche une Exception PDOException pour avertir l'utilisateur que le favori n'a pas été supprimé et qu'il n'a pas été supprimé de la base de données.
        catch (PDOException $errorPDOException) {
            $errors["peutPasCreerFavori"] = "Le favori n'a pas été supprimé. " . $errorPDOException->getMessage();
            $peutSupprimerFavori = false;
            // var_dump($errors);
        }
    }

    /**
     * Méthode pour récupérer les favoris en fonction de l'identifiant de l'utilisateur
     * @param int $userId L'identifiant de l'utilisateur en question
     * @return array Retourne un tableau avec tous les favoris correspondants à l'identifiant de l'utilisateur en question
     */
    public function findByUser(int $userId)
    {
        // On essaye de se connnecter
        try {

            // On fait la requête SQL pour récupérer la liste des favoris de l'utilisateur en question avec son id.
            $sql = "SELECT * FROM favoris JOIN annonces ON favoris.user_id = $userId AND favoris.annonce_id = annonces.a_id;";

            // On se connecte à la base de données.
            $pdo = Database::getConnection();

            // On prépare la requête pour l'utiliser.
            $stmt = $pdo->prepare($sql);

            // On exécute la requête SQL.
            $stmt->execute();

            // On récupère les données sous forme de tableau associatif avec l'aide de la fonction fetchAll et de la constante FETCH_ASSOC de la classe PDO
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // On regarde s'il n'y a pas de données.
            // Si c'est vide alors les favoris n'ont pas été trouvés.
            if (empty($data)) {
                $errors["favorisUtilIdVide"] = "Les favoris pour l'utilisateur $userId n'ont pas été trouvés.";

                // Sinon, les favoris sont trouvés.
            } else {
                $reussi["favorisUtilIdTrouve"] = "Les favoris pour l'utilisateur $userId ont été trouvés.";
            }

            // var_dump($errors);
            // var_dump($data);

            // On retourne les favoris sous forme d'array (Tableau associatif).
            return $data;

        }

        // Si on n'arrive pas à se connecter à la base de données, alors on déclanche une Exception PDOException pour avertir l'utilisateur que les annonces pour utilisateur $userId n'ont pas été trouvées.
        catch (PDOException $errorPDOException) {
            $errors["favorisUtilIdVide"] = "Les favoris pour l'utilisateur $userId n'ont pas été trouvés. " . $errorPDOException->getMessage();
            // var_dump($errors);
        }
    }
}