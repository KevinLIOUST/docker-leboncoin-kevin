<?php

namespace App\Controllers;

class HomeController
{
    public function index()
    {
        if (isset($_SESSION["user"])) {
            unset($_SESSION["user"]);
            session_destroy();
        }
        require_once __DIR__ . "/../Views/home.php";
    }
}
