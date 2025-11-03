<?php
session_start();
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/../includes/article-functions.php';

// Check authentication
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

$slug = $_GET['slug'] ?? null;
$czArticle = $slug ? readArticle($slug, 'cz') : null;
$deArticle = $slug ? readArticle($slug, 'de') : null;

$message = '';
$messageType = '';

// Show success message if redirected after save
if (isset($_GET['saved'])) {
    $message = 'Článek byl úspěšně uložen.';
    $messageType = 'success';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title_cz = $_POST['title_cz'] ?? '';
    $title_de = $_POST['title_de'] ?? '';
    $content_cz = $_POST['content_cz'] ?? '';
    $content_de = $_POST['content_de'] ?? '';
    $image_url = $_POST['image_url'] ?? '';
    $article_url = trim($_POST['article_url'] ?? '');
    $published = isset($_POST['published']) && $_POST['published'] === '1';
    
    // Handle image upload
    $uploaded_image = null;
    if (isset($_FILES['article_image']) && $_FILES['article_image']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['article_image'];
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime_type = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);
        
        if (in_array($mime_type, $allowed_types) && $file['size'] <= MAX_UPLOAD_SIZE) {
            $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
            $filename = 'article_' . date('Y-m-d_His') . '_' . uniqid() . '.' . $extension;
            $destination = UPLOADS_DIR . $filename;
            
            if (move_uploaded_file($file['tmp_name'], $destination)) {
                $uploaded_image = SITE_URL . '/uploads/' . $filename;
            }
        }
    }
    
    // Use uploaded image or existing image URL
    $article_image = $uploaded_image ?: $image_url;
    
    // Handle slug/URL
    $oldSlug = $slug;
    
    if (!$slug && $title_cz) {
        // New article - generate slug from title or use provided URL
        if ($article_url) {
            $slug = generateSlug($article_url);
        } else {
            $slug = generateSlug($title_cz);
        }
        
        // Ensure unique slug
        $originalSlug = $slug;
        $counter = 1;
        while (file_exists(ARTICLES_DIR . $slug . '-cz.html')) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }
    } elseif ($slug && $article_url) {
        // Existing article - check if URL was changed
        $newSlug = generateSlug($article_url);
        if ($newSlug !== $slug) {
            // Check if new slug is valid and unique
            if (preg_match('/^[a-z0-9-]+$/', $newSlug)) {
                if (!file_exists(ARTICLES_DIR . $newSlug . '-cz.html')) {
                    // Rename article files
                    if (renameArticle($slug, $newSlug)) {
                        $slug = $newSlug;
                    } else {
                        $message = 'Nepodařilo se změnit URL adresu článku.';
                        $messageType = 'error';
                        $slug = $oldSlug; // Keep old slug
                    }
                } else {
                    $message = 'URL adresa článku již existuje. Zvolte jinou.';
                    $messageType = 'error';
                    $slug = $oldSlug; // Keep old slug
                }
            } else {
                $message = 'URL adresa obsahuje neplatné znaky. Použijte pouze malá písmena, čísla a pomlčky.';
                $messageType = 'error';
                $slug = $oldSlug; // Keep old slug
            }
        }
    }
    
    if ($slug && ($title_cz || $title_de)) {
        // Save article data with image and published status
        $articleData = [
            'title_cz' => $title_cz,
            'title_de' => $title_de,
            'content_cz' => $content_cz,
            'content_de' => $content_de,
            'image' => $article_image,
            'published' => $published
        ];
        
        // Save Czech version - add h1 title at the beginning
        if ($title_cz && $content_cz) {
            $czHtml = '<h1>' . htmlspecialchars($title_cz) . '</h1>' . $content_cz;
            saveArticle($slug, $czHtml, 'cz', $articleData);
        }
        
        // Save German version
        if ($title_de && $content_de) {
            $deHtml = '<h1>' . htmlspecialchars($title_de) . '</h1>' . $content_de;
            saveArticle($slug, $deHtml, 'de', $articleData);
        }
        
        $message = 'Článek byl úspěšně uložen.';
        $messageType = 'success';
        
        // If slug was changed, redirect to new URL
        if ($oldSlug && $slug !== $oldSlug) {
            header('Location: edit.php?slug=' . urlencode($slug) . '&saved=1');
            exit;
        }
        
        // Reload articles
        $czArticle = readArticle($slug, 'cz');
        $deArticle = readArticle($slug, 'de');
    } else {
        $message = 'Vyplňte alespoň název a obsah pro českou verzi.';
        $messageType = 'error';
    }
}
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $slug ? 'Upravit článek' : 'Nový článek'; ?> - <?php echo SITE_NAME; ?></title>
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>/assets/css/admin.css">
    <script src="https://cdn.tiny.cloud/1/sa1s92fbrat1qc1ipw1g9elncr8u3ma8xov7grh93okrv8bo/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#content_cz, #content_de',
            min_height: 400,
            menubar: false,
            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                'insertdatetime', 'media', 'table', 'code', 'help', 'wordcount', 'autoresize'
            ],
            toolbar_sticky: true,
            toolbar_sticky_offset: 0,
            autoresize_bottom_margin: 20,
            autoresize_on_init: true,
            setup: function(editor) {
                editor.on('init', function() {
                    // Wait a bit for content to load, then resize
                    setTimeout(function() {
                        if (editor.plugins.autoresize) {
                            editor.plugins.autoresize.resizeToContent();
                        }
                        // Also manually check content height
                        var iframe = editor.iframeElement;
                        if (iframe) {
                            var iframeDoc = iframe.contentDocument || iframe.contentWindow.document;
                            if (iframeDoc && iframeDoc.body) {
                                var contentHeight = Math.max(iframeDoc.body.scrollHeight, 400);
                                if (contentHeight > 400) {
                                    editor.theme.resizeTo(null, contentHeight + 120);
                                }
                            }
                        }
                    }, 300);
                });
                
                // Resize when content changes
                editor.on('keyup', function() {
                    setTimeout(function() {
                        if (editor.plugins.autoresize) {
                            editor.plugins.autoresize.resizeToContent();
                        }
                    }, 100);
                });
            },
            toolbar: 'undo redo | blocks | ' +
                'bold italic forecolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'link | removeformat | help | code',
            content_style: 'body { font-family:Inter,Arial,sans-serif; font-size:16px }',
            relative_urls: false,
            remove_script_host: false
        });
    </script>
