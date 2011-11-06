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
// Файл: way.php
//-----------------------------------------------------------------------------/
// Назначение: Блок пути просмотра
//=============================================================================/
*/

	if (!defined("OLE")) die("<script>window.location = \"./\"</script>");
	
	if (!isset($o_news)) 	   {
		include(CLASSES ."/news.class.php");	
		$o_news = new news($o_mysql);
	}
	if (!isset($o_categories)) {
		include(CLASSES ."/categories.class.php");
		$o_categories = new categories($o_mysql);
	}
	if (!isset($o_statik)) {
		include(CLASSES ."/statik.class.php");
		$o_statik = new statik($o_mysql);
	}
	
	if (!$m || ($m=="start" && ((isset($o_vars->get['p']) && $o_other->check($o_vars->get['p'], "^[0-9]+$")) || $o_vars->get['p']==""))) { $blocks = "<span class=\"sw\">".$LANG['start']."</span>";	
	}
	else {
		$blocks = "<a href=\"index.php\">".$LANG['start']."</a>";
		switch ($m) {
			case "start" : break;
			
			case "arhnews" : 
				if (!$o_vars->get['year'] || !$o_vars->get['mon']) $blocks .= " &raquo; <span class=\"sw\">".$LANG[$m]."</span>";
				else $blocks .= " &raquo; <a href=\"index.php?m=$m\">".$LANG[$m]."</a>";
				
				if ($o_vars->get['year'] && $o_vars->get['mon'] && $o_vars->get['mon']<=12 && $o_other->check($o_vars->get['year'], "^[0-9]+$") && $o_other->check($o_vars->get['mon'], "^[0-9]+$") && ($o_other->check($o_vars->get['p'], "^[0-9]+$") || $o_vars->get['p']=="")) 
					if (!$o_vars->get['day']) $blocks .= " &raquo; <span class=\"sw\">".$LANG[$m.'_ymd']." " .$o_other->getMonthAb($o_vars->get['mon']) ." ". $o_vars->get['year'] ." ".$LANG[$m.'_ym']."</span>"; 
					elseif ($o_vars->get['day'] && checkdate($o_vars->get['mon'], $o_vars->get['day'], $o_vars->get['year'])) $blocks .= " &raquo; <span class=\"sw\">".$LANG[$m.'_ymd']." ".$o_vars->get['day']." " .$o_other->getMonthAb($o_vars->get['mon'], 1) ." ". $o_vars->get['year'] ." ".$LANG[$m.'_ym']."</span>";  
			break;
						
			case "news" : 
				if (!$o_vars->get['id'] && $o_vars->get['a']!="add") $blocks .= " &raquo; <span class=\"sw\">".$LANG[$m]."</span>";
				else $blocks .= " &raquo; <a href=\"index.php?m=$m\">".$LANG[$m]."</a>";
				
				if ($o_vars->get['id'] && $o_news->get($o_vars->get['id'], 1) && $o_vars->get['a']!="del" && $o_vars->get['a']!="edit" && $o_vars->get['a']!="add") 
					$blocks .= " &raquo; <span class=\"sw\">".$o_news->getOne($o_vars->get['id'], "title")."</span>"; 
				elseif (isset($o_vars->get['a']) && $o_vars->get['a']=="add")  $blocks .= " &raquo; <span class=\"sw\">".$LANG[$m.'_add']."</span>";
			 	elseif (isset($o_vars->get['a']) && $o_vars->get['a']=="edit" && $o_vars->get['id']) {
					if ($o_news->get($o_vars->get['id'], 1)) $blocks .= " &raquo; <span class=\"sw\">".$LANG[$m.'_edit'].$o_news->getOne($o_vars->get['id'], "title")."</span>"; 
				 	else $blocks .= " &raquo; <span class=\"sw\">".$LANG[$m.'_edit']."</span>"; 
				}
			 	elseif (isset($o_vars->get['a']) && $o_vars->get['a']=="del" && $o_vars->get['id']) $blocks .= " &raquo; <span class=\"sw\">".$LANG[$m.'_del']."</span>";
			break;
							
			case "categories" : 
				if (!$o_vars->get['id']) $blocks .= " &raquo; <span class=\"sw\">".$LANG[$m]."</span>";
				else $blocks .= " &raquo; <a href=\"index.php?m=$m\">".$LANG[$m]."</a>";
				
				if ($o_vars->get['id'] && $o_categories->get($o_vars->get['id']) && ($o_other->check($o_vars->get['p'], "^[0-9]+$") || $o_vars->get['p']=="")) 
					$blocks .= " &raquo; <span class=\"sw\">".$o_categories->getOne($o_vars->get['id'], "name")."</span>"; 
			break;
							
			case "statik" : 
				if (!$o_vars->get['id'] && $o_vars->get['a']!="add") $blocks .= " &raquo; <span class=\"sw\">".$LANG[$m]."</span>";
				else $blocks .= " &raquo; <a href=\"index.php?m=$m\">".$LANG[$m]."</a>";
				
				if ($o_vars->get['id'] && $o_statik->getS($o_vars->get['id']) && $o_vars->get['a']!="del" && $o_vars->get['a']!="edit" && $o_vars->get['a']!="add") 
					$blocks .= " &raquo; <span class=\"sw\">".$o_statik->getOne($o_vars->get['id'], "title")."</span>"; 
				elseif (isset($o_vars->get['a']) && $o_vars->get['a']=="add")  $blocks .= " &raquo; <span class=\"sw\">".$LANG[$m.'_add']."</span>";
			 	elseif (isset($o_vars->get['a']) && $o_vars->get['a']=="edit" && $o_vars->get['id']) {
					if ($o_statik->get($o_vars->get['id'])) $blocks .= " &raquo; <span class=\"sw\">".$LANG[$m.'_edit'].$o_statik->getOne($o_vars->get['id'], "title")."</span>"; 
				 	else $blocks .= " &raquo; <span class=\"sw\">".$LANG[$m.'_edit']."</span>"; 
				}
			 	elseif (isset($o_vars->get['a']) && $o_vars->get['a']=="del" && $o_vars->get['id']) $blocks .= " &raquo; <span class=\"sw\">".$LANG[$m.'_del']."</span>";
			break;
			
			case "search" :
				if (isset($o_vars->post['action_search']) && $USER_RIGHTS['allow_search']) 
					$blocks .= " &raquo; <a href=\"index.php?m=$m\">".$LANG[$m]."</a>";
				else $blocks .= " &raquo; <span class=\"sw\">".$LANG[$m]."</span>";
			break;
			
			case "statistik" : 
				$blocks .= " &raquo; <span class=\"sw\">".$LANG[$m]."</span>";
			break;
			
			case "lostpass" : 
				$blocks .= " &raquo; <span class=\"sw\">".$LANG[$m]."</span>";
			break;
			
			case "registr" : 
				$blocks .= " &raquo; <span class=\"sw\">".$LANG[$m]."</span>";
			break;
			
			case "profile" : 
				if ($o_users->getOne($o_vars->get['id'], "name")) 
					$blocks .= " &raquo; <span class=\"sw\">".$LANG[$m].$o_users->getOne($o_vars->get['id'], "name")."</span>";
			break;
			
			case "bookmarks" : 
				if ($ID && ($o_other->check($o_vars->get['p'], "^[0-9]+$") || $o_vars->get['p']=="")) 
					$blocks .= " &raquo; <span class=\"sw\">".$LANG[$m]."</span>"; 
				else $blocks .= " &raquo; <a href=\"index.php?m=$m\">".$LANG[$m]."</a>";
			break;
						
			case "pm" : if ($ID) $blocks .= " &raquo; <span class=\"sw\">".$LANG[$m]."</span><br />";
			break;
			
		}
	}

?>
