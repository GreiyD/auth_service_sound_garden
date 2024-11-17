FROM php:8.3-fpm

ARG WORKDIR
WORKDIR ${WORKDIR}

RUN apt-get -y update && apt-get -y install git unzip vim rsync

RUN docker-php-ext-install pdo pdo_mysql sockets

#RUN pecl install xdebug && docker-php-ext-enable xdebug;
#COPY ./docker/configs/php/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer

COPY . .

RUN composer install --no-interaction

RUN vendor/bin/rr get --location=bin/ && chmod +x bin/rr

EXPOSE 9000

CMD ["/srv/src/app/bin/rr", "serve", "-c", ".rr.dev.yaml"]