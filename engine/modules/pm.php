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
// Файл: pm.php
//-----------------------------------------------------------------------------/
// Назначение: Модуль управления и вывода персональных сообщений
//=============================================================================/
*/
	
		include(CLASSES ."/pm.class.php");
		$o_pm = new pm($o_mysql);
		
	    	$mrules1["{ID}"]          = $ID;
			   
					
					    $mrules1["{USER_ID}"] .= ($n[0]!=$user_id) ? "<option value=\"$n[0]\">$n[1]</option>" : "<option value=\"$n[0]\" selected=\"selected\">$n[1]</option>";
				   					   	
	    	if ((!$type && $ID==$o_pm->getOne($id, "user_id")) || ($type && $ID==$o_pm->getOne($id, "user_from"))) $o_pm->delNot($id, $type);			
					if ($type) $mrules1["{USER}"] = ($o_users->getOne($n[3], "name")) ? "<a href=\"index.php?m=profile&amp;id=$n[3]\">".$o_users->getOne($n[3], "name"). "</a>" : $n[10];
	                $mrules1["{USER_ID}"] = (!$type) ? $n[4] : $n[3];
				if ($type) $mrules1["{USER}"] = ($o_users->getOne($n[3], "name")) ? $o_users->getOne($n[3], "name") : $n[10];
	                
		elseif ($o_users->getKol()==1) $mrules["{MIDDLE}"] .= "<div class=\"mess\">".$LANG[$m.'_emadd']."</div>";
		