<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" xml:lang="ru">
<head>
<title>{TITLE} - Панель управления</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="shortcut icon" href="{THEME}/images/siteico.ico" type="image/x-icon" />

<link rel="stylesheet" type="text/css" media="all" href="{THEME}/calendar.css" title="win2k-cold-1" />

<script type="text/javascript" src="engine/js/jquery.js"></script>
<script type="text/javascript" src="engine/js/hoverIntent.js"></script>
<script type="text/javascript" src="engine/js/adminmenu.js"></script>

<style type="text/css" media="all">

* { margin: 0; padding: 0; }
body {background: #fAfAfA; margin: 0px; color:#808080; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;}
a img {border: none;}
ol, ul {list-style: none;}

#adminmenu {
	float: left;
	clear: left;
	width: 145px;
	margin-top: 15px;
	margin-right: 5px;
	margin-bottom: 15px;
	margin-left: -160px;
	position: relative;
	padding: 0;
	list-style: none;
}

.folded #adminmenu {
	margin-left: -45px;
}

.folded #adminmenu,
.folded #adminmenu li.menu-top {
	width: 28px;
}

#content {margin: 5px; width:98%;}

#body {
	clear: both;
	margin-left: 175px;
}

.folded #body {
	margin-left: 60px;
}

#body-content {
	float: left;
	width: 100%;
	margin-bottom:10px;
}

#adminmenu a {text-decoration: none;}

#adminmenu * {
	-webkit-user-select: none;
	-moz-user-select: none;
	-khtml-user-select: none;
	user-select: none;
}

#adminmenu .submenu {
	display: none;
	list-style: none;
	padding: 0;
	margin: 0;
	position: relative;
	z-index: 2;
	border-width: 1px 0 0;
	border-style: solid none none;
}

#adminmenu .submenu a {
	font: normal 11px/18px "Lucida Grande", Verdana, Arial, "Bitstream Vera Sans", sans-serif;
}

#adminmenu .submenu li.current,
#adminmenu .submenu li.current a,
#adminmenu .submenu li.current a:hover {
	font-weight: bold;
}

#adminmenu a.menu-top,
#adminmenu .submenu-head {
	font: normal 12px/18px Georgia, "Times New Roman", "Bitstream Charter", Times, serif;
}

#adminmenu div.submenu-head {
	display: none;
}

.folded #adminmenu div.submenu-head,
.folded #adminmenu li.has-submenu div.sub-open {
	display: block;
}

.folded #adminmenu a.menu-top,
.folded #adminmenu .submenu,
.folded #adminmenu li.menu-open .submenu,
.folded #adminmenu div.menu-toggle {
	display: none;
}

#adminmenu li.menu-open .submenu {
	display: block;
}

#adminmenu div.menu-image {
	float: left;
	width: 28px;
	height: 28px;
}

#adminmenu li {
	margin: 0;
	padding: 0;
	cursor: pointer;
}

#adminmenu a {
	display: block;
	line-height: 18px;
	padding: 1px 5px 3px;
}

#adminmenu li.menu-top {
	min-height: 26px;
}

#adminmenu a.menu-top {
	line-height: 18px;
	min-width: 10em;
	padding: 5px 5px;
	border-width: 1px 1px 0;
	border-style: solid solid none;
}

#adminmenu .submenu a {
	margin: 0;
	padding-left: 12px;
	border-width: 0 1px 0 0;
	border-style: none solid none none;
}

#adminmenu .menu-top-last ul.submenu {
	border-width: 0 0 1px;
	border-style: none none solid;
}

#adminmenu .submenu li {
	padding: 0;
	margin: 0;
}

.folded #adminmenu li.menu-top {
	width: 28px;
	height: 30px;
	overflow: hidden;
	border-width: 1px 1px 0;
	border-style: solid solid none;
}

#adminmenu .menu-top-first a.menu-top,
.folded #adminmenu li.menu-top-first,
#adminmenu .submenu .submenu-head {
	border-width: 1px 1px 0;
	border-style: solid solid none;
	-moz-border-radius-topleft :6px;
	-moz-border-radius-topright: 6px;
	-webkit-border-top-right-radius: 6px;
	-webkit-border-top-left-radius: 6px;
	-khtml-border-top-right-radius: 6px;
	-khtml-border-top-left-radius: 6px;
	border-top-right-radius: 6px;
	border-top-left-radius: 6px;
}

