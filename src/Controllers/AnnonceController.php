<?php

namespace App\Controllers;

use App\Models\Annonce;

class AnnonceController
{
    public function index()
    {
        require_once __DIR__ . "/../Views/annonces.php";
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // On crée un tableau d'erreur vide pour l'instant.
            // Ce tableau va nous servir pour afficher les erreurs dans l'interface.
            $errors = [];

            // On crée un tableau pour afficher les message pour dire à l'utilisateur que c'est bon pour telle ou telle action.
            $reussi = [];

            // On regarde pour le nom de l'utilisateur.
            if (isset($_POST["titre"])) {
                // on va vérifier si c'est vide
                if (empty($_POST["titre"])) {
                    // si c'est vide, je créé une erreur dans mon tableau
                    $errors["titre"] = "Titre obligatoire.";
                } else {
                    $reussi["titre"] = "Titre valide.";
                }
            }

            // On regarde pour l'adresse email de l'utilisateur.
            if (isset($_POST["description"])) {
                // on va vérifier si c'est vide
                if (empty($_POST["description"])) {
                    // si c'est vide, je créé une erreur dans mon tableau
                    $errors["description"] = "Description obligatoire.";
                } else {
                    $reussi["description"] = "Description valide";
                }
            }

            // On regarde pour le mot de passe.
            if (isset($_POST["prix"])) {
                // on va vérifier si c'est vide
                if (empty($_POST["prix"])) {
                    // si c'est vide, je créé une erreur dans mon tableau
                    $errors["prix"] = "Prix obligatoire.";
                } else {
                    $reussi["prix"] = "Prix valide.";
                }
            }

            // On regarde pour la confirmation du mot de passe.
            // Il faut retaper encore une fois le mot de passe pour bien être sur que c'est bien ce mot de passe que l'utilisateur a choisi pour la création de son compte.
            if (isset($_FILES["photo"])) {
                // on va vérifier si c'est vide
                if (empty($_FILES["photo"])) {
                    // si c'est vide, je créé une erreur dans mon tableau
                    $errors["photo"] = "Photo obligatoire.";
                } else {
                    $reussi["photo"] = "La Photo est présente.";
                }
            }

            if (empty($errors)) {
                $annonce = new Annonce();

                var_dump($_FILES['photo']);

                if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
                    $nomFichier = $_FILES['photo']['name'];
                    $cheminTemporaire = $_FILES['photo']['image/png'];
                    $cheminDestination = __DIR__ . "/../../public/uploads/768x768/" . $nomFichier;

                    // Déplacer le fichier vers le dossier final
                    if (move_uploaded_file($cheminTemporaire, $cheminDestination)) {
                        echo "Fichier téléchargé avec succès : $nomFichier";
                    } else {
                        echo "Erreur lors du déplacement du fichier.";
                    }
                } else {
                    echo "Erreur lors du téléchargement : " . $_FILES['photo']['error'];
                }

                $annonce->createAnnonce($_POST['titre'], $_POST['description'], $_POST['prix'], $_POST['photo'], $_SESSION['id']);
                // $user->createUser($_POST['username'], $_POST["email"], password_hash($_POST["password"], PASSWORD_DEFAULT));
                $reussi["createAnnonce"] = "Une nouvelle annonce vient d'être créée.";
            }
        }

        require_once __DIR__ . "/../Views/create.php";
    }

    public function show($id)
    {
        require_once __DIR__ . "/../Views/details.php/$id";
    }
}
?>