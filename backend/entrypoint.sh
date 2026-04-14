#!/bin/bash
if [ ! -f "db-init/perpustakaan.db3" ]; then
    mkdir db-init
    touch db-init/perpustakaan.db3
    chmod 666 perpustakaan.db3
    php database/migration.php
    php database/seeder.php    
fi
php-fpm -D && nginx -g "daemon off;"