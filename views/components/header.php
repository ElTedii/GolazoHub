<header class="main-header">
    <div class="header-container">
        
        <div class="header-left">
            <a href="/GolazoHub/" class="logo" style="display: flex; align-items: center; gap: 8px; text-decoration: none; color: inherit;">
                <i data-lucide="trophy" class="logo-icon"></i>
                <span class="logo-text">Golazo<span class="text-accent">Hub</span></span>
            </a>
        </div>

        <div class="header-search">
            <i data-lucide="search" class="search-icon"></i>
            <input type="text" placeholder="Buscar publicaciones, mundiales, selecciones..." class="search-input">
        </div>

        <div class="header-actions" style="display: flex; align-items: center; gap: 12px;">
            <?php if (isset($_SESSION['usuario_id'])): ?>
                
                <span class="username" style="color: var(--text-primary); font-weight: 600; font-size: 0.9rem; white-space: nowrap;">
                    <?= htmlspecialchars($_SESSION['usuario_nombre']); ?>
                </span>
                
                <form id="avatarForm" action="/GolazoHub/index.php?action=cambiar_foto" method="POST" enctype="multipart/form-data" style="margin: 0; padding: 0; display: flex; align-items: center;">
                    <label for="avatarInput" style="cursor: pointer; position: relative; display: block; line-height: 0; margin: 0;" title="Cambiar foto de perfil">
                        <img src="/GolazoHub/index.php?action=ver_avatar&id=<?= $_SESSION['usuario_id']; ?>&t=<?= time(); ?>" 
                            alt="Avatar" 
                            style="width: 36px; height: 36px; border-radius: 50%; object-fit: cover; border: 2px solid var(--accent); display: block;">
                        
                        <div style="position: absolute; bottom: -2px; right: -2px; background: var(--accent); border-radius: 50%; width: 14px; height: 14px; display: flex; align-items: center; justify-content: center; border: 1px solid var(--bg-card);">
                            <i data-lucide="camera" style="width: 8px; height: 8px; color: white;"></i>
                        </div>
                    </label>
                    <input type="file" id="avatarInput" name="avatar" accept="image/*" style="display: none;" onchange="document.getElementById('avatarForm').submit();">
                </form>

                <a href="/GolazoHub/index.php?action=logout" class="btn-secondary" style="display: inline-flex; align-items: center; justify-content: center; gap: 6px; text-decoration: none; height: 36px; padding: 0 16px; border-radius: 20px;" title="Cerrar Sesión">
                    <i data-lucide="log-out" style="width: 14px; height: 14px;"></i>
                    <span>Salir</span>
                </a>

            <?php else: ?>
                <button class="btn-secondary" onclick="openAuthModal('login')">Iniciar Sesión</button>
                <button class="btn-primary" onclick="openAuthModal('register')">Registrarse</button>
            <?php endif; ?>
        </div>

    </div>
</header>

<div id="toast-alert" style="position: fixed; bottom: 24px; right: 24px; background-color: #ef4444; color: white; padding: 12px 20px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.3); display: flex; align-items: center; gap: 10px; z-index: 9999; font-size: 0.9rem; font-weight: 500; opacity: 0; visibility: hidden; transform: translateY(20px); transition: all 0.3s ease;">
    <i data-lucide="alert-circle" style="width: 18px; height: 18px;"></i>
    <span id="toast-message">Hubo un error</span>
</div>

<script>
// Actualiza tu script de la alerta para que cambie la opacidad y visibilidad
function mostrarAlerta(mensaje) {
    const toast = document.getElementById('toast-alert');
    const texto = document.getElementById('toast-message');
    
    texto.innerText = mensaje;
    
    // Lo hacemos visible y lo subimos sutilmente
    toast.style.opacity = "1";
    toast.style.visibility = "visible";
    toast.style.transform = "translateY(0)";
    
    // Se vuelve a ocultar solito después de 4 segundos
    setTimeout(() => {
        toast.style.opacity = "0";
        toast.style.visibility = "hidden";
        toast.style.transform = "translateY(20px)";
    }, 4000);
}
</script>