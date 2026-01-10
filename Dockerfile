FROM php:8.2-apache AS build

WORKDIR /var/www/html
RUN docker-php-ext-install mysqli pdo pdo_mysql

COPY src/ /var/www/html/


FROM php:8.2-apache

WORKDIR /var/www/html
RUN docker-php-ext-install mysqli pdo pdo_mysql \
    && a2enmod rewrite

COPY --from=build /var/www/html /var/www/html

EXPOSE 80
