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
// Файл: email.php
//-----------------------------------------------------------------------------/
// Назначение: Модуль управления email сообщениями (админка)
//=============================================================================/
*/
		include(CLASSES."/email.class.php");
		
		$o_email = new email($o_mysql);
		
			$sw = false;
			
				
				$sw = true;
				
	        	if ($result) $MESS = $o_other->showMessA($LANG[$m.'_edit']);
	            else $MESS = $o_other->showMessA($LANG[$m.'_eedit'], 1);
	        	
	        	$mrules["{TITLEE}"] = $LANG[$m];
	    	    
				$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);
	        	$MESS = $o_other->showMessA($LANG['wrong_input'], 1);
	        }
		
		if (!isset($action) || $sw) { 
	    	
	    	$mrules["{TITLEE}"] = $LANG[$m];
	    	    
			$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);