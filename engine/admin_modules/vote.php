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
// Файл: vote.php
//-----------------------------------------------------------------------------/
// Назначение: Модуль управления голосованиями (админка)
//=============================================================================/
*/    if (!defined("OLE")) die("<script>window.location = \"./\"</script>");		if ($USER_RIGHTS['id_ug']==1) {
		
		include(CLASSES."/vote.class.php");
		include(CLASSES."/categories.class.php");
		
		$o_vote 	  = new vote($o_mysql);		$o_categories = new categories($o_mysql);
				$a  = $o_vars->get['a'];		$id = $o_vars->get['id'];						if ($a=="add") {			
			$sw = false;
				    	$action = $o_vars->post['action'];	    		        if (!isset($action)) {	        	
	        	$mrules["{TITLEE}"] = $LANG[$m.'_fadd'];
	        	
	        	$mrules["{TITLE}"]      = "";				$mrules["{ONOFF_YES}"]  = "checked=\"checked\"";				$mrules["{ONOFF_NO}"]   = "";				$mrules["{IS_REG_YES}"] = "checked=\"checked\"";				$mrules["{IS_REG_NO}"]  = "";				$mrules["{BODY}"]       = "";					
	        	$mrules["{CATS_DIS}"] = "";
	        	$mrules["{CATS_SEL}"] = "selected=\"selected\"";
	        		        	$mrules["{CATS}"] = "";				$result = $o_categories->makeTree();	        	if ($result) foreach ($result as $n) $mrules["{CATS}"] .= "<option value=\"$n[0]\">".$n[1]."</option>";	        					$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);		    }	        else {							$title  = stripslashes(htmlspecialchars(strip_tags($o_vars->post['title']), ENT_QUOTES));				$onoff  = intval($o_vars->post['onoff']);				$is_reg = intval($o_vars->post['is_reg']);				$body   = (!$USER_RIGHTS['allow_html']) ? stripslashes(htmlspecialchars(strip_tags($o_other->strRepl($o_vars->post['body'])), ENT_QUOTES)) : stripslashes($o_other->strRepl($o_vars->post['body']));								if (@in_array("0", $o_vars->post['cats'])) $cats = "0";				else $cats = @implode(",", $o_categories->makeCats($o_vars->post['cats']));										if ($title!="" && $body!="") {
				
					$sw = true;
										$result = $o_vote->add($title, time(), $onoff, $is_reg, $cats, $body, 0);	            	
	            	if ($result) $MESS = $o_other->showMessA($LANG[$m.'_add']);
	            	else $MESS = $o_other->showMessA($LANG[$m.'_eadd'], 1);  
	            }	            else {
	            
	            	$mrules["{TITLEE}"] = $LANG[$m.'_fadd'];
	        	
			    	$mrules["{TITLE}"] = $title;
			    	$mrules["{BODY}"]  = $body;
			    	
			    	$mrules["{ONOFF_YES}"]  = ($onoff)   ? "checked=\"checked\"" : "";
					$mrules["{ONOFF_NO}"]   = (!$onoff)  ? "checked=\"checked\"" : "";
					$mrules["{IS_REG_YES}"] = ($is_reg)  ? "checked=\"checked\"" : "";
					$mrules["{IS_REG_NO}"]  = (!$is_reg) ? "checked=\"checked\"" : "";	
					
					$mrules["{CATS_DIS}"] = "";
					
					$cats1 = array();					$cats1 = explode(",", $cats);	    			if ($cats=="0") {$mrules["{CATS_SEL}"] = "selected=\"selected\""; $cats1 = "";}	    			else $mrules["{CATS_SEL}"] = "";					
					$mrules["{CATS}"] = "";
					
					$result = $o_categories->makeTree();
					if ($result) foreach ($result as $n1) 						$mrules["{CATS}"] .= (@in_array($n1[0], $cats1)) ? "<option value=\"$n1[0]\" selected=\"selected\">".$n1[1]."</option>" : "<option value=\"$n1[0]\">".$n1[1]."</option>";							            
	            	$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);
	            	$MESS = $o_other->showMessA($LANG['wrong_input'], 1);
	            }	    	}	    }
	    elseif ($a=="edit" && isset($id)) {		    
		    $sw = false;
		    			$action = $o_vars->post['action'];				        if (!isset($action)) {	            $result = $o_vote->get($id);	            if (!$result) {$sw = true; $MESS = $o_other->showMessA($LANG[$m.'_eget'], 1);} 				else {		        	foreach ($result as $n);
		        	
		        	$mrules["{TITLEE}"] = $LANG[$m.'_fedit']. $n[2];		        						$mrules["{TITLE}"]      = $n[2];					$mrules["{ONOFF_YES}"]  = ($n[4])  ? "checked=\"checked\"" : "";					$mrules["{ONOFF_NO}"]   = (!$n[4]) ? "checked=\"checked\"" : "";					$mrules["{IS_REG_YES}"] = ($n[5])  ? "checked=\"checked\"" : "";					$mrules["{IS_REG_NO}"]  = (!$n[5]) ? "checked=\"checked\"" : "";					$mrules["{BODY}"]       = $n[7];					$mrules["{CATS_DIS}"]   = ($n[1])  ? "disabled=\"disabled\"" : "";															$cats = array();					$cats = explode(",", $n[6]);	    			if ($n[6]=="0") {$mrules["{CATS_SEL}"] = "selected=\"selected\""; $cats = "";}	    			else $mrules["{CATS_SEL}"] = "";					
					$mrules["{CATS}"] = "";
					
					$result = $o_categories->makeTree();
					if ($result) foreach ($result as $n1) 						$mrules["{CATS}"] .= (@in_array($n1[0], $cats)) ? "<option value=\"$n1[0]\" selected=\"selected\">".$n1[1]."</option>" : "<option value=\"$n1[0]\">".$n1[1]."</option>";																		$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);	            }	        } 			else {								$title = stripslashes(htmlspecialchars(strip_tags($o_vars->post['title']), ENT_QUOTES));				$onoff  = intval($o_vars->post['onoff']);				$is_reg = intval($o_vars->post['is_reg']);				$body = (!$USER_RIGHTS['allow_html']) ? stripslashes(htmlspecialchars(strip_tags($o_other->strRepl($o_vars->post['body'])), ENT_QUOTES)) : stripslashes($o_other->strRepl($o_vars->post['body']));								if ($o_vote->getOne($id, "type")) $cats = $o_vote->getOne($id, "cats");
				elseif (@in_array("0", $o_vars->post['cats'])) $cats = "0";				else $cats = @implode(",", $o_categories->makeCats($o_vars->post['cats']));								if ($title!="" && $body!="" && $id!="") {					
					$sw = true;
					
					$result = $o_vote->update($id, $title, $onoff, $is_reg, $cats, $body);	            	
	            	if ($result) $MESS = $o_other->showMessA($LANG[$m.'_edit']);
	            	else $MESS = $o_other->showMessA($LANG[$m.'_eedit'], 1); 	            }	        	else {
	            
	            	$mrules["{TITLEE}"] = $LANG[$m.'_fedit']. $o_vote->getOne($id, "title");
	        	
			    	$mrules["{TITLE}"] = $title;
			    	$mrules["{BODY}"]  = $body;
			    	
			    	$mrules["{ONOFF_YES}"]  = ($onoff)   ? "checked=\"checked\"" : "";
					$mrules["{ONOFF_NO}"]   = (!$onoff)  ? "checked=\"checked\"" : "";
					$mrules["{IS_REG_YES}"] = ($is_reg)  ? "checked=\"checked\"" : "";
					$mrules["{IS_REG_NO}"]  = (!$is_reg) ? "checked=\"checked\"" : "";	
					
					$mrules["{CATS_DIS}"] = $o_vote->getOne($id, "type") ? "disabled=\"disabled\"" : "";
					
					$cats1 = array();					$cats1 = explode(",", $cats);	    			if ($cats=="0") {$mrules["{CATS_SEL}"] = "selected=\"selected\""; $cats1 = "";}	    			else $mrules["{CATS_SEL}"] = "";					
					$mrules["{CATS}"] = "";
					
					$result = $o_categories->makeTree();
					if ($result) foreach ($result as $n1) 						$mrules["{CATS}"] .= (@in_array($n1[0], $cats1)) ? "<option value=\"$n1[0]\" selected=\"selected\">".$n1[1]."</option>" : "<option value=\"$n1[0]\">".$n1[1]."</option>";							            
	            	$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);
	            	$MESS = $o_other->showMessA($LANG['wrong_input'], 1);
	            }			}	    }	    
	    if ((!isset($a) && !isset($id)) || ($a=="reset" && isset($id)) || ($a=="del" && isset($id)) || ($a=="add" && $sw) || ($a=="edit" && isset($id) && $sw)) {
	    
	    	if ($a=="del") {
	    	
	    		$result = $o_vote->del($id); 	       		
	       		if ($result) $MESS = $o_other->showMessA($LANG[$m.'_del']);	            else $MESS = $o_other->showMessA($LANG[$m.'_edel'], 1);	
	    	}
	    	
	    	if ($a=="reset") {
	    	
	    		$result = $o_vote->reset($id); 	       		
	       		if ($result) $MESS = $o_other->showMessA($LANG[$m.'_res']);	            else $MESS = $o_other->showMessA($LANG[$m.'_eres'], 1);	
	    	}	    				$action = $o_vars->post['action'];	    		    	if (isset($action) && $a!="add" && $a!="edit") {									$make     = $o_vars->post['make'];				$selected = $o_vars->post['selected'];								$result = $o_vote->makeIn($make, $selected);				
				if ($result) $MESS = $o_other->showMessA($LANG[$m.'_make']);	            else $MESS = $o_other->showMessA($LANG[$m.'_emake'], 1);
			}			
			$result = $o_vote->get();	        $o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_allshowt.tpl");			if (!$result) $o_tpl->addhtml("<div class=\"nothing\">".$LANG[$m.'_egets']."</div>");	        else {	        	foreach ($result as $n) {		                       					$mrules["{ID}"]    = $n[0];		            $mrules["{TITLE}"] = $n[2];					$mrules["{DATE}"]  = $o_other->makeNormalDate($n[3],1);	                $mrules["{KOL}"]   = $o_vote->kolVotes($n[0]);	                $mrules["{ONOFF}"] = ($n[4]) ? "<img src=\"".ADMIN_TEMPLATES_DIR."/images/yes.png\" alt=\"".$LANG['yes']."\" title=\"".$LANG['yes']."\" />" : "<img src=\"".ADMIN_TEMPLATES_DIR."/images/no.png\" alt=\"".$LANG['no']."\" title=\"".$LANG['no']."\" />";	                $mrules["{TYPE}"]  = ($n[1]) ? $LANG['vote_tynews'] : $LANG['vote_tyblock'];
	                					$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_allshowm.tpl", $mrules);	            }	        }	        $o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_allshowb.tpl");		} 		elseif ($a!="add" && ($a!="edit" || ($a=="edit" && !isset($id)))) $MESS1 = $o_other->showMessA($LANG['efunction'], 1);	}	else $MESS1 = $o_other->showMessA($LANG['eaccess'], 1);    ?>
