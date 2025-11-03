<?php
require_once __DIR__ . '/includes/language.php';

$currentLang = getCurrentLanguage();
$pageTitle = $currentLang === 'cz' ? 'Služby' : 'Leistungen';
$metaDescription = $currentLang === 'cz' 
    ? 'Soudní překlady, běžné překlady a odborné překlady z/do němčiny'
    : 'Gerichtsübersetzungen, allgemeine Übersetzungen und Fachübersetzungen Deutsch-Tschechisch';

include __DIR__ . '/includes/header.php';
?>

<main>
    <section class="section">
        <div class="container">
            <h1 class="section-title"><?php echo $currentLang === 'cz' ? 'Služby' : 'Leistungen'; ?></h1>
            
            <div class="services-grid">
                <div class="service-card">
                    <h3><?php echo $currentLang === 'cz' ? 'Soudní překlady' : 'Gerichtsübersetzungen'; ?></h3>
                    <p><?php echo $currentLang === 'cz' 
                        ? 'Ověřené překlady s kulatým razítkem z češtiny do němčiny a naopak. Elektronické soudní překlady s digitálním podpisem jsou moderní a rychlá alternativa k tradičním tištěným překladům.'
                        : 'Beglaubigte Übersetzungen mit runden Stempel von Tschechisch nach Deutsch und umgekehrt. Elektronische Gerichtsübersetzungen mit digitaler Signatur sind eine moderne und schnelle Alternative zu traditionellen Druckübersetzungen.'; ?></p>
                    <h4 style="margin-top: 1.5rem; margin-bottom: 0.5rem;"><?php echo $currentLang === 'cz' ? 'Typy dokumentů:' : 'Dokumententypen:'; ?></h4>
                    <ul>
                        <li><?php echo $currentLang === 'cz' ? 'Rodné, oddací a úmrtní listy' : 'Geburts-, Heirats- und Sterbeurkunden'; ?></li>
                        <li><?php echo $currentLang === 'cz' ? 'Vysvědčení, diplomy, certifikáty' : 'Zeugnisse, Diplome, Zertifikate'; ?></li>
                        <li><?php echo $currentLang === 'cz' ? 'Výpisy z rejstříku trestů' : 'Strafregisterauszüge'; ?></li>
                        <li><?php echo $currentLang === 'cz' ? 'Výpisy z obchodního rejstříku' : 'Handelsregisterauszüge'; ?></li>
                        <li><?php echo $currentLang === 'cz' ? 'Čestná prohlášení' : 'Eidesstattliche Erklärungen'; ?></li>
                        <li><?php echo $currentLang === 'cz' ? 'Plné moci' : 'Vollmachten'; ?></li>
                        <li><?php echo $currentLang === 'cz' ? 'Smlouvy' : 'Verträge'; ?></li>
                        <li><?php echo $currentLang === 'cz' ? 'Žaloby a právní dokumenty' : 'Klagen und Rechtsdokumente'; ?></li>
                    </ul>
                    <p style="margin-top: 1rem; color: var(--secondary-gray);">
                        <strong><?php echo $currentLang === 'cz' ? 'Cena:' : 'Preis:'; ?></strong> <?php echo $currentLang === 'cz' ? '550 Kč / NS (sazba MSp ČR)' : '550 CZK / NS (Tarif Justizministerium)'; ?>
                    </p>
                </div>

                <div class="service-card">
                    <h3><?php echo $currentLang === 'cz' ? 'Běžné překlady' : 'Allgemeine Übersetzungen'; ?></h3>
                    <p><?php echo $currentLang === 'cz' 
                        ? 'Překlady bez razítka pro běžné použití. Vhodné pro osobní i firemní dokumenty, které nevyžadují úřední ověření.'
                        : 'Übersetzungen ohne Stempel für den allgemeinen Gebrauch. Geeignet für persönliche und geschäftliche Dokumente, die keine amtliche Beglaubigung erfordern.'; ?></p>
                    <h4 style="margin-top: 1.5rem; margin-bottom: 0.5rem;"><?php echo $currentLang === 'cz' ? 'Jazyky:' : 'Sprachen:'; ?></h4>
                    <ul>
                        <li><?php echo $currentLang === 'cz' ? 'Čeština ↔ Němčina' : 'Tschechisch ↔ Deutsch'; ?></li>
                        <li><?php echo $currentLang === 'cz' ? 'Čeština ↔ Angličtina' : 'Tschechisch ↔ Englisch'; ?></li>
                    </ul>
                    <h4 style="margin-top: 1.5rem; margin-bottom: 0.5rem;"><?php echo $currentLang === 'cz' ? 'Typy dokumentů:' : 'Dokumententypen:'; ?></h4>
                    <ul>
                        <li><?php echo $currentLang === 'cz' ? 'Obecné texty a korespondence' : 'Allgemeine Texte und Korrespondenz'; ?></li>
                        <li><?php echo $currentLang === 'cz' ? 'Obchodní materiály' : 'Geschäftsmaterialien'; ?></li>
                        <li><?php echo $currentLang === 'cz' ? 'Marketingové texty' : 'Marketingtexte'; ?></li>
                        <li><?php echo $currentLang === 'cz' ? 'Osobní dokumenty' : 'Persönliche Dokumente'; ?></li>
                    </ul>
                    <p style="margin-top: 1rem; color: var(--secondary-gray);">
                        <strong><?php echo $currentLang === 'cz' ? 'Cena:' : 'Preis:'; ?></strong> <?php echo $currentLang === 'cz' ? 'od 270 Kč / NS' : 'ab 270 CZK / NS'; ?>
                    </p>
                </div>

                <div class="service-card">
                    <h3><?php echo $currentLang === 'cz' ? 'Odborné překlady' : 'Fachübersetzungen'; ?></h3>
                    <p><?php echo $currentLang === 'cz' 
                        ? 'Specializované překlady technických a právních dokumentů. Spolupracuji s agenturami překladů (České překlady, Panorama, Lingua) i přímo s firmami.'
                        : 'Spezialisierte Übersetzungen technischer und rechtlicher Dokumente. Ich arbeite mit Übersetzungsagenturen (České překlady, Panorama, Lingua) sowie direkt mit Unternehmen zusammen.'; ?></p>
                    <h4 style="margin-top: 1.5rem; margin-bottom: 0.5rem;"><?php echo $currentLang === 'cz' ? 'Oblasti:' : 'Bereiche:'; ?></h4>
                    <ul>
                        <li><?php echo $currentLang === 'cz' ? 'Technické manuály a dokumentace' : 'Technische Handbücher und Dokumentation'; ?></li>
                        <li><?php echo $currentLang === 'cz' ? 'Stavební projekty' : 'Bauprojekte'; ?></li>
                        <li><?php echo $currentLang === 'cz' ? 'Právní dokumenty a smlouvy' : 'Rechtsdokumente und Verträge'; ?></li>
                        <li><?php echo $currentLang === 'cz' ? 'Normy a technické specifikace' : 'Normen und technische Spezifikationen'; ?></li>
                        <li><?php echo $currentLang === 'cz' ? 'Stanovy společností' : 'Gesellschaftssatzungen'; ?></li>
                    </ul>
                    <h4 style="margin-top: 1.5rem; margin-bottom: 0.5rem;"><?php echo $currentLang === 'cz' ? 'Reference:' : 'Referenzen:'; ?></h4>
                    <p style="color: var(--secondary-gray);">
                        Honeywell, Škoda Vagonka, Philips
                    </p>
                    <p style="margin-top: 1rem; color: var(--secondary-gray);">
                        <strong><?php echo $currentLang === 'cz' ? 'Cena:' : 'Preis:'; ?></strong> <?php echo $currentLang === 'cz' ? 'Individuálně podle rozsahu a náročnosti' : 'Individuell nach Umfang und Komplexität'; ?>
                    </p>
                </div>
            </div>

            <div style="margin-top: 3rem; padding: 2rem; background-color: var(--bg-light); border-radius: 8px; text-align: center;">
                <h3 style="margin-bottom: 1rem;"><?php echo $currentLang === 'cz' ? 'Zajímá vás některá služba?' : 'Interessiert Sie eine Leistung?'; ?></h3>
                <a href="<?php echo getLangUrl('kontakt', $currentLang); ?>" class="cta-button">
                    <?php echo $currentLang === 'cz' ? 'Kontaktujte mě' : 'Kontaktieren Sie mich'; ?>
                </a>
            </div>
        </div>
    </section>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>




