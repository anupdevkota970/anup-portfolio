
# Stage 1: Build frontend assets
FROM node:22-alpine AS frontend

WORKDIR /app

COPY package*.json ./
RUN npm ci

COPY . .
RUN npm run build


# Stage 2: Laravel production application
FROM serversideup/php:8.2-fpm-nginx

WORKDIR /var/www/html

# Copy Laravel application
COPY --chown=www-data:www-data . .

# Copy compiled Vite assets
COPY --from=frontend --chown=www-data:www-data /app/public/build ./public/build

# Install production PHP dependencies
USER www-data

RUN composer install \
    --no-dev \
    --no-interaction \
    --prefer-dist \
    --optimize-autoloader

# Production settings
ENV APP_ENV=production
ENV APP_DEBUG=false
ENV LOG_OUTPUT_LEVEL=warn
ENV PHP_OPCACHE_ENABLE=1

EXPOSE 8080
