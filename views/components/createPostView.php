<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Crear Publicación - GolazoHub</title>
        <link rel="stylesheet" href="/GolazoHub/assets/css/styles.css?v=7">
        <script src="https://unpkg.com/lucide@latest"></script>
    </head>
    <body>

        <?php include 'View/header.php'; ?>

        <div class="dashboard-grid">
            
            <div class="grid-col-left">
                <?php include 'View/sidebar_left.php'; ?>
            </div>

            <main class="main-feed">
                
                <div class="create-post-container">
                    <h1 class="create-title">Crear una publicación</h1>
                    
                    <form action="/GolazoHub/posts/store" method="POST" enctype="multipart/form-data" class="create-post-form">
                        
                        <div class="form-row-selectors">
                            <div class="form-group-select">
                                <label for="post_mundial">¿En qué Mundial entra?</label>
                                <select id="post_mundial" name="mundial_id" required>
                                    <option value="" disabled selected>Elige un Mundial...</option>
                                    <option value="1">🇶🇦 Catar 2022</option>
                                    <option value="2">🇷🇺 Rusia 2018</option>
                                    <option value="3">🇧🇷 Brasil 2014</option>
                                    <option value="4">🇿🇦 Sudáfrica 2010</option>
                                </select>
                            </div>

                            <div class="form-group-select">
                                <label for="post_categoria">Categoría del debate</label>
                                <select id="post_categoria" name="categoria_id" required>
                                    <option value="" disabled selected>Elige una categoría...</option>
                                    <option value="1">Polémicas Históricas</option>
                                    <option value="2">Debate Táctico</option>
                                    <option value="3">Memes Futboleros</option>
                                    <option value="4">Análisis En Vivo</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group-fields">
                            <label Land for="post_title">Título</label>
                            <input type="text" id="post_title" name="titulo" maxlength="150" placeholder="Escribe un título descriptivo e interesante..." required>
                        </div>

                        <div class="form-group-fields">
                            <label for="post_content">Cuerpo del debate (Opcional)</label>
                            <textarea id="post_content" name="contenido" rows="5" placeholder="Expande tu argumento, haz preguntas o añade contexto aquí..."></textarea>
                        </div>

                        <div class="form-group-fields">
                            <label>Añadir Imagen o Video</label>
                            <div class="upload-dropzone" onclick="document.getElementById('file_input').click()">
                                <i data-lucide="upload-cloud" class="upload-icon"></i>
                                <p class="upload-text">Haz clic aquí para subir una imagen o video para tu debate</p>
                                <span class="upload-subtext">Archivos permitidos: JPG, PNG, MP4 (Máx. 10MB)</span>
                                <input type="file" id="file_input" name="multimedia" accept="image/*,video/*" style="display: none;" onchange="updateFileName(this)">
                                <div id="file_name_preview" class="file-preview-name"></div>
                            </div>
                        </div>

                        <div class="form-actions-submit">
                            <a href="/GolazoHub/" class="btn-secondary" style="text-decoration: none; display: inline-block; text-align: center;">Cancelar</a>
                            <button type="submit" class="btn-primary">Publicar</button>
                        </div>

                    </form>
                </div>

            </main>

            <div class="grid-col-right">
                <?php include 'View/sidebar_right.php'; ?>
            </div>

        </div>

        <?php include 'View/auth_modal.php'; ?>

        <script>
            lucide.createIcons();

            // Pequeño script para mostrar el nombre del archivo seleccionado
            function updateFileName(input) {
                const preview = document.getElementById('file_name_preview');
                if (input.files && input.files[0]) {
                    preview.textContent = "Archivo seleccionado: " + input.files[0].name;
                    preview.style.display = "block";
                } else {
                    preview.textContent = "";
                    preview.style.display = "none";
                }
            }
        </script>
    </body>
</html>