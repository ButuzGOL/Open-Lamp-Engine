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
// Файл: init.php
//-----------------------------------------------------------------------------/
// Назначение: Инициализация пользователя
//=============================================================================/
*/

    if (!defined("OLE")) die("<script>window.location = \"./\"</script>");
    
    include(CLASSES."/users.class.php");
    include(CLASSES."/usersgroup.class.php");
    
    $o_usersgroup = new usersgroup($o_mysql);
	$o_users      = new users($o_mysql);
	
	if (isset($o_vars->post['password']) && isset($o_vars->post['name'])) {
		
		$result = $o_users->chNPInLogCoockSess($o_vars->post['name'], md5(md5($o_vars->post['password'])));
	
		if ($result) {
		    $ID = $o_users->getId($o_vars->post['name']);
    		if (!$o_users->getOne($ID, "banned") && $o_users->allowedIp($ID, IP)) {
    		 	
    		 	$name     = $o_vars->post['name'];
    		 	$password = md5(md5($o_vars->post['password']));
    		 	@session_destroy();
    		 	@session_register("name");	
    		 	@session_register("password");	
				if (!$CONFIG['allow_renter']) {
    		 	    setcookie("name", $name, time()+(365*86400));
		            setcookie("password", $password, time()+(365*86400));
    		 	}
			}
			else $ID = 0;
		}
	}
	
	if (!$ID) {
	    if ($_SESSION['name'] && $_SESSION['password']) {
			if ($o_users->chNPInLogCoockSess($_SESSION['name'], $_SESSION['password'])) {
				$ID = $o_users->getId($_SESSION['name']); 
	    		if ($o_users->getOne($ID, "banned") || !$o_users->allowedIp($ID, IP)) $ID = 0;			
	    	}
	    }
		elseif ($_COOKIE['name'] && $_COOKIE['password']) { 
			if ($o_users->chNPInLogCoockSess($_COOKIE['name'], $_COOKIE['password'])) {
				$ID = $o_users->getId($_COOKIE['name']); 
	    		if ($o_users->getOne($ID, "banned") || !$o_users->allowedIp($ID, IP)) $ID = 0;			
	    	} 
	    }
	}
	
	if (isset($o_vars->get['logout']) && ((isset($_SESSION['name']) && isset($_SESSION['password'])) || (isset($_COOKIE['name']) && isset($_COOKIE['password'])))) { 
		setcookie("name", "", time()-(365*86400));
		setcookie("password", "", time()-(365*86400));
		@session_destroy();
		@session_unset();
 		$ID = 0; 
	}
		
	if ($ID) {
	
		$o_users->updateOne($ID, "last_date", time());
		$o_users->updateOne($ID, "last_ip", IP);
		
		$USERS_GROUP = $o_users->getOne($ID, "usersgroup");
		
		$result = $o_users->get($ID);
		
		if ($result) {	
			foreach ($result as $n);
			$USER = array(
				'name'       => "$n[1]",
				'email'      => "$n[2]",
				'icq'        => "$n[12]",
				'avatar'     => "$n[9]",
				);
		}
	}
	else $USERS_GROUP = $CONFIG['gost_group'];
			
	$result = $o_usersgroup->get($USERS_GROUP); 
	
	if ($result) {
		
		foreach ($result as $n);
		
		$USER_RIGHTS = array(
			'id_ug'            => "$n[0]",
			'allow_cats'       => "$n[2]",   
			'cat_add'          => "$n[3]",    
			'allow_offline'    => "$n[4]",   
			'allow_admin'      => "$n[5]",
			'allow_short'      => "$n[6]",    
			'allow_poll'       => "$n[7]",   
			'allow_adds'       => "$n[8]",    
			'moderation'       => "$n[9]",
			'allow_main'       => "$n[10]",
			'allow_edit'       => "$n[11]",
			'allow_all_edit'   => "$n[12]",
			'allow_addc'       => "$n[13]",   
			'allow_editc'      => "$n[14]",   
			'allow_delc'       => "$n[15]",   
			'captcha'          => "$n[16]",
			'edit_allc'        => "$n[17]",
			'del_allc'         => "$n[18]",   
			'allow_hide'       => "$n[19]",   
			'allow_pm'         => "$n[20]",   
			'allow_search'     => "$n[21]",   
			'allow_rating'     => "$n[22]",   
			'allow_addst'      => "$n[23]",    
			'moderationst'     => "$n[26]",
			'allow_editst'     => "$n[24]",
			'allow_all_editst' => "$n[25]",
			'allow_html'       => "$n[27]",     
		);
	}
	else {
		$USER_RIGHTS = array(
			'id_ug'            => "0",
			'allow_cats'       => "0",
			'cat_add'          => "0",
			'allow_offline'    => "0",
			'allow_admin'      => "0",
			'allow_short'      => "0",
			'allow_poll'       => "0",
			'allow_adds'       => "0",
			'moderation'       => "0",
			'allow_main'       => "0",
			'allow_edit'       => "0",
			'allow_all_edit'   => "0",
			'allow_addc'       => "0",
			'allow_editc'      => "0",
			'allow_delc'       => "0",
			'captcha'          => "1",
			'edit_allc'        => "0",
			'del_allc'         => "0",
			'allow_hide'       => "0",
			'allow_pm'         => "0",
			'allow_search'     => "0",
			'allow_rating'     => "1",
			'allow_addst'      => "0",    
			'moderationst'     => "0",
			'allow_editst'     => "0",
			'allow_all_editst' => "0",
			'allow_html'       => "0", 
		);
	}
	
?>
