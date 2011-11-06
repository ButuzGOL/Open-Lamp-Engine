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
// Файл: admin.php
//-----------------------------------------------------------------------------/
// Назначение: Админ старт
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
	include(LANG_DIR."/rassian/ladmin.php");
	
	include(CLASSES."/tpl.class.php");
    $o_tpl = new tpl();
	
	include(CLASSES."/mysql.class.php");
	$o_mysql = new mysql();
	if (!$o_mysql->online()) {
		$o_tpl->messCsA($CONFIG['title'] ." - " .$LANG['cs_mysql'], $LANG['cs_mysql'], $LANG['cs_mmysql']);
		die();
	}

	include(CLASSES."/bannedip.class.php");
	$o_bannedip = new bannedip($o_mysql);
	if ($o_bannedip->checkIsBann(IP)) {
		$o_tpl->messCsA($CONFIG['title'] ." - " .$LANG['cs_ip'], $LANG['cs_ip'], $LANG['cs_mip']);
    	$o_mysql->close();
    	die();
    }
	
	include(CLASSES."/vars.class.php");
    include(CLASSES."/other.class.php");
    	
	$o_vars  = new vars();
	$o_other = new other($o_mysql, $o_tpl, 0, $LANG);	
	
	include("engine/inita.php");
		
	if (!$ID) $o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/login.tpl");
	else {
		
		$hrules["{HDESCR}"] = $CONFIG['descr'];
		
		$hrules["{USER}"]   = $o_users->getOne($ID, "name");
		$hrules["{UGROUP}"] = $o_usersgroup->getOne(
							$o_users->getOne($ID, "usersgroup"), "group_name");
		$hrules["{AVATAR}"] = (!$o_users->getOne($ID, "avatar")) ? AVATARS_DIR."/0.png" : AVATARS_DIR."/".$o_users->getOne($ID, "avatar");
			
		$o_tpl->header = $o_tpl->gethtml(ADMIN_TEMPLATES_DIR."/header.tpl", 
										 $hrules);
    	$o_tpl->footer = $o_tpl->gethtml(ADMIN_TEMPLATES_DIR."/footer.tpl");
					
		$m = $o_vars->get['m'];	
	
		if (isset($m) && !empty($m))

    		if (file_exists(ADMIN_MODULES."/".$m.".php")) include(ADMIN_MODULES."/".$m.".php");
    		else include(ADMIN_MODULES."/error.php");

		else include(ADMIN_MODULES."/start.php");
		
		$rules["{MESS}"] = ($MESS)  ? $MESS  : "";
	}
	
	$rules["{TITLE}"] = $CONFIG['title'];
	$rules["{THEME}"] = ADMIN_TEMPLATES_DIR;
	$rules["{MESS1}"] = ($MESS1) ? $MESS1 : "";
	$rules["{HURL}"]  = URL . "/". $CONFIG['adm_file'];
		
	$o_tpl->init($rules);
	
	$o_mysql->close();

?>
