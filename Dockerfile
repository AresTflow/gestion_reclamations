# Dockerfile
FROM php:8.2-fpm-alpine

# Dépendances minimales
RUN apk update && apk add --no-cache \
    bash curl git unzip \
    libpng-dev libzip-dev zip oniguruma-dev sqlite

# Extensions essentielles
RUN docker-php-ext-install pdo_mysql pdo_sqlite mbstring zip

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copier et installer
COPY . .
RUN composer install --no-dev --optimize-autoloader

# Configuration .env basique
RUN echo "APP_ENV=production" > .env && \
    echo "APP_DEBUG=false" >> .env && \
    echo "APP_KEY=base64:izFMkW9mZV8lNZWgsyqDgVgS2b9nZLaaCNzxCZ8yL5I=" >> .env && \
    echo "DB_CONNECTION=sqlite" >> .env

# Permissions
RUN chmod -R 755 storage bootstrap/cache

EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]