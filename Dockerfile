FROM php:8.2-apache

COPY . /home/leon/Documents/Software_Projekte/

WORKDIR /home/leon/Documents/Software_Projekte/

CMD [ "php", "./public/index.php"]