FROM php:8.2-alpine

RUN apk add --no-cache curl

RUN curl -sS https://getcomposer.org/composer.phar -o /usr/local/bin/composer && \
    chmod +x /usr/local/bin/composer

WORKDIR /var/www/html

COPY . .

# Cache array pour éviter SQLite
RUN sed -i "s/'default' => env('CACHE_DRIVER', 'file'),/'default' => env('CACHE_DRIVER', 'array'),/g" config/cache.php

RUN composer install --no-dev --ignore-platform-reqs

# .env avec NOUVELLE APP_KEY
RUN echo "APP_ENV=local" > .env
RUN echo "APP_DEBUG=true" >> .env
RUN echo "APP_KEY=base64:BZuJRD5qvTL4ziTBGGiSfuLau3ITSoWqQJ5JKeIiSjo=" >> .env  # ← NOUVELLE CLÉ
RUN echo "DB_CONNECTION=sqlite" >> .env
RUN echo "CACHE_DRIVER=array" >> .env
RUN echo "SESSION_DRIVER=file" >> .env

# Permissions pour sessions
RUN mkdir -p storage/framework/sessions
RUN chmod -R 777 storage/framework/sessions storage bootstrap/cache

EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]