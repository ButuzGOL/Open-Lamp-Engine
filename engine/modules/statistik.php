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
// Файл: statistik.php
//-----------------------------------------------------------------------------/
// Назначение: Модуль статистики по сайту
//=============================================================================/
*/

	if (!defined("OLE")) die("<script>window.location = \"./\"</script>");
	
	include(CLASSES ."/news.class.php");
	include(CLASSES ."/comments.class.php");
	
	$o_news 	= new news($o_mysql);
	$o_comments = new comments($o_mysql);
	
	$mrules["{TITLE}"] = $LANG[$m];
	
	$news_st     = $o_news->getStatistik();
	$users_st    = $o_users->getStatistik();
	$comments_st = $o_comments->getStatistik();
	
	$mrules1["{NEWS_KOL}"]  = $news_st['kol'];
	$mrules1["{NEWS_OPUB}"] = $news_st['opub'];
	$mrules1["{NEWS_MAIN}"] = $news_st['main'];
	$mrules1["{NEWS_MODE}"] = $news_st['mode'];
	$mrules1["{NEWS_MON}"]  = $news_st['mon'];
	$mrules1["{NEWS_WEEK}"] = $news_st['week'];
	$mrules1["{NEWS_DAY}"]  = $news_st['day'];

	$mrules1["{COMM_KOL}"]  = $comments_st['kol'];
	$mrules1["{COMM_MON}"]  = $comments_st['mon'];
	$mrules1["{COMM_WEEK}"] = $comments_st['week'];
	$mrules1["{COMM_DAY}"]  = $comments_st['day'];
	
	$mrules1["{USERS_KOL}"]  = $users_st['kol'];
	$mrules1["{USERS_BANN}"] = $users_st['bann'];
	$mrules1["{USERS_MON}"]  = $users_st['mon'];
	$mrules1["{USERS_WEEK}"] = $users_st['week'];
	$mrules1["{USERS_DAY}"]  = $users_st['day'];
	
	$mrules["{MIDDLE}"] = $o_tpl->gethtml(TEMPLATES_DIR."/".$m."_middle.tpl", $mrules1);
						
	$o_tpl->addhtml(TEMPLATES_DIR."/default_middle.tpl", $mrules);
    		
?>
