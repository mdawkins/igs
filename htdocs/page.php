<?php

require '../functions/functions.php';

// Connect to the Database
$link = db_connect($DB_SERVER, $DB_LOGIN, $DB_PASSWORD, $DB);

#$title= "";
$scripts = '<SCRIPT LANGUAGE="JavaScript">
    function varitext(text){
    text=document
    print(text)
    }
    </script>';
//gzip compression
ob_start("ob_gzhandler");

html_head($title);
#echo '<link rel="stylesheet" type="text/css" href="/default.css.php">';
html_head_end($scripts);
echo "<body bgcolor=#f7eac8>\n";
require "../orders/".$_GET["filename"];
?>
</body>
</html>
<?php 
ob_end_flush();
#phpinfo(); ?>
