<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>GolazoHub - Estilo Reddit Mundial</title>
        <link rel="stylesheet" href="/GolazoHub/assets/css/styles.css?v=1">
        <script src="https://unpkg.com/lucide@latest"></script>
    </head>
    <body>

        <?php include 'views/components/header.php'; ?>

        <div class="dashboard-grid">
            
            <div class="grid-col-left">
                <?php include 'views/components/sidebarLeft.php'; ?>
            </div>

            <main class="main-feed">
                <?php 
                    // Evaluamos dinámicamente si la variable $posts existe y tiene elementos
                    $hay_posts = (isset($posts) && is_array($posts) && count($posts) > 0); 
                ?>

                <?php if ($hay_posts == false): ?>
                    <div class="post-card" style="padding: 40px 20px; text-align: center; display: flex; flex-direction: column; align-items: center; justify-content: center; min-height: 250px;">
                        <div style="background-color: var(--bg-main); width: 64px; height: 64px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 16px; border: 1px solid var(--border-color);">
                            <i data-lucide="frown" style="width: 32px; height: 32px; color: var(--text-muted);"></i>
                        </div>
                        <h3 style="margin: 0 0 8px 0; color: var(--text-primary); font-size: 1.1rem;">No hay debates en esta comunidad</h3>
                        <p style="margin: 0 0 20px 0; color: var(--text-muted); font-size: 0.9rem; max-width: 320px;">Sé el primero en encender la polémica compartiendo tus argumentos.</p>
                    </div>

                <?php else: ?>
                    
                    <?php foreach ($posts as $post): ?>
                        <div class="post-card">
                            
                            <div class="post-voting">
                                <button class="vote-btn"><i data-lucide="arrow-up"></i></button>
                                <span class="vote-count">0</span>
                                <button class="vote-btn"><i data-lucide="arrow-down"></i></button>
                            </div>

                            <div class="post-content-area">
                                
                                <div class="post-meta">
                                    <span class="category-badge">Debate</span>
                                </div>

                                <h3 class="post-title"><?= htmlspecialchars($post['titulo']); ?></h3>
                                
                                <?php if (!empty($post['contenido'])): ?>
                                    <p class="post-body-text"><?= htmlspecialchars($post['contenido']); ?></p>
                                <?php endif; ?>

                                <?php if (!empty($post['tipo_multimedia'])): ?>
                                    <div class="post-media-container">
                                        <img src="/GolazoHub/index.php?action=ver_imagen_post&id=<?= $post['id']; ?>" alt="Evidencia" class="post-media">
                                    </div>
                                <?php endif; ?>
                                
                                <div class="post-footer">
                                    <button class="footer-action-btn">
                                        <i data-lucide="message-square"></i> Comentarios
                                    </button>
                                </div>

                            </div>
                        </div>
                    <?php endforeach; ?>

                <?php endif; ?>

                </main>

            <div class="grid-col-right">
                <?php include 'views/components/sidebarRight.php'; ?>
            </div>

        </div>

        <footer class="main-footer">
            <div class="footer-container">
                <a href="https://github.com/ElTedii" target="_blank" rel="noopener noreferrer" class="footer-brand-link">
                    <img src="assets\images\logo-minimal.png" alt="Desarrollado por Ismael Cruz" class="footer-image">
                </a>
            </div>
        </footer>

        <script>
            lucide.createIcons();
        </script>
        
        <?php include 'views/components/authModal.php'; ?>

        <script>
            // Inicializar iconos de Lucide si es necesario
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }

            // CONTROL DEL MODAL DE AUTENTICACIÓN
            const modal = document.getElementById('authModal');

            function openAuthModal(section) {
                if (modal) {
                    switchAuthSection(section);
                    modal.style.display = 'flex'; // Cambiado a flex para centrar la caja
                } else {
                    console.error("No se encontró el elemento #authModal");
                }
            }

            function closeAuthModal() {
                if (modal) {
                    modal.style.display = 'none'; // Lo ocultamos por completo
                }
            }

            function switchAuthSection(section) {
                const loginSec = document.getElementById('loginSection');
                const regSec = document.getElementById('registerSection');
                
                if (loginSec && regSec) {
                    if (section === 'login') {
                        loginSec.style.display = 'block';
                        regSec.style.display = 'none';
                    } else {
                        loginSec.style.display = 'none';
                        regSec.style.display = 'block';
                    }
                }
            }

            // Cerrar si dan clic en el fondo negro exterior
            if (modal) {
                modal.addEventListener('click', (e) => {
                    if (e.target === modal) {
                        closeAuthModal();
                    }
                });
            }
        </script>
    </body>
</html>