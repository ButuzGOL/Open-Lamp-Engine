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
// Файл: ajax.php
//-----------------------------------------------------------------------------/
// Назначение: Ajax
//=============================================================================/
*/

	include("engine/config/config.php");
	include("engine/define.php");
	include(LANG_DIR."/rassian/lindex.php");
	
	include(CLASSES ."/mysql.class.php");
	include(CLASSES ."/vars.class.php");
	include(CLASSES ."/tpl.class.php");
	include(CLASSES ."/other.class.php");
		
	$o_mysql = new mysql();
	$o_vars  = new vars();
	$o_tpl   = new tpl();
	$o_other = new other($o_mysql, $o_tpl, $LANG);
	
	$m = $o_vars->get["m"]; 

	if (ob_get_length()) ob_clean();

	header('Expires: Fri, 25 Dec 1980 00:00:00 GMT');
	header('Last-Modified: ' . gmdate( 'D, d M Y H:i:s') . 'GMT');
	header('Cache-Control: no-cache, must-revalidate');
	header('Pragma: no-cache');
	header("Content-type: text/plain; charset=UTF-8");
	
	$o_tpl->addhtml("<?xml version='1.0' encoding='UTF-8' standalone='yes'?>");
	$o_tpl->addhtml("<response>");

	if (isset($m) && !empty($m))	
			
			if (file_exists(AJAX_MODULES."/".$m.".php")) 
				include(AJAX_MODULES."/".$m.".php");
	   		else include(AJAX_MODULES."/error.php");
		
	else include(AJAX_MODULES."/error.php");

	$o_tpl->addhtml("</response>");
	
	$o_tpl->init();	
	
	$o_mysql->close();

?>
