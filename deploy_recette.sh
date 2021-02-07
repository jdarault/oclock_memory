#!/bin/sh

php composer.phar dump-env test
php bin/console doctrine:schema:update --force
php bin/console cache:clear --env=test
chmod -R 777 var