<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@7.2.3/css/flag-icons.min.css"/>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 1. CARGA GLOBAL DE CONFIGURACIÓN Y BASE DE DATOS
require_once 'config/database.php'; 

// 2. IMPORTACIÓN DE CONTROLADORES
require_once 'controllers/homeController.php';
require_once 'controllers/postController.php';
require_once 'models/usuario.php';

$homeCtrl = new homeController();
$postCtrl = new PostController();

// 3. CAPTURA DE ACCIÓN
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// 4. ENRUTADOR SEGURO
if ($action == 'register') {
    $homeCtrl->register();
} elseif ($action == 'login') {
    $homeCtrl->autenticar();
} elseif ($action == 'logout') {
    $homeCtrl->logout();
} elseif ($action == 'profile') {
    $homeCtrl->profile();
} elseif ($action == 'create_post') {
    $postCtrl->create();
} elseif ($action == 'store_post') {
    $postCtrl->store();
} elseif ($action == 'ver_imagen_post') {
    $postCtrl->verImagen();
} elseif ($action == 'ver_avatar') {
    $homeCtrl->verAvatar();
} elseif ($action == 'cambiar_foto') {
    $homeCtrl->cambiarFoto();
} elseif ($action == 'perfil') {
    $homeCtrl->perfil();
} else {
    // Acción por defecto (Inicio)
    $homeCtrl->index();
}