#!/bin/bash

echo "🔄 Очистка кэша Laravel..."

docker exec -it app php artisan view:clear
docker exec -it app php artisan route:clear
docker exec -it app php artisan config:clear
docker exec -it app php artisan cache:clear
docker exec -it app php artisan clear-compiled
docker exec -it app php artisan optimize:clear

echo "✅ Laravel кэш очищен."
