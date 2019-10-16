#!/bin/bash
DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

cd ${DIR}

# Purge Laravel Caches
php artisan cache:clear
php artisan twig:clean
php artisan view:clear
php artisan assets:clear
php artisan config:clear
rm -rf ${DIR}/storage/framework/cache/* ${DIR}/storage/framework/views/*

# Purge sessions
rm -rf ${DIR}/storage/framework/sessions/*

# Purge Pyro cached content
rm -rf ${DIR}/storage/streams/${APP}/pages ${DIR}/storage/streams/${APP}/variables ${DIR}/storage/streams/${APP}/templates

chmod -R 777 ${DIR}/storage
chown -R nginx:nginx ${DIR}