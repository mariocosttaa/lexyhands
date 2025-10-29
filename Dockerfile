FROM php:8.1-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy composer files first
COPY composer.json composer.lock ./

# Install Composer dependencies (generates initial autoloader)
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Copy application files
COPY . .

# Regenerate autoloader after copying all files to ensure PSR-4 mappings are correct
# This ensures Router and all App\ classes are properly mapped
RUN composer dump-autoload --optimize --no-dev --classmap-authoritative || composer dump-autoload --optimize --no-dev

# Verify Router class can be found (helps debug autoloader issues)
RUN php -r "require 'vendor/autoload.php'; if (!class_exists('App\Services\Router')) { echo 'ERROR: Router class not found!\n'; exit(1); } echo 'Router class found successfully\n';"

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html
RUN chmod -R 775 /var/www/html/app/cache
RUN chmod -R 775 /var/www/html/app/cache/logs

# Configure Apache
RUN echo '<VirtualHost *:80>\n\
    DocumentRoot /var/www/html/public\n\
    <Directory /var/www/html/public>\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
    Alias /private /var/www/html/private\n\
    <Directory /var/www/html/private>\n\
        Require all granted\n\
    </Directory>\n\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

# Expose port 80
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
