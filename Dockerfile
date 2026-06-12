# Stage 1: Base PHP environment
FROM php:8.3-fpm as base
RUN apt-get update && apt-get install -y git curl libpng-dev libonig-dev libxml2-dev zip unzip libzip-dev libicu-dev nginx
RUN apt-get clean && rm -rf /var/lib/apt/lists/*
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip intl
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
WORKDIR /var/www

# Stage 2: Development
FROM base as development
EXPOSE 9000
CMD ["php-fpm"]

# Stage 3: Production
FROM base as production
ENV APP_ENV=production
ENV APP_DEBUG=false
COPY . .
RUN composer install --no-dev --optimize-autoloader
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
EXPOSE 80
HEALTHCHECK --interval=30s --timeout=3s CMD curl -f http://localhost/ || exit 1
CMD ["php-fpm"]
