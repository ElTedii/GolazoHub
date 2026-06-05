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

    public function actualizarAvatar($id_usuario, $contenido_binario, $tipo_mime) {
        // Usamos los nombres reales de TU base de datos: 'avatar' y 'tipo_avatar'
        $stmt = $this->db->prepare("UPDATE usuarios SET avatar = :contenido, tipo_avatar = :tipo WHERE id = :id");
        return $stmt->execute([
            ':contenido' => $contenido_binario,
            ':tipo' => $tipo_mime,
            ':id' => $id_usuario
        ]);
    }

    public function obtenerAvatar($id_usuario) {
        // Usamos los nombres reales de TU base de datos
        $stmt = $this->db->prepare("SELECT avatar, tipo_avatar FROM usuarios WHERE id = :id");
        $stmt->execute([':id' => $id_usuario]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function obtenerUsuarioPorId($id) {
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}