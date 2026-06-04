<?php
// config/Database.php

class Database {
    private $host = "localhost";
    private $db_name = "golazohub";
    private $username = "root";
    private $password = ""; // En XAMPP/MAMP por defecto viene vacío
    private $conn;

    public function conectar() {
        $this->conn = null;

        try {
            // Inicializamos la conexión forzando codificación UTF8MB4 (Para que soporte emojis de banderas y balones)
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8mb4",
                $this->username,
                $this->password
            );
            
            // Le indicamos a PDO que dispare excepciones claras si hay algún error en las consultas SQL
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Configuramos para que por defecto nos devuelva los datos en arreglos asociativos limpios
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            
        } catch(PDOException $exception) {
            echo "Error crítico en la conexión a la Base de Datos: " . $exception->getMessage();
        }

        return $this->conn;
    }
}