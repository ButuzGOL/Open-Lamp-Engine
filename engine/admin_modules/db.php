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
// Файл: db.php
//-----------------------------------------------------------------------------/
// Назначение: Модуль управления базой данных (админка)
//=============================================================================/
*/
		
		include(CLASSES."/db.class.php");
		
		$o_db = new db($o_mysql);
							if ($result) $MESS = $o_other->showMessA($LANG[$m.'_opt']);
	            			else $MESS = $o_other->showMessA($LANG[$m.'_eopt'], 1); 
						    break;
	            			else $MESS = $o_other->showMessA($LANG[$m.'_evopt'], 1); 
						    break;
	            			else $MESS = $o_other->showMessA($LANG[$m.'_erep'], 1); 
						    break;
				case "backup": $result = $o_db->makeBackUp(); 
	            			else $MESS = $o_other->showMessA($LANG[$m.'_ebackup'], 1);
	            			else $MESS = $o_other->showMessA($LANG[$m.'_eres'], 1);
						   	break;
					
		$mrules["{TITLEE}"] = $LANG[$m];
		
		$result = $o_db->getTables();
	    
	    $mrules["{DBBACKUP}"]     = "";
	    $result = $o_db->getBackUpFiles();
		