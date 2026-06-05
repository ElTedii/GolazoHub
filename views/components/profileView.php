<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= htmlspecialchars($usuario['usuario']); ?> - GolazoHub</title>
        <link rel="stylesheet" href="/GolazoHub/assets/css/styles.css?v=20">
        <script src="https://unpkg.com/lucide@latest"></script>
    </head>
    <body>

        <?php include 'views/components/header.php'; ?>

        <div class="dashboard-grid">
            
            <div class="grid-col-left">
                <?php include 'views/components/sideBarLeft.php'; ?>
            </div>

            <main class="main-feed">
                
                <div style="margin-bottom: 16px; padding-left: 4px;">
                    <h2 style="font-size: 1.1rem; font-weight: bold; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px; margin: 0;">
                        Publicaciones de u/<?= htmlspecialchars($usuario['usuario']); ?>
                    </h2>
                </div>

                <?php include 'views/components/postCard.php'; ?>

            </main>

            <div class="grid-col-right">
                
                <div class="profile-card-sidebar" style="background-color: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px; overflow: hidden; margin-bottom: 16px;">
                    <div style="height: 60px; background: linear-gradient(90deg, var(--accent) 0%, #0077b6 100%);"></div>
                    
                    <div style="padding: 16px; position: relative; margin-top: -30px;">
                        <div style="width: 64px; height: 64px; border: 4px solid var(--bg-card); border-radius: 50%; overflow: hidden; margin-bottom: 10px;">
                            <img src="/GolazoHub/index.php?action=ver_avatar&id=<?= $usuario['id']; ?>" 
                                 alt="Avatar" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>

                        <h2 style="font-size: 1.2rem; font-weight: bold; color: var(--text-primary); margin: 0;">
                            u/<?= htmlspecialchars($usuario['usuario']); ?>
                        </h2>
                        
                        <p style="font-size: 0.8rem; color: var(--text-muted); margin: 2px 0 16px 0;">
                            <?= htmlspecialchars($usuario['bio'] ?? 'Usuario de GolazoHub'); ?>
                        </p>

                        <div style="display: flex; gap: 24px; border-top: 1px solid var(--border-color); padding-top: 14px; margin-bottom: 16px;">
                            <div>
                                <span style="display: block; font-size: 0.9rem; font-weight: bold; color: var(--text-primary);">
                                    <?= $usuario['karma'] ?? 0; ?>
                                </span>
                                <span style="font-size: 0.75rem; color: var(--text-muted);">Karma</span>
                            </div>
                            <div>
                                <span style="display: block; font-size: 0.9rem; font-weight: bold; color: var(--text-primary);">
                                    <?= isset($usuario['fecha_registro']) ? date('M Y', strtotime($usuario['fecha_registro'])) : '---'; ?>
                                </span>
                                <span style="font-size: 0.75rem; color: var(--text-muted);">Registro</span>
                            </div>
                        </div>

                        <button class="btn-secondary" style="width: 100%; display: flex; align-items: center; justify-content: center; gap: 8px; padding: 8px 0; font-size: 0.85rem;">
                            <i data-lucide="settings" style="width: 16px; height: 16px;"></i> Configuración del Perfil
                        </button>
                    </div>
                </div>

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