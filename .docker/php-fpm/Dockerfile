FROM php:8.4-fpm

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libicu-dev \
    libzip-dev \
    zlib1g-dev \
    pkg-config \
    libcurl4-openssl-dev \
    mariadb-client \
    libonig-dev && \
    docker-php-ext-configure zip && \
    docker-php-ext-install \
        intl \
        pdo_mysql \
        zip \
        bcmath \
        opcache \
        mbstring && \
    rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www
RUN chown -R www:www /var/www/html
USER www

WORKDIR /var/www/html

EXPOSE 80
EXPOSE 9000

CMD ["php-fpm"]
