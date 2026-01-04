
FROM php:8.2-apache AS build

WORKDIR /var/www/html


COPY src/ .


FROM php:8.2-apache

WORKDIR /var/www/html


COPY --from=build /var/www/html /var/www/html

EXPOSE 80
