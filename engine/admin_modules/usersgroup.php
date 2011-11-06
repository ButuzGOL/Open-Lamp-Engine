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
// Файл: usersgroup.php
//-----------------------------------------------------------------------------/
// Назначение: Модуль управления группами пользователей (админка)
//=============================================================================/
*/
		include(CLASSES."/categories.class.php");
		
		$o_categories = new categories($o_mysql);
		
			$sw = false;
			
	        	
	        	$mrules["{TITLEE}"] = $LANG[$m.'_fadd'];
				$mrules["{GROUP_NAME}"] = "";
				$mrules["{IS_ADM}"]     = "";
				
				$mrules["{ALLOW_CATS_SEL}"] = "selected=\"selected\"";
				$mrules["{CAT_ADD_SEL}"]    = "selected=\"selected\"";
								
				$mrules["{ALLOW_CATS}"] = "";
				$result = $o_categories->makeTree();
	        		foreach ($result as $n) {
	        			$mrules["{CAT_ADD}"]    .= "<option value=\"$n[0]\">".$n[1]."</option>"; 
	        			$mrules["{ALLOW_CATS}"] .= "<option value=\"$n[0]\">".$n[1]."</option>";
	        		}
	        		
	        	$mrules["{ALLOW_OFFLINE_YES}"]    = "";
				$mrules["{ALLOW_HTML_YES}"]       = "";
				$allow_html	      = intval($o_vars->post['allow_html']);
				
					$sw = true;
					
					
	            	else $MESS = $o_other->showMessA($LANG[$m.'_eadd'], 1);
	            }
	            	
	            	$mrules["{TITLEE}"] = $LANG[$m.'_fadd'];
					$mrules["{GROUP_NAME}"] = $group_name;
					$mrules["{IS_ADM}"]     = "";
					
					$cats1 = array();
					$mrules["{ALLOW_CATS}"] = "";
					
					$result = $o_categories->makeTree();
					if ($result) foreach ($result as $n1) 
					
					$cats1 = array();
					$mrules["{CAT_ADD_CATS}"] = "";
					
					$result = $o_categories->makeTree();
					if ($result) foreach ($result as $n1) 
					
					$mrules["{ALLOW_OFFLINE_YES}"]    = ($allow_offline)   	 ? "checked=\"checked\"" : "";
					$mrules["{ALLOW_HTML_YES}"]       = ($allow_html) 	     ? "checked=\"checked\"" : "";
					
	            	$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);
	            	$MESS = $o_other->showMessA($LANG['wrong_input']. $LANG[$m.'_eform'], 1);
	            }
	    elseif ($a=="edit" && isset($id)) {
	    
	    	$sw = false;
		        	
		        	$mrules["{TITLEE}"] = $LANG[$m.'_fedit']. $n[1];
					$mrules["{ALLOW_HTML_YES}"]       = ($n[27])  ? "checked=\"checked\"" : "";
					$cat_add = array();
					if ($n[2]=="0") {$mrules["{ALLOW_CATS_SEL}"] = "selected=\"selected\""; $allow_cats = "";}
					if ($n[3]=="0") {$mrules["{CAT_ADD_SEL}"] = "selected=\"selected\""; $cat_add = "";}
	    			$mrules["{ALLOW_CATS}"] = "";
	    			$mrules["{CAT_ADD}"]    = "";
	    			
	    				foreach ($result as $n1) {
				
					$sw = true;
					
	            	if ($result) $MESS = $o_other->showMessA($LANG[$m.'_edit']);
	            	else $MESS = $o_other->showMessA($LANG[$m.'_eedit'], 1); 	
	            }
	        		
	        		$mrules["{TITLEE}"] = $LANG[$m.'_fedit']. $o_usersgroup->getOne($id, "group_name");
	        		
	        		$mrules["{GROUP_NAME}"] = $group_name;
					$mrules["{IS_ADM}"] = ($id==1) ? "disabled=\"disabled\"" : "";
					
					$cats1 = array();
					$mrules["{ALLOW_CATS}"] = "";
					
					$result = $o_categories->makeTree();
					if ($result) foreach ($result as $n1) 
					
					$cats1 = array();
					$mrules["{CAT_ADD_CATS}"] = "";
					
					$result = $o_categories->makeTree();
					if ($result) foreach ($result as $n1) 
					
					$mrules["{ALLOW_OFFLINE_YES}"]    = ($allow_offline)   	 ? "checked=\"checked\"" : "";
					$mrules["{ALLOW_HTML_YES}"]       = ($allow_html) 	     ? "checked=\"checked\"" : "";
					
	            	$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);
	            	$MESS = $o_other->showMessA($LANG['wrong_input']. $LANG[$m.'_eform'], 1);
	        	}
	    if ((!isset($a) && !isset($id)) || ($a=="del" && isset($id))  || ($a=="add" && $sw) || ($a=="edit" && isset($id) && $sw)) {
	    	if ($a=="del") {
				if ($id==1) $MESS = $o_other->showMessA($LANG[$m.'_edel'], 1);
			
			    	if ($result) $MESS = $o_other->showMessA($LANG[$m.'_del']);
	    	}
	    	
				if ($result) $MESS = $o_other->showMessA($LANG[$m.'_make']);
			}
	        	