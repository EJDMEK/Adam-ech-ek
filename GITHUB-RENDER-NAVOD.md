# Nasazení na Render.com přes GitHub

Kompletní návod pro nahrání webu na GitHub a nasazení na Render.com.

---

## Krok 1: Příprava projektu pro GitHub

### 1.1. Git konfigurace

Projekt je připravený pro GitHub. Všechny soubory budou nahrány včetně `admin/config.php`.

### 1.2. Vytvoření Git repozitáře (pokud ještě není)

Otevřete terminál v této složce a spusťte:

```bash
cd "/Users/admin/Documents/preklad nemcina web"

# Inicializace Git (pokud ještě není inicializovaný)
git init

# Přidání všech souborů
git add .

# První commit
git commit -m "Initial commit - Překladatelský web"
```

---

## Krok 2: Vytvoření repozitáře na GitHub

### 2.1. Vytvořte nový repozitář na GitHub

1. Jděte na [github.com](https://github.com) a přihlaste se
2. Klikněte na **"+"** → **"New repository"**
3. Vyplňte:
   - **Repository name:** `preklad-nemcina-web` (nebo jiný název)
   - **Description:** "Ilona Žídková - Soudní překlady němčina"
   - **Visibility:** Private (doporučeno) nebo Public
   - ✅ **NECHCE** zaškrtnout "Initialize with README" (soubory už máte)

4. Klikněte na **"Create repository"**

### 2.2. Připojte lokální repozitář k GitHubu

GitHub vám ukáže příkazy. Použijte tyto (nahraďte `YOUR_USERNAME` a `YOUR_REPO_NAME`):

```bash
# Přidání remote repozitáře (nahraďte URL vaším)
git remote add origin https://github.com/YOUR_USERNAME/YOUR_REPO_NAME.git

# Přejmenování hlavní větve na main (pokud je potřeba)
git branch -M main

# Nahrání na GitHub
git push -u origin main
```

**Poznámka:** Pokud používáte SSH klíč, použijte SSH URL:
```bash
git remote add origin git@github.com:YOUR_USERNAME/YOUR_REPO_NAME.git
```

---

## Krok 3: Nasazení na Render.com

### 3.1. Vytvoření účtu a připojení GitHub

1. Jděte na [render.com](https://render.com)
2. Klikněte na **"Get Started for Free"**
3. Přihlaste se pomocí **GitHub** (doporučeno - jednodušší připojení)

### 3.2. Vytvoření Web Service

1. Po přihlášení klikněte na **"New +"** → **"Web Service"**
2. Vyberte **"Connect GitHub"** nebo **"Connect GitLab"**
3. Autorizujte Render k přístupu k vašim repozitářům
4. Vyberte repozitář `preklad-nemcina-web`
5. Klikněte na **"Connect"**

### 3.3. Konfigurace na Render

Render automaticky detekuje `render.yaml`, ale zkontrolujte nastavení:

- **Name:** `preklad-nemcina-web` (nebo jiný název)
- **Region:** Vyberte nejblíže (např. Frankfurt pro Evropu)
- **Branch:** `main` (nebo vaše hlavní větev)
- **Runtime:** `PHP` (měl by být automaticky detekován)
- **Build Command:** (prázdné - není potřeba)
- **Start Command:** `php -S 0.0.0.0:$PORT router.php` (měl by být automaticky z render.yaml)

### 3.4. Environment Variables (volitelné)

V sekci **"Environment"** můžete přidat:
- `PHP_VERSION` = `8.2` (pokud není v render.yaml)

### 3.5. Nasazení

1. Klikněte na **"Create Web Service"**
2. Render začne nasazovat web (obvykle 2-5 minut)
3. Počkejte na dokončení

**Důležité:** Po prvním nasazení dostanete URL typu: `https://preklad-nemcina-web.onrender.com`

---

## Krok 4: Konfigurace po nasazení

### 4.1. Vytvoření config.php na Render

Po nasazení musíte vytvořit `admin/config.php`:

**Možnost A: Přes Render Shell**

1. V Render dashboardu klikněte na vaši službu
2. Jděte na **"Shell"** (vlevo v menu)
3. Spusťte:
```bash
cd /opt/render/project/src
cp admin/config.php.example admin/config.php
nano admin/config.php
```

4. Upravte:
   - `SITE_URL` = vaše Render URL (např. `https://preklad-nemcina-web.onrender.com`)
   - `ADMIN_PASSWORD_HASH` = změňte heslo
   - `CONTACT_EMAIL` = váš email

5. Uložte: `Ctrl+X`, pak `Y`, pak `Enter`

**Možnost B: Přes GitHub (doporučeno pro trvalé řešení)**

1. Vytvořte `admin/config.php` lokálně (zkopírujte z `config.php.example`)
2. Upravte hodnoty (SITE_URL, heslo, email)
3. Přidejte do `.gitignore` výjimku nebo použijte environment variables

**POZORNOST:** `admin/config.php` obsahuje heslo. Pokud jste ho přidali do Git, zvažte použití Render Environment Variables místo toho.

### 4.2. Render Environment Variables (lepší způsob)

Místo config.php můžete použít environment variables:

V Render → Environment → Add Environment Variable:

- `SITE_URL` = `https://preklad-nemcina-web.onrender.com`
- `CONTACT_EMAIL` = `your-email@domain.com`
- `ADMIN_USERNAME` = `admin`
- `ADMIN_PASSWORD_HASH` = (hash hesla - použijte PHP `password_hash()`)

**Jak získat hash hesla:**
```php
<?php
echo password_hash('VASE_HESLO', PASSWORD_DEFAULT);
?>
```

---

## Krok 5: Aktualizace webu

Při každé změně v kódu:

```bash
# Přidat změny
git add .

# Commit
git commit -m "Popis změn"

# Nahrání na GitHub
git push
```

Render automaticky:
- ✅ Detekuje změny na GitHubu
- ✅ Znovu nasadí web
- ✅ Aktualizuje URL

---

## Kontrola a testování

### Po nasazení zkontrolujte:

1. ✅ Web se načítá: `https://your-app.onrender.com`
2. ✅ Admin panel funguje: `https://your-app.onrender.com/admin/login.php`
3. ✅ Kontaktní formulář funguje
4. ✅ Články se zobrazují
5. ✅ Obrázky se načítají

---

## Řešení problémů

### Web se nenačítá
- Zkontrolujte, že `router.php` existuje v kořenové složce
- Zkontrolujte Render logs (v dashboardu)
- Ověřte, že Start Command je správný

### Admin panel nefunguje
- Zkontrolujte, že `admin/config.php` existuje na serveru
- Ověřte, že SITE_URL je správně nastavená
- Zkontrolujte oprávnění složek (obvykle není potřeba měnit)

### Kontaktní formulář nefunguje
- Zkontrolujte `CONTACT_EMAIL` v config.php
- Ověřte, že Render podporuje `mail()` funkci
- Zkontrolujte Render logs pro chybové hlášky

---

## Výhody Render.com

- ✅ **Automatické nasazení** při push na GitHub
- ✅ **HTTPS zdarma** automaticky
- ✅ **Škálovatelnost** - automatické škálování
- ✅ **Backup** - vše je na GitHubu
- ✅ **Logy** - snadné sledování chyb

---

## Důležité poznámky

- ⚠️ Render má **free tier**, ale služby se "uspí" po 15 minutách neaktivity (první požadavek pak může trvat 30-60 sekund)
- ⚠️ Pokud máte `admin/config.php` v Git repozitáři, zvažte použití Environment Variables místo toho pro větší bezpečnost

---

## Rychlý checklist

- [ ] Git inicializovaný lokálně
- [ ] Repozitář vytvořený na GitHub
- [ ] Soubory nahrány na GitHub
- [ ] Účet vytvořený na Render
- [ ] Render připojen k GitHub repozitáři
- [ ] Web Service vytvořený na Render
- [ ] `admin/config.php` vytvořený na Render
- [ ] SITE_URL nastavená správně
- [ ] Web funguje a testován

---

**Hotovo!** 🎉 Váš web je online na Render.com!

