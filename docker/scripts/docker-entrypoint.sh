#!/bin/sh

if [ "$APP_ENV" == "dev" ]
then
  chmod -R 0750 /var/www/credit-int/docker/postgres/data
  /usr/local/bin/composer install
  /var/www/credit-int/bin/console doctrine:migrations:migrate --no-interaction
else
  set -e
fi

supervisord -n -c /etc/supervisord/supervisord.conf