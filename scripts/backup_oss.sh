#!/bin/sh
# backup osourceshop
# mdawkins 11/16/2004

# directory to osourceshop
DIR=/home/websites/
#DIR=/var/www/

WEBSITEDIR=osourceshop

cd $DIR
td=$(date +%Y%m%d%H%M%S)
name=$(echo $WEBSITEDIR"_"$td".tar")
tar cf $name $WEBSITEDIR
bzip2 $name
newname=$(echo $name".bz2")
mv $newname ~/images

db=$(echo $WEBSITEDIR"_"$td".sql")
cd ~/images
mysqldump -u ossadmin $WEBSITEDIR -possadmin > $db
bzip2 $db

cd ~/

