FROM php:7.4.3-apache
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN apt-get update && apt-get install vim -y
COPY php.ini /usr/local/etc/php/php.ini
RUN mkdir /var/www/logs && touch /var/www/logs/errors.log && chmod 777 /var/www/logs/errors.log
