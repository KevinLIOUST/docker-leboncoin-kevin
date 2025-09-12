<?php

namespace App\Controllers;

class AnnonceController {
    public function index(){
        require_once __DIR__ . "/../Views/annonces.php";
    }

    public function create(){
        require_once __DIR__ . "/../Views/create.php";
    }

    public function show($id){
        require_once __DIR__ . "/../Views/details.php/$id";
    }
}
?>