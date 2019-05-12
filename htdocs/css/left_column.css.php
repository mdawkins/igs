<?php

$color_dark = '#3267a8';
$color_lite = '#ffffff';
$color_med = '#dddddd';

$px_large = '14px';
$px_med = '12px';
$px_small = '10px';

echo'

#left_column {
	padding: 0px;
	margin-right: 4px;
	color: '.$color_dark.';
	font-size: '.$px_med.';
	text-decoration: none;
	font-weight: bold;
	background-color: transparent;
}

ul.search  {
	border: 1px solid '.$color_dark.';
	text-align: center;
	padding: 0px;
	background: '.$color_med.';
}

.search li {
	padding: 3px;
	list-style-type: none;
}

ul.categories  {
	border: 1px solid '.$color_dark.';
	text-align: left;
	padding-left: 20px;
	background: '.$color_med.';
}

.categories li {
	padding: 3px;
	list-style-type: none;
}
				
a.cat, a.cat:link, a.cat:visited, a.cat:active, a.cat:visited {
	display: block; 
	background: transparent;
	text-decoration: none; 
	font-size: '.$px_large.'; 
	color: '.$color_dark.'; 
	font-weight: bold;
}

a.cat:hover {
	color: '.$color_lite.'; 
}
				
ul.botmenu  {
	border: 1px solid '.$color_dark.';
	text-align: center;
	padding: 0px;
	background: '.$color_med.';
}

.botmenu li {
	padding: 3px;
	list-style-type: none;
}
				
a.left, a.left:link, a.left:visited, a.left:active, a.left:visited {
	display: block; 
	background: transparent;
	text-decoration: none; 
	font-size: '.$px_med.'; 
	color: '.$color_dark.'; 
	font-weight: bold;
}

a.left:hover {
	color: '.$color_lite.'; 
}
				
ul.low_extra  {
	border: 1px solid '.$color_dark.';
	text-align: center;
	padding: 0px;
	background: '.$color_med.';
}

.low_extra li {
	padding: 3px;
	list-style-type: none;
}
				

';
?>
