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
// Файл: define.php
//-----------------------------------------------------------------------------/
// Назначение: Константы скрипта
//=============================================================================/
*/

	define("OLE", true);
	
    define("IP", $_SERVER['REMOTE_ADDR']);   
    
	define("CLASSES", "engine/classes");
    define("BLOCKSS", "engine/blocks");
	define("MODULES", "engine/modules");
    define("ADMIN_MODULES", "engine/admin_modules");
	define("AJAX_MODULES", "engine/ajax_modules");
	
    define("RE_MAIL", "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$");

    define("FILTER_NUMS", "/[^0-9]/");
    define("RE_IMAGE", "^[a-zA-Z0-9_-]+$");
	define("RE_LOGIN", "/^[a-zA-Z0-9-_.]+$/");
    define("RE_PASSWORD", "/^[a-zA-Z0-9]+$/");
    
    define("SITE_DIR", preg_replace("/engine/", "", dirname(__FILE__)));
    define("CONFIG_DIR", "engine/config");
    define("LANG_DIR", "languages");
    define("DB_BACKUP_DIR", "uploads/dbbackups");
    define("FONTS_DIR", "uploads/fonts");
    define("AVATARS_DIR", "uploads/avatars");
    define("IMAGES_DIR", "uploads/images");
    define("BLOCK_TEMPLATES_DIR", "uploads/block_templates");
    define("TEMPLATES_DIR", "themes/".$CONFIG['theme']);
	define("ADMIN_TEMPLATES_DIR", "admin_themes/default");
	
	define("USERS", MYSQL_PREF."users");
	define("USERSGROUP", MYSQL_PREF."usersgroup");
	define("NEWS", MYSQL_PREF."news");
	define("BLOCKS", MYSQL_PREF."blocks");
	define("BANNERS", MYSQL_PREF."banners");
	define("NOTE", MYSQL_PREF."note");
	define("PM", MYSQL_PREF."pm");
	define("BOOKMARKS", MYSQL_PREF."bookmarks");
	define("VOTE", MYSQL_PREF."vote");
	define("VOTES", MYSQL_PREF."votes");
	define("CATEGORIES", MYSQL_PREF."categories");
	define("BANNEDIP", MYSQL_PREF."bannedip");
	define("WFILTER", MYSQL_PREF."wfilter");
	define("EMAIL", MYSQL_PREF."email");
	define("COMMENTS", MYSQL_PREF."comments");
	define("STATIK", MYSQL_PREF."statik");
	define("BLOCKS", MYSQL_PREF."blocks");
	
?>
