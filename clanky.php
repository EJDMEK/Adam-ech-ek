<?php
require_once __DIR__ . '/includes/language.php';
require_once __DIR__ . '/includes/article-functions.php';

$currentLang = getCurrentLanguage();
$slug = $_GET['slug'] ?? null;

// If slug is provided, show individual article
if ($slug) {
    $article = readArticle($slug, $currentLang);
    
    // Try other language if current language doesn't exist
    if (!$article && $currentLang === 'cz') {
        $article = readArticle($slug, 'de');
    } elseif (!$article && $currentLang === 'de') {
        $article = readArticle($slug, 'cz');
    }
    
    if ($article) {
        $pageTitle = htmlspecialchars($article['title']);
        $excerpt = html_entity_decode(strip_tags($article['content']), ENT_QUOTES, 'UTF-8');
        $metaDescription = mb_substr($excerpt, 0, 160);
        
        include __DIR__ . '/includes/header.php';
        ?>
        <main>
            <section class="section articles-section">
                <div class="container">
                    <div class="article-content">
                        <?php if (!empty($article['image'])): ?>
                        <div class="article-featured-image">
                            <img src="<?php echo htmlspecialchars($article['image']); ?>" alt="<?php echo htmlspecialchars($article['title']); ?>">
                        </div>
                        <?php endif; ?>
                        
                        <div class="article-body">
                            <?php 
                            // Extract h1 from content and display separately
                            preg_match('/<h1[^>]*>(.*?)<\/h1>/s', $article['content'], $matches);
                            if (!empty($matches[0])) {
                                echo $matches[0]; // Display h1
                                $contentWithoutH1 = preg_replace('/<h1[^>]*>.*?<\/h1>/s', '', $article['content']);
                            } else {
                                $contentWithoutH1 = $article['content'];
                            }
                            ?>
                            
                            <div class="article-meta-footer">
                                <div class="article-author">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                    <span><?php echo htmlspecialchars($article['author']); ?></span>
                                </div>
                                <div class="article-date">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                    </svg>
                                    <span><?php echo $currentLang === 'cz' ? 'Publikováno:' : 'Veröffentlicht:'; ?> <?php echo date('d.m.Y', $article['created']); ?></span>
                                </div>
                            </div>
                            
                            <?php echo $contentWithoutH1; // Display rest of content without h1 ?>
                        </div>
                        
                        <?php
                        // Get other articles (exclude current)
                        $allArticles = getPublicArticles($currentLang, 4); // Get 4 to show 3 (excluding current)
                        $otherArticles = array_filter($allArticles, function($a) use ($article) {
                            return $a['slug'] !== $article['slug'];
                        });
                        $otherArticles = array_slice($otherArticles, 0, 3);
                        
                        if (!empty($otherArticles)):
                        ?>
                        <div class="article-related">
                            <h3 class="article-related-title"><?php echo $currentLang === 'cz' ? 'Další články' : 'Weitere Artikel'; ?></h3>
                            <div class="articles-grid-related">
                                <?php foreach ($otherArticles as $otherArticle): ?>
                                <article class="article-card-related" onclick="window.location.href='<?php echo getLangUrl('clanky/' . $otherArticle['slug'], $currentLang); ?>'" style="cursor: pointer;">
                                    <?php if (!empty($otherArticle['image'])): ?>
                                    <div class="article-card-image-related">
                                        <img src="<?php echo htmlspecialchars($otherArticle['image']); ?>" alt="<?php echo htmlspecialchars($otherArticle['title']); ?>">
                                    </div>
                                    <?php endif; ?>
                                    <div class="article-card-content-related">
                                        <h4><?php echo htmlspecialchars($otherArticle['title']); ?></h4>
                                        <p class="article-excerpt-related"><?php 
                                            $excerpt = html_entity_decode(strip_tags($otherArticle['content']), ENT_QUOTES, 'UTF-8');
                                            echo htmlspecialchars(mb_substr($excerpt, 0, 120)) . '...'; 
                                        ?></p>
                                    </div>
                                </article>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                        
                        <div class="article-back-link">
                            <a href="<?php echo getLangUrl('clanky', $currentLang); ?>" class="article-back-button">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M19 12H5M12 19l-7-7 7-7"/>
                                </svg>
                                <span><?php echo $currentLang === 'cz' ? 'Zpět na seznam článků' : 'Zurück zur Artikelliste'; ?></span>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <?php
        include __DIR__ . '/includes/footer.php';
        exit;
    }
}

// Show article list
$pageTitle = $currentLang === 'cz' ? 'Články' : 'Artikel';
$metaDescription = $currentLang === 'cz' 
    ? 'Články o překladatelských službách, elektronických překladech a dalších tématech'
    : 'Artikel über Übersetzungsdienstleistungen, elektronische Übersetzungen und andere Themen';

$articles = getPublicArticles($currentLang);

include __DIR__ . '/includes/header.php';
?>

<main>
    <section class="section articles-section">
        <div class="container">
            <div class="articles-header">
                <h2 class="articles-title"><?php echo $currentLang === 'cz' ? 'Články a aktuality' : 'Artikel und Aktuelles'; ?></h2>
                <p class="articles-subtitle"><?php echo $currentLang === 'cz' 
                    ? 'Zajímavosti, postřehy a praktické informace ze světa překladatelství a soudních překladů.'
                    : 'Interessantes, Beobachtungen und praktische Informationen aus der Welt der Übersetzung und Gerichtsübersetzungen.'; ?></p>
            </div>
            
            <?php if (empty($articles)): ?>
            <div style="text-align: center; padding: 3rem; color: var(--secondary-gray);">
                <p><?php echo $currentLang === 'cz' 
                    ? 'Zatím zde nejsou žádné články.'
                    : 'Es gibt noch keine Artikel.'; ?></p>
            </div>
            <?php else: ?>
            <div class="articles-grid">
                <?php foreach ($articles as $article): ?>
                <article class="article-card" onclick="window.location.href='<?php echo getLangUrl('clanky/' . $article['slug'], $currentLang); ?>'" style="cursor: pointer;">
                    <?php if (!empty($article['image'])): ?>
                    <div class="article-card-image">
                        <img src="<?php echo htmlspecialchars($article['image']); ?>" alt="<?php echo htmlspecialchars($article['title']); ?>">
                    </div>
                    <?php endif; ?>
                    <div class="article-card-content">
                        <h3><?php echo htmlspecialchars($article['title']); ?></h3>
                        <div class="article-card-meta">
                            <div class="article-author">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                <span><?php echo htmlspecialchars($article['author'] ?? 'Ilona Žídková'); ?></span>
                            </div>
                            <div class="article-date">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                                <span><?php echo date('d.m.Y', $article['created'] ?? time()); ?></span>
                            </div>
                        </div>
                        <p class="article-excerpt"><?php 
                            $excerpt = html_entity_decode(strip_tags($article['content']), ENT_QUOTES, 'UTF-8');
                            echo htmlspecialchars(mb_substr($excerpt, 0, 180)) . '...'; 
                        ?></p>
                        <span class="article-read-more">
                            <?php echo $currentLang === 'cz' ? 'Číst více' : 'Weiterlesen'; ?>
                        </span>
                    </div>
                </article>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>



