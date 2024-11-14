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

# Instalar NGINX
RUN apt-get install -y nginx

# Configuración de directorios
WORKDIR /var/www

# Copiar el código fuente
COPY . .

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Instalar dependencias de Composer
RUN composer install --no-dev --optimize-autoloader

# Instalar dependencias de npm
RUN curl -sL https://deb.nodesource.com/setup_16.x | bash - \
    && apt-get install -y nodejs

RUN npm install

# Ejecutar Vite para compilar assets
RUN npm run build

# Copiar la configuración de NGINX al contenedor
COPY nginx/default.conf /etc/nginx/sites-available/default

# Exponer el puerto 80
EXPOSE 80

# Iniciar NGINX y PHP-FPM en el contenedor
CMD service nginx start && php-fpm
