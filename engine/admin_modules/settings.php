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
// Файл: settings.php
//-----------------------------------------------------------------------------/
// Назначение: Модуль управления настройками сайта (админка)
//=============================================================================/
*/

    if (!defined("OLE")) die("<script>window.location = \"./\"</script>");
	
	if ($USER_RIGHTS['id_ug']==1 && $ID==1) {
		
		$action = $o_vars->post['action'];
		
	    if (isset($action)) {
	    
	    	$sw = false;
			
			$url        = addslashes(htmlspecialchars(strip_tags($o_vars->post['url']), ENT_QUOTES));
			$title      = addslashes(htmlspecialchars(strip_tags($o_vars->post['title']), ENT_QUOTES));
			$charset    = addslashes(htmlspecialchars(strip_tags($o_vars->post['charset']), ENT_QUOTES));
			$descr      = addslashes(htmlspecialchars(strip_tags($o_vars->post['descr']), ENT_QUOTES));
			$keywords   = addslashes(htmlspecialchars(strip_tags($o_vars->post['keywords']), ENT_QUOTES));
			$autor      = addslashes(htmlspecialchars(strip_tags($o_vars->post['autor']), ENT_QUOTES));
			$theme      = addslashes(htmlspecialchars(strip_tags($o_vars->post['themes']), ENT_QUOTES));
			$site_onoff = intval($o_vars->post['site_onoff']);
			
			$site_monoff = addslashes($o_vars->post['site_monoff']); 
			$o_other->filter('/"/', '&quot;', $site_monoff);				 
	
			$allow_dimg = intval($o_vars->post['allow_dimg']);
			$simg 	    = intval($o_vars->post['simg']);
						
			
			$adm_file     = addslashes(htmlspecialchars(strip_tags($o_vars->post['adm_file']), ENT_QUOTES));
			$allow_renter = intval($o_vars->post['allow_renter']);
			
			
			$news_num   = intval($o_vars->post['news_num']);
			$news_sort  = intval($o_vars->post['news_sort']);
			$news_msort = intval($o_vars->post['news_msort']);
			$news_email = intval($o_vars->post['news_email']);
			$comm_num   = intval($o_vars->post['comm_num']);
			$comm_msort = intval($o_vars->post['comm_msort']);
		  		    	
			
			$allow_reg     = intval($o_vars->post['allow_reg']);
	    	$reg_group     = intval($o_vars->post['reg_group']);
	    	$gost_group    = intval($o_vars->post['gost_group']);
	    	$send_regemail = intval($o_vars->post['send_regemail']);
	    	$users_kol     = intval($o_vars->post['users_kol']);
	    	
	    	
	    	$mysql_host = addslashes(htmlspecialchars(strip_tags($o_vars->post['mysql_host']), ENT_QUOTES));
	    	$mysql_user = addslashes(htmlspecialchars(strip_tags($o_vars->post['mysql_user']), ENT_QUOTES));
	    	$mysql_db   = addslashes(htmlspecialchars(strip_tags($o_vars->post['mysql_db']), ENT_QUOTES));
	    	$mysql_pref = addslashes(htmlspecialchars(strip_tags($o_vars->post['mysql_pref']), ENT_QUOTES));
	    			
			if ($url!="" && $adm_file!="" && $mysql_host!="" && $mysql_db!="" && $mysql_pref!="") {
				
				$sw = true;
				
				$str = "<?php
	
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
// Файл: config.php
//-----------------------------------------------------------------------------/
// Назначение: Настройки сайта
//=============================================================================/
*/
	
	\$CONFIG = array (
	
	'version' => \"1.0\",
	
	'title'       => \"$title\",
	'charset'     => \"$charset\",
	'descr'       => \"$descr\",
	'keywords'    => \"$keywords\",
	'autor'       => \"$autor\",
	'theme'       => \"$theme\",
	'site_onoff'  => \"$site_onoff\",
	'site_monoff' => \"$site_monoff\",
	'allow_dimg'  => \"$allow_dimg\",
	'simg'        => \"$simg\",
	
	'adm_file'     => \"$adm_file\",
	'allow_renter' => \"$allow_renter\",
	
	'news_num'   => \"$news_num\",
	'news_sort'  => \"$news_sort\",
	'news_msort' => \"$news_msort\",
	'news_email' => \"$news_email\",
	'comm_num'   => \"$comm_num\",
	'comm_msort' => \"$comm_msort\",
		
	'allow_reg'     => \"$allow_reg\",
	'reg_group'     => \"$reg_group\",
	'gost_group'    => \"$gost_group\",
	'send_regemail' => \"$send_regemail\",
	'users_kol'     => \"$users_kol\"
	
	);
	
	define(URL, \"$url\");
	define(\"MYSQL_HOST\", \"$mysql_host\"); 
	define(\"MYSQL_USER\", \"$mysql_user\");
	define(\"MYSQL_PASS\", \"".MYSQL_PASS."\");
	define(\"MYSQL_DB\", \"$mysql_db\");  
	define(\"MYSQL_PREF\", \"$mysql_pref\"); 
	
?>";
				
				$o_other->fileWrite(CONFIG_DIR."/config.php", $str);
					
	        	if ($result) $MESS = $o_other->showMessA($LANG[$m.'_edit']);
	            else $MESS = $o_other->showMessA($LANG[$m.'_eedit'], 1);
	            
	        }
		}
	        
		if (isset($action)) {
			
			$mrules["{TITLEE}"] = $LANG[$m];
			
			$mrules["{URL}"]      = $url;
			$mrules["{TITLE}"]    = $title;
			$mrules["{CHARSET}"]  = $charset;
			$mrules["{DESCR}"]    = $descr;
			$mrules["{KEYWORDS}"] = $keywords;
			$mrules["{AUTOR}"]    = $autor;
			$mrules["{TPL}"]      = "";
		
			$result = $o_other->getDir("themes");
			foreach ($result as $n) 
				$mrules["{THEMES}"] .= ($n==$theme) ? "<option value='$n' selected=\"selected\"> $n</option>" : "<option value='$n'> $n</option>";
	
			$mrules["{SITE_ONOFF_YES}"] = ($site_onoff)  ? "checked=\"checked\"" : "";
			$mrules["{SITE_ONOFF_NO}"]  = (!$site_onoff) ? "checked=\"checked\"" : "";
			$mrules["{SITE_MONOFF}"]    = $site_monoff;
			$mrules["{ALLOW_DIMG_YES}"] = ($allow_dimg)  ? "checked=\"checked\"" : "";
			$mrules["{ALLOW_DIMG_NO}"]  = (!$allow_dimg) ? "checked=\"checked\"" : "";
			$mrules["{SIMG}"]           = $simg;
		
		
			$mrules["{ADM_FILE}"]         = $adm_file;
			$mrules["{ALLOW_RENTER_YES}"] = ($allow_renter)  ? "checked=\"checked\"" : "";
			$mrules["{ALLOW_RENTER_NO}"]  = (!$allow_renter) ? "checked=\"checked\"" : "";
					
		
			$mrules["{NEWS_NUM}"]       = $news_num;
			$mrules["{NEWS_SORT}"]      = $news_sort;
			$mrules["{NEWS_MSORT}"]     = $news_msort;
			$mrules["{NEWS_EMAIL_YES}"] = ($news_email)  ? "checked=\"checked\"" : "";
			$mrules["{NEWS_EMAIL_NO}"]  = (!$news_email) ? "checked=\"checked\"" : "";
			$mrules["{COMM_NUM}"]       = $comm_num;
			$mrules["{COMM_MSORT}"]     = $comm_msort;
							
		
			$mrules["{ALLOW_REG_YES}"] = ($allow_reg)  ? "checked=\"checked\"" : "";
			$mrules["{ALLOW_REG_NO}"]  = (!$allow_reg) ? "checked=\"checked\"" : "";
			$mrules["{REG_GROUP}"]     = "";
			$mrules["{GOST_GROUP}"]    = "";
			 
			$result = $o_usersgroup->get();
			foreach ($result as $n) {
				$mrules["{REG_GROUP}"]  .= ($n[0]==$reg_group)  ? "<option value='$n[0]' selected=\"selected\"> $n[1]</option>" : "<option value='$n[0]'> $n[1]</option>";
				$mrules["{GOST_GROUP}"] .= ($n[0]==$gost_group) ? "<option value='$n[0]' selected=\"selected\"> $n[1]</option>" : "<option value='$n[0]'> $n[1]</option>";
			}
	
			$mrules["{SEND_REGEMAIL_YES}"] = ($send_regemail)   ? "checked=\"checked\"" : "";
			$mrules["{SEND_REGEMAIL_NO}"]  = (!$send_regemail)  ? "checked=\"checked\"" : "";
			$mrules["{USERS_KOL}"]         = $users_kol;
		
						
			$mrules["{MYSQL_HOST}"] = $mysql_host;
			$mrules["{MYSQL_USER}"] = $mysql_user;
			$mrules["{MYSQL_DB}"]   = $mysql_db;
			$mrules["{MYSQL_PREF}"] = $mysql_pref;
		
			$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);
		    if (!$sw) $MESS = $o_other->showMessA($LANG['wrong_input'], 1);
		}
		else {
			
			$mrules["{TITLEE}"] = $LANG[$m];
	    	
	    	$mrules["{URL}"]      = URL;
	    	$mrules["{TITLE}"]    = $CONFIG['title'];
			$mrules["{CHARSET}"]  = $CONFIG['charset'];
	    	$mrules["{DESCR}"]    = $CONFIG['descr'];
	    	$mrules["{KEYWORDS}"] = $CONFIG['keywords'];
	    	$mrules["{AUTOR}"]    = $CONFIG['autor'];
			$mrules["{TPL}"]      = "";
	    	
	    	$result = $o_other->getDir("themes");
		    foreach ($result as $n) 
				$mrules["{THEMES}"] .= ($n==$CONFIG['theme']) ? "<option value='$n' selected=\"selected\"> $n</option>" : "<option value='$n'> $n</option>";
			
			$mrules["{SITE_ONOFF_YES}"] = ($CONFIG['site_onoff'])  ? "checked=\"checked\"" : "";
			$mrules["{SITE_ONOFF_NO}"]  = (!$CONFIG['site_onoff']) ? "checked=\"checked\"" : "";
	    	$mrules["{SITE_MONOFF}"]    = $CONFIG['site_monoff'];
	    	$mrules["{ALLOW_DIMG_YES}"] = ($CONFIG['allow_dimg'])  ? "checked=\"checked\"" : "";
			$mrules["{ALLOW_DIMG_NO}"]  = (!$CONFIG['allow_dimg']) ? "checked=\"checked\"" : "";
	    	$mrules["{SIMG}"]           = $CONFIG['simg'];
	    	
	    	
	    	$mrules["{ADM_FILE}"]         = $CONFIG['adm_file'];
	    	$mrules["{ALLOW_RENTER_YES}"] = ($CONFIG['allow_renter'])  ? "checked=\"checked\"" : "";
			$mrules["{ALLOW_RENTER_NO}"]  = (!$CONFIG['allow_renter']) ? "checked=\"checked\"" : "";
	    	    	
	    	
	    	$mrules["{NEWS_NUM}"]       = $CONFIG['news_num'];
	    	$mrules["{NEWS_SORT}"]      = $CONFIG['news_sort'];
			$mrules["{NEWS_MSORT}"]     = $CONFIG['news_msort'];
			$mrules["{NEWS_EMAIL_YES}"] = ($CONFIG['news_email'])  ? "checked=\"checked\"" : "";
			$mrules["{NEWS_EMAIL_NO}"]  = (!$CONFIG['news_email']) ? "checked=\"checked\"" : "";
	    	$mrules["{COMM_NUM}"]       = $CONFIG['comm_num'];
	    	$mrules["{COMM_MSORT}"]     = $CONFIG['comm_msort'];
	    			    	
	    	
	    	$mrules["{ALLOW_REG_YES}"] = ($CONFIG['allow_reg'])  ? "checked=\"checked\"" : "";
			$mrules["{ALLOW_REG_NO}"]  = (!$CONFIG['allow_reg']) ? "checked=\"checked\"" : "";
	    	$mrules["{REG_GROUP}"]     = "";
			$mrules["{GOST_GROUP}"]    = "";
			 
		    $result = $o_usersgroup->get();
		    foreach ($result as $n) {
				$mrules["{REG_GROUP}"]  .= ($n[0]==$CONFIG['reg_group'])  ? "<option value='$n[0]' selected=\"selected\"> $n[1]</option>" : "<option value='$n[0]'> $n[1]</option>";
				$mrules["{GOST_GROUP}"] .= ($n[0]==$CONFIG['gost_group']) ? "<option value='$n[0]' selected=\"selected\"> $n[1]</option>" : "<option value='$n[0]'> $n[1]</option>";
			}
			
	    	$mrules["{SEND_REGEMAIL_YES}"] = ($CONFIG['send_regemail'])   ? "checked=\"checked\"" : "";
			$mrules["{SEND_REGEMAIL_NO}"]  = (!$CONFIG['send_regemail'])  ? "checked=\"checked\"" : "";
	    	$mrules["{USERS_KOL}"]         = $CONFIG['users_kol'];
	    	
	    		    	
	    	$mrules["{MYSQL_HOST}"] = MYSQL_HOST;
			$mrules["{MYSQL_USER}"] = MYSQL_USER;
			$mrules["{MYSQL_DB}"]   = MYSQL_DB;
			$mrules["{MYSQL_PREF}"] = MYSQL_PREF;
				
			$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);
		}    
    }
	else $MESS1 = $o_other->showMessA($LANG['eaccess'], 1);

?>
