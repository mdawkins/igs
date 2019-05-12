<?php
$to = "service@igs";
$subject = "ZDNet Developer article";
$msg = "I completely understand SMTP servers now!";
$headers = "From: orders@igs\r\n";
mail("$to", "$subject", "$msg", "$headers");
echo "finished!";
?>
