FROM php:7.3.8-cli-alpine

ARG TIMEZONE=${TIMEZONE:-America/Chicago}
ARG DEV_ENV=${DEV_ENV:-dev}

RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
RUN docker-php-ext-install iconv
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-enable iconv
RUN docker-php-ext-enable pdo_mysql

# Install Composer
ENV COMPOSER_ALLOW_SUPERUSER 1
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
&& composer --version

# Set timezone
RUN ln -snf /usr/share/zoneinfo/${TIMEZONE} /etc/localtime && echo ${TIMEZONE} > /etc/timezone \
&& printf '[PHP]\ndate.timezone = "%s"\n', ${TIMEZONE} > /usr/local/etc/php/conf.d/tzone.ini \
&& "date"

COPY entrypoint.sh /entrypoint.sh
ENTRYPOINT /entrypoint.sh
RUN ["chmod", "+x", "/entrypoint.sh"]