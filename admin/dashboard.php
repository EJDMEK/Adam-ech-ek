<?php
session_start();
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/../includes/article-functions.php';

// Check authentication
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

$articles = getAllArticles();
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - <?php echo SITE_NAME; ?></title>
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>/assets/css/admin.css">
</head>
<body class="admin-dashboard">
    <header class="admin-header">
        <div class="container">
            <h1>Administrace článků</h1>
            <a href="logout.php" class="logout-button">Odhlásit se</a>
        </div>
    </header>
    
    <main class="admin-main">
        <div class="container">
            <div class="dashboard-actions">
                <a href="edit.php" class="btn btn-primary"><span>+ Přidat nový článek</span></a>
            </div>
            
            <?php if (empty($articles)): ?>
            <p>Zatím nejsou žádné články. Vytvořte první článek.</p>
            <?php else: ?>
            <table class="articles-table">
                <thead>
                    <tr>
                        <th>Slug</th>
                        <th>Česká verze</th>
                        <th>Německá verze</th>
                        <th>Status</th>
                        <th>Poslední změna</th>
                        <th>Akce</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($articles as $article): 
                        // Check published status
                        $articleData = readArticle($article['slug'], 'cz');
                        $isPublished = true; // Default to published
                        if ($articleData && isset($articleData['published'])) {
                            $isPublished = $articleData['published'];
                        }
                    ?>
                    <tr>
                        <td><code><?php echo htmlspecialchars($article['slug']); ?></code></td>
                        <td>
                            <?php if ($article['cz_exists']): ?>
                                <span class="badge badge-success">✓ Ano</span>
                            <?php else: ?>
                                <span class="badge badge-error">✗ Ne</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($article['de_exists']): ?>
                                <span class="badge badge-success">✓ Ano</span>
                            <?php else: ?>
                                <span class="badge badge-error">✗ Ne</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($isPublished): ?>
                                <span class="badge badge-success" style="background-color: #22c55e;">Publikováno</span>
                            <?php else: ?>
                                <span class="badge badge-error" style="background-color: #ef4444;">Skryto</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo date('d.m.Y H:i', $article['modified']); ?></td>
                        <td>
                            <a href="edit.php?slug=<?php echo urlencode($article['slug']); ?>" class="btn btn-sm">Upravit</a>
                            <a href="delete.php?slug=<?php echo urlencode($article['slug']); ?>" 
                               class="btn btn-sm btn-danger" 
                               onclick="return confirm('Opravdu chcete smazat tento článek?');">Smazat</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>



