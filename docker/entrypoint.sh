#!/bin/sh
set -e

mkdir -p /data
chown -R www-data:www-data /data
if [ ! -f .env ]; then
	cp .env.example .env
fi
if [ -z "${APP_KEY:-}" ] && ! grep -q '^APP_KEY=base64:' .env; then
	php artisan key:generate --force
fi
php artisan migrate --force
	if ! php artisan tinker --execute="exit(\\App\\Models\\Product::query()->exists() ? 0 : 1);"; then
		php artisan db:seed --force
	fi
php artisan config:cache
php artisan view:cache

exec "$@"