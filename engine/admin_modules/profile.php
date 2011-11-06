<?php
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
*/
	include(CLASSES."/news.class.php");
	include(CLASSES."/comments.class.php");
	
	$o_news     = new news($o_mysql);
	$o_comments = new comments($o_mysql);
	
		
		$sw = false;
			$sw = true;
				
			$result = $o_users->update($ID, $login, $email, "", $usersgroup, $banned, $allow_mail, $avatar, $avatar_name, $avatar_size, $del_avatar, $fullname, $land, $icq, $info, $allowed_ip);
			
			if ($result && strlen($pass) >= 5 && $o_users->check($pass, RE_PASSWORD) && $o_users->check($old_pass, RE_PASSWORD))
				
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
	        else $MESS = $o_other->showMessA($LANG[$m.'_eedit'], 1);   
    	
    		$mrules["{TITLEE}"] = $LANG[$m];
    		
    		$mrules["{NAME1}"]      = $o_users->getOne($ID, "name");
    		$mrules["{NAME}"]       = $login;
		    $mrules["{NEWS_NUM}"]   = $o_news->getKolUserNews($o_users->getOne($ID, "news_num"));
		
			$mrules["{DEL_AVATAR_CHE}"] = ($del_avatar) ? "checked=\"checked\"" : "";
			$mrules["{DEL_AVATAR_DIS}"] = (!$o_users->getOne($ID, "avatar")) ? "disabled=\"disabled\"" : "";
	   		$mrules["{ALLOW_MAIL_YES}"] = ($allow_mail)  ? "checked=\"checked\"" : "";
	    	        	
        	$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);
            $MESS = $o_other->showMessA($LANG['wrong_input'], 1);
    	}	
	
	if (!isset($action) || $sw) {
        $result = $o_users->get($ID);
    	foreach ($result as $n);  
    	
    	$mrules["{TITLEE}"] = $LANG[$m];      	
    	$mrules["{NAME1}"]      = $n[1];        	
        $mrules["{NEWS_NUM}"]   = $o_news->getKolUserNews($n[0]);
		
		$mrules["{DEL_AVATAR_CHE}"] = "";
		$mrules["{DEL_AVATAR_DIS}"] = (!$n[9]) ? "disabled=\"disabled\"" : "";		
   		$mrules["{ALLOW_MAIL_YES}"] = ($n[8])  ? "checked=\"checked\"" : "";