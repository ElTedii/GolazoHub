<?php
// controllers/HomeController.php

class HomeController {
    
    public function index() {
        // MÁS ADELANTE: Aquí llamaremos al Modelo para traer las publicaciones de la BD
        // $publicaciones = Publicacion::obtenerTodas();
        
        // Por ahora, el controlador simplemente manda llamar a la vista principal
        require_once 'views/homeView.php';
    }
}