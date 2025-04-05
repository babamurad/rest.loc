#!/bin/bash

set -e

git pull origin main

php8.3 artisan down

php8.3 composer.pchar update --no-dev --optimize-autoloader

php8.3 composer.pchar dump-autoload --optimize

php8.3 artisan migrate --force

php8.3 artisan cache:clear

php8.3 artisan config:clear

php8.3 artisan view:clear

php8.3 artisan route:clear

php8.3 artisan optimize:clear

php8.3 artisan optimize

php8.3 artisan config:cache

php8.3 artisan route:cache

php8.3 artisan view:cache

php8.3 artisan event:cache

php8.3 artisan queue:restart

php8.3 artisan up