#!/usr/bin/env bash

php ./bin/console make:entity SiteBundle --regenerate
php ./bin/console make:entity UserBundle --regenerate

( exec "./app/sh/unix/migrate.sh" )