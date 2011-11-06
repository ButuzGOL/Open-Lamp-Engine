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
// Файл: blocks.php
//-----------------------------------------------------------------------------/
// Назначение: Модуль управления блоками сайта (админка)
//=============================================================================/
*/    if (!defined("OLE")) die("<script>window.location = \"./\"</script>");			if ($USER_RIGHTS['id_ug']==1) {
	
		include(CLASSES."/blocks.class.php");
	
		$o_blocks = new blocks($o_mysql);				$a  = $o_vars->get['a'];		$id = $o_vars->get['id'];						if ($a=="add") {			
			$sw = false;
				    	$action = $o_vars->post['action'];	    		        if (!isset($action)) {
	        	
	        	$mrules["{TITLEE}"] = $LANG[$m.'_fadd'];
	        	
	        	$mrules["{DESCR}"] = "";
	        	$mrules["{TITLE}"] = "";
	        	$mrules["{PLACE}"] = 1;
	        	$mrules["{TEXT}"]  = "";
	        	$mrules["{TPL}"]   = "";
	        	$mrules["{MODUL}"] = "";
	        					$mrules["{ONOFF_YES}"]  = "checked=\"checked\"";				$mrules["{ONOFF_NO}"]   = "";
	        	
	        	$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);	        }
	        else {							$descr = stripslashes(htmlspecialchars(strip_tags($o_vars->post['descr']), ENT_QUOTES));				$title = stripslashes(htmlspecialchars(strip_tags($o_vars->post['title']), ENT_QUOTES));						$tpl   = stripslashes(htmlspecialchars(strip_tags($o_vars->post['tpl']), ENT_QUOTES));					$modul = stripslashes(htmlspecialchars(strip_tags($o_vars->post['modul']), ENT_QUOTES));								$text = stripslashes($o_vars->post['text']);								$onoff = intval($o_vars->post['onoff']);				$place = intval($o_vars->post['place']);								if ($descr!="" && (($modul!="" && file_exists(BLOCKSS."/".$modul)) || !$modul) && (($tpl!="" && file_exists(BLOCK_TEMPLATES_DIR."/".$tpl)) || !$tpl)) {					
					$sw = true;
					
					$result = $o_blocks->add($descr, $title, $onoff, $place, $tpl, $modul, $text);	            	
	            	if ($result) $MESS = $o_other->showMessA($LANG[$m.'_add']);
	            	else $MESS = $o_other->showMessA($LANG[$m.'_eadd'], 1); 	            }	            else {
	            	
	            	$mrules["{TITLEE}"] = $LANG[$m.'_fadd'];
	        	
			    	$mrules["{DESCR}"] = $descr;
			    	$mrules["{TITLE}"] = $title;
			    	$mrules["{PLACE}"] = $place;
			    	$mrules["{TEXT}"]  = $text;
			    	$mrules["{TPL}"]   = $tpl;
			    	$mrules["{MODUL}"] = $modul;
			    						$mrules["{ONOFF_YES}"] = ($onoff)  ? "checked=\"checked\"" : "";					$mrules["{ONOFF_NO}"]  = (!$onoff) ? "checked=\"checked\"" : "";
	            	
	            	$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);
	            	$MESS = $o_other->showMessA($LANG['wrong_input'], 1);
	            }	    	}	    		    }
	    elseif ($a=="edit" && isset($id)) {		    
		    $sw = false;
		    			$action = $o_vars->post['action'];				        if (!isset($action)) {	            $result = $o_blocks->get($id);	            if (!$result) {$sw = true; $MESS = $o_other->showMessA($LANG[$m.'_eget'], 1);}				else {		        	foreach ($result as $n);		        	
		        	$mrules["{TITLEE}"] = $LANG[$m.'_fedit']. $n[1];
		        				        $mrules["{DESCR}"]     = $n[1];					$mrules["{TITLE}"]     = $n[2];					$mrules["{ONOFF_YES}"] = ($n[3])  ? "checked=\"checked\"" : "";					$mrules["{ONOFF_NO}"]  = (!$n[3]) ? "checked=\"checked\"" : "";					$mrules["{PLACE}"]     = $n[4];		           	$mrules["{TPL}"]       = $n[6];					$mrules["{MODUL}"]     = $n[7];					$mrules["{TEXT}"]      = $n[8];																	$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);	            }	        } 			else {												$descr = stripslashes(htmlspecialchars(strip_tags($o_vars->post['descr']), ENT_QUOTES));				$title = stripslashes(htmlspecialchars(strip_tags($o_vars->post['title']), ENT_QUOTES));						$tpl   = stripslashes(htmlspecialchars(strip_tags($o_vars->post['tpl']), ENT_QUOTES));					$modul = stripslashes(htmlspecialchars(strip_tags($o_vars->post['modul']), ENT_QUOTES));								$text = stripslashes($o_vars->post['text']);								$onoff = intval($o_vars->post['onoff']);				$place = intval($o_vars->post['place']);												if ($descr!="" && (($modul!="" && file_exists(BLOCKSS."/".$modul)) || !$modul) && (($tpl!="" && file_exists(BLOCK_TEMPLATES_DIR."/".$tpl)) || !$tpl) && $id!="") {					
					$sw = true;
					
					$result = $o_blocks->update($id, $descr, $title, $onoff, $place, $tpl, $modul, $text);	            	
	            	if ($result) $MESS = $o_other->showMessA($LANG[$m.'_edit']);
	            	else $MESS = $o_other->showMessA($LANG[$m.'_eedit'], 1);		            }	        	else {
	        	
	        		$mrules["{TITLEE}"] = $LANG[$m.'_fedit']. $o_blocks->getOne($id, "descr");
	        		
	        		$mrules["{DESCR}"] = $descr;
			    	$mrules["{TITLE}"] = $title;
			    	$mrules["{PLACE}"] = $place;
			    	$mrules["{TEXT}"]  = $text;
			    	$mrules["{TPL}"]   = $tpl;
			    	$mrules["{MODUL}"] = $modul;
			    						$mrules["{ONOFF_YES}"] = ($onoff)  ? "checked=\"checked\"" : "";					$mrules["{ONOFF_NO}"]  = (!$onoff) ? "checked=\"checked\"" : "";
				
					$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);
					$MESS = $o_other->showMessA($LANG['wrong_input'], 1);
				}			}	    }
	    	    if ((!isset($a) && !isset($id)) || (($a=="1" || $a=="2" || $a=="3" || $a=="4" || $a=="up" || $a=="down") && isset($id)) || ($a=="del" && isset($id))  || ($a=="add" && $sw) || ($a=="edit" && isset($id) && $sw)) {	    	
	    	if ($a=="del") {				    $result = $o_blocks->del($id); 
			    
			    if ($result) $MESS = $o_other->showMessA($LANG[$m.'_del']);			    else $MESS = $o_other->showMessA($LANG[$m.'_edel'], 1); 	        	    	}
	    		    	if ($a=="1" || $a=="2" || $a=="3" || $a=="4") $o_blocks->changePlace($id, $a);	    	if ($a=="up" || $a=="down") $o_blocks->changePos($id, $a);	    				$action = $o_vars->post['action'];	    		    	if (isset($action) && $a!="add" && $a!="edit") {									$make     = $o_vars->post['make'];				$selected = $o_vars->post['selected'];								$result = $o_blocks->makeIn($make, $selected);				
				if ($result) $MESS = $o_other->showMessA($LANG[$m.'_make']);			    else $MESS = $o_other->showMessA($LANG[$m.'_emake'], 1);			}						$result = $o_blocks->get();	        $o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_allshowt.tpl");			if (!$result) $o_tpl->addhtml("<div class=\"nothing\">".$LANG[$m.'_egets']."</div>");	        else {	        	foreach ($result as $n) {		                       					$mrules["{ID}"] = $n[0];		            					if ($n[4]==1) $mrules["{PLACE}"] = "<img src=\"".ADMIN_TEMPLATES_DIR."/images/blocks_left_dis.png\" alt=\"".$LANG['left']."\" title=\"".$LANG['left']."\" /> <a href=\"?m=$m&amp;a=2&amp;id=$n[0]\"><img src=\"".ADMIN_TEMPLATES_DIR."/images/blocks_right.png\" alt=\"".$LANG['right']."\" title=\"".$LANG['right']."\" /></a> <a href=\"?m=$m&amp;a=3&amp;id=$n[0]\"><img src=\"".ADMIN_TEMPLATES_DIR."/images/blocks_top.png\" alt=\"".$LANG['top']."\" title=\"".$LANG['top']."\" /></a> <a href=\"?m=$m&amp;a=4&amp;id=$n[0]\"><img src=\"".ADMIN_TEMPLATES_DIR."/images/blocks_bottom.png\" alt=\"".$LANG['bottom']."\" title=\"".$LANG['bottom']."\" /></a>";										
					elseif ($n[4]==2) $mrules["{PLACE}"] = "<a href=\"?m=$m&amp;a=1&amp;id=$n[0]\"><img src=\"".ADMIN_TEMPLATES_DIR."/images/blocks_left.png\" alt=\"".$LANG['left']."\" title=\"".$LANG['left']."\" /></a> <img src=\"".ADMIN_TEMPLATES_DIR."/images/blocks_right_dis.png\" alt=\"".$LANG['right']."\" title=\"".$LANG['right']."\" /> <a href=\"?m=$m&amp;a=3&amp;id=$n[0]\"><img src=\"".ADMIN_TEMPLATES_DIR."/images/blocks_top.png\" alt=\"".$LANG['top']."\" title=\"".$LANG['top']."\" /></a> <a href=\"?m=$m&amp;a=4&amp;id=$n[0]\"><img src=\"".ADMIN_TEMPLATES_DIR."/images/blocks_bottom.png\" alt=\"".$LANG['bottom']."\" title=\"".$LANG['bottom']."\" /></a>";										
					elseif ($n[4]==3) $mrules["{PLACE}"] = "<a href=\"?m=$m&amp;a=1&amp;id=$n[0]\"><img src=\"".ADMIN_TEMPLATES_DIR."/images/blocks_left.png\" alt=\"".$LANG['left']."\" title=\"".$LANG['left']."\" /></a> <a href=\"?m=$m&amp;a=2&amp;id=$n[0]\"><img src=\"".ADMIN_TEMPLATES_DIR."/images/blocks_right.png\" alt=\"".$LANG['right']."\" title=\"".$LANG['right']."\" /></a> <img src=\"".ADMIN_TEMPLATES_DIR."/images/blocks_top_dis.png\" alt=\"".$LANG['top']."\" title=\"".$LANG['top']."\" /> <a href=\"?m=$m&amp;a=4&amp;id=$n[0]\"><img src=\"".ADMIN_TEMPLATES_DIR."/images/blocks_bottom.png\" alt=\"".$LANG['bottom']."\" title=\"".$LANG['bottom']."\" /></a>";										
					elseif ($n[4]==4) $mrules["{PLACE}"] = "<a href=\"?m=$m&amp;a=1&amp;id=$n[0]\"><img src=\"".ADMIN_TEMPLATES_DIR."/images/blocks_left.png\" alt=\"".$LANG['left']."\" title=\"".$LANG['left']."\" /></a> <a href=\"?m=$m&amp;a=2&amp;id=$n[0]\"><img src=\"".ADMIN_TEMPLATES_DIR."/images/blocks_right.png\" alt=\"".$LANG['right']."\" title=\"".$LANG['right']."\" /></a> <a href=\"?m=$m&amp;a=3&amp;id=$n[0]\"><img src=\"".ADMIN_TEMPLATES_DIR."/images/blocks_top.png\" alt=\"".$LANG['top']."\" title=\"".$LANG['top']."\" /></a> <img src=\"".ADMIN_TEMPLATES_DIR."/images/blocks_bottom_dis.png\" alt=\"".$LANG['bottom']."\" title=\"".$LANG['bottom']."\" />";					
					else $mrules["{PLACE}"] = "&nbsp;";										if ($n[5]>1 && $n[5]<($o_blocks->getPos($n[4])-1)) $mrules["{POS}"] = "<a href=\"?m=$m&amp;a=up&amp;id=$n[0]\">					<img src=\"".ADMIN_TEMPLATES_DIR."/images/blocks_up.png\" alt=\"".$LANG['ttop']."\" title=\"".$LANG['ttop']."\" /></a>&nbsp;&nbsp;&nbsp;<a href=\"?m=$m&amp;a=down&amp;id=$n[0]\"><img src=\"".ADMIN_TEMPLATES_DIR."/images/blocks_down.png\" alt=\"".$LANG['bbuttom']."\" title=\"".$LANG['bbuttom']."\" /></a>";					elseif ($n[5]>1 && $n[5]==($o_blocks->getPos($n[4])-1)) $mrules["{POS}"] = "<a href=\"?m=$m&amp;a=up&amp;id=$n[0]\"><img src=\"".ADMIN_TEMPLATES_DIR."/images/blocks_up.png\" alt=\"".$LANG['ttop']."\" title=\"".$LANG['ttop']."\" /></a>";					elseif ($n[5]==1 && $n[5]<($o_blocks->getPos($n[4])-1)) $mrules["{POS}"] = "<a href=\"?m=$m&amp;a=down&amp;id=$n[0]\"><img src=\"".ADMIN_TEMPLATES_DIR."/images/blocks_down.png\" alt=\"".$LANG['bbuttom']."\" title=\"".$LANG['bbuttom']."\" /></a>";        					else $mrules["{POS}"] = "&nbsp;";                                  										$mrules["{DESCR}"] = $n[1];					$mrules["{ONOFF}"] = ($n[3]) ? "<img src=\"".ADMIN_TEMPLATES_DIR."/images/yes.png\" alt=\"".$LANG['yes']."\" title=\"".$LANG['yes']."\" />" : "<img src=\"".ADMIN_TEMPLATES_DIR."/images/no.png\" alt=\"".$LANG['no']."\" title=\"".$LANG['no']."\" />";	                					            					$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_allshowm.tpl", $mrules);	            }	        }	        $o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_allshowb.tpl");		}		elseif ($a!="add" && ($a!="edit" || ($a=="edit" && !isset($id)))) $MESS1 = $o_other->showMessA($LANG['efunction'], 1);	}	else $MESS1 = $o_other->showMessA($LANG['eaccess'], 1);?>
