#!/bin/sh

# Wait for MySQL
while ! mysqladmin ping -h"$DB_HOST" --silent; do
    echo 'waiting for mysql to be connectable...'
    sleep 2
done

# Run Laravel migrations
php artisan migrate
