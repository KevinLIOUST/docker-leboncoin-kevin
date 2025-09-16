<?php

namespace App\Controllers;

use App\Models\Annonce;

class AnnonceController
{
    public function index()
    {
        require_once __DIR__ . "/../Views/annonces.php";
    }

    public function create(string $photo)
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
            if (isset($_POST["file"])) {
                // on va vérifier si c'est vide
                if (empty($_POST["file"])) {
                    // si c'est vide, je créé une erreur dans mon tableau
                    $errors["file"] = "Photo obligatoire.";
                } else {
                    $reussi["file"] = "La Photo est présente.";
                }
            }

            if (empty($errors)) {
                $annonce = new Annonce();

                // var_dump($_FILES['file']);

                // if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
                //     $nomFichier = $_FILES['file'][$_POST['file']];
                //     $cheminTemporaire = $_FILES['file']['image/png'];
                //     $cheminDestination = __DIR__ . "/../../public/uploads/768x768/" . $nomFichier;

                //     // Déplacer le fichier vers le dossier final
                //     if (move_uploaded_file($cheminTemporaire, $cheminDestination)) {
                //         echo "Fichier téléchargé avec succès : $nomFichier";
                //     } else {
                //         echo "Erreur lors du déplacement du fichier.";
                //     }
                // } else {
                //     echo "Erreur lors du téléchargement.";
                // }

                $chemin = __DIR__ . "/../../public/uploads/768x768";

                // Vérifie si le dossier existe déjà
                if (!file_exists($chemin)) {
                    // Crée le dossier avec des permissions spécifiques
                    if (mkdir($chemin, 0777)) {
                        echo "Le dossier '$chemin' a été créé avec succès.";
                    } else {
                        echo "Erreur lors de la création du dossier.";
                    }
                } else {
                    echo "Le dossier '$chemin' existe déjà.";
                }

                // var_dump($_POST);

                $_FILES["file"] = $photo;

                // Vérifiez si un fichier a été uploadé
                if (!isset($_FILES['file'])) {

                    // Récupérer les informations du fichier
                    $fileName = $_FILES['file']['name']; // Nom du fichier

                    // Définir le dossier de destination
                    $uploadFolder = __DIR__ . "/../../public/uploads/768x768/";
                    $destinationPath = "$uploadFolder . $fileName";

                    // Déplacer le fichier vers le dossier de destination
                    // if (move_uploaded_file($fileTmpPath, $destinationPath)) {
                    //     echo "Le fichier a été déplacé avec succès vers : $destinationPath";
                    // } else {
                    //     echo "Erreur : Impossible de déplacer le fichier.";
                    // }
                }

                $annonce->createAnnonce($_POST['titre'], $_POST['description'], $_POST['prix'], $destinationPath, $_SESSION["user"]['id']);
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