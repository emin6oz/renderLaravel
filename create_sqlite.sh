#!/bin/bash
touch /database/db.sqlite
php artisan migrate --force
