# Usa la imagen oficial de PHP 8.2 con Apache.
FROM php:8.2-apache

# Actualiza el sistema e instala herramientas necesarias.
RUN apt -y update && apt install -y openssl zip unzip git

# Limpia la cache de paquetes para reducir el tamaño de la imagen.
RUN apt clean && rm -rf /var/lib/apt/lists/*

# Añade el instalador de extensiones PHP.
ADD --chmod=0755 https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

# Instala las extensiones PHP necesarias para Laravel y MySQL.
RUN install-php-extensions pdo pdo_mysql

# Activa el módulo 'rewrite' de Apache.
RUN a2enmod rewrite

# Define el directorio raíz de Apache en 'public'.
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# Actualiza la configuración de Apache para usar el nuevo directorio raíz.
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/conf-available/*.conf

# Copia el código fuente del proyecto al contenedor.
COPY . /var/www/html

# Establece el directorio de trabajo.
WORKDIR /var/www/html

# Descarga e instala Composer.
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instala las dependencias del proyecto Laravel de forma optimizada.
RUN composer install --prefer-dist --no-dev --no-interaction --optimize-autoloader

# Asigna los permisos de usuario/grupo correctos a los directorios que Laravel necesita para escribir.
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Da permisos de escritura a los directorios necesarios para Laravel.
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Genera la clave de la aplicación Laravel.
RUN php artisan key:generate

# Optimiza la configuración, rutas y vistas para producción.
RUN php artisan config:cache && php artisan