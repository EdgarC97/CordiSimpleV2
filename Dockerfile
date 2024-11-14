# Usamos una imagen base con PHP
FROM php:8.2-fpm

# Instalar dependencias necesarias para PHP
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    git \
    libzip-dev \
    unzip \
    libicu-dev \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip intl pdo pdo_mysql

# Instalar Node.js y npm (la versión de Node.js puede ser ajustada a la que necesites)
RUN curl -sL https://deb.nodesource.com/setup_16.x | bash - \
    && apt-get install -y nodejs

# Configuración de directorios
WORKDIR /var/www

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copiar el código fuente
COPY . .

# Instalar dependencias de Composer
RUN composer install --no-dev --optimize-autoloader

# Instalar dependencias de npm
RUN npm install

# Ejecutar Vite para compilar assets
RUN npm run build

# Exponer el puerto 9000 para el contenedor PHP-FPM
EXPOSE 9000

# Configurar el contenedor para usar PHP-FPM
CMD ["php-fpm"]
