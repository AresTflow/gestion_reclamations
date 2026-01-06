# Version MySQL seulement
FROM php:8.2

# Installation minimale
RUN apt-get update && \
    apt-get install -y curl && \
    rm -rf /var/lib/apt/lists/*

# Installer Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

COPY . .

# Installer dépendances (ignore les warnings extensions)
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs

# .env pour MySQL
RUN echo "APP_ENV=production" > .env
RUN echo "APP_DEBUG=false" >> .env
RUN echo "APP_KEY=base64:izFMkW9mZV8lNZWgsyqDgVgS2b9nZLaaCNzxCZ8yL5I=" >> .env
RUN echo "DB_CONNECTION=mysql" >> .env
RUN echo "DB_HOST=127.0.0.1" >> .env
RUN echo "DB_PORT=3306" >> .env
RUN echo "DB_DATABASE=laravel" >> .env
RUN echo "DB_USERNAME=root" >> .env
RUN echo "DB_PASSWORD=" >> .env

EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]