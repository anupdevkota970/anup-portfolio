
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

# Copy compiled frontend assets
COPY --from=frontend --chown=www-data:www-data /app/public/build ./public/build

# Install production PHP dependencies
USER root

RUN composer install \
    --no-dev \
    --no-interaction \
    --prefer-dist \
    --optimize-autoloader

# Ensure Laravel writable directories have correct ownership
RUN chown -R www-data:www-data storage bootstrap/cache

# Run application as non-root user
USER www-data

ENV APP_ENV=production
ENV APP_DEBUG=false
ENV PHP_OPCACHE_ENABLE=1
ENV NGINX_HTTP_PORT=8080

EXPOSE 8080

CMD ["/init"]
