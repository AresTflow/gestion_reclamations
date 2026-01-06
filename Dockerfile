FROM php:8.2-alpine

RUN apk add --no-cache curl

RUN curl -sS https://getcomposer.org/composer.phar -o /usr/local/bin/composer && \
    chmod +x /usr/local/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --ignore-platform-reqs

# CORRECTIONS POUR 500 ERROR
RUN echo "APP_ENV=production" > .env
RUN echo "APP_DEBUG=true" >> .env  # ← TRUE pour voir les erreurs
RUN echo "APP_KEY=base64:izFMkW9mZV8lNZWgsyqDgVgS2b9nZLaaCNzxCZ8yL5I=" >> .env
RUN echo "DB_CONNECTION=sqlite" >> .env

# PERMISSIONS CRITIQUES
RUN chmod -R 775 storage bootstrap/cache
RUN chown -R www-data:www-data storage bootstrap/cache

# CLEAR CACHE LARAVEL
RUN php artisan config:clear
RUN php artisan cache:clear
RUN php artisan view:clear

# CRÉER SQLITE
RUN touch database/database.sqlite
RUN chmod 775 database/database.sqlite

EXPOSE 8000

CMD php artisan serve --host=0.0.0.0 --port=8000