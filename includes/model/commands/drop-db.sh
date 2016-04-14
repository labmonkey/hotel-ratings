#!/usr/bin/env bash

# drops database schema
(exec ../../vendor/bin/doctrine orm:schema-tool:drop --force)