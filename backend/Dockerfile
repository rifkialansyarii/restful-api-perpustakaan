
FROM php:8.5-fpm

RUN apt update -y && apt install -y nginx zip libicu-dev libpng-dev libonig-dev libxml2-dev unzip sqlite3 libsqlite3-dev && docker-php-ext-install pdo pdo_sqlite intl pcntl mbstring

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY ./nginx.conf /etc/nginx/sites-available/default


WORKDIR /var/www/backend

COPY entrypoint.sh /usr/local/bin/

COPY . .

RUN composer install

RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 8080


ENTRYPOINT ["entrypoint.sh"]