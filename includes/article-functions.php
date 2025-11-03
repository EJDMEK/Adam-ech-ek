<?php
/**
 * Article management functions
 */

require_once __DIR__ . '/../admin/config.php';

/**
 * Generate SEO-friendly slug from text
 */
function generateSlug($text) {
    // Convert to lowercase
    $text = mb_strtolower($text, 'UTF-8');
    
    // Remove diacritics
    $replace = [
        'á' => 'a', 'č' => 'c', 'ď' => 'd', 'é' => 'e', 'ě' => 'e',
        'í' => 'i', 'ň' => 'n', 'ó' => 'o', 'ř' => 'r', 'š' => 's',
        'ť' => 't', 'ú' => 'u', 'ů' => 'u', 'ý' => 'y', 'ž' => 'z',
        'ä' => 'a', 'ö' => 'o', 'ü' => 'u', 'ß' => 'ss'
    ];
    $text = strtr($text, $replace);
    
    // Replace spaces and special chars with hyphens
    $text = preg_replace('/[^a-z0-9]+/', '-', $text);
    
    // Remove leading/trailing hyphens
    $text = trim($text, '-');
    
    return $text;
}

/**
 * Get all articles
 */
function getAllArticles() {
    $articles = [];
    $files = glob(ARTICLES_DIR . '*-cz.html');
    
    foreach ($files as $file) {
        $basename = basename($file);
        $slug = str_replace('-cz.html', '', $basename);
        
        // Check if DE version exists
        $deFile = ARTICLES_DIR . $slug . '-de.html';
        
        $articles[] = [
            'slug' => $slug,
            'cz_file' => $basename,
            'de_file' => file_exists($deFile) ? str_replace('-cz.html', '-de.html', $basename) : null,
            'cz_exists' => true,
            'de_exists' => file_exists($deFile),
            'modified' => filemtime($file)
        ];
    }
    
    // Sort by modification time (newest first)
    usort($articles, function($a, $b) {
        return $b['modified'] - $a['modified'];
    });
    
    return $articles;
}

/**
 * Read article content
 */
function readArticle($slug, $lang = 'cz') {
    $file = ARTICLES_DIR . $slug . '-' . $lang . '.html';
    
    if (!file_exists($file)) {
        return null;
    }
    
    $content = file_get_contents($file);
    
    // Extract title from first h1 if exists, or use slug
    preg_match('/<h1[^>]*>(.*?)<\/h1>/s', $content, $matches);
    $title = !empty($matches[1]) ? strip_tags($matches[1]) : ucfirst(str_replace('-', ' ', $slug));
    
    // Load metadata (image, author, created date, published status)
    $metaFile = ARTICLES_DIR . $slug . '-meta.json';
    $image = null;
    $author = null;
    $created = null;
    $published = true; // Default to published
    if (file_exists($metaFile)) {
        $metaData = json_decode(file_get_contents($metaFile), true);
        if (isset($metaData['image'])) {
            $image = $metaData['image'];
        }
        if (isset($metaData['author'])) {
            $author = $metaData['author'];
        }
        if (isset($metaData['created'])) {
            $created = $metaData['created'];
        }
        if (isset($metaData['published'])) {
            $published = (bool)$metaData['published'];
        }
    }
    
    // If created date not in metadata, use file creation time
    if (!$created) {
        $created = filemtime($file);
    }
    
    // Default author if not set
    if (!$author) {
        $author = 'Ilona Žídková';
    }
    
    return [
        'slug' => $slug,
        'title' => $title,
        'content' => $content,
        'image' => $image,
        'author' => $author,
        'created' => $created,
        'published' => $published,
        'lang' => $lang,
        'modified' => filemtime($file)
    ];
}

/**
 * Save article
 */
