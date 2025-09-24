<?php

namespace App\Models;

use App\Models\DatabaseConnection\Database;
use PDO;
use PDOException;

$errors = [];

$reussi = [];

// Classe Annonce pour gérer les annonces avec la base de données
class Annonce
{
    /**
     * Méthode pour créer une annonce.
     * @param string $titre Le titre de l'annonce.
     * @param string $description La description de l'annonce.
     * @param float $prix Le prix de l'annonce.
     * @param mixed $photo La photo de l'article de l'annonce.
     * @param int $userId L'identifiant de l'utilisateur en question qui a fait l'annonce.
     * @return bool Retourne une valeur booléenne pour dire si l'utilisateur peut crée cette annonce ou pas.
     */
    public function createAnnonce(string $titre, string $description, float $prix, string $photo, int $userId)
    {
        // On essaye de se connnecter
        try {

            // On fait la requête SQL pour créer l'annonce en question.
            $sql = "INSERT INTO annonces (a_title, a_description, a_price, a_picture, u_id) VALUES ('$titre', '$description', $prix, '$photo', $userId);";

            // On se connecte à la base de données.
            $pdo = Database::getConnection();

            // On prépare la requête pour l'utiliser.
            $stmt = $pdo->prepare($sql);

            // On exécute la requête SQL.
            $stmt->execute();

            // Variable booléenne $peutCreerAnnonce pour valeur true pour dire que l'annonce a été créée.
            $peutCreerAnnonce = true;

            // Message avertissant l'utilisateur que l'utilisateur est crée et ajouté dans la base de données.
            $reussi["peutCreerAnnonce"] = "L'annonce a été crée, et ajouté dans la base de données.";

            // var_dump($errors);

            // Retourne true.
            return $peutCreerAnnonce;

        }

        // Si on n'arrive pas à se connecter à la base de données, alors on déclanche une Exception PDOException pour avertir l'utilisateur que l'annonce n'a pas été crée et qu'elle n'a pas été ajouté dans la base de données.
        catch (PDOException $errorPDOException) {
            $errors["peutPasCreerAnnonce"] = "L'annonce n'a pas été créée. " . $errorPDOException->getMessage();
            $peutCreerAnnonce = false;
            // var_dump($errors);
        }
    }

    /**
     * Méthode pour récupérer toutes les annonces.
     * @return array Retourne la liste des annonces sous forme de tableau associatif.
     */
    public function findAll()
    {

        // On essaye de se connnecter
        try {

            // On fait la requête SQL pour récupérer toutes les annonces.
            $sql = "SELECT * FROM annonces;";

            // On se connecte à la base de données.
            $pdo = Database::getConnection();

            // On prépare la requête pour l'utiliser.
            $stmt = $pdo->prepare($sql);

            // On exécute la requête SQL.
            $stmt->execute();

            // On récupère les données sous forme de tableau associatif avec l'aide de la fonction fetchAll et de la constante FETCH_ASSOC de la classe PDO
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // On regarde s'il n'y a pas de données.
            // Si c'est vide alors aucune annonce n'a été trouvée.
            if (empty($data)) {
                $errors["annoncesVide"] = "Pas d'annonces trouvées.";

                // Sinon, les annonces sont trouvées.
            } else {
                $reussi["annoncesTrouvees"] = "Toutes les annonces ont été trouvées.";
            }

            // var_dump($errors);
            // var_dump($data);

            // On retourne les annonces sous forme d'array (Tableau associatif).
            return $data;

        }

        // Si on n'arrive pas à se connecter à la base de données, alors on déclanche une Exception PDOException pour avertir l'utilisateur que les annonces ne sont pas trouvées.
        catch (PDOException $errorPDOException) {
            $errors["annoncesVide"] = "Pas d'annonces trouvées. " . $errorPDOException->getMessage();
            // var_dump($errors);
        }
    }

