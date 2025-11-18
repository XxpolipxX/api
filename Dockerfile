FROM php:8.2-apache

# Instalacja zależności systemowych
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libzip-dev \
    && docker-php-ext-install zip pdo pdo_mysql \
    && apt-get clean

# Włączenie mod_rewrite
RUN a2enmod rewrite

# Ustawienie DocumentRoot na /public
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf

# Skopiowanie plików projektu
COPY . /var/www/html/

# Instalacja Composera
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Instalacja zależności
RUN composer install

# Uprawnienia
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80