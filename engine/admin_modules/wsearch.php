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
// Файл: wsearch.php
//-----------------------------------------------------------------------------/
// Назначение: Модуль управления поиском и заменой текста (админка)
//=============================================================================/
*/
	    	
	    	$sw = false;
				$sw = true;
				
				$result = $o_other->changeText($table, $text0, $text1);
	        	if ($result) $MESS = $o_other->showMessA($LANG[$m.'_edit']);
	            else $MESS = $o_other->showMessA($LANG[$m.'_eedit'], 1);    
	        }
	        	        	
	        	$mrules["{TITLEE}"] = $LANG[$m];
	    	
				$mrules["{NEWS_SEL}"] = (@in_array("1", $table)) ? "selected=\"selected\"" : "";
				$mrules["{COMM_SEL}"] = (@in_array("2", $table)) ? "selected=\"selected\"" : "";
				$mrules["{PM_SEL}"]   = (@in_array("3", $table)) ? "selected=\"selected\"" : "";
				$mrules["{ST_SEL}"]   = (@in_array("4", $table)) ? "selected=\"selected\"" : "";
				
				$mrules["{TEXT0}"] = $text0;
				$mrules["{TEXT1}"] = $text1;
	        	
	        	$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);
	            $MESS = $o_other->showMessA($LANG['wrong_input'], 1);
	        }
		
		if (!isset($action) || $sw) {
			    	
	    	$mrules["{TITLEE}"] = $LANG[$m];
	    	
	    	$mrules["{NEWS_SEL}"] = "selected=\"selected\"";
	    	$mrules["{COMM_SEL}"] = "selected=\"selected\"";
	    	$mrules["{PM_SEL}"]   = "selected=\"selected\"";
	    	$mrules["{ST_SEL}"]   = "selected=\"selected\"";
	    	
	    	$mrules["{TEXT0}"] = "";
	    	$mrules["{TEXT1}"] = "";
	    		    	
	    	$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);
		}	    