    /**
     * Méthode pour récupérer l'annonce en question grâce à son id.
     * @return array Retourne l'annonce avec toutes ses informations sous forme de tableau associatif.
     */
    public function findById(int $id)
    {

        // On essaye de se connnecter
        try {

            // On fait la requête SQL pour récupérer l'annonce en question avec l'id.
            $sql = "SELECT * FROM annonces WHERE a_id = $id;";

            // On se connecte à la base de données.
            $pdo = Database::getConnection();

            // On prépare la requête pour l'utiliser.
            $stmt = $pdo->prepare($sql);

            // On exécute la requête SQL.
            $stmt->execute();

            // On récupère les données sous forme de tableau associatif avec l'aide de la fonction fetchAll et de la constante FETCH_ASSOC de la classe PDO
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            // On regarde s'il n'y a pas de données.
            // Si c'est vide alors l'annonce n'a pas été trouvée
            if (empty($data)) {
                $errors["annonceIdVide"] = "L'annonce pour id $id n'a pas été trouvée.";
                header("Location: index.php?url=page404.php");

                // Sinon, les annonces sont trouvées.
            } else {
                $reussi["annonceIdTrouvee"] = "L'annonce pour id $id a été trouvée.";
            }

            // var_dump($errors);
            // var_dump($data);

            // On retourne les annonces sous forme d'array (Tableau associatif).
            return $data;

        }

        // Si on n'arrive pas à se connecter à la base de données, alors on déclanche une Exception PDOException pour avertir l'utilisateur que l'annonce en question n'est pas trouvée.
        catch (PDOException $errorPDOException) {
            $errors["annonceIdVide"] = "L'annonce pour id $id n'a pas été trouvée. " . $errorPDOException->getMessage();
            // var_dump($errors);
        }
    }

    /**
     * Méthode pour récupérer les annonces en question grâce à l'identifiant de l'utilisateur qui les a postées.
     * @param int $userId L'identifiant de l'utilisateur qui a posté une ou les annonces.
     * @return array Retourne un tableau associatif avec une ou les annonces avec l'identifiant de l'utilisateur en question.
     */
    public function findByUser(int $userId)
    {

        // On essaye de se connnecter
        try {

            // On fait la requête SQL pour récupérer l'annonce en question avec l'id.
            $sql = "SELECT * FROM annonces WHERE u_id = $userId;";

            // On se connecte à la base de données.
            $pdo = Database::getConnection();

            // On prépare la requête pour l'utiliser.
            $stmt = $pdo->prepare($sql);

            // On exécute la requête SQL.
            $stmt->execute();

            // On récupère les données sous forme de tableau associatif avec l'aide de la fonction fetchAll et de la constante FETCH_ASSOC de la classe PDO
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // On regarde s'il n'y a pas de données.
            // Si c'est vide alors les annonces n'ont pas été trouvées.
            if (empty($data)) {
                $errors["annoncesUtilIdVide"] = "Les annonces pour l'utilisateur $userId n'ont pas été trouvées.";

                // Sinon, les annonces sont trouvées.
            } else {
                $reussi["annoncesUtilIdTrouvee"] = "Les annonces pour l'utilisateur $userId ont été trouvées.";
            }

            // var_dump($errors);
            // var_dump($data);

            // On retourne les annonces sous forme d'array (Tableau associatif).
            return $data;

        }

        // Si on n'arrive pas à se connecter à la base de données, alors on déclanche une Exception PDOException pour avertir l'utilisateur que les annonces pour utilisateur $userId n'ont pas été trouvées.
        catch (PDOException $errorPDOException) {
            $errors["annoncesUtilIdVide"] = "Les annonces pour l'utilisateur $userId n'ont pas été trouvées. " . $errorPDOException->getMessage();
            // var_dump($errors);
        }
    }

    /**
     * Méthode pour supprimer l'annonce enquestion sur laquelle l'utilisateur a cliqué.
     * @param int $annonceId L'identifiant de l'annonce en question
     */
    public function deleteAnnonce(int $annonceId, int $userId)
    {

        // On essaye de se connnecter
        try {

            // On fait la requête SQL pour récupérer l'annonce en question avec l'id.
            $sql = "DELETE FROM annonces WHERE a_id = $annonceId AND u_id = $userId;";

            // On se connecte à la base de données.
            $pdo = Database::getConnection();

            // On prépare la requête pour l'utiliser.
            $stmt = $pdo->prepare($sql);

            // On exécute la requête SQL.
            $stmt->execute();

            if ($stmt->execute()) {
                $reussi["supprimeAnnonce"] = "L'annonce $annonceId de l'utilisateur $userId a bien été supprimée.";
                // echo "L'annonce $annonceId a bien été supprimée.";
            } else {
                $errors["pasSupprimeAnnonce"] = "L'annonce $annonceId de l'utilisateur $userId n'a pas été supprimée.";
                // echo "L'annonce $annonceId de l'utilisateur $userId n'a pas été supprimée.";
            }

        }

        // Si on n'arrive pas à se connecter à la base de données, alors on déclanche une Exception PDOException pour avertir l'utilisateur que les annonces pour utilisateur $annonceId n'ont pas été trouvées.
        catch (PDOException $errorPDOException) {
            $errors["pasSupprimeAnnonce"] = "L'annonce $annonceId de l'utilisateur $userId n'a pas été supprimée." . $errorPDOException->getMessage();
            // echo "L'annonce $annonceId de l'utilisateur $userId n'a pas été supprimée." . $errorPDOException->getMessage();
        }
    }

