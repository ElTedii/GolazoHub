<?php
// index.php (Raíz del proyecto)

// 1. Cargar configuraciones globales si las hay (como la base de datos más adelante)

// 2. Importar el controlador encargado de la página de inicio
require_once 'controllers/homeController.php';

// 3. Instanciar el controlador y ejecutar su acción principal
$controller = new homeController();
$controller->index();