FROM php:8.3-cli-bookworm

WORKDIR /var/www/html

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        git unzip ca-certificates curl \
        libsqlite3-dev sqlite3 \
        libpng-dev libjpeg62-turbo-dev libwebp-dev libfreetype6-dev libzip-dev \
        libonig-dev libxml2-dev libicu-dev \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-configure gd \
        --with-jpeg \
        --with-webp \
        --with-freetype \
    && docker-php-ext-install -j$(nproc) \
        pdo_sqlite \
        bcmath \
        intl \
        zip \
        gd \
        exif

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY . /var/www/html

RUN mkdir -p bootstrap/cache storage/framework/{cache,sessions,testing,views} database \
    && chown -R www-data:www-data bootstrap/cache storage \
    && chmod -R ug+rwx bootstrap/cache storage

# During Docker build there is typically no `.env`; Laravel console bootstrapping used by Composer
# scripts can fail unless a minimal `.env` exists with an `APP_KEY`.
RUN test -f .env || cp .env.example .env \
    && php -r "file_exists('database/database.sqlite') || touch('database/database.sqlite');" \
    && php -r "\$p='.env'; \$c=file_get_contents(\$p); \$c=preg_replace('/^SESSION_DRIVER=.*/m','SESSION_DRIVER=file',\$c); \$c=preg_replace('/^CACHE_STORE=.*/m','CACHE_STORE=file',\$c); \$c=preg_replace('/^QUEUE_CONNECTION=.*/m','QUEUE_CONNECTION=sync',\$c); file_put_contents(\$p,\$c);" \
    && php artisan key:generate --force \
    && composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist \
    && rm -f .env

RUN chmod +x /var/www/html/docker/entrypoint.sh

EXPOSE 10000

ENTRYPOINT ["/var/www/html/docker/entrypoint.sh"]
