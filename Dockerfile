FROM php:8.3-fpm-alpine AS base

# Dependencias del sistema y extensiones de PHP que Laravel necesita
RUN apk add --no-cache \
    nginx \
    supervisor \
    git \
    curl \
    libzip-dev \
    zip \
    unzip \
    oniguruma-dev \
    libpng-dev \
    freetype-dev \
    libjpeg-turbo-dev \
    nodejs \
    npm \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl gd

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copiamos el proyecto
COPY . .

# Instalamos dependencias de PHP
RUN composer install --optimize-autoloader --no-dev --no-interaction

# Front: el repo usa pnpm (pnpm-lock.yaml)
RUN if [ -f package.json ]; then \
        corepack enable && pnpm install --frozen-lockfile && pnpm run build; \
    fi

# Permisos que Laravel necesita
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Configuración de Nginx, PHP-FPM y Supervisor
COPY docker/nginx.conf /etc/nginx/http.d/default.conf
COPY docker/www.conf /usr/local/etc/php-fpm.d/zz-clear-env.conf
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY docker/start.sh /start.sh
RUN chmod +x /start.sh

EXPOSE 10000

CMD ["/start.sh"]
