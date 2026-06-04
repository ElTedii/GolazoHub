<div id="authModal" class="auth-overlay" style="display: none;">
    <div class="modal-container">
        <button class="close-modal-btn" onclick="closeAuthModal()">&times;</button>

        <div id="loginSection" class="auth-section">
            <h2 class="auth-title">Iniciar Sesión</h2>
            <p class="auth-subtitle">Conéctate a GolazoHub para votar y comentar.</p>
            
            <form action="/GolazoHub/index.php?action=login" method="POST" class="auth-form">
                <div class="form-group">
                    <label for="login_user">Usuario o Correo</label>
                    <input type="text" id="login_user" name="usuario_login" placeholder="Tu usuario o correo" required>
                </div>
                <div class="form-group">
                    <label for="login_pass">Contraseña</label>
                    <input type="password" id="login_pass" name="password_login" placeholder="Ingresa tu contraseña" required>
                </div>
                <button type="submit" class="btn-primary btn-block">Iniciar Sesión</button>
            </form>
            <p class="auth-footer-text">
                ¿Eres nuevo en GolazoHub? <a href="#" onclick="switchAuthSection('register')">Regístrate</a>
            </p>
        </div>

        <div id="registerSection" class="auth-section" style="display: none;">
            <h2 class="auth-title">Crear una Cuenta</h2>
            <p class="auth-subtitle">Únete a la comunidad de debate del mundial.</p>
            
            <form action="/GolazoHub/index.php?action=register" method="POST" class="auth-form">
                <div class="form-group">
                    <label for="reg_user">Nombre de Usuario</label>
                    <input type="text" id="reg_user" name="usuario" placeholder="Ej. Isma_Goalkeep" required>
                </div>
                <div class="form-group">
                    <label for="reg_email">Correo Electrónico</label>
                    <input type="email" id="reg_email" name="correo" placeholder="tu@correo.com" required>
                </div>
                <div class="form-group">
                    <label for="reg_pass">Contraseña</label>
                    <input type="password" id="reg_pass" name="password" placeholder="Mínimo 8 caracteres" required>
                </div>
                <button type="submit" class="btn-primary btn-block">Registrarse</button>
            </form>
            <p class="auth-footer-text">
                ¿Ya tienes cuenta? <a href="#" onclick="switchAuthSection('login')">Inicia sesión</a>
            </p>
        </div>
    </div>
</div>