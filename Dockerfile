FROM php:8.4-apache

# Instalación de dependencias del sistema
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    libicu-dev \
    && rm -rf /var/lib/apt/lists/*

# Extensiones de PHP (Incluyendo MySQL)
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        gd \
        pdo_mysql \
        mysqli \
        intl \
        zip \
        bcmath \
        sockets

# Redis y configuración de Apache
RUN pecl install redis && docker-php-ext-enable redis
RUN a2enmod rewrite

# --- NUEVA CONFIGURACIÓN PARA DISPONIBILIDAD INMEDIATA ---

# 1. Redirigir Apache a la carpeta /web (Elimina el error Forbidden)
ENV APACHE_DOCUMENT_ROOT /var/www/html/web
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 2. Copiar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# 3. Script de arranque: Instala dependencias, ajusta permisos y lanza Apache
# Esto permite que el proyecto esté disponible sin comandos manuales
CMD bash -c "composer install --no-interaction && \
    mkdir -p runtime web/assets && \
    chmod -R 777 runtime web/assets && \
    apache2-foreground"