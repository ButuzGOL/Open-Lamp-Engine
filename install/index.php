<?php

/*
//=============================================================================/
// Open Lamp Engine version 1.0
//-----------------------------------------------------------------------------/
// Web-site: http://www.pamparam.net/ email: openlampengine@gmail.com
//-----------------------------------------------------------------------------/
// Author: r0n9.GOL email: ron9.gol@gmail.com
//-----------------------------------------------------------------------------/
// Copyright by r0n9.GOL © 2009
//=============================================================================/
// Данный код защищен авторскими правами :)
//=============================================================================/
// Файл: index.php
//-----------------------------------------------------------------------------/
// Назначение: Установка
//=============================================================================/
*/
//326306983 - Stas
//hidden_stas@bofh.od.ua
	include("tpl.class.php");

	$o_tpl = new tpl("header.tpl", "footer.tpl", "Установка Open Lamp Engine");

	$STEP = $_POST['step'];
		
	if (file_exists("../engine/config/config.php")) {
		$o_tpl->header = "";
		$o_tpl->footer = "";
		$o_tpl->addhtml("messcs.tpl");
	}
	elseif (!$STEP) $o_tpl->addhtml("1.tpl");
	elseif ($STEP==1) {
	
		$rules["{PHP}"]   = phpversion() > "4" 				 ? "<img src=\"yes.png\" alt=\"Да\" title=\"Да\" />" : "<img src=\"no.png\" alt=\"Нет\" title=\"Нет\" />";
		$rules["{MYSQL}"] = function_exists("mysql_connect") ? "<img src=\"yes.png\" alt=\"Да\" title=\"Да\" />" : "<img src=\"no.png\" alt=\"Нет\" title=\"Нет\" />";
		$rules["{XML}"]   = extension_loaded("xml") 		 ? "<img src=\"yes.png\" alt=\"Да\" title=\"Да\" />" : "<img src=\"no.png\" alt=\"Нет\" title=\"Нет\" />";
		
		$rules["{AVATARS}"]  = (is_writable("../uploads/avatars/"))   ? "<img src=\"yes.png\" alt=\"Да\" title=\"Да\" />" : "<img src=\"no.png\" alt=\"Нет\" title=\"Нет\" />";
		$rules["{IMAGES}"]   = (is_writable("../uploads/images/"))    ? "<img src=\"yes.png\" alt=\"Да\" title=\"Да\" />" : "<img src=\"no.png\" alt=\"Нет\" title=\"Нет\" />";
		$rules["{DBBACKUP}"] = (is_writable("../uploads/dbbackups/")) ? "<img src=\"yes.png\" alt=\"Да\" title=\"Да\" />" : "<img src=\"no.png\" alt=\"Нет\" title=\"Нет\" />";
		$rules["{CONFIG}"]   = (is_writable("../engine/config/"))     ? "<img src=\"yes.png\" alt=\"Да\" title=\"Да\" />" : "<img src=\"no.png\" alt=\"Нет\" title=\"Нет\" />";
		 
		$o_tpl->addhtml("2.tpl", $rules);
	}
	elseif ($STEP==2) {
		
		$rules["{TITLE}"] = "";
		
		$rules["{DB_HOST}"]     = "localhost";
		$rules["{DB_NAME}"]     = "";
		$rules["{DB_USERNAME}"] = "";
		$rules["{DB_USERPASS}"] = "";
		$rules["{DB_PREF}"]     = "ole_";
		
		$rules["{NAME}"]  = "";
		$rules["{PASS}"]  = "";
		$rules["{EMAIL}"] = "";
		
		$rules["{ER}"]         = "";
		$rules["{ER_DB}"]      = "";
		$rules["{ER_DB_NAME}"] = "";
		$rules["{ER_NAME}"]    = "";
		$rules["{ER_PASS}"]    = "";
		$rules["{ER_EMAIL}"]   = "";
											
		$o_tpl->addhtml("3.tpl", $rules);
	}
	elseif ($STEP==3) {
	 	
	 	$title = $_POST['title'];
			
	 	$db_host     = $_POST['db_host'];
		$db_name     = $_POST['db_name'];
		$db_username = $_POST['db_username'];
	 	$db_userpass = $_POST['db_userpass'];
	 	$db_pref     = $_POST['db_pref'];
	
	 	$name  = $_POST['name'];
	 	$pass  = $_POST['pass'];
		$email = $_POST['email'];
	
		if ($db_host!="" && $db_name!="" && $db_pref!="" && preg_match("/^[a-zA-Z0-9-_.]+$/", $name) && preg_match("/^[a-zA-Z0-9]+$/", $pass) && @eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email) && @mysql_connect($db_host, $db_username, $db_userpass) && @mysql_select_db($db_name) && is_writable("../engine/config/")) {
			
			$db = mysql_connect($db_host, $db_username, $db_userpass);
			mysql_query("SET NAMES 'utf8'", $db); 
			mysql_select_db($db_name);	
			
			$q = "DROP TABLE IF EXISTS ".$db_pref."usersgroup";
			mysql_query($q) or die("Ошибка SQL запроса");
						
			$q = "CREATE TABLE ".$db_pref."usersgroup (
			  `id` smallint(5) NOT NULL auto_increment,
			  `group_name` varchar(32) NOT NULL default '', 
			  `allow_cats` varchar(255) NOT NULL default '',			
			  `cat_add` varchar(255) NOT NULL default '',				
			  `allow_offline` tinyint(1) NOT NULL default '0',			
			  `allow_admin` tinyint(1) NOT NULL default '0',			
			  `allow_short` tinyint(1) NOT NULL default '0',			
			  `allow_poll`  tinyint(1) NOT NULL default '1',			
			  `allow_adds` tinyint(1) NOT NULL default '1',				
			  `moderation` tinyint(1) NOT NULL default '0',				
			  `allow_main`  tinyint(1) NOT NULL default '1',			
			  `allow_edit` tinyint(1) NOT NULL default '0',    			
			  `allow_all_edit` tinyint(1) NOT NULL default '0',		    
			  `allow_addc` tinyint(1) NOT NULL default '0',
			  `allow_editc` tinyint(1) NOT NULL default '0',
			  `allow_delc` tinyint(1) NOT NULL default '0',				
			  `captcha`  tinyint(1) NOT NULL default '0',				
			  `edit_allc` tinyint(1) NOT NULL default '0',				
			  `del_allc` tinyint(1) NOT NULL default '0',				
			  `allow_hide` tinyint(1) NOT NULL default '1',				
			  `allow_pm` tinyint(1) NOT NULL default '0',				
			  `allow_search`  tinyint(1) NOT NULL default '1',			
			  `allow_rating` tinyint(1) NOT NULL default '1',			
			  `allow_addst` tinyint(1) NOT NULL default '1',				
			  `allow_editst` tinyint(1) NOT NULL default '0',    			
			  `allow_all_editst` tinyint(1) NOT NULL default '0',		    
			  `moderationst` tinyint(1) NOT NULL default '0',
			  `allow_html` tinyint(1) NOT NULL default '0',
			  PRIMARY KEY  (`id`),
			  UNIQUE KEY `group_name` (`group_name`)
			) engine=myisam DEFAULT CHARSET=utf8";
			mysql_query($q) or die("Ошибка SQL запроса");

			$q = "INSERT INTO ".$db_pref."usersgroup VALUES ('1', 'Администраторы', '0', '0', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '0', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1')";
			mysql_query($q) or die("Ошибка SQL запроса");
			$q = "INSERT INTO ".$db_pref."usersgroup VALUES ('2', 'Главные редакторы', '0', '0', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '0', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1')";
			mysql_query($q) or die("Ошибка SQL запроса");
			$q = "INSERT INTO ".$db_pref."usersgroup VALUES ('3', 'Журналисты', '0', '0', '0', '1', '1', '1', '1', '0', '1', '1', '0', '1', '1', '1', '0', '0', '0', '1', '1', '1', '1', '1', '1', '0', '0', '0')";
			mysql_query($q) or die("Ошибка SQL запроса");
			$q = "INSERT INTO ".$db_pref."usersgroup VALUES ('4', 'Посетители', '0', '0', '0', '0', '1', '1', '1', '0', '0', '0', '0', '1', '1', '1', '0', '0', '0', '1', '1', '1', '1', '1', '0', '0', '0', '0')";
			mysql_query($q) or die("Ошибка SQL запроса");
			$q = "INSERT INTO ".$db_pref."usersgroup VALUES ('5', 'Гости', '0', '0', '0', '0', '1', '1', '0', '0', '0', '0', '0', '0', '0', '0', '1', '0', '0', '0', '0', '1', '1', '0', '0', '0', '0', '0')";
			mysql_query($q) or die("Ошибка SQL запроса");
			
			$q = "DROP TABLE IF EXISTS ".$db_pref."users";
			mysql_query($q) or die("Ошибка SQL запроса");
			
			$q = "CREATE TABLE ".$db_pref."users (
			  `id` mediumint(8) NOT NULL auto_increment,
			  `name` varchar(40) NOT NULL default '',
			  `email` varchar(50) NOT NULL default '',
			  `password` varchar(32) NOT NULL default '',
			  `last_date` varchar(20) default NULL,
			  `usersgroup` smallint(5) NOT NULL default '4',
			  `reg_date` varchar(20) default NULL,
			  `banned` tinyint(1) NOT NULL default '0',
			  `allow_mail` tinyint(1) NOT NULL default '1',
			  `avatar` varchar(30) NOT NULL default '',
			  `fullname` varchar(100) NOT NULL default '',
			  `land` varchar(100) NOT NULL default '',
			  `icq` varchar(20) NOT NULL default '',
			  `info` text NOT NULL,
			  `allowed_ip` varchar(16) NOT NULL default '', 		
			  `hash` varchar(32) NOT NULL default '',   
			  `hashlp` varchar(32) NOT NULL default '',
			  `last_ip` varchar(16) NOT NULL default '',
			  PRIMARY KEY  (`id`),
			  UNIQUE KEY `name` (`name`),
			  UNIQUE KEY `email` (`email`)
			) TYPE=MyISAM DEFAULT CHARSET=utf8";
			mysql_query($q) or die("Ошибка SQL запроса");

			$q = "INSERT INTO ".$db_pref."users VALUES ('1', '$name', '$email', '".md5(md5($pass))."', '".time()."', '1', '".time()."', '0', '1', '', '', '', '', '', '', '', '', '')";
			mysql_query($q) or die("Ошибка SQL запроса");

			$q = "DROP TABLE IF EXISTS ".$db_pref."categories";
			mysql_query($q) or die("Ошибка SQL запроса");
			
			$q = "CREATE TABLE ".$db_pref."categories (
			  `id` smallint(5) NOT NULL auto_increment,
			  `name` varchar(30) NOT NULL default '',
			  `parent_id` smallint(5) NOT NULL default '0',
			  `news_sort` smallint(2) NOT NULL default '0',
			  `news_msort` smallint(2) NOT NULL default '0',
			  `news_num` smallint(2) NOT NULL default '0',
			  PRIMARY KEY  (`id`)
			  ) TYPE=MyISAM DEFAULT CHARSET=utf8";
			mysql_query($q) or die("Ошибка SQL запроса");
			
			$q = "DROP TABLE IF EXISTS ".$db_pref."vote";
			mysql_query($q) or die("Ошибка SQL запроса");
			
			$q = "CREATE TABLE ".$db_pref."vote (
			  `id` mediumint(8) NOT NULL auto_increment,
			  `type` tinyint(1) NOT NULL default '0',
			  `title` varchar(100) NOT NULL default '',
			  `date` varchar(20) NOT NULL default '0',
			  `onoff` tinyint(1) NOT NULL default '1',
			  `is_reg` tinyint(1) NOT NULL default '0',
			  `cats` varchar(255) NOT NULL default '',
			  `body` text NOT NULL,
			  PRIMARY KEY  (`id`)
			  ) TYPE=MyISAM DEFAULT CHARSET=utf8";
			mysql_query($q) or die("Ошибка SQL запроса");
			
			$q = "DROP TABLE IF EXISTS ".$db_pref."votes";
			mysql_query($q) or die("Ошибка SQL запроса");
			
			$q = "CREATE TABLE ".$db_pref."votes (
			  `id` int(10) NOT NULL auto_increment,
			  `vote_id` mediumint(8) NOT NULL default '0',
			  `ip` varchar(16) NOT NULL default '',
			  `answer` varchar(100) NOT NULL default '',
			  `news_id` mediumint(8) NOT NULL default '0',
			  PRIMARY KEY (`id`)
			  ) TYPE=MyISAM DEFAULT CHARSET=utf8";
			mysql_query($q) or die("Ошибка SQL запроса");

			$q = "DROP TABLE IF EXISTS ".$db_pref."news";
			mysql_query($q) or die("Ошибка SQL запроса");
			
			$q = "CREATE TABLE ".$db_pref."news (
			  `id` int(11) NOT NULL auto_increment,
			  `autor` varchar(40) NOT NULL default '',
			  `date` varchar(20) NOT NULL default '0',
			  `short_story` text NOT NULL,
			  `full_story` text NOT NULL,
			  `title` varchar(255) NOT NULL default '',
			  `keywords` text NOT NULL,
			  `cats` varchar(255) NOT NULL default '0',
			  `allow_comm` tinyint(1) NOT NULL default '1',
			  `allow_main` tinyint(1) unsigned NOT NULL default '1',     
			  `allow_rate` tinyint(1) unsigned NOT NULL default '1',
			  `vote_id` mediumint(8) NOT NULL default '0',
			  `onoff` tinyint(1) NOT NULL default '0',
			  `news_read` smallint(6) unsigned NOT NULL default '0',
			  `expires` varchar(20) NOT NULL default '0',
			  `moderation` tinyint(1) NOT NULL default '0',
			  `fixed` tinyint(1) NOT NULL default '0',                   
			  `access` varchar(255) NOT NULL default '',
			  `descr` varchar(200) NOT NULL default '',
			  `user_id` mediumint(8) NOT NULL default '0',
			  PRIMARY KEY  (`id`)
			) TYPE=MyISAM DEFAULT CHARSET=utf8";
			mysql_query($q) or die("Ошибка SQL запроса");

			$q = "DROP TABLE IF EXISTS ".$db_pref."statik";
			mysql_query($q) or die("Ошибка SQL запроса");
			
			$q = "CREATE TABLE ".$db_pref."statik (
			  `id` smallint(5) NOT NULL auto_increment,
			  `title` varchar(100) NOT NULL default '',
			  `story` text NOT NULL,
			  `descr` varchar(255) NOT NULL default '',
			  `keywords` text NOT NULL,
			  `access` varchar(200) NOT NULL default '0',
			  `views` mediumint(8) NOT NULL default '0',
			  `autor` varchar(40) NOT NULL default '',
			  `date` varchar(20) NOT NULL default '0',
			  `onoff` tinyint(1) NOT NULL default '0',
			  `user_id` mediumint(8) NOT NULL default '0',
			  PRIMARY KEY  (`id`)
			  ) TYPE=MyISAM DEFAULT CHARSET=utf8";
			mysql_query($q) or die("Ошибка SQL запроса");

			$q = "DROP TABLE IF EXISTS ".$db_pref."bannedip";
			mysql_query($q) or die("Ошибка SQL запроса");
			
			$q = "CREATE TABLE ".$db_pref."bannedip (
			  `id` smallint(5) NOT NULL auto_increment,
			  `ip` varchar(16) NOT NULL default '',
			  `date` varchar(20) NOT NULL default '',
			  `descr` text NOT NULL,
			  PRIMARY KEY  (`id`),
			  UNIQUE KEY `ip` (`ip`)
			  ) TYPE=MyISAM DEFAULT CHARSET=utf8";
			mysql_query($q) or die("Ошибка SQL запроса");
			
			$q = "DROP TABLE IF EXISTS ".$db_pref."bookmarks";
			mysql_query($q) or die("Ошибка SQL запроса");
			
			$q = "CREATE TABLE ".$db_pref."bookmarks (
			  `id` smallint(5) NOT NULL auto_increment,
			  `user_id` mediumint(8) NOT NULL default '0',
			  `news_id` mediumint(8) NOT NULL default '0',
			  PRIMARY KEY  (`id`)
			) TYPE=MyISAM DEFAULT CHARSET=utf8";
			mysql_query($q) or die("Ошибка SQL запроса");

			$q = "DROP TABLE IF EXISTS ".$db_pref."comments";
			mysql_query($q) or die("Ошибка SQL запроса");
			
			$q = "CREATE TABLE ".$db_pref."comments (
			  `id` int(10) unsigned NOT NULL auto_increment,
			  `news_id` int(11) NOT NULL default '0',
			  `user_id` mediumint(8) NOT NULL default '0',
			  `date` varchar(20) NOT NULL default '',
			  `autor` varchar(40) NOT NULL default '',
			  `email` varchar(40) NOT NULL default '',
			  `icq` varchar(20) NOT NULL default '',
			  `text` text NOT NULL,
			  `ip` varchar(16) NOT NULL default '',
			  PRIMARY KEY  (`id`)
			  ) TYPE=MyISAM DEFAULT CHARSET=utf8";
			mysql_query($q) or die("Ошибка SQL запроса");

			$q = "DROP TABLE IF EXISTS ".$db_pref."pm";
			mysql_query($q) or die("Ошибка SQL запроса");
			
			$q = "CREATE TABLE ".$db_pref."pm (
			  `id` int(10) unsigned NOT NULL auto_increment,
			  `subj` varchar(100) NOT NULL default '',
			  `text` text NOT NULL,
			  `user_id` MEDIUMINT(8) NOT NULL default '0',
			  `user_from` MEDIUMINT(8) NOT NULL default '0',
			  `date` varchar(20) NOT NULL default '',
			  `pm_read` tinyint(1) unsigned NOT NULL default '0',
			  `is_del` tinyint(1) unsigned NOT NULL default '0',
			  `is_del_from` tinyint(1) unsigned NOT NULL default '0',
			  `autor` varchar(40) NOT NULL default '',
			  `autor_to` varchar(40) NOT NULL default '',
			  PRIMARY KEY  (`id`)
			  ) TYPE=MyISAM DEFAULT CHARSET=utf8";
			mysql_query($q) or die("Ошибка SQL запроса");

			$q = "DROP TABLE IF EXISTS ".$db_pref."note";
			mysql_query($q) or die("Ошибка SQL запроса");
			
			$q = "CREATE TABLE ".$db_pref."note (
			  `text` text
			  ) TYPE=MyISAM DEFAULT CHARSET=utf8";
			mysql_query($q);

			$q = "insert into ".$db_pref."note values('Здесь вы можете сохранять собственные заметки.')";
			mysql_query($q) or die("Ошибка SQL запроса");
			
			$q = "DROP TABLE IF EXISTS ".$db_pref."wfilter";
			mysql_query($q) or die("Ошибка SQL запроса");
			
			$q = "CREATE TABLE ".$db_pref."wfilter (
			  `id` int(10) unsigned NOT NULL auto_increment,
			  `word0` varchar(100) not null default '',
			  `word1` varchar(100) not null default '',
			  PRIMARY KEY  (`id`)
			  ) TYPE=MyISAM DEFAULT CHARSET=utf8";
			mysql_query($q) or die("Ошибка SQL запроса");
			
			$q = "DROP TABLE IF EXISTS ".$db_pref."email";
			mysql_query($q) or die("Ошибка SQL запроса");
			
			$q = "CREATE TABLE ".$db_pref."email (
			  `id` tinyint(3) unsigned NOT NULL auto_increment,
			  `template` text NOT NULL,
			  PRIMARY KEY  (`id`)
			  ) TYPE=MyISAM DEFAULT CHARSET=utf8";
			mysql_query($q) or die("Ошибка SQL запроса");
			
			$q = "INSERT INTO ".$db_pref."email values ('1', '{*USERNAME*},\r\n\r\nЭто письмо отправлено с сайта {*URL*}\r\n\r\nВы получили это письмо, так как этот e-mail адрес был использован при регистрации на сайте. Если Вы не регистрировались на этом сайте, просто проигнорируйте это письмо и удалите его. Вы больше не получите такого письма.\r\n\r\n------------------------------------------------\r\nВаш логин и пароль на сайте:\r\n------------------------------------------------\r\n\r\nЛогин: {*USERNAME*}\r\nПароль: {*PASSWORD*}\r\n\r\n------------------------------------------------\r\nИнструкция по активации\r\n------------------------------------------------\r\n\r\nБлагодарим Вас за регистрацию.\r\nМы требуем от Вас подтверждения Вашей регистрации, для проверки того, что введённый Вами e-mail адрес - реальный. Это требуется для защиты от нежелательных злоупотреблений и спама.\r\n\r\nДля активации Вашего аккаунта, зайдите по следующей ссылке:\r\n\r\n{*VALIDATIONLINK*}\r\n\r\nЕсли и при этих действиях ничего не получилось, возможно Ваш аккаунт удалён. В этом случае, обратитесь к Администратору, для разрешения проблемы.\r\n\r\nС уважением,\r\n\r\nАдминистрация {*URL*}')";
			mysql_query($q) or die("Ошибка SQL запроса"); 

			$q = "INSERT INTO ".$db_pref."email values ('2', '{*USERNAME_TO*},\r\n\r\nДанное письмо вам отправил {*USERNAME_FROM*} с сайта {*URL*}\r\n\r\n------------------------------------------------\r\nТекст сообщения\r\n------------------------------------------------\r\n\r\n{*TEXT*}\r\n\r\nIP адрес отправителя: {*IP*}\r\n\r\n------------------------------------------------\r\nПомните, что администрация сайта не несет ответственности за содержание данного письма\r\n\r\nС уважением,\r\n\r\nАдминистрация {*URL*}')";
			mysql_query($q) or die("Ошибка SQL запроса");
			
			$q = "INSERT INTO ".$db_pref."email values ('3', 'Уважаемый {*USERNAME*},\r\n\r\nВы сделали запрос на получение забытого пароля на сайте {*URL*} Однако в целях безопасности все пароли хранятся в зашифрованном виде, поэтому мы не можем сообщить вам ваш старый пароль, поэтому если вы хотите сгенерировать новый пароль, зайдите по следующей ссылке: \r\n\r\n{*LOSTLINK*}\r\n\r\nЕсли вы не делали запроса для получения пароля, то просто удалите данное письмо, ваш пароль храниться в надежном месте, и недоступен посторонним лицам.\r\n\r\nIP адрес отправителя: {*IP*}\r\n\r\nС уважением,\r\n\r\nАдминистрация {*URL*}')";
			mysql_query($q) or die("Ошибка SQL запроса");
			  
			$q = "INSERT INTO ".$db_pref."email values ('4', 'Уважаемый администратор,\r\n\r\nуведомляем вас о том, что на сайт {*URL*} была добавлена новость, которая в данный момент ожидает модерации.\r\n\r\n------------------------------------------------\r\nКраткая информация о новости\r\n------------------------------------------------\r\n\r\nАвтор: {*USERNAME*}\r\nЗаголовок новости: {*TITLE*}\r\nКатегория: {*CATEGORY*}\r\nДата добавления: {*DATE*}\r\n\r\nС уважением,\r\n\r\nАдминистрация {*URL*}')";
			mysql_query($q) or die("Ошибка SQL запроса"); 

			$q = "DROP TABLE IF EXISTS ".$db_pref."banners";
			mysql_query($q) or die("Ошибка SQL запроса");
			
			$q = "CREATE TABLE ".$db_pref."banners (
			  `id` smallint(5) NOT NULL auto_increment,
			  `descr` varchar(200) NOT NULL default '',
			  `code` text NOT NULL,
			  `onoff` tinyint(1) NOT NULL default '1',
			  `fixed` tinyint(1) NOT NULL default '0',
			  `place` tinyint(1) NOT NULL default '0',
			  `cats` varchar(255) NOT NULL default '',
			  `access` varchar(200) NOT NULL default '0',
			  `allow_main` tinyint(1) NOT NULL default '1',
			  `allow_cate` tinyint(1) NOT NULL default '1',
			  `allow_statik` tinyint(1) NOT NULL default '0',
			  `allow_news` tinyint(1) NOT NULL default '0',
			  `allow_arhnews` tinyint(1) NOT NULL default '0',
			  `allow_search` tinyint(1) NOT NULL default '0',
			  PRIMARY KEY  (`id`)
			) TYPE=MyISAM DEFAULT CHARSET=utf8";
			mysql_query($q) or die("Ошибка SQL запроса");

			$q = "DROP TABLE IF EXISTS ".$db_pref."blocks";
			mysql_query($q) or die("Ошибка SQL запроса");
			
			$q = "CREATE TABLE ".$db_pref."blocks (
			  `id` smallint(5) NOT NULL auto_increment,
			  `descr` varchar(200) NOT NULL default '',
			  `title` varchar(200) NOT NULL default '',
			  `onoff` tinyint(1) NOT NULL default '1',
			  `place` tinyint(1) NOT NULL default '0',
			  `pos` tinyint(3) NOT NULL default '0',
			  `tpl` varchar(50) NOT NULL default '',
			  `modul` varchar(50) NOT NULL default '',
			  `text` text NOT NULL,
			  PRIMARY KEY  (`id`)
			) TYPE=MyISAM DEFAULT CHARSET=utf8";
			mysql_query($q) or die("Ошибка SQL запроса");
			
			$q = "INSERT INTO ".$db_pref."blocks values ('1', 'Поиск', 'Поиск', '1', '1', '1', 'search.tpl', '', '')";
			mysql_query($q) or die("Ошибка SQL запроса");
			$q = "INSERT INTO ".$db_pref."blocks values ('2', 'Навигация по сайту', 'Навигация', '1', '1', '2', '', '', '
		<img src=\"{BLOCK_TEMPLATE}/images/navig.png\" style=\"padding-right:5px;\" alt=\"\" /> <a href=\"index.php\">Главная</a><br />
        <img src=\"{BLOCK_TEMPLATE}/images/navig.png\" style=\"padding-right:5px;\" alt=\"\" /> <a href=\"index.php?m=categories\">Категория</a><br />
	    <img src=\"{BLOCK_TEMPLATE}/images/navig.png\" style=\"padding-right:5px;\" alt=\"\" /> <a href=\"index.php?m=statik\">Статические страницы</a><br />
        <img src=\"{BLOCK_TEMPLATE}/images/navig.png\" style=\"padding-right:5px;\" alt=\"\" /> <a href=\"index.php?m=arhnews\">Архив новостей</a><br />
		<img src=\"{BLOCK_TEMPLATE}/images/navig.png\" style=\"padding-right:5px;\" alt=\"\" /> <a href=\"index.php?m=news\">Новости</a><br />
		<img src=\"{BLOCK_TEMPLATE}/images/navig.png\" style=\"padding-right:5px;\" alt=\"\" /> <a href=\"index.php?m=search\">Расширенный поиск</a>')";
			mysql_query($q) or die("Ошибка SQL запроса");
			$q = "INSERT INTO ".$db_pref."blocks values ('3', 'Календарь', 'Календарь', '1', '1', '3', '', 'calendar.php', '')";
			mysql_query($q) or die("Ошибка SQL запроса");
			$q = "INSERT INTO ".$db_pref."blocks values ('4', 'Популярные новости', 'Популярные новости', '1', '1', '4', '', 'popunews.php', '')";
			mysql_query($q) or die("Ошибка SQL запроса");
			$q = "INSERT INTO ".$db_pref."blocks values ('5', 'Путь', 'Путь', '1', '3', '1', 'way.tpl', 'way.php', '')";
			mysql_query($q) or die("Ошибка SQL запроса");
			$q = "INSERT INTO ".$db_pref."blocks values ('6', 'Панель управления', 'Пользователь', '1', '2', '1', '', 'enter.php', '')";
			mysql_query($q) or die("Ошибка SQL запроса");
			$q = "INSERT INTO ".$db_pref."blocks values ('7', 'Опрос', 'Опрос', '1', '2', '2', '', 'vote.php', '')";
			mysql_query($q) or die("Ошибка SQL запроса");
			$q = "INSERT INTO ".$db_pref."blocks values ('8', 'Архив новостей', 'Архив новостей', '1', '2', '3', '', 'arhnews.php', '')";
			mysql_query($q) or die("Ошибка SQL запроса");
			$q = "INSERT INTO ".$db_pref."blocks values ('9', 'Информация', 'Информация', '1', '2', '4', '', '', 'Здесь может быть ваша информация')";
			mysql_query($q) or die("Ошибка SQL запроса");
			
			$url = preg_replace("'index.php'", "", preg_replace("'/install/'", "", $_SERVER['HTTP_REFERER']));
			
