<?php
/**
 * Dynamic sitemap generator
 */
require_once __DIR__ . '/includes/article-functions.php';

header('Content-Type: application/xml; charset=utf-8');

$baseUrl = defined('SITE_URL') ? rtrim(SITE_URL, '/') : 'https://soudnipreklady-nemcina.cz';

$articles = getAllArticles();

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

// Homepage (both languages)
echo '  <url>' . "\n";
echo '    <loc>' . htmlspecialchars($baseUrl . '/cz/') . '</loc>' . "\n";
echo '    <changefreq>weekly</changefreq>' . "\n";
echo '    <priority>1.0</priority>' . "\n";
echo '  </url>' . "\n";

echo '  <url>' . "\n";
echo '    <loc>' . htmlspecialchars($baseUrl . '/de/') . '</loc>' . "\n";
echo '    <changefreq>weekly</changefreq>' . "\n";
echo '    <priority>1.0</priority>' . "\n";
echo '  </url>' . "\n";

// Static pages
$pages = ['sluzby', 'cenik', 'kontakt', 'o-mne', 'clanky'];
foreach ($pages as $page) {
    foreach (['cz', 'de'] as $lang) {
        echo '  <url>' . "\n";
        echo '    <loc>' . htmlspecialchars($baseUrl . '/' . $lang . '/' . $page) . '</loc>' . "\n";
        echo '    <changefreq>monthly</changefreq>' . "\n";
        echo '    <priority>0.8</priority>' . "\n";
        echo '  </url>' . "\n";
    }
}

// Articles
foreach ($articles as $article) {
    if ($article['cz_exists']) {
        echo '  <url>' . "\n";
        echo '    <loc>' . htmlspecialchars($baseUrl . '/cz/clanky/' . $article['slug']) . '</loc>' . "\n";
        echo '    <lastmod>' . date('Y-m-d', $article['modified']) . '</lastmod>' . "\n";
        echo '    <changefreq>monthly</changefreq>' . "\n";
        echo '    <priority>0.7</priority>' . "\n";
        echo '  </url>' . "\n";
    }
    if ($article['de_exists']) {
        echo '  <url>' . "\n";
        echo '    <loc>' . htmlspecialchars($baseUrl . '/de/clanky/' . $article['slug']) . '</loc>' . "\n";
        echo '    <lastmod>' . date('Y-m-d', $article['modified']) . '</lastmod>' . "\n";
        echo '    <changefreq>monthly</changefreq>' . "\n";
        echo '    <priority>0.7</priority>' . "\n";
        echo '  </url>' . "\n";
    }
}

echo '</urlset>' . "\n";
?>




