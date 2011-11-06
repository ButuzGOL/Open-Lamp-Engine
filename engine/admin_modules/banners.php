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
// Файл: banners.php
//-----------------------------------------------------------------------------/
// Назначение: Модуль управления рекламными материалами (админка)
//=============================================================================/
*/

		include(CLASSES."/banners.class.php");
		include(CLASSES."/categories.class.php");
		
		$o_banners    = new banners($o_mysql);
		$o_categories = new categories($o_mysql);
	
		
			$sw = false;
	        	
	        	$mrules["{TITLEE}"] = $LANG[$m.'_fadd'];
	        	
	        	$mrules["{DESCR}"] = "";
	        	$mrules["{CODE}"]  = "";
				$mrules["{PLACE}"] = 1;
				$mrules["{CATS_SEL}"] = "selected=\"selected\"";
				
				$result = $o_categories->makeTree();
				$mrules["{ACCESS_SEL}"] = "selected=\"selected\"";
				
				$mrules["{ACCESS}"] = "";
				
				$mrules["{ONOFF_YES}"]         = "checked=\"checked\"";
				
					$sw = true;
					
	            	else $MESS = $o_other->showMessA($LANG[$m.'_eadd'], 1); 
	            	
	            	$mrules["{TITLEE}"] = $LANG[$m.'_fadd'];
	        	
			    	$mrules["{DESCR}"] = $descr;
			    	$mrules["{CODE}"]  = $code;
					$mrules["{PLACE}"] = $place;
	            	
	            	$cats1 = array();												
					$cats1 = explode(",", $cats);
					$mrules["{CATS}"] = "";
					
	    				foreach ($result as $n1) 
					$result = $o_usersgroup->get();
					$mrules["{ONOFF_YES}"]         = ($onoff)          ? "checked=\"checked\"" : "";
	            	$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);
	            	$MESS = $o_other->showMessA($LANG['wrong_input'], 1);
	            }
		    $sw = false;
		    
		        	
		        	$mrules["{TITLEE}"] = $LANG[$m.'_fedit']. $n[1];
	        			        	
		            $cats = array();
					$mrules["{CATS}"] = "";
					
	    				foreach ($result as $n1) 
					$result = $o_usersgroup->get();
																
				
					$sw = true;
					
	            	if ($result) $MESS = $o_other->showMessA($LANG[$m.'_edit']);
	            	else $MESS = $o_other->showMessA($LANG[$m.'_eedit'], 1);	
				
					$mrules["{TITLEE}"] = $LANG[$m.'_fedit']. $o_banners->getOne($id, "descr");
	        		        	
			    	$mrules["{DESCR}"] = $descr;
			    	$mrules["{CODE}"]  = $code;
					$mrules["{PLACE}"] = $place;
	            	
	            	$cats1 = array();												
					$cats1 = explode(",", $cats);
					$mrules["{CATS}"] = "";
					
	    				foreach ($result as $n1) 
					$result = $o_usersgroup->get();
					$mrules["{ONOFF_YES}"]         = ($onoff)          ? "checked=\"checked\"" : "";
	            	$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);
	            	$MESS = $o_other->showMessA($LANG['wrong_input'], 1);
				}
	    
	    if ((!isset($a) && !isset($id)) || ($a=="del" && isset($id))  || ($a=="add" && $sw) || ($a=="edit" && isset($id) && $sw)) {
	    	if ($a=="del") {
			    
			    if ($result) $MESS = $o_other->showMessA($LANG[$m.'_del']);
				if ($result) $MESS = $o_other->showMessA($LANG[$m.'_make']);
	    	}