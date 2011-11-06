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
// Файл: vote.php
//-----------------------------------------------------------------------------/
// Назначение: Блок голосований
//=============================================================================/
*/
	
	if (!defined("OLE")) die("<script>window.location = \"./\"</script>");
        
    if (!isset($o_vote)) {
    	include(CLASSES ."/vote.class.php");
    	$o_vote = new vote($o_mysql);
    }
    if (!isset($o_categories)) {
    	include(CLASSES ."/categories.class.php");
    	$o_categories = new categories($o_mysql);
    }
    if (!isset($o_bbcodes)) {
    	include(CLASSES ."/bbcodes.class.php");
    	$o_bbcodes = new bbcodes($o_mysql);
    }
	
	$h = 0;
	if ($o_vars->get['id'] && $o_categories->get($o_vars->get['id']) && $o_vars->get['m']=="categories") $h = $o_vars->get['id'];
	
	$result1 = $o_vote->getS($h, $ID);
    
    if ($result1) {
       	foreach ($result1 as $n1);
        $brules["{TITLE}"] = $n1[2];
		$brules["{ID}"]    = $n1[0];
		$a = explode("\n", $n1[7]);
		$brules["{VOTES}"] = "<input type=\"radio\" name=\"vote\" onclick=\"vote_help=1;\" checked=\"checked\" /> ".$o_bbcodes->filter($a[0])."<br />";
		for ($i = 1; $i < count($a); $i++)
			$brules["{VOTES}"] .= "<input type=\"radio\" name=\"vote\" onclick=\"vote_help=".($i+1).";\" /> ".$o_bbcodes->filter($a[$i])."<br />";
		
		$blocks = $o_tpl->gethtml(BLOCK_TEMPLATES_DIR."/vote1.tpl", $brules);
		
		unset($brules);
	}
	else $blocks = $LANG['vote_egets'];	
	
?>
