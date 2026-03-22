FROM php:8.2-apache

RUN docker-php-ext-install mysqli

COPY index.php /var/www/html/index.php
COPY conn.php /var/www/html/conn.php

EXPOSE 80
