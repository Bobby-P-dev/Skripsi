# Gunakan base image PHP 8.2 FPM yang ringan
FROM php:8.2-fpm-alpine

# Set direktori kerja
WORKDIR /var/www/html

# Install dependensi sistem yang dibutuhkan
RUN apk add --no-cache shadow nginx supervisor libzip-dev zip unzip postgresql-dev gd-dev \
    && docker-php-ext-install pdo pdo_pgsql zip gd

# Copy composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Salin HANYA file composer
COPY composer.json composer.lock ./

# Install dependensi saja, tanpa skrip, tanpa autoloader.
# Ini adalah langkah build yang paling "aman".
RUN composer install --no-dev --no-interaction --no-scripts --no-autoloader

# Sekarang salin SEMUA sisa file aplikasi Anda
COPY . .

# Atur kepemilikan file agar bisa ditulis oleh web server
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Ekspos port untuk PHP-FPM
EXPOSE 9000

# Perintah default untuk menjalankan container
CMD ["php-fpm"]
