FROM php:7.4-apache

# Set working directory
WORKDIR /var/www/html

# Install dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    nodejs \
    npm

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install \
    pdo_mysql \
    mysqli \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    zip

# Set timezone
RUN ln -sf /usr/share/zoneinfo/Australia/Victoria /etc/localtime

# Configure Apache
RUN a2enmod rewrite headers
RUN sed -i 's/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# Set session directory permissions
RUN mkdir -p /var/www/html/application/cache/
RUN chmod -R 755 /var/www/html/application/cache/

# Set permissions for the root directory
RUN chown -R www-data:www-data /var/www/html