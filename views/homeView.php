<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>GolazoHub - Estilo Reddit Mundial</title>
        <link rel="stylesheet" href="/GolazoHub/assets/css/styles.css">
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
    </body>
</html>