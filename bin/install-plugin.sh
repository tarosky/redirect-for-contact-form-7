#!/usr/bin/env bash

set -ex

curl -s $WP_PLUGIN -o plugin.zip
unzip plugin.zip -d .plugin
rm -f plugin.zip
