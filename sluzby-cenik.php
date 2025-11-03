<?php
require_once __DIR__ . '/includes/language.php';

$currentLang = getCurrentLanguage();

$pageTitle = $currentLang === 'cz' ? 'Služby a ceník' : 'Leistungen und Preise';
$metaDescription = $currentLang === 'cz' 
    ? 'Soudní překlady, běžné překlady a odborné překlady z/do němčiny s ceníkem'
    : 'Gerichtsübersetzungen, allgemeine Übersetzungen und Fachübersetzungen Deutsch-Tschechisch mit Preisliste';

include __DIR__ . '/includes/header.php';
?>

<main>
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
                        : 'Beglaubigte Übersetzung in digitaler Form mit elektronischer Bescheinigung und qualifizierter Signatur des Gerichtsübersetzers. Vollständig von Behörden und Institutionen akzeptiert.'; ?></p>
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
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>