$str = "<?php
	
/*
//==============================================================================/
// Open Lamp Engine version 1.0
//------------------------------------------------------------------------------/
// Web-site: http://www.ole.od.ua/
//------------------------------------------------------------------------------/
// Author: r0n9.GOL Web-site: http://www.tregub.od.ua email: ron9.gol@gmail.com 
//------------------------------------------------------------------------------/
// Copyright by r0n9.GOL © 2009 
//==============================================================================/
// Данный код защищен авторскими правами :)
//==============================================================================/
// Файл: config.php
//------------------------------------------------------------------------------/
// Назначение: Настройки сайта
//==============================================================================/
*/
	
	\$CONFIG = array (
	
	'version' => \"1.0\",
	
	'title'       => \"$title\",
	'charset'     => \"UTF-8\",
	'descr'       => \"Powered by Open Lamp Engine\",
	'keywords'    => \"OLE, Open Lamp Engien, CMS\",
	'autor'       => \"r0n9.GOL\",
	'theme'       => \"default\",
	'site_onoff'  => \"1\",
	'site_monoff' => \"Сайт временно закрыт\",
	'allow_dimg'  => \"1\",
	'simg'        => \"10000\",
	
	'adm_file'     => \"admin.php\",
	'allow_renter' => \"0\",
	
	'news_num'   => \"10\",
	'news_sort'  => \"1\",
	'news_msort' => \"1\",
	'news_email' => \"1\",
	'comm_num'   => \"20\",
	'comm_msort' => \"1\",
		
	'allow_reg'     => \"1\",
	'reg_group'     => \"4\",
	'gost_group'    => \"5\",
	'send_regemail' => \"1\",
	'users_kol'     => \"0\"
	
	);
	
	define(URL, \"$url\");
	define(\"MYSQL_HOST\", \"$db_host\"); 
	define(\"MYSQL_USER\", \"$db_username\");
	define(\"MYSQL_PASS\", \"$db_userpass\");
	define(\"MYSQL_DB\", \"$db_name\");  
	define(\"MYSQL_PREF\", \"$db_pref\"); 
	
?>";
					
			$con_file = @fopen("../engine/config/config.php", "w+") or die("Извините, но невозможно создать файл ../engine/config.php");
			@fwrite($con_file, $str);
			@fclose($con_file);
							
			$o_tpl->addhtml("4.tpl");		
		}
		else {
		
			$rules["{TITLE}"] = $title;
		
			$rules["{DB_HOST}"]     = $db_host;
			$rules["{DB_NAME}"]     = $db_name;
			$rules["{DB_USERNAME}"] = $db_username;
			$rules["{DB_USERPASS}"] = $db_userpass;
			$rules["{DB_PREF}"]     = $db_pref;
		
			$rules["{NAME}"]  = $name;
			$rules["{PASS}"]  = $pass;
			$rules["{EMAIL}"] = $email;
			
			$rules["{ER}"]         = (!is_writable("../engine/config/")) ? "Ошибка прав доступа к папке ../engine/config/" : "";					  
			$rules["{ER_DB}"]      = (@!mysql_connect($db_host, $db_username, $db_userpass)) ? "Ошибка подключения к базе данных" : "";
			$rules["{ER_DB_NAME}"] = (@mysql_connect($db_host, $db_username, $db_userpass) && @!mysql_select_db($db_name)) ? "Поле не правельно заполнено" : "";
			$rules["{ER_NAME}"]    = (!preg_match("/^[a-zA-Z0-9-_.]+$/", $name)) ? "Поле не правельно заполнено" : "";
			$rules["{ER_PASS}"]    = (!preg_match("/^[a-zA-Z0-9]+$/", $pass)) ? "Поле не правельно заполнено" : "";
			$rules["{ER_EMAIL}"]   = (!@eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)) ? "Поле не правельно заполнено" : "";
						
			$o_tpl->addhtml("3.tpl", $rules);
		}
	}

	$o_tpl->init();

?>
