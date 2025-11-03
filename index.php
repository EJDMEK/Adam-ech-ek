<?php
require_once __DIR__ . '/includes/language.php';
require_once __DIR__ . '/includes/article-functions.php';

$currentLang = getCurrentLanguage();

// Set language cookie if not set
if (!isset($_COOKIE['lang'])) {
    setLanguageCookie($currentLang);
}

$pageTitle = $currentLang === 'cz' ? 'Ilona Žídková – soudní překladatelka německého jazyka' : 'Ilona Žídková – Gerichtsdolmetscherin für Deutsch';
$metaDescription = $currentLang === 'cz' 
    ? 'Soudní a běžné překlady z/do němčiny pro firmy i jednotlivce. Elektronické soudní překlady s podpisem.'
    : 'Gerichts- und allgemeine Übersetzungen Deutsch-Tschechisch für Unternehmen und Einzelpersonen. Elektronische Gerichtsübersetzungen mit Signatur.';

// Get latest articles for preview
$latestArticles = getPublicArticles($currentLang, 3);

include __DIR__ . '/includes/header.php';
?>

<main>
    <!-- Hero Section -->
    <section class="hero-new" id="home">
        <div class="container">
            <div class="hero-layout">
                <div class="hero-content">
                    <h1><?php echo $currentLang === 'cz' 
                        ? 'Soudní a běžné překlady z a do němčiny' 
                        : 'Gerichts- und allgemeine Übersetzungen Deutsch-Tschechisch'; ?></h1>
                    <p class="hero-subtitle"><?php echo $currentLang === 'cz' 
                        ? 'Přesné, elektronicky podepsané a úředně ověřené překlady pro firmy i jednotlivce.' 
                        : 'Präzise und zuverlässige Gerichts- und allgemeine Übersetzungen von und nach Deutsch. Elektronisch signiert, mit Stempel und im Einklang mit den Anforderungen von Behörden und Unternehmen.'; ?></p>
                    <div style="display: flex; gap: 1rem; flex-wrap: wrap; margin-top: 1.25rem;">
                        <a href="<?php echo getLangUrl('kontakt', $currentLang); ?>" class="cta-button-new">
                            <?php echo $currentLang === 'cz' ? 'Poptat překlad' : 'Angebot anfordern'; ?>
                        </a>
                        <a href="<?php echo getLangUrl('sluzby-cenik', $currentLang); ?>" class="cta-button-secondary">
                            <?php echo $currentLang === 'cz' ? 'Služby a ceník' : 'Leistungen und Preise'; ?>
                        </a>
                    </div>
                </div>
                <div class="hero-image">
                    <img src="<?php echo SITE_URL; ?>/heroimage.svg" alt="Soudní překlady">
                </div>
            </div>
            <!-- Company Carousel -->
            <div class="company-carousel-section">
                <p class="carousel-title"><?php echo $currentLang === 'cz' 
                    ? 'Na překladech pro tyto firmy jsem spolupracovala v rámci agenturní činnosti' 
                    : 'Ich habe bei Übersetzungen für diese Unternehmen im Rahmen der Agenturtätigkeit zusammengearbeitet'; ?></p>
                <div class="company-carousel-wrapper">
                    <div class="company-carousel">
                        <div class="company-logo">
                            <img src="<?php echo SITE_URL; ?>/loga firem/Honeywell_logo.svg" alt="Honeywell">
                        </div>
                        <div class="company-logo">
                            <img src="<?php echo SITE_URL; ?>/loga firem/Škoda_Works_logo.svg" alt="Škoda Works">
                        </div>
                        <div class="company-logo">
                            <img src="<?php echo SITE_URL; ?>/loga firem/philips.svg" alt="Philips">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- O mně Section -->
    <section class="section about-compact" id="o-mne">
        <div class="container">
            <div class="about-compact-card">
                <div class="about-compact-header-title">
                    <h2 class="about-compact-title"><?php echo $currentLang === 'cz' ? 'O mně' : 'Über mich'; ?></h2>
                </div>
                <div class="about-compact-header">
                    <div class="about-photo-compact">
                        <div class="photo-ring">
                            <img src="<?php echo SITE_URL; ?>/ilona zidkova.jpeg" alt="Ilona Žídková" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                            <div class="photo-placeholder" style="display:none;">
                                <svg width="400" height="500" viewBox="0 0 400 500" fill="none">
                                    <rect width="400" height="500" fill="#F5F5F5"/>
                                    <circle cx="200" cy="200" r="60" fill="#999999"/>
                                    <path d="M100 350 L300 350" stroke="#999999" stroke-width="3"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="about-info-compact">
                        <h2 class="about-name-compact">Mgr. Ilona Žídková</h2>
                        <p class="about-title-compact"><?php echo $currentLang === 'cz' 
                            ? 'Soudní překladatelka německého jazyka' 
                            : 'Gerichtsdolmetscherin für Deutsch'; ?></p>
                        <div class="about-meta-compact">
                            <span class="meta-item"><?php echo $currentLang === 'cz' ? 'Od 2010' : 'Seit 2010'; ?></span>
                            <span class="meta-divider">•</span>
                            <span class="meta-item"><?php echo $currentLang === 'cz' ? '20+ let praxe' : '20+ Jahre Erfahrung'; ?></span>
                            <span class="meta-divider">•</span>
                            <a href="https://www.linkedin.com/in/ilona-%C5%BE%C3%ADdkov%C3%A1-78726999/" target="_blank" rel="noopener noreferrer" class="meta-link">
                                LinkedIn
                            </a>
                            <span class="meta-divider">•</span>
                            <span class="meta-item"><?php echo $currentLang === 'cz' ? 'Datová schránka: zbcsft6' : 'Datenschrank: zbcsft6'; ?></span>
                        </div>
                    </div>
                </div>
                
                <div class="about-content-compact">
                    <p class="about-text-compact"><?php echo $currentLang === 'cz' 
                        ? 'Jazykům se věnuji celý život – od prvních lekcí němčiny s rakouskou ORF v dětství, přes studium anglické a německé filologie na Filozofické fakultě Univerzity Palackého, až po profesionální praxi v oblasti překladatelství a tlumočení. Od roku 2000 působím jako profesionální překladatelka a tlumočnice, od roku 2010 také jako soudní překladatelka německého jazyka jmenovaná Ministerstvem spravedlnosti ČR.'
                        : 'Ich widme mich Sprachen mein ganzes Leben lang – von den ersten Deutschstunden mit dem österreichischen ORF in meiner Kindheit, über das Studium der englischen und deutschen Philologie an der Philosophischen Fakultät der Palacký-Universität, bis hin zur professionellen Praxis im Bereich Übersetzung und Dolmetschen. Seit 2000 bin ich als professionelle Übersetzerin und Dolmetscherin tätig, seit 2010 auch als Gerichtsdolmetscherin für Deutsch, ernannt vom Justizministerium der Tschechischen Republik.'; ?></p>
                    
                    <div class="skills-compact-grid">
                        <div class="skill-compact">
                            <div class="skill-icon-compact">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 6L9 17l-5-5"/>
                                </svg>
                            </div>
                            <div class="skill-text-compact">
                                <strong><?php echo $currentLang === 'cz' ? 'Pečlivost' : 'Sorgfalt'; ?></strong>
                                <span><?php echo $currentLang === 'cz' 
                                    ? 'Každé slovo má své místo a význam.' 
                                    : 'Jedes Wort hat seinen Platz und seine Bedeutung.'; ?></span>
                            </div>
                        </div>
                        <div class="skill-compact">
                            <div class="skill-icon-compact">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                                    <path d="M9 12l2 2 4-4"/>
                                </svg>
                            </div>
                            <div class="skill-text-compact">
                                <strong><?php echo $currentLang === 'cz' ? 'Spolehlivost' : 'Zuverlässigkeit'; ?></strong>
                                <span><?php echo $currentLang === 'cz' 
                                    ? 'Kontrola zdrojů a paralelních textů.' 
                                    : 'Kontrolle von Quellen und parallelen Texten.'; ?></span>
                            </div>
                        </div>
                        <div class="skill-compact">
                            <div class="skill-icon-compact">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="3" width="7" height="7"/>
                                    <rect x="14" y="3" width="7" height="7"/>
                                    <rect x="14" y="14" width="7" height="7"/>
                                    <rect x="3" y="14" width="7" height="7"/>
                                </svg>
                            </div>
                            <div class="skill-text-compact">
                                <strong><?php echo $currentLang === 'cz' ? 'Konzistence' : 'Konsistenz'; ?></strong>
                                <span><?php echo $currentLang === 'cz' 
                                    ? 'Používání CAT nástrojů pro jednotnou terminologii.' 
                                    : 'Verwendung von CAT-Tools für einheitliche Terminologie.'; ?></span>
                            </div>
                        </div>
                        <div class="skill-compact">
                            <div class="skill-icon-compact">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"/>
                                    <polyline points="12 6 12 12 16 14"/>
                                </svg>
                            </div>
                            <div class="skill-text-compact">
                                <strong><?php echo $currentLang === 'cz' ? 'Zkušenosti' : 'Erfahrung'; ?></strong>
                                <span><?php echo $currentLang === 'cz' 
                                    ? 'Více než 20 let praxe v právním, technickém a úředním prostředí.' 
                                    : 'Mehr als 20 Jahre Praxis in rechtlicher, technischer und behördlicher Umgebung.'; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Služby a Ceník Section -->
    <section class="section services-pricing-combined" id="sluzby-cenik">
        <div class="container">
            <div class="combined-header">
                <h2 class="combined-title"><?php echo $currentLang === 'cz' ? 'Služby a ceník' : 'Leistungen und Preise'; ?></h2>
                <p class="combined-subtitle"><?php echo $currentLang === 'cz' 
                    ? 'Poskytuji soudní i běžné překlady z a do němčiny – přesně, včas a v souladu s požadavky úřadů i firem.'
                    : 'Ich biete Gerichts- und allgemeine Übersetzungen von und nach Deutsch – präzise, rechtzeitig und im Einklang mit den Anforderungen von Behörden und Unternehmen.'; ?></p>
            </div>
            
            <div class="combined-grid">
                <div class="combined-card">
                    <div class="combined-icon">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="4" y="2" width="16" height="20" rx="2" ry="2"/>
                            <path d="M9 22v-4h6v4"/>
                            <path d="M8 6h8"/>
                            <path d="M8 10h8"/>
                            <path d="M8 14h4"/>
                            <path d="M10 6V2h4v4"/>
                        </svg>
                    </div>
                    <h3><?php echo $currentLang === 'cz' ? 'Soudní překlady' : 'Gerichtsübersetzungen'; ?></h3>
                    <p class="combined-text"><?php echo $currentLang === 'cz' 
                        ? 'Ověřené překlady z a do němčiny (tzv. „s kulatým razítkem") určené pro úřady, soudy a instituce. Rodné a oddací listy, diplomy, vysvědčení, smlouvy, výpisy z rejstříků.'
                        : 'Beglaubigte Übersetzungen von und nach Deutsch (sog. „mit runden Stempel") für Behörden, Gerichte und Institutionen. Geburts- und Heiratsurkunden, Diplome, Zeugnisse, Verträge, Registerauszüge.'; ?></p>
                    <div class="combined-price">
                        <span class="combined-price-amount"><?php echo $currentLang === 'cz' ? 'od 550 Kč' : 'ab 550 CZK'; ?></span>
                        <span class="combined-price-unit">/ NS</span>
                    </div>
                    <p class="combined-price-note"><?php echo $currentLang === 'cz' 
                        ? 'Ceny jsou orientační a mohou se lišit podle rozsahu, typu dokumentu a termínu dodání.'
                        : 'Die Preise sind Richtwerte und können je nach Umfang, Dokumenttyp und Liefertermin variieren.'; ?></p>
                </div>
                
                <div class="combined-card">
                    <div class="combined-icon">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="3" width="20" height="14" rx="2" ry="2"/>
                            <line x1="8" y1="21" x2="16" y2="21"/>
                            <line x1="12" y1="17" x2="12" y2="21"/>
                        </svg>
                    </div>
                    <h3><?php echo $currentLang === 'cz' ? 'Elektronické soudní překlady' : 'Elektronische Gerichtsübersetzungen'; ?></h3>
                    <p class="combined-text"><?php echo $currentLang === 'cz' 
                        ? 'Ověřený překlad v digitální podobě s elektronickou doložkou a kvalifikovaným podpisem soudního překladatele. Plně akceptován úřady i institucemi.'
                        : 'Beglaubigte Übersetzung in digitaler Form mit elektronischer Bescheinigung und qualifizierter Signatur des Gerichtsdolmetschers. Vollständig von Behörden und Institutionen akzeptiert.'; ?></p>
                    <div class="combined-price">
                        <span class="combined-price-amount"><?php echo $currentLang === 'cz' ? 'od 550 Kč' : 'ab 550 CZK'; ?></span>
                        <span class="combined-price-unit">/ NS</span>
                    </div>
                    <p class="combined-price-note"><?php echo $currentLang === 'cz' 
                        ? 'Ceny jsou orientační a mohou se lišit podle rozsahu, typu dokumentu a termínu dodání.'
                        : 'Die Preise sind Richtwerte und können je nach Umfang, Dokumenttyp und Liefertermin variieren.'; ?></p>
                </div>
                
                <div class="combined-card">
                    <div class="combined-icon">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                            <polyline points="14 2 14 8 20 8"/>
                            <line x1="9" y1="15" x2="15" y2="15"/>
                            <line x1="9" y1="12" x2="15" y2="12"/>
                        </svg>
                    </div>
                    <h3><?php echo $currentLang === 'cz' ? 'Běžné překlady' : 'Allgemeine Übersetzungen'; ?></h3>
                    <p class="combined-text"><?php echo $currentLang === 'cz' 
                        ? 'Přesné a srozumitelné překlady obecných i odborných textů – právní, technické, obchodní, marketingové.'
                        : 'Präzise und verständliche Übersetzungen allgemeiner und fachlicher Texte – rechtlich, technisch, geschäftlich, marketingbezogen.'; ?></p>
                    <div class="combined-price">
                        <span class="combined-price-amount"><?php echo $currentLang === 'cz' ? 'od 270 Kč' : 'ab 270 CZK'; ?></span>
                        <span class="combined-price-unit">/ NS</span>
                    </div>
                    <p class="combined-price-note"><?php echo $currentLang === 'cz' 
                        ? 'Ceny jsou orientační a mohou se lišit podle rozsahu, typu dokumentu a termínu dodání.'
                        : 'Die Preise sind Richtwerte und können je nach Umfang, Dokumenttyp und Liefertermin variieren.'; ?></p>
                </div>
            </div>
            
            <div class="combined-cta-new">
                <div class="combined-cta-content">
                    <h3 class="combined-cta-title"><?php echo $currentLang === 'cz' 
                        ? 'Nejste si jistí, jaký typ překladu potřebujete?'
                        : 'Sind Sie sich nicht sicher, welche Art von Übersetzung Sie benötigen?'; ?></h3>
                    <p class="combined-cta-description"><?php echo $currentLang === 'cz' 
                        ? 'Pošlete dokument ke zpracování a ráda Vám doporučím vhodné řešení.'
                        : 'Senden Sie das Dokument zur Bearbeitung und ich empfehle Ihnen gerne eine passende Lösung.'; ?></p>
                    <a href="<?php echo getLangUrl('kontakt', $currentLang); ?>" class="combined-cta-button-new">
                        <?php echo $currentLang === 'cz' ? 'Nezávazně poptat překlad' : 'Unverbindlich Übersetzung anfordern'; ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Kontakt Section -->
    <section class="section contact-modern" id="kontakt">
        <div class="container">
            <div class="contact-modern-header">
                <h2 class="contact-modern-title"><?php echo $currentLang === 'cz' ? 'Kontakt' : 'Kontakt'; ?></h2>
                <p class="contact-modern-subtitle"><?php echo $currentLang === 'cz' 
                    ? 'Potřebujete překlad? Ráda se s Vámi spojím a pomohu Vám najít to nejlepší řešení.'
                    : 'Benötigen Sie eine Übersetzung? Ich kontaktiere Sie gerne und helfe Ihnen, die beste Lösung zu finden.'; ?></p>
            </div>
            
            <div class="contact-modern-grid">
                <!-- Kontaktní informace - karty -->
                <div class="contact-modern-info-wrapper">
                    <div class="contact-modern-info">
                        <div class="contact-card">
                            <div class="contact-card-icon">
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                    <circle cx="12" cy="7" r="4"/>
                                </svg>
                            </div>
                            <div class="contact-card-content">
                                <h4><?php echo $currentLang === 'cz' ? 'Jméno' : 'Name'; ?></h4>
                                <p style="font-weight: 500;">Ilona Žídková</p>
                            </div>
                        </div>
                    
                    <div class="contact-card">
                        <div class="contact-card-icon">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                            </svg>
                        </div>
                        <div class="contact-card-content">
                            <h4><?php echo $currentLang === 'cz' ? 'Telefon' : 'Telefon'; ?></h4>
                            <a href="tel:+420773253130">+420 773 253 130</a>
                        </div>
                    </div>
                    
                    <div class="contact-card">
                        <div class="contact-card-icon">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                <polyline points="22,6 12,13 2,6"/>
                            </svg>
                        </div>
                        <div class="contact-card-content">
                            <h4><?php echo $currentLang === 'cz' ? 'E-mail' : 'E-Mail'; ?></h4>
                            <a href="mailto:zidkova.ilona@seznam.cz">zidkova.ilona@seznam.cz</a>
                        </div>
                    </div>
                    
                    <div class="contact-card">
                        <div class="contact-card-icon">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                <circle cx="12" cy="10" r="3"/>
                            </svg>
                        </div>
                        <div class="contact-card-content">
                            <h4><?php echo $currentLang === 'cz' ? 'Adresa' : 'Adresse'; ?></h4>
                            <p>Podštampilí 777<br>Velký Týnec, 783 72</p>
                        </div>
                    </div>
                    
                    <div class="contact-card">
                        <div class="contact-card-icon">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="21 16 21 22 3 22 3 16"/>
                                <line x1="7" y1="16" x2="7" y2="2"/>
                                <line x1="17" y1="16" x2="17" y2="2"/>
                                <path d="M7 2h10"/>
                            </svg>
                        </div>
                        <div class="contact-card-content">
                            <h4><?php echo $currentLang === 'cz' ? 'Datová schránka' : 'Datenschließfach'; ?></h4>
                            <p>zbcsft6</p>
                        </div>
                    </div>
                </div>
                </div>
                
                <!-- Kontaktní formulář -->
                <div class="contact-modern-form-wrapper">
                    <div class="contact-form-modern">
                        <h3 class="form-modern-title"><?php echo $currentLang === 'cz' ? 'Napište mi zprávu' : 'Schreiben Sie mir'; ?></h3>
                        
                        <form method="POST" action="<?php echo SITE_URL; ?>/kontakt.php" enctype="multipart/form-data" class="form-modern">
                            <div class="form-row-modern">
                                <div class="form-group-modern">
                                    <label for="contact_name_mod"><?php echo $currentLang === 'cz' ? 'Jméno a příjmení' : 'Vor- und Nachname'; ?></label>
                                    <input type="text" id="contact_name_mod" name="name" placeholder="<?php echo $currentLang === 'cz' ? 'Vaše jméno' : 'Ihr Name'; ?>" required>
                                </div>
                                
                                <div class="form-group-modern">
                                    <label for="contact_email_mod"><?php echo $currentLang === 'cz' ? 'E-mail' : 'E-Mail'; ?></label>
                                    <input type="email" id="contact_email_mod" name="email" placeholder="<?php echo $currentLang === 'cz' ? 'vas@email.cz' : 'ihr@email.de'; ?>" required>
                                </div>
                            </div>
                            
                            <div class="form-group-modern">
                                <label for="contact_subject_mod"><?php echo $currentLang === 'cz' ? 'Typ překladu / předmět' : 'Übersetzungstyp / Betreff'; ?></label>
                                <input type="text" id="contact_subject_mod" name="subject" placeholder="<?php echo $currentLang === 'cz' ? 'Soudní překlad rodného listu' : 'Gerichtsübersetzung Geburtsurkunde'; ?>">
                            </div>
                            
                            <div class="form-group-modern">
                                <label for="contact_message_mod"><?php echo $currentLang === 'cz' ? 'Zpráva' : 'Nachricht'; ?></label>
                                <textarea id="contact_message_mod" name="message" rows="6" placeholder="<?php echo $currentLang === 'cz' ? 'Zde napište podrobnosti o Vašem požadavku...' : 'Geben Sie hier Details zu Ihrer Anfrage ein...'; ?>" required></textarea>
                            </div>
                            
                            <button type="submit" class="form-modern-submit">
                                <span><?php echo $currentLang === 'cz' ? 'Odeslat zprávu' : 'Nachricht senden'; ?></span>
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="22" y1="2" x2="11" y2="13"/>
                                    <polygon points="22 2 15 22 11 13 2 9 22 2"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog/Articles Section -->
    <section class="section articles-section" id="blog-preview">
        <div class="container">
            <div class="articles-header">
                <h2 class="articles-title"><?php echo $currentLang === 'cz' ? 'Články a aktuality' : 'Artikel und Aktuelles'; ?></h2>
                <p class="articles-subtitle"><?php echo $currentLang === 'cz' 
                    ? 'Zajímavosti, postřehy a praktické informace ze světa překladatelství a soudních překladů.'
                    : 'Interessantes, Beobachtungen und praktische Informationen aus der Welt der Übersetzung und Gerichtsübersetzungen.'; ?></p>
            </div>
            
            <?php if (!empty($latestArticles)): ?>
                <div class="articles-grid">
                    <?php foreach ($latestArticles as $article): ?>
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
            <?php else: ?>
                <!-- Demo articles if no articles in database -->
                <div class="articles-grid">
                    <article class="article-card" onclick="window.location.href='<?php echo getLangUrl('kontakt', $currentLang); ?>'" style="cursor: pointer;">
                        <div class="article-card-content">
                            <h3><?php echo $currentLang === 'cz' ? 'Elektronické soudní překlady – nový standard' : 'Elektronische Gerichtsübersetzungen – neuer Standard'; ?></h3>
                            <p class="article-excerpt"><?php echo $currentLang === 'cz' 
                                ? 'Elektronicky podepsané překlady s doložkou a kvalifikovaným podpisem přinášejí větší pohodlí i právní jistotu. Jak tento proces funguje a kdy ho můžete využít?'
                                : 'Elektronisch signierte Übersetzungen mit Bescheinigung und qualifizierter Signatur bieten mehr Komfort und Rechtssicherheit. Wie funktioniert dieser Prozess und wann können Sie ihn nutzen?'; ?></p>
                            <span class="article-read-more">
                                <?php echo $currentLang === 'cz' ? 'Číst více' : 'Weiterlesen'; ?>
                            </span>
                        </div>
                    </article>
                    
                    <article class="article-card" onclick="window.location.href='<?php echo getLangUrl('kontakt', $currentLang); ?>'" style="cursor: pointer;">
                        <div class="article-card-content">
                            <h3><?php echo $currentLang === 'cz' ? 'Jak probíhá ověřený překlad krok za krokem' : 'Wie läuft eine beglaubigte Übersetzung Schritt für Schritt ab'; ?></h3>
                            <p class="article-excerpt"><?php echo $currentLang === 'cz' 
                                ? 'Od zaslání dokumentu po finální svázání s razítkem. Podívejte se, co vše zahrnuje proces soudního překladu a kdy je ověření potřeba.'
                                : 'Von der Übersendung des Dokuments bis zur finalen Verbindung mit dem Stempel. Sehen Sie, was der Prozess der Gerichtsübersetzung umfasst und wann eine Beglaubigung erforderlich ist.'; ?></p>
                            <span class="article-read-more">
                                <?php echo $currentLang === 'cz' ? 'Číst více' : 'Weiterlesen'; ?>
                            </span>
                        </div>
                    </article>
                    
                    <article class="article-card" onclick="window.location.href='<?php echo getLangUrl('kontakt', $currentLang); ?>'" style="cursor: pointer;">
                        <div class="article-card-content">
                            <h3><?php echo $currentLang === 'cz' ? 'Překlad a přepis: není to totéž' : 'Übersetzung und Abschrift: nicht dasselbe'; ?></h3>
                            <p class="article-excerpt"><?php echo $currentLang === 'cz' 
                                ? 'Mnoho klientů si plete překlad, přepis a lokalizaci. Vysvětluji, jak se tyto pojmy liší a proč je důležité vybrat správnou formu.'
                                : 'Viele Kunden verwechseln Übersetzung, Abschrift und Lokalisierung. Ich erkläre, wie sich diese Begriffe unterscheiden und warum es wichtig ist, die richtige Form zu wählen.'; ?></p>
                            <span class="article-read-more">
                                <?php echo $currentLang === 'cz' ? 'Číst více' : 'Weiterlesen'; ?>
                            </span>
                        </div>
                    </article>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>
