FROM php:8.2-alpine

RUN apk add --no-cache curl sqlite

RUN curl -sS https://getcomposer.org/composer.phar -o /usr/local/bin/composer && \
    chmod +x /usr/local/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --ignore-platform-reqs

# .env COMPLET avec file cache
RUN echo "APP_ENV=local" > .env
RUN echo "APP_DEBUG=true" >> .env
RUN echo "APP_KEY=base64:izFMkW9mZV8lNZWgsyqDgVgS2b9nZLaaCNzxCZ8yL5I=" >> .env
RUN echo "APP_URL=http://localhost" >> .env
RUN echo "" >> .env
RUN echo "DB_CONNECTION=sqlite" >> .env
RUN echo "" >> .env
RUN echo "# FORCE FILE CACHE - NO DATABASE CACHE" >> .env
RUN echo "CACHE_DRIVER=array" >> .env  # ← ARRAY au lieu de file/database
RUN echo "SESSION_DRIVER=file" >> .env
RUN echo "QUEUE_CONNECTION=sync" >> .env

# Créer SQLite PROPREMENT
RUN rm -f database/database.sqlite 2>/dev/null || true
RUN sqlite3 database/database.sqlite ".databases" 2>/dev/null || touch database/database.sqlite

# Permissions
RUN chmod -R 777 storage bootstrap/cache database/database.sqlite

EXPOSE 8000

# Commande qui initialise proprement
CMD sh -c "php artisan migrate --force 2>/dev/null || true && php artisan serve --host=0.0.0.0 --port=8000"