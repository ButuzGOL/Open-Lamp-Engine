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
// Назначение: Модуль управления и вывода статических страниц
//=============================================================================/
*/

	if (!defined("OLE")) die("<script>window.location = \"./\"</script>");
	
	include(CLASSES ."/statik.class.php");
	include(CLASSES ."/banners.class.php");
	include(CLASSES ."/bbcodes.class.php");
	include(CLASSES ."/wfilter.class.php");
		
	$o_statik  = new statik($o_mysql);
	$o_banners = new banners($o_mysql);
	$o_bbcodes = new bbcodes($o_mysql);
	$o_wfilter = new wfilter($o_mysql);
	
	$id = $o_vars->get['id'];
	$a  = $o_vars->get['a'];
	
	if ($a=="add" && $USER_RIGHTS['allow_addst']) {
		
		$action_statik = $o_vars->post['action_statik'];
						
		if (!isset($action_statik)) {
			
			$mrules["{TITLE}"] = $LANG[$m.'_add'];
						$mrules1["{ONOFF_YES}"]     = ($USER_RIGHTS['moderationst'])  ? "checked=\"checked\"" : "disabled=\"disabled\"";
			$mrules1["{ONOFF_NO}"]      = (!$USER_RIGHTS['moderationst']) ? "checked=\"checked\"" : "";			$mrules1["{BB_IMG_UPLOAD}"] = ($USER_RIGHTS['allow_admin'])   ? "<img onclick=\"image_upload();\" title=\"Загрузка файлов на сервер\" alt=\"Загрузка файлов на сервер\" src=\"{TEMPLATE}/images/bbcodes_upload.png\" />" : "";
			$mrules1["{TITLE}"]    = "";			$mrules1["{STORY}"]    = "";
			$mrules1["{KEYWORDS}"] = "";
			$mrules1["{DESCR}"]    = "";
		
			$mrules1["{ACCESS_SEL}"] = "selected=\"selected\"";
					$mrules1["{ACCESS}"] = "";			$result = $o_usersgroup->get();			foreach ($result as $n) if ($n[0]!=1) $mrules1["{ACCESS}"] .= "<option value=\"$n[0]\">".$n[1]."</option>";
			
			$mrules1["{ACCESS_DIS}"] = ($USER_RIGHTS['id_ug']!=1) ? "disabled=\"disabled\"" : "";
		
			$mrules1["{CAPTCHA}"] = ($USER_RIGHTS['captcha']) ? "<div class=\"captcha\"><img src=\"?m=captcha\" alt=\"\" /> <input type=\"text\" name=\"captcha\" maxlength=\"5\" /></div>" : "";
		
			$mrules1["{MESS}"] = "";
			
			$mrules["{MIDDLE}"] = $o_tpl->gethtml(TEMPLATES_DIR."/".$m."_form_middle.tpl", $mrules1);
			$o_tpl->addhtml(TEMPLATES_DIR."/default_middle.tpl", $mrules);
			
		}
		else {
			
			$autor   = ($USER['name']) ? $USER['name'] : $o_usersgroup->getOne($USER_RIGHTS['id_ug'], "group_name");
			$date    = time();
			$title   = stripslashes(htmlspecialchars(strip_tags($o_vars->post['title']), ENT_QUOTES));			$descr   = stripslashes(htmlspecialchars(strip_tags($o_vars->post['descr']), ENT_QUOTES));
			$story   = (!$USER_RIGHTS['allow_html']) ? $o_wfilter->wordFilter(stripslashes(htmlspecialchars(strip_tags($o_other->strRepl($o_vars->post['story'])), ENT_QUOTES))) : $o_wfilter->wordFilter($o_other->strRepl($o_vars->post['story']));			$onoff 	 = intval($o_vars->post['onoff']);
			$captcha = $o_vars->post['captcha'];	
									
			$keywords = stripslashes(htmlspecialchars(strip_tags($o_vars->post['keywords']), ENT_QUOTES));
			
			if (@in_array("0", $o_vars->post['access']) || $USER_RIGHTS['id_ug']!=1) $access = "0";			else $access = @implode(",", $o_vars->post['access']);
												
			if ($title!="" && $story!=""&& (($captcha!=""&& $_SESSION['captcha']==$captcha) || !$USER_RIGHTS['captcha'])) {
						
				$o_statik->add($title, $descr, $story, $keywords, $access, $autor, $date, $onoff, $ID);	  
				$o_other->showMess($LANG[$m.'_add'], $LANG[$m.'_madd'], "index.php", $LANG['redir_main'], TEMPLATES_DIR);          	
	    	}
			else {
						
				$mrules["{TITLE}"] = $LANG[$m.'_add'];
				
				$mrules1["{MESS}"] = "<center style=\"color:#AC4646;\">".$LANG['wrong_input']."</center><br />";
											$mrules1["{BB_IMG_UPLOAD}"] = ($allow_admin)   ? "<img onclick=\"image_upload();\" title=\"Загрузка файлов на сервер\" alt=\"Загрузка файлов на сервер\" src=\"{TEMPLATE}/images/bbcodes_upload.png\" />" : "";
				
				$mrules1["{ONOFF_YES}"] = ($onoff)  ? "checked=\"checked\"" : "";
				$mrules1["{ONOFF_NO}"]  = (!$onoff) ? "checked=\"checked\"" : "";
				
				if (!$USER_RIGHTS['moderation']) {
					$mrules1["{ONOFF_YES}"] = ($USER_RIGHTS['moderation'])  ? "checked=\"checked\"" : "disabled=\"disabled\"";
					$mrules1["{ONOFF_NO}"]  = (!$USER_RIGHTS['moderation']) ? "checked=\"checked\"" : "";
				}
				$mrules1["{TITLE}"]    = $title;				$mrules1["{STORY}"]    = $story;
				$mrules1["{DESCR}"]    = $descr;
				$mrules1["{KEYWORDS}"] = $keywords;
		
				$access1 = array();				$access1 = explode(",", $access);				if ($access=="0") {$mrules1["{ACCESS_SEL}"] = "selected=\"selected\""; $access1 = "";}				else $mrules1["{ACCESS_SEL}"] = "";						$mrules1["{ACCESS}"] = "";
				$result = $o_usersgroup->get();				foreach ($result as $n1) 					if ($n1[0]!=1) 						$mrules1["{ACCESS}"] .= (@in_array($n1[0], $access1)) ? "<option value=\"$n1[0]\" selected=\"selected\">".$n1[1]."</option>" : "<option value=\"$n1[0]\">".$n1[1]."</option>";
				
				$mrules1["{ACCESS_DIS}"] = ($USER_RIGHTS['id_ug']!=1) ? "disabled=\"disabled\"" : "";
		
				$mrules1["{CAPTCHA}"] = ($USER_RIGHTS['captcha']) ? "<div class=\"captcha\"><img src=\"?m=captcha\" alt=\"\" /> <input type=\"text\" name=\"captcha\" maxlength=\"5\" /></div>" : "";
				
				$mrules["{MIDDLE}"] = $o_tpl->gethtml(TEMPLATES_DIR."/".$m."_form_middle.tpl", $mrules1);
				$o_tpl->addhtml(TEMPLATES_DIR."/default_middle.tpl", $mrules);	
			}
		}
	}
	elseif ($a=="edit" && isset($id) && ($USER_RIGHTS['allow_all_editst'] || ($USER_RIGHTS['allow_editst'] && $ID==$o_statik->getOne($id, "name")))) {
		
		$result = $o_statik->get($id);
        if ($result) {
			
			$action_statik = $o_vars->post['action_statik'];
			
			if (!isset($action_statik)) {
			
		   		foreach ($result as $n);
					
				$mrules["{TITLE}"] = $LANG[$m.'_edit']. $n[1];
		
				$moderationst1 = (!$USER_RIGHTS['moderationst']) ? "disabled=\"disabled\"" : "";				$mrules1["{ONOFF_YES}"]     = ($n[9])  ? "checked=\"checked\"" : $moderationst1;				$mrules1["{ONOFF_NO}"]      = (!$n[9]) ? "checked=\"checked\"" : $moderationst1;				$mrules1["{BB_IMG_UPLOAD}"] = ($USER_RIGHTS['allow_admin'])   ? "<img onclick=\"image_upload();\" title=\"Загрузка файлов на сервер\" alt=\"Загрузка файлов на сервер\" src=\"{TEMPLATE}/images/bbcodes_upload.png\" />" : "";
				$mrules1["{TITLE}"]    = $n[1];				$mrules1["{STORY}"]    = $n[2];
				$mrules1["{DESCR}"]    = $n[3];
				$mrules1["{KEYWORDS}"] = $n[4];
								$access = array();				$access = explode(",", $n[5]);				if ($n[5]=="0") {$mrules1["{ACCESS_SEL}"] = "selected=\"selected\""; $access = "";}				else $mrules1["{ACCESS_SEL}"] = "";		
				$mrules1["{ACCESS}"] = "";				$result = $o_usersgroup->get();				foreach ($result as $n1) 					if ($n1[0]!=1) 						$mrules1["{ACCESS}"] .= (@in_array($n1[0], $access)) ? "<option value=\"$n1[0]\" selected=\"selected\">".$n1[1]."</option>" : "<option value=\"$n1[0]\">".$n1[1]."</option>";
					
				$mrules["{ACCESS_DIS}"] = ($USER_RIGHTS['id_ug']!=1) ? "disabled=\"disabled\"" : "";
				
				$mrules1["{MESS}"] = "";
				
				$mrules1["{CAPTCHA}"] = "";
				
				$mrules["{MIDDLE}"] = $o_tpl->gethtml(TEMPLATES_DIR."/".$m."_form_middle.tpl", $mrules1);
				$o_tpl->addhtml(TEMPLATES_DIR."/default_middle.tpl", $mrules);
			}
			else {
							$title = stripslashes(htmlspecialchars(strip_tags($o_vars->post['title']), ENT_QUOTES));				$descr = stripslashes(htmlspecialchars(strip_tags($o_vars->post['descr']), ENT_QUOTES));
				$story = (!$USER_RIGHTS['allow_html']) ? $o_wfilter->wordFilter(stripslashes(htmlspecialchars(strip_tags($o_other->strRepl($o_vars->post['story'])), ENT_QUOTES))) : $o_wfilter->wordFilter($o_other->strRepl($o_vars->post['story']));				$onoff 	                     = intval($o_vars->post['onoff']);
											$moderationst1 = (!$USER_RIGHTS['moderationst']) ? "disabled=\"disabled\"" : "";							
				$keywords = stripslashes(htmlspecialchars(strip_tags($o_vars->post['keywords']), ENT_QUOTES));
			
				if ($USER_RIGHTS['id_ug']!=1) $access = $o_statik->getOne($id, "access");				elseif (@in_array("0", $o_vars->post['access'])) $access = "0";				else $access = @implode(",", $o_vars->post['access']);
			
					
				if ($id!="" && $title!="" && $story!="" && ($USER_RIGHTS['allow_all_editst'] || ($USER_RIGHTS['allow_editst'] && $ID==$o_statik->getOne($id, "name")))) {
				
					$o_statik->update($id, $title, $descr, $story, $keywords, $access, $onoff);
					$o_other->showMess($LANG[$m.'_edit'] .$o_statik->getOne($id, "title"), $LANG[$m.'_medit'], "index.php", $LANG['redir_main'], TEMPLATES_DIR);
				}
				else {
					
					$mrules["{TITLE}"] = $LANG[$m.'_edit']. $o_statik->getOne($id, "title");
					
					$mrules1["{MESS}"] = "<center style=\"color:#AC4646;\">".$LANG['wrong_input']."</center><br />";
												$mrules1["{BB_IMG_UPLOAD}"] = ($allow_admin)   ? "<img onclick=\"image_upload();\" title=\"Загрузка файлов на сервер\" alt=\"Загрузка файлов на сервер\" src=\"{TEMPLATE}/images/bbcodes_upload.png\" />" : "";
				
					$mrules1["{ONOFF_YES}"] = ($onoff)  ? "checked=\"checked\"" : "";
					$mrules1["{ONOFF_NO}"]  = (!$onoff) ? "checked=\"checked\"" : "";
				
					if (!$USER_RIGHTS['moderation']) {
						$mrules1["{ONOFF_YES}"] = ($USER_RIGHTS['moderation'])  ? "checked=\"checked\"" : "disabled=\"disabled\"";
						$mrules1["{ONOFF_NO}"]  = (!$USER_RIGHTS['moderation']) ? "checked=\"checked\"" : "";
					}
					$mrules1["{TITLE}"]    = $title;					$mrules1["{STORY}"]    = $story;
					$mrules1["{DESCR}"]    = $descr;
					$mrules1["{KEYWORDS}"] = $keywords;
		
					$access1 = array();					$access1 = explode(",", $access);					if ($access=="0") {$mrules1["{ACCESS_SEL}"] = "selected=\"selected\""; $access1 = "";}					else $mrules1["{ACCESS_SEL}"] = "";							$mrules1["{ACCESS}"] = "";
					$result = $o_usersgroup->get();					foreach ($result as $n1) 						if ($n1[0]!=1) 							$mrules1["{ACCESS}"] .= (@in_array($n1[0], $access1)) ? "<option value=\"$n1[0]\" selected=\"selected\">".$n1[1]."</option>" : "<option value=\"$n1[0]\">".$n1[1]."</option>";
				
					$mrules1["{ACCESS_DIS}"] = ($USER_RIGHTS['id_ug']!=1) ? "disabled=\"disabled\"" : "";
					
					$mrules1["{CAPTCHA}"] = "";
					
					$mrules["{MIDDLE}"] = $o_tpl->gethtml(TEMPLATES_DIR."/".$m."_form_middle.tpl", $mrules1);
					$o_tpl->addhtml(TEMPLATES_DIR."/default_middle.tpl", $mrules);		
				}
			}
		}
		else $o_other->showMess($LANG[$m.'_del'], $LANG[$m.'_eget'], "index.php", $LANG['redir_main'], TEMPLATES_DIR);
	}
	elseif ($a=="del" && isset($id) && ($USER_RIGHTS['allow_all_editst'] || ($USER_RIGHTS['allow_editst'] && $ID==$o_statik->getAutorId($id)))) {

		$result = $o_statik->del($id); 
    	if ($result) $o_other->showMess($LANG[$m.'_del'], $LANG[$m.'_mdel'], "index.php", $LANG['redir_main'], TEMPLATES_DIR);
		else $o_other->showMess($LANG[$m.'_del'], $LANG[$m.'_eget'], "index.php", $LANG['redir_main'], TEMPLATES_DIR);
    }  
	elseif ($a!="add" && !isset($id)) {
		$result = $o_statik->getS();
		
        if (!$result) $o_other->showMess($LANG[$m], $LANG[$m.'_egets'], "index.php", $LANG['redir_main'], TEMPLATES_DIR);
		else {
            $mrules["{TITLE}"]  = $LANG[$m];
            foreach ($result as $n) {
                
                $n[1] = (strlen($n[1]) < 61) ? $n[1] : substr($n[1], 0 , 60);
	                            
                $mrules1["{ID}"]    = $n[0];
	            $mrules1["{TITLE}"] = ($o_other->isAllowAccess($USER_RIGHTS['id_ug'], $n[5])) ? "<a href=\"?m=$m&amp;id=$n[0]\">$n[1]</a>" : $n[1];
			    $mrules1["{AUTOR}"] = ($o_users->getOne($n[10], "name")) ? "<a href=\"?m=profile&amp;id=$n[10]\">".$o_users->getOne($n[10], "name")."</a>" : $n[7];
			    $mrules1["{VIEWS}"] = $n[6];
			    $mrules1["{DATE}"]  = $o_other->makeNormalDate($n[8], 1);
	            
		        $mrules1['{DEL}']  = ($USER_RIGHTS['allow_all_editst'] || ($USER_RIGHTS['allow_editst'] && $ID==$n[10])) ? "<a href=\"index.php?m=$m&amp;a=del&amp;id=$n[0]\"><img src=\"".TEMPLATES_DIR."/images/del.png\" title=\"".$LANG['del']."\" alt=\"".$LANG['del']."\" /></a>" : "";
				$mrules1['{EDIT}'] = ($USER_RIGHTS['allow_all_editst'] || ($USER_RIGHTS['allow_editst'] && $ID==$n[10])) ? "<a href=\"index.php?m=$m&amp;a=edit&amp;id=$n[0]\"><img src=\"".TEMPLATES_DIR."/images/edit.png\" title=\"".$LANG['edit']."\" alt=\"".$LANG['edit']."\" /></a>" : "";
				
				$mrules["{MIDDLE}"] .= $o_tpl->gethtml(TEMPLATES_DIR."/".$m."_allshowm_middle.tpl",$mrules1);
            }        			$o_tpl->addhtml(TEMPLATES_DIR."/default_middle.tpl", $mrules);
		}
	}
	elseif ($a!="add" && $a!="edit" && $a!="del" && $o_other->isAllowAccess($USER_RIGHTS['id_ug'], $o_statik->getOne($id, "access"))) {
		$result = $o_statik->getS($id);
		if (!$result) $o_other->showMess($LANG[$m], $LANG[$m.'_eget'], "index.php", $LANG['redir_main'], TEMPLATES_DIR);
		else {
		    $banners_top    = "";
	        $banners_buttom = "";
	        $result1 = $o_banners->getS(1);
	        if ($result1) {
	            foreach ($result1 as $n) {
	                if ($n[5]=="1" || $n[5]=="4" || $n[5]=="5" || $n[5]=="7") $banners_top    .= $n[2];
	                if ($n[5]=="3" || $n[5]=="5" || $n[5]=="6" || $n[5]=="7") $banners_buttom .= $n[2];
	            } 	
	        }
	        if ($banners_top) $o_tpl->addhtml($banners_top);
			$o_statik->statikReadPP($id);
			foreach ($result as $n);
				
        	$mrules["{ID}"]    = $n[0];
	        $mrules["{TITLE}"] = $n[1];
			$mrules["{STORY}"] = $o_bbcodes->filter(nl2br($n[2]), $USER_RIGHTS['allow_hide']);			
			$mrules["{AUTOR}"] = ($o_users->getOne($n[10], "name")) ? "<a href=\"?m=profile&amp;id=$n[10]\">".$o_users->getOne($n[10], "name")."</a>" : $n[7];
			$mrules["{VIEWS}"] = $n[6];
			$mrules["{DATE}"]  = $o_other->makeNormalDate($n[8], 1);
			
			$TITLE    = $n[1];
			$DESCR    = $n[3];
	        $KEYWORDS = $n[4];
	        
	        $mrules['{DEL}']  = ($USER_RIGHTS['allow_all_editst'] || ($USER_RIGHTS['allow_editst'] && $ID==$n[10])) ? "<a href=\"index.php?m=$m&amp;a=del&amp;id=$n[0]\"><img src=\"".TEMPLATES_DIR."/images/del.png\" title=\"".$LANG['del']."\" alt=\"".$LANG['del']."\" /></a>" : "";
			$mrules['{EDIT}'] = ($USER_RIGHTS['allow_all_editst'] || ($USER_RIGHTS['allow_editst'] && $ID==$n[10])) ? "<a href=\"index.php?m=$m&amp;a=edit&amp;id=$n[0]\"><img src=\"".TEMPLATES_DIR."/images/edit.png\" title=\"".$LANG['edit']."\" alt=\"".$LANG['edit']."\" /></a>" : "";
			
			$o_tpl->addhtml(TEMPLATES_DIR."/".$m."_show.tpl", $mrules);
			if ($banners_buttom) $o_tpl->addhtml($banners_buttom);
		}
	}
	elseif ($a=="add" || $a=="edit" || $a=="del" || isset($id)) $o_other->showMess($LANG['mess'], $LANG['eaccess'], "index.php", $LANG['redir_main'], TEMPLATES_DIR);

?>
