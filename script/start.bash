#!/bin/bash
echo "-- Start script --";

echo "---- Start symfony server in background ----";

symfony server:start -d

echo "---- Run watcher with yarn ----";

yarn encore prod --watch

echo "-- End --"