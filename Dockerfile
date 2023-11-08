FROM php:8.2-fpm


# Setup working directory
WORKDIR /var/www/html

COPY . .

# Install system dependencies
RUN apt-get update && apt-get install -y \
    openssl \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# php extension
RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    # for postgresql
    # pdo_pgsql \
    # pgsql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    xml \
    gd


# installing Composer from the official website
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY .env.example .env
RUN composer install --optimize-autoloader --no-dev; \
    php artisan key:generate; \
    php artisan cache:clear; \
    chown -R www-data:www-data /var/www/html;

EXPOSE 9000
CMD ["php-fpm"]
