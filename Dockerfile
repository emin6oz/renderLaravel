FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git unzip curl zip sqlite3 libsqlite3-dev libzip-dev \
    && docker-php-ext-install pdo pdo_sqlite zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /app

# Copy project files
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Copy your committed SQLite file into the writable /tmp directory
RUN mkdir -p /tmp && cp database/db.sqlite /tmp/database.sqlite

# Fix permissions for Laravel storage
RUN chmod -R 775 storage bootstrap/cache

# Cache config (optional – enable if env is stable)
# RUN php artisan config:cache

# Expose the port Laravel will use
EXPOSE 8000

# Start Laravel development server
CMD php artisan serve --host=0.0.0.0 --port=8000