#adminmenu .menu-top-last a.menu-top,
.folded #adminmenu li.menu-top-last {
	border-width: 1px;
	border-style: solid;
	-moz-border-radius-bottomleft: 6px;
	-moz-border-radius-bottomright: 6px;
	-webkit-border-bottom-right-radius: 6px;
	-webkit-border-bottom-left-radius: 6px;
	-khtml-border-bottom-right-radius: 6px;
	-khtml-border-bottom-left-radius: 6px;
	border-bottom-right-radius: 6px;
	border-bottom-left-radius: 6px;
}

#adminmenu li.menu-open a.menu-top-last {
	border-bottom: 0 none;
	-moz-border-radius-bottomright: 0;
	-moz-border-radius-bottomleft: 0;
	-webkit-border-bottom-right-radius: 0;
	-webkit-border-bottom-left-radius: 0;
	-khtml-border-bottom-right-radius: 0;
	-khtml-border-bottom-left-radius: 0;
	border-bottom-right-radius: 0;
	border-bottom-left-radius: 0;
}

#adminmenu img.menu-image {
	float: left;
	padding: 8px 6px 0;
	opacity: 0.6;
	filter: alpha(opacity=60);
}

#adminmenu li.menu-top:hover img.menu-image,
#adminmenu li.has-current-submenu img.menu-image {
	opacity: 1;
	filter: alpha(opacity=100);
}

.folded #adminmenu img.menu-image {
	padding: 7px 0 0 6px;
}

#adminmenu li.menu-separator {
	height: 21px;
	padding: 0;
	margin: 0;
	cursor: w-resize;
}

.folded #adminmenu li.menu-separator {
 	cursor: e-resize;
}

#adminmenu .submenu .submenu-head {
	border-width: 1px;
	border-style: solid;
	padding: 6px 4px 6px 10px;
	cursor: default;
}

.folded #adminmenu .submenu {
	position: absolute;
	margin: -1px 0 0 28px;
	padding: 0 8px 8px;
	z-index: 999;
	border: 0 none;
}

.folded #adminmenu .submenu ul {
	width: 140px;
	border-width: 0 0 1px;
	border-style: none none solid;
}

.folded #adminmenu .submenu a {
	padding-left: 10px;
}

.folded #adminmenu a.has-submenu {
	margin-left: 40px;
}

#adminmenu li.menu-top-last .submenu ul {
	border-width: 0 0 1px;
	border-style: none none solid;
}

#adminmenu .menu-toggle {
	width: 22px;
	clear: right;
	float: right;
	margin: 1px 0 0;
	height: 27px;
	padding: 1px 2px 0 0;
	cursor: default;
}

#adminmenu li.has-current-submenu ul {
	border-bottom-width: 1px;
	border-bottom-style: solid;
}


#adminmenu a:hover {
	color: #d7722f;
}

#adminmenu * {
	border-color: #e3e3e3;
}

#adminmenu li.menu-separator {
	background: transparent url({THEME}/images/menu-arrows.png) no-repeat scroll left 5px;
}

.folded #adminmenu li.menu-separator {
	background: transparent url({THEME}/images/menu-arrows.png) no-repeat scroll right -34px;
}

#adminmenu li.has-current-submenu.menu-open .menu-toggle,
#adminmenu li.has-current-submenu:hover .menu-toggle {
	background: transparent url({THEME}/images/menu-bits.png) no-repeat scroll left -207px;
}

#adminmenu .has-submenu:hover .menu-toggle,
#adminmenu .menu-open .menu-toggle {
	background: transparent url({THEME}/images/menu-bits.png) no-repeat scroll left -109px;
}

#adminmenu a.menu-top {
	background: #f8f8f8 url({THEME}/images/menu-bits.png) repeat-x scroll left -379px;
}

#adminmenu .submenu a {
	background: #FFFFFF url({THEME}/images/menu-bits.png) no-repeat scroll 0 -310px;
}

#adminmenu .has-current-submenu ul li a {
	background: none;
}

