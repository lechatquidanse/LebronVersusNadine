#!/bin/sh
if [ ! -d "/usr/local/bin/phpunit" ]; then
  echo ''
  echo 'Phpunit INSTALLING'
  echo '----------'
  sudo wget https://phar.phpunit.de/phpunit.phar
  sudo chmod +x phpunit.phar
  sudo mv phpunit.phar /usr/local/bin/phpunit
fi