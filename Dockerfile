FROM php:8.2-fpm

# Установка зависимостей
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev git libzip-dev unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql zip

# Установка Xdebug
RUN pecl install xdebug && docker-php-ext-enable xdebug

# Установка Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Рабочая директория
WORKDIR /var/www/html

# Копируем проект целиком
COPY . .

# Установка зависимостей
RUN composer install --no-dev --optimize-autoloader || true

RUN sed -i 's|listen = 127.0.0.1:9000|listen = 0.0.0.0:9000|' /usr/local/etc/php-fpm.d/www.conf

# Настройка прав
RUN chown -R www-data:www-data storage bootstrap/cache

EXPOSE 9000 9003

CMD ["php-fpm"]
