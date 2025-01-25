FROM php:8.2-fpm

# Устанавливаем необходимые зависимости и расширения для работы с изображениями, базами данных и cron
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    cron \
    git \
    libzip-dev \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql zip

# Устанавливаем Xdebug
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

# Устанавливаем Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Копируем конфигурацию Xdebug
COPY ./xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

# Копируем конфигурацию и код приложения
WORKDIR /var/www/html
COPY . .

# Устанавливаем зависимости Laravel
RUN composer install --no-dev --optimize-autoloader

# Устанавливаем разрешения для storage и bootstrap/cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Открываем порты 9000 (php-fpm) и 9003 (Xdebug)
EXPOSE 9000 9003

# Запускаем cron и php-fpm
CMD cron && php-fpm
