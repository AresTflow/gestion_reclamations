# Dockerfile qui marche - Laravel sur Render
FROM php:8.2-cli-alpine

# Installation MINIMALE
RUN apk add --no-cache curl git

# Composer (méthode alternative)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

WORKDIR /var/www/html

# 1. Copier SEULEMENT composer.json d'abord
COPY composer.json composer.lock ./

# 2. Installer dépendances AVEC timeout augmenté
RUN composer install --no-dev --no-interaction --ignore-platform-reqs --no-scripts \
    --no-autoloader --prefer-dist

# 3. Copier tout
COPY . .

# 4. Générer autoloader
RUN composer dump-autoload --optimize --no-dev

# 5. .env SIMPLE
RUN echo "APP_ENV=production" > .env
RUN echo "APP_DEBUG=false" >> .env
RUN echo "APP_KEY=base64:izFMkW9mZV8lNZWgsyqDgVgS2b9nZLaaCNzxCZ8yL5I=" >> .env
RUN echo "DB_CONNECTION=sqlite" >> .env

# 6. SQLite file
RUN touch database/database.sqlite

EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]