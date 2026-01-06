FROM php:8.2-alpine

RUN apk add --no-cache curl

RUN curl -sS https://getcomposer.org/composer.phar -o /usr/local/bin/composer && \
    chmod +x /usr/local/bin/composer

WORKDIR /var/www/html

COPY . .

# FORCE array cache dans les configs
RUN sed -i "s/'default' => env('CACHE_DRIVER', 'file'),/'default' => env('CACHE_DRIVER', 'array'),/g" config/cache.php
RUN sed -i "s/'driver' => env('SESSION_DRIVER', 'file'),/'driver' => env('SESSION_DRIVER', 'array'),/g" config/session.php

RUN composer install --no-dev --ignore-platform-reqs

# .env
RUN echo "APP_ENV=local" > .env
RUN echo "APP_DEBUG=true" >> .env
RUN echo "APP_KEY=base64:izFMkW9mZV8lNZWgsyqDgVgS2b9nZLaaCNzxCZ8yL5I=" >> .env
RUN echo "DB_CONNECTION=sqlite" >> .env
RUN echo "CACHE_DRIVER=array" >> .env
RUN echo "SESSION_DRIVER=array" >> .env

RUN chmod -R 777 storage bootstrap/cache

EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]