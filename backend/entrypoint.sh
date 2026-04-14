#!/bin/bash
set -e

DB_DIR="database/data"
DB_FILE="$DB_DIR/<your-name-database>.db3"

mkdir -p "$DB_DIR"

if [ ! -f "$DB_FILE" ]; then
    touch "$DB_FILE"
    
    chown -R www-data:www-data "$DB_DIR"
    chmod -R 775 "$DB_DIR"
    
    su -s /bin/bash -c "php database/migration.php" www-data
    su -s /bin/bash -c "php database/seeder.php" www-data
else
    chown -R www-data:www-data "$DB_DIR"
    chmod -R 775 "$DB_DIR"
fi

php-fpm -D
exec nginx -g "daemon off;"