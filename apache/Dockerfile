FROM php:7.4.26-apache

WORKDIR /var/www/html

RUN apt-get update -y && apt-get install -y \
    git \
    gcc \
    && apt-get clean \
    && rm -rf /tmp/* /var/lib/apt/lists/* /var/tmp/* 

COPY php.ini /usr/local/etc/php/php.ini

#composer
COPY composer.json /var/www/html/composer.json
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN ls

RUN chmod 777 -R /var/www/
RUN useradd -p $(openssl passwd -1 thepassword) phpcomposer
RUN su - phpcomposer -c "cd /var/www/html && php composer.phar install"
