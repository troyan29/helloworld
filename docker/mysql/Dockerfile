FROM docker_base

RUN echo "mysql-server mysql-server/root_password password root" | debconf-set-selections
RUN echo "mysql-server mysql-server/root_password_again password root" | debconf-set-selections

ENV DEBIAN_FRONTEND noninteractive
RUN apt-get install -y mysql-server

COPY sakila-data.sql /tmp/sakila-data.sql
COPY sakila-schema.sql /tmp/sakila-schema.sql

RUN /bin/bash -c "/usr/bin/mysqld_safe &" && \
  sleep 5 && \
  mysql -u root -proot < /tmp/sakila-schema.sql && \
  mysql -u root -proot < /tmp/sakila-data.sql

CMD ["mysqld"]