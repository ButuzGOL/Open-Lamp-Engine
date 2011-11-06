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
// Файл: vote.php
//-----------------------------------------------------------------------------/
// Назначение: Модуль управления голосованиями (админка)
//=============================================================================/
*/
		
		include(CLASSES."/vote.class.php");
		include(CLASSES."/categories.class.php");
		
		$o_vote 	  = new vote($o_mysql);
		
			$sw = false;
			
	        	$mrules["{TITLEE}"] = $LANG[$m.'_fadd'];
	        	
	        	$mrules["{TITLE}"]      = "";
	        	$mrules["{CATS_DIS}"] = "";
	        	$mrules["{CATS_SEL}"] = "selected=\"selected\"";
	        	
				
					$sw = true;
					
	            	if ($result) $MESS = $o_other->showMessA($LANG[$m.'_add']);
	            	else $MESS = $o_other->showMessA($LANG[$m.'_eadd'], 1);  
	            }
	            
	            	$mrules["{TITLEE}"] = $LANG[$m.'_fadd'];
	        	
			    	$mrules["{TITLE}"] = $title;
			    	$mrules["{BODY}"]  = $body;
			    	
			    	$mrules["{ONOFF_YES}"]  = ($onoff)   ? "checked=\"checked\"" : "";
					$mrules["{ONOFF_NO}"]   = (!$onoff)  ? "checked=\"checked\"" : "";
					$mrules["{IS_REG_YES}"] = ($is_reg)  ? "checked=\"checked\"" : "";
					$mrules["{IS_REG_NO}"]  = (!$is_reg) ? "checked=\"checked\"" : "";	
					
					$mrules["{CATS_DIS}"] = "";
					
					$cats1 = array();
					$mrules["{CATS}"] = "";
					
					$result = $o_categories->makeTree();
					if ($result) foreach ($result as $n1) 
	            	$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);
	            	$MESS = $o_other->showMessA($LANG['wrong_input'], 1);
	            }
	    elseif ($a=="edit" && isset($id)) {
		    $sw = false;
		    
		        	
		        	$mrules["{TITLEE}"] = $LANG[$m.'_fedit']. $n[2];
					$mrules["{CATS}"] = "";
					
					$result = $o_categories->makeTree();
					if ($result) foreach ($result as $n1) 
				elseif (@in_array("0", $o_vars->post['cats'])) $cats = "0";
					$sw = true;
					
					$result = $o_vote->update($id, $title, $onoff, $is_reg, $cats, $body);
	            	if ($result) $MESS = $o_other->showMessA($LANG[$m.'_edit']);
	            	else $MESS = $o_other->showMessA($LANG[$m.'_eedit'], 1); 
	            
	            	$mrules["{TITLEE}"] = $LANG[$m.'_fedit']. $o_vote->getOne($id, "title");
	        	
			    	$mrules["{TITLE}"] = $title;
			    	$mrules["{BODY}"]  = $body;
			    	
			    	$mrules["{ONOFF_YES}"]  = ($onoff)   ? "checked=\"checked\"" : "";
					$mrules["{ONOFF_NO}"]   = (!$onoff)  ? "checked=\"checked\"" : "";
					$mrules["{IS_REG_YES}"] = ($is_reg)  ? "checked=\"checked\"" : "";
					$mrules["{IS_REG_NO}"]  = (!$is_reg) ? "checked=\"checked\"" : "";	
					
					$mrules["{CATS_DIS}"] = $o_vote->getOne($id, "type") ? "disabled=\"disabled\"" : "";
					
					$cats1 = array();
					$mrules["{CATS}"] = "";
					
					$result = $o_categories->makeTree();
					if ($result) foreach ($result as $n1) 
	            	$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);
	            	$MESS = $o_other->showMessA($LANG['wrong_input'], 1);
	            }
	    if ((!isset($a) && !isset($id)) || ($a=="reset" && isset($id)) || ($a=="del" && isset($id)) || ($a=="add" && $sw) || ($a=="edit" && isset($id) && $sw)) {
	    
	    	if ($a=="del") {
	    	
	    		$result = $o_vote->del($id); 
	       		if ($result) $MESS = $o_other->showMessA($LANG[$m.'_del']);
	    	}
	    	
	    	if ($a=="reset") {
	    	
	    		$result = $o_vote->reset($id); 
	       		if ($result) $MESS = $o_other->showMessA($LANG[$m.'_res']);
	    	}
				if ($result) $MESS = $o_other->showMessA($LANG[$m.'_make']);
			}
			$result = $o_vote->get();
	                