<?php
// controllers/HomeController.php

class HomeController {
    
    public function index() {
        // El controlador solo se encarga de mandar llamar a la vista
        require_once 'views\homeView.php';
    }
}