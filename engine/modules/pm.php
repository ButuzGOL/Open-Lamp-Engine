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
// Файл: pm.php
//-----------------------------------------------------------------------------/
// Назначение: Модуль управления и вывода персональных сообщений
//=============================================================================/
*/    if (!defined("OLE")) die("<script>window.location = \"./\"</script>");		if ($ID && $USER_RIGHTS['allow_pm']) {
	
		include(CLASSES ."/pm.class.php");		
		$o_pm = new pm($o_mysql);
				$a    = $o_vars->get['a'];		$id   = $o_vars->get['id'];		$send = $o_vars->get['send'];				$type = (isset($send)) ? 1 : 0; 				$mrules["{TITLE}"]  = $LANG[$m];			$mrules["{MIDDLE}"] = "<div class=\"pm\"><div class=\"menu\"><a href=\"index.php?m=pm\">".$LANG[$m.'_res']."</a> | <a href=\"index.php?m=pm&amp;send\">".$LANG[$m.'_send']."</a> | <a href=\"index.php?m=pm&amp;a=add\">".$LANG[$m.'_add']."</a></div></div>";						if ($a=="add" && $o_users->getKol()>1) {				    	$action_pmadd = $o_vars->post['action_pmadd'];	    				$k = 0;	    	
	    	$mrules1["{ID}"]          = $ID;			$mrules1["{SUBJ}"]        = "";			$mrules1["{TEXT}"]        = "";			$mrules1["{MESS}"]        = "";			$mrules1["{IS_DEL_FROM}"] = "checked=\"ckecked\"";
			   	        if (isset($action_pmadd)) { 							$mrules1["{SUBJ}"] = $subj      = stripslashes(htmlspecialchars(strip_tags($o_vars->post['subj']), ENT_QUOTES));				$user_id   				        = intval($o_vars->post['user_id']);				$mrules1["{ID}"]   = $user_from = $ID;				$mrules1["{TEXT}"] = $text      = stripslashes(htmlspecialchars(strip_tags($o_vars->post['text']), ENT_QUOTES));				$is_del_from			        = ($o_vars->post['is_del_from']) ? 0 : 1;				$mrules1["{IS_DEL_FROM}"]       = (!$is_del_from) ? "checked=\"ckecked\"" : "";
									if ($subj!="" && $user_id!="" && $user_from!="" && $text!="" && $o_users->get($user_id) && $user_id!=$ID) {					$result = $o_pm->add($subj, $text, $user_id, $user_from, time(), 0, 0, $is_del_from, $o_users->getOne($user_from, "name"), $o_users->getOne($user_id, "name"));					$k = 1;							$mrules["{MIDDLE}"] .= "<div class=\"mess\">".$LANG[$m.'_madd']."</div>";	            }	            else $mrules1["{MESS}"] = $LANG['wrong_input'];	        }							if (!$k)	{								$mrules1["{USER_ID}"] = "";				$result = $o_users->get();				foreach ($result as $n)					if ($n[0]!=$ID) 
					    $mrules1["{USER_ID}"] .= ($n[0]!=$user_id) ? "<option value=\"$n[0]\">$n[1]</option>" : "<option value=\"$n[0]\" selected=\"selected\">$n[1]</option>";
				   					   					$mrules["{MIDDLE}"] .= $o_tpl->gethtml(TEMPLATES_DIR."/".$m."_add_middle.tpl", $mrules1);	    	}	    }	    elseif (!isset($a) && !isset($id) || ($a=="del" && isset($id))) {	    	
	    	if ((!$type && $ID==$o_pm->getOne($id, "user_id")) || ($type && $ID==$o_pm->getOne($id, "user_from"))) $o_pm->delNot($id, $type);									$result = $o_pm->get($ID, $type);			if (!$result) $mrules["{MIDDLE}"] .= "<div class=\"mess\">".$LANG[$m.'_egets']."</div>";	        else {	        	foreach ($result as $n) {		            		            $mrules1["{ID}"]   = $n[0];					$mrules1["{ID1}"]  = (!$type)           ? $n[0]          : $n[0]."&amp;send";		            $mrules1["{SUBJ}"] = (!$n[6] && !$type) ? "<span class=\"notread\">$n[1]</span>" : $n[1];					
					if ($type) $mrules1["{USER}"] = ($o_users->getOne($n[3], "name")) ? "<a href=\"index.php?m=profile&amp;id=$n[3]\">".$o_users->getOne($n[3], "name"). "</a>" : $n[10];	                else 	   $mrules1["{USER}"] = ($o_users->getOne($n[4], "name")) ? "<a href=\"index.php?m=profile&amp;id=$n[4]\">".$o_users->getOne($n[4], "name"). "</a>" : $n[9];	                 
	                $mrules1["{USER_ID}"] = (!$type) ? $n[4] : $n[3];					$mrules1["{DATE}"]    = $o_other->makeNormalDate($n[5]);					            					$mrules["{MIDDLE}"] .= $o_tpl->gethtml(TEMPLATES_DIR."/".$m."_allshowm_middle.tpl", $mrules1);	            }	        }					}		elseif (!isset($a) && isset($id)) {	    				$result = $o_pm->get($ID, $type, $id);		    if (!$result) $mrules["{MIDDLE}"] .= "<div class=\"mess\">".$LANG[$m.'_eget']."</div>";		    else {		    	if (!$type) $o_pm->makeRead($id);		    	foreach ($result as $n);			                    			    $mrules1["{SUBJ}"] = $n[1];				
				if ($type) $mrules1["{USER}"] = ($o_users->getOne($n[3], "name")) ? $o_users->getOne($n[3], "name") : $n[10];	            else 	   $mrules1["{USER}"] = ($o_users->getOne($n[4], "name")) ? $o_users->getOne($n[4], "name") : $n[9];
	                				$mrules1["{DATE}"] = $o_other->makeNormalDate($n[5]);				$mrules1["{TEXT}"] = nl2br($n[2]);						            				$mrules["{MIDDLE}"] .= $o_tpl->gethtml(TEMPLATES_DIR."/".$m."_show_middle.tpl", $mrules1);		            		    }		}
		elseif ($o_users->getKol()==1) $mrules["{MIDDLE}"] .= "<div class=\"mess\">".$LANG[$m.'_emadd']."</div>";
				$o_tpl->addhtml(TEMPLATES_DIR."/default_middle.tpl", $mrules);    }    else $o_other->showMess($LANG['mess'], $LANG['eaccess'], "index.php", $LANG['redir_main'], TEMPLATES_DIR);?>
