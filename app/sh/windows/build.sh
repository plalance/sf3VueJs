#!/bin/sh
php ./bin/console make:entity SiteBundle --regenerate
php ./bin/console make:entity UserBundle --regenerate

( exec "./app/sh/windows/migrate.sh" )