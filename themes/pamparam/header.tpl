<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" xml:lang="ru">
<head>
<title>{TITLE}</title>
<meta http-equiv="Content-Type" content="text/html; charset={CHARSET}" />
<meta name="description" content="{DESCR}" />
<meta name="keywords" content="{KEYWORDS}" />
<meta name="generator" content="CMS" />
<meta name="robots" content="all" />
<meta name="revisit" content="1 days" />
<meta name="author" content="{AUTOR}" />
<link rel="shortcut icon" href="{THEME}/images/siteico.ico" type="image/x-icon" />
<script type="text/javascript" src="engine/js/ajax.js"></script>
<style type="text/css" media="all">
.rating {
		color: #666666;
		font-family: Tahoma, helvetica, sans-serif;
		font-size: 11px;
		width: 85px;
		height: 16px;
	}
	.unit-rating{
		list-style:none;
		margin: 0px;
		padding:0px;
		width: 85px;
		height: 16px;
		position: relative;
		background: url('{THEME}/images/rating.png') top left repeat-x;
	}

	.unit-rating li{
	    text-indent: -90000px;
		padding:0px;
		margin:0px;
		float: left;
	}
	.unit-rating li a{
		display:block;
		width:17px;
		height: 16px;
		text-decoration: none;
		text-indent: -9000px;
		z-index: 17;
		position: absolute;
		padding: 0px;
	}
	.unit-rating li a:hover{
		background: url('{THEME}/images/rating.png') left center;
		z-index: 2;
		left: 0px;
	}
	.unit-rating a.r1-unit{left: 0px;}
	.unit-rating a.r1-unit:hover{width:17px;}
	.unit-rating a.r2-unit{left:17px;}
	.unit-rating a.r2-unit:hover{width: 34px;}
	.unit-rating a.r3-unit{left: 34px;}
	.unit-rating a.r3-unit:hover{width: 51px;}
	.unit-rating a.r4-unit{left: 51px;}
	.unit-rating a.r4-unit:hover{width: 68px;}
	.unit-rating a.r5-unit{left: 68px;}
	.unit-rating a.r5-unit:hover{width: 85px;}
	.unit-rating li.current-rating{
		background: url('{THEME}/images/rating.png') left bottom;
		position: absolute;
		height: 16px;
		display: block;
		text-indent: -9000px;
		z-index: 1;
}
* {margin:0; padding:0;}
body { background:#FFFFFF; color:#808080; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; margin:0; padding:0; margin:0; padding:0;}
a {color:#d7722f; text-decoration:none;}
a img {border: none;}

#menu_wrap { background:url({THEME}/images/topmenu.png) repeat-x; height:38px; width:100%;}
#menu {width:1000px; margin:0 auto;}
#menu ul { list-style-type:none;}
#menu li { float:left; text-align:center; width:80px; height:28px; padding:10px 5px 0 5px;}
#menu li:hover { background:url({THEME}/images/topmenu_hover.png);}
#menu li:hover a {color:#FFFFFF;}

#header_wrap { width:100%; height:117px; border-bottom:1px solid #e1e1e1;}
#header { height:117px; width:1000px; margin:0 auto; position:relative;}
#header h1 {position:absolute; top:25px; left:68px;  font-size:30px;}
#header h1 a {font-weight:normal;}
#header h2 {position:absolute; top:61px; left:140px; font-size:14px;}
#header h3 {position:absolute; top:20px; left:600px; font-size:14px; letter-spacing:5px}
#header p {position:absolute; top:5px;}

#footer {width:100%; padding:10px 0; font-size:11px; font-weight:normal; height:15px; margin-bottom:20px; border-bottom:1px solid #e1e1e1; border-top:1px solid #e1e1e1; background:#FFFFFF;}
#footer .footerl {float: left; padding-left: 20px; color:#e1e1e1;}
#footer .footerr {float: right; padding-right: 20px;}
#footer .footerl a:hover {text-decoration: underline;}

.post {margin:10px 0 0px 10px; font-size:12px; text-align:left;}
.post h3 { font-weight:normal; color:#333333; font-family:Georgia, "Times New Roman", Times, serif; font-size:24px;}
.post .meta { padding:7px 0; font-size:11px; clear:both;}
.post .meta p {float:left; padding:0 0 0 15px; background:no-repeat left center;}
.post .meta .date { background-image:url({THEME}/images/news_date.png); margin:0 40px 0 3px;}
.post .meta .categories {float:right; padding:0 10px 0 0;}
.post .meta .comments { background-image:url({THEME}/images/news_comments.png);}
.post .meta .categories a:hover {text-decoration: underline;}
.post .meta .comments a:hover {text-decoration: underline;}
.post .meta .autor a:hover {text-decoration: underline;}
.post .meta .rate { margin:0 0 0 20px;}
.post .meta .autor { float:right; padding:0 30px 0 13px; background-image:url({THEME}/images/news_autor.png);}
.post .meta .nread { float:right; padding:0 10px 0 13px; background-image:url({THEME}/images/news_nread.png);}
.post .meta .bookm { float:right; padding:0 10px 0 13px;}
.post .text {padding:15px; line-height:17px;}
.post .text a {color:#d7722f;}
.post .text a:hover {text-decoration:underline;}

.block {font-size:11px; padding: 0px 10px 10px 10px; width:200px; margin:10px auto;}
.block div {padding:0px;}
.block a {color: #bcbcbc;}
.block a:hover {color:#d7722f;}
.block h4 {text-transform:uppercase; border-bottom: 1px dotted #bcbcbc; color:#d7722f; font-size:11px; font-weight:normal; padding:10px 0px 0px 0px; margin-bottom:10px;}

.showmess {margin:10px 0 20px 10px; font-size:11px; text-align:left;}
.showmess h3 {font-weight:normal; color:#333333; font-family:Georgia, "Times New Roman", Times, serif; font-size:22px;}
.showmess p {padding-top:10px; width:100%; text-align:center;}
.showmess a:hover {text-decoration: underline;}

.dmiddle { margin:10px 0 20px 10px; font-size:11px; text-align:left;}
.dmiddle h3 { font-weight:normal; color:#333333; font-family:Georgia, "Times New Roman", Times, serif; font-size:22px;}
.dmiddle div { padding: 3px; }
.dmiddle a:hover{text-decoration: underline;}

#mid1 {width:250px; margin-left: 5px; float:left;}
#mid2 {min-width:350px; margin-left:250px}

#commentform {margin:10px; text-align:left;}
#commentform input {background:#fafafa; border:1px solid #cccccc; color:#666666; padding:4px; width:200px;}
#commentform input.submit {vertical-align:top; border:none; width:32px; height:32px; padding-left:20px;}
#commentform textarea {background:#fafafa; border:1px solid #cccccc; color:#666666; padding:5px; width:98%; height:135px; font-size:18px;}
#commentform .captcha {margin-top:10px;}
#commentform .captcha input {height:37px; vertical-align:top; padding:5px; font-size: 30px; width:100px; border:1px solid #cccccc;}
#commentform .polya {margin:10px 0 10px 0; font-size:19px;}

.comment {padding: 10px; margin:10px 10px 20px 15px; font-size:12px; border:1px solid #cccccc; text-align:left;
	-moz-border-radius: 5px;
	-khtml-border-radius: 5px;
	-webkit-border-radius: 5px;
	border-radius: 5px;
	border: 1px solid #e1e1e1;
	-moz-box-shadow: rgba(200,200,200,1) 0 4px 18px;
	-webkit-box-shadow: rgba(200,200,200,1) 0 4px 18px;
	-khtml-box-shadow: rgba(200,200,200,1) 0 4px 18px;
	box-shadow: rgba(200,200,200,1) 0 4px 18px;
}
.comment h3 {font-weight:normal; color:#333333; font-family:Georgia, "Times New Roman", Times, serif; font-size:18px;}
.comment .meta {padding:7px 0; font-size:11px;}
.comment .text {min-height:105px; padding:7px 0; font-size:11px; line-height:17px;}
.comment .meta .autor a:hover {text-decoration: underline;}
.comment .meta p {float:left; padding:0 0 0 15px; background:no-repeat left center;}
.comment .meta .group {float:right; padding:0 5px 0 2px;}
.comment .meta .autor {float:right; padding:0 5px 0 13px; background-image:url({THEME}/images/comments_autor.png);}
.comment .meta .email {float:right; padding:0 10px 0 13px; background-image:url({THEME}/images/comments_email.png);}
.comment .meta .icq {float:right; padding:0 10px 0 13px; background-image:url({THEME}/images/comments_icq.png);}
.comment .meta .ip {float:right; padding:0 10px 0 13px; background-image:url({THEME}/images/comments_ip.png);}
.comment .text .ava {float: left; padding:0 10px 10px 10px;}
.comment .text .comm {padding:0 10px 0 110px;}

#lostpass {margin:10px;}
#lostpass input {background:#fafafa; border:1px solid #cccccc; color:#666666; padding:4px; width:200px;}
#lostpass input.submit {vertical-align:top; border:none; width:32px; height:32px; padding-left:20px;}
#lostpass .captcha {margin-top:10px;}
#lostpass .captcha input {height:37px; vertical-align:top; padding:5px; font-size: 30px; width:100px; border:1px solid #cccccc;}
#lostpass .polya {margin:10px 0 10px 0; font-size:19px;}
.lpemmes {width:100%; text-align:left; padding-left:10px;}

#registr {margin:10px;}
#registr input {background:#fafafa; border:1px solid #cccccc; color:#666666; padding:4px; width:200px;}
#registr input.submit {vertical-align:top; border:none; width:32px; height:32px; padding-left:20px;}
#registr .captcha {margin-top:10px;}
#registr .captcha input {height:37px; vertical-align:top; padding:5px; font-size: 30px; width:100px; border:1px solid #cccccc;}
#registr .polya {margin:10px 0 10px 0; font-size:19px;}

.mess {width:100%; text-align:center; color:#AC4646; font-size:15px;}

.news {margin:10px 0 0px 0px; font-size:10px; width:97%; height:15px;}
.news p {float:left; padding:0px;}
.news .title {float:left; padding:0; width:320px;}
.news .autor {float:left; padding:0 0 0 5px; width:70px;}
.news .date {float:left; padding:0 0 0 5px; width:50px;}
.news .view {float:left; padding:0 0 0 5px; width:68px;}
.news .comm {padding:0 0 0 5px;}
.news .autor a:hover {text-decoration: underline;}
.news .title a:hover {text-decoration: underline;}
.news .de a:hover {text-decoration: underline;}

.pages {width:100%; letter-spacing:3px; text-align:center; font-size:14px; padding:5px; clear:both;}
.pages a {font-size:18px;}
.pages a:hover {text-decoration: underline;}
.pages .sp {font-size:30px;}

#pmform {margin:10px;}
#pmform input {background:#fafafa; border:1px solid #cccccc; color:#666666; padding:4px; width:200px;}
#pmform input.submit {vertical-align:top; border:none; width:32px; height:32px; padding-left:20px;}
#pmform input.check {width:14px; height:14px; border: none; color:#666666; padding:0px;}
#pmform textarea {background:#fafafa; border:1px solid #cccccc; color:#666666; padding:5px; width:90%; height:135px; font-size:18px;}
#pmform select {background:#fafafa; border:1px solid #cccccc; color:#666666; padding:4px; width:200px;}
#pmform .polya {margin:10px 0 10px 0; font-size:19px;}

.pm {margin:10px 0 10px 10px; font-size:10px; width:100%; height:15px;}
.pm p {float:left; padding:0 0 0 15px; background:no-repeat left center;}
.pm .title {float:left; padding:0; width:300px;}
.pm .autor {float:left; padding:0 0 0 5px; width:120px;}
.pm .date {float:left; padding:0 0 0 5px; width:50px;}
.pm .autor a:hover {text-decoration: underline;}
.pm .title a:hover {text-decoration: underline;}
.pm .de a:hover {text-decoration: underline;}
.pm .title .notread {border-top: 1px solid #d7722f;}
.pm .mess {width:100%; text-align:center; color:#AC4646; font-size:15px;}
.pm .menu {width:100%; text-align:center; color:#666666; font-size:11px; padding-bottom:10px;}

.pmshow {padding: 5px; margin:10px;}
.pmshow .polya {margin:10px 0 10px 0; font-size:12px;}
.pmshow .polya .lt {float: left;}
.pmshow .polya .rt {padding-left:150px;}

.profile {padding: 10px; margin:0px 0px 20px 10px; font-size:15px;}
.profile .text {min-height:80px; padding:7px 0; font-size:11px;}
.profile .text .ava {float: left; padding:80px 10px 10px 10px;}
.profile .text .pro {padding:0 10px 0 150px;}
.profile .text .pro .proo {font-size:11px; height:20px;}
.profile .menu {width:100%; text-align: center; letter-spacing: 30px; cursor:pointer;}
.profileform {margin:10px;}
.profileform input {background:#fafafa; border:1px solid #cccccc; color:#666666; padding:4px; width:200px;}
.profileform input.submit {vertical-align:top; border:none; width:32px; height:32px; padding-left:20px;}
.profileform textarea {background:#fafafa; border:1px solid #cccccc; color:#666666; padding:5px; width:90%; height:135px; font-size:18px;}
.profileform input {background:#fafafa; border:1px solid #cccccc; color:#666666; padding:4px; width:200px;}
.profileform input.check {width:14px; height:14px; border: none; color:#666666; padding:0px;}
.profileform select {background:#fafafa; border:1px solid #cccccc; color:#666666; padding:4px; width:200px;}
.profileform .polya {margin:10px 0 10px 0; font-size:19px;}
.profileform .polya .small {font-size:12px;}

.search {padding: 5px; margin:5px; font-size:12px;}
.search h3 {font-size:19px; color:#666666;}
.search .soder {float: left; padding:0;}
.search .autor {padding:0 10px 0 360px;}
.search .butto {margin:12px 0 0 0;}
.searchform {margin:0px;}
.searchform input {font-size:10px; background:#fafafa; border:1px solid #cccccc; color:#666666; padding:4px; width:250px;}
.searchform input.submit {vertical-align:top; border:none; width:32px; height:32px; padding-left:20px;}
.searchform select {background:#fafafa; border:1px solid #cccccc; color:#666666; padding:4px; width:250px; font-size:10px;}
.searchform .polya {margin:10px 0 10px 0; font-size:10px;}

.statik {margin:10px 0 0px 0px; font-size:10px; width:97%; height:15px;}
.statik p {float:left; padding:0 0 0 10px;}
.statik .title {float:left; padding:0; width:350px;}
.statik .autor {float:left; padding:0 0 0 5px; width:70px;}
.statik .date {float:left; padding:0 0 0 5px; width:50px;}
.statik .view {float:left; padding:0 0 0 5px; width:80px;}
.statik .autor a:hover {text-decoration: underline;}
.statik .title a:hover {text-decoration: underline;}
.statik .de a:hover {text-decoration: underline;}

.stat {margin:10px 0 20px 10px; font-size:12px; text-align:left;}
.stat h3 { font-weight:normal; color:#333333; font-family:Georgia, "Times New Roman", Times, serif; font-size:24px;}
.stat .meta { padding:7px 0; font-size:11px;}
.stat .meta .autor a:hover{text-decoration: underline;}
.stat .meta p {float:left; padding:0 0 0 15px; background:no-repeat left center;}
.stat .meta .date { background-image:url({THEME}/images/statik_date.png); margin:0 40px 0 3px;}
.stat .meta .comments { background-image:url({THEME}/images/statik_comment.png);}
.stat .meta .autor { float:right; padding:0 30px 0 13px; background-image:url({THEME}/images/statik_author.png);}
.stat .meta .nread { float:right; padding:0 10px 0 13px; background-image:url({THEME}/images/statik_tag.png);}
.stat .text {padding:25px 20px 5px 5px; line-height:17px;}

.statistik {padding: 0px; margin:0px 0px 0px 0px; font-size:15px;}
.statistik .text {min-height:80px; padding:7px 0; font-size:11px;}
.statistik .text .img {float: left; padding:10px;}
.statistik .text .info {padding:0 10px 0 180px;}
.statistik .text .info .proo {font-size:11px; height:20px;}
.statistik .text .info .zproo {font-size:13px; height:20px; font-weight:bold;}

#statikform {margin:10px;}
#statikform input {background:#fafafa; border:1px solid #cccccc; color:#666666; padding:1px; width:300px; font-size:10px;}
#statikform input.submit {vertical-align:top; border:none; width:32px; height:32px; padding-left:20px;}
#statikform input.check {width:14px; height:14px; border:none;}
#statikform textarea {background:#fafafa; margin-bottom:5px; border:1px solid #cccccc; color:#666666; padding:3px; width:95%; font-size:11px;}
#statikform .polya .smallta {background:#fafafa; margin:0px; border:1px solid #cccccc; color:#666666; padding:3px; width:300px; height:70px; font-size:10px;}
#statikform select {background:#fafafa; border:1px solid #cccccc; color:#666666; padding:0px; width:300px; font-size:10px;}
#statikform .captcha {margin-top:10px;}
#statikform .captcha input {height:37px; vertical-align:top; font-size: 30px; padding:5px; width:100px; border:1px solid #cccccc;}
#statikform .bbcodes {margin: 0px; cursor:pointer;}
#statikform .bbcodes .fonts {float:left; margin: 0 0 5px 0;}
#statikform .bbcodes .size {float:left; margin: 0 0 1px 5px;}
#statikform .bbcodes .butt1 {float:left; margin: 0 0 1px 5px;}
#statikform .polya {font-size:11px;}
#statikform .polya .pleft {float:left; padding-left: 5px;}
#statikform .polya .pright {padding-left:240px;}
#statikform .polya .small {font-size:10px;}

#newsform {margin:10px;}
#newsform input {background:#fafafa; border:1px solid #cccccc; color:#666666; padding:1px; width:304px; font-size:10px;}
#newsform input.submit {vertical-align:top; border:none; width:32px; height:32px; padding-left:20px;}
#newsform input.check {width:14px; height:14px; border:none;}
#newsform textarea {background:#fafafa; margin-bottom:5px; border:1px solid #cccccc; color:#666666; padding:3px; width:95%; font-size:11px;}
#newsform .polya .smallta {background:#fafafa; margin:0px; border:1px solid #cccccc; color:#666666; padding:3px; width:300px; height:70px; font-size:10px;}
#newsform select {background:#fafafa; border:1px solid #cccccc; color:#666666; padding:0px; width:300px; font-size:10px;}
#newsform .captcha {margin-top:10px;}
#newsform .captcha input {height:37px; vertical-align:top; font-size: 30px; padding:5px; width:100px; border:1px solid #cccccc;}
#newsform .bbcodes {margin: 0px; cursor:pointer;}
#newsform .bbcodes .fonts {float:left; margin: 0 0 5px 0;}
#newsform .bbcodes .size {float:left; margin: 0 0 1px 5px;}
#newsform .bbcodes .butt1 {float:left; margin: 0 0 1px 5px;}
#newsform .polya {font-size:11px;}
#newsform .polya .pleft {float:left; padding-left: 5px;}
#newsform .polya .pright {padding-left:240px;}
#newsform .polya .small {font-size:10px;}
#newsform .menu {width:100%; height:100%; text-align: left; letter-spacing: 30px; padding-bottom:15px; cursor:pointer;}

#news_vote {margin:0px 10px 0px 10px; width:30%;}
#news_vote1 {width:100%;}
#news_vote1 h3 {margin-bottom:7px; font-weight:normal; color:#333333; font-family:Georgia, "Times New Roman", Times, serif; font-size:18px; text-align:center;}
#news_vote1 .votes { margin-bottom:7px;}
#news_vote1 .buttons {text-align:center;}
#news_vote1 input.submit {margin-top:10px; border:1px solid #cccccc; background:#FFFFFF; width:80px; background:#fafafa; color:#666666; padding:2px; font-size:10px;}

#mconteiner {width:98%; margin: auto;}
#mconteiner .blo{vertical-align: top; background:url({THEME}/images/block.png) repeat-y;}
</style>
</head>
<body>

<div id="menu_wrap">
	<div id="menu">
  		<ul>
   			<li><a href="index.php" title="Главная">Главная</a></li>
   			<li><a href="index.php?m=registr" title="Регистрация">Регистрация</a></li>
   			<li><a href="index.php?m=statistik" title="Статистика">Статистика</a></li>
   			<li><a href="index.php?m=news&id=12" title="Про OLE">Про OLE</a></li>
  		</ul>
 	</div>
</div>

<div id="header_wrap">
	<div id="header">
  		<p><a href="{HURL}"><img src="{THEME}/images/logotip.png" alt="{HTITLE}" title="{HTITLE}" /></a></p>
  		<h2>{HDESCR}</h2>
  		<h3>
  			<a href="{HURL}/uploads/files/ole_1.0.zip" title="Скачать Open Lamp Engine"><img src="{THEME}/images/downloadole.png" alt="Скачать Open Lamp Engine" title="Скачать Open Lamp Engine" /></a>
  			<a href="http://mywordpress.ru/wp-content/plugins/download-monitor/download.php?id=2" title="Скачать WordPress"><img src="{THEME}/images/downloadwordpress.png" alt="Скачать WordPress" title="Скачать WordPress"/></a>
  			<a href="http://joomlaportal.ru/downloads/joomla/Joomla_1.5.9-Stable-Full_Package-Russian.zip" title="Скачать Joomla"><img src="{THEME}/images/downloadjoomla.png" alt="Скачать Joomla" title="Скачать Joomla"/></a>
  		</h3>
 	</div>
</div>

<div id="mconteiner">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
	        <td class="blo">
                {TOP_BLOCKS}
