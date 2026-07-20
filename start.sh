#!/bin/sh
php artisan config:clear
php artisan migrate --force || true
php artisan db:seed --force || true
exec php -S 0.0.0.0:$PORT -t public
