<?php

// use App\Models\DatabaseConnection\Database;
use App\Models\User;

require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/routeur.php";

$objUser = new User();
// $objUser->createUser("le.legendaire.cos","kevin.lioust@outlook.com","ConventionsGeek");

$objUser->findByEmail("fheiufe@hbdiufe.de");

?>