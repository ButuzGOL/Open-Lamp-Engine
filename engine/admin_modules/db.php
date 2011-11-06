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
// Файл: db.php
//-----------------------------------------------------------------------------/
// Назначение: Модуль управления базой данных (админка)
//=============================================================================/
*/    if (!defined("OLE")) die("<script>window.location = \"./\"</script>");						if ($USER_RIGHTS['id_ug']==1) {
		
		include(CLASSES."/db.class.php");
		
		$o_db = new db($o_mysql);				$action  = $o_vars->post['action'];			    if (isset($action)) {	    		    	$db = $o_vars->post['db'];	    		    	$tables   = $o_vars->post['tables'];	    	$dbbackup = $o_vars->post['dbbackup'];	    				$news_date   = ($o_vars->post['news_tt'])   ? "1" : intval($o_other->makeToTime($o_vars->post['news_date']));			$comm_date   = ($o_vars->post['comm_tt'])   ? "1" : intval($o_other->makeToTime($o_vars->post['comm_date']));			$pm_date     = ($o_vars->post['pm_tt'])     ? "1" : intval($o_other->makeToTime($o_vars->post['pm_date']));	 		$vote_date   = ($o_vars->post['vote_tt'])   ? "1" : intval($o_other->makeToTime($o_vars->post['vote_date']));			$statik_date = ($o_vars->post['statik_tt']) ? "1" : intval($o_other->makeToTime($o_vars->post['statik_date']));						switch ($db) {				case "opt": $result = $o_db->makeOptim($tables); 
							if ($result) $MESS = $o_other->showMessA($LANG[$m.'_opt']);
	            			else $MESS = $o_other->showMessA($LANG[$m.'_eopt'], 1); 
						    break;				case "vopt": $result = $o_db->makeVOptim($news_date, $comm_date, $pm_date, $vote_date, $statik_date); 						    if ($result) $MESS = $o_other->showMessA($LANG[$m.'_vopt']);
	            			else $MESS = $o_other->showMessA($LANG[$m.'_evopt'], 1); 
						    break;				case "rep": $result = $o_db->makeRepair($tables); 						    if ($result) $MESS = $o_other->showMessA($LANG[$m.'_rep']);
	            			else $MESS = $o_other->showMessA($LANG[$m.'_erep'], 1); 
						    break;
				case "backup": $result = $o_db->makeBackUp(); 						    if ($result) $MESS = $o_other->showMessA($LANG[$m.'_backup']);
	            			else $MESS = $o_other->showMessA($LANG[$m.'_ebackup'], 1);		            	    break;		   				case "res": $result = $o_db->makeRestoreBackUp($dbbackup); 							if ($result) $MESS = $o_other->showMessA($LANG[$m.'_res']);
	            			else $MESS = $o_other->showMessA($LANG[$m.'_eres'], 1);
						   	break;			}		}
					
		$mrules["{TITLEE}"] = $LANG[$m];
				$mrules["{TABLES}"] = "";
		$result = $o_db->getTables();	    foreach ($result as $n) $mrules["{TABLES}"] .= "<option value=\"$n[0]\" selected=\"selected\">".$n[0]."</option>";
	    
	    $mrules["{DBBACKUP}"]     = "";
	    $result = $o_db->getBackUpFiles();		if ($result) foreach ($result as $n) $mrules["{DBBACKUP}"] .= "<option value=\"$n[file]\" selected=\"selected\">".$n['name']."</option>";		else $mrules["{DBBACKUP}"] = "<option value=\"\" selected=\"selected\">".$LANG[$m.'_egets']."</option>";
				$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);		    	}	else $MESS1 = $o_other->showMessA($LANG['eaccess'], 1);?>
