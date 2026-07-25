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

# Wait for database connection if DB_HOST is configured
TARGET_HOST=${DB_HOST:-${MYSQLHOST:-127.0.0.1}}
TARGET_PORT=${DB_PORT:-${MYSQLPORT:-3306}}

echo "Checking MySQL connection at $TARGET_HOST:$TARGET_PORT..."

for i in $(seq 1 15); do
    php -r "
    try {
        \$host = getenv('DB_HOST') ?: (getenv('MYSQLHOST') ?: '127.0.0.1');
        \$port = getenv('DB_PORT') ?: (getenv('MYSQLPORT') ?: '3306');
        \$user = getenv('DB_USERNAME') ?: (getenv('MYSQLUSER') ?: 'root');
        \$pass = getenv('DB_PASSWORD') !== false && getenv('DB_PASSWORD') !== '' ? getenv('DB_PASSWORD') : getenv('MYSQLPASSWORD');
        \$pdo = new PDO('mysql:host=' . \$host . ';port=' . \$port, \$user, \$pass);
        echo 'MySQL Connected successfully!';
        exit(0);
    } catch (\Throwable \$e) {
        exit(1);
    }
    " && break

    echo "MySQL connection pending ($i/15), waiting 2 seconds..."
    sleep 2
done

# Run database migrations and seeders safely
echo "Running database migrations..."
php artisan migrate --force || echo "Migration skipped or failed"

echo "Running database seeders..."
php artisan db:seed --force || echo "Seeding skipped or failed"

# Determine port
PORT=${PORT:-8080}
echo "Starting Laravel server on port $PORT..."

exec php artisan serve --host=0.0.0.0 --port=$PORT
