# Website Ilona Žídková - Soudní překlady němčina

Profesionální web pro soudní překladatelku německého jazyka s funkčním CMS systémem pro správu článků.

## Technické požadavky

- PHP 8.0 nebo vyšší
- Apache web server s mod_rewrite
- Podpora pro .htaccess

## Lokální instalace a spuštění

### Varianta 1: PHP built-in server (pro testování)

1. Otevřete terminál v kořenovém adresáři projektu
2. Spusťte:
```bash
php -S localhost:8000
```
3. Otevřete v prohlížeči: `http://localhost:8000`

### Varianta 2: XAMPP / MAMP

1. Zkopírujte projekt do složky web serveru:
   - XAMPP: `C:\xampp\htdocs\` (Windows) nebo `/Applications/XAMPP/htdocs/` (Mac)
   - MAMP: `/Applications/MAMP/htdocs/`
2. Otevřete v prohlížeči: `http://localhost/preklad-nemcina-web`

## Konfigurace

### 1. Admin přístup

Výchozí přihlašovací údaje:
- **Uživatelské jméno:** `admin`
- **Heslo:** `admin123`

**DŮLEŽITÉ:** Změňte heslo v produkci! Upravte soubor `admin/config.php`:

```php
define('ADMIN_PASSWORD_HASH', password_hash('VASE_NOVE_HESLO', PASSWORD_DEFAULT));
```

### 2. Email pro kontaktní formulář

Upravte v `admin/config.php`:

```php
define('CONTACT_EMAIL', 'vas-email@domena.cz');
```

### 3. URL webu

Pro produkci upravte v `admin/config.php`:

```php
define('SITE_URL', 'https://morano.cz');
```

## Struktura projektu

```
/
├── admin/              # Administrační rozhraní
│   ├── config.php      # Konfigurace (heslo, email, cesty)
│   ├── login.php       # Přihlášení
│   ├── dashboard.php   # Seznam článků
│   ├── edit.php        # Editor článků (TinyMCE)
│   ├── delete.php      # Mazání článků
│   └── upload-handler.php
├── articles/           # Uložené články (HTML soubory)
├── uploads/            # Nahrané obrázky z článků
├── contact-submissions/ # Odeslané kontaktní formuláře
├── includes/           # PHP funkce
│   ├── header.php      # Hlavička stránky
│   ├── footer.php      # Patička stránky
│   ├── language.php    # Jazykové funkce
│   └── article-functions.php
├── assets/             # CSS, JS, obrázky
├── index.php           # Hlavní stránka
├── sluzby.php          # Stránka služeb
├── cenik.php           # Ceník
├── kontakt.php         # Kontaktní formulář
├── clanky.php          # Blog / články
├── sitemap.php         # Dynamický sitemap
└── .htaccess           # URL rewrite pravidla
```

## Správa článků

### Přidání článku

1. Přihlaste se do admin panelu: `http://localhost:8000/admin/login.php`
2. Klikněte na "Přidat nový článek"
3. Vyplňte:
   - **Název (česky)** - povinné
   - **Obsah (česky)** - povinné (TinyMCE editor)
   - **Název (německy)** - volitelné
   - **Obsah (německy)** - volitelné
4. Klikněte na "Uložit článek"

Slug se automaticky vygeneruje z českého názvu (SEO-friendly).

### Úprava článku

1. V dashboardu klikněte na "Upravit" u příslušného článku
2. Upravte obsah a uložte

### Mazání článku

1. V dashboardu klikněte na "Smazat"
2. Potvrďte smazání

## Nahávání obrázků

V editoru TinyMCE:
1. Klikněte na ikonu obrázku
2. Vyberte "Upload" nebo vložte URL
3. Vyberte soubor (JPEG, PNG, GIF, WebP, max 5MB)
4. Obrázek se automaticky nahraje do složky `/uploads/`

## Jazyky

Web podporuje dva jazyky:
- **Čeština (CZ)** - výchozí
- **Němčina (DE)**

URL struktura:
- `http://domena.cz/cz/` - česká verze
- `http://domena.cz/de/` - německá verze

Jazyková preference se ukládá do cookie.

## Kontaktní formulář

Formulář:
- Odesílá email na adresu z `config.php`
- Ukládá submise do `/contact-submissions/` jako JSON soubory
- Podporuje nahrání souboru (PDF, DOC, DOCX, TXT, obrázky, max 10MB)

## SEO

- Dynamický sitemap: `/sitemap.php`
- Robots.txt: `/robots.txt`
- SEO-friendly URL: `/clanky/[slug]/`
- Dynamické meta tagy pro každou stránku

## Nasazení

### Render.com (doporučeno)

Web je připravený pro nasazení na Render.com přes GitHub.

**Podrobný návod:** Viz [GITHUB-RENDER-NAVOD.md](GITHUB-RENDER-NAVOD.md)

**Rychlý postup:**
1. Nahrajte projekt na GitHub
2. Vytvořte Web Service na Render.com
3. Připojte GitHub repozitář
4. Render automaticky nasadí web
5. Vytvořte `admin/config.php` z `admin/config.php.example` na Render
6. Upravte konfiguraci (heslo, email, SITE_URL)

### Tradiční hosting (Wedos, Web4U, atd.)

1. Nahrajte všechny soubory na server přes FTP nebo File Manager
2. Ujistěte se, že Apache má povolený `mod_rewrite`
3. Vytvořte `admin/config.php` z `admin/config.php.example`:
   - Nastavte `SITE_URL` na vaši doménu
   - Změňte admin heslo
   - Nastavte správný kontaktní email
4. Zkontrolujte oprávnění složek (přes FTP klient nebo File Manager):
   - `articles/` - 755 (nebo 777 pokud je potřeba)
   - `uploads/` - 755 (nebo 777 pokud je potřeba)
   - `contact-submissions/` - 755 (nebo 777 pokud je potřeba)
5. Otestujte funkcionalitu admin panelu a formulářů

## Bezpečnost

- Hesla jsou hashována pomocí `password_hash()`
- Session-based autentizace
- Validace nahrávaných souborů (typ, velikost)
- XSS ochrana (htmlspecialchars)
- Admin adresář by měl být chráněn přes .htaccess (nastaveno)

## Podpora

Pro dotazy a problémy kontaktujte vývojáře nebo administrátora.