#adminmenu .has-current-submenu ul li a.current {
	background: url({THEME}/images/menu-dark.png) top left no-repeat !important;
}

#adminmenu li.has-current-submenu a.has-current-submenu,
#adminmenu .menu-top .current {
	background: #6d6d6d url({THEME}/images/menu-bits.png) top left repeat-x;
	border-color: #6d6d6d;
	color: #fff;
	text-shadow: rgba(0,0,0,0.4) 0px -1px 0px;
}

#adminmenu li.has-current-submenu .submenu,
#adminmenu li.has-current-submenu ul li a {
	border-color: #aaa !important;
}

#adminmenu li.has-current-submenu ul li a {
	background: url({THEME}/images/menu-dark.png) bottom left no-repeat !important;
}

#adminmenu li.has-current-submenu ul {
	border-bottom-color: #aaa;
}

#adminmenu .submenu .current a.current {
	background: transparent url({THEME}/images/menu-bits.png) no-repeat scroll  0 -289px;
}

#adminmenu .submenu a:hover {
	color: #d7722f !important;
}

#adminmenu .submenu li.current,
#adminmenu .submenu li.current a,
#adminmenu .submenu li.current a:hover {
	color: #d7722f;
	background-color: #f5f5f5;
	background-image: none;
	border-color: #e3e3e3;
	text-shadow: rgba(255,255,255,1) 0px 1px 0px;
}

#adminmenu .submenu ul {
	background-color: #fff;
}

.folded #adminmenu li.menu-top,
#adminmenu .submenu .submenu-head {
	background-color: #F8F8F8;
}

.folded #adminmenu li.has-current-submenu,
.folded #adminmenu li.menu-top.current {
	background-color: #e6e6e6;
}

#adminmenu .has-current-submenu .submenu .submenu-head {
	background-color: #EAEAEA;
	border-color: #aaa;
}

#adminmenu div.submenu {
	background-color: transparent;
}

#adminmenu #menu-start div.menu-image {
	background: transparent url("{THEME}/images/menu.png") no-repeat scroll -1px -31px;
}

#adminmenu #menu-start:hover div.menu-image,
#adminmenu #menu-start.has-current-submenu div.menu-image {
	background: transparent url("{THEME}/images/menu.png") no-repeat scroll -1px 1px;
}

#adminmenu #menu-news div.menu-image {
	background: transparent url("{THEME}/images/menu.png") no-repeat scroll -34px -31px;
}

#adminmenu #menu-news:hover div.menu-image,
#adminmenu #menu-news.has-current-submenu div.menu-image {
	background: transparent url("{THEME}/images/menu.png") no-repeat scroll -34px 1px;
}

#adminmenu #menu-users div.menu-image {
	background: transparent url("{THEME}/images/menu.png") no-repeat scroll -67px -31px;
}

#adminmenu #menu-users:hover div.menu-image,
#adminmenu #menu-users.has-current-submenu div.menu-image {
	background: transparent url("{THEME}/images/menu.png") no-repeat scroll -67px 1px;
}

#adminmenu #menu-util div.menu-image {
	background: transparent url("{THEME}/images/menu.png") no-repeat scroll -99px -31px;
}

#adminmenu #menu-util:hover div.menu-image,
#adminmenu #menu-util.has-current-submenu div.menu-image {
	background: transparent url("{THEME}/images/menu.png") no-repeat scroll -99px 1px;
}

#adminmenu #menu-settings div.menu-image {
	background: transparent url("{THEME}/images/menu.png") no-repeat scroll -131px -31px;
}

#adminmenu #menu-settings:hover div.menu-image,
#adminmenu #menu-settings.has-current-submenu div.menu-image {
	background: transparent url("{THEME}/images/menu.png") no-repeat scroll -131px 1px;
}

#adminmenu a {
	color: #c1c1c1;
}

