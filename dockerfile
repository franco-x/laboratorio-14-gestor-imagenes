FROM node:22 AS assets

WORKDIR /app

COPY package*.json ./
RUN npm install

COPY . .
RUN npm run build


FROM php:8.4-cli

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libzip-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    libsqlite3-dev \
    libxml2-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
        pdo \
        pdo_sqlite \
        mbstring \
        zip \
        gd \
        exif \
        pcntl \
        dom \
        xml \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

COPY --from=assets /app/public/build /var/www/public/build

RUN composer install --no-dev --optimize-autoloader --no-interaction --no-progress

RUN mkdir -p database public/imagenes storage bootstrap/cache \
    && touch database/database.sqlite \
    && chmod -R 777 database public/imagenes storage bootstrap/cache \
    && chmod -R 777 public/build

RUN php artisan config:clear && php artisan view:clear && php artisan route:clear

CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=${PORT:-10000}