<?php

$color_dark = '#3267a8';
$color_lite = '#ffffff';
$color_med = '#dddddd';

$px_large = '14px';
$px_med = '12px';
$px_small = '10px';

echo'

#feature_area {
	display: block;
	border: 3px solid '.$color_dark.'; 
	padding: 0px;
	width: 600px;
	height: 407px;
	font-size: '.$px_med.'; 
	color: '.$color_dark.'; 
}

div.row {
	clear: both;
	padding: 3px;
}

div.row #image {
	display: block; 
	padding: 0px;
	margin-right: 2px;
	margin-left: 2px;
	width: 125px;
	height: 125px;
	background: transparent;
	border:3px solid '.$color_dark.'; 
	overflow:hidden; 
	float:left;
}

div.row #image img {
	display block;
	padding: 0px;
	border: 0px; 
	width: 125px;
	height: 125px;
}

div.row #text {
	display: block; 
	padding: 0px;
	margin-right: 2px;
	margin-left: 2px;
	height: 125px; 
	width: 449px;
	background: '.$color_med.'; 
	border:3px solid '.$color_dark.'; 
	text-align: center; 
	text-decoration: none; 
	font-size: '.$px_med.'; 
	color: '.$color_dark.'; 
	line-height: 25px; 
	font-weight: bold;
	overflow: hidden; 
	float: left;
}

a.head, a.head:link, a.head:visited, a.head:active, a.head:visited {
	display: block; 
	background: transparent;
	text-align: center; 
	text-decoration: underline; 
	font-size: '.$px_large.'; 
	color: '.$color_dark.'; 
	font-weight: bold;
	overflow:hidden; 
}

a.head:hover {
	color: '.$color_dark.'; 
}

ul.area {
	padding: 0;
	width: 100%;
}

.area li {
	list-style-type: none;
}
';
