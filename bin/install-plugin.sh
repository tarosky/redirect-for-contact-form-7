#!/usr/bin/env bash

set -ex

download() {
    if [ `which curl` ]; then
        curl -s "$1" > "$2";
    elif [ `which wget` ]; then
        wget -nv -O "$2" "$1"
    fi
}

download $CF7 cf7.zip
unzip cf7.zip -d .lib
rm -f cf7.zip
