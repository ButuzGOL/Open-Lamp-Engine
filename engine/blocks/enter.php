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
// Файл: enter.php
//-----------------------------------------------------------------------------/
// Назначение: Блок пользовательской панели
//=============================================================================/
*/

	if (!defined("OLE")) die("<script>window.location = \"./\"</script>");
	
	if (!isset($o_pm)) {
    	include(CLASSES ."/pm.class.php");	
    	$o_pm = new pm($o_mysql);
    } 
	
	$blocks = "";
	
	if (!$ID) $blocks .= $o_tpl->gethtml(BLOCK_TEMPLATES_DIR."/enter1.tpl");
	else {
		$kol_pm = $o_pm->kolPM($ID);
		$blocks .= "<div align=\"center\">Привет, <b>".$USER['name']."</b><br /><br />";
		$blocks .= (!$USER['avatar']) ? "<img src=\"".AVATARS_DIR."/0.png\" alt=\"".$USER['name']."\" title=\"".$USER['name']."\" /></div><br />" : "<img src=\"".AVATARS_DIR."/".$USER['avatar']."\" alt=\"".$USER['name']."\" title=\"".$USER['name']."\" /></div><br />";
		$blocks .= ($USER_RIGHTS['allow_admin']) ? "<img src=\"".BLOCK_TEMPLATES_DIR."/images/enter.png\" style=\"padding-right:5px;\" alt=\"\" /> <a href=\"".$CONFIG['adm_file']."\" onclick=\"this.target='target'\">Админцентр</a><br />" : "";
		$blocks .= "<img src=\"".BLOCK_TEMPLATES_DIR."/images/enter.png\" style=\"padding-right:5px;\" alt=\"\" /> <a href=\"index.php?m=profile&amp;id=$ID\">Мой профиль</a><br />";
		
		if ($USER_RIGHTS['allow_pm'])
			$blocks .= ($kol_pm['read']) ? "<img src=\"".BLOCK_TEMPLATES_DIR."/images/enter.png\" style=\"padding-right:5px;\" alt=\"\" /> <a href=\"index.php?m=pm\">Cообщения (<b>".$kol_pm['read']."</b> | ".$kol_pm['all'].")</a><br />" : "<img src=\"".BLOCK_TEMPLATES_DIR."/images/enter.png\" style=\"padding-right:5px;\" alt=\"\" /> <a href=\"index.php?m=pm\">Cообщения (".$kol_pm['read']." | ".$kol_pm['all'].")</a><br />";
			
		$blocks .= "<img src=\"".BLOCK_TEMPLATES_DIR."/images/enter.png\" style=\"padding-right:5px;\" alt=\"\" /> <a href=\"index.php?m=bookmarks\">Мои закладки</a><br />
			        <img src=\"".BLOCK_TEMPLATES_DIR."/images/enter.png\" style=\"padding-right:5px;\" alt=\"\" /> <a href=\"index.php?m=statistik\">Статистика</a><br />";
		$blocks .= ($USER_RIGHTS['allow_adds']) ? "<img src=\"".BLOCK_TEMPLATES_DIR."/images/enter.png\" style=\"padding-right:5px;\" alt=\"\" /> <a href=\"index.php?m=news&amp;a=add\">Добавить новость</a><br />" : "";
		$blocks .= ($USER_RIGHTS['allow_addst']) ? "<img src=\"".BLOCK_TEMPLATES_DIR."/images/enter.png\" style=\"padding-right:5px;\" alt=\"\" /> <a href=\"index.php?m=statik&amp;a=add\">Добавить статическую страницу</a><br />" : "";
		$blocks .= "<img src=\"".BLOCK_TEMPLATES_DIR."/images/enter.png\" style=\"padding-right:5px;\" alt=\"\" /> <a href=\"index.php?logout\">Завершить сеанс</a><br />";
	}
			        
?>
