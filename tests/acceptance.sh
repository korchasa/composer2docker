#!/usr/bin/env bash
set -ex
docker build -t korchasa/composer2docker . > /dev/null
rm -rf /tmp/phpstan
git clone https://github.com/phpstan/phpstan.git /tmp/phpstan > /dev/null
cd /tmp/phpstan
git checkout 0.8.5 -b 0.8.5
composer install --no-dev -q
docker run --rm -v "$(pwd)":/work korchasa/composer2docker > Dockerfile
docker build -t phpstan . > /dev/null
docker run --rm -v "$(pwd)":/work phpstan > /dev/null