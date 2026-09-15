#!/bin/bash

# Cache configuration and routes for performance
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run database migrations
# Force flag is required to run in production mode
php artisan migrate --force

# Start the Apache server in the foreground
exec apache2-foreground
