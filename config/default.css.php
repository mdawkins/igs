<?php

$color_dark = '#880838';
$color_lite = '#f7eac8';
$color_med = '#dd9f9f';

echo'body, p, h1, h2, h3, table, td, th, ul, ol {
font-family: verdana,helvetica,arial,sans-serif;
}

body {
	color: black;
	background-color: white;
	margin-top: 0px;
	margin-left: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	height: auto;
	width: 780px;
}

#A1 {
	position: relative;
	float: left;
	top: 0px;
	left: 0px;
	height: auto;
	width: 780px;
}

#cover {
	position: relative;
	float: left;
}

#B2 {
	background-color: '.$color_lite.';
	left: 0px;
	height: auto;
}

#C3 {
	background-color: '.$color_lite.';
	vertical-align: top;
}

#C3text {
	vertical-align: top;
	border: thin solid '.$color_dark.';
	background-color: '.$color_lite.';
	margin: 2px;
}

p {
	font-size: 12px;
	color: '.$color_dark.';
	text-decoration: none;
	background-color: transparent;
}

.font_black {
	font-size: 12px;
	color: black;
	font-weight: bold;
}

.font_green {
	font-size: 12px;
	color: green;
	font-weight: bold;
}

.font_blue {
	font-size: 12px;
	color: blue;
	font-weight: bold;
}

.font_red {
	font-size: 12px;
	color: red;
	font-weight: bold;
}

.bg1 {
	background-color: '.$color_lite.';
}

.bg2 {
	font-size: 14px;
	font-weight: bold;
	color: '.$color_lite.';
	background-color: '.$color_dark.';
}

.tbl_display {
	background-color: '.$color_lite.';
        border: thin solid '.$color_dark.';
	margin: 2px;
	padding: 0px;
}

.tbl_col {
        border: thin solid '.$color_dark.';
	margin: 2px;
	width: 98%;
	background-image: url(/graphics/beige197.jpg);
}

.tbl_copy {
        border: thin solid '.$color_dark.';
	text-align: center;
	margin: 0 2px 2px 2px;
	padding: 0px;
	width: 98%;
	background-image: url(/graphics/beige197.jpg);
}

.tbl_front {
        border: thin solid '.$color_dark.';
	text-align: center;
	margin: 2px 0 0 2px;
	padding: 0px;
	height: 1%;
	background-image: url(/graphics/beige197.jpg);
}

.tbl_title_front {
        border: thin solid '.$color_dark.';
	margin: 2px 0 0 2px;
	width: auto;
	height: 1%;
	background-image: url(/graphics/beige197.jpg);
}

.div_cart {
	display:inline;
	float:left;
	color: '.$color_dark.';
	font-size: 12px;
	text-decoration: none;
	background-color: transparent;
	font-weight: bold;
}

.title {
	font-size: 14px;
	font-weight: bold;
	color: '.$color_lite.';
	background-color: '.$color_dark.';
	text-align: justify;
	padding: 2px;
}
.title.a {
	padding: 0 10px 0 10px;
}

.title_front {
	font-size: 12px;
	font-weight: bold;
	color: '.$color_lite.';
	background-color: '.$color_dark.';
	text-align: left;
	padding: 3px;
	margin: 0px;
}

.title_form {
	font-size: 12px;
	font-weight: bold;
	color: '.$color_lite.';
	background-color: '.$color_dark.';
	text-align: center;
	padding: 3px;
	margin: 0px;
}

.title_button {
	font-size: 12px;
	font-weight: bold;
	color: '.$color_lite.';
	background-color: '.$color_dark.';
	text-align: center;
	padding: 1px;
	margin: 0px;
}

label {
	float: left;
	font-size: 12px;
	color: '.$color_dark.';
	font-weight: bold;
	text-align: left;
	width: 180px;
	padding: 0 0 0 4px;
	margin: 0;
}

.field {
	font-size: 12px;
	color: '.$color_dark.';
	font-weight: bold;
	text-align: left;
	width: 180px;
	background-color: '.$color_lite.';
}

.comment {
	width: auto;
	background-color: '.$color_lite.';
	text-align: left;
	padding: 0;
	margin: 0;
}

.field2 {
	font-size: 12px;
	color: '.$color_dark.';
	text-align: right;
	width: 150px;
}

input.text, select.text, textarea {
	font-size: 10px;
	padding: 0px;
	margin: 2px;
}

input.submit {
	color: '.$color_dark.';
	font-size: 12px;
	background-color: '.$color_lite.';
	text-align: center;
	font-weight: bold;
	height: 22px;
	width: 129px;
	margin: 0 5px 0 5px;
}

input.search {
	color: '.$color_dark.';
	font-size: 12px;
	background-color: '.$color_lite.';
	text-align: center;
	font-weight: bold;
	height: 22px;
	width: 40px;
}

.dark_large {
	color: '.$color_dark.';
	font-size: 14px;
	text-decoration: none;
	background-color: transparent;
	font-weight: bold;
}

.dark_med {
	color: '.$color_dark.';
	font-size: 12px;
	text-decoration: none;
	background-color: transparent;
	font-weight: bold;
}

.dark_small {
	color: '.$color_dark.';
	font-size: 10px;
	text-decoration: none;
	background-color: transparent;
	font-weight: bold;
}

.lite_large {
	color: '.$color_lite.';
	font-size: 14px;
	text-decoration: none;
	background-color: transparent;
	font-weight: bold;
}

