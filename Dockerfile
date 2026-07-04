# downloads an image that already has: PHP 8.2, Apache Web Server
FROM php:8.2-apache

# installs: PDO, MySQL driver
RUN docker-php-ext-install pdo pdo_mysql

# Copies your entire project NoteAppDocker/ into Apache's website folder /var/www/html
COPY . /var/www/html/

# Apache runs as the user www-data, this command gives Apache permission to access your project files
RUN chown -R www-data:www-data /var/www/html

# tells Docker that this container uses port 80
EXPOSE 80