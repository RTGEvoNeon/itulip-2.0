#!/bin/bash

# Указываем локальный путь к проекту
LOCAL_PROJECT_PATH="."

# Указываем сервер и путь на нем
REMOTE_USER="root"
REMOTE_HOST="itulip.ru"
REMOTE_PROJECT_PATH="/var/www/html"

# Массив с путями для исключения
EXCLUDES=(
  "vendor"
  "node_modules"
)

# Формируем параметр для rsync с исключениями
EXCLUDE_PARAMS=""
for EXCLUDE in "${EXCLUDES[@]}"; do
  EXCLUDE_PARAMS+="--exclude '$EXCLUDE' "
done

# Выполняем команду rsync для передачи проекта
rsync -avz $EXCLUDE_PARAMS "$LOCAL_PROJECT_PATH" "$REMOTE_USER@$REMOTE_HOST:$REMOTE_PROJECT_PATH"
