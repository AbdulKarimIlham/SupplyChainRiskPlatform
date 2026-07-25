FROM php:8.2-cli

# Install system dependencies and Node.js
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    && curl -sL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy application source code
COPY . .

# Install PHP dependencies without running artisan scripts during build
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Install Node dependencies and compile assets
RUN npm install
RUN npm run build

# Ensure storage permissions
RUN chmod -R 777 storage bootstrap/cache

# Setup entrypoint script
RUN chmod +x /app/docker-entrypoint.sh

ENTRYPOINT ["/app/docker-entrypoint.sh"]
