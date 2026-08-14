#!/bin/sh
set -e

if [ -n "${MYSQL_ADDON_HOST:-}" ]; then
  export DB_CONNECTION="${DB_CONNECTION:-mysql}"
  export DB_HOST="${DB_HOST:-$MYSQL_ADDON_HOST}"
  export DB_PORT="${DB_PORT:-$MYSQL_ADDON_PORT}"
  export DB_DATABASE="${DB_DATABASE:-$MYSQL_ADDON_DB}"
  export DB_USERNAME="${DB_USERNAME:-$MYSQL_ADDON_USER}"
  export DB_PASSWORD="${DB_PASSWORD:-$MYSQL_ADDON_PASSWORD}"
  export DB_URL="${DB_URL:-$MYSQL_ADDON_URI}"
fi

php artisan config:cache
php artisan view:cache
php artisan migrate --force

exec supervisord -c /etc/supervisor/conf.d/supervisord.conf
