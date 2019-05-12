<?php

$color_dark = '#3267a8';
$color_lite = '#ffffff';
$color_med = '#dddddd';

$px_large = '14px';
$px_med = '12px';
$px_small = '10px';

echo'
.display_items {
	text-align: center;
	width: 150px;
        border: thin solid '.$color_dark.';
	float: left;
	padding: 5px;
	color: '.$color_dark.';
	font-size: '.$px_med.';
	text-decoration: none;
	background-color: transparent;
	font-weight: bold;
	
}

ul.item  {
	padding: 0;
	width: 100%;
}

.item li {
	list-style-type: none;
}
				
.item .button {
	background: '.$color_med.';
        border: thin solid '.$color_dark.';
	text-align: center;
	padding: 2px;
	color: '.$color_dark.';
}

';
?>
