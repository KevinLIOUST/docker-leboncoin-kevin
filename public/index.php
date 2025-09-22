<?php

/**
 * La page index.php est la première lue car les serveurs web, comme Apache,
 * sont configurés pour chercher automatiquement ce fichier comme page d'accueil par défaut d'un site.
 */

/**
 * La page index.php est la première lue car les serveurs web, comme Apache,
 * sont configurés pour chercher automatiquement ce fichier comme page d'accueil par défaut d'un site.
 */

// use App\Models\DatabaseConnection\Database;

// Ici, on va chercher les classes pour les utiliser
// Le "App" correspond à "src/" dans l'arborescence du projet dans le composer.json (PSR4)
use App\Models\Annonce;
use App\Models\User;

// session_start(), elle permet de démarrer une nouvelle session ou de reprendre une session existante.
/**
 * Création d'une session : Si aucune session n'existe, elle en crée une nouvelle.
 * Reprise d'une session : Si une session existe déjà (identifiée par un cookie ou un identifiant de session transmis via GET/POST), elle la reprend.
 * Gestion des données : Une fois la session démarrée, vous pouvez stocker et récupérer des données dans la superglobale $_SESSION.
 */
session_start();

require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/routeur.php";

// $objUser = new User();
// $objUser->createUser("dddd","dddd.ooooo.com","ConventionsGeeks");

// $hachage = User::checkPasswordHachByEmail("lucy.heartfilia@fairytail.com")[0]["u_password"];
// var_dump($hachage);

// $objUser->findByUser(19);

?>