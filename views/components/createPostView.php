<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Crear una Publicación - GolazoHub</title>
        <link rel="stylesheet" href="/GolazoHub/assets/css/styles.css?v=25">
        <script src="https://unpkg.com/lucide@latest"></script>
    </head>
    <body>

        <?php include 'views/components/header.php'; ?>

        <div class="dashboard-grid">
            
            <div class="grid-col-left">
                <?php include 'views/components/sideBarLeft.php'; ?>
            </div>

            <main class="main-feed">
                
                <div style="margin-bottom: 20px; padding-left: 4px;">
                    <h2 style="font-size: 1.4rem; font-weight: bold; color: var(--text-primary); margin: 0;">Crear una publicación</h2>
                </div>

                <form action="/GolazoHub/posts/store" method="POST" enctype="multipart/form-data" class="post-card" style="padding: 24px; display: flex; flex-direction: column; gap: 20px;">
                    
                    <div style="display: flex; gap: 16px; flex-wrap: wrap;">
                        <div class="form-group" style="flex: 1; min-width: 180px;">
                            <label style="font-size: 0.85rem; font-weight: 600; color: var(--text-muted); margin-bottom: 6px; display: block;">Seleccionar Comunidad</label>
                            <select name="mundial_id" required style="background-color: var(--bg-main); border: 1px solid var(--border-color); border-radius: 8px; padding: 10px; color: var(--text-primary); width: 100%; outline: none;">
                                <option value="1">🇶🇦 Catar 2022</option>
                                <option value="2">🇷🇺 Rusia 2018</option>
                                <option value="3">🇧🇷 Brasil 2014</option>
                                <option value="4">🇿🇦 Sudáfrica 2010</option>
                            </select>
                        </div>

                        <div class="form-group" style="flex: 1; min-width: 180px;">
                            <label style="font-size: 0.85rem; font-weight: 600; color: var(--text-muted); margin-bottom: 6px; display: block;">Categoría de Debate</label>
                            <select name="categoria_id" required style="background-color: var(--bg-main); border: 1px solid var(--border-color); border-radius: 8px; padding: 10px; color: var(--text-primary); width: 100%; outline: none;">
                                <option value="1">Polémicas Históricas</option>
                                <option value="2">Debate Táctico</option>
                                <option value="3">Memes Futboleros</option>
                                <option value="4">Análisis En Vivo</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="post_title" style="font-size: 0.85rem; font-weight: 600; color: var(--text-muted); margin-bottom: 6px; display: block;">Título</label>
                        <input type="text" id="post_title" name="titulo" placeholder="¿Qué polémica o partido quieres debatir?" required style="background-color: var(--bg-main); border: 1px solid var(--border-color); border-radius: 8px; padding: 12px; color: var(--text-primary); width: 100%; box-sizing: border-box; outline: none; font-size: 0.95rem;">
                    </div>

                    <div class="form-group">
                        <label id="post_content" style="font-size: 0.85rem; font-weight: 600; color: var(--text-muted); margin-bottom: 6px; display: block;">Cuerpo del argumento (Opcional)</label>
                        <textarea name="contenido" placeholder="Escribe aquí el contexto, datos o tu opinión detallada..." style="background-color: var(--bg-main); border: 1px solid var(--border-color); border-radius: 8px; padding: 12px; color: var(--text-primary); width: 100%; box-sizing: border-box; min-height: 120px; resize: vertical; outline: none; font-family: inherit; font-size: 0.95rem;"></textarea>
                    </div>

                    <div class="form-group">
                        <label style="font-size: 0.85rem; font-weight: 600; color: var(--text-muted); margin-bottom: 6px; display: block;">
                            <i data-lucide="image" style="width: 14px; height: 14px; vertical-align: middle; margin-right: 4px;"></i> Adjuntar Imagen o Evidencia Multimedia
                        </label>
                        <div style="border: 2px dashed var(--border-color); border-radius: 8px; padding: 20px; text-align: center; background-color: var(--bg-main); position: relative; transition: border-color 0.2s;">
                            <i data-lucide="upload-cloud" style="width: 36px; height: 36px; color: var(--text-muted); margin-bottom: 8px;"></i>
                            <p style="font-size: 0.85rem; color: var(--text-muted); margin: 0 0 10px 0;">Formatos permitidos: JPG, PNG, GIF (Máx. 16MB para BLOB)</p>
                            <input type="file" name="multimedia" accept="image/*" style="cursor: pointer; font-size: 0.85rem; color: var(--text-muted);">
                        </div>
                    </div>

                    <div style="display: flex; justify-content: flex-end; gap: 12px; border-top: 1px solid var(--border-color); padding-top: 16px; margin-top: 8px;">
                        <button type="button" class="btn-secondary" onclick="window.location.href='/GolazoHub/'" style="padding: 10px 20px;">Cancelar</button>
                        <button type="submit" class="btn-primary" style="padding: 10px 24px;">Publicar</button>
                    </div>

                </form>

            </main>

            <div class="grid-col-right">
                <?php include 'views/components/sideBarRight.php'; ?>
            </div>

        </div>

        <?php include 'views/components/authModal.php'; ?>

        <script>
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        </script>
    </body>
</html>