FROM php:8.0-fpm

RUN apt-get update
RUN apt-get -y --no-install-recommends install git \
    && php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer

RUN apt-get install zip unzip

RUN composer require firebase/php-jwt

COPY . /app/
VOLUME [ "/app" ]



