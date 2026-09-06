#!/bin/sh
set -e

mkdir -p /data
chown -R www-data:www-data /data
php artisan migrate --force
php artisan config:cache
php artisan view:cache

exec "$@"