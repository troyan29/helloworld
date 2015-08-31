FROM docker_base

RUN apt-get install  -y git

RUN apt-get install -y php5-fpm \
	php5-mysql \
	php5-xdebug

RUN apt-get install -y nginx

RUN rm /etc/nginx/sites-enabled/default
COPY configuration /etc/nginx/sites-enabled/testing.local.conf

COPY php.ini /etc/php5/fpm/php.ini

RUN service php5-fpm start

RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer


CMD service php5-fpm start && nginx -g 'daemon off;'
EXPOSE 80