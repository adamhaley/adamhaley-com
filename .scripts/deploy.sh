#!/bin/bash
set -e

echo "Deployment started ..."

git config --global --add safe.directory /home/***/***haley-com

# Enter maintenance mode or return true
# if already is in maintenance mode
(php artisan down) || true

# Pull the latest version of the app
git pull origin master

# Install composer dependencies
composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# Clear the old cache
php artisan clear-compiled

# Recreate cache
php artisan optimize

# npm install
yarn install

# Compile npm assets
yarn run prod

# Run database migrations
php artisan migrate --force

#seed the database
php artisan db:seed

# Exit maintenance mode
php artisan up

echo whoami

echo "Deployment finished!"
