<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@7.2.3/css/flag-icons.min.css"/>
<?php
// 1. Iniciar la sesión al principio de todo (Obligatorio para el Login)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 2. Importar el controlador encargado de las páginas
require_once 'controllers/homeController.php';

// 3. Instanciar el controlador
$controller = new homeController();

// 4. Capturar qué acción quiere hacer el usuario por la URL (?action=...)
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// 5. EL ENRUTADOR: Evaluamos la acción ANTES de cargar cualquier vista
if ($action == 'register') {
    $controller->register();
} elseif ($action == 'login') {
    $controller->autenticar();
} elseif ($action == 'cambiar_foto') {
    $controller->cambiarFoto(); // <--- NUEVA
} elseif ($action == 'ver_avatar') {
    $controller->verAvatar();   // <--- NUEVA
} elseif ($action == 'logout') {
    $controller->logout();       // <--- NUEVA
} elseif ($action == 'profile') {
    $controller->profile();
} else {
    $controller->index();
}
