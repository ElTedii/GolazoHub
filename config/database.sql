CREATE DATABASE IF NOT EXISTS golazohub CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE golazohub;

-- 1. TABLA DE USUARIOS
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    correo VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL, -- Almacenará la contraseña encriptada con password_hash()
    rol ENUM('usuario', 'admin') DEFAULT 'usuario',
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- 2. TABLA DE MUNDIALES
CREATE TABLE mundiales (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL, -- Ej. 'Catar 2022'
    codigo_bandera VARCHAR(10) NOT NULL -- Emoji de la bandera para ahorrar espacio visual
) ENGINE=InnoDB;

-- 3. TABLA DE CATEGORÍAS (Filtros de debate)
CREATE TABLE categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL -- Ej. 'Polémicas Históricas', 'Debate Táctico'
) ENGINE=InnoDB;

-- 4. TABLA DE PUBLICACIONES (POSTS)
CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    mundial_id INT NOT NULL,
    categoria_id INT NOT NULL,
    titulo VARCHAR(150) NOT NULL,
    contenido TEXT NULL,
    multimedia LONGBLOB NULL, 
    tipo_multimedia VARCHAR(50) NULL, -- Guarda el tipo MIME (Ej. 'image/png', 'image/jpeg') para poder renderizarlo después
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (mundial_id) REFERENCES mundiales(id) ON DELETE CASCADE,
    FOREIGN KEY (categoria_id) REFERENCES categorias(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- 5. TABLA DE COMENTARIOS ANIDADOS (Hilos estilo Reddit)
CREATE TABLE comentarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    post_id INT NOT NULL,
    usuario_id INT NOT NULL,
    comentario_parent_id INT NULL, -- Si es NULL es comentario raíz; si tiene ID, es respuesta a otro
    contenido TEXT NOT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (comentario_parent_id) REFERENCES comentarios(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- 6. TABLA DE VOTOS (Evita duplicados usando llave primaria compuesta)
CREATE TABLE votos (
    usuario_id INT NOT NULL,
    post_id INT NOT NULL,
    tipo_voto ENUM('up', 'down') NOT NULL,
    PRIMARY KEY (usuario_id, post_id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- ====================================================
-- SEEDERS (Datos base indispensables para pruebas iniciales)
-- ====================================================
INSERT INTO mundiales (nombre, codigo_bandera) VALUES 
('Catar 2022', '🇶🇦'),
('Rusia 2018', '🇷🇺'),
('Brasil 2014', '🇧🇷'),
('Sudáfrica 2010', '🇿🇦');

INSERT INTO categorias (nombre) VALUES 
('Polémicas Históricas'),
('Debate Táctico'),
('Memes Futboleros'),
('Análisis En Vivo');