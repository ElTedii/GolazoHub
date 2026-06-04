<?php
require_once 'config/Database.php';

class Usuario {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->conectar();
    }

    public function registrar($user, $email, $pass) {
        try {
            // 1. Encriptar la contraseña (Regla de oro de seguridad)
            $pass_hash = password_hash($pass, PASSWORD_BCRYPT);

            // 2. Preparar la consulta
            $query = "INSERT INTO usuarios (usuario, correo, password) VALUES (:user, :email, :pass)";
            $stmt = $this->db->prepare($query);

            // 3. Vincular datos (Protección contra Inyección SQL)
            $stmt->bindParam(':user', $user);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':pass', $pass_hash);

            return $stmt->execute();
        } catch (PDOException $e) {
            // Si el correo o usuario ya existen, saltará un error aquí
            return false;
        }
    } 

    public function login($user_or_email) {
        try {
            // Buscamos al usuario ya sea por su nombre de usuario o por su correo
            $query = "SELECT * FROM usuarios WHERE usuario = :user OR correo = :email LIMIT 1";
            $stmt = $this->db->prepare($query);
            
            $stmt->bindParam(':user', $user_or_email);
            $stmt->bindParam(':email', $user_or_email);
            $stmt->execute();

            // Si encuentra al usuario, nos devuelve toda su fila (id, usuario, password, rol...)
            return $stmt->fetch(); 
        } catch (PDOException $e) {
            return false;
        }
    } 

    // Dentro de models/Usuario.php

public function actualizarAvatar($id_usuario, $contenido_binario, $tipo_mime) {
    try {
        // Como no creamos columna avatar en la tabla usuarios originalmente, 
        // podemos añadirla rápido en la BD o usar una consulta dinámica si alteraste la tabla.
        // CORRE ESTA LÍNEA EN TU PHP_MYADMIN SI DA ERROR: ALTER TABLE usuarios ADD COLUMN avatar LONGBLOB NULL, ADD COLUMN tipo_avatar VARCHAR(50) NULL;
        
        $query = "UPDATE usuarios SET avatar = :avatar, tipo_avatar = :tipo WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':avatar', $contenido_binario, PDO::PARAM_LOB);
        $stmt->bindParam(':tipo', $tipo_mime);
        $stmt->bindParam(':id', $id_usuario);
        return $stmt->execute();
    } catch (PDOException $e) {
        return false;
    }
}

public function obtenerAvatar($id_usuario) {
    try {
        $query = "SELECT avatar, tipo_avatar FROM usuarios WHERE id = :id LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id_usuario);
        $stmt->execute();
        return $stmt->fetch();
    } catch (PDOException $e) {
        return false;
    }
}

}