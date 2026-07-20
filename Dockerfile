FROM richarvey/nginx-php-fpm:latest

# Configure Nginx web root for Laravel public directory
ENV WEBROOT="/var/www/html/public"
ENV PHP_ERRORS_STDERR="1"
ENV ERRORS="1"

# Copy application code into container webroot
COPY . /var/www/html

# Set full read/write permissions for Laravel storage & bootstrap cache
RUN chmod -R 777 /var/www/html/storage /var/www/html/bootstrap/cache

# Ensure .env file exists
RUN cp -n /var/www/html/.env.example /var/www/html/.env

# Install Composer dependencies
RUN composer install --optimize-autoloader --no-dev

# Generate Laravel APP_KEY
RUN php artisan key:generate

# Install Node & Build assets
RUN npm install && npm run build
