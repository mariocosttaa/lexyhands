FROM php:8.1-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set working directory to /app (Coolify default)
WORKDIR /app

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy composer files first (for better caching)
COPY composer.json composer.lock ./

# Install Composer dependencies
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Copy application files
COPY . .

# Regenerate autoloader after all files are in place
RUN composer dump-autoload --optimize --no-dev --classmap-authoritative

# Verify Router class can be found
RUN php -r "require 'vendor/autoload.php'; if (!class_exists('App\Services\Router')) { echo 'ERROR: Router class not found!\n'; exit(1); } echo 'Router class found successfully\n';"

# Set proper permissions
RUN chown -R www-data:www-data /app && \
    chmod -R 755 /app && \
    chmod -R 775 /app/app/cache && \
    chmod -R 775 /app/app/cache/logs

# Configure Apache to serve from /app/public
RUN echo '<VirtualHost *:80>\n\
    DocumentRoot /app/public\n\
    <Directory /app/public>\n\
        AllowOverride All\n\
        Require all granted\n\
        Options -Indexes +FollowSymLinks\n\
    </Directory>\n\
    Alias /private /app/private\n\
    <Directory /app/private>\n\
        Require all granted\n\
    </Directory>\n\
    ErrorLog ${APACHE_LOG_DIR}/error.log\n\
    CustomLog ${APACHE_LOG_DIR}/access.log combined\n\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

# Expose port 80
EXPOSE 80

# Healthcheck
HEALTHCHECK --interval=30s --timeout=10s --start-period=40s --retries=3 \
  CMD curl -f http://localhost/ || exit 1

# Start Apache
CMD ["apache2-foreground"]
