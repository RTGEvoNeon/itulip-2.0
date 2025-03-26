#!/bin/bash

# Настройка переменных
PROJECT_DIR="."  # Локальный путь к проекту
ENV_FILE=".env.production"     # Файл продакшн-окружения
DOCKER_COMPOSE_FILE="docker-compose.yml"  # docker-compose файл
SERVER_USER="root"
SERVER_IP="itulip.ru"
REMOTE_DIR="/var/www/html"  # Папка на сервере

echo "🚀 Начинаем деплой на $SERVER_IP"

# 🔁 Синхронизация файлов
echo "📦 Копируем проект на сервер..."
rsync -avz --exclude=".git" --exclude="node_modules" --exclude=".env.local" --exclude=".env" "$PROJECT_DIR/" "$SERVER_USER@$SERVER_IP:$REMOTE_DIR"

# 🔧 Подключение и выполнение команд
echo "🔧 Подключаемся к серверу и запускаем контейнеры..."
ssh $SERVER_USER@$SERVER_IP << EOF
  set -e  # Остановиться при ошибке

  cd $REMOTE_DIR

  echo "📄 Обновляем .env файл..."
  cp $ENV_FILE .env

  echo "🐳 Перезапускаем docker-compose..."
  docker compose down
  docker compose up -d --build

  echo "✅ Деплой завершен."
EOF
