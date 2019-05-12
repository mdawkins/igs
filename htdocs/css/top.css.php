<?php

$color_dark = '#3267a8';
$color_lite = '#ffffff';
$color_med = '#dddddd';

$px_large = '14px';
$px_med = '12px';
$px_small = '10px';

echo'
a.top_area, a.top_area:link, a.top_area:visited {
	display: block; 
	padding: 0px;
	width: 170px;
	background: transparent;
	margin-right: 2px; 
	text-align: center; 
	text-decoration: none; 
	font-size: '.$px_large.'; 
	color: '.$color_dark.'; 
	line-height:25px; 
	font-weight: bold;
	overflow:hidden; 
	float:left;
}

a.top_area:hover {
	color: '.$color_med.'; 
}

ul.top_area {
	padding: 0;
	width: 100%;
}

.top_area li {
	list-style-type: none;
}

a.top_menu, a.top_menu:link, a.top_menu:visited {
	display: block; 
	height: 25px; 
	padding-left: 18px;
	padding-right: 18px;
	background: '.$color_med.'; 
	border:1px solid '.$color_dark.'; 
	margin-right: 2px; 
	text-align: center; 
	text-decoration: none; 
	font-size: '.$px_large.'; 
	color: '.$color_dark.'; 
	line-height:25px; 
	font-weight: bold;
	overflow:hidden; 
	float:left;
}

a.top_menu:hover {
	color: '.$color_med.'; 
	background: '.$color_dark.';
}

ul.top_menu {
	padding: 0;
	width: 100%;
}

.top_menu li {
	list-style-type: none;
}
			
a.top_area_text, a.top_area_text:link, a.top_area_text:visited {
	display: block; 
	height: 25px; 
	width: 170px;
	background: '.$color_med.'; 
	border:1px solid '.$color_dark.'; 
	margin-right: 2px; 
	text-align: center; 
	text-decoration: none; 
	font-size: '.$px_large.'; 
	color: '.$color_dark.'; 
	line-height:25px; 
	font-weight: bold;
	overflow:hidden; 
	float:left;
}

a.top_area_text:hover {
	color: '.$color_med.'; 
	background: '.$color_dark.';
}

ul.top_area_text {
	padding: 0;
	width: 100%;
}

.top_menu li {
	list-style-type: none;
}

';
