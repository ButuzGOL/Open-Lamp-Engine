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
// Файл: bookmarks.php
//-----------------------------------------------------------------------------/
// Назначение: Модуль управления закладками (ajax)
//=============================================================================/
*/

    if (!defined("OLE")) die("<script>window.location = \"./\"</script>");
    
    include(CLASSES ."/users.class.php");
    include(CLASSES ."/news.class.php");
    
    $o_users = new users($o_mysql);
    
    $act     = $o_vars->post['act'];
	$user_id = intval($o_vars->post['user_id']);
	$news_id = intval($o_vars->post['news_id']);
    
    if ($user_id && $news_id) {
	
		if ($act=="add") $result = $o_users->addBookmark($user_id, $news_id); 
		if ($act=="del") $result = $o_users->delBookmark($user_id, $news_id);
	}
		
	if (($act=="add" && $result) || ($act=="del" && !$result)) $send_text = "<img src=\"".TEMPLATES_DIR."/images/bookmarks_minus.png\" onclick=\"gogoAj('bookmark_$news_id','bookmarks','act=del&amp;user_id=$user_id&amp;news_id=$news_id','".TEMPLATES_DIR."',2);\" style=\"cursor: pointer;\" title=\"".$LANG['bookmarks_del']."\" alt=\"".$LANG['bookmarks_del']."\" />";
	
	if (($act=="del" && $result) || ($act=="add" && !$result)) $send_text = "<img src=\"".TEMPLATES_DIR."/images/bookmarks_plus.png\" onclick=\"gogoAj('bookmark_$news_id','bookmarks','act=add&amp;user_id=$user_id&amp;news_id=$news_id','".TEMPLATES_DIR."',2);\" style=\"cursor: pointer;\" title=\"".$LANG['bookmarks_add']."\" alt=\"".$LANG['bookmarks_add']."\" />";
	
	$send_text = str_replace("<","[", $send_text);
	$send_text = str_replace(">","]", $send_text);
	
	$o_tpl->addhtml($send_text);
		        
?>
