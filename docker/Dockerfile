FROM php:8.2-apache

RUN apt-get update && \
    apt-get install -y git

# instalação do composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# instalação do node
RUN apt-get update && apt-get install -y gnupg
RUN curl -sL https://deb.nodesource.com/setup_14.x | bash -
RUN apt-get install -y nodejs

# habilitação da extensão mysql
RUN docker-php-ext-install pdo_mysql

# configuração do apache
COPY vhost.conf /etc/apache2/sites-available/
RUN a2enmod rewrite

# configuração do PHP
COPY custom.ini /usr/local/etc/php/
ADD vhost.conf /etc/apache2/sites-enabled/000-default.conf

EXPOSE 80
CMD ["apache2-foreground"]
