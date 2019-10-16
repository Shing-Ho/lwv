#!/bin/bash
DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

cd ${DIR}
echo "-----------------------------------------"
echo "-- Running schedule for LWV Site"
echo "-- $(date)"
echo "-----------------------------------------"
php artisan search:refresh
php artisan search:refresh documents
php artisan documents:status
php artisan messaging:process

chmod -R 777 ${DIR}/storage
chown -R nginx:nginx ${DIR}

echo "-----------------------------------------"
echo "-- Finished"
echo "-- $(date)"
echo "-----------------------------------------"
