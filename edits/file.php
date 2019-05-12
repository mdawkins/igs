<?php
if($_GET["file"] == "about" || $_GET["file"] == "contact" ||
	$_GET["file"] == "greeting" || $_GET["file"] == "instr" ||
	$_GET["file"] == "faq" ||
	$_GET["file"] == "policies" || $_GET["file"] == "priv" )
{
	$passfile = $_GET["file"].'.php';
}
else
{
	echo "GO FUCK YOURSELF!!!";
	exit;
}

if($_POST["button"] == "Save")
{
	$_POST["text"]=stripslashes($_POST["text"]);
	chdir("../siteinfo");
	$dir=opendir(".");
	$file=fopen($passfile, "w");
	fwrite($file,$_POST["text"]);
	fclose($file);
}

chdir("../siteinfo");
$dir=opendir(".");
$file=fopen($passfile, "r");
$text=fread($file, filesize($passfile));
fclose($file);
#echo $text;

?>
<table width=100%>
	<tr>
		<td width=100% align=center>
		<form method="post">
		<font class=font1>Editting ... <?php echo $passfile; ?></font>
		<br>
		<textarea cols=100 rows=30 name="text"><?php echo $text; ?>
		</textarea><br>
		<input type=submit value="Save" name="button">
		<input type=submit value="Reset" name="button">
		</form>
		</td>
	</tr>
</table>
<?php #phpinfo(32);
?>
