#!/bin/bash

php /app/artisan migrate
php /app/artisan db:seed --class=DatabaseSeeder
php-fpm
