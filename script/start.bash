#!/bin/bash
echo "-- Start script --"
echo "Start symfony server"

symfony server:start

echo "Run watcher with yarn"

yarn encore prod --watch

echo "-- End --"