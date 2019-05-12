<?php

   $DB_SERVER="localhost";	// Database Server machine
   $DB_LOGIN="igsuser";		// Database login 
   $DB_PASSWORD="igsuser";	// Database password
   $DB="igs";			// Database containing the tables
   $tablename="cust_info";
   $WEBSITE="http://igs";
   $SSLWEBSITE="http://igs";
   $SITECOOKIE=$_SERVER['HTTP_HOST'];

   $SITENAME="igs";
   $DOMAINNAME="igs";
   $BUSINESSNAME="Internet Gift Shop";
   $BUSINESSCITY='Somecity'; 
   $BUSINESSCOUNTY='Somecounty';
   $BUSINESSSTATE='Colorado';
   $BUSINESSSTATEABR='CO';
   $BUSINESSZIP='80123';
   $SHORTNAME="Internet Gift Shop";
   $BUSINESSADDRESS='123 W. Somestreet Ave.<br>P.O. BOX 1234<br>'.$BUSINESSCITY.', '.$BUSINESSSTATEABR.' '.$BUSINESSZIP.'<br><br>';
   $BUSINESSMAILADDRESS='P.O. BOX 1234<br>'.$BUSINESSCITY.', '.$BUSINESSSTATEABR.' '.$BUSINESSZIP.'<br><br>';
   $BUSINESSPHONE='999.765.4321';
   $BUSINESSFAX='999.765.4322';
   $BUSINESSORDERS='1.800.999.5IGS (5555)';
   $BUSINESSNBRS=$BUSINESSPHONE.'<br>'.$BUSINESSFAX.'<br>'.$BUSINESSORDERS.'<br><br>';

   $title="Internet Gift Shop offers things and stuff";

   $orders_email = 'orders@'.$DOMAINNAME;
   $service_email = 'service@'.$DOMAINNAME;

   $FREE_SHIPPING_LIMIT = '89.99';
   $SHIPPING_LIMIT = '8.99';

   $rewriteurl = "no";

?>
