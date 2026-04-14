#!/bin/bash
if [ ! -f "perpustakaan.db3" ]; then
    touch perpustakaan.db3
    chmod 666 perpustakaan.db3
    php database/migration.php
    php database/seeder.php

    chown -R www-data:www-data .
    
fi
php-fpm -D && nginx -g "daemon off;"