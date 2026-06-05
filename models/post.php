<?php
// models/Post.php

class Post {
    private $db;

    public function __construct() {
        // Instanciamos la clase de configuración e invocamos el método correcto: conectar()
        $database = new Database();
        $this->db = $database->conectar(); 
    }

    public function crear($usuario_id, $mundial_id, $categoria_id, $titulo, $contenido, $multimedia, $tipo_multimedia) {
        try {
            $query = "INSERT INTO posts (usuario_id, mundial_id, categoria_id, titulo, contenido, multimedia, tipo_multimedia) 
            VALUES (:usuario_id, :mundial_id, :categoria_id, :titulo, :contenido, :multimedia, :tipo_multimedia)";
            
            $stmt = $this->db->prepare($query);
            
            $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
            $stmt->bindParam(':mundial_id', $mundial_id, PDO::PARAM_INT);
            $stmt->bindParam(':categoria_id', $categoria_id, PDO::PARAM_INT);
            $stmt->bindParam(':titulo', $titulo, PDO::PARAM_STR);
            $stmt->bindParam(':contenido', $contenido, PDO::PARAM_STR);
            
            // PDO::PARAM_LOB le dice explícitamente a MySQL que va a recibir un archivo binario pesado (Stream/Blob)
            $stmt->bindParam(':multimedia', $multimedia, PDO::PARAM_LOB);
            $stmt->bindParam(':tipo_multimedia', $tipo_multimedia, PDO::PARAM_STR);

            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function obtenerImagen($id_post) {
        try {
            $query = "SELECT multimedia, tipo_multimedia FROM posts WHERE id = :id LIMIT 1";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id_post, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function obtenerTodos() {
    try {
        // Hacemos INNER JOINs para jalar el nombre del autor, la categoría y el mundial al mismo tiempo
        $query = "SELECT 
                    p.id, 
                    p.titulo, 
                    p.contenido, 
                    p.tipo_multimedia, 
                    p.fecha_creacion,
                    u.usuario AS autor_nombre,
                    c.nombre AS categoria_nombre,
                    m.nombre AS mundial_nombre,
                    (SELECT COUNT(*) FROM votos v WHERE v.post_id = p.id AND v.tipo_voto = 'up') AS upvotes,
                    (SELECT COUNT(*) FROM votos v WHERE v.post_id = p.id AND v.tipo_voto = 'down') AS downvotes
                    FROM posts p
                    INNER JOIN usuarios u ON p.usuario_id = u.id
                    INNER JOIN categorias c ON p.categoria_id = c.id
                    INNER JOIN mundiales m ON p.mundial_id = m.id
                    ORDER BY p.fecha_creacion DESC"; 

        $stmt = $this->db->prepare($query);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    public function obtenerMundiales() {
        $sql = "SELECT * FROM mundiales";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

        public function obtenerCategorias() {
        $sql = "SELECT * FROM categorias";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}