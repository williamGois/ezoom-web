FROM php:7.3.8-fpm-alpine
# Copy composer.lock and composer.json

# Set working directory
WORKDIR /var/www

FROM php:7.3.8-fpm-alpine

RUN docker-php-ext-install pdo pdo_mysql sockets
RUN apk add --no-cache zip libzip-dev
RUN apk add zlib-dev gd php7-gd
RUN docker-php-ext-install zip
RUN apk add --no-cache libpng libpng-dev && docker-php-ext-install gd


RUN curl -sS https://getcomposer.org/installer | php -- \
     --install-dir=/usr/local/bin --filename=composer


# Expose port 9000 and start php-fpm server
EXPOSE 9000


CMD ["php-fpm"]