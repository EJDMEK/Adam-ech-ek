<?php
/**
 * One-time script to change admin password
 * Delete this file after use!
 */
require_once __DIR__ . '/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newPassword = $_POST['password'] ?? '';
    if (strlen($newPassword) >= 6) {
        $hash = password_hash($newPassword, PASSWORD_DEFAULT);
        
        // Update config file
        $configFile = __DIR__ . '/config.php';
        $config = file_get_contents($configFile);
        $config = preg_replace(
            "/define\('ADMIN_PASSWORD_HASH',\s*'[^']+'\);/",
            "define('ADMIN_PASSWORD_HASH', '{$hash}');",
            $config
        );
        file_put_contents($configFile, $config);
        
        echo "Heslo bylo úspěšně změněno. Smažte tento soubor!";
        exit;
    } else {
        $error = "Heslo musí mít alespoň 6 znaků.";
    }
}
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Změna hesla</title>
    <style>
        body { font-family: sans-serif; max-width: 500px; margin: 50px auto; padding: 20px; }
        .form-group { margin-bottom: 1rem; }
        label { display: block; margin-bottom: 0.5rem; }
        input { width: 100%; padding: 0.5rem; }
        button { padding: 0.5rem 1.5rem; background: #FFD600; border: none; cursor: pointer; }
        .error { color: red; }
    </style>
</head>
<body>
    <h1>Změna admin hesla</h1>
    <?php if (isset($error)): ?>
    <p class="error"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
    <form method="POST">
        <div class="form-group">
            <label for="password">Nové heslo (min. 6 znaků):</label>
            <input type="password" id="password" name="password" required minlength="6">
        </div>
        <button type="submit">Změnit heslo</button>
    </form>
    <p style="color: red; margin-top: 2rem; font-size: 0.9rem;">
        <strong>DŮLEŽITÉ:</strong> Po změně hesla smažte tento soubor (change-password.php)!
    </p>
</body>
</html>




