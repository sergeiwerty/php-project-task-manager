FROM php:8.2-fpm-alpine

WORKDIR /var/www/html

COPY . .

RUN set -ex \
  && apk --no-cache add \
    postgresql-dev

RUN docker-php-ext-install pdo pdo_pgsql

ENV PHPIZE_DEPS \
  autoconf \
  file \
  g++ \
  gcc \
  libc-dev \
  make \
  pkgconf \
  re2c \
  pcre-dev

# Install dependencies and PHP extensions
RUN apk add --no-cache --virtual .phpize-deps $PHPIZE_DEPS \
  && apk add --no-cache linux-headers \
  && pecl install xdebug \
  && docker-php-ext-enable xdebug \
  && apk del .phpize-deps

RUN addgroup -g 1000 laravel && adduser -G laravel -g laravel -s /bin/sh -D laravel

USER laravel