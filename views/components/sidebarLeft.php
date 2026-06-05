<aside class="sidebar-left">
    <div class="sidebar-section">
        <ul class="sidebar-menu">
            <li class="menu-item active" onclick="window.location.href='/GolazoHub/index.php'">
                <i data-lucide="home"></i>
                <span>Inicio</span>
            </li>
            <li class="menu-item">
                <i data-lucide="trending-up"></i>
                <span>Populares</span>
            </li>
            <?php if (isset($_SESSION['usuario_id'])): ?>
                <li class="menu-item" onclick="window.location.href='/GolazoHub/index.php?action=create_post'" style="border: 1px solid var(--accent); margin-top: 10px; border-radius: 999px; background: rgba(0, 180, 216, 0.1); cursor: pointer;">
                    <i data-lucide="plus-circle" style="color: var(--accent);"></i>
                    <span style="color: var(--accent); font-weight: 600;">Crear Debate</span>
                </li>
            <?php endif; ?>
        </ul>
    </div>

    <div class="sidebar-section">
        <h3>Mundiales</h3>
        <ul class="sidebar-menu">
            <li class="menu-item" onclick="window.location.href='/GolazoHub/index.php'">
                <i data-lucide="globe"></i>
                <span>Todos los Mundiales</span>
            </li>

            <?php if (isset($mundiales) && is_array($mundiales) && count($mundiales) > 0): ?>
                <?php foreach ($mundiales as $m): ?>
                    <li class="menu-item" onclick="window.location.href='/GolazoHub/index.php?mundial_id=<?= $m['id']; ?>'">
                        <span style="font-size: 1.25rem; margin-right: 12px; display: inline-flex; align-items: center; line-height: 1;">
                            <?= htmlspecialchars($m['codigo_bandera']); ?>
                        </span>
                        <span><?= htmlspecialchars($m['nombre']); ?></span>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li style="padding: 10px 16px; color: var(--text-muted); font-size: 13px;">No hay mundiales cargados.</li>
            <?php endif; ?>
        </ul>
    </div>

    <div class="sidebar-section">
        <h3>📌 Categorías</h3>
        <ul class="sidebar-menu">
            <li class="menu-item" onclick="window.location.href='/GolazoHub/index.php'">
                <i data-lucide="layers"></i>
                <span>Todas las Categorías</span>
            </li>

            <?php if (isset($categorias) && is_array($categorias) && count($categorias) > 0): ?>
                <?php foreach ($categorias as $c): ?>
                    <li class="menu-item" onclick="window.location.href='/GolazoHub/index.php?categoria_id=<?= $c['id']; ?>'">
                        <i data-lucide="tag" style="width: 14px; height: 14px;"></i>
                        <span><?= htmlspecialchars($c['nombre']); ?></span>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li style="padding: 10px 16px; color: var(--text-muted); font-size: 13px;">No hay categorías.</li>
            <?php endif; ?>
        </ul>
    </div>
</aside>