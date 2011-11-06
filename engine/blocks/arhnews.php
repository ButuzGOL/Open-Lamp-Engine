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
// Файл: arhnews.php
//-----------------------------------------------------------------------------/
// Назначение: Блок архива новостей
//=============================================================================/
*/
	
	if (!defined("OLE")) die("<script>window.location = \"./\"</script>");
        
    if (!isset($o_news)) {
    	include(CLASSES ."/news.class.php");	
    	$o_news = new news($o_mysql);
    }
    
    $blocks = "";
    
    $result1 = $o_news->getKM();
    if (!$result1) $blocks .= $LANG['arhnews_egets'] ."<br />";
    else {
		$k = 0;
		foreach($result1 as $n1) {
			if ($k==15) {$blocks .= "<b><a href=\"index.php?m=arhnews\">...</a></b><br />"; break;}	
			$blocks .= "<img src=\"".BLOCK_TEMPLATES_DIR."/images/arhnews.png\" style=\"padding-right:5px;\" alt=\"\" /> <a href=\"index.php?m=arhnews&amp;year=".$n1['year']."&amp;mon=".$n1['mon']."\">".$n1['year']." ".$o_other->getMonthAb($n1['mon'])." (".$n1['kol'].")</a><br />"; 
			$k++;
		}
	}

?>
