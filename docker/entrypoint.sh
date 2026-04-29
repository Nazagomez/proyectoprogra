#!/usr/bin/env bash
set -euo pipefail

cd /var/www/html

export SESSION_DRIVER="${SESSION_DRIVER:-file}"
export CACHE_STORE="${CACHE_STORE:-file}"
export QUEUE_CONNECTION="${QUEUE_CONNECTION:-sync}"

if [ "${APP_KEY:-}" = "" ]; then
  echo "APP_KEY is required for production boots."
  exit 1
fi

mkdir -p database
if [ ! -f database/database.sqlite ]; then
  touch database/database.sqlite
fi

php artisan migrate --force
php artisan db:seed --force

php artisan config:cache
php artisan route:cache

exec php artisan serve --host=0.0.0.0 --port="${PORT:-10000}"
