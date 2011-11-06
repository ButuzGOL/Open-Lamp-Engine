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
// Назначение: Блок календаря
//=============================================================================/
*/

	if (!defined("OLE")) die("<script>window.location = \"./\"</script>");

	if (!isset($o_news)) {
    	include(CLASSES ."/news.class.php");	
    	$o_news = new news($o_mysql);
    }
    
    $year  = ($o_vars->get['year'] && $o_other->check($o_vars->get['year'], "^[0-9]+$"))                             ? $o_vars->get['year'] : date('Y');
	$month = ($o_vars->get['mon'] && $o_other->check($o_vars->get['mon'], "^[0-9]+$") && $o_vars->get['mon'] <= 12)  ? $o_vars->get['mon']  : date('n');

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
	
    $brules["{PRIV_YEAR}"]  = $priv_year;
    $brules["{PRIV_MONTH}"] = $priv_month;
    $brules["{YEAR}"]       = $year;
    $brules["{MONTH}"] 	    = $o_other->getMonthAb($month);
    $brules["{NEXT_YEAR}"]  = $next_year;
    $brules["{NEXT_MONTH}"] = $next_month;
    
    $date = getdate(mktime(0, 0, 0, $month, 1, $year));
	$date['kolday'] = date('t', mktime(0, 0, 0, $month, 1, $year));
	
	if (!$date['wday']) $date['wday'] = 7;
	$brules["{FIRST}"] = ($date['wday']!=1) ? $date['wday'] * 15 + ($date['wday'] - 1) * 8 : 15;
	$h = $date['wday'];
	
	$brules["{DAYS}"] = ($o_news->checkNewsOnDate($year, $month, 1)) ? "<a href='index.php?m=arhnews&amp;year=$year&amp;mon=$month&amp;day=1'>1</a></p>" : "1</p>";
	if ($h % 7==0) $brules["{DAYS}"] .= "</div><div>";
	for ($i = 2; $i <= $date['kolday']; $i++) {
    	$brules["{DAYS}"] .= ($o_news->checkNewsOnDate($year, $month, $i)) ? "<p><a href='index.php?m=arhnews&amp;year=$year&amp;mon=$month&amp;day=$i'>$i</a></p>" : "<p>$i</p>";
    	$h++;
		if ($h % 7==0) $brules["{DAYS}"] .= ($i!=$date['kolday']) ? "</div><div>" : "";     	
	}		
		
	$blocks = $o_tpl->gethtml(BLOCK_TEMPLATES_DIR."/calendar1.tpl", $brules);
	
	unset($brules);
	        
?>
