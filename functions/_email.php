<?php
include "../config/serv_conf.inc";

$message = "User ID:\t".$_POST["user_id"]."\nE-mail Address:\t".$_POST["email_address"]."\nNew Password:\t".$_POST["rand_passwd"]."\n\n";
$message .= 'You can change your password anytime by going to "customer registry" on the menu and logging in to your account. From there you will click on "Change Personal Information" and then on the "Change Password" button.';
//e-mail order
$content_type = "text/html";
include "../config/mime_mail.inc";

# create object instance
$mail = new mime_mail;

# set all data slots
$mail->from    = $service_email;
$mail->to      = $_POST["email_address"];
$mail->subject = "Your information";
$mail->body    = $message;
#$mail->add_attachment($data, $page, $content_type); // I can't get the variable to accept a string ???

# send e-mail
$mail->send();
#echo "Your account information has been sent to ".$row["cust_email"];

unset($_POST["user_id"], $_POST["email_address"], $_POST["rand_passwd"]);

?>
