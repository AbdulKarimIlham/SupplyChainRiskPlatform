#!/bin/sh

# Ensure APP_KEY exists
if [ -z "$APP_KEY" ]; then
    echo "Generating APP_KEY..."
    php artisan key:generate --force
fi

# Clear stale caches
php artisan config:clear || true
php artisan route:clear || true
php artisan view:clear || true

# Run database migrations and seeders safely
echo "Running database migrations..."
php artisan migrate --force || echo "Migration skipped or failed"

echo "Running database seeders..."
php artisan db:seed --force || echo "Seeding skipped or failed"

# Determine port
PORT=${PORT:-8080}
echo "Starting Laravel server on port $PORT..."

exec php artisan serve --host=0.0.0.0 --port=$PORT
