#!/bin/sh

# Remove cached bootstrap files
rm -f bootstrap/cache/*.php

# Ensure APP_KEY exists
if [ -z "$APP_KEY" ]; then
    echo "Generating APP_KEY..."
    php artisan key:generate --force
fi

# Clear stale caches
php artisan config:clear || true
php artisan route:clear || true
php artisan view:clear || true

# Wait for database connection if configured
echo "Checking MySQL connection..."

for i in $(seq 1 10); do
    php -r "
    try {
        \$url = getenv('DB_URL') ?: (getenv('MYSQL_URL') ?: (getenv('MYSQL_PRIVATE_URL') ?: getenv('DATABASE_URL')));
        if (\$url) {
            \$p = parse_url(\$url);
            \$host = \$p['host'] ?? '127.0.0.1';
            \$port = \$p['port'] ?? '3306';
            \$user = \$p['user'] ?? 'root';
            \$pass = \$p['pass'] ?? '';
        } else {
            \$host = getenv('DB_HOST') ?: (getenv('MYSQLHOST') ?: (getenv('MYSQL_HOST') ?: (getenv('RAILWAY_PUBLIC_DOMAIN') || getenv('RAILWAY_STATIC_URL') || getenv('RAILWAY_ENVIRONMENT') || isset(\$_SERVER['HTTP_X_RAILWAY_EDGE']) ? 'mysql.railway.internal' : '127.0.0.1')));
            \$port = getenv('DB_PORT') ?: (getenv('MYSQLPORT') ?: (getenv('MYSQL_PORT') ?: '3306'));
            \$user = getenv('DB_USERNAME') ?: (getenv('MYSQLUSER') ?: (getenv('MYSQL_USER') ?: 'root'));
            \$pass = (getenv('DB_PASSWORD') !== false && getenv('DB_PASSWORD') !== '') ? getenv('DB_PASSWORD') : (getenv('MYSQLPASSWORD') ?: (getenv('MYSQL_PASSWORD') ?: ''));
        }
        \$pdo = new PDO('mysql:host=' . \$host . ';port=' . \$port, \$user, \$pass);
        echo 'MySQL Connected successfully!';
        exit(0);
    } catch (\Throwable \$e) {
        echo 'MySQL Check error: ' . \$e->getMessage() . PHP_EOL;
        exit(1);
    }
    " && break

    echo "MySQL connection pending ($i/10), waiting 2 seconds..."
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
