# Použití oficiálního PHP obrazu
FROM php:8.2-cli

# Nastavení pracovního adresáře
WORKDIR /var/www/html

# Kopírování všech souborů do kontejneru
COPY . .

# Exponování portu (Render nastaví $PORT)
EXPOSE 8080

# Spuštění PHP built-in serveru s routerem
CMD php -S 0.0.0.0:${PORT:-8080} router.php

