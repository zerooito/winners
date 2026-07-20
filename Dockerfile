FROM php:7.4-apache

WORKDIR /var/www/html

COPY ./default.conf /etc/apache2/sites-available/000-default.conf

RUN docker-php-ext-install pdo pdo_mysql

RUN apt-get update && apt-get install -y libpng-dev libzip-dev zip unzip \
    default-mysql-client libmagickwand-dev libmcrypt-dev --no-install-recommends \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip \
    && pecl install imagick mcrypt-1.0.9 \
    && docker-php-ext-enable imagick mcrypt \
    && docker-php-ext-install gd

RUN apt-get update && \
  apt-get -y install curl git libicu-dev libpq-dev zlib1g-dev libonig-dev && \
  docker-php-ext-install intl mbstring pcntl pdo_mysql pdo_pgsql && \
  usermod -u 1000 www-data && \
  usermod -a -G users www-data && \
  chown -R www-data:www-data /var/www && \
  curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
  a2enmod rewrite

RUN apt-get update && apt-get install -y \
    libfreetype6-dev libjpeg62-turbo-dev \
    libgd-dev libpng-dev \
    && docker-php-ext-configure gd \
    --with-freetype=/usr/include/ \
    --with-jpeg=/usr/include/ \
    && docker-php-ext-install gd

COPY . /var/www/html

RUN git config --global --add safe.directory /var/www/html && composer install