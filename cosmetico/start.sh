#!/bin/bash
set -e

echo "==> Optimizando configuración de Laravel..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan storage:link

echo "==> Ejecutando migraciones..."
php artisan migrate --force

echo "==> Iniciando PHP-FPM en segundo plano..."
php-fpm -D

echo "==> Iniciando Worker de Laravel en segundo plano..."
php artisan queue:work --tries=3 --timeout=90 > /var/www/storage/logs/worker.log 2>&1 &

echo "==> Iniciando Nginx..."
nginx -g 'daemon off;'
