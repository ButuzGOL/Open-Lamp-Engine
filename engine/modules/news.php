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
// Файл: news.php
//-----------------------------------------------------------------------------/
// Назначение: Модуль управления и вывода новостей
//=============================================================================/
*/

	if (!defined("OLE")) die("<script>window.location = \"./\"</script>");
	
	include(CLASSES ."/news.class.php");
	include(CLASSES ."/categories.class.php");
	include(CLASSES ."/banners.class.php");
	include(CLASSES ."/comments.class.php");
	include(CLASSES ."/bbcodes.class.php");
	include(CLASSES ."/wfilter.class.php");
	include(CLASSES ."/vote.class.php");
	include(CLASSES ."/email.class.php");
	
	$o_news 	  = new news($o_mysql);
	$o_categories = new categories($o_mysql);
	$o_vote 	  = new vote($o_mysql);
	$o_banners 	  = new banners($o_mysql);
	$o_comments   = new comments($o_mysql);
	$o_email      = new email($o_mysql);
	$o_wfilter    = new wfilter($o_mysql);
	$o_bbcodes    = new bbcodes();
		
	$id  = $o_vars->get['id'];
	$a   = $o_vars->get['a'];
	$idc = $o_vars->get['idc'];
	
	if ($a=="add" && $USER_RIGHTS['allow_adds']) {
		
		$action_news = $o_vars->post['action_news'];
		
		if (!isset($action_news)) {
		
			$mrules["{TITLE}"] = $LANG[$m.'_add'];
	
			$mrules1["{ALLOW_MAIN_YES}"] = ($USER_RIGHTS['allow_main'])  ? "checked=\"checked\"" : "disabled=\"disabled\"";
			$mrules1["{ALLOW_MAIN_NO}"]  = (!$USER_RIGHTS['allow_main']) ? "checked=\"checked\"" : "";
			$mrules1["{ONOFF_YES}"]      = ($USER_RIGHTS['moderation'])  ? "checked=\"checked\"" : "disabled=\"disabled\"";
			$mrules1["{ONOFF_NO}"]       = (!$USER_RIGHTS['moderation']) ? "checked=\"checked\"" : "";
			$mrules1["{MODERATION_NO}"]  = ($USER_RIGHTS['moderation'])  ? "checked=\"checked\"" : "disabled=\"disabled\"";
			$mrules1["{MODERATION_YES}"] = (!$USER_RIGHTS['moderation']) ? "checked=\"checked\"" : "";
			$mrules1["{BB_IMG_UPLOAD}"]  = ($USER_RIGHTS['allow_admin'])   ? "<img onclick=\"image_upload();\" title=\"Загрузка файлов на сервер\" alt=\"Загрузка файлов на сервер\" src=\"{TEMPLATE}/images/bbcodes_upload.png\" />" : "";
		
			$mrules1["{DATE}"]        = "";
			$mrules1["{DATEC}"]       = "checked=\"checked\"";
			$mrules1["{SHORT_STORY}"] = "";
			$mrules1["{FULL_STORY}"]  = "";
			$mrules1["{TITLE}"]       = "";
			$mrules1["{KEYWORDS}"]    = "";
			$mrules1["{DESCR}"]       = "";
			$mrules1["{EXPIRES}"]     = "";
			$mrules1["{EXPIRESC}"]    = "checked=\"checked\"";
			
			$mrules1["{ALLOW_COMM_YES}"] = "checked=\"checked\"";
			$mrules1["{ALLOW_COMM_NO}"]  = "";
			$mrules1["{ALLOW_RATE_YES}"] = "checked=\"checked\"";
			$mrules1["{ALLOW_RATE_NO}"]  = "";
			$mrules1["{FIXED_YES}"]      = "";
			$mrules1["{FIXED_NO}"]       = "checked=\"checked\"";
		
			$mrules1["{VOTE_TITLE}"]      = "";
			$mrules1["{VOTE_ONOFF_YES}"]  = "checked=\"checked\"";
			$mrules1["{VOTE_ONOFF_NO}"]   = "";
			$mrules1["{VOTE_IS_REG_YES}"] = "";
			$mrules1["{VOTE_IS_REG_NO}"]  = "checked=\"checked\"";
			$mrules1["{VOTE_BODY}"]       = "";
		
			$cats = array();			$cats = explode(",", $USER_RIGHTS['cat_add']);			if ($USER_RIGHTS['cat_add']=="0" || $USER_RIGHTS['allow_edit'] || $USER_RIGHTS['allow_all_edit']) {$mrules1["{CATS_SEL}"] = "selected=\"selected\""; $cats = ""; $mrules1["{CATS_DIS}"] = "";}			else {$mrules1["{CATS_SEL}"] = ""; $mrules1["{CATS_DIS}"] = "disabled=\"disabled\"";}		
			$mrules1["{CATS}"] = "";			$result = $o_categories->makeTree();
			if ($result) 
				foreach ($result as $n)					$mrules1["{CATS}"] .= (@in_array($n[0], $cats)) ? "<option value=\"$n[0]\" selected=\"selected\">".$n[1]."</option>" : "<option value=\"$n[0]\">".$n[1]."</option>";
		
			$mrules1["{ACCESS_SEL}"] = "selected=\"selected\"";
		
			$mrules1["{ACCESS}"] = "";			$result = $o_usersgroup->get();			foreach ($result as $n) if ($n[0]!=1) $mrules1["{ACCESS}"] .= "<option value=\"$n[0]\">".$n[1]."</option>";
			
			$mrules1["{ACCESS_DIS}"] = ($USER_RIGHTS['id_ug']!=1) ? "disabled=\"disabled\"" : "";
			
			$mrules1["{CAPTCHA}"] = ($USER_RIGHTS['captcha']) ? "<div class=\"captcha\"><img src=\"?m=captcha\" alt=\"\" /> <input type=\"text\" name=\"captcha\" maxlength=\"5\" /></div>" : "";
							
			$mrules1["{MESS}"] = "";
			
			$mrules["{MIDDLE}"] = $o_tpl->gethtml(TEMPLATES_DIR."/".$m."_form_middle.tpl", $mrules1);
			$o_tpl->addhtml(TEMPLATES_DIR."/default_middle.tpl", $mrules);		
		}		else {
			
			$autor = ($USER['name']) ? $USER['name'] : $o_usersgroup->getOne($USER_RIGHTS["id_ug"], "group_name");
			$title = stripslashes(htmlspecialchars(strip_tags($o_vars->post['title']), ENT_QUOTES));
			$date  = (!$o_vars->post['date']) ? time() : $o_other->makeToTime($o_vars->post['date']);
			
			if (!$USER_RIGHTS['allow_edit'] && !$USER_RIGHTS['allow_all_edit']) $cats = $USER_RIGHTS['cat_add'];			elseif (@in_array("0", $o_vars->post['cats'])) $cats = "0";			else $cats = @implode(",", $o_categories->makeCats($o_vars->post['cats']));
		
			$short_story = (!$USER_RIGHTS['allow_html']) ? $o_wfilter->wordFilter(stripslashes(htmlspecialchars(strip_tags($o_other->strRepl($o_vars->post['short_story'])), ENT_QUOTES))) : $o_wfilter->wordFilter($o_other->strRepl($o_vars->post['short_story']));
			$full_story  = (!$USER_RIGHTS['allow_html']) ? $o_wfilter->wordFilter(stripslashes(htmlspecialchars(strip_tags($o_other->strRepl($o_vars->post['full_story'])), ENT_QUOTES))) : $o_wfilter->wordFilter($o_other->strRepl($o_vars->post['full_story']));
			
			$onoff 	     = intval($o_vars->post['onoff']);
			$allow_main  = intval($o_vars->post['allow_main']);
			$moderation	 = intval($o_vars->post['moderation']);
			$fixed		 = intval($o_vars->post['fixed']);
			$allow_rate  = intval($o_vars->post['allow_rate']);
			$allow_comm  = intval($o_vars->post['allow_comm']);
			$captcha     = $o_vars->post['captcha'];	
			
			$expires = (!$o_vars->post['expires'] || time() > $o_other->makeToTime($o_vars->post['expires'])) ? 0 : $o_other->makeToTime($o_vars->post['expires']);
			
			$descr    = stripslashes(htmlspecialchars(strip_tags($o_vars->post['descr']), ENT_QUOTES));
			$keywords = stripslashes(htmlspecialchars(strip_tags($o_vars->post['keywords']), ENT_QUOTES));
			
		
			$vote_title = stripslashes(htmlspecialchars(strip_tags($o_vars->post['vote_title']), ENT_QUOTES));
			$vote_onoff              = intval($o_vars->post['vote_onoff']);
			$vote_is_reg             = intval($o_vars->post['vote_is_reg']);
			$vote_body = (!$USER_RIGHTS['allow_html']) ? stripslashes(htmlspecialchars(strip_tags($o_other->strRepl($o_vars->post['vote_body'])), ENT_QUOTES)) : stripslashes($o_other->strRepl($o_vars->post['vote_body']));
			$vote_id                 = 0;
			
			if (@in_array("0", $o_vars->post['access']) || $USER_RIGHTS['id_ug']!=1) $access = "0";			else $access = @implode(",", $o_vars->post['access']);
			
			if ($title!="" && $short_story!="" && (($captcha!="" && $_SESSION['captcha']==$captcha) || !$USER_RIGHTS['captcha'])) {
				
				if ($vote_title!="" && $vote_body!="") { 
				   $result = $o_vote->add($vote_title, time(), $vote_onoff, $vote_is_reg, "0", $vote_body, "1");
				   if ($result) $vote_id = $o_vote->getLastId(); 
				}
		
				$result = $o_news->add($autor, $date, $short_story, $full_story, $title, $keywords, $cats, $allow_comm, $allow_main, $allow_rate, $vote_id, $onoff, 0, $expires, $moderation, $fixed, $access, $descr, $ID);
									            
	            if ($ID!="1" && $result && $CONFIG['news_email']) {
				    
					$mrules["{*CATEGORY*}"] = "";
				    if ($n[7]) {
					    $a1 = explode(",", $cats);
					    if (count($a1)==1) {
						    $a2 = $o_categories->makeWayCate($a1[0]);
						    for ($i = 0; $a2[$i]; $i++) $mrules["{*CATEGORY*}"] .= $o_categories->getOne($a2[$i], "group_name")." &raquo; ";	
						    $mrules["{*CATEGORY*}"] = substr($mrules["{*CATEGORY*}"], 0, -8);
					    }
					    else {
						    for ($i = 0; $a1[$i]; $i++) $mrules["{*CATEGORY*}"] .= $o_categories->getOne($a1[$i], "group_name")." &amp; ";
						    $mrules["{*CATEGORY*}"] = substr($mrules["{*CATEGORY*}"], 0, -7);	          	
					    }
				    }
					   
					$mrules["{*NAME*}"]     = $title;
					$mrules["{*USERNAME*}"] = $autor;
					$mrules["{*DATE*}"]     = $o_other->makeNormalDate($date);
					$mrules["{*URL*}"]      = URL;
									
					$subj    = $LANG[$m.'_add'];
					$message = $o_tpl->gethtml($o_email->get(4), $mrules);
					$headers = "From: ".$CONFIG['title']."<".$o_users->getOne(1, "email").">\r\n";
					$email   = $o_users->getOne("1", "email");
					
					$o_email->sendEMail($email, $subj, $message, $headers);
				}
				$o_other->showMess($LANG[$m.'_add'], $LANG[$m.'_madd'], "index.php", $LANG['redir_main'], TEMPLATES_DIR);    	
	    	}
			else {
			
				$mrules["{TITLE}"] = $LANG[$m.'_add'];
				
				$mrules1["{MESS}"] = $LANG['wrong_input'];
				
				$mrules1["{TITLE}"] = $title;
				$mrules1["{DATE}"]  = (!$o_vars->post['date']) ? ""                    : $o_vars->post['date'];
				$mrules1["{DATEC}"] = (!$o_vars->post['date']) ? "checked=\"checked\"" : "";
				
				$mrules1["{BB_IMG_UPLOAD}"] = ($USER_RIGHTS['allow_admin'])   ? "<img onclick=\"image_upload();\" title=\"Загрузка файлов на сервер\" alt=\"Загрузка файлов на сервер\" src=\"{TEMPLATE}/images/bbcodes_upload.png\" />" : "";
				
				$mrules1["{SHORT_STORY}"] = $short_story;
				$mrules1["{FULL_STORY}"]  = $full_story;
						
				$mrules1["{ONOFF_YES}"]      = ($onoff)       ? "checked=\"checked\"" : "";
				$mrules1["{ONOFF_NO}"]       = (!$onoff)      ? "checked=\"checked\"" : "";
				$mrules1["{ALLOW_MAIN_YES}"] = ($allow_main)  ? "checked=\"checked\"" : ""; 
				$mrules1["{ALLOW_MAIN_NO}"]  = (!$allow_main) ? "checked=\"checked\"" : ""; 
				$mrules1["{MODERATION_YES}"] = ($moderation)  ? "checked=\"checked\"" : ""; 
				$mrules1["{MODERATION_NO}"]  = (!$moderation) ? "checked=\"checked\"" : ""; 			
				$mrules1["{FIXED_YES}"]      = ($fixed)       ? "checked=\"checked\"" : ""; 
				$mrules1["{FIXED_NO}"]       = (!$fixed)      ? "checked=\"checked\"" : ""; 
				$mrules1["{ALLOW_RATE_YES}"] = ($allow_rate)  ? "checked=\"checked\"" : ""; 
				$mrules1["{ALLOW_RATE_NO}"]  = (!$allow_rate) ? "checked=\"checked\"" : ""; 
				$mrules1["{ALLOW_COMM_YES}"] = ($allow_comm)  ? "checked=\"checked\"" : ""; 
				$mrules1["{ALLOW_COMM_NO}"]  = (!$allow_comm) ? "checked=\"checked\"" : "";
			
				if (!$USER_RIGHTS['allow_main']) {
					$mrules1["{ALLOW_MAIN_YES}"] = ($USER_RIGHTS['allow_main'])  ? "checked=\"checked\"" : "disabled=\"disabled\"";
					$mrules1["{ALLOW_MAIN_NO}"]  = (!$USER_RIGHTS['allow_main']) ? "checked=\"checked\"" : "";
				}
				if (!$USER_RIGHTS['moderation']) {
					$mrules1["{ONOFF_YES}"]      = ($USER_RIGHTS['moderation'])  ? "checked=\"checked\"" : "disabled=\"disabled\"";
					$mrules1["{ONOFF_NO}"]       = (!$USER_RIGHTS['moderation']) ? "checked=\"checked\"" : "";
					$mrules1["{MODERATION_NO}"]  = ($USER_RIGHTS['moderation'])  ? "checked=\"checked\"" : "disabled=\"disabled\"";
					$mrules1["{MODERATION_YES}"] = (!$USER_RIGHTS['moderation']) ? "checked=\"checked\"" : ""; 
				}
			
				$mrules1["{EXPIRES}"]  = (!$expires) ? ""                    : $o_vars->post['expires'];
				$mrules1["{EXPIRESC}"] = (!$expires) ? "checked=\"checked\"" : "";
							
				$mrules1["{DESCR}"]    = $descr;
				$mrules1["{KEYWORDS}"] = $keywords;
					
				$mrules1["{VOTE_TITLE}"] = $vote_title;
				$mrules1["{VOTE_BODY}"]  = $vote_body;
				
				$mrules1["{VOTE_ONOFF_YES}"]  = ($vote_onoff)   ? "checked=\"checked\"" : "" ; 
				$mrules1["{VOTE_ONOFF_NO}"]   = (!$vote_onoff)  ? "checked=\"checked\"" : "" ; 
				$mrules1["{VOTE_IS_REG_YES}"] = ($vote_is_reg)  ? "checked=\"checked\"" : "" ; 
				$mrules1["{VOTE_IS_REG_NO}"]  = (!$vote_is_reg) ? "checked=\"checked\"" : "" ; 
			
				$access1 = array();				$access1 = explode(",", $access);				if ($access=="0") {$mrules1["{ACCESS_SEL}"] = "selected=\"selected\""; $access1 = "";}				else $mrules1["{ACCESS_SEL}"] = "";						$mrules1["{ACCESS}"] = "";
				$result = $o_usersgroup->get();				foreach ($result as $n1) 					if ($n1[0]!=1) $mrules1["{ACCESS}"] .= (@in_array($n1[0], $access1)) ? "<option value=\"$n1[0]\" selected=\"selected\">".$n1[1]."</option>" : "<option value=\"$n1[0]\">".$n1[1]."</option>";
				
				$cats1 = array();					
				$cats1 = explode(",", $cats);
				if ($cats=="0") {$mrules1["{CATS_SEL}"] = "selected=\"selected\""; $cats1 = "";}
				else $mrules1["{CATS_SEL}"] = "";
			
				$mrules1["{CATS}"] = "";
				$result  = $o_categories->makeTree();			
				if ($result)
					foreach ($result as $n)
						$mrules1["{CATS}"] .= (@in_array($n[0], $cats1)) ? "<option value=\"$n[0]\" selected=\"selected\">".$n[1]."</option>" : "<option value=\"$n[0]\">".$n[1]."</option>";
								
				$mrules1["{ACCESS_DIS}"] = ($USER_RIGHTS['id_ug']!=1) ? "disabled=\"disabled\"" : "";
			
				$mrules1["{CAPTCHA}"] = ($USER_RIGHTS['captcha']) ? "<div class=\"captcha\"><img src=\"?m=captcha\" alt=\"code\" border=\"0\" align=\"top\"/> <input type=\"text\" name=\"captcha\" maxlength=\"5\"></div>" : "";
							
				$mrules["{MIDDLE}"] = $o_tpl->gethtml(TEMPLATES_DIR."/".$m."_form_middle.tpl", $mrules1);
				$o_tpl->addhtml(TEMPLATES_DIR."/default_middle.tpl", $mrules);		
			}
		}
	}
	elseif ($a=="edit" && isset($id) && ($USER_RIGHTS['allow_all_edit'] || ($USER_RIGHTS['allow_edit'] && $ID==$o_news->getOne($id, "user_id")))) {
		
		$result = $o_news->get($id, 0);
        if ($result) {
        	
        	$action_news = $o_vars->post['action_news'];
        	
        	if (!isset($action_news)) {

		   		foreach ($result as $n);
		    		
				$mrules["{TITLE}"] = $LANG[$m.'_edit']. $n[5];
	
				$mrules1["{DATE}"]  	  = (!$n[2])  ? "" : $o_other->makeNormalDate($n[2]);
				$mrules1["{DATEC}"]       = ($n[2])   ? "" : "checked=\"checked\"";
				$mrules1["{EXPIRES}"]     = (!$n[14]) ? "" : $o_other->makeNormalDate($n[14]);
				$mrules1["{EXPIRESC}"]    = ($n[14])  ? "" : "checked=\"checked\"";
				$mrules1["{SHORT_STORY}"] = $n[3];
				$mrules1["{FULL_STORY}"]  = $n[4];
				$mrules1["{TITLE}"]       = $n[5];
				$mrules1["{KEYWORDS}"]    = $n[6];
				$mrules1["{DESCR}"]       = $n[18];
			
				$allow_main1 = (!$USER_RIGHTS['allow_main']) ? "disabled=\"disabled\"" : "";
				$moderation1 = (!$USER_RIGHTS['moderation']) ? "disabled=\"disabled\"" : "";
				
				$mrules1["{ALLOW_COMM_YES}"]  = ($n[8])   ? "checked=\"checked\""            : "";
				$mrules1["{ALLOW_COMM_NO}"]   = (!$n[8])  ? "checked=\"checked\""            : "";
				$mrules1["{ALLOW_MAIN_YES}"]  = ($n[9])   ? "checked=\"checked\""            : "$allow_main1";
				$mrules1["{ALLOW_MAIN_NO}"]   = (!$n[9])  ? "checked=\"checked\""            : "$allow_main1";
				$mrules1["{ALLOW_RATE_YES}"]  = ($n[10])  ? "checked=\"checked\""            : "";
				$mrules1["{ALLOW_RATE_NO}"]   = (!$n[10]) ? "checked=\"checked\""            : "";
				$mrules1["{ONOFF_YES}"]       = ($n[12])  ? "checked=\"checked\""            : "$moderation1";
				$mrules1["{ONOFF_NO}"]        = (!$n[12]) ? "checked=\"checked\""            : "$moderation1";	
				$mrules1["{EXPIRES}"]         = ($n[14])  ? $o_other->makeNormalDate($n[14]) : "";
				$mrules1["{EXPIRES_NO}"]      = (!$n[14]) ? "checked=\"checked\""            : "";
				$mrules1["{MODERATION_YES}"]  = ($n[15])  ? "checked=\"checked\""            : "$moderation1";
				$mrules1["{MODERATION_NO}"]   = (!$n[15]) ? "checked=\"checked\""            : "$moderation1";	
				$mrules1["{FIXED_YES}"]       = ($n[16])  ? "checked=\"checked\""            : "";
				$mrules1["{FIXED_NO}"]        = (!$n[16]) ? "checked=\"checked\""            : "";	
			
				$mrules1["{BB_IMG_UPLOAD}"] = ($USER_RIGHTS['allow_admin'])   ? "<img onclick=\"image_upload();\" title=\"Загрузка файлов на сервер\" alt=\"Загрузка файлов на сервер\" src=\"{TEMPLATE}/images/bbcodes_upload.png\" />" : "";
			
				if ($n[11]) $result = $o_vote->get($n[11]);
				else $result = false;
				
				if ($result) {
					foreach($result as $n1); 
					$mrules1["{VOTE_TITLE}"]      = $n1[2];
					$mrules1["{VOTE_ONOFF_YES}"]  = ($n1[4])  ? "checked=\"checked\"" : "";
					$mrules1["{VOTE_ONOFF_NO}"]   = (!$n1[4]) ? "checked=\"checked\"" : "";
					$mrules1["{VOTE_IS_REG_YES}"] = ($n1[5])  ? "checked=\"checked\"" : "";
					$mrules1["{VOTE_IS_REG_NO}"]  = (!$n1[5]) ? "checked=\"checked\"" : "";
					$mrules1["{VOTE_BODY}"]       = $n1[7];
				}
				else {
					$mrules1["{VOTE_TITLE}"]      = "";
					$mrules1["{VOTE_ONOFF_YES}"]  = "checked=\"checked\"";
					$mrules1["{VOTE_ONOFF_NO}"]   = "";
					$mrules1["{VOTE_IS_REG_YES}"] = "checked=\"checked\"";
					$mrules1["{VOTE_IS_REG_NO}"]  = "";
					$mrules1["{VOTE_BODY}"]       = "";
				}			
			
				$cats = array();
				$cats = explode(",", $n[7]);
				if ($n[7]=="0") {$mrules1["{CATS_SEL}"] = "selected=\"selected\""; $cats = "";}
				else $mrules1["{CATS_SEL}"] = "";
			
				$mrules1["{CATS}"] = "";
				$result = $o_categories->makeTree();
				if ($result)
					foreach ($result as $n1)
						$mrules1["{CATS}"] .= (@in_array($n1[0], $cats)) ? "<option value=\"$n1[0]\" selected=\"selected\">".$n1[1]."</option>" : "<option value=\"$n1[0]\">".$n1[1]."</option>";
				
				$access = array();				$access = explode(",", $n[17]);				if ($n[17]=="0") {$mrules1["{ACCESS_SEL}"] = "selected=\"selected\""; $access = "";}				else $mrules1["{ACCESS_SEL}"] = "";						$mrules1["{ACCESS}"] = "";
				$result = $o_usersgroup->get();				foreach ($result as $n1) 					if ($n1[0]!=1) 						$mrules1["{ACCESS}"] .= (@in_array($n1[0], $access)) ? "<option value=\"$n1[0]\" selected=\"selected\">".$n1[1]."</option>" : "<option value=\"$n1[0]\">".$n1[1]."</option>";
					
				$mrules1["{ACCESS_DIS}"] = ($USER_RIGHTS['id_ug']!=1) ? "disabled=\"disabled\"" : "";
							
				$mrules1["{MESS}"]    = "";
				$mrules1["{CAPTCHA}"] = "";
				$mrules1["{CATS_DIS}"]    = "";
				
				$mrules["{MIDDLE}"] = $o_tpl->gethtml(TEMPLATES_DIR."/news_form_middle.tpl", $mrules1);
				$o_tpl->addhtml(TEMPLATES_DIR."/default_middle.tpl", $mrules);
			}
			else {
			
				$title = stripslashes(htmlspecialchars(strip_tags($o_vars->post['title']), ENT_QUOTES));
				$date  = (!$o_vars->post['date']) ? time() : $o_other->makeToTime($o_vars->post['date']);
			
				if (@in_array("0", $o_vars->post['cats'])) $cats = "0";
				else $cats = @implode(",", $o_categories->makeCats($o_vars->post['cats']));
			
				if ($USER_RIGHTS['id_ug']!=1) $access = $o_news->getOne($id, "access");				elseif (@in_array("0", $o_vars->post['access'])) $access = "0";				else $access = @implode(",", $o_vars->post['access']);
			
				$short_story = (!$USER_RIGHTS['allow_html']) ? $o_wfilter->wordFilter(stripslashes(htmlspecialchars(strip_tags($o_other->strRepl($o_vars->post['short_story'])), ENT_QUOTES))) : $o_wfilter->wordFilter($o_other->strRepl($o_vars->post['short_story']));
				$full_story  = (!$USER_RIGHTS['allow_html']) ? $o_wfilter->wordFilter(stripslashes(htmlspecialchars(strip_tags($o_other->strRepl($o_vars->post['full_story'])), ENT_QUOTES))) : $o_wfilter->wordFilter($o_other->strRepl($o_vars->post['full_story']));
			
				$onoff 	    = intval($o_vars->post['onoff']);
				$allow_main = intval($o_vars->post['allow_main']);
				$moderation	= intval($o_vars->post['moderation']);
				$fixed		= intval($o_vars->post['fixed']);
				$allow_rate = intval($o_vars->post['allow_rate']);
				$allow_comm = intval($o_vars->post['allow_comm']);
				$captcha    = $o_vars->post['captcha'];	
			
				$onoff 	    = intval($o_vars->post['onoff']);
				$allow_main = intval($o_vars->post['allow_main']);
				$moderation	= intval($o_vars->post['moderation']);
				$fixed		= intval($o_vars->post['fixed']);
				$allow_rate = intval($o_vars->post['allow_rate']);
				$allow_comm = intval($o_vars->post['allow_comm']);
						
				$expires = (!$o_vars->post['expires'] || time() > $o_other->makeToTime($o_vars->post['expires'])) ? 0 : $o_other->makeToTime($o_vars->post['expires']);
			
				$descr    = stripslashes(htmlspecialchars(strip_tags($o_vars->post['descr']), ENT_QUOTES));
				$keywords = stripslashes(htmlspecialchars(strip_tags($o_vars->post['keywords']), ENT_QUOTES));
			
		
				$vote_title	 = stripslashes(htmlspecialchars(strip_tags($o_vars->post['vote_title']), ENT_QUOTES));
				$vote_onoff  = intval($o_vars->post['vote_onoff']);
				$vote_is_reg = intval($o_vars->post['vote_is_reg']);
				$vote_body	 = (!$USER_RIGHTS['allow_html']) ? stripslashes(htmlspecialchars(strip_tags($o_other->strRepl($o_vars->post['vote_body'])), ENT_QUOTES)) : stripslashes($o_other->strRepl($o_vars->post['vote_body']));
				$vote_id     = ($o_vote->get($o_news->getOne($id, "vote_id"))) ? $o_news->getOne($id, "vote_id") : 0;
			
				if ($id!="" && $title!="" && $short_story!="" && ($USER_RIGHTS['allow_all_edit'] || ($USER_RIGHTS['allow_edit'] && $ID==$o_news->getOne($id, "user_id")))) {
				
					if ($vote_title!=""&& $vote_body!="") {
						if (!$vote_id) { 
						    $result  = $o_vote->add($vote_title, time(), $vote_onoff, $vote_is_reg, $cats, $vote_body, "1");
						   	if ($result) $vote_id = $o_vote->getLastId();
						}
						else $o_vote->update($vote_id, $vote_title, $vote_onoff, $vote_is_reg, $cats, $vote_body);					
					}
				
					$result = $o_news->update($id, $date, $short_story, $full_story, $title, $keywords, $cats, $allow_comm, $allow_main, $allow_rate, $vote_id, $onoff, $expires, $moderation, $fixed, $access, $descr);
				
			        $o_other->showMess($LANG[$m.'_edit'] .$o_news->getOne($id, "title"), $LANG[$m.'_medit'], "index.php", $LANG['redir_main'], TEMPLATES_DIR);
				}
				else {
					
					$mrules["{TITLE}"] = $LANG[$m.'_edit']. $o_news->getOne($id, "title");
					
					$mrules1["{MESS}"] = $LANG['wrong_input'];
					
					$mrules1["{TITLE}"] = $title;
					$mrules1["{DATE}"]  = (!$o_vars->post['date']) ? ""                    : $o_vars->post['date'];
					$mrules1["{DATEC}"] = (!$o_vars->post['date']) ? "checked=\"checked\"" : "";
				
					$mrules1["{BB_IMG_UPLOAD}"] = ($USER_RIGHTS['allow_admin'])   ? "<img onclick=\"image_upload();\" title=\"Загрузка файлов на сервер\" alt=\"Загрузка файлов на сервер\" src=\"{TEMPLATE}/images/bbcodes_upload.png\" />" : "";
				
					$mrules1["{SHORT_STORY}"] = $short_story;
					$mrules1["{FULL_STORY}"]  = $full_story;
						
					$mrules1["{ONOFF_YES}"]      = ($onoff)       ? "checked=\"checked\"" : "";
					$mrules1["{ONOFF_NO}"]       = (!$onoff)      ? "checked=\"checked\"" : "";
					$mrules1["{ALLOW_MAIN_YES}"] = ($allow_main)  ? "checked=\"checked\"" : ""; 
					$mrules1["{ALLOW_MAIN_NO}"]  = (!$allow_main) ? "checked=\"checked\"" : ""; 
					$mrules1["{MODERATION_YES}"] = ($moderation)  ? "checked=\"checked\"" : ""; 
					$mrules1["{MODERATION_NO}"]  = (!$moderation) ? "checked=\"checked\"" : ""; 			
					$mrules1["{FIXED_YES}"]      = ($fixed)       ? "checked=\"checked\"" : ""; 
					$mrules1["{FIXED_NO}"]       = (!$fixed)      ? "checked=\"checked\"" : ""; 
					$mrules1["{ALLOW_RATE_YES}"] = ($allow_rate)  ? "checked=\"checked\"" : ""; 
					$mrules1["{ALLOW_RATE_NO}"]  = (!$allow_rate) ? "checked=\"checked\"" : ""; 
					$mrules1["{ALLOW_COMM_YES}"] = ($allow_comm)  ? "checked=\"checked\"" : ""; 
					$mrules1["{ALLOW_COMM_NO}"]  = (!$allow_comm) ? "checked=\"checked\"" : "";
			
					if (!$USER_RIGHTS['allow_main']) {
						$mrules1["{ALLOW_MAIN_YES}"] = ($USER_RIGHTS['allow_main'])  ? "checked=\"checked\"" : "disabled=\"disabled\"";
						$mrules1["{ALLOW_MAIN_NO}"]  = (!$USER_RIGHTS['allow_main']) ? "checked=\"checked\"" : "";
					}
					if (!$USER_RIGHTS['moderation']) {
						$mrules1["{ONOFF_YES}"]      = ($USER_RIGHTS['moderation'])  ? "checked=\"checked\"" : "disabled=\"disabled\"";
						$mrules1["{ONOFF_NO}"]       = (!$USER_RIGHTS['moderation']) ? "checked=\"checked\"" : "";
						$mrules1["{MODERATION_NO}"]  = ($USER_RIGHTS['moderation'])  ? "checked=\"checked\"" : "disabled=\"disabled\"";
						$mrules1["{MODERATION_YES}"] = (!$USER_RIGHTS['moderation']) ? "checked=\"checked\"" : ""; 
					}
			
					$mrules1["{EXPIRES}"]  = (!$expires) ? ""                    : $o_vars->post['expires'];
					$mrules1["{EXPIRESC}"] = (!$expires) ? "checked=\"checked\"" : "";
							
					$mrules1["{DESCR}"]    = $descr;
					$mrules1["{KEYWORDS}"] = $keywords;
					
					$mrules1["{VOTE_TITLE}"] = $vote_title;
					$mrules1["{VOTE_BODY}"]  = $vote_body;
				
					$mrules1["{VOTE_ONOFF_YES}"]  = ($vote_onoff)   ? "checked=\"checked\"" : "" ; 
					$mrules1["{VOTE_ONOFF_NO}"]   = (!$vote_onoff)  ? "checked=\"checked\"" : "" ; 
					$mrules1["{VOTE_IS_REG_YES}"] = ($vote_is_reg)  ? "checked=\"checked\"" : "" ; 
					$mrules1["{VOTE_IS_REG_NO}"]  = (!$vote_is_reg) ? "checked=\"checked\"" : "" ; 
			
					$access1 = array();					$access1 = explode(",", $access);					if ($access=="0") {$mrules1["{ACCESS_SEL}"] = "selected=\"selected\""; $access1 = "";}					else $mrules1["{ACCESS_SEL}"] = "";							$mrules1["{ACCESS}"] = "";
					$result = $o_usersgroup->get();					foreach ($result as $n1) 						if ($n1[0]!=1) $mrules1["{ACCESS}"] .= (@in_array($n1[0], $access1)) ? "<option value=\"$n1[0]\" selected=\"selected\">".$n1[1]."</option>" : "<option value=\"$n1[0]\">".$n1[1]."</option>";
				
					$cats1 = array();					
					$cats1 = explode(",", $cats);
					if ($cats=="0") {$mrules1["{CATS_SEL}"] = "selected=\"selected\""; $cats1 = "";}
					else $mrules1["{CATS_SEL}"] = "";
			
					$mrules1["{CATS}"] = "";
					$result  = $o_categories->makeTree();			
					if ($result)
						foreach ($result as $n)
							$mrules1["{CATS}"] .= (@in_array($n[0], $cats1)) ? "<option value=\"$n[0]\" selected=\"selected\">".$n[1]."</option>" : "<option value=\"$n[0]\">".$n[1]."</option>";
								
					$mrules1["{ACCESS_DIS}"] = "";
					$mrules1["{CAPTCHA}"]    = "";
				
					$mrules["{MIDDLE}"] = $o_tpl->gethtml(TEMPLATES_DIR."/news_form_middle.tpl", $mrules1);
					$o_tpl->addhtml(TEMPLATES_DIR."/default_middle.tpl", $mrules);
				}
			}
		}
		else $o_other->showMess($LANG[$m.'_edit'], $LANG[$m.'_eget'], "index.php", $LANG['redir_main'], TEMPLATES_DIR);
	}
	elseif ($a=="del" && isset($id) && ($USER_RIGHTS['allow_all_edit'] || ($USER_RIGHTS['allow_edit'] && $ID==$o_news->getOne($id, "user_id")))) {

		$result = $o_news->del($id);
		
		if($result) $o_other->showMess($LANG[$m.'_del'], $LANG[$m.'_mdel'], "index.php", $LANG['redir_main'], TEMPLATES_DIR);
		else $o_other->showMess($LANG[$m.'_del'], $LANG[$m.'_eget'], "index.php", $LANG['redir_main'], TEMPLATES_DIR);
    }   
	elseif ($a!="add" &&  !isset($id)) {
		$result = $o_news->getS(0, $o_news->kolNewsS(0, 0, 0, false), 0, 0, 0, false);
        if (!$result) $o_other->showMess($LANG[$m], $LANG[$m.'_egets'], "index.php", $LANG['redir_main'], TEMPLATES_DIR);  
		else {
			$mrules["{TITLE}"]  = $LANG[$m];
			foreach ($result as $n) {
				
				$n[5] = (strlen($n[5]) < 31) ? $n[5] : mb_substr($n[5], 0, 28, 'UTF-8') . '...';
	            				
			    $mrules1["{ID}"]        = $n[0];
			    $mrules1["{DATE}"]      = $o_other->makeNormalDate($n[2],1);
	            $mrules1["{AUTOR}"]     = ($o_users->getOne($n[19], "name")) ? "<a href=\"?m=profile&amp;id=$n[19]\">".$o_users->getOne($n[19], "name")."</a>" : $n[1];
	            $mrules1["{TITLE}"]     = ($USER_RIGHTS['allow_short'] && $o_categories->isAllowCate($USER_RIGHTS['allow_cats'], $n[7]) && $o_other->isAllowAccess($USER_RIGHTS['id_ug'], $n[17])) ? "<a href=\"?m=$m&amp;id=$n[0]\">$n[5]</a>" : $n[5];
	            $mrules1["{NEWS_READ}"] = $n[13];
	            $mrules1["{KOL_COMM}"]  = $o_comments->kolInNews($n[0]);
		        
		       $mrules1['{DEL}']  = ($USER_RIGHTS['allow_all_edit'] || ($USER_RIGHTS['allow_edit'] && $ID==$n[19])) ? "<a href=\"index.php?m=$m&amp;a=del&amp;id=$n[0]\"><img src=\"".TEMPLATES_DIR."/images/del.png\" title=\"".$LANG['del']."\" alt=\"".$LANG['del']."\" /></a>" : "";
				$mrules1['{EDIT}'] = ($USER_RIGHTS['allow_all_edit'] || ($USER_RIGHTS['allow_edit'] && $ID==$n[19])) ? "<a href=\"index.php?m=$m&amp;a=edit&amp;id=$n[0]\"><img src=\"".TEMPLATES_DIR."/images/edit.png\" title=\"".$LANG['edit']."\" alt=\"".$LANG['edit']."\" /></a>" : "";
				
				$mrules["{MIDDLE}"] .= $o_tpl->gethtml(TEMPLATES_DIR."/".$m."_allshowm_middle.tpl", $mrules1);
				
			}
			$o_tpl->addhtml(TEMPLATES_DIR."/default_middle.tpl", $mrules);
			
		}
	}
	elseif ($a!="add" && $a!="edit" && $a!="del" && (($USER_RIGHTS['allow_short'] && $o_categories->isAllowCate($USER_RIGHTS['allow_cats'], $o_news->getOne($id, "cats")) && $o_other->isAllowAccess($USER_RIGHTS['id_ug'], $o_news->getOne($id, "access"))) || (!$o_news->getOne($id, "onoff")))) {
		
		$result = $o_news->get($id, 1);
		if (!$result) $o_other->showMess($LANG[$m], $LANG[$m.'_eget'], "index.php", $LANG['redir_main'], TEMPLATES_DIR);  
		else {
			
			$banners_top    = "";
	        $banners_buttom = "";
	        $result1 = $o_banners->getS(3);
	        if ($result1) {
	            foreach ($result1 as $n) {
	                if ($n[5]=="1" || $n[5]=="4" || $n[5]=="5" || $n[5]=="7") $banners_top    .= $n[2];
	                if ($n[5]=="3" || $n[5]=="5" || $n[5]=="6" || $n[5]=="7") $banners_buttom .= $n[2];
	            } 	
	        }
	        if ($banners_top) $o_tpl->addhtml($banners_top);
			
			if ($a=="delc" && isset($idc) && ($USER_RIGHTS['del_allc'] || ($USER_RIGHTS['allow_delc'] && $ID==$o_comments->getOne($idc, "user_id") && $ID)))
				$o_comments->del($idc);
			
			$o_news->newsReadPP($id);
			foreach ($result as $n); 
		   	
			$action_addcomm = $o_vars->post['action_addcomm'];
	    
		    if (isset($action_addcomm)) {
				
				$user_id = ($ID) ? $ID : 0;
				$autor   = ($o_vars->post['autor']) ? stripslashes(htmlspecialchars(strip_tags($o_vars->post['autor']), ENT_QUOTES)) : $USER['name'];
				$email   = ($o_vars->post['email']) ? stripslashes(htmlspecialchars(strip_tags($o_vars->post['email']), ENT_QUOTES)) : $USER['email'];
				$icq     = ($o_vars->post['icq'])   ? stripslashes(htmlspecialchars(strip_tags($o_vars->post['icq']), ENT_QUOTES))   : $USER['icq'];
				$text    = (!$USER_RIGHTS['allow_html']) ? $o_wfilter->wordFilter(stripslashes(htmlspecialchars(strip_tags($o_other->strRepl($o_vars->post['text'])), ENT_QUOTES))) : $o_wfilter->wordFilter(stripslashes($o_other->strRepl($o_vars->post['text'])));
				
				$captcha = $o_vars->post['captcha'];
				
				if ($autor!="" && $text!="" && $o_other->check($email, RE_MAIL) && (($captcha!="" && $_SESSION['captcha']==$captcha) || !$USER_RIGHTS['captcha'])) {
					$o_comments->add($n[0], $user_id, time(), $autor, $email, $icq, $text, IP);
				}
			}
			
			$action_editcomm = $o_vars->post['action_editcomm'];
	    
		    if (isset($action_editcomm) && isset($idc) && ($USER_RIGHTS['edit_allc'] || ($USER_RIGHTS['allow_editc'] && $ID==$o_comments->getOne($idc, "user_id") && $ID))) {
				
				$text = (!$USER_RIGHTS['allow_html']) ? $o_wfilter->wordFilter(stripslashes(htmlspecialchars(strip_tags($o_other->strRepl($o_vars->post['text'])), ENT_QUOTES))) : $o_wfilter->wordFilter(stripslashes($o_other->strRepl($o_vars->post['text'])));
				
				if ($text!="" && $idc!="") $o_comments->update($idc, $text);
			}
		      	
			$mrules["{ID}"]         = $n[0];
			$mrules["{DATE}"]       = $o_other->makeNormalDate($n[2],1);
	        $mrules["{AUTOR}"]      = ($o_users->getOne($n[19], "name")) ? "<a href=\"?m=profile&amp;id=$n[19]\">".$o_users->getOne($n[19], "name")."</a>" : $n[1];
	        $mrules["{TITLE}"]      = $n[5];
	        $mrules["{FULL_STORY}"] = ($n[4]!="") ? $o_bbcodes->filter(nl2br($n[4]), $USER_RIGHTS['allow_hide']) : $o_bbcodes->filter(nl2br($n[3]), $USER_RIGHTS['allow_hide']);
	        $mrules["{NEWS_READ}"]  = $n[13];
	        $mrules["{KOL_COMM}"]   = $o_comments->kolInNews($n[0]);
	        
	        $TITLE    = $n[5];
			$DESCR    = $n[18];
	        $KEYWORDS = $n[6];
	        
	        $mrules["{BOOKMARKS}"] = "";
			if ($ID) {
	        	$result1 = $o_users->getUserBookmarks($ID);
				$mrules["{BOOKMARKS}"] = "<img src=\"".TEMPLATES_DIR."/images/bookmarks_plus.png\" onclick=\"gogoAj('bookmark_$n[0]','bookmarks','act=add&amp;user_id=$ID&amp;news_id=$n[0]','{TEMPLATE}',2);\" style=\"cursor: pointer;\" title=\"".$LANG['bookmarks_add']."\" alt=\"".$LANG['bookmarks_add']."\" />";
				if ($result1) { 
					$k = 0;
					foreach($result1 as $n1) 
					if ($n1[0]==$n[0]) {$k = 1; break;}
					if ($k)	$mrules["{BOOKMARKS}"] = "<img src=\"".TEMPLATES_DIR."/images/bookmarks_minus.png\" onclick=\"gogoAj('bookmark_$n[0]','bookmarks','act=del&amp;user_id=$ID&amp;news_id=$n[0]','{TEMPLATE}',2);\" style=\"cursor: pointer;\" title=\"".$LANG['bookmarks_del']."\" alt=\"".$LANG['bookmarks_del']."\" />";
				}
			}
			
			if ($n[10]) {
				$sum_kol = $o_vote->SumKolVotesNews($n[0]);
				if ($sum_kol[0][1])	$pr = round($sum_kol[0][0]/$sum_kol[0][1]*17);
				else $pr = 0;
		
				if (!$o_vote->getKolRateOnIp($n[0], IP) && $USER_RIGHTS['allow_rating']) {
					$mrules["{RATE}"] = "
						<ul class=\"unit-rating\">
							<li class=\"current-rating\" style=\"width: ".$pr."px;\">$pr</li>
							<li><a href=\"#\" title=\"".$LANG['rate_1']."\" class=\"r1-unit\" onclick=\"gogoAj('rate_$n[0]','rate','vote=1&amp;id=$n[0]','{TEMPLATE}',1); return false;\">1</a></li>
							<li><a href=\"#\" title=\"".$LANG['rate_2']."\" class=\"r2-unit\" onclick=\"gogoAj('rate_$n[0]','rate','vote=2&amp;id=$n[0]','{TEMPLATE}',1); return false;\">2</a></li>
							<li><a href=\"#\" title=\"".$LANG['rate_3']."\" class=\"r3-unit\" onclick=\"gogoAj('rate_$n[0]','rate','vote=3&amp;id=$n[0]','{TEMPLATE}',1); return false;\">3</a></li>
							<li><a href=\"#\" title=\"".$LANG['rate_4']."\" class=\"r4-unit\" onclick=\"gogoAj('rate_$n[0]','rate','vote=4&amp;id=$n[0]','{TEMPLATE}',1); return false;\">4</a></li>
							<li><a href=\"#\" title=\"".$LANG['rate_5']."\" class=\"r5-unit\" onclick=\"gogoAj('rate_$n[0]','rate','vote=5&amp;id=$n[0]','{TEMPLATE}',1); return false;\">5</a></li>
						</ul>";	
				}
				else $mrules["{RATE}"] = "<ul class=\"unit-rating\"><li class=\"current-rating\" style=\"width: ".$pr."px;\">$pr</li></ul>";
			}
			else $mrules["{RATE}"] = "";
			 
			$mrules["{CATE}"] = "";
			if ($n[7]) {
				$a1 = explode(",", $n[7]);
				if (count($a1)==1) {
					$a2 = $o_categories->makeWayCate($a1[0]);
					for ($i = 0; $a2[$i]; $i++) $mrules["{CATE}"] .= "<a href='?m=categories&amp;id=$a2[$i]'>".$o_categories->getOne($a2[$i], "name")."</a> &raquo; ";	
					$mrules["{CATE}"] = substr($mrules["{CATE}"], 0, -8);
				}
				else {
					for ($i = 0; $a1[$i]; $i++) $mrules["{CATE}"] .= "<a href='?m=categories&amp;id=$a1[$i]'>".$o_categories->getOne($a1[$i], "name")."</a> &amp; ";
					$mrules["{CATE}"] = substr($mrules["{CATE}"], 0, -7);	          	
				}
			}
				
			$mrules["{VOTE}"] = "";
			if ($n[11] && $USER_RIGHTS['allow_poll']) {
				$result = $o_vote->get($n[11], 1);
				if ($result) {
		        	foreach ($result as $n1);
			        if ($n1[4]) {
			        	$mrules1["{TITLE}"] = $n1[2];
			        	$mrules1["{ID}"]    = $n1[0];
			        	$a1 = explode("\n", $n1[7]);
			        	$mrules1["{VOTES}"] = "<input name=\"news_vote\" type=\"radio\" onclick=\"news_vote_help=1;\" checked=\"checked\"> ".$o_bbcodes->filter($a1[0])."<br />";
			        	for ($i = 1; $i < count($a1); $i++)
							$mrules1["{VOTES}"] .= "<input name=\"news_vote\" type=\"radio\" onclick=\"news_vote_help=".($i+1).";\"> ".$o_bbcodes->filter($a1[$i])."<br />";
								        		
		        		$mrules["{VOTE}"] = $o_tpl->gethtml(TEMPLATES_DIR."/news_vote.tpl", $mrules1);    
		            }
		        }
			}
			
			$mrules['{DEL}']  = ($USER_RIGHTS['allow_all_edit'] || ($USER_RIGHTS['allow_edit'] && $ID==$n[19])) ? "<a href=\"index.php?m=$m&amp;a=del&amp;id=$n[0]\"><img src=\"".TEMPLATES_DIR."/images/del.png\" title=\"".$LANG['del']."\" alt=\"".$LANG['del']."\" /></a>" : "";
			$mrules['{EDIT}'] = ($USER_RIGHTS['allow_all_edit'] || ($USER_RIGHTS['allow_edit'] && $ID==$n[19])) ? "<a href=\"index.php?m=$m&amp;a=edit&amp;id=$n[0]\"><img src=\"".TEMPLATES_DIR."/images/edit.png\" title=\"".$LANG['edit']."\" alt=\"".$LANG['edit']."\" /></a>" : "";
			
			$o_tpl->addhtml(TEMPLATES_DIR."/".$m."_show.tpl", $mrules);
	    
			unset($mrules);
	    
	    	$p = ($o_vars->get['p']) ? $o_vars->get['p'] : 0;
	    
			$kol_comm_on_p = $CONFIG['comm_num'];
	    
	    	$result = $o_comments->get($id, $p, $kol_comm_on_p, $CONFIG['comm_msort']);
	   
	    	if ($result) {
				foreach($result as $n1) {
				
					$mrules["{AVATAR}"]     = AVATARS_DIR."/0.png";
					$mrules['{USERSGROUP}'] = "";
					$mrules['{IS_REG}']     = $LANG['no'];  	
			
					if ($n1[2]) {
						$result1 = $o_users->get($n1[2]);
						if ($result1) {
							foreach ($result1 as $n2);
							$mrules["{AVATAR}"]     = ($n2[9]) ? AVATARS_DIR ."/" .$n2[9] : AVATARS_DIR ."/0.png";
							$mrules['{USERSGROUP}'] = (!$n2[5]) ? "" : "(".$o_usersgroup->getOne($n2[5], "group_name").")";
							$mrules['{IS_REG}']     = ($o_users->get($n1[2])) ? $LANG['yes'] : $LANG['no'];  	
						}
					}
					
					$mrules['{AUTOR}'] = ($o_users->getOne($n1[2], "name")) ? $o_users->getOne($n1[2], "name") : $n1[4];
					$mrules['{AUTOR1}'] = ($o_users->getOne($n1[2], "name")) ? "<a href=\"?m=profile&amp;id=$n1[2]\">".$o_users->getOne($n1[2], "name")."</a>" : $n1[4];
					$mrules['{DATE}']  = $o_other->makeNormalDate($n1[3]);
					$mrules['{EMAIL}'] = $n1[5];
					$mrules['{IP}']    = $n1[8];
					$mrules['{ICQ}']   = ($n1[6]) ? $n1[6] : $LANG['no'];
					$mrules['{TEXT}']  = nl2br($n1[7]);
										
					$mrules['{DELC}']  = ($USER_RIGHTS['del_allc'] || ($USER_RIGHTS['allow_delc'] && $ID==$n1[2])) ? "<a href=\"index.php?m=$m&amp;id=$id&amp;p=$p&amp;a=delc&amp;idc=$n1[0]\"><img src=\"".TEMPLATES_DIR."/images/del.png\" title=\"".$LANG['del']."\" alt=\"".$LANG['del']."\" /></a>" : "";
					$mrules['{EDITC}'] = ($USER_RIGHTS['edit_allc'] || ($USER_RIGHTS['allow_editc'] && $ID==$n1[2])) ? "<a href=\"index.php?m=$m&amp;id=$id&amp;p=$p&amp;a=editc&amp;idc=$n1[0]#ecomment\"><img src=\"".TEMPLATES_DIR."/images/edit.png\" title=\"".$LANG['edit']."\" alt=\"".$LANG['edit']."\" /></a>" : "";
					
					$o_tpl->addhtml(TEMPLATES_DIR."/comments_show.tpl", $mrules);
				}
			}
	    
		    if ($result) {
				$kol_comm = $o_comments->kolInNews($id);
				$kol_p = ceil($kol_comm / $kol_comm_on_p);
				if ($kol_p > 1) {
					
					unset($mrules);
						 
					if ($p > 0) $mrules["{PRIV}"] = "<a href=\"index.php?m=$m&amp;id=$id&amp;p=".($p-1)."\">".$LANG['spriv']."</a>";
					else $mrules["{PRIV}"] = "<span>".$LANG['spriv']."</span>";

					$mrules["{LPAGES}"] = "";
	
					for ($i = 0, $t1 = 1, $t2 = 1; $i < $kol_p; $i++) {
						if ($kol_p > 13) {   
							
							if ($i < 4 || ($i-$p) < 2 && $p < 6) $mrules["{LPAGES}"] .= ($i==$p) ? "<span class=\"sp\">".($i+1)."</span> " : "<a href=\"index.php?m=$m&amp;id=$id&amp;p=$i\">".($i+1)."</a> "; 
							elseif ($t1)  {$mrules["{LPAGES}"] .= " ... "; $t1 = 0;}
							
							if ($i > ($p-2) && $p > 5 && $p < ($kol_p - 6) && ($i-$p) < 2) $mrules["{LPAGES}"] .= ($i==$p) ? "<span class=\"sp\">".($i+1)."</span> " : "<a href=\"index.php?m=$m&amp;id=$id&amp;p=$i\">".($i+1)."</a> ";
							elseif ($t2 && $p > 5 && $i > 4 && $p < ($kol_p - 6) && $i > ($kol_p - 5))  {$mrules["{LPAGES}"] .= " ... "; $t2 = 0;}				        
					
							
						    if ($i > ($kol_p - 5) || ($p - $i) < 2 && $p > ($kol_p - 7)) $mrules["{LPAGES}"] .= ($i==$p) ? "<span class=\"sp\">".($i+1)."</span> " : "<a href=\"index.php?m=$m&amp;id=$id&amp;p=$i\">".($i+1)."</a> ";
						}
						else $mrules["{LPAGES}"] .= ($i==$p) ? "<span class=\"sp\">".($i+1)."</span> " : "<a href=\"index.php?m=$m&amp;id=$id&amp;p=$i\">".($i+1)."</a> ";
					}
			
					if ($kol_comm - $kol_comm_on_p  * ($p + 1) > 0) $mrules["{NEXT}"] = "<a href=\"index.php?m=$m&amp;id=$id&amp;p=".($p+1)."\">".$LANG['snext']."</a>";
					else $mrules["{NEXT}"] = "<span>".$LANG['snext']."</span>";
	
					$o_tpl->addhtml(TEMPLATES_DIR."/pages.tpl", $mrules);
				}	
			}
			if ($a=="editc" && isset($idc) && !$action_editcomm && ($USER_RIGHTS['edit_allc'] || ($USER_RIGHTS['allow_editc'] && $ID==$o_comments->getOne($idc, "user_id") && $ID))) {
				unset($mrules);
	    				
	    		$mrules["{TITLE}"] = $LANG['comments_edit'];
	    		
	    		$mrules1["{TEXT}"] = $o_comments->getOne($idc, "text");
	    			    		  		
				$mrules["{MIDDLE}"] = $o_tpl->gethtml(TEMPLATES_DIR."/comments_edit_middle.tpl", $mrules1);
				$o_tpl->addhtml(TEMPLATES_DIR."/default_middle.tpl", $mrules);
			}
			elseif ($n[8] && $USER_RIGHTS['allow_addc']) {
	    		
	    		unset($mrules);
	    				
	    		$mrules["{TITLE}"] = $LANG['comments_add'];
	    			    			    		
	    		$mrules1["{CAPTCHA}"] = ($USER_RIGHTS['captcha']) ? "<div class=\"captcha\"><img src=\"?m=captcha\" alt=\"\" /> <input type=\"text\" name=\"captcha\" maxlength=\"5\" /></div>" : "";
	    		
				if ($ID) $mrules["{MIDDLE}"] = $o_tpl->gethtml(TEMPLATES_DIR."/comments_add_middle1.tpl", $mrules1);
				else $mrules["{MIDDLE}"]     = $o_tpl->gethtml(TEMPLATES_DIR."/comments_add_middle2.tpl", $mrules1);
				$o_tpl->addhtml(TEMPLATES_DIR."/default_middle.tpl", $mrules);
			}
			if ($banners_buttom) $o_tpl->addhtml($banners_buttom);
		}
    }
	elseif ($a=="add" || $a=="edit" || $a=="del" || isset($id)) $o_other->showMess($LANG['mess'], $LANG['eaccess'], "index.php", $LANG['redir_main'], TEMPLATES_DIR);

?>
