<?php

/*
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
// Файл: statik.php
//-----------------------------------------------------------------------------/
// Назначение: Модуль управления рекламными материалами (админка)
//=============================================================================/
*/

    if (!defined("OLE")) die("<script>window.location = \"./\"</script>");
	
	if ($USER_RIGHTS['allow_editst'] || $USER_RIGHTS['allow_all_editst'] || $USER_RIGHTS['allow_addst']) {
	
		include(CLASSES."/statik.class.php");
		include(CLASSES."/wfilter.class.php");
		
		$o_statik  = new statik($o_mysql);
		$o_wfilter = new wfilter($o_mysql);
	
		$a  = $o_vars->get['a'];
		$id = $o_vars->get['id'];
		
		if ($a=="add" && $USER_RIGHTS['allow_addst']) {
		
			$sw = false;
		
			$action = $o_vars->post['action'];
	
			if (!isset($action)) {    
		
				$mrules["{TITLEE}"] = $LANG[$m.'_fadd'];
					$mrules["{ONOFF_YES}"] = ($USER_RIGHTS['moderationst'])  ? "checked=\"checked\"" : "disabled=\"disabled\"";
				$mrules["{ONOFF_NO}"]  = (!$USER_RIGHTS['moderationst']) ? "checked=\"checked\"" : "";
				$mrules["{TITLE}"]    = "";				$mrules["{STORY}"]    = "";
				$mrules["{DECR}"]     = "";
				$mrules["{KEYWORDS}"] = "";
				$mrules["{DESCR}"]    = "";
		
				$mrules["{ACCESS_SEL}"] = "selected=\"selected\"";
						$mrules["{ACCESS}"] = "";				$result = $o_usersgroup->get();				foreach ($result as $n) if ($n[0]!=1) $mrules["{ACCESS}"] .= "<option value=\"$n[0]\">".$n[1]."</option>";
			
				$mrules["{ACCESS_DIS}"] = ($USER_RIGHTS['id_ug']!=1) ? "disabled=\"disabled\"" : "";
						   	
				$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);
			}
			else {
	
				$title    = stripslashes(htmlspecialchars(strip_tags($o_vars->post['title']), ENT_QUOTES));
				$descr    = stripslashes(htmlspecialchars(strip_tags($o_vars->post['descr']), ENT_QUOTES));
				$story    = (!$USER_RIGHTS['allow_html']) ? $o_wfilter->wordFilter(stripslashes(htmlspecialchars(strip_tags($o_other->strRepl($o_vars->post['story'])), ENT_QUOTES))) : $o_wfilter->wordFilter($o_other->strRepl($o_vars->post['story']));
				$keywords = stripslashes(htmlspecialchars(strip_tags($o_vars->post['keywords']), ENT_QUOTES));
				$onoff 	  = intval($o_vars->post['onoff']);
				$autor    = $o_users->getOne($ID, "name");
				$date     = time();
				
				if (@in_array("0", $o_vars->post['access'])) $access = "0";
				else $access = @implode(",", $o_vars->post['access']);
				
				if ($title!="" && $story!="") {
				
				    $sw = true;
				    
					$result = $o_statik->add($title, $descr, $story, $keywords, $access, $autor, $date, $onoff, $ID);
					
					if ($result) $MESS = $o_other->showMessA($LANG[$m.'_add']);
	            	else $MESS = $o_other->showMessA($LANG[$m.'_eadd'], 1);  
				}
				else {
				
					$mrules["{TITLEE}"] = $LANG[$m.'_fadd'];
					
					$mrules["{TITLE}"]    = $title;
					$mrules["{DESCR}"]    = $descr;
					$mrules["{STORY}"]    = $story;
					$mrules["{KEYWORDS}"] = $keywords; 
					
					$mrules["{ONOFF_YES}"] = ($onoff)  ? "checked=\"checked\"" : "";
					$mrules["{ONOFF_NO}"]  = (!$onoff) ? "checked=\"checked\"" : "";
						
					if (!$USER_RIGHTS['moderation']) {
						$mrules["{ONOFF_YES}"] = ($USER_RIGHTS['moderation'])  ? "checked=\"checked\"" : "disabled=\"disabled\"";
						$mrules["{ONOFF_NO}"]  = (!$USER_RIGHTS['moderation']) ? "checked=\"checked\"" : "";
					}
					
					if (@in_array("0", $o_vars->post['access']) || $USER_RIGHTS['id_ug']!=1) $access = "0";					else $access = @implode(",", $o_vars->post['access']);
			
					$access1 = array();					$access1 = explode(",", $access);					if ($access=="0") {$mrules["{ACCESS_SEL}"] = "selected=\"selected\""; $access1 = "";}					else $mrules["{ACCESS_SEL}"] = "";							$mrules["{ACCESS}"] = "";
					$result = $o_usersgroup->get();					foreach ($result as $n1) 						if ($n1[0]!=1) 							$mrules["{ACCESS}"] .= (@in_array($n1[0], $access1)) ? "<option value=\"$n1[0]\" selected=\"selected\">".$n1[1]."</option>" : "<option value=\"$n1[0]\">".$n1[1]."</option>";
							
					$mrules["{ACCESS_DIS}"] = ($USER_RIGHTS['id_ug']!=1) ? "disabled=\"disabled\"" : "";
					
					$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);
	            	$MESS = $o_other->showMessA($LANG['wrong_input'], 1);						
				}
			}
		}
		elseif ($a=="edit" && isset($id) && ($USER_RIGHTS['allow_all_editst'] || ($USER_RIGHTS['allow_editst'] && $ID==$o_statik->getOne($id, "user_id")))) {
		
			$sw = false;
			
			$action = $o_vars->post['action'];
	
			if (!isset($action)) {
				$result = $o_statik->get($id);
				if (!$result) {$sw = true; $MESS = $o_other->showMessA($LANG[$m.'_eget'], 1);} 
				else {
					foreach ($result as $n);
					
					$mrules["{TITLEE}"] = $LANG[$m.'_fedit']. $n[1];
						
					$moderationst1 = (!$USER_RIGHTS['moderationst']) ? "disabled=\"disabled\"" : "";					$mrules["{ONOFF_YES}"] = ($n[9])  ? "checked=\"checked\"" : $moderationst1;					$mrules["{ONOFF_NO}"]  = (!$n[9]) ? "checked=\"checked\"" : $moderationst1;										$mrules["{TITLE}"]    = $n[1];					$mrules["{STORY}"]    = $n[2];
					$mrules["{DESCR}"]    = $n[3];
					$mrules["{KEYWORDS}"] = $n[4];
									$access = array();					$access = explode(",", $n[5]);					if ($n[5]=="0") {$mrules["{ACCESS_SEL}"] = "selected=\"selected\""; $access = "";}					else $mrules["{ACCESS_SEL}"] = "";		
					$mrules["{ACCESS}"] = "";					$result = $o_usersgroup->get();					foreach ($result as $n1) 						if ($n1[0]!=1) 							$mrules["{ACCESS}"] .= (@in_array($n1[0], $access)) ? "<option value=\"$n1[0]\" selected=\"selected\">".$n1[1]."</option>" : "<option value=\"$n1[0]\">".$n1[1]."</option>";
					
					$mrules["{ACCESS_DIS}"] = ($USER_RIGHTS['id_ug']!=1) ? "disabled=\"disabled\"" : "";
					
					$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);
				}
			} 
			else {
		
				$title    = stripslashes(htmlspecialchars(strip_tags($o_vars->post['title']), ENT_QUOTES));
				$descr    = stripslashes(htmlspecialchars(strip_tags($o_vars->post['descr']), ENT_QUOTES));
				$story    = (!$USER_RIGHTS['allow_html']) ? $o_wfilter->wordFilter(stripslashes(htmlspecialchars(strip_tags($o_other->strRepl($o_vars->post['story'])), ENT_QUOTES))) : $o_wfilter->wordFilter($o_other->strRepl($o_vars->post['story']));
				$keywords = stripslashes(htmlspecialchars(strip_tags($o_vars->post['keywords']), ENT_QUOTES));
				$onoff = intval($o_vars->post['onoff']);
		
				if ($ID!=1) $access = $o_statik->getOne($id, "access");
				elseif (@in_array("0", $o_vars->post['access'])) $access = "0";
				else $access = @implode(",", $o_vars->post['access']);
		
				if ($title!="" && $story!="" && $id!="") {
					
					$sw = true;
					
					$result = $o_statik->update($id, $title, $descr, $story, $keywords, $access, $onoff);
					
					if ($result) $MESS = $o_other->showMessA($LANG[$m.'_edit']);
	            	else $MESS = $o_other->showMessA($LANG[$m.'_eedit'], 1);  
				}
				else {
					
					$mrules["{TITLEE}"] = $LANG[$m.'_fedit']. $o_statik->getOne($id, "title");
					
					$mrules["{TITLE}"]    = $title;
					$mrules["{DESCR}"]    = $descr;
					$mrules["{STORY}"]    = $story;
					$mrules["{KEYWORDS}"] = $keywords;
												$moderationst1 = (!$USER_RIGHTS['moderationst']) ? "disabled=\"disabled\"" : "";					$mrules["{ONOFF_YES}"] = ($onoff)  ? "checked=\"checked\"" : $moderationst1;					$mrules["{ONOFF_NO}"]  = (!$onoff) ? "checked=\"checked\"" : $moderationst1;
			
					if ($USER_RIGHTS['id_ug']!=1) $access = $o_statik->getOne($id, "access");					elseif (@in_array("0", $o_vars->post['access'])) $access = "0";					else $access = @implode(",", $o_vars->post['access']);
			
					$access1 = array();					$access1 = explode(",", $access);					if ($access=="0") {$mrules["{ACCESS_SEL}"] = "selected=\"selected\""; $access1 = "";}					else $mrules["{ACCESS_SEL}"] = "";			
					$mrules["{ACCESS}"] = "";					$result = $o_usersgroup->get();					foreach ($result as $n1) 						if ($n1[0]!=1) 							$mrules["{ACCESS}"] .= (@in_array($n1[0], $access1)) ? "<option value=\"$n1[0]\" selected=\"selected\">".$n1[1]."</option>" : "<option value=\"$n1[0]\">".$n1[1]."</option>";
							
					$mrules["{ACCESS_DIS}"] = ($USER_RIGHTS['id_ug']!=1) ? "disabled=\"disabled\"" : "";
					
					$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);
	            	$MESS = $o_other->showMessA($LANG['wrong_input'], 1);			
				}
			}
		}
		
		if (((!isset($a) && !isset($id)) || ($a=="del" && isset($id) && ($USER_RIGHTS['allow_all_editst'] || ($USER_RIGHTS['allow_editst'] && $ID==$o_statik->getOne($id, "user_id")))) || ($a=="add" && $sw) || ($a=="edit" && isset($id) && $sw)) && ($USER_RIGHTS['allow_all_editst'] || $USER_RIGHTS['allow_editst']) ) {
			
			if ($a=="del" && isset($id)) {
			
				$result = $o_statik->del($id); 
			
				if ($result) $MESS = $o_other->showMessA($LANG[$m.'_del']);
			    else $MESS = $o_other->showMessA($LANG[$m.'_edel'], 1); 
			}
			
			$action = $o_vars->post['action'];
	
			if (isset($action) && $a!="add" && $a!="edit") {
			
				$make     = $o_vars->post['make'];
				$selected = $o_vars->post['selected'];
		
				$result = $o_statik->makeIn($make, $selected);
			
				if ($result) $MESS = $o_other->showMessA($LANG[$m.'_make']);
			    else $MESS = $o_other->showMessA($LANG[$m.'_emake'], 1);
			}
			
			$user_id = ($USER_RIGHTS['allow_all_editst']) ? "0" : $ID;
			$result = $o_statik->get(0, $user_id);
			$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_allshowt.tpl");
			if (!$result) $o_tpl->addhtml("<div class=\"nothing\">".$LANG[$m.'_egets']."</div>");
			else { 
				foreach ($result as $n) {
				               
					$mrules["{ID}"]    = $n[0];
				    $mrules["{TITLE}"] = $n[1];
			        $mrules["{VIEWS}"] = $n[6];
				    $mrules["{ONOFF}"] = ($n[9]) ? "<img src=\"".ADMIN_TEMPLATES_DIR."/images/yes.png\" alt=\"".$LANG['yes']."\" title=\"".$LANG['yes']."\" />" : "<img src=\"".ADMIN_TEMPLATES_DIR."/images/no.png\" alt=\"".$LANG['no']."\" title=\"".$LANG['no']."\" />";
					$mrules["{DATE}"]  = $o_other->makeNormalDate($n[8],1);
					$mrules["{AUTOR}"] = (!$o_users->getOne($n[10], "name")) ? $n[7] : $o_users->getOne($n[10], "name");
							    
					$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_allshowm.tpl", $mrules);
			    }
			}
			
			unset($mrules);
			
			$mrules["{MODERATIONST_DIS}"] = (!$USER_RIGHTS['moderationst']) ? "disabled=\"disabled\"" : "";
			$mrules["{ALLOW_ADDST_DIS}"]  = (!$USER_RIGHTS['allow_addst'])  ? "disabled=\"disabled\"" : "";
	
			$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_allshowb.tpl", $mrules);
			
		}
		elseif (isset($a) && ($a=="add" && !$USER_RIGHTS['allow_addst']) || (!$USER_RIGHTS['allow_edit'] || !$USER_RIGHTS['allow_all_edit']))
			$MESS1 = $o_other->showMessA($LANG['eaccess'], 1);   	 		elseif ($a!="add" && ($a!="edit" || ($a=="edit" && !isset($id)))) $MESS1 = $o_other->showMessA($LANG['efunction'], 1);
	}
	else $o_other->showMess($LANG['mess'], $LANG['eaccess'], "javascript:history.back(1)", $LANG['redir_back']);	   

?>
