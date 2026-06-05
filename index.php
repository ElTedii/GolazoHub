<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@7.2.3/css/flag-icons.min.css"/>
<?php
// index.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 1. Importar los controladores obligatorios
require_once 'controllers/homeController.php';
require_once 'controllers/postController.php';

$homeCtrl = new homeController();
$postCtrl = new PostController();

// 2. Capturar la acción por URL (?action=...)
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// 3. EL ENRUTADOR DEFINITIVO
if ($action == 'register') {
    $homeCtrl->register();
} elseif ($action == 'login') {
    $homeCtrl->autenticar();
} elseif ($action == 'logout') {
    $homeCtrl->logout();
} elseif ($action == 'profile') {
    $homeCtrl->profile();
} elseif ($action == 'cambiar_foto') {
    $homeCtrl->cambiarFoto();
} elseif ($action == 'ver_avatar') {
    $homeCtrl->verAvatar();
} 
// --- RUTAS DE PUBLICACIONES Y VOTACIÓN ---
elseif ($action == 'create_post') {
    $postCtrl->create(); // Muestra el formulario
} elseif ($action == 'store_post') {
    $postCtrl->store();  // Procesa y guarda el post en la BD
} elseif ($action == 'ver_imagen_post') {
    $postCtrl->verImagen(); // Renderiza imágenes BLOB
} elseif ($action == 'vote_post') {
    // Aquí irá tu método o lógica de votación posterior
    header("Location: /GolazoHub2/");
} else {
    $homeCtrl->index();
}
