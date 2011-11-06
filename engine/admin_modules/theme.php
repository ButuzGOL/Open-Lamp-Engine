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
// Файл: tpl.php
//-----------------------------------------------------------------------------/
// Назначение: Модуль управления шаблонами сайта (админка)
//=============================================================================/
*/
	if ($USER_RIGHTS['id_ug']==1) {
			$sw = false;

			$news_allshow         = $o_other->otfiltertpl($o_vars->post['news_allshow']);
			$news_vote            = $o_other->otfiltertpl($o_vars->post['news_vote']);
			$news_allshowm_middle = $o_other->otfiltertpl($o_vars->post['news_allshowm_middle']);
			$news_form_middle     = $o_other->otfiltertpl($o_vars->post['news_form_middle']);
			$comments_show        = $o_other->otfiltertpl($o_vars->post['comments_show']);
	
			$pages = $o_other->otfiltertpl($o_vars->post['pages']); 			   	
			$statik_show            = $o_other->otfiltertpl($o_vars->post['statik_show']);
	
			$pm_show_middle     = $o_other->otfiltertpl($o_vars->post['pm_show_middle']);
			$arhnews_allshowm_middle    = $o_other->otfiltertpl($o_vars->post['arhnews_allshowm_middle']);
			$registr_middle             = $o_other->otfiltertpl($o_vars->post['registr_middle']);
			$profile_middle             = $o_other->otfiltertpl($o_vars->post['profile_middle']);
			$statistik_middle           = $o_other->otfiltertpl($o_vars->post['statistik_middle']);
			$messcs      = $o_other->otfiltertpl($o_vars->post['messcs']);
				
				$sw = true;
				
				$o_other->fileWrite(TEMPLATES_DIR."/news_allshow.tpl", $news_allshow);
				$o_other->fileWrite(TEMPLATES_DIR."/news_vote.tpl", $news_vote);
				$o_other->fileWrite(TEMPLATES_DIR."/news_allshowm_middle.tpl", $news_allshowm_middle);
				$o_other->fileWrite(TEMPLATES_DIR."/news_form_middle.tpl", $news_form_middle);
				$o_other->fileWrite(TEMPLATES_DIR."/comments_show.tpl", $comments_show);
			
				$o_other->fileWrite(TEMPLATES_DIR."/pages.tpl", $pages); 			   	
				$o_other->fileWrite(TEMPLATES_DIR."/statik_show.tpl", $statik_show);
			
				$o_other->fileWrite(TEMPLATES_DIR."/pm_show_middle.tpl", $pm_show_middle);
				$o_other->fileWrite(TEMPLATES_DIR."/arhnews_allshowm_middle.tpl", $arhnews_allshowm_middle);
				$o_other->fileWrite(TEMPLATES_DIR."/registr_middle.tpl", $registr_middle);
				$o_other->fileWrite(TEMPLATES_DIR."/profile_middle.tpl", $profile_middle);
				$o_other->fileWrite(TEMPLATES_DIR."/statistik_middle.tpl", $statistik_middle);
				$o_other->fileWrite(TEMPLATES_DIR."/messcs.tpl", $messcs);
	        	if ($result) $MESS = $o_other->showMessA($LANG[$m.'_edit']);
	            else $MESS = $o_other->showMessA($LANG[$m.'_eedit'], 1);
	        	
	        	$mrules["{TITLEE}"] = $LANG[$m] .TEMPLATES_DIR;		
				$mrules["{NEWS_ALLSHOW}"]         = $o_other->filterTpl($news_allshow);
				$mrules["{NEWS_VOTE}"]            = $o_other->filterTpl($news_vote);
				$mrules["{NEWS_ALLSHOWM_MIDDLE}"] = $o_other->filterTpl($news_allshowm_middle);
				$mrules["{NEWS_FORM_MIDDLE}"]     = $o_other->filterTpl($news_form_middle);
				$mrules["{COMMENTS_SHOW}"]        = $o_other->filterTpl($comments_show);
		
				$mrules["{PAGES}"] = $o_other->filterTpl($pages); 			   	
				$mrules["{STATIK_SHOW}"]            = $o_other->filterTpl($statik_show);
		
				$mrules["{PM_SHOW_MIDDLE}"]     = $o_other->filterTpl($pm_show_middle);
				$mrules["{ARHNEWS_ALLSHOWM_MIDDLE}"]    = $o_other->filterTpl($arhnews_allshowm_middle);
				$mrules["{REGISTR_MIDDLE}"]             = $o_other->filterTpl($registr_middle);
				$mrules["{PROFILE_MIDDLE}"]             = $o_other->filterTpl($profile_middle);
				$mrules["{STATISTIK_MIDDLE}"]           = $o_other->filterTpl($statistik_middle);
				$mrules["{MESSCS}"]      = $o_other->filterTpl($messcs);
				$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);
	        	$MESS = $o_other->showMessA($LANG['wrong_input'], 1);
	        }
		
		if (!isset($action) || $sw) { 
	    	
	    	$mrules["{TITLEE}"] = $LANG[$m] .TEMPLATES_DIR;		
			$mrules["{NEWS_ALLSHOW}"]         = $o_other->filterTpl($o_other->fileRead(TEMPLATES_DIR."/news_allshow.tpl"));
			$mrules["{NEWS_VOTE}"]            = $o_other->filterTpl($o_other->fileRead(TEMPLATES_DIR."/news_vote.tpl"));
			$mrules["{NEWS_ALLSHOWM_MIDDLE}"] = $o_other->filterTpl($o_other->fileRead(TEMPLATES_DIR."/news_allshowm_middle.tpl"));
			$mrules["{NEWS_FORM_MIDDLE}"]     = $o_other->filterTpl($o_other->fileRead(TEMPLATES_DIR."/news_form_middle.tpl"));
			$mrules["{COMMENTS_SHOW}"]        = $o_other->filterTpl($o_other->fileRead(TEMPLATES_DIR."/comments_show.tpl"));
			
			$mrules["{PAGES}"] = $o_other->filterTpl($o_other->fileRead(TEMPLATES_DIR."/pages.tpl")); 			   	
			$mrules["{STATIK_SHOW}"]            = $o_other->filterTpl($o_other->fileRead(TEMPLATES_DIR."/statik_show.tpl"));
			
			$mrules["{PM_SHOW_MIDDLE}"]     = $o_other->filterTpl($o_other->fileRead(TEMPLATES_DIR."/pm_show_middle.tpl"));
			$mrules["{ARHNEWS_ALLSHOWM_MIDDLE}"]    = $o_other->filterTpl($o_other->fileRead(TEMPLATES_DIR."/arhnews_allshowm_middle.tpl"));
			$mrules["{REGISTR_MIDDLE}"]             = $o_other->filterTpl($o_other->fileRead(TEMPLATES_DIR."/registr_middle.tpl"));
			$mrules["{PROFILE_MIDDLE}"]             = $o_other->filterTpl($o_other->fileRead(TEMPLATES_DIR."/profile_middle.tpl"));
			$mrules["{STATISTIK_MIDDLE}"]           = $o_other->filterTpl($o_other->fileRead(TEMPLATES_DIR."/statistik_middle.tpl"));
			$mrules["{MESSCS}"]      = $o_other->filterTpl($o_other->fileRead(TEMPLATES_DIR."/messcs.tpl"));
			$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);
	