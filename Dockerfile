FROM php:7.4-cli

RUN apt-get update && \
    apt-get upgrade -y && \
    apt-get install -y git && \
    apt-get install -y libzip-dev zlib1g-dev unzip \
    && docker-php-ext-install zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
COPY . /usr/src/myapp
WORKDIR /usr/src/myapp
RUN composer install --ignore-platform-reqs 
CMD [ "php", "./main.php" ]
