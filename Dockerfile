FROM composer:1.6 AS composer

FROM node:9-alpine as node
WORKDIR /build
COPY package.json .
COPY yarn.lock .
RUN yarn install --pure-lockfile && yarn cache clean

FROM php:7.2-fpm-alpine

WORKDIR /srv/app

RUN apk add --no-cache --virtual .persistent-deps \
		git \
		icu-libs \
		zlib

ENV APCU_VERSION 5.1.8
RUN set -xe \
	&& apk add --no-cache --virtual .build-deps \
		$PHPIZE_DEPS \
		icu-dev \
		zlib-dev \
		openssl \
		openssl-dev \
	&& docker-php-ext-install \
		intl \
		zip \
		pdo_mysql \
	&& pecl install \
		apcu-${APCU_VERSION} \
		openssl \
	&& docker-php-ext-enable --ini-name 20-apcu.ini apcu \
	&& docker-php-ext-enable --ini-name 05-opcache.ini opcache \
	&& apk del .build-deps

###> recipes ###
###< recipes ###

COPY docker/app/php.ini /usr/local/etc/php/php.ini

COPY --from=composer /usr/bin/composer /usr/bin/composer

# https://getcomposer.org/doc/03-cli.md#composer-allow-superuser
ENV COMPOSER_ALLOW_SUPERUSER 1

# Use prestissimo to speed up builds
RUN composer global require "hirak/prestissimo:^0.3" --prefer-dist --no-progress --no-suggest --optimize-autoloader --classmap-authoritative  --no-interaction

COPY docker/app/docker-entrypoint.sh /usr/local/bin/docker-app-entrypoint
RUN chmod +x /usr/local/bin/docker-app-entrypoint

# Allow to use development versions of Symfony
ARG STABILITY=stable
ENV STABILITY ${STABILITY}

# RUN composer create-project "symfony/skeleton" . --stability=$STABILITY --prefer-dist --no-dev --no-progress --no-scripts --no-plugins --no-interaction

COPY --from=node /build/node_modules/ ./node_modules/

COPY . /srv/app
RUN ls -la
RUN composer install --prefer-dist --no-dev --no-progress --no-suggest --classmap-authoritative --no-interaction \
	&& composer clear-cache \
	&& chown -R www-data var # Permissions hack because setfacl does not work on Mac and Windows

ENTRYPOINT ["docker-app-entrypoint"]
CMD ["php-fpm"]