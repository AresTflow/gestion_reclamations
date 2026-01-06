# Dockerfile
FROM php:8.2-cli

# Dépendances minimales
RUN apt-get update && apt-get install -y \
    curl git unzip sqlite3 \
    && docker-php-ext-install pdo_mysql pdo_sqlite \
    && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copier tout
COPY . .

# Installer dépendances
RUN composer install --no-dev --optimize-autoloader

# Configuration minimale
RUN echo "APP_ENV=production" > .env && \
    echo "APP_DEBUG=false" >> .env && \
    echo "APP_KEY=base64:izFMkW9mZV8lNZWgsyqDgVgS2b9nZLaaCNzxCZ8yL5I=" >> .env && \
    echo "DB_CONNECTION=sqlite" >> .env

# Créer database.sqlite
RUN touch database/database.sqlite && chmod 755 database/database.sqlite

EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]