<?php

// 1. Cargamos las dependencias globales arriba de la clase para que todas las funciones las hereden
require_once 'config/Database.php';
require_once 'models/Usuario.php';

class homeController {
    
    public function index() {
        require_once 'views/homeView.php';
    }

    public function profile() {
        require_once 'views/profileView.php';
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Recibir y limpiar datos con trim()
            $user = isset($_POST['usuario']) ? trim($_POST['usuario']) : '';
            $email = isset($_POST['correo']) ? trim($_POST['correo']) : ''; 
            $pass = isset($_POST['password']) ? trim($_POST['password']) : '';

            // VALIDACIÓN CON EMPTY
            if (empty($user) || empty($email) || empty($pass)) {
                header("Location: /GolazoHub/?error=campos_vacios");
                exit();
            }

            // Intentar registrar en la BD a través del Modelo
            $usuarioModel = new Usuario();
            if ($usuarioModel->registrar($user, $email, $pass)) {
                header("Location: /GolazoHub/?success=registro_exitoso");
            } else {
                header("Location: /GolazoHub/?error=usuario_duplicado");
            }
            exit();
        }
    }

    public function autenticar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Activamos las sesiones si es que no se han iniciado antes
            if (session_status() === PHP_SESSION_NONE) { 
                session_start(); 
            }

            $user_input = isset($_POST['usuario_login']) ? trim($_POST['usuario_login']) : '';
            $pass_input = isset($_POST['password_login']) ? trim($_POST['password_login']) : '';

            // VALIDACIÓN CON EMPTY
            if (empty($user_input) || empty($pass_input)) {
                header("Location: /GolazoHub/?error=campos_vacios_login");
                exit();
            }

            // Ahora sí encuentra la clase Usuario porque está importada arriba de todo
            $usuarioModel = new Usuario();
            $userData = $usuarioModel->login($user_input);

            // Si el usuario existe, verificamos la contraseña encriptada
            if ($userData && password_verify($pass_input, $userData['password'])) {
                // ¡ÉXITO! Guardamos los datos clave en la sesión del servidor
                $_SESSION['usuario_id'] = $userData['id'];
                $_SESSION['usuario_nombre'] = $userData['usuario'];
                $_SESSION['usuario_rol'] = $userData['rol'];

                header("Location: /GolazoHub/?success=bienvenido");
            } else {
                // Credenciales incorrectas
                header("Location: /GolazoHub/?error=datos_incorrectos");
            }
            exit();
        }
    }

    // Dentro de controllers/homeController.php

    public function cambiarFoto() {
        if (session_status() === PHP_SESSION_NONE) { session_start(); }
        
        // Verificamos que esté logueado y que venga un archivo válido
        if (isset($_SESSION['usuario_id']) && isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) {
            $tipo_mime = $_FILES['avatar']['type'];
            
            // Validamos con empty o filtros que sea una imagen real
            if (strpos($tipo_mime, 'image/') === 0) {
                $contenido_binario = file_get_contents($_FILES['avatar']['tmp_name']);
                
                $usuarioModel = new Usuario();
                $usuarioModel->actualizarAvatar($_SESSION['usuario_id'], $contenido_binario, $tipo_mime);
            }
        }
        header("Location: /GolazoHub/");
        exit();
    }

public function verAvatar() {
    // Limpiamos cualquier espacio en blanco o eco previo que pueda corromper la imagen
    if (ob_get_length()) ob_clean();

    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    
    // Nos aseguramos de que el modelo esté instanciado correctamente
    $usuarioModel = new Usuario();
    $userData = $usuarioModel->obtenerAvatar($id);

    // Si el usuario existe y tiene una foto en la BD, la renderizamos
    if ($userData && !empty($userData['avatar'])) {
        header("Content-Type: " . $userData['tipo_avatar']);
        echo $userData['avatar'];
    } else {
        // SVG por defecto corregido y limpio sin caracteres raros
        header("Content-Type: image/svg+xml");
        echo '<?xml version="1.0" encoding="utf-8"?><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#888888"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>';
    }
    exit();
}

    public function logout() {
        if (session_status() === PHP_SESSION_NONE) { session_start(); }
        session_destroy(); // Destruye la sesión borrando el login
        header("Location: /GolazoHub/");
        exit();
    }
}