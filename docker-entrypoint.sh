#!/bin/sh
php artisan config:clear || true
php artisan migrate --force || true
php artisan db:seed --force || true
exec php -S 0.0.0.0:${PORT:-8080} -t public
