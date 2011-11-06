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
// Файл: registr.php
//-----------------------------------------------------------------------------/
// Назначение: Модуль регистрации пользователей
//=============================================================================/
*/

	if (!defined("OLE")) die("<script>window.location = \"./\"</script>");
	
	include(CLASSES ."/email.class.php");
	
	$o_email = new email($o_mysql);
	
	$h = $o_vars->get['h'];
	
	if (isset($h)) {
		if ($o_users->hashActiv($h)) $o_other->showMess($LANG[$m], $LANG[$m.'_ok'], "index.php", $LANG['redir_main'], TEMPLATES_DIR);
		else $o_other->showMess($LANG[$m], $LANG[$m.'_eok'], "?m=$m", $LANG[$m], TEMPLATES_DIR); 
	}
	
	if ((($CONFIG['allow_reg'] && ($CONFIG['users_kol'] >= $o_users->getKol() || $CONFIG['users_kol']==0)) || $o_vars->post['action_reg']) && !isset($h)) {
	
		$mrules1["{LOGIN}"]    = "";
		$mrules1["{EMAIL}"]    = "";
		$mrules1["{MESS}"]     = "";
		$mrules1["{CAPTCHA}"] = ($USER_RIGHTS['captcha']) ? "<div class=\"captcha\"><img src=\"?m=captcha\" alt=\"\" /> <input type=\"text\" name=\"captcha\" maxlength=\"5\" /></div>" : "";
		
		$k = 0;
		
		$action_reg = $o_vars->post['action_reg'];
		
		if (isset($action_reg)) {
			
			$mrules1["{LOGIN}"] = $login = $o_vars->post['login'];
			$pass                        = $o_vars->post['pass'];
			$pass2                       = $o_vars->post['pass2'];
			$mrules1["{EMAIL}"] = $email = $o_vars->post['email'];
			$captcha                     = strip_tags($o_vars->post['captcha']);
		
			if ($o_other->check($email, RE_MAIL) && $o_users->check($login) && $pass2!="" && $pass==$pass2 && strlen($pass) >= 5 && $o_users->check($pass, RE_PASSWORD) && (($captcha!="" && $_SESSION['captcha']==$captcha) || !$USER_RIGHTS['captcha'])) {
				$hash   = ($CONFIG['send_regemail']) ? $o_other->makeHash() : ""; 
				$result = $o_users->add($login, $email, md5(md5($pass)), time(), $CONFIG['reg_group'], time(), 0, 1, "", "", "", "", "", "", $hash, IP);
				
				if (!$result) $mrules1["{MESS}"] = $LANG[$m.'_eadd'];
				else $k = 1;
			}
			else $mrules1["{MESS}"] = $LANG['wrong_input'];
		}
		
		
		if (!$k) {	
			$mrules["{TITLE}"]  = $LANG[$m];
			$mrules["{MIDDLE}"] = $o_tpl->gethtml(TEMPLATES_DIR."/".$m."_middle.tpl", $mrules1);
			$o_tpl->addhtml(TEMPLATES_DIR."/default_middle.tpl", $mrules);
		}
		else 
			{
			if (!$CONFIG['send_regemail']) $o_other->showMess($LANG[$m], $LANG[$m.'_add'], "index.php", $LANG['redir_main'], TEMPLATES_DIR);
			else {			
				$mrules["{*USERNAME*}"]       = $login;
				$mrules["{*VALIDATIONLINK*}"] = URL ."/index.php?m=$m&h=$hash";
				$mrules["{*PASSWORD*}"]       = $pass;
				$mrules["{*URL*}"]            = URL;
				
				$subj    = $LANG[$m];
				$message = $o_tpl->gethtml($o_email->get(1), $mrules);
				$headers = "From: ".$CONFIG['title']."<".$o_users->getOne(1, "email").">\r\n";
				$o_email->sendEMail($email, $subj, $message, $headers);
				$o_other->showMess($LANG[$m], $LANG[$m.'_emme'], "index.php", $LANG['redir_main'], TEMPLATES_DIR);
			}	
		}
	}
	elseif (!isset($h)) $o_other->showMess($LANG[$m], $LANG[$m.'_admax'], "index.php", $LANG['redir_main'], TEMPLATES_DIR);
	
?>
