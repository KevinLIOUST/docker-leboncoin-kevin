<?php

namespace App\Controllers;

use App\Models\Annonce;
use BcMath\Number;

// On crée un tableau vide pour les erreurs.
$errors = [];

// On créer un tableau vide pour les bons messages.
$reussi = [];

class AnnonceController
{
    public function index()
    {
        $annonce = new Annonce();
        $data = $annonce->findAll();
        require_once __DIR__ . "/../Views/annonces.php";
    }

    public function supprimerAnnonce()
    {
        // if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if (isset($_GET["url"])) {
            $id = explode('/', $_GET['url'])[1] ?? null;
        }

        $annonce = new Annonce();

        if ($annonce->findById($id)[0]["u_id"] == $_SESSION["user"]["id"]) {
            $image = $annonce->findImage($id)[0]["a_picture"];
            $annonce->deleteAnnonce($id, $_SESSION["user"]["id"]);
            // Chemin vers l'image à supprimer
            $chemin = __DIR__ . "/../../public/uploads/$image";

            // Vérifier si le fichier existe
            if (file_exists($chemin)) {
                // Supprimer le fichier
                if (unlink($chemin)) {
                    $reussi["imageSupprime"] = "L'image a été supprimée avec succès.";
                } else {
                    $errors["imagePasSupprime"] = "Erreur : Impossible de supprimer l'image.";
                }
            } else {
                $errors["pasImage"] = "Erreur : Le fichier n'existe pas.";
            }
        }
        // }

