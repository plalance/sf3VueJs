#!/usr/bin/env bash

php ./bin/console doctrine:generate:entities SiteBundle --no-backup
php ./bin/console doctrine:generate:entities UserBundle --no-backup

( exec "./app/sh/migrate.sh" )