#header {height:115px; border-bottom:1px solid #f8f8f8;}
#header .left {float:left; padding-left:15px;}
#header .left {height:117px; width:600px; margin:0 auto; position:relative;}
#header .left h1 {position:absolute; top:35px; left:68px; font-size:30px;}
#header .left h1 a {font-weight:normal; color:#d7722f; text-decoration:none;}
#header .left h2 {position:absolute; top:70px; left:74px; font-size:14px;}
#header .left p {position:absolute; top:15px; left:0px;}
#header .right {float:right; padding-right:10px; padding-top:10px;}
#header .rright {float:right; padding:20px 20px 0 0; color:#808080; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px;}
#header .rright a {text-decoration:none; color:#bcbcbc; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px;}
#header .rright a:hover {color:#d7722f;}

#footer {width:100%; padding:10px 0; color:#bcbcbc; font-size:11px; font-weight:normal; height:15px; margin-bottom:20px; border-bottom:1px solid #efefef; border-top:1px solid #efefef; clear:both;}
#footer .text {float: right; padding-right: 20px; color:#808080;}

#body-content {
	float: left;
	width: 100%;
}
#body-content .mess {
	margin: 15px 0 0 10px;
	padding: 10px;
	font-weight: normal;
	-moz-border-radius: 5px;
	-khtml-border-radius: 5px;
	-webkit-border-radius: 5px;
	border-radius: 5px;
	border: 1px solid;
	-moz-box-shadow: rgba(200,200,200,1) 0 4px 18px;
	-webkit-box-shadow: rgba(200,200,200,1) 0 4px 18px;
	-khtml-box-shadow: rgba(200,200,200,1) 0 4px 18px;
	box-shadow: rgba(200,200,200,1) 0 4px 18px;
	color:#000; 
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
}

