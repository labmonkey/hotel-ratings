#!/usr/bin/env bash

# required for cli-config.php to work
cd "$(dirname "$0")"

# generates entity classes from .yml
(exec ../../vendor/bin/doctrine orm:generate-entities ../entities)

# updates database schema
(exec ../../vendor/bin/doctrine orm:schema-tool:update --force --dump-sql)