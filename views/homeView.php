<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GolazoHub - Estilo Reddit Mundial</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body>

    <?php include 'View/header.php'; ?>

    <div class="dashboard-grid">
        
        <?php include 'View/sidebar_left.php'; ?>

        <main class="main-feed">
            <?php include 'View/post_card.php'; ?>
            <?php include 'View/post_card.php'; ?> 
        </main>

        <?php include 'View/sidebar_right.php'; ?>

    </div>

    <script>
        // Inicializa los íconos de Lucide
        lucide.createIcons();
    </script>
</body>
</html>