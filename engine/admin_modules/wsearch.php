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
// Файл: wsearch.php
//-----------------------------------------------------------------------------/
// Назначение: Модуль управления поиском и заменой текста (админка)
//=============================================================================/
*/    if (!defined("OLE")) die("<script>window.location = \"./\"</script>");		if ($USER_RIGHTS['id_ug']==1) {				$action = $o_vars->post['action'];			    if (isset($action)) {
	    	
	    	$sw = false;					$text0 = stripslashes(htmlspecialchars(strip_tags($o_vars->post['text0']), ENT_QUOTES));		 	$text1 = stripslashes(htmlspecialchars(strip_tags($o_vars->post['text1']), ENT_QUOTES));			$table = $o_vars->post['table'];										if ($text0!="" && $table!="") {				
				$sw = true;
				
				$result = $o_other->changeText($table, $text0, $text1);	        
	        	if ($result) $MESS = $o_other->showMessA($LANG[$m.'_edit']);
	            else $MESS = $o_other->showMessA($LANG[$m.'_eedit'], 1);    
	        }	        else {
	        	        	
	        	$mrules["{TITLEE}"] = $LANG[$m];
	    	
				$mrules["{NEWS_SEL}"] = (@in_array("1", $table)) ? "selected=\"selected\"" : "";
				$mrules["{COMM_SEL}"] = (@in_array("2", $table)) ? "selected=\"selected\"" : "";
				$mrules["{PM_SEL}"]   = (@in_array("3", $table)) ? "selected=\"selected\"" : "";
				$mrules["{ST_SEL}"]   = (@in_array("4", $table)) ? "selected=\"selected\"" : "";
				
				$mrules["{TEXT0}"] = $text0;
				$mrules["{TEXT1}"] = $text1;
	        	
	        	$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);
	            $MESS = $o_other->showMessA($LANG['wrong_input'], 1);
	        }		}
		
		if (!isset($action) || $sw) {
			    	
	    	$mrules["{TITLEE}"] = $LANG[$m];
	    	
	    	$mrules["{NEWS_SEL}"] = "selected=\"selected\"";
	    	$mrules["{COMM_SEL}"] = "selected=\"selected\"";
	    	$mrules["{PM_SEL}"]   = "selected=\"selected\"";
	    	$mrules["{ST_SEL}"]   = "selected=\"selected\"";
	    	
	    	$mrules["{TEXT0}"] = "";
	    	$mrules["{TEXT1}"] = "";
	    		    	
	    	$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);
		}	        }	else $MESS1 = $o_other->showMessA($LANG['eaccess'], 1);?>
