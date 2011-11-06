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
//==============================================================================/
// Файл: lostpass.php
//------------------------------------------------------------------------------/
// Назначение: Модуль забытого пароля
//==============================================================================/
*/

	if (!defined("OLE")) die("<script>window.location = \"./\"</script>");
	
	include(CLASSES ."/email.class.php");
	
	$o_email = new email($o_mysql);
	
	$h = $o_vars->get['h'];
	
	if (isset($h)) {
		$login = $o_users->hashLostPassActiv($h);
		if ($login) {
			$pass = $o_other->makePass();
			$o_users->changePass2($o_users->getId($login), $pass);
			$o_other->showMess($LANG[$m], $LANG[$m.'_ok'].": ".$LANG['login'].":  $login ".$LANG['pass'].": $pass", "index.php", $LANG['redir_main'], TEMPLATES_DIR);
		}
		else $o_other->showMess($LANG[$m], $LANG[$m.'_eok'], "?m=$m", $LANG[$m], TEMPLATES_DIR);
	}
	else {
	
		$mrules1["{MESS}"]    = "";
		$mrules1["{LOGIN}"]   = "";
		$mrules1["{CAPTCHA}"] = ($USER_RIGHTS['captcha']) ? "<div class=\"captcha\"><img src=\"?m=captcha\" alt=\"\" /> <input type=\"text\" name=\"captcha\" maxlength=\"5\" /></div>" : "";
				
		$k = 0;
			
		$action_lostpass = $o_vars->post['action_lostpass'];
			
		if (isset($action_lostpass)) {
				
			$mrules1["{LOGIN}"] = $name = $o_vars->post['login'];
			$captcha                    = $o_vars->post['captcha'];
			
			if ($o_users->check($name) && $name!=$USER['name'] && $o_users->getId($name) && (($captcha!="" && $_SESSION['captcha']==$captcha) || !$USER_RIGHTS['captcha'])) {
					
				$hash   = $o_other->makeHash();
				$result = $o_users->hashLostPass($o_users->getId($name), $hash);
				
				$k = 1;
			}
			else $mrules1["{MESS}"] = $LANG['wrong_input'];
		}
		
		
		if (!$k) {	
			$mrules["{TITLE}"]  = $LANG[$m];
			$mrules["{MIDDLE}"] = $o_tpl->gethtml(TEMPLATES_DIR."/".$m."_middle.tpl", $mrules1);
			$o_tpl->addhtml(TEMPLATES_DIR."/default_middle.tpl", $mrules);
		}
		else {
			$mrules["{*USERNAME*}"] = $login;
			$mrules["{*LOSTLINK*}"] = URL ."/index.php?m=$m&h=". $hash;
			$mrules["{*IP*}"]       = IP;
			$mrules["{*URL*}"] 		= URL;
				
			$subj    = $LANG[$m];
			$message = $o_tpl->gethtml($o_email->get(3), $mrules);
			$headers = "From: ".$CONFIG['title']."<".$o_users->getOne(1, "email").">\r\n";
			$o_email->sendEMail($email, $subj, $message, $headers);
			$o_other->showMess($LANG[$m], $LANG[$m.'_emme'], "index.php", $LANG['redir_main'], TEMPLATES_DIR);
		}	    
    }

?>
