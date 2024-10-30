FROM php:8.2-apache

EXPOSE 80

# install composer
RUN curl -sS https://getcomposer.org/installer -o /tmp/composer-setup.php && php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer

# install node
RUN apt-get update && apt-get install -y ca-certificates curl gnupg && mkdir -p /etc/apt/keyrings
RUN curl -fsSL https://deb.nodesource.com/gpgkey/nodesource-repo.gpg.key | gpg --dearmor -o /etc/apt/keyrings/nodesource.gpg
RUN NODE_MAJOR=20 && echo "deb [signed-by=/etc/apt/keyrings/nodesource.gpg] https://deb.nodesource.com/node_$NODE_MAJOR.x nodistro main" | tee /etc/apt/sources.list.d/nodesource.list
RUN apt-get update
RUN apt-get install nodejs -y

# install supervisor
RUN apt install supervisor -y
RUN apt install libxml2-dev libonig-dev -y

# install pdo mysql php extension
RUN docker-php-ext-install pdo_mysql

# install & enable php mysqli extension
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# install php ftp extension
RUN apt install libssl-dev -y && docker-php-ext-install ftp

# install & enable php gd extension
RUN apt install -y libpng-dev libfreetype6-dev libjpeg62-turbo-dev
RUN docker-php-ext-configure gd --with-freetype --with-jpeg && docker-php-ext-install gd && docker-php-ext-enable gd

# install zip extension
RUN apt install libzip-dev -y
RUN docker-php-ext-install zip

# enable Apache's mod rewrite
RUN a2enmod rewrite

# enable Apache's mod expires
RUN a2enmod expires

# install git
RUN apt install git -y

# install & enabling xdebug
RUN pecl install xdebug-3.3.1 && docker-php-ext-enable xdebug

# copying php conf files into a separate folder
# where we will add the xdebug config file.
# deleting the default xdebug config file.
RUN rm -f /usr/local/etc/php/conf.d/*xdebug.ini && cp -R /usr/local/etc/php/conf.d /usr/local/etc/php/conf.d-dev

# create the log file to be able to run tail
RUN touch /var/log/cron.log

# install cron
RUN apt -y install cron

# setup cron job
RUN crontab -l | { cat; echo "* * * * * cd /var/www/app && /usr/local/bin/php artisan schedule:run >> /dev/null 2>&1"; } | crontab -

# instal wget
RUN apt -y install wget

# install & configure phpmyadmin
WORKDIR /root
RUN wget https://files.phpmyadmin.net/phpMyAdmin/5.2.1/phpMyAdmin-5.2.1-all-languages.tar.gz
RUN tar xvf phpMyAdmin-5.2.1-all-languages.tar.gz
RUN mv phpMyAdmin-5.2.1-all-languages /usr/share/phpmyadmin
RUN mkdir -p /var/lib/phpmyadmin/tmp
RUN chown -R www-data:www-data /var/lib/phpmyadmin
RUN cp /usr/share/phpmyadmin/config.sample.inc.php /usr/share/phpmyadmin/config.inc.php

# install nano
RUN apt install nano -y

# enable apache mod filter
RUN a2enmod filter

# enable apache gzip module
RUN a2enmod deflate

# install unzip
RUN apt install unzip

WORKDIR /var/www/app

# symlink phpmyadmin
# run the cron service
# set permissions
# run composer install
# run migrations
# run npm install and build
# run supervisor (skipped) (supervisorctl start all) instead stop supervisor
# symlink storage directory
# run apache in the foreground
CMD bash -c "ln -sf /usr/share/phpmyadmin /var/www/app/public/phpmyadmin && service cron start && chmod -R 777 storage bootstrap && composer install --no-dev && php artisan migrate --force && npm install && npm run build && service supervisor stop && php artisan storage:link && apachectl -D FOREGROUND"
