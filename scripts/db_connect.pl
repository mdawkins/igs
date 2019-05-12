#!/usr/bin/perl

use DBI;
#use strict;

my ($dsn) = "DBI:MYSQL:tpnshop";
my ($user_name) = "root";
my ($password) = "";
my ($dbh, $sth);
my ( @ary);
		  
open(OUT, ">replace.sh");
print OUT '#!/bin/sh
infile="newdata.csv"
file="newdata.sql"

sed s/\\\'/\\\\\\\\\\\'/g $infile |
sed s/\"\"/--/g |
sed s/\"//g |
sed s/--/\"/g |
sed 2,\$s/^/\(\\\'/g |
sed s/tn.jpg/tn.jpg\\\'\)/g |
sed s/\),/\)/g  |
sed 2,\$s/,/\\\',\\\'/g |
sed 2,\$s/\ \\\'/\\\'/g |
sed 2,\$s/\)/\),/g |
sed \$,\$s/\),/\)/g |
';

$cat = shift;
$dbh = DBI->connect ($dsn,$user_name,$password,{RaiseError => 1});

$sth = $dbh->prepare ("select subcat_name, subcat_id from subcat where cat_id = $cat");
$sth->execute();

while (@ary = $sth->fetchrow_array())
{
	@ary[0]=~s/\s/\\ /g;
	print OUT 'sed s/\\\'',@ary[0],"\\'/", @ary[1], "/g |\n";
}
$sth->finish();

$sth = $dbh->prepare ("select cat_name, cat_id from cat where cat_id = $cat");
$sth->execute();
while (@ary=$sth->fetchrow_array())
{
	@ary[0]=~s/\s/\\ /g;
	print OUT 'sed s/\\\'',@ary[0],"\\'/", @ary[1], "/g > \$file\n";
}
close(OUT);
$sth->finish();
$dbh->disconnect();
exit(0);
  
