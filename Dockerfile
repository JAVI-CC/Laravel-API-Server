FROM php:8.2.13-fpm

# Arguments defined in docker-compose.yml
ARG user
ARG uid

# Copy composer.json to /var/www/
COPY composer.json /var/www/

# Set working directory
WORKDIR /var/www

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:2.7.2 /usr/bin/composer /usr/bin/composer

# We install composer dependencies
RUN composer install --no-ansi --no-interaction --no-progress --optimize-autoloader --no-scripts

# We copy all the files from the current folder of
# laravel files to /var/www/
COPY . .

# To generate the necessary files that Composer will use for autoloading
RUN composer dump-autoload -o

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

EXPOSE 9000

CMD ["php-fpm"]