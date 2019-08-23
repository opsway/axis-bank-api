FROM php:7.3.8-cli-alpine

WORKDIR /app
ADD . .

RUN apk upgrade --update && apk --no-cache add \
    coreutils \
    libltdl \
    bash \
    binutils \
    patch

RUN set -e -u -x \
    && apk add --no-cache --no-progress --virtual BUILD_DEPS ${PHPIZE_DEPS} \
    && apk add --no-cache --no-progress --virtual BUILD_DEPS_PHP_GNUPG gpgme-dev \
    && apk add --no-cache --no-progress gpgme \
    && pecl install gnupg \
    && docker-php-ext-enable gnupg \
    && apk del --no-progress BUILD_DEPS BUILD_DEPS_PHP_GNUPG

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer