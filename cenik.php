<?php
require_once __DIR__ . '/includes/language.php';

$currentLang = getCurrentLanguage();
$pageTitle = $currentLang === 'cz' ? 'Ceník' : 'Preise';
$metaDescription = $currentLang === 'cz' 
    ? 'Ceník překladatelských služeb - soudní překlady, běžné překlady, odborné překlady'
    : 'Preise für Übersetzungsdienstleistungen - Gerichtsübersetzungen, allgemeine Übersetzungen, Fachübersetzungen';

include __DIR__ . '/includes/header.php';
?>

<main>
    <section class="section">
        <div class="container">
            <h1 class="section-title"><?php echo $currentLang === 'cz' ? 'Ceník' : 'Preise'; ?></h1>
            
            <div class="pricing-table">
                <div class="pricing-item">
                    <div class="pricing-item-header">
                        <h3><?php echo $currentLang === 'cz' ? 'Běžné překlady' : 'Allgemeine Übersetzungen'; ?></h3>
                        <div>
                            <span class="price">od 270 Kč</span>
                            <div class="price-note">/ NS</div>
                        </div>
                    </div>
                    <p style="color: var(--secondary-gray); margin-top: 0.5rem;">
                        <?php echo $currentLang === 'cz' 
                            ? 'Překlady bez razítka z/do češtiny, němčiny, angličtiny'
                            : 'Übersetzungen ohne Stempel von/nach Tschechisch, Deutsch, Englisch'; ?>
                    </p>
                </div>

                <div class="pricing-item">
                    <div class="pricing-item-header">
                        <h3><?php echo $currentLang === 'cz' ? 'Soudní překlady' : 'Gerichtsübersetzungen'; ?></h3>
                        <div>
                            <span class="price">550 Kč</span>
                            <div class="price-note">/ NS</div>
                        </div>
                    </div>
                    <p style="color: var(--secondary-gray); margin-top: 0.5rem;">
                        <?php echo $currentLang === 'cz' 
                            ? 'Ověřené překlady s kulatým razítkem (sazba MSp ČR). Elektronické soudní překlady s podpisem.'
                            : 'Beglaubigte Übersetzungen mit runden Stempel (Tarif Justizministerium). Elektronische Gerichtsübersetzungen mit Signatur.'; ?>
                    </p>
                </div>

                <div class="pricing-item">
                    <div class="pricing-item-header">
                        <h3><?php echo $currentLang === 'cz' ? 'Odborné překlady' : 'Fachübersetzungen'; ?></h3>
                        <div>
                            <span class="price"><?php echo $currentLang === 'cz' ? 'Individuálně' : 'Individuell'; ?></span>
                        </div>
                    </div>
                    <p style="color: var(--secondary-gray); margin-top: 0.5rem;">
                        <?php echo $currentLang === 'cz' 
                            ? 'Cena podle rozsahu, náročnosti a termínu dodání. Sleva za opakování textů.'
                            : 'Preis je nach Umfang, Komplexität und Liefertermin. Rabatt für wiederholte Texte.'; ?>
                    </p>
                </div>
            </div>

            <div style="margin-top: 3rem; padding: 2rem; background-color: var(--bg-light); border-radius: 8px;">
                <h3 style="margin-bottom: 1rem;"><?php echo $currentLang === 'cz' ? 'Poznámky k cenám' : 'Hinweise zu Preisen'; ?></h3>
                <ul style="list-style: none; color: var(--secondary-gray);">
                    <li style="padding: 0.5rem 0; padding-left: 1.5rem; position: relative;">
                        <span style="position: absolute; left: 0; color: var(--accent-yellow);">•</span>
                        <?php echo $currentLang === 'cz' 
                            ? 'NS = normostrana (1800 znaků včetně mezer)'
                            : 'NS = Normseite (1800 Zeichen inklusive Leerzeichen)'; ?>
                    </li>
                    <li style="padding: 0.5rem 0; padding-left: 1.5rem; position: relative;">
                        <span style="position: absolute; left: 0; color: var(--accent-yellow);">•</span>
                        <?php echo $currentLang === 'cz' 
                            ? 'Konečná cena se může lišit podle rozsahu a náročnosti dokumentu'
                            : 'Der Endpreis kann je nach Umfang und Komplexität des Dokuments variieren'; ?>
                    </li>
                    <li style="padding: 0.5rem 0; padding-left: 1.5rem; position: relative;">
                        <span style="position: absolute; left: 0; color: var(--accent-yellow);">•</span>
                        <?php echo $currentLang === 'cz' 
                            ? 'Překlady zasílám elektronicky i poštou'
                            : 'Ich sende Übersetzungen elektronisch und per Post'; ?>
                    </li>
                    <li style="padding: 0.5rem 0; padding-left: 1.5rem; position: relative;">
                        <span style="position: absolute; left: 0; color: var(--accent-yellow);">•</span>
                        <?php echo $currentLang === 'cz' 
                            ? 'Možná sleva za opakování textů při větším objemu'
                            : 'Möglicher Rabatt für wiederholte Texte bei größerem Volumen'; ?>
                    </li>
                </ul>
            </div>

            <div style="margin-top: 3rem; text-align: center;">
                <h3 style="margin-bottom: 1rem;"><?php echo $currentLang === 'cz' ? 'Chcete získat konkrétní cenovou nabídku?' : 'Möchten Sie ein konkretes Preisangebot erhalten?'; ?></h3>
                <a href="<?php echo getLangUrl('kontakt', $currentLang); ?>" class="cta-button">
                    <?php echo $currentLang === 'cz' ? 'Kontaktujte mě' : 'Kontaktieren Sie mich'; ?>
                </a>
            </div>
        </div>
    </section>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>




