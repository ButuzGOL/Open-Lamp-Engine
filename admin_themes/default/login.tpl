<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" xml:lang="ru">
<head>
<title>{TITLE} - Панель управления</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><link rel="shortcut icon" href="{THEME}/images/siteico.ico" type="image/x-icon" />

<style type="text/css" media="all">
* { margin: 0; padding: 0; }
body {background: #fAfAfA; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;}
img {border:none;}
#conteiner {width: 400px; margin: 7em auto;}
#conteiner .loform {
	padding: 16px 16px 16px 16px;
	font-weight: normal;
	-moz-border-radius: 11px;
	-khtml-border-radius: 11px;
	-webkit-border-radius: 11px;
	border-radius: 5px;
	background: #fff;
	border: 1px solid #e5e5e5;
	-moz-box-shadow: rgba(200,200,200,1) 0 4px 18px;
	-webkit-box-shadow: rgba(200,200,200,1) 0 4px 18px;
	-khtml-box-shadow: rgba(200,200,200,1) 0 4px 18px;
	box-shadow: rgba(200,200,200,1) 0 4px 18px;
}
#conteiner .mess {
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


#conteiner .loform p {color:#808080; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:14px; margin:5px;}
#conteiner .loform input {background:#fafafa; border:1px solid #cccccc; color:#666666; padding:4px; width:98%; font-size:25px; margin-bottom:20px;}
#conteiner .loform input.submit {margin-top:-16px; width:64px; height:64px; border: none; text-align:right; vertical-align:top;}
#conteiner .loform a {color: #bcbcbc; text-decoration: none;}
#conteiner .loform a:hover {color:#d7722f;}

#conteiner .logo {text-align:center; padding-bottom:20px;}
</style>
</head>
<body>
<div id="conteiner">
	<div class="logo">
		<a href="{HURL}">
			<img src="{THEME}/images/logotip.png" alt="Панель управления" title="Панель управления" />
		</a>
	</div>
	{MESS1}
	<div class="loform">
		<form action="{HURL}" method="post">	
			<p>Логин <input type="text" name="name" size="40" /></p>
			<p>
				Пароль<br />
				<input type="password" name="password" size="32" style="width:75%" />
				<input type="image" class="submit" name="action" src="{THEME}/images/login.png" />
			</p>
		</form>	
		<p><a href="index.php">Перейти на сайт</a></p>	
	</div>
</div>
</body>
</html>
