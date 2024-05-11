# Use the official PHP image from Docker Hub
FROM php:7.4-apache

# Install mysqli extension for database connectivity
RUN docker-php-ext-install mysqli

# Enable Apache rewrite module
RUN a2enmod rewrite

# Copy your PHP files into the container
COPY . /var/www/html/

# Set permissions for Apache
RUN chown -R www-data:www-data /var/www/html/

# Expose port 80
EXPOSE 80
