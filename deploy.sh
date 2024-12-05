#!/bin/bash

# Настройка переменных
PROJECT_DIR="."  # Путь к вашему проекту на сервере
ENV_FILE=".env.production"     # Укажите, какой файл .env использовать для продакшн
DOCKER_COMPOSE_FILE="docker-compose.yml"  # Путь к файлу docker-compose
SERVER_USER="root"  # Имя пользователя на сервере
SERVER_IP="itulip.ru"  # IP-адрес вашего сервера

# Перенос файлов на сервер
echo "Переносим файлы на сервер..."
rsync -avz --exclude=".git" --exclude="node_modules" --exclude=".env.local" $PROJECT_DIR $SERVER_USER@$SERVER_IP:/var/www/html

# Подключаемся к серверу для выполнения команд
echo "Подключаемся к серверу..."
ssh $SERVER_USER@$SERVER_IP << EOF

  # Переходим в директорию проекта
  cd /var/www/html

  # Копируем .env.production в .env (если еще не сделано)
  cp $ENV_FILE .env
  
  #установка зависимостей
  #npm ci
  #npm run production



