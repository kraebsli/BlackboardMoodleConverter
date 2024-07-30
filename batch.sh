#!/bin/bash

for FILE in uploads/*
do
php parse.php $(basename $FILE)
done