    /**
     * Méthode pour modifier une annonce.
     * @param string $titre Le titre de l'annonce.
     * @param string $description La description de l'annonce.
     * @param float $prix Le prix de l'annonce.
     * @param mixed $photo La photo de l'article de l'annonce.
     * @param int $userId L'identifiant de l'utilisateur en question qui a fait l'annonce.
     * @return bool Retourne une valeur booléenne pour dire si l'utilisateur peut modifier cette annonce ou pas.
     */
    public function modifierAnnonce(int $id, string $titre, string $description, float $prix, string $photo, int $userId)
    {

        // On essaye de se connnecter
        try {

            // On fait la requête SQL pour récupérer l'annonce en question avec l'id.
            $sql = "UPDATE annonces SET a_title = '$titre', a_description = '$description', a_price = $prix, a_picture = '$photo' WHERE a_id = $id";

            // On se connecte à la base de données.
            $pdo = Database::getConnection();

            // On prépare la requête pour l'utiliser.
            $stmt = $pdo->prepare($sql);

            // On exécute la requête SQL.
            $stmt->execute();

            if ($stmt->execute()) {
                $reussi["modifieAnnonce"] = "L'annonce $id de l'utilisateur $userId a bien été modifiée.";
                // echo "L'annonce $annonceId a bien été supprimée.";
            } else {
                $errors["pasModifieAnnonce"] = "L'annonce $id de l'utilisateur $userId n'a pas été modifiée.";
                // echo "L'annonce $annonceId de l'utilisateur $userId n'a pas été supprimée.";
            }

        }

        // Si on n'arrive pas à se connecter à la base de données, alors on déclanche une Exception PDOException pour avertir l'utilisateur que les annonces pour utilisateur $annonceId n'ont pas été trouvées.
        catch (PDOException $errorPDOException) {
            $errors["pasModifieAnnonce"] = "L'annonce $id de l'utilisateur $userId n'a pas été modifiée." . $errorPDOException->getMessage();
            // echo "L'annonce $annonceId de l'utilisateur $userId n'a pas été supprimée." . $errorPDOException->getMessage();
        }
    }

    /**
     * Méthode pour retrouver l'image en question à supprimer en même temps que l'annonce.
     * @param int $annonceId L'identifiant de l'annonce en question
     */
    public function findImage(int $annonceId)
    {

        // On essaye de se connnecter
        try {

            // On fait la requête SQL pour récupérer l'image en question avec l'id de l'annonce.
            $sql = "SELECT a_picture FROM annonces WHERE a_id = $annonceId;";

            // On se connecte à la base de données.
            $pdo = Database::getConnection();

            // On prépare la requête pour l'utiliser.
            $stmt = $pdo->prepare($sql);

            // On exécute la requête SQL.
            $stmt->execute();

            if ($stmt->execute()) {
                $reussi["trouverImage"] = "L'image a bien été trouvée.";
            } else {
                $errors["pasTrouverImage"] = "L'image n'a pas été trouvée.";
            }

            // On récupère les données sous forme de tableau associatif avec l'aide de la fonction fetchAll et de la constante FETCH_ASSOC de la classe PDO
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // On regarde s'il n'y a pas de données.
            // Si c'est vide alors les annonces n'ont pas été trouvées.
            if (empty($data)) {
                $errors["pasTrouverImage"] = "L'image n'a pas été trouvée.";

                // Sinon, les annonces sont trouvées.
            } else {
                $reussi["trouverImage"] = "L'image a bien été trouvée.";
            }

            // var_dump($errors);
            // var_dump($data);

            // On retourne les annonces sous forme d'array (Tableau associatif).
            return $data;

        }

        // Si on n'arrive pas à se connecter à la base de données, alors on déclanche une Exception PDOException pour avertir l'utilisateur que les annonces pour utilisateur $annonceId n'ont pas été trouvées.
        catch (PDOException $errorPDOException) {
            $errors["pasTrouverImage"] = "L'image n'a pas été trouvée." . $errorPDOException->getMessage();
        }
    }
}

?>