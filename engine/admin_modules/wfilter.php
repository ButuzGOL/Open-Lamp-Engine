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
// Файл: wfilter.php
//-----------------------------------------------------------------------------/
// Назначение: Модуль управления фильтрами слов (админка)
//=============================================================================/
*/    if (!defined("OLE")) die("<script>window.location = \"./\"</script>");	
	if ($USER_RIGHTS['allow_all_edit'] || $USER_RIGHTS['allow_all_editst']) {			
		include(CLASSES."/wfilter.class.php");
		
		$o_wfilter = new wfilter($o_mysql);
		
		$a  = $o_vars->get['a'];		$id = $o_vars->get['id'];					if ($a=="add") {
			$sw = false;
							$action = $o_vars->post['action'];				if (!isset($action)) {
				
				$mrules["{TITLEE}"] = $LANG[$m.'_fadd'];
	        	
	        	$mrules["{WORD0}"] = "";				$mrules["{WORD1}"] = "";				
				$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);			}
			else {					$word0 = stripslashes(htmlspecialchars(strip_tags($o_vars->post['word0']), ENT_QUOTES));				$word1 = stripslashes(htmlspecialchars(strip_tags($o_vars->post['word1']), ENT_QUOTES));							if ($word0!="") {
					
					$sw = true;
										$result = $o_wfilter->add($word0, $word1);					
					if ($result) $MESS = $o_other->showMessA($LANG[$m.'_add']);
	            	else $MESS = $o_other->showMessA($LANG[$m.'_eadd'], 1);  	
				}				else {
					
					$mrules["{TITLEE}"] = $LANG[$m.'_fadd'];
	        	
			    	$mrules["{WORD0}"] = $word0;					$mrules["{WORD1}"] = $word1;
				
					$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);
					$MESS = $o_other->showMessA($LANG['wrong_input'], 1);
				}			}		}		elseif ($a=="edit" && isset($id)) {
		
			$sw = false;					$action = $o_vars->post['action'];				if (!isset($action)) {				$result = $o_wfilter->get($id);				if (!$result) {$sw = true; $MESS = $o_other->showMessA($LANG[$m.'_eget'], 1);}				else {					foreach ($result as $n);					
					$mrules["{TITLEE}"] = $LANG[$m.'_fedit']. $n[1];
										$mrules["{WORD0}"] = $n[1];					$mrules["{WORD1}"] = $n[2];								$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);				}			} 			else {						$word0 = stripslashes(htmlspecialchars(strip_tags($o_vars->post['word0']), ENT_QUOTES));				$word1 = stripslashes(htmlspecialchars(strip_tags($o_vars->post['word1']), ENT_QUOTES));							if ($word0!="" && $id!="") {
					
					$sw = true;
										$result = $o_wfilter->update($id, $word0, $word1);				
					if ($result) $MESS = $o_other->showMessA($LANG[$m.'_edit']);
	            	else $MESS = $o_other->showMessA($LANG[$m.'_eedit'], 1);	
				}				else {
				
					$mrules["{TITLEE}"] = $LANG[$m.'_fedit']. $o_wfilter->getOne($id, "word0");
	        	
			    	$mrules["{WORD0}"] = $word0;					$mrules["{WORD1}"] = $word1;
				
					$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);
					$MESS = $o_other->showMessA($LANG['wrong_input'], 1);
				}			}		}
		
		if ((!isset($a) && !isset($id)) || ($a=="del" && isset($id))  || ($a=="add" && $sw) || ($a=="edit" && isset($id) && $sw)) {
	    	
	    	if ($a=="del") {				$result = $o_wfilter->del($id); 		
				if ($result) $MESS = $o_other->showMessA($LANG[$m.'_del']);			    else $MESS = $o_other->showMessA($LANG[$m.'_edel'], 1);			} 
	    				$action = $o_vars->post['action'];				if (isset($action) && $a!="add" && $a!="edit") {							$make     = $o_vars->post['make'];				$selected = $o_vars->post['selected'];						$result = $o_wfilter->makeIn($make, $selected);		
				if ($result) $MESS = $o_other->showMessA($LANG[$m.'_make']);			    else $MESS = $o_other->showMessA($LANG[$m.'_emake'], 1);
			}						$result = $o_wfilter->get();			$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_allshowt.tpl");			if (!$result) $o_tpl->addhtml("<div class=\"nothing\">".$LANG[$m.'_egets']."</div>");			else {				foreach ($result as $n) {				               					$mrules["{ID}"]    = $n[0];				    $mrules["{WORD0}"] = $n[1];					$mrules["{WORD1}"] = $n[2];			                    					$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_allshowm.tpl", $mrules);			    }			}			$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_allshowb.tpl");		}		elseif ($a!="add" && ($a!="edit" || ($a=="edit" && !isset($id)))) $MESS1 = $o_other->showMessA($LANG['efunction'], 1);	}	else $MESS1 = $o_other->showMessA($LANG['eaccess'], 1);        ?>