.lite_med {
	color: '.$color_lite.';
	font-size: 12px;
	text-decoration: none;
	background-color: transparent;
	font-weight: bold;
}

.lite_small {
	color: '.$color_lite.';
	font-size: 10px;
	text-decoration: none;
	background-color: transparent;
	font-weight: bold;
}

.med_large {
	color: '.$color_med.';
	font-size: 14px;
	text-decoration: none;
	background-color: transparent;
	font-weight: bold;
}

.med_med {
	color: '.$color_med.';
	font-size: 12px;
	text-decoration: none;
	background-color: transparent;
	font-weight: bold;
}

.med_small {
	color: '.$color_med.';
	font-size: 10px;
	text-decoration: none;
	background-color: transparent;
	font-weight: bold;
}

a.dark_large:link {
	color: '.$color_dark.';
	font-size: 14px;
	text-decoration: none;
	background-color: transparent;
	font-weight: bold;
}

a.dark_large:visited {
	color: '.$color_dark.';
	font-size: 14px;
	text-decoration: none;
	background-color: transparent;
	font-weight: bold;
} 

a.dark_large:active {
	color: '.$color_dark.';
	font-size: 14px;
	text-decoration: none;
	background-color: transparent;
	font-weight: bold;
} 

a.dark_large:hover {
	color: '.$color_med.';
	font-size: 14px;
	text-decoration: none;
	background-color: transparent;
	font-weight: bold;
}

a.dark_med:link {
	color: '.$color_dark.';
	font-size: 12px;
	text-decoration: none;
	background-color: transparent;
	font-weight: bold;
}

a.dark_med:visited {
	color: '.$color_dark.';
	font-size: 12px;
	text-decoration: none;
	background-color: transparent;
	font-weight: bold;
} 

a.dark_med:active {
	color: '.$color_dark.';
	font-size: 12px;
	text-decoration: none;
	background-color: transparent;
	font-weight: bold;
} 

a.dark_med:hover {
	color: '.$color_med.';
	font-size: 12px;
	text-decoration: none;
	background-color: transparent;
	font-weight: bold;
}

a.dark_small:link {
	color: '.$color_dark.';
	font-size: 10px;
	text-decoration: none;
	background-color: transparent;
	font-weight: bold;
}

a.dark_small:visited {
	color: '.$color_dark.';
	font-size: 10px;
	text-decoration: none;
	background-color: transparent;
	font-weight: bold;
} 

a.dark_small:active {
	color: '.$color_dark.';
	font-size: 10px;
	text-decoration: none;
	background-color: transparent;
	font-weight: bold;
} 

a.dark_small:hover {
	color: '.$color_med.';
	font-size: 10px;
	text-decoration: none;
	background-color: transparent;
	font-weight: bold;
}

a.lite_large:link {
	color: '.$color_lite.';
	font-size: 14px;
	text-decoration: none;
	background-color: transparent;
	font-weight: bold;
}

a.lite_large:visited {
	color: '.$color_lite.';
	font-size: 14px;
	text-decoration: none;
	background-color: transparent;
	font-weight: bold;
} 

a.lite_large:active {
	color: '.$color_lite.';
	font-size: 14px;
	text-decoration: none;
	background-color: transparent;
	font-weight: bold;
} 

a.lite_large:hover {
	color: '.$color_med.';
	font-size: 14px;
	text-decoration: none;
	background-color: transparent;
	font-weight: bold;
}

a.lite_med:link {
	color: '.$color_lite.';
	font-size: 12px;
	text-decoration: none;
	background-color: transparent;
	font-weight: bold;
}

a.lite_med:visited {
	color: '.$color_lite.';
	font-size: 12px;
	text-decoration: none;
	background-color: transparent;
	font-weight: bold;
} 

a.lite_med:active {
	color: '.$color_lite.';
	font-size: 12px;
	text-decoration: none;
	background-color: transparent;
	font-weight: bold;
} 

a.lite_med:hover {
	color: '.$color_med.';
	font-size: 12px;
	text-decoration: none;
	background-color: transparent;
	font-weight: bold;
}

a.lite_small:link {
	color: '.$color_lite.';
	font-size: 10px;
	text-decoration: none;
	background-color: transparent;
	font-weight: bold;
}

a.lite_small:visited {
	color: '.$color_lite.';
	font-size: 10px;
	text-decoration: none;
	background-color: transparent;
	font-weight: bold;
} 

a.lite_small:active {
	color: '.$color_lite.';
	font-size: 10px;
	text-decoration: none;
	background-color: transparent;
	font-weight: bold;
} 

a.lite_small:hover {
	color: '.$color_med.';
	font-size: 10px;
	text-decoration: none;
	background-color: transparent;
	font-weight: bold;
}

img.floatleft { 
    float: left; 
    margin: 0 10px 10px 5px; 
}
img.floatright { 
    float: right; 
    margin: 0 5px 5px 10px; 
}

ul.item {
	margin: 1px;
	padding: 1px;
	background: '.$color_lite.';
}

.item li {
	color: '.$color_dark.';
	font-size: 10px;
	text-decoration: none;
	font-weight: bold;
	padding: 1px;
	list-style-type: none;
}

.button {
	color: '.$color_lite.';
	font-size: 10px;
	text-decoration: none;
	font-weight: bold;
	background-color: '.$color_dark.';
	text-align: center;
	margin: 1px;
	padding: 2px;
	width: 70px;
}

.spacer {
	clear: both;
	height: 0px;
        font-size: 1px;
	height: 98%;
	line-height: 0px;
}

br {
	clear: left;
}

';
?>
