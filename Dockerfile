FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    git \
    libzip-dev \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql zip

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY ./xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

WORKDIR /var/www/html

# Безопасная установка composer-зависимостей
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader

COPY . .

# Права доступа
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 9000 9003

CMD ["php-fpm"]
