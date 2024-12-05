FROM php:8.2-fpm

# Устанавливаем необходимые зависимости и расширения
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Устанавливаем Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Копируем конфигурацию и код приложения
WORKDIR /var/www/html
COPY . .

# Устанавливаем зависимости Laravel
RUN composer install --no-dev --optimize-autoloader

# Устанавливаем разрешения для storage и bootstrap/cache
#RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Открываем порт 9000 для php-fpm
EXPOSE 9000

CMD ["php-fpm"]
