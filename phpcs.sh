#!/bin/sh
php -d xdebug.mode=off ./vendor/bin/phpcs "$@"
