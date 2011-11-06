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
// Файл: profile.php
//-----------------------------------------------------------------------------/
// Назначение: Модуль управления и вывода профеля пользователя
//=============================================================================/
*/

	if (!defined("OLE")) die("<script>window.location = \"./\"</script>");
	
	include(CLASSES ."/email.class.php");
	include(CLASSES ."/pm.class.php");
	include(CLASSES ."/comments.class.php");
	include(CLASSES ."/news.class.php");
	
	$o_email 	= new email($o_mysql);
	$o_pm 		= new pm($o_mysql);
	$o_comments = new comments($o_mysql);
	$o_news 	= new news($o_mysql);
	
	$id = $o_vars->get['id'];
	
	$mrules["{TITLE}"]  = $LANG[$m]. $o_users->getOne($id, "name");
	$mrules["{MIDDLE}"] = "";
	
	$mrules1["{DISP_EM}"]     = "none";
	$mrules1["{DISP_PM}"]     = "none";
	$mrules1["{DISP_RP}"]     = "none";
	$mrules1["{MESS}"]        = "";
	$mrules1["{SUBJ}"]        = "";
	$mrules1["{TEXT}"]        = "";
	$mrules1["{TEXT1}"]       = "";  
	$mrules1["{SUBJ1}"]       = "";
	$mrules1["{IS_DEL_FROM}"] = "checked=\"checked\"";  
    	
	$allow_mail = "";
	
	if ($ID && $id!=$ID && $o_users->getOne($id, "allow_mail")) $action_em = $o_vars->post["action_em"];
	if ($ID && $ID!=$id && $o_usersgroup->getOne($o_users->getOne($id, "usersgroup"), "allow_pm")) $action_pm = $o_vars->post["action_pm"];
	if ($ID && $ID==$id) $action_rp = $o_vars->post["action_rp"];
	
	if (isset($action_em)) {
		
	 	$mrules1["{SUBJ1}"] = $subj = stripslashes(htmlspecialchars(strip_tags($o_vars->post['subj1']), ENT_QUOTES));
		$mrules1["{TEXT1}"] = $text = stripslashes(htmlspecialchars(strip_tags($o_vars->post['text1']), ENT_QUOTES));
		
		if ($text!="" && $subj!="") {
			
			$mrules2["{*USERNAME_TO*}"]   = $o_users->getOne($id, "name");
			$mrules2["{*USERNAME_FROM*}"] = $o_users->getOne($ID, "name");
			$mrules2["{*TEXT*}"]          = $text;
			$mrules2["{*IP*}"]            = IP;
			$mrules2["{*URL*}"]           = URL;
			
			$subj    = $subj;	
			$message = $o_tpl->gethtml($o_email->get(2), $mrules2);
			$headers = "From: ".$CONFIG['title']."<".$o_users->getOne(1, "email").">\r\n";
			$o_email->sendEMail($email, $subj, $message, $headers);
				
			$mrules1["{MESS}"]    = $LANG[$m.'_email'];
			$mrules1["{DISP_EM}"] = "none";
			
			$mrules1["{SUBJ1}"] = "";
			$mrules1["{TEXT1}"] = "";
				
        }
        else {
			$mrules1["{MESS}"]    = $LANG['wrong_input'];
            $mrules1["{DISP_EM}"] = "";
        }
	}
	
	if (isset($action_pm)) {
		
	 	$mrules1["{SUBJ}"] = $subj = stripslashes(htmlspecialchars(strip_tags($o_vars->post['subj']), ENT_QUOTES));
		$user_id   				   = $id;
		$user_from 				   = $ID;
		$mrules1["{TEXT}"] = $text = stripslashes(htmlspecialchars(strip_tags($o_vars->post['text']), ENT_QUOTES));
		$is_del_from			   = ($o_vars->post['is_del_from']) ? 0 : 1;
		$mrules1["{IS_DEL_FROM}"]  = (!$is_del_from) ? "checked=\"checked\"" : "";
	
	
		if ($subj!="" && $text!="") {
			$result = $o_pm->add($subj, $text, $user_id, $user_from, time(), 0, 0, $is_del_from, $o_users->getOne($user_from, "name"), $o_users->getOne($user_id, "name"));
				
			$mrules1["{MESS}"]    = $LANG[$m.'_pm'];
			$mrules1["{DISP_PM}"] = "none";
			
			$mrules1["{SUBJ}"] = "";
			$mrules1["{TEXT}"] = "";
				
        }
        else {
			$mrules1["{MESS}"]    = $LANG['wrong_input'];
            $mrules1["{DISP_PM}"] = "";
        }
	}
		
	if (isset($action_rp)) {
		
	 	$id         = $ID;
		$login      = $o_users->getOne($id, "name");
		$email      = $o_vars->post['email'];
		$old_pass   = $o_vars->post['pass'];
		$pass   	= $o_vars->post['pass2'];
		$usersgroup = $o_users->getOne($id, "usersgroup");
		$banned     = $o_users->getOne($id, "banned");
		$allow_mail = intval($o_vars->post['allow_mail']);
		$fullname 	= stripslashes(htmlspecialchars(strip_tags($o_vars->post['fullname']), ENT_QUOTES));
		$land	    = stripslashes(htmlspecialchars(strip_tags($o_vars->post['land']), ENT_QUOTES));
		$icq		= stripslashes(htmlspecialchars(strip_tags($o_vars->post['icq']), ENT_QUOTES));
		$info 	    = stripslashes(htmlspecialchars(strip_tags($o_vars->post['info']), ENT_QUOTES));			
    	$allowed_ip = $o_other->filterIp($o_vars->post['allowed_ip']);
		$del_avatar = $o_vars->post['del_avatar'];
		
		$avatar      = $_FILES['avatar']['tmp_name'];
    	$avatar_name = $_FILES['avatar']['name'];
		$avatar_size = $_FILES['avatar']['size'];
	    
	    if ($o_users->check($login) && $o_other->check($email, RE_MAIL)) {			
			$result = $o_users->update($id, $login, $email, "", $usersgroup, $banned, $allow_mail, $avatar, $avatar_name, $avatar_size, $del_avatar, $fullname, $land, $icq, $info, $allowed_ip);
			
			if ($result && strlen($pass) >= 5 && $o_users->check($pass, RE_PASSWORD) && $o_users->check($old_pass, RE_PASSWORD))				$result1 = $o_users->changePass($id, $old_pass, $pass);
				
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
					        	if ($result && $result1) {
        		$mrules1["{MESS}"]    = $LANG[$m.'_rp'];
            	$mrules1["{DISP_RP}"] = "none";
        	}	        else {
	        	$mrules1["{MESS}"]    = $LANG[$m.'_erp'];
            	$mrules1["{DISP_RP}"] = "";    		}
    	}    	else {
			$mrules1["{MESS}"]    = $LANG['wrong_input'];
            $mrules1["{DISP_RP}"] = "";
        }
	}	    	
	$result = $o_users->get($id);
		
	if (!$result) $o_other->showMess($LANG[$m], $LANG[$m.'_eget'], "index.php", $LANG['redir_main'], TEMPLATES_DIR);
	else {	
		
		foreach ($result as $n);
		
		$mrules1["{AVATAR}"]     = (!$n[9]) ? AVATARS_DIR."/0.png" : AVATARS_DIR."/".$n[9];
		$mrules1["{BANNED}"]     = ($n[7])  ? $LANG['yes'] : $LANG['no'];
		$mrules1["{NAME}"]       = $n[1];
		$mrules1["{REG_DATE}"]   = $o_other->makeNormalDate($n[5]);
		$mrules1["{LAST_DATE}"]  = $o_other->makeNormalDate($n[4]);
		$mrules1["{LAST_IP}"]    = $n[17];
		$mrules1["{KOL_COMM}"]   = $o_comments->getKolUserComm($n[0]);
		$mrules1["{KOL_NEWS}"]   = $o_news->getKolUserNews($n[0]);
		$mrules1["{USERSGROUP}"] = $o_usersgroup->getOne($n[5], "group_name");
		$mrules1["{FULLNAME}"]   = (!$fullname) ? $n[10] : $fullname;
		$mrules1["{LAND}"]       = (!$land)     ? $n[11] : $land;
		$mrules1["{ICQ}"]        = (!$icq)      ? $n[12] : $icq;
		$mrules1["{INFO}"]       = (!$info)     ? $n[13] : $info;
		$mrules1["{FULLNAME1}"]  = $n[10];
		$mrules1["{LAND1}"]      = $n[11];
		$mrules1["{ICQ1}"]       = $n[12];
		$mrules1["{INFO1}"]      = $n[13];
		
		if ($ID!=$id) $mrules1["{EMAIL}"] = "";
		else $mrules1["{EMAIL}"] = (!$email) ? $n[2]  : $email;
    	
    	$mrules1["{ALLOWED_IP}"] = (!$allowed_ip) ? $n[14] : $allowed_ip;
    	
    	if ($allow_mail=="") {
    	    $mrules1["{ALLOW_MAIL_YES}"] = ($n[8])  ? "checked=\"checked\"" : "";
		    $mrules1["{ALLOW_MAIL_NO}"]  = (!$n[8]) ? "checked=\"checked\"" : "";
		}
		else {
		     $mrules1["{ALLOW_MAIL_YES}"] = ($allow_mail)  ? "checked=\"checked\"" : "";
		     $mrules1["{ALLOW_MAIL_NO}"]  = (!$allow_mail) ? "checked=\"checked\"" : "";
		}
		
		$mrules1["{BANNED_IP}"] = $n[7];
		
		$mrules1["{ALLOW_RP}"] = ($id==$ID)                                    ? "" : "_dis"; 
		$mrules1["{ALLOW_EM}"] = ($id!=$ID && $n[8] && $ID)                    ? "" : "_dis"; 
		$mrules1["{ALLOW_PM}"] = ($ID && $ID!=$id && $USER_RIGHTS['allow_pm']) ? "" : "_dis"; 
		
    	$mrules["{MIDDLE}"] = $o_tpl->gethtml(TEMPLATES_DIR."/".$m."_middle.tpl", $mrules1);
	
		$o_tpl->addhtml(TEMPLATES_DIR."/default_middle.tpl", $mrules);
	}
?>
