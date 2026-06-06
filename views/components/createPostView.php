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

                <form action="/GolazoHub/index.php?action=store_post" method="POST" enctype="multipart/form-data" class="create-post-form">
                    <div class="form-group-select">
                        <label>Mundial Asociado</label>
                        <select name="mundial_id" id="mundial_id">
                            <option value="">-- Selecciona un Mundial --</option>
                            <?php if (isset($mundiales) && is_array($mundiales)): ?>
                                <?php foreach ($mundiales as $mundial): ?>
                                    <option value="<?= htmlspecialchars($mundial['id']); ?>">
                                        <?= htmlspecialchars($mundial['nombre'] ?? 'Sin nombre'); ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="form-group-select">
                        <label for="categoria_id">Categoría del Debate</label>
                        <select name="categoria_id" id="categoria_id" required>
                            <option value="">-- Selecciona una Categoría --</option>

                            <?php if (isset($categorias) && is_array($categorias)): ?>
                                <?php foreach ($categorias as $c): ?>
                                    <option value="<?= $c['id']; ?>">
                                        <?= htmlspecialchars($c['nombre']); ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>

                        </select>
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
                        <button type="button" class="btn-   ondary" onclick="window.location.href='/GolazoHub/'" style="padding: 10px 20px;">Cancelar</button>
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