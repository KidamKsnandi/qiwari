# Use an official PHP image with Apache
FROM php:8.1-apache

# Enable Apache modules
RUN a2enmod rewrite

# Set the working directory in the container
WORKDIR /var/www/balanja

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libwebp-dev \
    libxml2-dev \
    libicu-dev \
    libyaml-dev \
    libmagickwand-dev \
    libzip-dev \
    libonig-dev \
    libpq-dev \
    unzip \
    git \
    libssl-dev \
    bash \
    curl \
    nano \
    cron \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) gd intl mbstring pdo pdo_pgsql pgsql xml zip \
    && rm -rf /var/lib/apt/lists/*

# Copy project files into the container
COPY . .

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Change DocumentRoot to point to Lumen public directory
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/balanja/public|' /etc/apache2/sites-available/000-default.conf

# Set permissions
RUN chown -R www-data:www-data /var/www/balanja \
    && chmod -R 755 /var/www/balanja

# PHP memory limit
RUN echo "memory_limit = 512M" > /usr/local/etc/php/conf.d/memory-limit.ini

# Expose Apache port
EXPOSE 80

# Start Apache in the foreground
CMD ["apache2-foreground"]