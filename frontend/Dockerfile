
FROM php:8.5-fpm

RUN apt update -y && apt install -y nginx zip libicu-dev && docker-php-ext-install pdo pdo_mysql intl pcntl


COPY ./nginx.conf /etc/nginx/sites-available/default

WORKDIR /var/www/frontend

COPY . .

EXPOSE 8081
CMD php-fpm -D && nginx -g "daemon off;" 