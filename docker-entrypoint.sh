#!/bin/sh

# Run migrations and seeding asynchronously in background so web server boots instantly
(
  sleep 2
  php artisan config:clear || true
  php artisan migrate --force || true
  php artisan db:seed --force || true
) &

# Immediately execute web server as PID 1 to pass Railway health check instantly
exec php -S 0.0.0.0:${PORT:-8080} -t public
