<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Debate: ¿Fue penal el de Catar? - GolazoHub</title>
        <link rel="stylesheet" href="/GolazoHub/assets/css/styles.css?v=15">
        <script src="https://unpkg.com/lucide@latest"></script>
    </head>
    <body>

        <?php include 'views/components/header.php'; ?>

        <div class="dashboard-grid">
            
            <div class="grid-col-left">
                <?php include 'views/components/sideBarLeft.php'; ?>
            </div>

<main class="main-feed">
            
            <article class="post-card post-detail-expanded">
                <div class="post-layout">
                    
                    <div class="post-votes-side">
                        <button class="vote-btn up"><i data-lucide="arrow-big-up"></i></button>
                        <span class="vote-count">342</span>
                        <button class="vote-btn down"><i data-lucide="arrow-big-down"></i></button>
                    </div>

                    <div class="post-content-side">
                        
                        <div class="post-header">
                            <span class="post-community">🇶🇦 Catar 2022</span>
                            <span class="post-divider">•</span>
                            <span class="post-author">Publicado por u/ElDiego10</span>
                            <span class="post-time">hace 2 horas</span>
                            <span class="post-tag">Polémicas Históricas</span>
                        </div>

                        <h1 class="post-title-detail" style="font-size: 1.4rem; font-weight: bold; color: var(--text-primary); margin: 10px 0; line-height: 1.4;">
                            ¿Alguien más sigue pensando que este penal estuvo completamente regalado?
                        </h1>

                        <div class="post-body-text" style="font-size: 0.95rem; color: var(--text-primary); line-height: 1.5; margin-bottom: 16px;">
                            <p>He estado revisando la repetición en cámara lenta desde diferentes ángulos y sigo sin ver el contacto claro. En estos torneos tan cortos, un error arbitral te cambia todo el esquema táctico. Abro debate: ¿creen que el VAR debió intervenir con más fuerza o se manejó bajo el protocolo correcto?</p>
                        </div>

                        <div class="post-media-box" style="margin-top: 12px; border-radius: 8px; overflow: hidden; border: 1px solid var(--border-color);">
                            <img src="https://images.unsplash.com/photo-1508098682722-e99c43a406b2?auto=format&fit=crop&w=800&q=80" alt="Polémica" style="width: 100%; display: block; max-height: 450px; object-fit: cover;">
                        </div>

                    </div>
                </div>
            </article>

                <section class="comments-section">
                    <h3 class="comments-title">Comentarios (2)</h3>
                    
                    <div class="comment-box-container">
                        <textarea placeholder="¿Qué piensas de esta jugada? Deja tu argumento..."></textarea>
                        <div class="comment-box-actions">
                            <button class="btn-primary">Comentar</button>
                        </div>
                    </div>

                    <div class="comments-list">
                        
                        <div class="comment-node">
                            <div class="comment-meta">
                                <span class="comment-author">u/AnalistaTactico</span>
                                <span class="comment-time">hace 1 hora</span>
                            </div>
                            <div class="comment-content">
                                Totalmente de acuerdo contigo. El defensa arrastra el pie antes del impacto, el delantero solo buscó el contacto ingeniosamente. El VAR en este mundial pecó de no querer contradecir al central.
                            </div>
                            <div class="comment-actions">
                                <button class="comment-vote-btn"><i data-lucide="arrow-big-up"></i> 12</button>
                                <button class="comment-vote-btn"><i data-lucide="arrow-big-down"></i></button>
                                <button class="comment-reply-btn"><i data-lucide="message-square"></i> Responder</button>
                            </div>

                            <div class="comment-replies">
                                <div class="comment-node">
                                    <div class="comment-meta">
                                        <span class="comment-author">u/ArbitroJusto</span>
                                        <span class="comment-time">hace 45 min</span>
                                    </div>
                                    <div class="comment-content">
                                        Difiero un poco. Aunque el contacto sea sutil, la zancadilla interrumpe la carrera del atacante dentro del área. Por reglamento, si hay imprudencia se sanciona, no importa la intensidad.
                                    </div>
                                    <div class="comment-actions">
                                        <button class="comment-vote-btn"><i data-lucide="arrow-big-up"></i> 5</button>
                                        <button class="comment-vote-btn"><i data-lucide="arrow-big-down"></i></button>
                                        <button class="comment-reply-btn"><i data-lucide="message-square"></i> Responder</button>
                                    </div>
                                </div>
                            </div> </div> </div>
                </section>

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