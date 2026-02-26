FROM php:8.4-fpm-alpine

# System deps
RUN apk add --no-cache \
    bash \
    git \
    curl \
    zip \
    unzip \
    libpq-dev \
    oniguruma-dev \
    icu-dev \
    libzip-dev

# PHP extensions
RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    intl \
    mbstring \
    bcmath \
    zip

# Install Node.js (LTS) and Yarn
RUN apk add --no-cache nodejs npm \
    && npm install -g yarn

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