function saveArticle($slug, $content, $lang = 'cz', $articleData = null) {
    $file = ARTICLES_DIR . $slug . '-' . $lang . '.html';
    $isNew = !file_exists($file);
    
    // Save metadata separately
    $metaFile = ARTICLES_DIR . $slug . '-meta.json';
    
    // Load existing metadata if exists
    $metaData = [];
    if (file_exists($metaFile)) {
        $metaData = json_decode(file_get_contents($metaFile), true) ?: [];
    }
    
    // If new article, set created date
    if ($isNew && !isset($metaData['created'])) {
        $metaData['created'] = time();
    }
    
    // Set default author if not set
    if (!isset($metaData['author'])) {
        $metaData['author'] = 'Ilona Žídková';
    }
    
    // Update with new data if provided
    if ($articleData) {
        if (isset($articleData['image']) && $articleData['image']) {
            $metaData['image'] = $articleData['image'];
        }
        if (isset($articleData['author'])) {
            $metaData['author'] = $articleData['author'];
        }
        if (isset($articleData['published'])) {
            $metaData['published'] = (bool)$articleData['published'];
        }
    }
    
    // Save metadata
    file_put_contents($metaFile, json_encode($metaData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    
    // Save content
    return file_put_contents($file, $content) !== false;
}

/**
 * Rename article (change slug)
 */
function renameArticle($oldSlug, $newSlug) {
    // Validate new slug format (only lowercase letters, numbers, and hyphens)
    if (!preg_match('/^[a-z0-9-]+$/', $newSlug)) {
        return false;
    }
    
    // Check if new slug already exists
    if (file_exists(ARTICLES_DIR . $newSlug . '-cz.html')) {
        return false;
    }
    
    $czFile = ARTICLES_DIR . $oldSlug . '-cz.html';
    $deFile = ARTICLES_DIR . $oldSlug . '-de.html';
    $metaFile = ARTICLES_DIR . $oldSlug . '-meta.json';
    
    $newCzFile = ARTICLES_DIR . $newSlug . '-cz.html';
    $newDeFile = ARTICLES_DIR . $newSlug . '-de.html';
    $newMetaFile = ARTICLES_DIR . $newSlug . '-meta.json';
    
    $renamed = false;
    
    // Rename Czech version
    if (file_exists($czFile)) {
        if (rename($czFile, $newCzFile)) {
            $renamed = true;
        }
    }
    
    // Rename German version
    if (file_exists($deFile)) {
        rename($deFile, $newDeFile);
    }
    
    // Rename metadata file
    if (file_exists($metaFile)) {
        rename($metaFile, $newMetaFile);
    }
    
    return $renamed;
}

/**
 * Delete article
 */
function deleteArticle($slug) {
    $czFile = ARTICLES_DIR . $slug . '-cz.html';
    $deFile = ARTICLES_DIR . $slug . '-de.html';
    $metaFile = ARTICLES_DIR . $slug . '-meta.json';
    
    $deleted = false;
    if (file_exists($czFile)) {
        $deleted = unlink($czFile);
    }
    if (file_exists($deFile)) {
        unlink($deFile);
    }
    if (file_exists($metaFile)) {
        unlink($metaFile);
    }
    
    return $deleted;
}

/**
 * Get article list for blog (public)
 */
function getPublicArticles($lang = 'cz', $limit = null) {
    $articles = getAllArticles();
    $publicArticles = [];
    
    foreach ($articles as $article) {
        $articleData = null;
        
        // Try requested language first
        if (($lang === 'cz' && $article['cz_exists']) || ($lang === 'de' && $article['de_exists'])) {
            $articleData = readArticle($article['slug'], $lang);
        }
        // Fallback to other language if requested doesn't exist
        elseif ($article['cz_exists']) {
            $articleData = readArticle($article['slug'], 'cz');
        }
        
        // Only include published articles
        if ($articleData && (!isset($articleData['published']) || $articleData['published'] === true)) {
            $publicArticles[] = $articleData;
        }
        
        if ($limit && count($publicArticles) >= $limit) {
            break;
        }
    }
    
    return $publicArticles;
}
?>



