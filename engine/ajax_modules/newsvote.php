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
// Назначение: Модуль управления голосованием (ajax)
//=============================================================================/
*/

    if (!defined("OLE")) die("<script>window.location = \"./\"</script>");
    
    include(CLASSES ."/vote.class.php");
    include(CLASSES ."/bbcodes.class.php");
    
    $o_vote    = new vote($o_mysql);
	$o_bbcodes = new bbcodes();
    
    $id   = intval($o_vars->post['id']);
    $vote = intval($o_vars->post['vote']);

	if ($vote) $o_vote->addVote($id, IP, $vote);

	$result = $o_vote->get($id);
	
    foreach ($result as $n);
   	$kol_vote = $o_vote->kolVotes($n[0]);
	$arules["{TITLE}"] .= $n[2];
	$a = explode("\n", $n[7]); 
	$arules["{VOTES}"] = "";
	for ($i = 0; $a[$i]; $i++) {
		$kol_answ  = $o_vote->getKolAnsw($id, $a[$i]);
		$proc_answ = ($kol_answ) ? round($kol_answ / $kol_vote*100, 2) : 0;
		$proc_gr   = ($kol_answ) ? round($proc_answ) : 1;
		$arules["{VOTES}"] .= $o_bbcodes->filter($a[$i])." - $kol_answ ($proc_answ%)<br /><img src=\"".TEMPLATES_DIR."/images/vote.png\" height=\"12\" width=\"$proc_gr%\" alt=\"$proc_gr%\" title=\"$proc_gr%\" /><br />";
	}
	$arules["{KOL_VOTE}"] = $kol_vote;
	$arules["{DATE}"]     = $o_other->makeNormalDate($n[3], 1);
	
	$send_text = $o_tpl->gethtml(TEMPLATES_DIR."/news_votea.tpl", $arules);
	 
	$send_text = str_replace("<", "[", $send_text);
	$send_text = str_replace(">", "]", $send_text);
	
	$o_tpl->addhtml($send_text);
		        
?>
