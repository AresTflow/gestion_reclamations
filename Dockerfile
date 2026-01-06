# Dockerfile simplifié - Sans build frontend
FROM php:8.2-fpm-alpine

# Dépendances minimales
RUN apk update && apk add --no-cache \
    bash curl git unzip \
    libpng-dev libzip-dev zip oniguruma-dev

# Extensions PHP essentielles
RUN docker-php-ext-install pdo_mysql mbstring zip

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copier et installer
COPY . .
RUN composer install --no-dev --optimize-autoloader

# Permissions Laravel
RUN chmod -R 755 storage bootstrap/cache

# Port Render
EXPOSE 8000

# Commande Render
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]