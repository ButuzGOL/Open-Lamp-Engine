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
// Файл: bannedip.php
//-----------------------------------------------------------------------------/
// Назначение: Модуль управления забаненными IP (админка)
//=============================================================================/
*/
					
			
			$sw = false;
				
				$mrules["{TITLEE}"] = $LANG[$m.'_fadd'];
	        	
	        	$mrules["{IP}"]    = "";
	        	$mrules["{DATE}"]  = "";
				$mrules["{DATEC}"] = "checked=\"checked\"";
				$mrules["{DESCR}"] = "";
													        
	        	$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);
	        else {
					
					$sw = true;
					
					
	            	else $MESS = $o_other->showMessA($LANG[$m.'_eadd'], 1); 
	            	
	            	$mrules["{TITLEE}"] = $LANG[$m.'_fadd'];
	        	
			    	$mrules["{IP}"]    = $ip;
			    	$mrules["{DATE}"]  = (!$date) ? ""                    : $o_vars->post['date'];
					$mrules["{DATEC}"] = (!$date) ? "checked=\"checked\"" : "";
			    	$mrules["{DESCR}"] = $descr;	            	
	            		            	
	            	$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);
	            	$MESS = $o_other->showMessA($LANG['wrong_input']. $LANG[$m.'_eform'], 1);
	            }
		    $sw = false;
		    
		        	$mrules["{TITLEE}"] = $LANG[$m.'_fedit']. $n[1];
		            $mrules["{IP}"]      = $n[1];
					$mrules["{DATEC}"]   = ($n[2])   ? "" : "checked=\"checked\"";
					$mrules["{DESCR}"]   = $n[3];
				
					$sw = true;
				
	            	if ($result) $MESS = $o_other->showMessA($LANG[$m.'_edit']);
	            	else $MESS = $o_other->showMessA($LANG[$m.'_eedit'], 1);	
					
					$mrules["{TITLEE}"] = $LANG[$m.'_fedit']. $o_bannedip->getOne($id, "ip");
			    	$mrules["{IP}"]    = $ip;
			    	$mrules["{DATE}"]  = (!$date) ? "" : $o_vars->post['date'];
					$mrules["{DATEC}"] = (!$date) ? "checked=\"checked\"" : "";
			    	$mrules["{DESCR}"] = $descr;	            	
	            		            	
	            	$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);
	            	$MESS = $o_other->showMessA($LANG['wrong_input']. $LANG[$m.'_eform'], 1);
	            }
	    
	    if ((!isset($a) && !isset($id)) || ($a=="del" && isset($id))  || ($a=="add" && $sw) || ($a=="edit" && isset($id) && $sw)) {
	    	if ($a=="del") {
			    
			    if ($result) $MESS = $o_other->showMessA($LANG[$m.'_del']);
	    	
				if ($result) $MESS = $o_other->showMessA($LANG[$m.'_make']);