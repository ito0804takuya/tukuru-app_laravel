FROM php:7.3-fpm-alpine
COPY ./src /work
COPY ./docker/php/php.ini /usr/local/etc/php/php.ini
LABEL maintainer "your-name"

SHELL ["/bin/ash", "-oeux", "pipefail", "-c"]

ARG PSYSH_DIR=/usr/local/share/psysh
ARG PSYSH_PHP_MANUAL=$PSYSH_DIR/php_manual.sqlite
ARG PHP_MANUAL_URL=http://psysh.org/manual/ja/php_manual.sqlite

ARG TZ=Asia/Tokyo

ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /composer

RUN set -eux && \
  apk add --update-cache --no-cache --virtual=.build-dependencies tzdata && \
  cp /usr/share/zoneinfo/${TZ} /etc/localtime && \
  apk del .build-dependencies && \
  docker-php-ext-install bcmath pdo_mysql && \
  curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer && \
  composer config -g repos.packagist composer https://packagist.jp && \
  composer global require hirak/prestissimo && \
  apk upgrade --update && apk add coreutils freetype-dev libjpeg-turbo-dev libltdl libmcrypt-dev libpng-dev && \
  docker-php-ext-install -j$(nproc) iconv && \
  docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ && \
  docker-php-ext-install -j$(nproc) gd
  
  