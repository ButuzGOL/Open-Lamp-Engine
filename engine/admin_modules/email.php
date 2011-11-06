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
// Файл: email.php
//-----------------------------------------------------------------------------/
// Назначение: Модуль управления email сообщениями (админка)
//=============================================================================/
*/    if (!defined("OLE")) die("<script>window.location = \"./\"</script>");						if ($USER_RIGHTS['id_ug']==1) {		
		include(CLASSES."/email.class.php");
		
		$o_email = new email($o_mysql);
				$action = $o_vars->post['action'];			    if (isset($action)) {		
			$sw = false;
						$reg_email  = stripslashes(htmlspecialchars(strip_tags($o_vars->post['reg_email']), ENT_QUOTES));		 	$ofs_email  = stripslashes(htmlspecialchars(strip_tags($o_vars->post['ofs_email']), ENT_QUOTES));			$lopa_email = stripslashes(htmlspecialchars(strip_tags($o_vars->post['lopa_email']), ENT_QUOTES));			$news_email = stripslashes(htmlspecialchars(strip_tags($o_vars->post['news_email']), ENT_QUOTES));							if ($reg_email!="" && $ofs_email!="" && $lopa_email!="" && $news_email!="") {
				
				$sw = true;
								$result = $o_email->update($reg_email, $ofs_email, $lopa_email, $news_email);	        	
	        	if ($result) $MESS = $o_other->showMessA($LANG[$m.'_edit']);
	            else $MESS = $o_other->showMessA($LANG[$m.'_eedit'], 1);	        }	        else {
	        	
	        	$mrules["{TITLEE}"] = $LANG[$m];
	    	    				$mrules["{REG_EMAIL}"]  = $reg_email;				$mrules["{OFS_EMAIL}"]  = $ofs_email; 			   					$mrules["{LOPA_EMAIL}"] = $lopa_email;				$mrules["{NEWS_EMAIL}"] = $news_email;			
				$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);
	        	$MESS = $o_other->showMessA($LANG['wrong_input'], 1);
	        }		}
		
		if (!isset($action) || $sw) { 
	    	
	    	$mrules["{TITLEE}"] = $LANG[$m];
	    	    			$mrules["{REG_EMAIL}"]  = $o_email->get(1);			$mrules["{OFS_EMAIL}"]  = $o_email->get(2); 			   				$mrules["{LOPA_EMAIL}"] = $o_email->get(3);			$mrules["{NEWS_EMAIL}"] = $o_email->get(4);			
			$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);	    }    }	else $MESS1 = $o_other->showMessA($LANG['eaccess'], 1);?>