</head>
<body class="admin-edit">
    <header class="admin-header admin-header-edit">
        <div class="container">
            <div class="header-controls-wrapper">
                <h1><?php echo $slug ? 'Upravit článek' : 'Nový článek'; ?></h1>
                <div class="header-controls-actions">
                    <a href="dashboard.php" class="btn btn-secondary">Zpět na seznam</a>
                    <div class="publish-toggle-control">
                        <label class="toggle-switch">
                            <input type="checkbox" name="published" value="1" id="published" form="article-form" <?php 
                            $isPublished = true;
                            if ($czArticle && isset($czArticle['published'])) {
                                $isPublished = $czArticle['published'];
                            }
                            echo $isPublished ? 'checked' : ''; 
                            ?>>
                            <span class="toggle-slider"></span>
                        </label>
                        <span class="toggle-label" id="toggle-label-text"><?php echo $isPublished ? 'Publikováno' : 'Skryto'; ?></span>
                    </div>
                    <button type="submit" form="article-form" class="btn btn-primary"><span>Uložit článek</span></button>
                </div>
            </div>
        </div>
    </header>
    
    <main class="admin-main">
        <div class="container">
            <?php if ($message): ?>
            <div class="alert alert-<?php echo $messageType; ?>"><?php echo htmlspecialchars($message); ?></div>
            <?php endif; ?>
            
            <form method="POST" enctype="multipart/form-data" id="article-form">
                <!-- Article URL/Slug -->
                <div class="form-group">
                    <label for="article_url">URL adresa článku</label>
                    <input type="text" id="article_url" name="article_url" 
                           value="<?php echo htmlspecialchars($slug ?? ''); ?>" 
                           placeholder="např. elektronicke-soudni-preklady-novy-standard"
                           pattern="[a-z0-9-]+"
                           oninput="this.value = this.value.toLowerCase().replace(/[^a-z0-9-]/g, '-').replace(/-+/g, '-').replace(/^-|-$/g, '')">
                    <p style="margin-top: 0.5rem; font-size: 0.875rem; color: var(--light-gray);">
                        Použijte pouze malá písmena, čísla a pomlčky. Adresa se automaticky upraví při zadávání.
                        <?php if ($slug): ?>
                        <br><strong>Aktuální adresa:</strong> <?php echo SITE_URL; ?>/cz/clanky/<?php echo htmlspecialchars($slug); ?>
                        <?php endif; ?>
                    </p>
                </div>
                
                <!-- Article Image -->
                <div class="form-group">
                    <label for="article_image">Hlavní obrázek článku</label>
                    <input type="file" id="article_image" name="article_image" accept="image/*">
                    <input type="hidden" name="image_url" id="image_url" value="<?php 
                        $currentImage = ($czArticle && isset($czArticle['image'])) ? $czArticle['image'] : '';
                        echo htmlspecialchars($currentImage);
                    ?>">
                    <?php if ($czArticle && isset($czArticle['image']) && $czArticle['image']): ?>
                    <div class="image-upload-preview">
                        <img src="<?php echo htmlspecialchars($czArticle['image']); ?>" alt="Current image" class="article-thumbnail">
                        <a href="#" class="remove-image" onclick="document.getElementById('image_url').value=''; this.parentElement.style.display='none'; return false;">Odstranit obrázek</a>
                    </div>
                    <?php endif; ?>
                    <p style="margin-top: 0.5rem; font-size: 0.875rem; color: var(--light-gray);">
                        Maximální velikost: <?php echo MAX_UPLOAD_SIZE / 1024 / 1024; ?>MB. Povolené formáty: JPEG, PNG, GIF, WebP
                    </p>
                </div>
                
                <div class="form-tabs">
                    <button type="button" class="tab-button active" data-tab="cz">Česká verze</button>
                    <button type="button" class="tab-button" data-tab="de">Německá verze</button>
                </div>
                
                <div class="tab-content active" id="tab-cz">
                    <div class="form-group">
                        <label for="title_cz">Název (česky) *</label>
                        <input type="text" id="title_cz" name="title_cz" 
                               value="<?php echo htmlspecialchars($czArticle ? strip_tags($czArticle['title']) : ''); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="content_cz">Obsah (česky) *</label>
                        <textarea id="content_cz" name="content_cz"><?php 
                            if ($czArticle) {
                                // Remove h1 from content (title is separate) and decode HTML entities
                                $content = preg_replace('/<h1[^>]*>.*?<\/h1>/s', '', $czArticle['content']);
                                echo htmlspecialchars($content);
                            }
                        ?></textarea>
                    </div>
                </div>
                
                <div class="tab-content" id="tab-de">
                    <div class="form-group">
                        <label for="title_de">Název (německy)</label>
                        <input type="text" id="title_de" name="title_de" 
                               value="<?php echo htmlspecialchars($deArticle ? strip_tags($deArticle['title']) : ''); ?>">
                    </div>
                    <div class="form-group">
                        <label for="content_de">Obsah (německy)</label>
                        <textarea id="content_de" name="content_de"><?php 
                            if ($deArticle) {
                                // Remove h1 from content (title is displayed separately)
                                $content = preg_replace('/<h1[^>]*>.*?<\/h1>/s', '', $deArticle['content']);
                                echo $content; // Don't use htmlspecialchars - TinyMCE needs HTML
                            }
                        ?></textarea>
                    </div>
                </div>
            </form>
        </div>
    </main>
    
    <script>
        // Tab switching
        document.querySelectorAll('.tab-button').forEach(button => {
            button.addEventListener('click', function() {
                const tab = this.dataset.tab;
                document.querySelectorAll('.tab-button').forEach(b => b.classList.remove('active'));
                document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
                this.classList.add('active');
                document.getElementById('tab-' + tab).classList.add('active');
            });
        });
        
        // Dynamic toggle label update and auto-save
        const toggleCheckbox = document.getElementById('published');
        const toggleLabel = document.getElementById('toggle-label-text');
        const articleForm = document.getElementById('article-form');
        let autoSaveTimeout;
        
        if (toggleCheckbox && articleForm) {
            toggleCheckbox.addEventListener('change', function() {
                toggleLabel.textContent = this.checked ? 'Publikováno' : 'Skryto';
                
                // Show saving indicator immediately
                const saveButton = document.querySelector('button[type="submit"][form="article-form"]');
                if (saveButton) {
                    const buttonSpan = saveButton.querySelector('span');
                    const originalText = buttonSpan ? buttonSpan.textContent : 'Uložit článek';
                    buttonSpan.textContent = 'Ukládám...';
                    saveButton.disabled = true;
                    saveButton.style.opacity = '0.7';
                }
                
                // Auto-save after toggle change
                clearTimeout(autoSaveTimeout);
                autoSaveTimeout = setTimeout(function() {
                    // Submit form
                    articleForm.requestSubmit();
                }, 300); // Wait 300ms for better UX
            });
        }
        
        // Image preview on file selection
        const articleImageInput = document.getElementById('article_image');
        const imagePreviewContainer = document.querySelector('.image-upload-preview');
        
        if (articleImageInput) {
            articleImageInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        // Update hidden input with current file (will be uploaded on save)
                        const imageUrl = document.getElementById('image_url');
                        
                        // Create or update preview
                        let previewContainer = document.querySelector('.image-upload-preview');
                        if (!previewContainer) {
                            previewContainer = document.createElement('div');
                            previewContainer.className = 'image-upload-preview';
                            previewContainer.innerHTML = '<img src="" alt="Preview" class="article-thumbnail"><a href="#" class="remove-image">Odstranit obrázek</a>';
                            
                            // Insert after file input
                            const formGroup = articleImageInput.closest('.form-group');
                            if (formGroup) {
                                articleImageInput.parentNode.insertBefore(previewContainer, articleImageInput.nextSibling);
                            }
                            
                            // Add remove functionality
                            const removeLink = previewContainer.querySelector('.remove-image');
                            if (removeLink) {
                                removeLink.onclick = function(event) {
                                    event.preventDefault();
                                    articleImageInput.value = '';
                                    if (imageUrl) imageUrl.value = '';
                                    previewContainer.style.display = 'none';
                                    return false;
                                };
                            }
                        }
                        
                        const img = previewContainer.querySelector('img');
                        if (img) {
                            img.src = e.target.result;
                            previewContainer.style.display = 'flex';
                        }
                    };
                    reader.readAsDataURL(file);
                }
            });
        }
        
    </script>
</body>
</html>

