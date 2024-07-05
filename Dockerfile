# # Gunakan image PHP sebagai basis
# FROM php:8.2-fpm

# # Instal dependensi sistem
# RUN apt-get update && apt-get install -y \
#     libpng-dev \
#     libjpeg-dev \
#     libfreetype6-dev \
#     libzip-dev \
#     zip \
#     unzip \
#     git \
#     curl \
#     nano \
#     libonig-dev \
#     libxml2-dev \
#     && docker-php-ext-configure gd --with-freetype --with-jpeg \
#     && docker-php-ext-install -j$(nproc) gd mbstring pdo pdo_mysql zip bcmath opcache

# # Instal Composer
# COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# # Setel direktori kerja
# WORKDIR /var/www/html

# # Salin file aplikasi ke dalam kontainer
# COPY . /var/www/html

# # Jalankan perintah Composer
# RUN composer install --no-scripts --no-autoloader

# # Setel izin untuk direktori penyimpanan dan cache
# RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# # Jalankan perintah Composer autoload
# RUN composer dump-autoload

# # Salin file konfigurasi PHP ke dalam kontainer
# COPY ./docker/php/php.ini /usr/local/etc/php/php.ini

# # Ekspose port 9000 dan konfigurasikan entrypoint
# EXPOSE 9000
# CMD ["php-fpm"]


# Use PHP with Apache as the base image
FROM php:8.2-apache as web

# Install Additional System Dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Enable Apache mod_rewrite for URL rewriting
RUN a2enmod rewrite

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql zip

# Configure Apache DocumentRoot to point to Laravel's public directory
# and update Apache configuration files
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Copy the application code
COPY . /var/www/html

# Set the working directory
WORKDIR /var/www/html

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install project dependencies
RUN composer install

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache