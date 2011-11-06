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
// Файл: banners.php
//-----------------------------------------------------------------------------/
// Назначение: Модуль управления рекламными материалами (админка)
//=============================================================================/
*/
    if (!defined("OLE")) die("<script>window.location = \"./\"</script>");			if ($USER_RIGHTS['id_ug']==1) {		
		include(CLASSES."/banners.class.php");
		include(CLASSES."/categories.class.php");
		
		$o_banners    = new banners($o_mysql);
		$o_categories = new categories($o_mysql);
			$a  = $o_vars->get['a'];		$id = $o_vars->get['id'];						if ($a=="add") {
		
			$sw = false;				    	$action = $o_vars->post['action'];	    		        if (!isset($action)) {
	        	
	        	$mrules["{TITLEE}"] = $LANG[$m.'_fadd'];
	        	
	        	$mrules["{DESCR}"] = "";
	        	$mrules["{CODE}"]  = "";
				$mrules["{PLACE}"] = 1;		        				
				$mrules["{CATS_SEL}"] = "selected=\"selected\"";
								$mrules["{CATS}"] = "";
				$result = $o_categories->makeTree();				if ($result) foreach ($result as $n) $mrules["{CATS}"] .= "<option value=\"$n[0]\">".$n[1]."</option>";				
				$mrules["{ACCESS_SEL}"] = "selected=\"selected\"";
				
				$mrules["{ACCESS}"] = "";				$result = $o_usersgroup->get();				foreach ($result as $n) $mrules["{ACCESS}"] .= "<option value=\"$n[0]\">".$n[1]."</option>";
				
				$mrules["{ONOFF_YES}"]         = "checked=\"checked\"";				$mrules["{ONOFF_NO}"]          = "";	            $mrules["{FIXED_YES}"]         = "";				$mrules["{FIXED_NO}"]          = "checked=\"checked\"";				$mrules["{ALLOW_MAIN_YES}"]    = "checked=\"checked\"";				$mrules["{ALLOW_MAIN_NO}"]     = "";				$mrules["{ALLOW_CATE_YES}"]    = "checked=\"checked\"";				$mrules["{ALLOW_CATE_NO}"]     = "";				$mrules["{ALLOW_STATIK_YES}"]  = "checked=\"checked\"";				$mrules["{ALLOW_STATIK_NO}"]   = "";				$mrules["{ALLOW_NEWS_YES}"]    = "checked=\"checked\"";				$mrules["{ALLOW_NEWS_NO}"]     = "";				$mrules["{ALLOW_ARHNEWS_YES}"] = "checked=\"checked\"";				$mrules["{ALLOW_ARHNEWS_NO}"]  = "";				$mrules["{ALLOW_SEARCH_YES}"]  = "checked=\"checked\"";				$mrules["{ALLOW_SEARCH_NO}"]   = "";										   					$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);		    }	        else {							$descr = stripslashes(htmlspecialchars(strip_tags($o_vars->post['descr']), ENT_QUOTES));						$code  = stripslashes($o_vars->post['code']);								$onoff         = intval($o_vars->post['onoff']);				$fixed         = intval($o_vars->post['fixed']);				$place         = intval($o_vars->post['place']);				$allow_main    = intval($o_vars->post['allow_main']);				$allow_cate    = intval($o_vars->post['allow_cate']);				$allow_statik  = intval($o_vars->post['allow_statik']);				$allow_news    = intval($o_vars->post['allow_news']);				$allow_arhnews = intval($o_vars->post['allow_arhnews']);				$allow_search  = intval($o_vars->post['allow_search']);								if (@in_array("0", $o_vars->post['cats'])) $cats = "0";				else $cats = @implode(",", $o_categories->makeCats($o_vars->post['cats']));								if (@in_array("0", $o_vars->post['access'])) $access = "0";				else $access = @implode(",", $o_vars->post['access']);									if ($descr!="" && $code!="") {
				
					$sw = true;
										$result = $o_banners->add($descr, $code, $onoff, $fixed, $place, $cats, $access, $allow_main, $allow_cate, $allow_statik, $allow_news, $allow_arhnews, $allow_search);	            	if ($result) $MESS = $o_other->showMessA($LANG[$m.'_add']);
	            	else $MESS = $o_other->showMessA($LANG[$m.'_eadd'], 1); 	            }	            else {
	            	
	            	$mrules["{TITLEE}"] = $LANG[$m.'_fadd'];
	        	
			    	$mrules["{DESCR}"] = $descr;
			    	$mrules["{CODE}"]  = $code;
					$mrules["{PLACE}"] = $place;
	            	
	            	$cats1 = array();												
					$cats1 = explode(",", $cats);					if ($cats=="0") {$mrules["{CATS_SEL}"] = "selected=\"selected\""; $cats1 = "";}	    			else $mrules["{CATS_SEL}"] = "";					
					$mrules["{CATS}"] = "";
										$result = $o_categories->makeTree();	    			if ($result) 
	    				foreach ($result as $n1) 							$mrules["{CATS}"] .= (@in_array($n1[0], $cats1)) ? "<option value=\"$n1[0]\" selected=\"selected\">".$n1[1]."</option>" : "<option value=\"$n1[0]\">".$n1[1]."</option>";							            		            $access1 = array();					$access1 = explode(",", $access);					if ($access=="0") {$mrules["{ACCESS_SEL}"] = "selected=\"selected\""; $access1 = "";}					else $mrules["{ACCESS_SEL}"] = "";							$mrules["{ACCESS}"] = "";
					$result = $o_usersgroup->get();					foreach ($result as $n1) 						if ($n1[0]!=1) 							$mrules["{ACCESS}"] .= (@in_array($n1[0], $access1)) ? "<option value=\"$n1[0]\" selected=\"selected\">".$n1[1]."</option>" : "<option value=\"$n1[0]\">".$n1[1]."</option>";									
					$mrules["{ONOFF_YES}"]         = ($onoff)          ? "checked=\"checked\"" : "";					$mrules["{ONOFF_NO}"]          = (!$onoff)         ? "checked=\"checked\"" : "";		            $mrules["{FIXED_YES}"]         = ($fixed)          ? "checked=\"checked\"" : "";					$mrules["{FIXED_NO}"]          = (!$fixed)  	   ? "checked=\"checked\"" : "";					$mrules["{ALLOW_MAIN_YES}"]    = ($allow_main)     ? "checked=\"checked\"" : "";					$mrules["{ALLOW_MAIN_NO}"]     = (!$allow_main)    ? "checked=\"checked\"" : "";					$mrules["{ALLOW_CATE_YES}"]    = ($allow_cate)     ? "checked=\"checked\"" : "";					$mrules["{ALLOW_CATE_NO}"]     = (!$allow_cate)    ? "checked=\"checked\"" : "";					$mrules["{ALLOW_STATIK_YES}"]  = ($allow_statik)   ? "checked=\"checked\"" : "";					$mrules["{ALLOW_STATIK_NO}"]   = (!$allow_statik)  ? "checked=\"checked\"" : "";					$mrules["{ALLOW_NEWS_YES}"]    = ($allow_news)     ? "checked=\"checked\"" : "";					$mrules["{ALLOW_NEWS_NO}"]     = (!$allow_news)    ? "checked=\"checked\"" : "";					$mrules["{ALLOW_ARHNEWS_YES}"] = ($allow_arhnews)  ? "checked=\"checked\"" : "";					$mrules["{ALLOW_ARHNEWS_NO}"]  = (!$allow_arhnews) ? "checked=\"checked\"" : "";					$mrules["{ALLOW_SEARCH_YES}"]  = ($allow_search)   ? "checked=\"checked\"" : "";					$mrules["{ALLOW_SEARCH_NO}"]   = (!$allow_search)  ? "checked=\"checked\"" : "";								
	            	$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);
	            	$MESS = $o_other->showMessA($LANG['wrong_input'], 1);
	            }	    	}	    }		elseif ($a=="edit" && isset($id)) {		    
		    $sw = false;
		    			$action = $o_vars->post['action'];				        if (!isset($action)) {	            $result = $o_banners->get($id);	            if (!$result) {$sw = true; $MESS = $o_other->showMessA($LANG[$m.'_eget'], 1);} 				else {		        	foreach ($result as $n);
		        	
		        	$mrules["{TITLEE}"] = $LANG[$m.'_fedit']. $n[1];
	        			        				        $mrules["{DESCR}"]             = $n[1];					$mrules["{CODE}"]              = $n[2];					$mrules["{ONOFF_YES}"]         = ($n[3])   ? "checked=\"checked\"" : "";					$mrules["{ONOFF_NO}"]          = (!$n[3])  ? "checked=\"checked\"" : "";		            $mrules["{FIXED_YES}"]         = ($n[4])   ? "checked=\"checked\"" : "";					$mrules["{FIXED_NO}"]          = (!$n[4])  ? "checked=\"checked\"" : "";					$mrules["{ALLOW_MAIN_YES}"]    = ($n[8])   ? "checked=\"checked\"" : "";					$mrules["{ALLOW_MAIN_NO}"]     = (!$n[8])  ? "checked=\"checked\"" : "";					$mrules["{ALLOW_CATE_YES}"]    = ($n[9])   ? "checked=\"checked\"" : "";					$mrules["{ALLOW_CATE_NO}"]     = (!$n[9])  ? "checked=\"checked\"" : "";					$mrules["{ALLOW_STATIK_YES}"]  = ($n[10])  ? "checked=\"checked\"" : "";					$mrules["{ALLOW_STATIK_NO}"]   = (!$n[10]) ? "checked=\"checked\"" : "";					$mrules["{ALLOW_NEWS_YES}"]    = ($n[11])  ? "checked=\"checked\"" : "";					$mrules["{ALLOW_NEWS_NO}"]     = (!$n[11]) ? "checked=\"checked\"" : "";					$mrules["{ALLOW_ARHNEWS_YES}"] = ($n[12])  ? "checked=\"checked\"" : "";					$mrules["{ALLOW_ARHNEWS_NO}"]  = (!$n[12]) ? "checked=\"checked\"" : "";					$mrules["{ALLOW_SEARCH_YES}"]  = ($n[13])  ? "checked=\"checked\"" : "";					$mrules["{ALLOW_SEARCH_NO}"]   = (!$n[13]) ? "checked=\"checked\"" : "";					$mrules["{PLACE}"]             = $n[5];		            
		            $cats = array();		            $cats = explode(",", $n[6]);					if ($n[6]=="0") {$mrules["{CATS_SEL}"] = "selected=\"selected\""; $cats = "";}	    			else $mrules["{CATS_SEL}"] = "";					
					$mrules["{CATS}"] = "";
										$result = $o_categories->makeTree();	    			if ($result) 
	    				foreach ($result as $n1) 							$mrules["{CATS}"] .= (@in_array($n1[0], $cats)) ? "<option value=\"$n1[0]\" selected=\"selected\">".$n1[1]."</option>" : "<option value=\"$n1[0]\">".$n1[1]."</option>";							            $access = array();					$access = explode(",", $n[7]);					if ($n[7]=="0") {$mrules["{ACCESS_SEL}"] = "selected=\"selected\""; $access = "";}					else $mrules["{ACCESS_SEL}"] = "";							$mrules["{ACCESS}"] = "";
					$result = $o_usersgroup->get();					foreach ($result as $n1) 						if ($n1[0]!=1) 							$mrules["{ACCESS}"] .= (@in_array($n1[0], $access)) ? "<option value=\"$n1[0]\" selected=\"selected\">".$n1[1]."</option>" : "<option value=\"$n1[0]\">".$n1[1]."</option>";
																					$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);	            }	        } 			else {												$descr = stripslashes(htmlspecialchars(strip_tags($o_vars->post['descr']), ENT_QUOTES));						$code  = stripslashes($o_vars->post['code']);								$onoff         = intval($o_vars->post['onoff']);				$fixed         = intval($o_vars->post['fixed']);				$place         = intval($o_vars->post['place']);				$allow_main    = intval($o_vars->post['allow_main']);				$allow_cate    = intval($o_vars->post['allow_cate']);				$allow_statik  = intval($o_vars->post['allow_statik']);				$allow_news    = intval($o_vars->post['allow_news']);				$allow_arhnews = intval($o_vars->post['allow_arhnews']);				$allow_search  = intval($o_vars->post['allow_search']);								if (@in_array("0", $o_vars->post['cats'])) $cats = "0";				else $cats = implode(",", $o_categories->makeCats($o_vars->post['cats']));								if (@in_array("0", $o_vars->post['access'])) $access = "0";				else $access = implode(",", $o_vars->post['access']);													if ($descr!="" && $code!="" && $id!="") {
				
					$sw = true;
										$result = $o_banners->update($id, $descr, $code, $onoff, $fixed, $place, $cats, $access, $allow_main, $allow_cate, $allow_statik, $allow_news, $allow_arhnews, $allow_search);	            
	            	if ($result) $MESS = $o_other->showMessA($LANG[$m.'_edit']);
	            	else $MESS = $o_other->showMessA($LANG[$m.'_eedit'], 1);		            }	        	else {
				
					$mrules["{TITLEE}"] = $LANG[$m.'_fedit']. $o_banners->getOne($id, "descr");
	        		        	
			    	$mrules["{DESCR}"] = $descr;
			    	$mrules["{CODE}"]  = $code;
					$mrules["{PLACE}"] = $place;
	            	
	            	$cats1 = array();												
					$cats1 = explode(",", $cats);					if ($cats=="0") {$mrules["{CATS_SEL}"] = "selected=\"selected\""; $cats1 = "";}	    			else $mrules["{CATS_SEL}"] = "";					
					$mrules["{CATS}"] = "";
										$result = $o_categories->makeTree();	    			if ($result) 
	    				foreach ($result as $n1) 							$mrules["{CATS}"] .= (@in_array($n1[0], $cats1)) ? "<option value=\"$n1[0]\" selected=\"selected\">".$n1[1]."</option>" : "<option value=\"$n1[0]\">".$n1[1]."</option>";							            		            $access1 = array();					$access1 = explode(",", $access);					if ($access=="0") {$mrules["{ACCESS_SEL}"] = "selected=\"selected\""; $access1 = "";}					else $mrules["{ACCESS_SEL}"] = "";							$mrules["{ACCESS}"] = "";
					$result = $o_usersgroup->get();					foreach ($result as $n1) 						if ($n1[0]!=1) 							$mrules["{ACCESS}"] .= (@in_array($n1[0], $access1)) ? "<option value=\"$n1[0]\" selected=\"selected\">".$n1[1]."</option>" : "<option value=\"$n1[0]\">".$n1[1]."</option>";									
					$mrules["{ONOFF_YES}"]         = ($onoff)          ? "checked=\"checked\"" : "";					$mrules["{ONOFF_NO}"]          = (!$onoff)         ? "checked=\"checked\"" : "";		            $mrules["{FIXED_YES}"]         = ($fixed)          ? "checked=\"checked\"" : "";					$mrules["{FIXED_NO}"]          = (!$fixed)  	   ? "checked=\"checked\"" : "";					$mrules["{ALLOW_MAIN_YES}"]    = ($allow_main)     ? "checked=\"checked\"" : "";					$mrules["{ALLOW_MAIN_NO}"]     = (!$allow_main)    ? "checked=\"checked\"" : "";					$mrules["{ALLOW_CATE_YES}"]    = ($allow_cate)     ? "checked=\"checked\"" : "";					$mrules["{ALLOW_CATE_NO}"]     = (!$allow_cate)    ? "checked=\"checked\"" : "";					$mrules["{ALLOW_STATIK_YES}"]  = ($allow_statik)   ? "checked=\"checked\"" : "";					$mrules["{ALLOW_STATIK_NO}"]   = (!$allow_statik)  ? "checked=\"checked\"" : "";					$mrules["{ALLOW_NEWS_YES}"]    = ($allow_news)     ? "checked=\"checked\"" : "";					$mrules["{ALLOW_NEWS_NO}"]     = (!$allow_news)    ? "checked=\"checked\"" : "";					$mrules["{ALLOW_ARHNEWS_YES}"] = ($allow_arhnews)  ? "checked=\"checked\"" : "";					$mrules["{ALLOW_ARHNEWS_NO}"]  = (!$allow_arhnews) ? "checked=\"checked\"" : "";					$mrules["{ALLOW_SEARCH_YES}"]  = ($allow_search)   ? "checked=\"checked\"" : "";					$mrules["{ALLOW_SEARCH_NO}"]   = (!$allow_search)  ? "checked=\"checked\"" : "";								
	            	$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);
	            	$MESS = $o_other->showMessA($LANG['wrong_input'], 1);
				}			}	    }
	    
	    if ((!isset($a) && !isset($id)) || ($a=="del" && isset($id))  || ($a=="add" && $sw) || ($a=="edit" && isset($id) && $sw)) {	    	
	    	if ($a=="del") {				    $result = $o_banners->del($id); 
			    
			    if ($result) $MESS = $o_other->showMessA($LANG[$m.'_del']);			    else $MESS = $o_other->showMessA($LANG[$m.'_edel'], 1); 	        	    	}	    				$action = $o_vars->post['action'];	    		    	if (isset($action) && $a!="add" && $a!="edit") {									$make     = $o_vars->post['make'];				$selected = $o_vars->post['selected'];								$result = $o_banners->makeIn($make, $selected);				
				if ($result) $MESS = $o_other->showMessA($LANG[$m.'_make']);			    else $MESS = $o_other->showMessA($LANG[$m.'_emake'], 1); 
	    	}						$result = $o_banners->get();	        $o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_allshowt.tpl");			if (!$result) $o_tpl->addhtml("<div class=\"nothing\">".$LANG[$m.'_egets']."</div>");	        else {	        	foreach ($result as $n) {		                       					$mrules["{ID}"]    = $n[0];		            $mrules["{DESCR}"] = $n[1];					$mrules["{ONOFF}"] = ($n[3]) ? "<img src=\"".ADMIN_TEMPLATES_DIR."/images/yes.png\" alt=\"".$LANG['yes']."\" title=\"".$LANG['yes']."\" />" : "<img src=\"".ADMIN_TEMPLATES_DIR."/images/no.png\" alt=\"".$LANG['no']."\" title=\"".$LANG['no']."\" />";	                $mrules["{FIXED}"] = ($n[4]) ? "<img src=\"".ADMIN_TEMPLATES_DIR."/images/yes.png\" alt=\"".$LANG['yes']."\" title=\"".$LANG['yes']."\" />" : "<img src=\"".ADMIN_TEMPLATES_DIR."/images/no.png\" alt=\"".$LANG['no']."\" title=\"".$LANG['no']."\" />";	                $mrules["{PLACE}"] = $o_other->getBannerPlace($n[5]);	                					            					$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_allshowm.tpl", $mrules);	            }	        }	        $o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_allshowb.tpl");		}		elseif ($a!="add" && ($a!="edit" || ($a=="edit" && !isset($id)))) $MESS1 = $o_other->showMessA($LANG['efunction'], 1);	}	else $MESS1 = $o_other->showMessA($LANG['eaccess'], 1);?>
