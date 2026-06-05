<?php

// 1. Cargamos las dependencias globales arriba de la clase para que todas las funciones las hereden
require_once 'config/Database.php';
require_once 'models/Usuario.php';

class homeController {

    public function index() {
        require_once 'models/Post.php';
        $postModel = new Post();

        // 1. Detectar si hay filtros activos en la URL
        $mundial_id = isset($_GET['mundial_id']) ? intval($_GET['mundial_id']) : null;
        $categoria_id = isset($_GET['categoria_id']) ? intval($_GET['categoria_id']) : null;

        // 2. Traer los posts (filtrados o todos)
        if ($mundial_id) {
            // Puedes crear este método en tu modelo o pasarle los filtros a obtenerTodos
            $posts = $postModel->obtenerTodos($mundial_id, null);
        } elseif ($categoria_id) {
            $posts = $postModel->obtenerTodos(null, $categoria_id);
        } else {
            $posts = $postModel->obtenerTodos();
        }

        // 3. Traer los catálogos para el sidebar
        $mundiales = $postModel->obtenerMundiales();
        $categorias = $postModel->obtenerCategorias();

        // Cargamos la vista principal
        require_once 'views/homeView.php';
    }

    public function profile() {

            // 1. Verificamos que el usuario esté logueado
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: /GolazoHub/");
            exit();
        }

        // 2. Instanciamos el modelo y traemos los datos
        $usuarioModel = new Usuario();
        $usuario = $usuarioModel->obtenerUsuarioPorId($_SESSION['usuario_id']);

        // 3. Pasamos la variable $usuario a la vista
        require_once 'views/components/profileView.php';
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

    public function cambiarFoto() {
        if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === 0) {
            $contenido = file_get_contents($_FILES['avatar']['tmp_name']);
            $tipo = $_FILES['avatar']['type'];
            $usuarioModel = new Usuario();
            $usuarioModel->actualizarAvatar($_SESSION['usuario_id'], $contenido, $tipo);
        }
        // Redirección limpia
        header("Location: /GolazoHub/index.php?action=profile");
        exit();
    }

    public function verAvatar() {
        // Si no hay ID, no hacemos nada
        if (!isset($_GET['id'])) return;
        
        $id = intval($_GET['id']);
        $usuarioModel = new Usuario();
        $avatar = $usuarioModel->obtenerAvatar($id);
        
        if ($avatar && !empty($avatar['avatar'])) {
            $tipo = !empty($avatar['tipo_avatar']) ? $avatar['tipo_avatar'] : 'image/jpeg';
            
            // Limpiamos cualquier salida previa para que la imagen salga pura
            if (ob_get_length()) ob_clean();
            
            header("Content-Type: " . $tipo);
            echo $avatar['avatar'];
            exit(); // ESTE EXIT ES OBLIGATORIO
        }
    }

    public function logout() {
        if (session_status() === PHP_SESSION_NONE) { session_start(); }
        session_destroy(); // Destruye la sesión borrando el login
        header("Location: /GolazoHub/");
        exit();
    }
}