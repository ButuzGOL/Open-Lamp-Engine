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
// Файл: start.php
//-----------------------------------------------------------------------------/
// Назначение: Модуль главной страницы (админка)
//=============================================================================/
*/

    if (!defined("OLE")) die("<script>window.location = \"./\"</script>");
	
	include(CLASSES."/news.class.php");
 	include(CLASSES."/comments.class.php");
    include(CLASSES."/note.class.php");
    	
	$o_news 	= new news($o_mysql);
	$o_comments = new comments($o_mysql);
	$o_note     = new note($o_mysql);
	
	$news_st     = $o_news->getStatistik();
	$users_st    = $o_users->getStatistik();
	$comments_st = $o_comments->getStatistik();
	
	$mrules["{NEWS_KOL}"]  = $news_st['kol'];
	$mrules["{NEWS_OPUB}"] = $news_st['opub'];
	$mrules["{NEWS_MAIN}"] = $news_st['main'];
	$mrules["{NEWS_MODE}"] = $news_st['mode'];
	$mrules["{NEWS_MON}"]  = $news_st['mon'];
	$mrules["{NEWS_WEEK}"] = $news_st['week'];
	$mrules["{NEWS_DAY}"]  = $news_st['day'];

	$mrules["{COMM_KOL}"]  = $comments_st['kol'];
	$mrules["{COMM_MON}"]  = $comments_st['mon'];
	$mrules["{COMM_WEEK}"] = $comments_st['week'];
	$mrules["{COMM_DAY}"]  = $comments_st['day'];
	
	$mrules["{USERS_KOL}"]  = $users_st['kol'];
	$mrules["{USERS_BANN}"] = $users_st['bann'];
	$mrules["{USERS_MON}"]  = $users_st['mon'];
	$mrules["{USERS_WEEK}"] = $users_st['week'];
	$mrules["{USERS_DAY}"]  = $users_st['day'];
			
	$action = $o_vars->post['action'];

	if (isset($action)) {
		$text = stripslashes(htmlspecialchars(strip_tags($o_vars->post['text']), ENT_QUOTES));
		$o_note->update($text);
	}
	
	$mrules["{NOTE}"] = $o_note->get();
		
	$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/start.tpl", $mrules);
?>
