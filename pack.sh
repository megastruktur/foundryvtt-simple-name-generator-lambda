#!/bin/bash

if [ "$1" == "" ]
then
	echo "Usage: ./pack.sh version"
	exit 1
fi

if [ ! -d "./packs/" ]
then
	mkdir packs
fi

# Make an archive and put it to packs dir
cd application
zip -r ../packs/$1.zip .
