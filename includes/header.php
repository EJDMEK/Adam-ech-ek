<?php
require_once __DIR__ . '/../admin/config.php';
require_once __DIR__ . '/language.php';

$currentLang = getCurrentLanguage();
$langName = getLanguageName();
?>
<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars($currentLang); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? htmlspecialchars($pageTitle) . ' - ' : ''; ?><?php echo htmlspecialchars(SITE_NAME); ?></title>
    <?php if (isset($metaDescription)): ?>
    <meta name="description" content="<?php echo htmlspecialchars($metaDescription); ?>">
    <?php endif; ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>/assets/css/style.css">
</head>
<body>
    <header class="main-header">
        <div class="container">
            <nav class="main-nav">
                <a href="<?php echo getLangUrl('', $currentLang); ?>" class="logo">
                    <img src="<?php echo SITE_URL; ?>/ilona zidkova logo alpha.svg" alt="Ilona Žídková" onerror="this.style.display='none'; this.nextElementSibling.style.display='inline-block';">
                    <span class="logo-text" style="display:none;">Ilona Žídková</span>
                </a>
                <ul class="nav-menu">
                    <li><a href="<?php echo getLangUrl('', $currentLang); ?>"><?php echo $currentLang === 'cz' ? 'Domů' : 'Start'; ?></a></li>
                    <li><a href="<?php echo getLangUrl('o-mne', $currentLang); ?>"><?php echo $currentLang === 'cz' ? 'O mně' : 'Über mich'; ?></a></li>
                    <li><a href="<?php echo getLangUrl('sluzby-cenik', $currentLang); ?>"><?php echo $currentLang === 'cz' ? 'Služby a ceník' : 'Leistungen und Preise'; ?></a></li>
                    <li><a href="<?php echo getLangUrl('clanky', $currentLang); ?>"><?php echo $currentLang === 'cz' ? 'Články' : 'Artikel'; ?></a></li>
                    <li><a href="<?php echo getLangUrl('kontakt', $currentLang); ?>"><?php echo $currentLang === 'cz' ? 'Kontakt' : 'Kontakt'; ?></a></li>
                </ul>
                <div class="lang-switcher">
                    <a href="<?php echo getLangUrl(getCurrentPagePath(), 'cz'); ?>" class="lang-link <?php echo $currentLang === 'cz' ? 'active' : ''; ?>">
                        <span class="lang-flag">🇨🇿</span>
                        <span class="lang-code">CZ</span>
                    </a>
                    <a href="<?php echo getLangUrl(getCurrentPagePath(), 'de'); ?>" class="lang-link <?php echo $currentLang === 'de' ? 'active' : ''; ?>">
                        <span class="lang-flag">🇩🇪</span>
                        <span class="lang-code">DE</span>
                    </a>
                </div>
                <button class="mobile-menu-toggle" aria-label="Toggle menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </nav>
        </div>
    </header>
