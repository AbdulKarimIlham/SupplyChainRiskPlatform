FROM php:8.2-cli

# Install system dependencies and PHP extensions required by Laravel & MySQL
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Node.js for asset bundling if needed
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Set working directory
WORKDIR /app

# Copy application files
COPY . /app

# Install Composer dependencies
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer install --optimize-autoloader --no-dev

# Set permissions for storage and bootstrap cache
RUN chmod -R 777 storage bootstrap/cache

# Build frontend assets
RUN npm install && npm run build

# Expose port
EXPOSE 8080

# Start command: run migrations/seeding gracefully and serve Laravel on $PORT
CMD ["sh", "-c", "php artisan config:clear && php artisan migrate --force || true && php artisan db:seed --force || true && php artisan serve --host=0.0.0.0 --port=${PORT:-8080}"]
