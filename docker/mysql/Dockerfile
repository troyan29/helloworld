FROM docker_base

# RUN debconf-set-selections <<< 'mysql-server mysql-server/root_password password root_passoword'
# RUN debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password root_password'

ENV DEBIAN_FRONTEND noninteractive
RUN apt-get install -y mysql-server

COPY sakila-data.sql /tmp/sakila-data.sql
COPY sakila-schema.sql /tmp/sakila-schema.sql

# RUN mysql -uroot < /tmp/sakila-schema.sql
# RUN mysql -uroot < /tmp/sakila-data.

CMD ["mysqld"]

EXPOSE 3306