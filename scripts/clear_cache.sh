#!/bin/bash

echo "🔄 Очистка кэша Laravel..."

php artisan view:clear
php artisan route:clear
php artisan config:clear
php artisan cache:clear
php artisan clear-compiled
php artisan optimize:clear

echo "✅ Laravel кэш очищен."
