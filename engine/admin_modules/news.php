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
// Назначение: Модуль управления новостями (админка)
//=============================================================================/
*/

    if (!defined("OLE")) die("<script>window.location = \"./\"</script>");
	
	if ($USER_RIGHTS['allow_edit'] || $USER_RIGHTS['allow_all_edit'] || $USER_RIGHTS['allow_adds']) {
		
		include(CLASSES."/news.class.php");
		include(CLASSES."/categories.class.php");
		include(CLASSES."/comments.class.php");
		include(CLASSES."/vote.class.php");
		include(CLASSES."/wfilter.class.php");
		
		$o_news 	  = new news($o_mysql);
		$o_categories = new categories($o_mysql);
		$o_comments   = new comments($o_mysql);
		$o_vote 	  = new vote($o_mysql);
		$o_wfilter 	  = new wfilter($o_mysql);
		
		$a  = $o_vars->get['a'];
		$id = $o_vars->get['id'];
			
		if ($a=="add" && $USER_RIGHTS['allow_adds']) {
		
			$sw = false;
			
			$action = $o_vars->post['action'];
			
		    if (!isset($action)) {	
				
				$mrules["{TITLEE}"] = $LANG[$m.'_fadd'];
	        	
	        	$mrules["{DATE}"]        = "";
				$mrules["{DATEC}"]       = "checked=\"checked\"";
				$mrules["{SHORT_STORY}"] = "";
				$mrules["{FULL_STORY}"]  = "";
				$mrules["{TITLE}"]       = "";
				$mrules["{KEYWORDS}"]    = "";
				$mrules["{DESCR}"]       = "";
				$mrules["{EXPIRES}"]     = "";
				$mrules["{EXPIRESC}"]    = "checked=\"checked\"";
			
				$mrules["{ALLOW_MAIN_YES}"] = ($USER_RIGHTS['allow_main'])  ? "checked=\"checked\"" : "disabled=\"disabled\"";
				$mrules["{ALLOW_MAIN_NO}"]  = (!$USER_RIGHTS['allow_main']) ? "checked=\"checked\"" : "";
				$mrules["{ONOFF_YES}"]      = ($USER_RIGHTS['moderation'])  ? "checked=\"checked\"" : "disabled=\"disabled\"";
				$mrules["{ONOFF_NO}"]       = (!$USER_RIGHTS['moderation']) ? "checked=\"checked\"" : "";
				$mrules["{MODERATION_NO}"]  = ($USER_RIGHTS['moderation'])  ? "checked=\"checked\"" : "disabled=\"disabled\"";
				$mrules["{MODERATION_YES}"] = (!$USER_RIGHTS['moderation']) ? "checked=\"checked\"" : "";	
				
				$mrules["{ALLOW_COMM_YES}"] = "checked=\"checked\"";
				$mrules["{ALLOW_COMM_NO}"]  = "";
				$mrules["{ALLOW_RATE_YES}"] = "checked=\"checked\"";
				$mrules["{ALLOW_RATE_NO}"]  = "";
				$mrules["{FIXED_YES}"]      = "";
				$mrules["{FIXED_NO}"]       = "checked=\"checked\"";
		
				$mrules["{VOTE_TITLE}"]      = "";
				$mrules["{VOTE_ONOFF_YES}"]  = "checked=\"checked\"";
				$mrules["{VOTE_ONOFF_NO}"]   = "";
				$mrules["{VOTE_IS_REG_YES}"] = "";
				$mrules["{VOTE_IS_REG_NO}"]  = "checked=\"checked\"";
				$mrules["{VOTE_BODY}"]       = "";
				
				$cats = array();
				$cats = explode(",", $USER_RIGHTS['cat_add']);
				if ($USER_RIGHTS['cat_add']=="0" || $USER_RIGHTS['allow_edit'] || $USER_RIGHTS['allow_all_edit']) {$mrules["{CATS_SEL}"] = "selected=\"selected\""; $cats = ""; $mrules["{CATS_DIS}"] = "";}
				else {$mrules["{CATS_SEL}"] = ""; $mrules["{CATS_DIS}"] = "disabled=\"disabled\"";}
		
				$mrules["{CATS}"] = "";
				$result = $o_categories->makeTree();
				if ($result) 
					foreach ($result as $n)
						$mrules["{CATS}"] .= (@in_array($n[0], $cats)) ? "<option value=\"$n[0]\" selected=\"selected\">".$n[1]."</option>" : "<option value=\"$n[0]\">".$n[1]."</option>";
		
				$mrules["{ACCESS_SEL}"] = "selected=\"selected\"";
		
				$mrules["{ACCESS}"] = "";
				$result = $o_usersgroup->get();
				foreach ($result as $n) if ($n[0]!=1) $mrules["{ACCESS}"] .= "<option value=\"$n[0]\">".$n[1]."</option>";
			
				$mrules["{ACCESS_DIS}"] = ($USER_RIGHTS['id_ug']!=1) ? "disabled=\"disabled\"" : "";
									
		    	$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);
			}
		    else {
		
				$autor = $o_users->getOne($ID, "name");
				$title = stripslashes(htmlspecialchars(strip_tags($o_vars->post['title']), ENT_QUOTES));
				$date  = (!$o_vars->post['date']) ? time() : $o_other->makeToTime($o_vars->post['date']);
			
				if (!$USER_RIGHTS['allow_edit'] || !$USER_RIGHTS['allow_all_edit']) $cats = $USER_RIGHTS['cat_add'];
				elseif (@in_array("0", $o_vars->post['cats'])) $cats = "0";
				else $cats = @implode(",", $o_categories->makeCats($o_vars->post['cats']));
			
				$short_story = (!$USER_RIGHTS['allow_html']) ? $o_wfilter->wordFilter(stripslashes(htmlspecialchars(strip_tags($o_other->strRepl($o_vars->post['short_story'])), ENT_QUOTES))) : $o_wfilter->wordFilter($o_other->strRepl($o_vars->post['short_story']));
				$full_story  = (!$USER_RIGHTS['allow_html']) ? $o_wfilter->wordFilter(stripslashes(htmlspecialchars(strip_tags($o_other->strRepl($o_vars->post['full_story'])), ENT_QUOTES))) : $o_wfilter->wordFilter($o_other->strRepl($o_vars->post['full_story']));
								
				$onoff 	     = intval($o_vars->post['onoff']);
				$allow_main  = intval($o_vars->post['allow_main']);
				$moderation	 = intval($o_vars->post['moderation']);
				$fixed		 = intval($o_vars->post['fixed']);
				$allow_rate  = intval($o_vars->post['allow_rate']);
				$allow_comm  = intval($o_vars->post['allow_comm']);	
				$expires     = (!$o_vars->post['expires'] || time() > $o_other->makeToTime($o_vars->post['expires'])) ? 0 : $o_other->makeToTime($o_vars->post['expires']);
				$descr       = stripslashes(htmlspecialchars(strip_tags($o_vars->post['descr']), ENT_QUOTES));
				$keywords    = stripslashes(htmlspecialchars(strip_tags($o_vars->post['keywords']), ENT_QUOTES));
			
				if (@in_array("0", $o_vars->post['access'])) $access = "0";
				else $access = @implode(",", $o_vars->post['access']);
			
				$vote_title  = stripslashes(htmlspecialchars(strip_tags($o_vars->post['vote_title']), ENT_QUOTES));
				$vote_onoff  = intval($o_vars->post['vote_onoff']);
				$vote_is_reg = intval($o_vars->post['vote_is_reg']);
				$vote_body	 = (!$USER_RIGHTS['allow_html']) ? stripslashes(htmlspecialchars(strip_tags($o_other->strRepl($o_vars->post['vote_body'])), ENT_QUOTES)) : stripslashes($o_other->strRepl($o_vars->post['vote_body']));
				$vote_id     = 0;
						       
				if ($title!="" && $short_story!="") {
				
					$sw = true;
					
					if ($vote_title!="" && $vote_body!="") { 
					   $result  = $o_vote->add($vote_title, time(), $vote_onoff, $vote_is_reg, $cats, $vote_body, "1");
					   if ($result) $vote_id = $o_vote->getLastId(); 
					}
	
					$result = $o_news->add($autor, $date, $short_story, $full_story, $title, $keywords, $cats, $allow_comm, $allow_main, $allow_rate, $vote_id, $onoff, 0, $expires, $moderation, $fixed, $access, $descr, $ID);
		        	
		        	if ($ID!="1" && $result && $CONFIG['news_email']) {
				    
						$mrules["{*CATEGORY*}"] = "";
					    if ($n[7]) {
						    $a = explode(",", $cats);
						    if (count($a)==1) {
							    $a1 = $o_categories->makeWayCate($a[0]);
							    for ($i = 0; $a1[$i]; $i++) $mrules["{*CATEGORY*}"] .= $o_categories->getOne($a1[$i], "group_name")." &raquo; ";	
							    $mrules["{*CATEGORY*}"] = substr($mrules["{*CATEGORY*}"], 0, -8);
						    }
						    else {
							    for ($i = 0; $a[$i]; $i++) $mrules["{*CATEGORY*}"] .= $o_categories->getOne($a[$i], "group_name")." &amp; ";
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
		        	
		        	if ($result) $MESS = $o_other->showMessA($LANG[$m.'_add']);
	            	else $MESS = $o_other->showMessA($LANG[$m.'_eadd'], 1); 
		       	}
		        else {
			
					$mrules["{TITLEE}"] = $LANG[$m.'_fadd'];
					
					$mrules["{TITLE}"]       = $title;
					$mrules["{SHORT_STORY}"] = $short_story;
					$mrules["{FULL_STORY}"]  = $full_story;
					$mrules["{DESCR}"]       = $descr;
					$mrules["{KEYWORDS}"]    = $keywords;
					$mrules["{VOTE_TITLE}"]  = $vote_title;
					$mrules["{VOTE_BODY}"]   = $vote_body;
					
					$mrules["{DATE}"]  = (!$o_vars->post['date']) ? ""                    : $o_vars->post['date'];
					$mrules["{DATEC}"] = (!$o_vars->post['date']) ? "checked=\"checked\"" : "";
								
					$allow_main1 = (!$USER_RIGHTS['allow_main']) ? "disabled=\"disabled\"" : "";
					$moderation1 = (!$USER_RIGHTS['moderation']) ? "disabled=\"disabled\"" : "";
				
					$mrules["{ALLOW_COMM_YES}"] = ($allow_comm)  ? "checked=\"checked\"" : "";
					$mrules["{ALLOW_COMM_NO}"]  = (!$allow_comm) ? "checked=\"checked\"" : "";
					$mrules["{ALLOW_MAIN_YES}"] = ($allow_main)  ? "checked=\"checked\"" : $allow_main1;
					$mrules["{ALLOW_MAIN_NO}"]  = (!$allow_main) ? "checked=\"checked\"" : $allow_main1;
					$mrules["{ALLOW_RATE_YES}"] = ($allow_rate)  ? "checked=\"checked\"" : "";
					$mrules["{ALLOW_RATE_NO}"]  = (!$allow_rate) ? "checked=\"checked\"" : "";
					$mrules["{ONOFF_YES}"]      = ($onoff)       ? "checked=\"checked\"" : $moderation1;
					$mrules["{ONOFF_NO}"]       = (!$onoff)      ? "checked=\"checked\"" : $moderation1;	
					$mrules["{MODERATION_YES}"] = ($moderation)  ? "checked=\"checked\"" : $moderation1;
					$mrules["{MODERATION_NO}"]  = (!$moderation) ? "checked=\"checked\"" : $moderation1;	
					$mrules["{FIXED_YES}"]      = ($fixed)       ? "checked=\"checked\"" : "";
					$mrules["{FIXED_NO}"]       = (!$fixed)      ? "checked=\"checked\"" : "";	
			
					$mrules["{EXPIRES}"]  = (!$expires) ? ""                    : $o_vars->post['expires'];
					$mrules["{EXPIRESC}"] = (!$expires) ? "checked=\"checked\"" : "";
								
					$mrules["{VOTE_ONOFF_YES}"]  = ($vote_onoff)   ? "checked=\"checked\"" : ""; 
					$mrules["{VOTE_ONOFF_NO}"]   = (!$vote_onoff)  ? "checked=\"checked\"" : ""; 
					$mrules["{VOTE_IS_REG_YES}"] = ($vote_is_reg)  ? "checked=\"checked\"" : ""; 
					$mrules["{VOTE_IS_REG_NO}"]  = (!$vote_is_reg) ? "checked=\"checked\"" : ""; 
			
					$cats1 = explode(",", $cats);
					if ($cats=="0") {$mrules["{CATS_SEL}"] = "selected=\"selected\""; $cats1 = "";}
					else $mrules["{CATS_SEL}"] = "";
			
					$mrules["{CATS}"] = "";
					$result  = $o_categories->makeTree();			
					if ($result) 
						foreach ($result as $n)
							$mrules["{CATS}"] .= (@in_array($n[0], $cats1)) ? "<option value=\"$n[0]\" selected=\"selected\">".$n[1]."</option>" : "<option value=\"$n[0]\">".$n[1]."</option>";
			
					$access1 = array();
					$access1 = explode(",", $access);
					if ($access=="0") {$mrules["{ACCESS_SEL}"] = "selected=\"selected\""; $access1 = "";}
					else $mrules["{ACCESS_SEL}"] = "";
		
					$mrules["{ACCESS}"] = "";
					$result = $o_usersgroup->get();
					foreach ($result as $n1) 
						if ($n1[0]!=1) $mrules["{ACCESS}"] .= (@in_array($n1[0], $access1)) ? "<option value=\"$n1[0]\" selected=\"selected\">".$n1[1]."</option>" : "<option value=\"$n1[0]\">".$n1[1]."</option>";
						
					$mrules["{ACCESS_DIS}"] = ($USER_RIGHTS['id_ug']!=1) ? "disabled=\"disabled\"" : "";
							        
		        	$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);
	            	$MESS = $o_other->showMessA($LANG['wrong_input'], 1);
		        }
			}
		}
		elseif ($a=="edit" && isset($id) && ($USER_RIGHTS['allow_all_edit'] || ($USER_RIGHTS['allow_edit'] && $ID==$o_news->getOne($id, "user_id")))) {
			
			$sw = false;
			
			$action = $o_vars->post['action'];
		
		    if (!isset($action)) {
		        $result = $o_news->get($id, 0);
		        if (!$result) {$sw = true; $MESS = $o_other->showMessA($LANG[$m.'_eget'], 1);}
				else {
			    	foreach ($result as $n);
			    	
			    	$mrules["{TITLEE}"] = $LANG[$m.'_fedit']. $n[5];
			    	
			    	$mrules["{DATE}"]  	     = (!$n[2])  ? "" : $o_other->makeNormalDate($n[2]);
					$mrules["{DATEC}"]       = ($n[2])   ? "" : "checked=\"checked\"";
					$mrules["{EXPIRES}"]     = (!$n[14]) ? "" : $o_other->makeNormalDate($n[14]);
					$mrules["{EXPIRESC}"]    = ($n[14])  ? "" : "checked=\"checked\"";
					$mrules["{SHORT_STORY}"] = $n[3];
					$mrules["{FULL_STORY}"]  = $n[4];
					$mrules["{TITLE}"]       = $n[5];
					$mrules["{KEYWORDS}"]    = $n[6];
					$mrules["{DESCR}"]       = $n[18];
			
					$allow_main1 = (!$USER_RIGHTS['allow_main']) ? "disabled=\"disabled\"" : "";
					$moderation1 = (!$USER_RIGHTS['moderation']) ? "disabled=\"disabled\"" : "";
				
					$mrules["{ALLOW_COMM_YES}"]  = ($n[8])   ? "checked=\"checked\""            : "";
					$mrules["{ALLOW_COMM_NO}"]   = (!$n[8])  ? "checked=\"checked\""            : "";
					$mrules["{ALLOW_MAIN_YES}"]  = ($n[9])   ? "checked=\"checked\""            : "$allow_main1";
					$mrules["{ALLOW_MAIN_NO}"]   = (!$n[9])  ? "checked=\"checked\""            : "$allow_main1";
					$mrules["{ALLOW_RATE_YES}"]  = ($n[10])  ? "checked=\"checked\""            : "";
					$mrules["{ALLOW_RATE_NO}"]   = (!$n[10]) ? "checked=\"checked\""            : "";
					$mrules["{ONOFF_YES}"]       = ($n[12])  ? "checked=\"checked\""            : "$moderation1";
					$mrules["{ONOFF_NO}"]        = (!$n[12]) ? "checked=\"checked\""            : "$moderation1";	
					$mrules["{EXPIRES}"]         = ($n[14])  ? $o_other->makeNormalDate($n[14]) : "";
					$mrules["{EXPIRES_NO}"]      = (!$n[14]) ? "checked=\"checked\""            : "";
					$mrules["{MODERATION_YES}"]  = ($n[15])  ? "checked=\"checked\""            : "$moderation1";
					$mrules["{MODERATION_NO}"]   = (!$n[15]) ? "checked=\"checked\""            : "$moderation1";	
					$mrules["{FIXED_YES}"]       = ($n[16])  ? "checked=\"checked\""            : "";
					$mrules["{FIXED_NO}"]        = (!$n[16]) ? "checked=\"checked\""            : "";	
				
					if ($n[11]) $result = $o_vote->get($n[11]);
					else $result = false;
				
					if ($result) {
						foreach($result as $n1); 
						$mrules["{VOTE_TITLE}"]      = $n1[2];
						$mrules["{VOTE_ONOFF_YES}"]  = ($n1[4])  ? "checked=\"checked\"" : "";
						$mrules["{VOTE_ONOFF_NO}"]   = (!$n1[4]) ? "checked=\"checked\"" : "";
						$mrules["{VOTE_IS_REG_YES}"] = ($n1[5])  ? "checked=\"checked\"" : "";
						$mrules["{VOTE_IS_REG_NO}"]  = (!$n1[5]) ? "checked=\"checked\"" : "";
						$mrules["{VOTE_BODY}"]       = $n1[7];
					}
					else {
						$mrules["{VOTE_TITLE}"]      = "";
						$mrules["{VOTE_ONOFF_YES}"]  = "checked=\"checked\"";
						$mrules["{VOTE_ONOFF_NO}"]   = "";
						$mrules["{VOTE_IS_REG_YES}"] = "checked=\"checked\"";
						$mrules["{VOTE_IS_REG_NO}"]  = "";
						$mrules["{VOTE_BODY}"]       = "";
					}			
					
					$mrules["{CATS_DIS}"] = "";		
					
					$cats = array();
					$cats = explode(",", $n[7]);
					if ($n[7]=="0") {$mrules["{CATS_SEL}"] = "selected=\"selected\""; $cats = "";}
					else $mrules["{CATS_SEL}"] = "";
			
					$mrules["{CATS}"] = "";
					$result = $o_categories->makeTree();
					if ($result)
						foreach ($result as $n1)
							$mrules["{CATS}"] .= (@in_array($n1[0], $cats)) ? "<option value=\"$n1[0]\" selected=\"selected\">".$n1[1]."</option>" : "<option value=\"$n1[0]\">".$n1[1]."</option>";
				
					$access = array();
					$access = explode(",", $n[17]);
					if ($n[17]=="0") {$mrules["{ACCESS_SEL}"] = "selected=\"selected\""; $access = "";}
					else $mrules["{ACCESS_SEL}"] = "";
		
					$mrules["{ACCESS}"] = "";
					$result = $o_usersgroup->get();
					foreach ($result as $n1) 
						if ($n1[0]!=1) 
							$mrules["{ACCESS}"] .= (@in_array($n1[0], $access)) ? "<option value=\"$n1[0]\" selected=\"selected\">".$n1[1]."</option>" : "<option value=\"$n1[0]\">".$n1[1]."</option>";
					
					$mrules["{ACCESS_DIS}"] = ($USER_RIGHTS['id_ug']!=1) ? "disabled=\"disabled\"" : "";
									
					$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);
		        }
		    } 
			else {
			
				$title = stripslashes(htmlspecialchars(strip_tags($o_vars->post['title']), ENT_QUOTES));
				$date  = (!$o_vars->post['date']) ? time() : $o_other->makeToTime($o_vars->post['date']);
			
				if (@in_array("0",$o_vars->post['cats'])) $cats = "0";
				else $cats = @implode(",", $o_categories->makeCats($o_vars->post['cats']));
			
				$short_story = (!$USER_RIGHTS['allow_html']) ? $o_wfilter->wordFilter(stripslashes(htmlspecialchars(strip_tags($o_other->strRepl($o_vars->post['short_story'])), ENT_QUOTES))) : $o_wfilter->wordFilter($o_other->strRepl($o_vars->post['short_story']));
				$full_story  = (!$USER_RIGHTS['allow_html']) ? $o_wfilter->wordFilter(stripslashes(htmlspecialchars(strip_tags($o_other->strRepl($o_vars->post['full_story'])), ENT_QUOTES))) : $o_wfilter->wordFilter($o_other->strRepl($o_vars->post['full_story']));
			
				$onoff 	    = intval($o_vars->post['onoff']);
				$allow_main = intval($o_vars->post['allow_main']);
				$moderation	= intval($o_vars->post['moderation']);
				$fixed		= intval($o_vars->post['fixed']);
				$allow_rate = intval($o_vars->post['allow_rate']);
				$allow_comm = intval($o_vars->post['allow_comm']);	
				$expires    = (!$o_vars->post['expires'] || time() > $o_other->makeToTime($o_vars->post['expires'])) ? 0 : $o_other->makeToTime($o_vars->post['expires']);
				$descr      = stripslashes(htmlspecialchars(strip_tags($o_vars->post['descr']), ENT_QUOTES));
				$keywords   = stripslashes(htmlspecialchars(strip_tags($o_vars->post['keywords']), ENT_QUOTES));
			
				if ($ID!=1) $access = $o_news->getOne($id, "access");
				elseif (@in_array("0", $o_vars->post['access'])) $access = "0";
				else $access = @implode(",", $o_vars->post['access']);
			
				$vote_title  = stripslashes(htmlspecialchars(strip_tags($o_vars->post['vote_title']), ENT_QUOTES));
				$vote_onoff  = intval($o_vars->post['vote_onoff']);
				$vote_is_reg = intval($o_vars->post['vote_is_reg']);
				$vote_body	 = (!$USER_RIGHTS['allow_html']) ? stripslashes(htmlspecialchars(strip_tags($o_other->strRepl($o_vars->post['vote_body'])), ENT_QUOTES)) : stripslashes($o_other->strRepl($o_vars->post['vote_body']));	
				$vote_id     = ($o_vote->get($o_news->getOne($id, "vote_id"))) ? $o_news->getOne($id, "vote_id") : 0;
		    	
				if ($title!="" && $short_story!="" && $id!="") {
					
					$sw = true;
					
					if ($vote_title!="" && $vote_body!="") {
						if (!$vote_id) { 
					   		$result = $o_vote->add($vote_title, time(), $vote_onoff, $vote_is_reg, $cats, $vote_body, "1");
					   		if ($result) $vote_id = $o_vote->getLastId();
						}
						else $o_vote->update($vote_id, $vote_title, $vote_onoff, $vote_is_reg, $cats, $vote_body);					
					}
					
					$result = $o_news->update($id, $date, $short_story, $full_story, $title, $keywords, $cats, $allow_comm, $allow_main, $allow_rate, $vote_id, $onoff, $expires, $moderation, $fixed, $access, $descr);
					
		        	if ($result) $MESS = $o_other->showMessA($LANG[$m.'_edit']);
	            	else $MESS = $o_other->showMessA($LANG[$m.'_eedit'], 1);
		        }
		    	else {
		    	
		    		$mrules["{TITLEE}"] = $LANG[$m.'_fedit']. $o_news->getOne($id, "title");
		    		
		    		$mrules["{TITLE}"]       = $title;
					$mrules["{SHORT_STORY}"] = $short_story;
					$mrules["{FULL_STORY}"]  = $full_story;
					$mrules["{DESCR}"]       = $descr;
					$mrules["{KEYWORDS}"]    = $keywords;
					$mrules["{VOTE_TITLE}"]  = $vote_title;
					$mrules["{VOTE_BODY}"]   = $vote_body;
					
					$mrules["{DATE}"]  = (!$o_vars->post['date']) ? ""                    : $o_vars->post['date'];
					$mrules["{DATEC}"] = (!$o_vars->post['date']) ? "checked=\"checked\"" : "";
								
					$allow_main1 = (!$USER_RIGHTS['allow_main']) ? "disabled=\"disabled\"" : "";
					$moderation1 = (!$USER_RIGHTS['moderation']) ? "disabled=\"disabled\"" : "";
				
					$mrules["{ALLOW_COMM_YES}"] = ($allow_comm)  ? "checked=\"checked\"" : "";
					$mrules["{ALLOW_COMM_NO}"]  = (!$allow_comm) ? "checked=\"checked\"" : "";
					$mrules["{ALLOW_MAIN_YES}"] = ($allow_main)  ? "checked=\"checked\"" : $allow_main1;
					$mrules["{ALLOW_MAIN_NO}"]  = (!$allow_main) ? "checked=\"checked\"" : $allow_main1;
					$mrules["{ALLOW_RATE_YES}"] = ($allow_rate)  ? "checked=\"checked\"" : "";
					$mrules["{ALLOW_RATE_NO}"]  = (!$allow_rate) ? "checked=\"checked\"" : "";
					$mrules["{ONOFF_YES}"]      = ($onoff)       ? "checked=\"checked\"" : $moderation1;
					$mrules["{ONOFF_NO}"]       = (!$onoff)      ? "checked=\"checked\"" : $moderation1;	
					$mrules["{MODERATION_YES}"] = ($moderation)  ? "checked=\"checked\"" : $moderation1;
					$mrules["{MODERATION_NO}"]  = (!$moderation) ? "checked=\"checked\"" : $moderation1;	
					$mrules["{FIXED_YES}"]      = ($fixed)       ? "checked=\"checked\"" : "";
					$mrules["{FIXED_NO}"]       = (!$fixed)      ? "checked=\"checked\"" : "";	
			
					$mrules["{EXPIRES}"]  = (!$expires) ? ""                    : $o_vars->post['expires'];
					$mrules["{EXPIRESC}"] = (!$expires) ? "checked=\"checked\"" : "";
								
					$mrules["{VOTE_ONOFF_YES}"]  = ($vote_onoff)   ? "checked=\"checked\"" : ""; 
					$mrules["{VOTE_ONOFF_NO}"]   = (!$vote_onoff)  ? "checked=\"checked\"" : ""; 
					$mrules["{VOTE_IS_REG_YES}"] = ($vote_is_reg)  ? "checked=\"checked\"" : ""; 
					$mrules["{VOTE_IS_REG_NO}"]  = (!$vote_is_reg) ? "checked=\"checked\"" : ""; 
			
					$mrules["{CATS_DIS}"] = "";
			
					$cats1 = explode(",", $cats);
					if ($cats=="0") {$mrules["{CATS_SEL}"] = "selected=\"selected\""; $cats1 = "";}
					else $mrules["{CATS_SEL}"] = "";
			
					$mrules["{CATS}"] = "";
					$result  = $o_categories->makeTree();			
					if ($result) 
						foreach ($result as $n)
							$mrules["{CATS}"] .= (@in_array($n[0], $cats1)) ? "<option value=\"$n[0]\" selected=\"selected\">".$n[1]."</option>" : "<option value=\"$n[0]\">".$n[1]."</option>";
			
					$access1 = array();
					$access1 = explode(",", $access);
					if ($access=="0") {$mrules["{ACCESS_SEL}"] = "selected=\"selected\""; $access1 = "";}
					else $mrules["{ACCESS_SEL}"] = "";
		
					$mrules["{ACCESS}"] = "";
					$result = $o_usersgroup->get();
					foreach ($result as $n1) 
						if ($n1[0]!=1) $mrules["{ACCESS}"] .= (@in_array($n1[0], $access1)) ? "<option value=\"$n1[0]\" selected=\"selected\">".$n1[1]."</option>" : "<option value=\"$n1[0]\">".$n1[1]."</option>";
						
					$mrules["{ACCESS_DIS}"] = ($USER_RIGHTS['id_ug']!=1) ? "disabled=\"disabled\"" : "";
							        
		        	$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);
	            	$MESS = $o_other->showMessA($LANG['wrong_input'], 1);
		    	}
			}
		}
		
		if (((!isset($a) && !isset($id)) || ($a=="del" && isset($id) && ($USER_RIGHTS['allow_all_edit'] || ($USER_RIGHTS['allow_edit'] && $ID==$o_news->getOne($id, "user_id")))) || ($a=="add" && $sw) || ($a=="edit" && isset($id) && $sw)) && ($USER_RIGHTS['allow_all_edit'] || $USER_RIGHTS['allow_edit'])) {
			                   
			if ($a=="del" && isset($id)) {
			
				$result = $o_news->del($id); 
		    
		   		if ($result) $MESS = $o_other->showMessA($LANG[$m.'_del']);
			    else $MESS = $o_other->showMessA($LANG[$m.'_edel'], 1);
			}
				
			$action = $o_vars->post['action'];
			
			if (isset($action) && $a!="add" && $a!="edit") {
			
				$make     = $o_vars->post['make'];
				$selected = $o_vars->post['selected'];
			
				$result = $o_news->makeIn($make, $selected);
				
				if ($result) $MESS = $o_other->showMessA($LANG[$m.'_make']);
	            else $MESS = $o_other->showMessA($LANG[$m.'_emake'], 1);
			}
						
			$user_id = ($USER_RIGHTS['allow_all_edit']) ? $user_id = "0" : $ID;
			$result = $o_news->get(0, 0, $user_id);
		    $o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_allshowt.tpl");
			if (!$result) $o_tpl->addhtml("<div class=\"nothing\">".$LANG[$m.'_egets']."</div>");
		    else {
		    	foreach ($result as $n) {
		    	
			        $mrules["{ID}"]         = $n[0];
			        $mrules["{DATE}"]       = $o_other->makeNormalDate($n[2],1);
		            $mrules["{AUTOR}"]      = (!$o_users->getOne($n[19], "name")) ? $n[1] : $o_users->getOne($n[19], "name");
		            $n[5] = (strlen($n[5]) < 31) ? $n[5] : mb_substr($n[5], 0, 28, 'UTF-8') . '...';
		            $mrules["{TITLE}"]      = $n[5];
		            $mrules["{KOL_COMM}"]   = $o_comments->kolInNews($n[0]);
		            $mrules["{MODERATION}"] = ($n[15]) ? "<img src=\"".ADMIN_TEMPLATES_DIR."/images/yes.png\" alt=\"".$LANG['yes']."\" title=\"".$LANG['yes']."\" />" : "<img src=\"".ADMIN_TEMPLATES_DIR."/images/no.png\" alt=\"".$LANG['no']."\" title=\"".$LANG['no']."\" />";
		            $mrules["{ONOFF}"]      = ($n[12]) ? "<img src=\"".ADMIN_TEMPLATES_DIR."/images/yes.png\" alt=\"".$LANG['yes']."\" title=\"".$LANG['yes']."\" />" : "<img src=\"".ADMIN_TEMPLATES_DIR."/images/no.png\" alt=\"".$LANG['no']."\" title=\"".$LANG['no']."\" />";
		            $mrules["{ONOFF}"]      = ($n[2] > time()) ? $LANG['time_not'] : $mrules["{ONOFF}"];
		            $mrules["{ONOFF}"]      = ($n[14] < time() && $n[14]) ? $LANG['time_end'] : $mrules["{ONOFF}"];
		            $mrules["{FIXED}"]      = ($n[16]) ? "<img src=\"".ADMIN_TEMPLATES_DIR."/images/yes.png\" alt=\"".$LANG['yes']."\" title=\"".$LANG['yes']."\" />" : "<img src=\"".ADMIN_TEMPLATES_DIR."/images/no.png\" alt=\"".$LANG['no']."\" title=\"".$LANG['no']."\" />";
		            	                
					$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_allshowm.tpl", $mrules);
		        }
		    }
		    unset($mrules);
		    
		    $mrules["{MODERATION_DIS}"] = (!$USER_RIGHTS['moderation']) ? "disabled=\"disabled\"" : "";
			$mrules["{ALLOW_MAIN_DIS}"] = (!$USER_RIGHTS['allow_main']) ? "disabled=\"disabled\"" : "";
			$mrules["{ALLOW_ADDS_DIS}"] = (!$USER_RIGHTS['allow_adds']) ? "disabled=\"disabled\"" : "";
		
		    $o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_allshowb.tpl", $mrules);
		}
		elseif (isset($a) && ($a=="add" && !$USER_RIGHTS['allow_adds']) || (!$USER_RIGHTS['allow_edit'] || !$USER_RIGHTS['allow_all_edit'])) 
			$MESS1 = $o_other->showMessA($LANG['eaccess'], 1);   	 
		elseif ($a!="add" && ($a!="edit" || ($a=="edit" && !isset($id)))) $MESS1 = $o_other->showMessA($LANG['efunction'], 1);  
	}
	else $MESS1 = $o_other->showMessA($LANG['eaccess'], 1);  	    

?>
