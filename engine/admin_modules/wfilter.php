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
// Файл: wfilter.php
//-----------------------------------------------------------------------------/
// Назначение: Модуль управления фильтрами слов (админка)
//=============================================================================/
*/
	if ($USER_RIGHTS['allow_all_edit'] || $USER_RIGHTS['allow_all_editst']) {	
		include(CLASSES."/wfilter.class.php");
		
		$o_wfilter = new wfilter($o_mysql);
		
		$a  = $o_vars->get['a'];
			$sw = false;
				
				
				$mrules["{TITLEE}"] = $LANG[$m.'_fadd'];
	        	
	        	$mrules["{WORD0}"] = "";
				$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);
			else {
					
					$sw = true;
					
					if ($result) $MESS = $o_other->showMessA($LANG[$m.'_add']);
	            	else $MESS = $o_other->showMessA($LANG[$m.'_eadd'], 1);  	
				}
					
					$mrules["{TITLEE}"] = $LANG[$m.'_fadd'];
	        	
			    	$mrules["{WORD0}"] = $word0;
				
					$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);
					$MESS = $o_other->showMessA($LANG['wrong_input'], 1);
				}
		
			$sw = false;
					$mrules["{TITLEE}"] = $LANG[$m.'_fedit']. $n[1];
					
					
					$sw = true;
					
					if ($result) $MESS = $o_other->showMessA($LANG[$m.'_edit']);
	            	else $MESS = $o_other->showMessA($LANG[$m.'_eedit'], 1);	
				}
				
					$mrules["{TITLEE}"] = $LANG[$m.'_fedit']. $o_wfilter->getOne($id, "word0");
	        	
			    	$mrules["{WORD0}"] = $word0;
				
					$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);
					$MESS = $o_other->showMessA($LANG['wrong_input'], 1);
				}
		
		if ((!isset($a) && !isset($id)) || ($a=="del" && isset($id))  || ($a=="add" && $sw) || ($a=="edit" && isset($id) && $sw)) {
	    	
	    	if ($a=="del") {
				if ($result) $MESS = $o_other->showMessA($LANG[$m.'_del']);
	    	
				if ($result) $MESS = $o_other->showMessA($LANG[$m.'_make']);
			}