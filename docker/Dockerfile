FROM php:apache

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli && a2enmod rewrite
RUN chmod -R 777 /var/www/html
