FROM php:8.3.0-apache

RUN apt-get update && apt-get install -y \
    libzip-dev \
    libssl-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    curl \
    zip \
    unzip \
    git \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip mbstring exif pcntl bcmath gd xml

    # Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev  --optimize-autoloader

# RUN chown -R www-data:www-data /var/www/html /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80

COPY default.conf /etc/apache2/sites-available/000-default.conf

RUN a2enmod rewrite