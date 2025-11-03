<?php
/**
 * Configuration file for admin panel
 */

// Admin credentials (default password - CHANGE IN PRODUCTION!)
define('ADMIN_USERNAME', 'admin');
define('ADMIN_PASSWORD_HASH', password_hash('admin123', PASSWORD_DEFAULT)); // Default: admin123

// Email settings for contact form
define('CONTACT_EMAIL', 'info@soudnipreklady-nemcina.cz'); // Change to actual email
define('EMAIL_SUBJECT_PREFIX', '[Soudní překlady]');

// Paths
define('ARTICLES_DIR', __DIR__ . '/../articles/');
define('UPLOADS_DIR', __DIR__ . '/../uploads/');
define('CONTACT_SUBMISSIONS_DIR', __DIR__ . '/../contact-submissions/');

// Upload settings
define('MAX_UPLOAD_SIZE', 5 * 1024 * 1024); // 5MB
define('ALLOWED_IMAGE_TYPES', ['image/jpeg', 'image/png', 'image/gif', 'image/webp']);

// Session settings
define('SESSION_NAME', 'admin_session');
define('SESSION_LIFETIME', 3600 * 24); // 24 hours

// Site settings
define('SITE_NAME', 'Ilona Žídková - Soudní překlady němčina');
define('SITE_URL', 'http://localhost:8000'); // Change for production

// Ensure directories exist
if (!file_exists(ARTICLES_DIR)) {
    mkdir(ARTICLES_DIR, 0755, true);
}
if (!file_exists(UPLOADS_DIR)) {
    mkdir(UPLOADS_DIR, 0755, true);
}
if (!file_exists(CONTACT_SUBMISSIONS_DIR)) {
    mkdir(CONTACT_SUBMISSIONS_DIR, 0755, true);
}
?>



