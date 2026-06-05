<?php
// controllers/postController.php

class PostController {

    public function create() {
        // 1. Validar que el usuario tenga sesión activa antes de dejarlo ver el formulario
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: /GolazoHub2/index.php?error=Inicia sesión para poder publicar.");
            exit();
        }

        // 2. Importamos e instanciamos el Modelo para poder consultar la Base de Datos
        require_once 'models/Post.php';
        $postModel = new Post();

        // 3. Consultamos las tablas mandando llamar a los métodos que creamos en el Paso 1
        $mundiales = $postModel->obtenerMundiales();
        $categorias = $postModel->obtenerCategorias();

        // 4. Cargamos la vista. Como las variables $mundiales y $categorias ya existen aquí,
        // la vista 'createPostView.php' podrá leerlas perfectamente.
        require_once 'views/components/createPostView.php';
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!isset($_SESSION['usuario_id'])) {
                header("Location: /GolazoHub2/index.php?error=Debes iniciar sesión para publicar.");
                exit();
            }

        $usuario_id = $_SESSION['usuario_id'];
        $mundial_id = isset($_POST['mundial_id']) ? intval($_POST['mundial_id']) : 0;
        $categoria_id = isset($_POST['categoria_id']) ? intval($_POST['categoria_id']) : 0;
        $titulo = isset($_POST['titulo']) ? trim($_POST['titulo']) : '';
        $contenido = isset($_POST['contenido']) ? trim($_POST['contenido']) : '';

        // Validaciones básicas obligatorias
        if (empty($titulo) || $mundial_id === 0 || $categoria_id === 0) {
            header("Location: /GolazoHub2/index.php?action=create_post&error=Campos obligatorios vacíos.");
            exit();
        }

        $multimediaData = null;
        $tipoMultimedia = null;

        // Validación de archivo multimedia
        if (isset($_FILES['multimedia']) && $_FILES['multimedia']['error'] == 0) {
            $fileTmpPath = $_FILES['multimedia']['tmp_name'];
            $fileSize = $_FILES['multimedia']['size'];
            $fileType = $_FILES['multimedia']['type'];

            if ($fileSize <= 16777216) { // Límite de 16MB para LONGBLOB
                $allowedMimeTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
                if (in_array($fileType, $allowedMimeTypes)) {
                    $multimediaData = file_get_contents($fileTmpPath);
                    $tipoMultimedia = $fileType;
                } else {
                    header("Location: /GolazoHub2/index.php?action=create_post&error=Formato no permitido. Usa JPG, PNG o GIF.");
                    exit();
                }
            } else {
                header("Location: /GolazoHub2/index.php?action=create_post&error=La imagen excede los 16MB.");
                exit();
            }
        }

        require_once 'models/Post.php';
        $postModel = new Post();
        $exito = $postModel->crear($usuario_id, $mundial_id, $categoria_id, $titulo, $contenido, $multimediaData, $tipoMultimedia);

        if ($exito) {
            header("Location: /GolazoHub2/index.php?success=Post publicado correctamente");
            exit();
        } else {
            header("Location: /GolazoHub2/index.php?action=create_post&error=Error interno al guardar en la Base de Datos.");
            exit();
        }
    }

        // Instanciar el modelo de Post e insertar los datos en la base de datos
        require_once 'models/Post.php';
        $postModel = new Post();

        $exito = $postModel->crear(
            $usuario_id, 
            $mundial_id, 
            $categoria_id, 
            $titulo, 
            $contenido, 
            $multimediaData, 
            $tipoMultimedia
        );

        if ($exito) {
            // Redirigir al feed principal con éxito
            header("Location: /GolazoHub/?success=Post publicado correctamente");
        } else {
            header("Location: /GolazoHub/posts/create?error=Error interno al guardar la publicación en la base de datos");
        }
        exit();
    }

    // 3. Renderizar la imagen BLOB directamente en las etiquetas <img>
    public function verImagen() {
        $id_post = isset($_GET['id']) ? intval($_GET['id']) : 0;
        if ($id_post === 0) exit();

        require_once 'models/Post.php';
        $postModel = new Post();
        $postData = $postModel->obtenerImagen($id_post);

        if ($postData && !empty($postData['multimedia'])) {
            // Mandamos los headers correspondientes para que el navegador sepa que es una imagen real
            header("Content-Type: " . $postData['tipo_multimedia']);
            echo $postData['multimedia'];
        }
        exit();
    }
}