.middle0 {margin:10px 0 0px 10px; font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; width:100%; border: none;}
.middle0 h1 {color:#d7722f; font-family:Georgia, "Times New Roman", Times, serif; font-size:30px; padding-top:5px;}
.middle0 h1 img {vertical-align:middle;}
.middle0 .head {
	clear:both; 
	margin: 0px 10px 0px 10px;
	width:90%;
	padding:10px 10px 0 10px;
	-moz-border-radius: 8px;
	-khtml-border-radius: 8px;
	-webkit-border-radius: 8px;
	border-radius: 8px;
	background: #fff;
	border-top: 1px solid #e5e5e5;
	border-left: 1px solid #e5e5e5;
	border-right: 1px solid #e5e5e5;
	height:25px;
	color:#000;
	}
.middle0 .foot {
	clear:both; 
	margin: -10px 10px 10px 10px;
	width:90%;
	padding: 10px 10px 10px 10px;
	-moz-border-radius: 8px;
	-khtml-border-radius: 8px;
	-webkit-border-radius: 8px;
	border-radius: 5px;
	background: #fff;
	border-bottom: 1px solid #e5e5e5;
	border-left: 1px solid #e5e5e5;
	border-right: 1px solid #e5e5e5;
	}
	
.middle0 .middle {clear:both; margin: -6px 10px 0px 10px; width:90%; padding:10px; border-left: 1px solid #e5e5e5; border-right: 1px solid #e5e5e5;}
.middle0 p {padding:0px;}
.middle0 .chb {float:left; padding:0 0 0 5px; width:20px;}
.middle0 .id {float:left; padding:0 5px 0 5px; width:20px;}
.middle0 .oth1 {float:left; padding:0 5px 0 5px; width:70px;}
.middle0 .name {color:#000;}
.middle0 .oth {float:right; padding:0 5px 0 5px; width:80px; text-align:center;}
.middle0 .act {float:right; padding:0 5px 0 5px; width:60px; text-align:center;}

.middle0 .foot input {padding-right:10px;}
.middle0 .foot select {border:none; margin-top:10px; background:#fafafa; width:280px; color:#666666; font-size:10px; }
.middle0 .head select {border:none; margin-top:10px; background:#fafafa; width:280px; color:#666666; font-size:10px; }
.middle0 .foot input.submit {vertical-align:top;}
.middle0 .mess {
	margin: 10px !important;
	width:90%;
	padding: 10px !important;
	font-weight: normal;
	-moz-border-radius: 5px;
	-khtml-border-radius: 5px;
	-webkit-border-radius: 5px;
	border-radius: 5px;
	border: 1px solid;
	-moz-box-shadow: rgba(200,200,200,1) 0 4px 18px;
	-webkit-box-shadow: rgba(200,200,200,1) 0 4px 18px;
	-khtml-box-shadow: rgba(200,200,200,1) 0 4px 18px;
	box-shadow: rgba(200,200,200,1) 0 4px 18px;
	color:#000;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
}
.middle0 .nothing {clear:both; margin: -6px 10px 0px 10px; width:90%; padding:10px; border-left: 1px solid #e5e5e5; border-right: 1px solid #e5e5e5; text-align:center;}
.middle0 .forma {width:60%;}
.middle0 .forma .form {
	margin: 0 10px;
	width:100%;
	padding:10px;
	-moz-border-radius: 8px;
	-khtml-border-radius: 8px;
	-webkit-border-radius: 8px;
	border-radius: 8px;
	background: #fff;
	border: 1px solid #e5e5e5;
	}
.middle0 .conim {margin: -6px 10px 0px 10px; height:220px; width:90%; padding:10px; border-left: 1px solid #e5e5e5; border-right: 1px solid #e5e5e5; text-align:center;}	
.middle0 .conim .wheim {float:left; padding-left:5px; width:16%;}
.middle0 .conim .image {
	margin: 10px;
	padding:10px;
	height: 180px;
	width: 110px;
	-moz-border-radius: 8px;
	-khtml-border-radius: 8px;
	-webkit-border-radius: 8px;
	border-radius: 8px;
	background: #fff;
	border: 1px solid #e5e5e5;
	}
.middle0 .conim .image .text {text-align:left; font-size:10px;}
	
.middle0 .forma .form .uava {position:absolute; padding-top:10px; margin-left:530px; width:100px;}
.middle0 .forma .form .uava1 {position:absolute; margin-left:530px; width:64px;}
.middle0 .forma .form .shab {text-decoration:none; color:#bcbcbc;}
.middle0 .forma .form .shab:hover {text-decoration:none; color:#d7722f;}
.middle0 .forma .form .shab1 {text-decoration:none; color:#d7722f;}
.middle0 .forma .form b {color:#000;}
.middle0 .forma .form .polya1 {font-size:11px; padding: 10px; height: 10px;}
.middle0 .forma .form .polya1 .pleft {float:left; width:150px;}
.middle0 .forma .form .polya1 .pright {padding-left:150px;}
.middle0 .forma .form .polya {font-size:11px; padding: 10px;}
.middle0 .forma .form .polya .pleft {float:left; width:270px;}
.middle0 .forma .form .polya .pright {padding-left:250px;}
.middle0 .forma .form .polya .small {font-size:10px;}
.middle0 .forma .form .polya .smallta {margin-left:5px; background:#fafafa; border:1px solid #cccccc; color:#666666; padding:3px; width:292px; height:70px; font-size:11px;}
.middle0 .forma .form textarea {background:#fafafa; margin-bottom:5px; border:1px solid #cccccc; color:#666666; padding:3px; width:600px; font-size:11px;}
.middle0 .forma .form input {margin-left:5px; background:#fafafa; border:1px solid #cccccc; color:#666666; padding:1px; width:295px; font-size:10px;}
.middle0 .forma .form input.check {width:14px; border:none;}
.middle0 .forma .form select { width:300px; margin-left:5px; background:#fafafa; border:1px solid #cccccc; color:#666666; padding:0px; font-size:10px;}
.middle0 .forma .form input.submit {vertical-align:top; border:none; width:32px; height:32px; padding-left:20px;}
.middle0 .forma .form .menu {width:100%; text-align: left; letter-spacing: 30px; padding-bottom:15px; cursor:pointer;}
.middle0 .forma .form .bbcodes {margin: -5px; cursor:pointer;}
.middle0 .forma .form .bbcodes .fonts {float:left; margin: 0 0 5px 0;}
.middle0 .forma .form .bbcodes .size {float:left; margin: 0 0 1px 5px;}
.middle0 .forma .form .bbcodes .butt1 {float:left; margin: 0px 0 1px 5px;}
.middle0 .back {float:right; padding: 100px 200px 0 0;}
.middle0 .forma .mess {
	margin: 10px;
	width:100%;
	margin-bottom: 10px;
	padding: 10px;
	font-weight: normal;
	-moz-border-radius: 5px;
	-khtml-border-radius: 5px;
	-webkit-border-radius: 5px;
	border-radius: 5px;
	border: 1px solid;
	-moz-box-shadow: rgba(200,200,200,1) 0 4px 18px;
	-webkit-box-shadow: rgba(200,200,200,1) 0 4px 18px;
	-khtml-box-shadow: rgba(200,200,200,1) 0 4px 18px;
	box-shadow: rgba(200,200,200,1) 0 4px 18px;
	color:#000; 
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
}
.middle1 {width:95%;}
.middle1 .startl {padding-right:480px; border: none;}
.middle1 .startr {float:right; padding-right: 20px; width:400px;}
.middle1 .startr .img {position:absolute; padding-top:10px; margin-left:250px; width:128px;}
.middle1 h1 {padding-left:5px; color:#d7722f; font-family:Georgia, "Times New Roman", Times, serif; font-size:25px; padding-top:5px;}
.middle1 h1 img {vertical-align:middle;}
.middle1 .lcon {
	margin: 0 10px;
	padding:10px;
	-moz-border-radius: 8px;
	-khtml-border-radius: 8px;
	-webkit-border-radius: 8px;
	border-radius: 8px;
	background: #fff;
	border: 1px solid #e5e5e5;
}
.middle1 .rcon {
	margin: 0 10px;
	width:400px;
	padding:10px;
	-moz-border-radius: 8px;
	-khtml-border-radius: 8px;
	-webkit-border-radius: 8px;
	border-radius: 8px;
	background: #fff;
	border: 1px solid #e5e5e5;
}
.middle1 .startl .lcon textarea {background:#fafafa; margin:5px; border:1px solid #cccccc; color:#666666; padding:3px; width:96%; font-size:11px;}
.middle1 .startr .rcon .info {padding:0 10px 0 20px;}
.middle1 .startr .rcon .info .proo {font-size:11px; height:20px;}
.middle1 .startr .rcon .info .zproo {font-size:13px; height:20px; font-weight:bold;}
</style>
<!--[if gte IE 6]>
<style type="text/css" media="all">

* html div.folded #adminmenu {
	margin-left: -22px;
}

* html #content #adminmenu li.menu-top {
	display: inline;
	padding: 0;
	margin: 0;
}

#content.folded #adminmenu li.menu-top {
	display: block;
}

ul#adminmenu {
	z-index: 99;
}

#adminmenu li.menu-top a.menu-top {
	min-width: auto;
	width: auto;
}

#content #adminmenu li.has-current-submenu a.has-submenu {
	font-style: normal;
}

* html #content #adminmenu .menu-open .menu-toggle {
	background: none;
}

* html #content #adminmenu .has-submenu .menu-toggle {
	background: url(../images/menu-bits.png) no-repeat scroll left -109px;
}

* html #content #adminmenu li.has-current-submenu .menu-toggle {
	background: url(../images/menu-bits.gif) no-repeat scroll left -206px;
}

* html #adminmenu div.menu-image {
	height: 29px;
}

#content #adminmenu .submenu li {
	padding: 0;
}

#content.folded #adminmenu li.menu-separator {
	width: 28px;
}

#content #adminmenu .submenu li.submenu-head {
	padding: 3px 4px 4px 10px;
	zoom: 100%;
}

#content.folded #adminmenu .menu-top {
	height: 30px;
}

.folded #adminmenu .submenu {
	margin: -1px 0 0 0;
}
</style>
<![endif]-->
</head>
<body>
<div id="header">
	<div class="left">
		<p><a href="{HURL}"><img src="{THEME}/images/logotip.png" alt="{TITLE}" title="{TITLE}" /></a></p>
		<h1><a href="{HURL}">{TITLE} - <span style="font-size:18px;">Панель управления</span></a></h1>
		<h2>{HDESCR}</h2>
	</div>

	<div class="rright">
		Вы вошли как: {USER} <br />
		Группа: {UGROUP} <br /><br />
		<img src="{THEME}/images/header_enter.png" style="padding-right:5px;" alt="" title="" /><a href="index.php" onclick="this.target='target'">Просмотр сайта</a><br />	
		<img src="{THEME}/images/header_enter.png" style="padding-right:5px;" alt="" title="" /><a href="?m=profile">Мои профиль</a><br />			
		<img src="{THEME}/images/header_enter.png" style="padding-right:5px;" alt="" title="" /><a href="?logout">Завершить сеанс</a>
	</div>
	
	<div class="right"><img src="{AVATAR}" alt="{USER}" title="{USER}" /></div>
</div>

<div id="content">
	<div id="body">

<ul id="adminmenu">

	<li class="menu-top menu-top-first menu-top-last" id="menu-start">
		<div class="menu-image"><br /></div>
		<div class="menu-toggle"><br /></div>
		<a href="{HURL}" id="menu-start0" class="menu-top menu-top-first menu-top-last">Главная</a>
	</li>
	
	<li class="menu-separator"><br /></li>
	
	<li class="has-submenu menu-top menu-top-first" id="menu-news">
		<div class="menu-image"><br /></div>
		<div class="menu-toggle" id="menu-news1"><br /></div>
		<a href="?m=news" id="menu-news0" class="has-submenu menu-top menu-top-first">Публикация</a>
		<div class="submenu"><div class="submenu-head">Публикация</div>
			<ul>
				<li id="news"><a href="?m=news" id="news0">Новости</a></li>
				<li id="newsadd"><a href="?m=news&amp;a=add" id="newsadd0">Добавить новость</a></li>
				<li id="statik"><a href="?m=statik" id="statik0">Стат. страницы</a></li>
				<li id="vote"><a href="?m=vote" id="vote0">Опросы</a></li>
				<li id="images"><a href="?m=images" id="images0">Картинки</a></li>
				<li id="categories"><a href="?m=categories" id="categories0">Категории</a></li>
			</ul>
		</div></li>
		
	<li class="has-submenu menu-top" id="menu-users">
		<div class="menu-image"><br /></div>
		<div class="menu-toggle" id="menu-users1"><br /></div>
		<a href="?m=users" id="menu-users0" class="has-submenu menu-top menu-top-first">Пользователи</a>
		<div class="submenu"><div class="submenu-head">Пользователи</div>
			<ul>
				<li id="users"><a href="?m=users" id="users0">Пользователи</a></li>
				<li id="usersgroup"><a href="?m=usersgroup" id="usersgroup0">Группы пользователей</a></li>
				<li id="profile"><a href="?m=profile" id="profile0">Мой профиль</a></li>
			</ul>
		</div>
	</li>
	
	<li class="has-submenu menu-top" id="menu-util">
		<div class="menu-image"><br /></div>
		<div class="menu-toggle" id="menu-util1"><br /></div>
		<a href="?m=bannedip" id="menu-util0" class="has-submenu menu-top">Утилиты</a>
		<div class="submenu"><div class="submenu-head">Утилиты</div>
			<ul>
				<li id="bannedip"><a href="?m=bannedip" id="bannedip0">Блокировка IP</a></li>
				<li id="wfilter"><a href="?m=wfilter" id="wfilter0">Фильтр слов</a></li>
				<li id="wsearch"><a href="?m=wsearch" id="wsearch0">Поиск и замена</a></li>
			</ul>
		</div>
	</li>
	
	<li class="has-submenu menu-top menu-top-last" id="menu-settings">
		<div class="menu-image"><br /></div>
		<div class="menu-toggle" id="menu-settings1"><br /></div>
		<a href="?m=settings" id="menu-settings0" class="has-submenu menu-top menu-top-last">Настройки</a>
		<div class="submenu"><div class="submenu-head">Настройки</div>
			<ul>
				<li id="settings"><a href="?m=settings" id="settings0">Настройки</a></li>
				<li id="db"><a href="?m=db" id="db0">База данных</a></li>
				<li id="banners"><a href="?m=banners" id="banners0">Баннера</a></li>
				<li id="blocks"><a href="?m=blocks" id="blocks0">Блоки</a></li>
				<li id="theme"><a href="?m=theme" id="theme0">Тема</a></li>
				<li id="email"><a href="?m=email" id="email0">Шаблоны Email</a></li>
			</ul>
		</div>
	</li>
	
	<li class="menu-separator"><br /></li>
		
</ul>
	<div id="body-content">
		{MESS1}
