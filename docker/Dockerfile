FROM php:5.4-apache 
RUN a2enmod rewrite
COPY V1/ /var/www/html/
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
RUN docker-php-ext-install mysql
