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
// Файл: rate.php
//-----------------------------------------------------------------------------/
// Назначение: Модуль управления рейтингом новости (ajax)
//=============================================================================/
*/

    if (!defined("OLE")) die("<script>window.location = \"./\"</script>");
    
    include(CLASSES ."/vote.class.php");
        
    $o_vote = new vote($o_mysql);
    
    $id   = intval($o_vars->post['id']);
    $vote = intval($o_vars->post['vote']);
		
	if ($vote) $result = $o_vote->addVote(0, IP, $vote, $id);				
	
	$sum_kol = $o_vote->SumKolVotesNews($id);
	if ($sum_kol[0][1])	$pr = round($sum_kol[0][0]/$sum_kol[0][1]*17); 
	else $pr = 0;
			
	$send_text = "<ul class=\"unit-rating\"><li class=\"current-rating\" style=\"width: ".$pr."px;\">$pr</li></ul>";
		
	$send_text = str_replace("<", "[", $send_text);
	$send_text = str_replace(">", "]", $send_text);
	
	$o_tpl->addhtml($send_text);
		        
?>
