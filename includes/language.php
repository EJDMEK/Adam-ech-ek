<?php
/**
 * Language detection and management
 */

// Available languages
define('LANGUAGES', ['cz' => 'Čeština', 'de' => 'Deutsch']);
define('DEFAULT_LANG', 'cz');

/**
 * Detect current language from URL or cookie
 */
function detectLanguage() {
    $lang = DEFAULT_LANG;
    
    // Check GET parameter (from .htaccess rewrite)
    if (isset($_GET['lang']) && array_key_exists($_GET['lang'], LANGUAGES)) {
        $lang = $_GET['lang'];
        setLanguageCookie($lang); // Save to cookie
    }
    // Check URL path
    elseif (isset($_SERVER['REQUEST_URI'])) {
        $path = $_SERVER['REQUEST_URI'];
        if (preg_match('#/(cz|de)(/|$)#', $path, $matches)) {
            $lang = $matches[1];
            setLanguageCookie($lang);
        }
    }
    // Check cookie
    if ($lang === DEFAULT_LANG && isset($_COOKIE['lang']) && array_key_exists($_COOKIE['lang'], LANGUAGES)) {
        $lang = $_COOKIE['lang'];
    }
    
    return $lang;
}

/**
 * Set language cookie
 */
function setLanguageCookie($lang) {
    if (array_key_exists($lang, LANGUAGES)) {
        setcookie('lang', $lang, time() + (365 * 24 * 60 * 60), '/'); // 1 year
        $_COOKIE['lang'] = $lang;
    }
}

/**
 * Get language-aware URL
 */
function getLangUrl($path = '', $lang = null) {
    if ($lang === null) {
        $lang = detectLanguage();
    }
    
    // Get SITE_URL if defined, otherwise use current domain
    $basePath = defined('SITE_URL') ? rtrim(SITE_URL, '/') : (isset($_SERVER['HTTP_HOST']) ? ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] : '');
    
    // Remove leading slash from path
    $path = ltrim($path, '/');
    
    // Handle special case: if path starts with #, just return it (anchor link)
    if (strpos($path, '#') === 0) {
        return $path;
    }
    
    // If path is empty, use language prefix
    if (empty($path)) {
        return $basePath . '/' . $lang . '/';
    }
    
    // Check if path already has language prefix
    if (preg_match('#^(cz|de)/#', $path)) {
        return $basePath . '/' . $path;
    }
    
    return $basePath . '/' . $lang . '/' . $path;
}

/**
 * Get current page path without language prefix for language switching
 */
function getCurrentPagePath() {
    $uri = $_SERVER['REQUEST_URI'] ?? '/';
    
    // Remove query string
    $uri = strtok($uri, '?');
    
    // Handle article slugs - preserve clanky/slug structure
    if (preg_match('#^/(cz|de)/clanky/([a-z0-9-]+)/?$#', $uri, $matches)) {
        return 'clanky/' . $matches[2];
    }
    if (preg_match('#^/clanky/([a-z0-9-]+)/?$#', $uri, $matches)) {
        return 'clanky/' . $matches[1];
    }
    
    // Remove language prefix if present
    $uri = preg_replace('#^/(cz|de)(/|$)#', '/', $uri);
    
    // If empty or just /, return empty (home page)
    if ($uri === '/' || empty(trim($uri, '/'))) {
        return '';
    }
    
    // Remove leading slash
    $path = ltrim($uri, '/');
    
    // Handle direct PHP file access (from .htaccess rewrite)
    // If we're accessing via ?lang=cz parameter, extract from script name as fallback
    if (empty($path)) {
        $scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
        if ($scriptName && $scriptName !== '/index.php') {
            $pageName = basename($scriptName, '.php');
            if ($pageName !== 'index') {
                return $pageName;
            }
        }
    }
    
    // Return the path
    return $path;
}

/**
 * Get current language
 */
function getCurrentLanguage() {
    return detectLanguage();
}

/**
 * Get language name
 */
function getLanguageName($lang = null) {
    if ($lang === null) {
        $lang = getCurrentLanguage();
    }
    return LANGUAGES[$lang] ?? LANGUAGES[DEFAULT_LANG];
}
?>

