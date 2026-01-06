#!/bin/sh



# Exécuter les migrations et seeders
php artisan migrate --force

# Optimiser Laravel
php artisan optimize:clear
php artisan optimize
php artisan view:cache
php artisan route:cache
php artisan config:cache

# Démarrer Supervisor
exec supervisord -c /etc/supervisor/conf.d/supervisord.conf