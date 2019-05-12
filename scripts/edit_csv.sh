#!/bin/sh
# This is designed to take the .csv file used to data entry your products and turn it into a sql almost-ready file.
# At the begining this needs to added: "insert into products (" the top list of columns ") values" and from  there
# this script should have things ready. Problems to look out for are " double quotes or ' single quotes that are not
# escaped with \ and accidently add an extra column. 11/16/2004 mdawkins


echo -n "csv file: "
read csvfile
echo -n "output sql file: "
read sqlfile
#csvfile='a.csv'
#sqlfile="newdata.sql"

sed s/\'/\\\\\'/g $csvfile | 
sed s/\"\"/-/g |
sed s/\"//g | 
sed s/-/\"/g |
sed 2,\$s/^/\(\'/g | 
sed s/tn.jpg/tn.jpg\'\)/g |
sed s/\),/\)/g |
sed 2,\$s/,/\',\'/g |
sed 2,\$s/\ \'/\'/g |
sed 2,\$s/\)/\),/g |
sed \$,\$s/\),/\)/g > $sqlfile
