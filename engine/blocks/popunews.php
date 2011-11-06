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
// Файл: popunews.php
//-----------------------------------------------------------------------------/
// Назначение: Блок популярных новостей
//=============================================================================/
*/

	if (!defined("OLE")) die("<script>window.location = \"./\"</script>");
	
	if (!isset($o_news)) {
    	include(CLASSES ."/news.class.php");	
    	$o_news = new news($o_mysql);
    }
		$blocks = "";
    
    $result1 = $o_news->getKP();
    if (!$result1) $blocks .= $LANG['popunews_egets'] ."<br />";
    else {
    	$k = 0;
		foreach($result1 as $n1) 
		    if ($n1[2]) {
		    	$k = 1;
		    	$n1[1] = (strlen($n1[1]) < 21) ? $n1[1] : mb_substr($n1[1], 0, 18, 'UTF-8') . '...';
			    $blocks .= "<img src=\"".BLOCK_TEMPLATES_DIR."/images/popunews.png\" style=\"padding-right:5px;\" alt=\"\" /> <a href=\"index.php?m=news&amp;id=".$n1[0]."\">".$n1[1]." (".$n1[2].")</a><br />";
		    }
		if (!$k) $blocks .= $LANG['popunews_egets'] ."<br />";
	}
		        
?>
