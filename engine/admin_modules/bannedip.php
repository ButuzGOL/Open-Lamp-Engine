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
// Файл: bannedip.php
//-----------------------------------------------------------------------------/
// Назначение: Модуль управления забаненными IP (админка)
//=============================================================================/
*/    if (!defined("OLE")) die("<script>window.location = \"./\"</script>");		if ($USER_RIGHTS['id_ug']==1) {
							$a  = $o_vars->get['a'];		$id = $o_vars->get['id'];						if ($a=="add") {
			
			$sw = false;				    	$action = $o_vars->post['action'];	    		        if (!isset($action)) {
				
				$mrules["{TITLEE}"] = $LANG[$m.'_fadd'];
	        	
	        	$mrules["{IP}"]    = "";
	        	$mrules["{DATE}"]  = "";
				$mrules["{DATEC}"] = "checked=\"checked\"";
				$mrules["{DESCR}"] = "";
													        
	        	$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);	        }
	        else {							$ip    = $o_other->filterIp($o_vars->post['ip']);				$date  = (!$o_vars->post['date'] || time() > $o_other->makeToTime($o_vars->post['date'])) ? 0 : $o_other->makeToTime($o_vars->post['date']);				$descr = stripslashes(htmlspecialchars(strip_tags($o_vars->post['descr']), ENT_QUOTES));											if ($ip!="" && !$o_bannedip->valueExists("ip", $ip)) {
					
					$sw = true;
										$result = $o_bannedip->add($ip, $date, $descr);
						            	if ($result) $MESS = $o_other->showMessA($LANG[$m.'_add']);
	            	else $MESS = $o_other->showMessA($LANG[$m.'_eadd'], 1); 	            }	            else {
	            	
	            	$mrules["{TITLEE}"] = $LANG[$m.'_fadd'];
	        	
			    	$mrules["{IP}"]    = $ip;
			    	$mrules["{DATE}"]  = (!$date) ? ""                    : $o_vars->post['date'];
					$mrules["{DATEC}"] = (!$date) ? "checked=\"checked\"" : "";
			    	$mrules["{DESCR}"] = $descr;	            	
	            		            	
	            	$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);
	            	$MESS = $o_other->showMessA($LANG['wrong_input']. $LANG[$m.'_eform'], 1);
	            }	    	}	    }		elseif ($a=="edit" && isset($id)) {		    
		    $sw = false;
		    			$action = $o_vars->post['action'];				        if (!isset($action)) {	            $result = $o_bannedip->get($id);	            if (!$result) {$sw = true; $MESS = $o_other->showMessA($LANG[$m.'_eget'], 1);} 				else {		        	foreach ($result as $n);		        	
		        	$mrules["{TITLEE}"] = $LANG[$m.'_fedit']. $n[1];			    			            
		            $mrules["{IP}"]      = $n[1];					$mrules["{DATE}"]  	 = (!$n[2])  ? "" : $o_other->makeNormalDate($n[2]);
					$mrules["{DATEC}"]   = ($n[2])   ? "" : "checked=\"checked\"";
					$mrules["{DESCR}"]   = $n[3];										$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);	            }	        } 			else {												$ip    = $o_other->filterIp($o_vars->post['ip']);				$date  = (!$o_vars->post['date'] || time() > $o_other->makeToTime($o_vars->post['date'])) ? 0 : $o_other->makeToTime($o_vars->post['date']);				$descr = stripslashes(htmlspecialchars(strip_tags($o_vars->post['descr']), ENT_QUOTES));						if ($id!="" && $ip!="" && !$o_bannedip->valueExists("ip", $ip, $id)) {
				
					$sw = true;
									$result = $o_bannedip->update($id, $ip, $date, $descr);	            	
	            	if ($result) $MESS = $o_other->showMessA($LANG[$m.'_edit']);
	            	else $MESS = $o_other->showMessA($LANG[$m.'_eedit'], 1);		            }	        	else {
					
					$mrules["{TITLEE}"] = $LANG[$m.'_fedit']. $o_bannedip->getOne($id, "ip");			    						
			    	$mrules["{IP}"]    = $ip;
			    	$mrules["{DATE}"]  = (!$date) ? "" : $o_vars->post['date'];
					$mrules["{DATEC}"] = (!$date) ? "checked=\"checked\"" : "";
			    	$mrules["{DESCR}"] = $descr;	            	
	            		            	
	            	$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);
	            	$MESS = $o_other->showMessA($LANG['wrong_input']. $LANG[$m.'_eform'], 1);
	            }			}	    }
	    
	    if ((!isset($a) && !isset($id)) || ($a=="del" && isset($id))  || ($a=="add" && $sw) || ($a=="edit" && isset($id) && $sw)) {	    	
	    	if ($a=="del") {				    $result = $o_bannedip->del($id); 
			    
			    if ($result) $MESS = $o_other->showMessA($LANG[$m.'_del']);			    else $MESS = $o_other->showMessA($LANG[$m.'_edel'], 1); 	        	    	} 
	    				$action = $o_vars->post['action'];	    		    	if (isset($action) && $a!="add" && $a!="edit") {									$make     = $o_vars->post['make'];				$selected = $o_vars->post['selected'];								$result = $o_bannedip->makeIn($make, $selected);				
				if ($result) $MESS = $o_other->showMessA($LANG[$m.'_make']);			    else $MESS = $o_other->showMessA($LANG[$m.'_emake'], 1);			}						$result = $o_bannedip->get();	        $o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_allshowt.tpl");			if (!$result) $o_tpl->addhtml("<div class=\"nothing\">".$LANG[$m.'_egets']."</div>");	        else {	        	foreach ($result as $n) {		                       					$mrules["{ID}"]    = $n[0];		            $mrules["{IP}"]    = $n[1];					$mrules["{DATE}"]  = ($n[2]) ? $o_other->makeNormalDate($n[2]) : $LANG[$m.'_endl'];	                $mrules["{DESCR}"] = ($n[3]) ? $n[3] : $LANG[$m.'_nore'];	                					$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_allshowm.tpl", $mrules);	            }	        }	        $o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_allshowb.tpl");		}		elseif ($a!="add" && ($a!="edit" || ($a=="edit" && !isset($id)))) $MESS1 = $o_other->showMessA($LANG['efunction'], 1);	}	else $MESS1 = $o_other->showMessA($LANG['eaccess'], 1);	        ?>
