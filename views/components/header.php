<header class="main-header">
    <div class="header-container">
        <div class="header-logo">
            <i data-lucide="trophy" class="logo-icon"></i>
            <span class="logo-text">Golazo<span class="text-accent">Hub</span></span>
        </div>

        <div class="header-search">
            <i data-lucide="search" class="search-icon"></i>
            <input type="text" placeholder="Buscar publicaciones, mundiales, selecciones..." class="search-input">
        </div>

        <div class="header-actions">
            <button class="btn-secondary" onclick="openAuthModal('login')">Iniciar Sesión</button>
            <button class="btn-primary" onclick="openAuthModal('register')">Registrarse</button>
        </div>
    </div>
</header>

<div id="toast-alert" style="position: fixed; bottom: 24px; right: 24px; background-color: #ef4444; color: white; padding: 12px 20px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.3); display: flex; align-items: center; gap: 10px; z-index: 9999; font-size: 0.9rem; font-weight: 500; transform: translateY(150%); transition: transform 0.3s ease;">
    <i data-lucide="alert-circle" style="width: 18px; height: 18px;"></i>
    <span id="toast-message">Hubo un error</span>
</div>

<script>
    // Función mágica de Javascript para mostrar la alerta cuando queramos
    function mostrarAlerta(mensaje) {
        const toast = document.getElementById('toast-alert');
        const texto = document.getElementById('toast-message');
        
        texto.innerText = mensaje; // Le metemos el texto del error
        toast.style.transform = "translateY(0)"; // Lo subimos para que se vea
        
        // Se vuelve a ocultar solito después de 4 segundos
        setTimeout(() => {
            toast.style.transform = "translateY(150%)";
        }, 4000);
    }
</script>