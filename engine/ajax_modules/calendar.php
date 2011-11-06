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
// Файл: calendar.php
//-----------------------------------------------------------------------------/
// Назначение: Модуль календаря (ajax)
//=============================================================================/
*/

    if (!defined("OLE")) die("<script>window.location = \"./\"</script>");
    
    include(CLASSES ."/news.class.php");
        
    $o_news = new news($o_mysql);
    
    $year  = intval($o_vars->post['year']) ? $o_vars->post['year'] : date("Y");
	$month = intval($o_vars->post['mon'])  ? $o_vars->post['mon']  : date("n");
	
	$next_year  = $year;
	$priv_year  = $year;
	$next_month = $month;
	$priv_month = $month;
	
	if ($month==12) {
		$next_month = 1;
		$next_year++;
	}
	else $next_month++;
	
	if ($month==1) {
		$priv_month = 12;
		$priv_year--;
	}
	else $priv_month--;
	
	$arules["{PRIV_YEAR}"]  = $priv_year;
    $arules["{PRIV_MONTH}"] = $priv_month;
    $arules["{YEAR}"]       = $year;
    $arules["{MONTH}"] 	    = $o_other->getMonthAb($month);
    $arules["{NEXT_YEAR}"]  = $next_year;
    $arules["{NEXT_MONTH}"] = $next_month;
    
    $date = getdate(mktime(0, 0, 0, $month, 1, $year));
	$date['kolday'] = date('t', mktime(0, 0, 0, $month, 1, $year));
	
	if (!$date['wday']) $date['wday'] = 7;
	$arules["{FIRST}"] = ($date['wday']!=1) ? $date['wday'] * 15 + ($date['wday'] - 1) * 8 : 15;
	$h = $date['wday'];
	
	$arules["{DAYS}"] = ($o_news->checkNewsOnDate($year, $month, 1)) ? "<a href='index.php?m=arhnews&amp;year=$year&amp;mon=$month&amp;day=1'>1</a></p>" : "1</p>";
	if ($h % 7==0) $arules["{DAYS}"] .= "</div><div>";
	for ($i = 2; $i <= $date['kolday']; $i++) {
    	$arules["{DAYS}"] .= ($o_news->checkNewsOnDate($year, $month, $i)) ? "<p><a href='index.php?m=arhnews&amp;year=$year&amp;mon=$month&amp;day=$i'>$i</a></p>" : "<p>$i</p>";
    	$h++;
		if ($h % 7==0) $arules["{DAYS}"] .= ($i!=$date['kolday']) ? "</div><div>" : "";     	
	}		
	
	$arules["{TEMPLATE}"] = TEMPLATES_DIR;
	
    $send_text = $o_tpl->gethtml(BLOCK_TEMPLATES_DIR."/calendar2a.tpl", $arules);
	
	$send_text = str_replace("<", "[", $send_text);
	$send_text = str_replace(">", "]", $send_text);
	
	$o_tpl->addhtml($send_text);
		        
?>
