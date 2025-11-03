<?php
require_once __DIR__ . '/includes/language.php';

$currentLang = getCurrentLanguage();

$pageTitle = $currentLang === 'cz' ? 'O mně' : 'Über mich';
$metaDescription = $currentLang === 'cz' 
    ? 'Ilona Žídková - soudní překladatelka německého jazyka jmenovaná Ministerstvem spravedlnosti'
    : 'Ilona Žídková - Gerichtsdolmetscherin für Deutsch, ernannt vom Justizministerium';

include __DIR__ . '/includes/header.php';
?>

<main>
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
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>
