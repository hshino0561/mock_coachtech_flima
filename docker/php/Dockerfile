FROM php:8.1.1-fpm

# 一般ユーザの作成
RUN useradd -m -u 1000 -s /bin/bash shino

COPY php.ini /usr/local/etc/php/

RUN apt update \
  && apt install -y default-mysql-client zlib1g-dev libzip-dev unzip \
  && docker-php-ext-install pdo_mysql zip

RUN curl -sS https://getcomposer.org/installer | php \
  && mv composer.phar /usr/local/bin/composer \
  && composer self-update

WORKDIR /var/www

# 権限の設定
RUN chown -R shino:shino /var/www

# ユーザを切り替える
USER shino
