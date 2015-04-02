cd /var/www/

php app/console doctrine:database:create --env=test
php app/console doctrine:schema:update --force --env=test
php app/console doctrine:schema:update --force
