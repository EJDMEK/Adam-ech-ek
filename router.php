<?php
/**
 * Router for PHP built-in server
 * This file handles URL rewriting when using: php -S localhost:8000 router.php
 */

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$query = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);

// Serve static files directly (images, CSS, JS, fonts, etc.)
$staticExtensions = ['jpg', 'jpeg', 'png', 'gif', 'svg', 'ico', 'css', 'js', 'woff', 'woff2', 'ttf', 'eot'];
$filePath = __DIR__ . $uri;
$extension = strtolower(pathinfo($uri, PATHINFO_EXTENSION));

// Check if it's a static file that exists
if (in_array($extension, $staticExtensions) && file_exists($filePath) && !is_dir($filePath)) {
    // Set proper Content-Type for CSS and JS
    $mimeTypes = [
        'css' => 'text/css',
        'js' => 'application/javascript',
        'svg' => 'image/svg+xml',
        'woff' => 'font/woff',
        'woff2' => 'font/woff2',
        'ttf' => 'font/ttf',
        'eot' => 'application/vnd.ms-fontobject'
    ];
    if (isset($mimeTypes[$extension])) {
        header('Content-Type: ' . $mimeTypes[$extension]);
    }
    readfile($filePath);
    return true;
}

// Also serve files from assets directory
if (strpos($uri, '/assets/') === 0 && file_exists($filePath) && !is_dir($filePath)) {
    // Set proper Content-Type
    $ext = strtolower(pathinfo($uri, PATHINFO_EXTENSION));
    $mimeTypes = [
        'css' => 'text/css',
        'js' => 'application/javascript',
        'svg' => 'image/svg+xml',
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'png' => 'image/png',
        'gif' => 'image/gif',
        'webp' => 'image/webp',
        'woff' => 'font/woff',
        'woff2' => 'font/woff2',
        'ttf' => 'font/ttf'
    ];
    if (isset($mimeTypes[$ext])) {
        header('Content-Type: ' . $mimeTypes[$ext]);
    }
    readfile($filePath);
    return true;
}

// Serve files from uploads directory
if (strpos($uri, '/uploads/') === 0 && file_exists($filePath) && !is_dir($filePath)) {
    // Set proper content type based on extension
    $ext = strtolower(pathinfo($uri, PATHINFO_EXTENSION));
    $mimeTypes = [
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'png' => 'image/png',
        'gif' => 'image/gif',
        'webp' => 'image/webp'
    ];
    if (isset($mimeTypes[$ext])) {
        header('Content-Type: ' . $mimeTypes[$ext]);
    }
    readfile($filePath);
    return true;
}

// Serve admin files directly (admin panel should work without routing)
if (strpos($uri, '/admin/') === 0 && file_exists($filePath) && !is_dir($filePath)) {
    return false; // Let PHP serve the file directly
}

// Handle files with spaces in names (URL encoded as %20)
// This is critical for files like "ilona zidkova logo alpha.svg"
$decodedUri = urldecode($uri);
if ($decodedUri !== $uri || strpos($uri, '%20') !== false) {
    $decodedPath = __DIR__ . $decodedUri;
    if (file_exists($decodedPath) && !is_dir($decodedPath)) {
        // Set proper content type based on extension
        $ext = strtolower(pathinfo($decodedUri, PATHINFO_EXTENSION));
        $mimeTypes = [
            'svg' => 'image/svg+xml',
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            'css' => 'text/css',
            'js' => 'application/javascript'
        ];
        if (isset($mimeTypes[$ext])) {
            header('Content-Type: ' . $mimeTypes[$ext]);
        }
        readfile($decodedPath);
        return true;
    }
}

// Serve files from loga firem directory (with spaces)
$decodedLogaPath = __DIR__ . urldecode($uri);
if (strpos($decodedUri, '/loga firem/') === 0 || strpos($uri, '/loga%20firem/') === 0) {
    if (file_exists($decodedLogaPath) && !is_dir($decodedLogaPath)) {
        $ext = strtolower(pathinfo($decodedUri, PATHINFO_EXTENSION));
        if ($ext === 'svg') {
            header('Content-Type: image/svg+xml');
        }
        readfile($decodedLogaPath);
        return true;
    }
}

// Serve root-level image files (including files with spaces in name)
// This handles files like "ilona zidkova logo alpha.svg" and "ilona zidkova.jpeg"
if (preg_match('#^/[^/]+\.(svg|jpeg|jpg|png|gif)$#i', $uri) && file_exists($filePath)) {
    return false;
}

// Also try decoded path for root files
if (preg_match('#^/[^/]+\.(svg|jpeg|jpg|png|gif)$#i', $decodedUri)) {
    if (file_exists($decodedPath) && !is_dir($decodedPath)) {
        $ext = strtolower(pathinfo($decodedUri, PATHINFO_EXTENSION));
        if ($ext === 'svg') {
            header('Content-Type: image/svg+xml');
        } elseif (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
            header('Content-Type: image/' . ($ext === 'jpg' ? 'jpeg' : $ext));
        }
        readfile($decodedPath);
        return true;
    }
}

// Handle language routing: /cz/page or /de/page -> page.php?lang=cz
if (preg_match('#^/(cz|de)/([a-z0-9-]+)/?$#', $uri, $matches)) {
    $lang = $matches[1];
    $page = $matches[2];
    
    // Check if PHP file exists
    $phpFile = __DIR__ . '/' . $page . '.php';
    if (file_exists($phpFile)) {
        $_GET['lang'] = $lang;
        if ($query) {
            parse_str($query, $_GET);
            $_GET['lang'] = $lang; // Ensure lang is set
        }
        require $phpFile;
        return true;
    }
}

// Handle /cz/clanky or /de/clanky -> clanky.php?lang=cz (article list)
if (preg_match('#^/(cz|de)/clanky/?$#', $uri, $matches)) {
    $lang = $matches[1];
    $_GET['lang'] = $lang;
    if ($query) {
        parse_str($query, $_GET);
        $_GET['lang'] = $lang;
    }
    require __DIR__ . '/clanky.php';
    return true;
}

// Handle /cz/ or /de/ -> index.php?lang=cz
if (preg_match('#^/(cz|de)/?$#', $uri, $matches)) {
    $lang = $matches[1];
    $_GET['lang'] = $lang;
    if ($query) {
        parse_str($query, $_GET);
        $_GET['lang'] = $lang;
    }
    require __DIR__ . '/index.php';
    return true;
}

// Handle articles: /cz/clanky/slug or /de/clanky/slug
if (preg_match('#^/(cz|de)/clanky/([a-z0-9-]+)/?$#', $uri, $matches)) {
    $lang = $matches[1];
    $slug = $matches[2];
    $_GET['lang'] = $lang;
    $_GET['slug'] = $slug;
    if ($query) {
        parse_str($query, $_GET);
        $_GET['lang'] = $lang;
        $_GET['slug'] = $slug;
    }
    require __DIR__ . '/clanky.php';
    return true;
}

// Handle articles without lang: /clanky/slug
if (preg_match('#^/clanky/([a-z0-9-]+)/?$#', $uri, $matches)) {
    $slug = $matches[1];
    $_GET['slug'] = $slug;
    if ($query) {
        parse_str($query, $_GET);
        $_GET['slug'] = $slug;
    }
    require __DIR__ . '/clanky.php';
    return true;
}

// Default: try to serve index.php
if ($uri === '/' || empty(trim($uri, '/'))) {
    require __DIR__ . '/index.php';
    return true;
}

// 404 - File not found
http_response_code(404);
echo "404 - Page not found";
exit;

