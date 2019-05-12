<?php

$form_num = 10;
$uploaddir = '/var/www/osourceshop/images/';
$allowed_extensions = array('.jpg', '.gif', '.png');

if(!isset($_POST) || empty($_POST)) 
{
	echo '<form name="upload_form" enctype="multipart/form-data" method="post" action="'.basename($_SERVER['REQUEST_URI']).'">
<div class=tbl_title_front>
	<h4 class=title_form>Upload Image Files</h4>'."\n";
	for($i=0;$i<$form_num;$i++)
	{
		echo '<label for=imagefile'.$i.'>Image File '.($i+1).'</label><input class=text type=file name="imagefile'.$i.'"><br />'."\n";
	}
	echo '<h4 class=title_button><input class=submit type=submit name="Submit" value="Upload"></h4>
</div>
</form>'."\n";
} 
else 
{
	// function to return filename and extension as an array
	function split_extension($filename)
	{
		for($i = 1; $i < strlen($filename); $i++)
		{
			if(substr($filename, -$i, 1) == '.')
			{
				$filename_array['filename'] = substr($filename, 0, -$i);
				$filename_array['extension'] = substr($filename, -$i, strlen($filename));
				return $filename_array;
			}
		}
	}

	for($i=0;$i<$form_num;$i++)
	{
		#if(isset($_FILES['imagefile'.$i]) && !empty($_FILES['imagefile'.$i])) 
		if(!empty($_FILES['imagefile'.$i]['name'])) 
		{
			// check the filename has the correct extension
			$filename_array = split_extension($_FILES['imagefile'.$i]['name']);

			if(!in_array($filename_array['extension'], $allowed_extensions)) 
			{
				echo 'You can only upload .gif, .jpg or .png files!';
				print_r($filename_array);
				exit();
			}
			// move the uploaded file to the target destination
			if(!move_uploaded_file($_FILES['imagefile'.$i]['tmp_name'], $uploaddir.$_FILES['imagefile'.$i]['name'])) 
			{
				echo 'The file could not be uploaded this time. <a href="'.basename($_SERVER['REQUEST_URI']) . '>Click here and try again.</a>';
				exit();
			}
			chmod($uploaddir.$_FILES['imagefile'.$i]['name'], 0644);
			$command = 'mogrify -resize 250x250 '.$uploaddir.$_FILES['imagefile'.$i]['name'];
			exec($command);

			$newfile = $filename_array['filename'].'_tn'.$filename_array['extension'];
			if (!copy($uploaddir.$_FILES['imagefile'.$i]['name'], $uploaddir.$newfile)) 
				echo "failed to copy ".$_FILES['imagefile'.$i]['name']."...<br />\n";
			
			$command = 'mogrify -resize 110x110 '.$uploaddir.$newfile;
			exec($command);

		}
	
	}
}
?>
