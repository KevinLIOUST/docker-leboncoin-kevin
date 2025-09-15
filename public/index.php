<?php

// use App\Models\DatabaseConnection\Database;

use App\Models\Annonce;
use App\Models\User;

session_start();

require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/routeur.php";

// $objUser = new User();
// $objUser->createUser("dddd","dddd.ooooo.com","ConventionsGeeks");

// $hachage = User::checkPasswordHachByEmail("lucy.heartfilia@fairytail.com")[0]["u_password"];
// var_dump($hachage);

// $objUser->findByUser(19);

?>