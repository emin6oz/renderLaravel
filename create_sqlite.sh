#!/bin/bash
touch /tmp/database.sqlite
php artisan migrate --force
