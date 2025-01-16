# Use the official PHP image with the necessary extensions
FROM php:8.1-fpm

# Install dependencies including PHP extensions like zip
RUN apt-get update && apt-get install -y \
    libzip-dev \
    && docker-php-ext-install zip pdo pdo_mysql bcmath

# Set working directory (adjust this path based on your project structure)
WORKDIR /var/www/html

# Copy the current directory contents into the container at /var/www/html
COPY . /var/www/html

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Run Composer install to install the PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Expose port 80
EXPOSE 80

# Start PHP-FPM
CMD ["php-fpm"]
