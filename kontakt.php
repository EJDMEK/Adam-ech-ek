<?php
require_once __DIR__ . '/includes/language.php';
require_once __DIR__ . '/admin/config.php';

$currentLang = getCurrentLanguage();
$pageTitle = $currentLang === 'cz' ? 'Kontakt' : 'Kontakt';
$metaDescription = $currentLang === 'cz' 
    ? 'Kontaktujte mě pro překladatelské služby. Email, telefon, adresa.'
    : 'Kontaktieren Sie mich für Übersetzungsdienstleistungen. E-Mail, Telefon, Adresse.';

$message = '';
$messageType = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
    $message_text = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);
    $file_uploaded = false;
    
    if ($name && $email && $message_text) {
        // Handle file upload if present
        $uploaded_file_path = null;
        if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
            $uploaded_file_path = handleContactFileUpload($_FILES['file']);
            if ($uploaded_file_path) {
                $file_uploaded = true;
            }
        }
        
        // Save submission to file
        $submission = [
            'timestamp' => date('Y-m-d H:i:s'),
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'message' => $message_text,
            'file' => $uploaded_file_path,
            'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown'
        ];
        
        $submission_file = CONTACT_SUBMISSIONS_DIR . date('Y-m-d_His') . '_' . uniqid() . '.json';
        file_put_contents($submission_file, json_encode($submission, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        
        // Send email
        $email_subject = EMAIL_SUBJECT_PREFIX . ' ' . ($currentLang === 'cz' ? 'Nový kontakt z webu' : 'Neue Kontaktanfrage von der Website');
        $email_body = ($currentLang === 'cz' ? "Nový kontakt z webu\n\n" : "Neue Kontaktanfrage von der Website\n\n") .
            ($currentLang === 'cz' ? 'Jméno: ' : 'Name: ') . $name . "\n" .
            ($currentLang === 'cz' ? 'Email: ' : 'E-Mail: ') . $email . "\n" .
            ($currentLang === 'cz' ? 'Telefon: ' : 'Telefon: ') . ($phone ?: '-') . "\n\n" .
            ($currentLang === 'cz' ? 'Zpráva:' : 'Nachricht:') . "\n" . $message_text;
        
        if ($uploaded_file_path) {
            $email_body .= "\n\n" . ($currentLang === 'cz' ? 'Přiložený soubor: ' : 'Angehängte Datei: ') . $uploaded_file_path;
        }
        
        $email_sent = @mail(CONTACT_EMAIL, $email_subject, $email_body, 
            'From: ' . $email . "\r\n" . 
            'Reply-To: ' . $email . "\r\n" . 
            'Content-Type: text/plain; charset=UTF-8');
        
        $message = $currentLang === 'cz' 
            ? 'Děkujeme! Vaše zpráva byla odeslána. Odpovím vám co nejdříve.'
            : 'Vielen Dank! Ihre Nachricht wurde gesendet. Ich werde Ihnen so schnell wie möglich antworten.';
        $messageType = 'success';
    } else {
        $message = $currentLang === 'cz' 
            ? 'Prosím vyplňte všechna povinná pole.'
            : 'Bitte füllen Sie alle Pflichtfelder aus.';
        $messageType = 'error';
    }
}

function handleContactFileUpload($file) {
    if ($file['error'] !== UPLOAD_ERR_OK) {
        return null;
    }
    
    // Validate file type
    $allowed_types = ['application/pdf', 'application/msword', 
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'text/plain', 'image/jpeg', 'image/png'];
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime_type = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);
    
    if (!in_array($mime_type, $allowed_types)) {
        return null;
    }
    
    // Validate file size (max 10MB)
    if ($file['size'] > 10 * 1024 * 1024) {
        return null;
    }
    
    // Generate safe filename
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filename = date('Y-m-d_His') . '_' . uniqid() . '.' . $extension;
    $destination = CONTACT_SUBMISSIONS_DIR . $filename;
    
    if (move_uploaded_file($file['tmp_name'], $destination)) {
        return $filename;
    }
    
    return null;
}

include __DIR__ . '/includes/header.php';
?>

<main>
    <!-- Kontakt Section -->
    <section class="section contact-modern" id="kontakt">
        <div class="container">
            <div class="contact-modern-header">
                <h2 class="contact-modern-title"><?php echo $currentLang === 'cz' ? 'Kontakt' : 'Kontakt'; ?></h2>
                <p class="contact-modern-subtitle"><?php echo $currentLang === 'cz' 
                    ? 'Potřebujete překlad? Ráda se s Vámi spojím a pomohu Vám najít to nejlepší řešení.'
                    : 'Benötigen Sie eine Übersetzung? Ich kontaktiere Sie gerne und helfe Ihnen, die beste Lösung zu finden.'; ?></p>
            </div>
            
            <?php if ($message): ?>
            <div class="alert alert-<?php echo $messageType; ?>" style="max-width: 800px; margin: 0 auto 2rem; padding: 1rem; border-radius: 8px;">
                <?php echo htmlspecialchars($message); ?>
            </div>
            <?php endif; ?>
            
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
                                <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/>
                            </svg>
                        </div>
                        <div class="contact-card-content">
                            <h4><?php echo $currentLang === 'cz' ? 'IČO' : 'IČO'; ?></h4>
                            <p>724 06 607</p>
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
                        
                        <form method="POST" action="<?php echo getLangUrl('kontakt', $currentLang); ?>" enctype="multipart/form-data" class="form-modern">
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
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>
