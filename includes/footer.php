    <footer class="footer-modern">
        <div class="container">
            <div class="footer-content-minimal">
                <div class="footer-menu">
                    <a href="<?php echo getLangUrl('', getCurrentLanguage()); ?>" class="footer-menu-link"><?php echo getCurrentLanguage() === 'cz' ? 'Domů' : 'Start'; ?></a>
                    <span class="footer-separator">•</span>
                    <a href="<?php echo getLangUrl('o-mne', getCurrentLanguage()); ?>" class="footer-menu-link"><?php echo getCurrentLanguage() === 'cz' ? 'O mně' : 'Über mich'; ?></a>
                    <span class="footer-separator">•</span>
                    <a href="<?php echo getLangUrl('sluzby-cenik', getCurrentLanguage()); ?>" class="footer-menu-link"><?php echo getCurrentLanguage() === 'cz' ? 'Služby a ceník' : 'Leistungen und Preise'; ?></a>
                    <span class="footer-separator">•</span>
                    <a href="<?php echo getLangUrl('clanky', getCurrentLanguage()); ?>" class="footer-menu-link"><?php echo getCurrentLanguage() === 'cz' ? 'Články' : 'Artikel'; ?></a>
                    <span class="footer-separator">•</span>
                    <a href="<?php echo getLangUrl('kontakt', getCurrentLanguage()); ?>" class="footer-menu-link"><?php echo getCurrentLanguage() === 'cz' ? 'Kontakt' : 'Kontakt'; ?></a>
                </div>
                <div class="footer-info">
                    <div class="footer-info-item">
                        <div class="footer-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                            </svg>
                        </div>
                        <a href="tel:+420773253130" class="footer-link-item">+420 773 253 130</a>
                    </div>
                    <div class="footer-info-item">
                        <div class="footer-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                <polyline points="22,6 12,13 2,6"/>
                            </svg>
                        </div>
                        <a href="mailto:zidkova.ilona@seznam.cz" class="footer-link-item">zidkova.ilona@seznam.cz</a>
                    </div>
                    <div class="footer-info-item">
                        <div class="footer-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                <line x1="16" y1="2" x2="16" y2="6"/>
                                <line x1="8" y1="2" x2="8" y2="6"/>
                                <line x1="3" y1="10" x2="21" y2="10"/>
                            </svg>
                        </div>
                        <span class="footer-item">IČO: 724 06 607</span>
                    </div>
                    <div class="footer-info-item footer-copyright-wrapper">
                        <span class="footer-copyright">&copy; <?php echo date('Y'); ?> Ilona Žídková</span>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    
    <script src="<?php echo SITE_URL; ?>/assets/js/main.js"></script>
</body>
</html>
