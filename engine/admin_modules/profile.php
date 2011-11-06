<?php/*
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
// Файл: profile.php
//-----------------------------------------------------------------------------/
// Назначение: Модуль управления профелем пользователя (админка)
//=============================================================================/
*/    if (!defined("OLE")) die("<script>window.location = \"./\"</script>");	
	include(CLASSES."/news.class.php");
	include(CLASSES."/comments.class.php");
	
	$o_news     = new news($o_mysql);
	$o_comments = new comments($o_mysql);
		$a = $o_vars->get['a'];				$action = $o_vars->post['action'];			if (isset($action)) {
		
		$sw = false;				$login      = ($ID==1) ? $o_vars->post['login'] : $o_users->getOne($ID, "name");		$email      = $o_vars->post['email'];		$old_pass   = $o_vars->post['old_password'];		$pass       = $o_vars->post['password'];		$usersgroup = $o_users->getOne($ID, "usersgroup");		$banned   	= $o_users->getOne($ID, "banned");		$allow_mail = intval($o_vars->post['allow_mail']);		$fullname 	= stripslashes(htmlspecialchars(strip_tags($o_vars->post['fullname']), ENT_QUOTES));		$land	    = stripslashes(htmlspecialchars(strip_tags($o_vars->post['land']), ENT_QUOTES));		$icq		= stripslashes(htmlspecialchars(strip_tags($o_vars->post['icq']), ENT_QUOTES));		$info 	    = stripslashes(htmlspecialchars(strip_tags($o_vars->post['info']), ENT_QUOTES));			    	$allowed_ip = $o_other->filterIp($o_vars->post['allowed_ip']);		$del_avatar = $o_vars->post['del_avatar'];				$avatar      = $_FILES['avatar']['tmp_name'];    	$avatar_name = $_FILES['avatar']['name'];		$avatar_size = $_FILES['avatar']['size'];								if ($o_users->check($login) && $o_other->check($email, RE_MAIL) && $ID) {			
			$sw = true;
				
			$result = $o_users->update($ID, $login, $email, "", $usersgroup, $banned, $allow_mail, $avatar, $avatar_name, $avatar_size, $del_avatar, $fullname, $land, $icq, $info, $allowed_ip);
			
			if ($result && strlen($pass) >= 5 && $o_users->check($pass, RE_PASSWORD) && $o_users->check($old_pass, RE_PASSWORD))				$result1 = $o_users->changePass($ID, $old_pass, $pass);
				
			if ($result) {
				
				setcookie("name", "", time()-(365*86400));
				setcookie("password", "", time()-(365*86400));
				@session_destroy();
				@session_unset();
				
				$name     = $login;
    		 	$password = ($result1) ? md5(md5($pass)) : $o_users->getOne($ID, "password");
    		 	@session_register("name");	
    		 	@session_register("password");	
				if (!$CONFIG['allow_renter']) {
    		 	    setcookie("name", $name, time()+(365*86400));
		            setcookie("password", $password, time()+(365*86400));
    		 	}
			}
		
			if ($pass=="" && $old_pass=="") $result1 = true;
			
			if ($result && $result1) $MESS = $o_other->showMessA($LANG[$m.'_edit']);
	        else $MESS = $o_other->showMessA($LANG[$m.'_eedit'], 1);       	}    	else {
    	
    		$mrules["{TITLEE}"] = $LANG[$m];
    		
    		$mrules["{NAME1}"]      = $o_users->getOne($ID, "name");
    		$mrules["{NAME}"]       = $login;		    $mrules["{EMAIL}"]      = $email;		    $mrules["{FULLNAME}"]   = $fullname;			$mrules["{LAND}"]       = $land;			$mrules["{ICQ}"]        = $icq;			$mrules["{INFO}"]       = $info;			$mrules["{ALLOWED_IP}"] = $allowed_ip;			$mrules["{USERGROUP}"]  = $o_usersgroup->getOne($o_users->getOne($ID, "usersgroup"), "group_name");			$mrules["{REG_DATE}"]   = $o_other->makeNormalDate($o_users->getOne($ID, "reg_date"));
		    $mrules["{NEWS_NUM}"]   = $o_news->getKolUserNews($o_users->getOne($ID, "news_num"));		    $mrules["{COMM_NUM}"]   = $o_comments->getKolUserComm($ID);					$mrules["{AVATAR}"] = (!$o_users->getOne($ID, "avatar")) ? AVATARS_DIR."/0.png" : AVATARS_DIR."/".$o_users->getOne($ID, "avatar");
		
			$mrules["{DEL_AVATAR_CHE}"] = ($del_avatar) ? "checked=\"checked\"" : "";
			$mrules["{DEL_AVATAR_DIS}"] = (!$o_users->getOne($ID, "avatar")) ? "disabled=\"disabled\"" : "";					
	   		$mrules["{ALLOW_MAIL_YES}"] = ($allow_mail)  ? "checked=\"checked\"" : "";			$mrules["{ALLOW_MAIL_NO}"]  = (!$allow_mail) ? "checked=\"checked\"" : "";					$mrules["{NAME_DIS}"] = ($ID!=1) ? "disabled=\"disabled\"" : "";
	    	        	
        	$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);
            $MESS = $o_other->showMessA($LANG['wrong_input'], 1);
    	}		}
	
	if (!isset($action) || $sw) {                
        $result = $o_users->get($ID);    	
    	foreach ($result as $n);  
    	
    	$mrules["{TITLEE}"] = $LANG[$m];      	    	
    	$mrules["{NAME1}"]      = $n[1];        	        $mrules["{NAME}"]       = $n[1];        $mrules["{EMAIL}"]      = $n[2];        $mrules["{FULLNAME}"]   = $n[10];		$mrules["{LAND}"]       = $n[11];		$mrules["{ICQ}"]        = $n[12];		$mrules["{INFO}"]       = $n[13];		$mrules["{ALLOWED_IP}"] = $n[14];		$mrules["{USERGROUP}"]  = $o_usersgroup->getOne($n[5], "group_name");		$mrules["{REG_DATE}"]   = $o_other->makeNormalDate($n[6]);
        $mrules["{NEWS_NUM}"]   = $o_news->getKolUserNews($n[0]);        $mrules["{COMM_NUM}"]   = $o_comments->getKolUserComm($n[0]);				$mrules["{AVATAR}"] = ($n[9])  ? AVATARS_DIR."/".$n[9] : AVATARS_DIR ."/0.png";	
		
		$mrules["{DEL_AVATAR_CHE}"] = "";
		$mrules["{DEL_AVATAR_DIS}"] = (!$n[9]) ? "disabled=\"disabled\"" : "";							
   		$mrules["{ALLOW_MAIL_YES}"] = ($n[8])  ? "checked=\"checked\"" : "";		$mrules["{ALLOW_MAIL_NO}"]  = (!$n[8]) ? "checked=\"checked\"" : "";				$mrules["{NAME_DIS}"] = ($ID!=1) ? "disabled=\"disabled\"" : "";								$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);	} 	?>
