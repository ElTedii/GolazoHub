<?php
// controllers/postController.php

class PostController {
    
    // 1. Mostrar la vista para crear una publicación
    public function create() {
        // Validación de seguridad por si intentan entrar tecleando la URL sin loguearse
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: /GolazoHub/index.php?error=Debes iniciar sesión para publicar");
            exit();
        }
        
        // Cargamos la vista del formulario
        require_once 'views/createPostView.php';
    }

    // 2. Procesar el formulario y guardar el Post en la Base de Datos
    public function store() {
        // Asegurar que la petición venga por POST y el usuario esté autenticado
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_SESSION['usuario_id'])) {
            header("Location: /GolazoHub/");
            exit();
        }

        // Sanitizar y recibir los datos del formulario de createPostView.php
        $usuario_id   = $_SESSION['usuario_id'];
        $mundial_id   = isset($_POST['mundial_id']) ? intval($_POST['mundial_id']) : 0;
        $categoria_id = isset($_POST['categoria_id']) ? intval($_POST['categoria_id']) : 0;
        $titulo       = isset($_POST['titulo']) ? trim($_POST['titulo']) : '';
        $contenido    = isset($_POST['contenido']) ? trim($_POST['contenido']) : null;

        // Variables por defecto para el archivo binario BLOB
        $multimediaData = null;
        $tipoMultimedia = null;

        // Validar que el título obligatorio no venga vacío
        if (empty($titulo)) {
            header("Location: /GolazoHub/posts/create?error=El título es obligatorio");
            exit();
        }

        // Procesar el archivo multimedia si el usuario subió uno
        if (isset($_FILES['multimedia']) && $_FILES['multimedia']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['multimedia']['tmp_name'];
            $fileSize    = $_FILES['multimedia']['size'];
            $fileType    = $_FILES['multimedia']['type'];

            // Tu base de datos soporta hasta 16MB (LONGBLOB), validamos el tamaño por seguridad (16MB = 16777216 bytes)
            if ($fileSize <= 16777216) {
                // Tipos permitidos según tu formulario: JPG, PNG, GIF
                $allowedMimeTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
                
                if (in_array($fileType, $allowedMimeTypes)) {
                    // Convertimos la imagen temporal en una cadena de bytes binaria para el BLOB
                    $multimediaData = file_get_contents($fileTmpPath);
                    $tipoMultimedia = $fileType;
                } else {
                    header("Location: /GolazoHub/posts/create?error=Formato de imagen no permitido. Usa JPG, PNG o GIF.");
                    exit();
                }
            } else {
                header("Location: /GolazoHub/posts/create?error=La imagen excede el límite máximo de 16MB.");
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