<?php
session_start();
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/../includes/article-functions.php';

// Check authentication
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

$slug = $_GET['slug'] ?? null;

if (!$slug) {
    header('Location: dashboard.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (deleteArticle($slug)) {
        header('Location: dashboard.php?deleted=1');
        exit;
    } else {
        header('Location: dashboard.php?error=1');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smazat článek - <?php echo SITE_NAME; ?></title>
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>/assets/css/admin.css">
</head>
<body class="admin-delete">
    <header class="admin-header">
        <div class="container">
            <h1>Smazat článek</h1>
            <a href="dashboard.php" class="btn btn-secondary">Zpět</a>
        </div>
    </header>
    
    <main class="admin-main">
        <div class="container">
            <div class="alert alert-error">
                <h3>Opravdu chcete smazat článek?</h3>
                <p><strong>Slug:</strong> <code><?php echo htmlspecialchars($slug); ?></code></p>
                <p>Tato akce je nevratná!</p>
            </div>
            
            <form method="POST">
                <button type="submit" class="btn btn-danger">Ano, smazat</button>
                <a href="dashboard.php" class="btn btn-secondary">Zrušit</a>
            </form>
        </div>
    </main>
</body>
</html>




