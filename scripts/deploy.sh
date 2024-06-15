#!/bin/bash
set -e

echo "Deployment started ..."

# Enter maintenance mode or return truee
# if already is in maintenance mode
(php artisan down) || true

# Stash changes
git stash

# Pull the latest version of the app
git pull origin main

# Install composer dependencies
# composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader
composer install --no-interaction --prefer-dist --optimize-autoloader

# Clear the old cache
php artisan clear-compiled
php artisan cache:clear

# Recreate cache
php artisan optimize

# Install NPM
npm install

# Compile npm assets
npm run build

# Run database migrations
php artisan migrate --force
#php artisan migrate:fresh --seed



# Exit maintenance mode
php artisan down
php artisan up

echo "Deployment finished!"
#change1w
