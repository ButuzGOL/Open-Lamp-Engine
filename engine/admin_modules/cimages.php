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
// Файл: cimages.php
//-----------------------------------------------------------------------------/
// Назначение: Модуль управления картинками мини (админка)
//=============================================================================/
*/
	if ($USER_RIGHTS['allow_edit'] || $USER_RIGHTS['allow_all_edit'] || $USER_RIGHTS['allow_add'] || $USER_RIGHTS['allow_editst'] || $USER_RIGHTS['allow_all_editst'] || $USER_RIGHTS['allow_addst']) {
		
		include(CLASSES."/images.class.php");	
		
		$o_images = new images();
	
			$sw = false;
			
		    	
		    	$mrules["{TITLEE}"] = $LANG[$m.'_fadd'];
		    	
		    	$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_add.tpl", $mrules);
		    else {
					
					$sw = true;
					
		        	if ($result) $MESS = $o_other->showMessA($LANG[$m.'_add']);
	            	else $MESS = $o_other->showMessA($LANG[$m.'_eadd'], 1); 
	            
	            	$mrules["{TITLEE}"] = $LANG[$m.'_fadd'];
	        	
	        		$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_add.tpl" , $mrules);
	        		$MESS = $o_other->showMessA($LANG['wrong_input'], 1);
	            }
		elseif ($a=="add" && (!$CONFIG['allow_dimg'] || (!$USER_RIGHTS['allow_edit'] && !$USER_RIGHTS['allow_all_edit']))) $MESS1 = $o_other->showMessA($LANG['eaccess']. " <a href=\"?m=cimages\">".$LANG[$m]."</a>", 1);
		if (!isset($a) || ($a=="add" && $sw)) {
				
					$mrules["{FULL_NAME}"] = $n['name'];
    }
    else $MESS1 = $o_other->showMessA($LANG['eaccess'], 1);	    