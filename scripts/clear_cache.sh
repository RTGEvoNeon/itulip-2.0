#!/bin/bash

echo "🔄 Очистка кэша Laravel..."

docker compose exec -it app php artisan view:clear
docker compose exec -it app php artisan route:clear
docker compose exec -it app php artisan config:clear
docker compose exec -it app php artisan cache:clear
docker compose exec -it app php artisan clear-compiled
docker compose exec -it app php artisan optimize:clear

echo "✅ Laravel кэш очищен."
