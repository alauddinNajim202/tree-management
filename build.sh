#!/usr/bin/env bash

# Install dependencies
composer install --no-dev --optimize-autoloader

# Clear caches
php artisan optimize:clear

# Give write permissions to the uploads folder
chmod -R 777 public/uploads

# Link storage directory
php artisan storage:link --force

# Run migrations (if any)
php artisan migrate --force
