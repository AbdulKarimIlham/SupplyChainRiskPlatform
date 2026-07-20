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

# Install Node.js for asset bundling
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Set working directory
WORKDIR /app

# Copy application files
COPY . /app

# Ensure .env file and sqlite database exist
RUN cp -n .env.example .env
RUN touch /app/database/database.sqlite && chmod 777 /app/database/database.sqlite

# Install Composer dependencies
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer install --optimize-autoloader --no-dev

# Generate key & set permissions for storage and bootstrap cache
RUN php artisan key:generate
RUN chmod -R 777 storage bootstrap/cache

# Build frontend assets
RUN npm install && npm run build

# Expose default port
EXPOSE 8080

# Clean direct shell CMD web server for Railway
CMD php -S 0.0.0.0:${PORT:-8080} -t public
