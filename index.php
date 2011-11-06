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
// Файл: index.php
//-----------------------------------------------------------------------------/
// Назначение: Старт
//=============================================================================/
*/

	@session_start();
	@ob_start(); 
	@ob_implicit_flush(0); 
	
    @error_reporting(E_ALL ^ E_NOTICE);
    @ini_set('display_errors', true);
    @ini_set('html_errors', false);
    @ini_set('error_reporting', E_ALL ^ E_NOTICE);
    @ini_set('session.bug_compat_warn', false);
        
    if (!file_exists("engine/config/config.php")) 
    	die("<script>window.location = \"./install\"</script>");
			
	include("engine/config/config.php");
	include("engine/define.php");
	include(LANG_DIR."/rassian/lindex.php");
	
	include(CLASSES."/tpl.class.php");
    $o_tpl = new tpl();
	
	if (!$CONFIG['site_onoff']) {
		$o_tpl->messCs($CONFIG['title'] ." - " .$LANG['cs_onoff'], 
					   $LANG['cs_onoff'], $CONFIG['site_monoff'], 
					   $CONFIG['charset']);
		die();
	}
	
	include(CLASSES."/mysql.class.php");
	$o_mysql = new mysql();
	if (!$o_mysql->online()) {
		$o_tpl->messCs($CONFIG['title'] ." - " .$LANG['cs_mysql'], 
					   $LANG['cs_mysql'], $LANG['cs_mmysql'], 
					   $CONFIG['charset']);
		die();
	}
	
	include(CLASSES."/bannedip.class.php");
	$o_bannedip = new bannedip($o_mysql);
	if ($o_bannedip->checkIsBann(IP)) {
		$o_tpl->messCs($CONFIG['title'] ." - " .$LANG['cs_ip'], $LANG['cs_ip'], 
					   $LANG['cs_mip'], $CONFIG['charset']);
    	$o_mysql->close();
    	die();
    }
    
	include(CLASSES ."/vars.class.php");
	include(CLASSES ."/other.class.php");
		 
	$o_vars  = new vars();
	$o_other = new other($o_mysql, $o_tpl, $LANG);
    
    $o_tpl->header = $o_tpl->gethtml(TEMPLATES_DIR."/header.tpl");
    $o_tpl->footer = $o_tpl->gethtml(TEMPLATES_DIR."/footer.tpl");
    	        		
	include("engine/init.php");
				
	$m = $o_vars->get["m"]; 
	
	if (isset($m) && !empty($m))
		if (file_exists(MODULES."/".$m.".php"))	include(MODULES."/".$m.".php");
	   	else include(MODULES."/error.php");
	else include(MODULES."/start.php");

	include("engine/blocks.php");
			
	$rules["{THEME}"] 	       = TEMPLATES_DIR;
	$rules["{BLOCK_TEMPLATE}"] = BLOCK_TEMPLATES_DIR;
	
 	$rules["{TITLE}"]    = ($TITLE)    ? $TITLE    : $CONFIG['title'];
	$rules["{DESCR}"]    = ($DESCR)    ? $DESCR    : $CONFIG['descr'];
	$rules["{KEYWORDS}"] = ($KEYWORDS) ? $KEYWORDS : $CONFIG['keywords'];
	$rules["{AUTOR}"]    = $CONFIG['autor'];
	$rules["{CHARSET}"]  = $CONFIG['charset'];
		
	$rules["{HTITLE}"] = $CONFIG['title'];
	$rules["{HDESCR}"] = $CONFIG['descr'];
	$rules["{HURL}"]   = URL;
		
	$o_tpl->init($rules);
	
	$o_mysql->close();

?>
