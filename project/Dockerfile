FROM php:8.1

RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

WORKDIR /var/www/html

COPY . .

RUN chown -R www-data:www-data /var/www/html

CMD php -S 0.0.0.0:8000 -t public

