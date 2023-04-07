#!/bin/bash

set -o monitor

trap exit SIGCHLD

# Start nginx or apache, in this example, nginx
nginx -g 'daemon off;' &

# Start php-fpm
php-fpm -F --php-ini . &

wait
