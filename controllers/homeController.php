<?php
// En controllers/homeController.php

class homeController {
    
    public function index() {
        require_once 'views/homeView.php';
    }

    public function profile() {
        require_once 'views/profileView.php';
    }

    // EJEMPLO DE DÓNDE VA EL EMPTY Y LA VALIDACIÓN:
    public function procesarRegistro() {
        // Supongamos que recibimos los campos del modal de registro
        $usuario = isset($_POST['usuario']) ? trim($_POST['usuario']) : '';
        $password = isset($_POST['password']) ? trim($_POST['password']) : '';

        // Aquí usamos la validación con empty()
        if (empty($usuario) || empty($password)) {
            // Si está vacío, creamos un mensaje de error
            $error = "¡No puedes dejar campos vacíos!";
            
            // Volvemos a cargar la vista mandando el error
            require_once 'views/homeView.php';
            return;
        }

        // Si pasó el empty(), aquí abajo se guarda en la base de datos...
    }
}