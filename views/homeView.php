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
                <?php include 'views/components/postCard.php'; ?>
                <?php include 'views/components/postCard.php'; ?>
            </main>

            <div class="grid-col-right">
                <?php include 'views/components/sidebarRight.php'; ?>
            </div>

        </div>

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