        include_once __DIR__ . "/../Views/profil.php";
        echo '<script>window.location.href = "index.php?url=profil";</script>';
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
                } elseif (strlen($_POST["titre"]) > 100) {
                    $errors["titre"] = "Titre trop long";
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
                } elseif (strlen($_POST["description"]) > 500) {
                    $errors["description"] = "description trop longue.";
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
                } elseif ((int) $_POST["prix"] < 0) {
                    $errors["prix"] = "Le prix doit être à 0 ou plus.";
                } elseif ($_POST["prix"] == 0) {
                    $reussi["prix"] = "Cette annonce est gratuite.";
                } else {
                    $reussi["prix"] = "Prix valide.";
                }
            }

            // On regarde pour la confirmation du mot de passe.
            // Il faut retaper encore une fois le mot de passe pour bien être sur que c'est bien ce mot de passe que l'utilisateur a choisi pour la création de son compte.
            if (isset($_FILES["file"])) {
                // on va vérifier si c'est vide
                if (empty($_FILES["file"]["name"])) {
                    // si c'est vide, je créé une erreur dans mon tableau
                    $errors["file"] = "Photo obligatoire.";
                } else {
                    $reussi["file"] = "La Photo est présente.";
                }
            }

            // var_dump($_FILES);

            if (empty($errors)) {
                $annonce = new Annonce();

                $chemin = __DIR__ . "/../../public/uploads";

                // Vérifie si le dossier existe déjà
                if (!file_exists($chemin)) {
                    // Crée le dossier avec des permissions spécifiques
                    if (mkdir($chemin, 0700)) {
                        $reussi["creerDossier"] = "Le dossier '$chemin' a été créé avec succès.";
                    } else {
                        $errors["pasCreerDossier"] = "Erreur lors de la création du dossier.";
                    }
                } else {
                    $reussi["dossierExistseDeja"] = "Le dossier '$chemin' existe déjà.";
                }

                // Vérifiez si un fichier a été uploadé
                if (!empty($_FILES['file']['name'])) {

                    // Récupérer les informations du fichier

                    $file = $_FILES['file'];

                    // On génére un identifiant unique pour l'image en question.
                    $imageId = md5(uniqid('image_', true));
                    $type = $file['type'];
                    $tmpNameFichier = $file["tmp_name"];
                    // var_dump($_FILES);

                    // On vérifie si c'est une image
                    if (getimagesize($tmpNameFichier)) {
                        // $reussi["image"] = "C'est une image.";
                        $reussi["image"] = "C'est une image.";
                    } else {
                        // $errors["pasImage"] = "C'est pas une image.";
                        $errors["pasImage"] = "C'est pas une image.";
                    }


                    // Définir le dossier de destination
                    $uploadFolder = __DIR__ . "/../../public/uploads/";
                    $nomFichier = "$imageId" . "." . explode("/", $type)[1];
                    // var_dump($nomFichier);
                    $destinationPath = "$uploadFolder" . $nomFichier;

                    // Déplacer le fichier vers le dossier de destination
                    if (move_uploaded_file($tmpNameFichier, $destinationPath)) {
                        echo "Le fichier a été déplacé avec succès vers : $destinationPath";
                    } else {
                        echo "Erreur : Impossible de déplacer le fichier.";
                    }
                }

                $annonce->createAnnonce($_POST['titre'], $_POST['description'], $_POST['prix'], $nomFichier, $_SESSION["user"]['id']);
                $reussi["createAnnonce"] = "Une nouvelle annonce vient d'être créée.";
            }
        }

        require_once __DIR__ . "/../Views/create.php";
    }

    public function modify()
    {
        if (isset($_GET["url"])) {
            $id = explode('/', $_GET['url'])[1] ?? null;
        }

        $annonce = new Annonce();
        $infosAnnonce = $annonce->findById($id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // if ($_SERVER['REQUEST_METHOD'] == 'POST') {

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
                } elseif (strlen($_POST["titre"]) > 100) {
                    $errors["titre"] = "Titre trop long";
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
                } elseif (strlen($_POST["description"]) > 500) {
                    $errors["description"] = "description trop longue.";
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
                } elseif ((int) $_POST["prix"] < 0) {
                    $errors["prix"] = "Le prix doit être à 0 ou plus.";
                } elseif ($_POST["prix"] == 0) {
                    $reussi["prix"] = "Cette annonce est gratuite.";
                } else {
                    $reussi["prix"] = "Prix valide.";
                }
            }

            // On regarde pour la confirmation du mot de passe.
            // Il faut retaper encore une fois le mot de passe pour bien être sur que c'est bien ce mot de passe que l'utilisateur a choisi pour la création de son compte.
            if (isset($_FILES["file"])) {
                // on va vérifier si c'est vide
                if (empty($_FILES["file"]["name"])) {
                    // si c'est vide, je créé une erreur dans mon tableau
                    $errors["file"] = "Photo obligatoire.";
                } else {
                    $reussi["file"] = "La Photo est présente.";
                }
            }

            // var_dump($_FILES);

            if (empty($errors)) {
                $imageId = $annonce->findImage($id)[0]["a_picture"];

                $chemin = __DIR__ . "/../../public/uploads";

                // Vérifie si le dossier existe déjà
                if (!file_exists($chemin)) {
                    // Crée le dossier avec des permissions spécifiques
                    if (mkdir($chemin, 0700)) {
                        $reussi["creerDossier"] = "Le dossier '$chemin' a été créé avec succès.";
                    } else {
                        $errors["pasCreerDossier"] = "Erreur lors de la création du dossier.";
                    }
                } else {
                    $reussi["dossierExistseDeja"] = "Le dossier '$chemin' existe déjà.";
                }

                // Vérifiez si un fichier a été uploadé
                if (!empty($_FILES['file']['name'])) {

                    // Récupérer les informations du fichier

                    $file = $_FILES['file'];

                    $type = $file['type'];
                    $tmpNameFichier = $file["tmp_name"];
                    // var_dump($_FILES);

                    // On vérifie si c'est une image
                    if (getimagesize($tmpNameFichier)) {
                        // $reussi["image"] = "C'est une image.";
                        $reussi["image"] = "C'est une image.";
                    } else {
                        // $errors["pasImage"] = "C'est pas une image.";
                        $errors["pasImage"] = "C'est pas une image.";
                    }


                    // Définir le dossier de destination
                    $uploadFolder = __DIR__ . "/../../public/uploads/";

                    // var_dump($nomFichier);
                    $destinationPath = "$uploadFolder" . $imageId;

                    // Déplacer le fichier vers le dossier de destination
                    if (move_uploaded_file($tmpNameFichier, $destinationPath)) {
                        echo "Le fichier a été déplacé avec succès vers : $destinationPath";
                    } else {
                        echo "Erreur : Impossible de déplacer le fichier.";
                    }
                }
                $annonce->modifierAnnonce($id, $_POST["titre"], $_POST["description"], $_POST["prix"], $imageId, $_SESSION["user"]['id']);
                $reussi["modifieAnnonce"] = "L'annonce vient d'être modifiée.";
            }
        }

        require_once __DIR__ . "/../Views/modifierAnnonce.php";
    }

    public function show($id)
    {
        // if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //     if (isset($_GET['url'])) {
        //         // var_dump($data);
        //     }
        // }
        $segments = explode('/', trim($_GET['url'], '/'));
        // var_dump($segments);
        $id = $segments[1];

        $annonce = new Annonce();
        $data = $annonce->findById($id);

        require_once __DIR__ . "/../Views/details.php";
    }
}
