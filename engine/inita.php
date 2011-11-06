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
// Файл: ainit.php
//-----------------------------------------------------------------------------/
// Назначение: Инициализация пользователя (админка)
//=============================================================================/
*/

    if (!defined("OLE")) die("<script>window.location = \"./\"</script>");
    
    include(CLASSES."/users.class.php");
    include(CLASSES."/usersgroup.class.php");
  	
  	$o_users      = new users($o_mysql);
	$o_usersgroup = new usersgroup($o_mysql);
      	  	
	if (isset($o_vars->post['password']) && isset($o_vars->post['name'])) {
		
		$result = $o_users->chNPInLogCoockSess($o_vars->post['name'], md5(md5($o_vars->post['password'])));
	
		if ($result) {
		    $ID = $o_users->getId($o_vars->post['name']);
    		if (!$o_users->getOne($ID, "banned") && $o_users->allowedIp($ID, IP) && $o_usersgroup->getOne($o_users->getOne($ID, "usersgroup"), "allow_admin")) {
    		 	
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
			else {
				$MESS1 = $o_other->showMessA($LANG['eaccess'], 1);
				$ID = 0;
			}
		}
		else $MESS1 = $o_other->showMessA($LANG['einlogpass'], 1);
	}
	
	if (!$ID) {
	    if ($_SESSION['name'] && $_SESSION['password']) {
			if ($o_users->chNPInLogCoockSess($_SESSION['name'], $_SESSION['password'])) {
				$ID = $o_users->getId($_SESSION['name']); 
	    		if ($o_users->getOne($ID, "banned") || !$o_users->allowedIp($ID, IP) || !$o_usersgroup->getOne($o_users->getOne($ID, "usersgroup"), "allow_admin")) $ID = 0;			}
	    }
		elseif ($_COOKIE['name'] && $_COOKIE['password']) { 
			if ($o_users->chNPInLogCoockSess($_COOKIE['name'], $_COOKIE['password'])) {
				$ID = $o_users->getId($_COOKIE['name']); 
	    		if ($o_users->getOne($ID, "banned") || !$o_users->allowedIp($ID, IP) || !$o_usersgroup->getOne($o_users->getOne($ID, "usersgroup"), "allow_admin")) $ID = 0;			} 
	    }
	}
	
	if (isset($o_vars->get['logout']) && ($_SESSION['name'] || $_SESSION['password'] || $_COOKIE['name'] || $_COOKIE['password'])) { 
		setcookie("name", "", time()-(365*86400));
		setcookie("password", "", time()-(365*86400));
		@session_destroy();
		@session_unset();
 		$ID = 0; 
 		$MESS1 = $o_other->showMessA($LANG['logout']);
	}
			
	if ($ID) {
	
		$o_users->updateOne($ID, "last_date", time());
		$o_users->updateOne($ID, "last_ip", IP);
				
		$result = $o_usersgroup->get($o_users->getOne($ID, "usersgroup"));
		
		if ($result) {
			foreach ($result as $n);
			$USER_RIGHTS = array(
				'id_ug'            => "$n[0]",
				'cat_add'          => "$n[3]",       
				'allow_admin'      => "$n[5]",
				'allow_adds'       => "$n[8]",    
				'moderation'       => "$n[9]",
				'allow_main'       => "$n[10]",
				'allow_edit'       => "$n[11]",
				'allow_all_edit'   => "$n[12]",
				'allow_addst'      => "$n[23]",    
				'moderationst'     => "$n[26]",
				'allow_editst'     => "$n[24]",
				'allow_all_editst' => "$n[25]",
				'allow_html'       => "$n[27]",  
			);
		}
	}
        
?>
