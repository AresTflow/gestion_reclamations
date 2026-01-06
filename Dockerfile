# Dockerfile optimisé pour Laravel + SQLite sur Render
FROM php:8.2-fpm-alpine

# Installer les dépendances système
RUN apk update && apk add --no-cache \
    bash \
    curl \
    git \
    unzip \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libwebp-dev \
    libzip-dev \
    zip \
    oniguruma-dev \
    sqlite \
    sqlite-dev

# Installer les extensions PHP
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install \
    pdo_mysql \
    pdo_sqlite \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    zip

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Répertoire de travail
WORKDIR /var/www/html

# 1. Copier les fichiers de dépendances
COPY composer.json composer.lock ./

# 2. Installer les dépendances PHP
RUN composer install --no-dev --no-interaction --optimize-autoloader --no-scripts

# 3. Copier le reste de l'application
COPY . .

# 4. CRÉER .env AVEC TA CLÉ EXISTANTE (pas de key:generate)
RUN echo "APP_NAME=\"Gestion Réclamations\"" > .env && \
    echo "APP_ENV=production" >> .env && \
    echo "APP_KEY=base64:izFMkW9mZV8lNZWgsyqDgVgS2b9nZLaaCNzxCZ8yL5I=" >> .env && \
    echo "APP_DEBUG=false" >> .env && \
    echo "APP_URL=http://localhost:8000" >> .env && \
    echo "DB_CONNECTION=sqlite" >> .env && \
    echo "CACHE_DRIVER=file" >> .env && \
    echo "SESSION_DRIVER=file" >> .env && \
    echo "QUEUE_CONNECTION=sync" >> .env && \
    echo "LOG_LEVEL=error" >> .env

# 5. Créer le fichier SQLite et configurer les permissions
RUN touch database/database.sqlite && \
    chown -R www-data:www-data /var/www/html/storage \
    /var/www/html/bootstrap/cache \
    database/database.sqlite && \
    chmod -R 755 /var/www/html/storage \
    /var/www/html/bootstrap/cache \
    database/database.sqlite

# 6. SUPPRIMÉ: php artisan key:generate --no-interaction --force
# (La clé est déjà définie ci-dessus)

# 7. Exécuter les migrations
RUN php artisan migrate --force --no-interaction

# 8. Optimiser Laravel
RUN php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache

# Port pour Render
EXPOSE 8000

# Commande pour Render
CMD php artisan serve --host=0.0.0.0 --port=8000