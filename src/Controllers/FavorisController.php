<?php

namespace App\Controllers;

use App\Models\Favori;

// On crée un tableau vide pour les erreurs.
$errors = [];

// On créer un tableau vide pour les bons messages.
$reussi = [];

// Classe FavorisController pour gérer les favoris, ainsi que les contrôles
class FavorisController
{
    /**
     * Méthode pour afficher tous les favoris en fonction de l'utilisateur qui s'est connecté
     * @return void Retoourne rien, c'est juste un affichage tout simple
     */
    public function index()
    {
        $favori = new Favori();
        $data = $favori->findByUser($_SESSION["user"]["id"]);
        require_once __DIR__ . "/../Views/favoris.php";
    }

    /**
     * Méthode pour ajouter un favori dans la liste après avoir appuyer sur un bouton
     * @param int $annonceId L'identifiant de l'annonce en question
     * @return void Retourne rien, c'est juste une méthode d'ajout
     */
    public function add(int $annonceId)
    {
        $favori = new Favori();
        $favori->addFavori($_SESSION["user"]["id"], $annonceId);
        echo "<script>window.location.href = 'index.php?url=favoris';</script>";
    }

    /**
     * Méthode pour supprimer un favoris en appuyant sur un bouton
     * @param int $annonceId L'identifiant de l'annonce en question
     * @return void Retourne rien, c'est juste une méthode d'ajout
     */
    public function remove(int $annonceId)
    {
        $favori = new Favori();
        $favori->removeFavori($_SESSION["user"]["id"], $annonceId);
        echo "<script>window.location.href = 'index.php?url=favoris';</script>";
    }
}