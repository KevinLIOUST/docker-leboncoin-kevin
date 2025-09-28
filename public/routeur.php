<?php

// Ici, on va chercher les classes pour les utiliser
// Le "App" correspond à "src/" dans l'arborescence du projet dans le composer.json (PSR4)
use App\Controllers\AnnonceController;
use App\Controllers\FavorisController;
use App\Controllers\HomeController;
use App\Controllers\UserController;
use App\Models\Annonce;

// si le param url est présent on prend sa valeur, sinon on donne la valeur home
$url = $_GET['url'] ?? 'home';

// je transforme $url en un tableau à l'aide de explode()
$arrayUrl = explode('/', $url);

// je récupère la page demandée index 0
$page = $arrayUrl[0];

// On récupère l'action d'ajouter ou de supprimer un favori par l'utilisateur
$action = $arrayUrl[1] ?? null;

// On récupère l'id pour pouvoir afficher les détails de l'annonce en question sur laquelle l'utilisateur a cliqué.
// S'il y a pas d'id, il y a rien
$id = $arrayUrl[1] ?? null;

// On récupère l'identifiant de l'annonce à ajouter ou supprimer par l'utilisateur
$idAnnonce = $arrayUrl[2] ?? null;

// On regarde la page en question dans l'url (index.php?url=$page)
switch ($page) {

    // Page d'accueil
    case 'home':
        $objController = new HomeController();
        $objController->index();
        break;

    // Page de création de compte utilisateur
    case "register":
        $objController = new UserController();
        $objController->register();
        break;

    // Page de connection au site Internet
    case "login":
        $objController = new UserController();
        $objController->login();
        break;

    // Page de bienvenue juste après avoir réussi à se connecter
    case "welcome":
        include_once __DIR__ . "/../src/Views/welcome.php";
        break;

    // Page d'affichage de l'espace personnel de l'utilisateur
    case "profil":
        $objController = new UserController();
        $objController->profil();

        if ($id == null) {
            break;
        } else {
            $objController = new AnnonceController();
            $objController->supprimerAnnonce();
        }
        break;

    // Page de déconnexion
    case "logout":
        include_once __DIR__ . "/../src/Views/logout.php";
        break;

    // Page pour afficher toutes les annonces de la liste générale
    case "annonces":
        $objController = new AnnonceController();
        $objController->index();
        break;

    // Page pour créer une annonce, accéssible quand un utilisateur se connectera
    case "create":
        $objController = new AnnonceController();
        $objController->create();
        break;

    case "modifierAnnonce":
        $objController = new AnnonceController();
        $objController->modify();
        break;

    // Page pour afficher les détails de l'article en question
    case "details":
        $objController = new AnnonceController();
        $objController->show($id);
        break;

    case "favoris":
        $objController = new FavorisController();
        $objController->index();

        if ($action == "add") {
            $_SESSION["user"]["actionFavori"] = "L'annonce $idAnnonce a été ajoutée aux Favoris";
            $objController->add($idAnnonce);
            break;
        } elseif ($action == "remove") {
            $_SESSION["user"]["actionFavori"] = "L'annonce $idAnnonce a été supprimée des Favoris";
            $objController->remove($idAnnonce);
            break;
        }

        break;

    // Page d'erreur qui s'affiche quand la page n'existe pas (Par exemple quand l'utilisateur modifie l'url à la main et met une page qui n'existe pas ou un identifiant d'article introuvable)
    default:
        // aucun cas reconnu = on charge la 404
        include_once __DIR__ . "/../src/Views/page404.php";
}
