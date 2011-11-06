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
*/    if (!defined("OLE")) die("<script>window.location = \"./\"</script>");	
	if ($USER_RIGHTS['id_ug']==1) {				$action = $o_vars->post['action'];			    if (isset($action)) {		
			$sw = false;
			$header         = $o_other->otfiltertpl($o_vars->post['header']);			$footer         = $o_other->otfiltertpl($o_vars->post['footer']); 			   				$default_middle = $o_other->otfiltertpl($o_vars->post['default_middle']);			$default_block  = $o_other->otfiltertpl($o_vars->post['default_block']);			$show_mess      = $o_other->otfiltertpl($o_vars->post['show_mess']);				
			$news_allshow         = $o_other->otfiltertpl($o_vars->post['news_allshow']);			$news_show            = $o_other->otfiltertpl($o_vars->post['news_show']);
			$news_vote            = $o_other->otfiltertpl($o_vars->post['news_vote']);			$news_votea           = $o_other->otfiltertpl($o_vars->post['news_votea']);
			$news_allshowm_middle = $o_other->otfiltertpl($o_vars->post['news_allshowm_middle']);
			$news_form_middle     = $o_other->otfiltertpl($o_vars->post['news_form_middle']);	
			$comments_show        = $o_other->otfiltertpl($o_vars->post['comments_show']);			$comments_add_middle1 = $o_other->otfiltertpl($o_vars->post['comments_add_middle1']);			$comments_add_middle2 = $o_other->otfiltertpl($o_vars->post['comments_add_middle2']);			$comments_edit_middle = $o_other->otfiltertpl($o_vars->post['comments_edit_middle']);
	
			$pages = $o_other->otfiltertpl($o_vars->post['pages']); 			   					
			$statik_show            = $o_other->otfiltertpl($o_vars->post['statik_show']);			$statik_allshowm_middle = $o_other->otfiltertpl($o_vars->post['statik_allshowm_middle']); 			   				$statik_form_middle     = $o_other->otfiltertpl($o_vars->post['statik_form_middle']);
	
			$pm_show_middle     = $o_other->otfiltertpl($o_vars->post['pm_show_middle']);			$pm_allshowm_middle = $o_other->otfiltertpl($o_vars->post['pm_allshowm_middle']);			$pm_add_middle      = $o_other->otfiltertpl($o_vars->post['pm_add_middle']);	
			$arhnews_allshowm_middle    = $o_other->otfiltertpl($o_vars->post['arhnews_allshowm_middle']);			$categories_allshowm_middle = $o_other->otfiltertpl($o_vars->post['categories_allshowm_middle']);			$lostpass_middle            = $o_other->otfiltertpl($o_vars->post['lostpass_middle']);
			$registr_middle             = $o_other->otfiltertpl($o_vars->post['registr_middle']);			$search_middle              = $o_other->otfiltertpl($o_vars->post['search_middle']);
			$profile_middle             = $o_other->otfiltertpl($o_vars->post['profile_middle']);
			$statistik_middle           = $o_other->otfiltertpl($o_vars->post['statistik_middle']);	
			$messcs      = $o_other->otfiltertpl($o_vars->post['messcs']);			$calendarcss = $o_other->otfiltertpl($o_vars->post['calendarcss']);							if ($header!="" && $footer!="" && $default_middle!="" && $default_block!="" && $show_mess!="" && $news_allshow!="" && $news_show!="" && $news_vote!="" && $news_votea!="" && $news_allshowm_middle!="" && $news_form_middle!="" && $comments_show!="" && $comments_add_middle1!="" && $comments_add_middle2!="" && $comments_edit_middle!="" && $pages!="" && $statik_show!="" && $statik_allshowm_middle!="" && $statik_form_middle!="" && $pm_show_middle!="" && $pm_allshowm_middle!="" && $pm_add_middle!="" && $arhnews_allshowm_middle!="" && $categories_allshowm_middle!="" && $lostpass_middle!="" && $registr_middle!="") {
				
				$sw = true;
								$o_other->fileWrite(TEMPLATES_DIR."/header.tpl", $header);				$o_other->fileWrite(TEMPLATES_DIR."/footer.tpl", $footer); 			   					$o_other->fileWrite(TEMPLATES_DIR."/default_middle.tpl", $default_middle);				$o_other->fileWrite(TEMPLATES_DIR."/default_block.tpl", $default_block);				$o_other->fileWrite(TEMPLATES_DIR."/show_mess.tpl", $show_mess);						
				$o_other->fileWrite(TEMPLATES_DIR."/news_allshow.tpl", $news_allshow);				$o_other->fileWrite(TEMPLATES_DIR."/news_show.tpl", $news_show);
				$o_other->fileWrite(TEMPLATES_DIR."/news_vote.tpl", $news_vote);				$o_other->fileWrite(TEMPLATES_DIR."/news_votea.tpl", $news_votea);
				$o_other->fileWrite(TEMPLATES_DIR."/news_allshowm_middle.tpl", $news_allshowm_middle);
				$o_other->fileWrite(TEMPLATES_DIR."/news_form_middle.tpl", $news_form_middle);			
				$o_other->fileWrite(TEMPLATES_DIR."/comments_show.tpl", $comments_show);				$o_other->fileWrite(TEMPLATES_DIR."/comments_add_middle1.tpl", $comments_add_middle1);				$o_other->fileWrite(TEMPLATES_DIR."/comments_add_middle2.tpl", $comments_add_middle2);				$o_other->fileWrite(TEMPLATES_DIR."/comments_edit_middle.tpl", $comments_edit_middle);
			
				$o_other->fileWrite(TEMPLATES_DIR."/pages.tpl", $pages); 			   							
				$o_other->fileWrite(TEMPLATES_DIR."/statik_show.tpl", $statik_show);				$o_other->fileWrite(TEMPLATES_DIR."/statik_allshowm_middle.tpl", $statik_allshowm_middle); 			   					$o_other->fileWrite(TEMPLATES_DIR."/statik_form_middle.tpl", $statik_form_middle);
			
				$o_other->fileWrite(TEMPLATES_DIR."/pm_show_middle.tpl", $pm_show_middle);				$o_other->fileWrite(TEMPLATES_DIR."/pm_allshowm_middle.tpl", $pm_allshowm_middle);				$o_other->fileWrite(TEMPLATES_DIR."/pm_add_middle.tpl", $pm_add_middle);			
				$o_other->fileWrite(TEMPLATES_DIR."/arhnews_allshowm_middle.tpl", $arhnews_allshowm_middle);				$o_other->fileWrite(TEMPLATES_DIR."/categories_allshowm_middle.tpl", $categories_allshowm_middle);				$o_other->fileWrite(TEMPLATES_DIR."/lostpass_middle.tpl", $lostpass_middle);
				$o_other->fileWrite(TEMPLATES_DIR."/registr_middle.tpl", $registr_middle);				$o_other->fileWrite(TEMPLATES_DIR."/search_middle.tpl", $search_middle);
				$o_other->fileWrite(TEMPLATES_DIR."/profile_middle.tpl", $profile_middle);
				$o_other->fileWrite(TEMPLATES_DIR."/statistik_middle.tpl", $statistik_middle);			
				$o_other->fileWrite(TEMPLATES_DIR."/messcs.tpl", $messcs);				$result = $o_other->fileWrite(TEMPLATES_DIR."/calendar.css", $calendarcss);	        	
	        	if ($result) $MESS = $o_other->showMessA($LANG[$m.'_edit']);
	            else $MESS = $o_other->showMessA($LANG[$m.'_eedit'], 1);	        }	        else {
	        	
	        	$mrules["{TITLEE}"] = $LANG[$m] .TEMPLATES_DIR;												$mrules["{HEADER}"]         = $o_other->filterTpl($header);				$mrules["{FOOTER}"]         = $o_other->filterTpl($footer); 			   					$mrules["{DEFAULT_MIDDLE}"] = $o_other->filterTpl($default_middle);				$mrules["{DEFAULT_BLOCK}"]  = $o_other->filterTpl($default_block);				$mrules["{SHOW_MESS}"]      = $o_other->filterTpl($show_mess);					
				$mrules["{NEWS_ALLSHOW}"]         = $o_other->filterTpl($news_allshow);				$mrules["{NEWS_SHOW}"]            = $o_other->filterTpl($news_show);
				$mrules["{NEWS_VOTE}"]            = $o_other->filterTpl($news_vote);				$mrules["{NEWS_VOTEA}"]           = $o_other->filterTpl($news_votea);
				$mrules["{NEWS_ALLSHOWM_MIDDLE}"] = $o_other->filterTpl($news_allshowm_middle);
				$mrules["{NEWS_FORM_MIDDLE}"]     = $o_other->filterTpl($news_form_middle);		
				$mrules["{COMMENTS_SHOW}"]        = $o_other->filterTpl($comments_show);				$mrules["{COMMENTS_ADD_MIDDLE1}"] = $o_other->filterTpl($comments_add_middle1);				$mrules["{COMMENTS_ADD_MIDDLE2}"] = $o_other->filterTpl($comments_add_middle2);				$mrules["{COMMENTS_EDIT_MIDDLE}"] = $o_other->filterTpl($comments_edit_middle);
		
				$mrules["{PAGES}"] = $o_other->filterTpl($pages); 			   						
				$mrules["{STATIK_SHOW}"]            = $o_other->filterTpl($statik_show);				$mrules["{STATIK_ALLSHOWM_MIDDLE}"] = $o_other->filterTpl($statik_allshowm_middle); 			   					$mrules["{STATIK_FORM_MIDDLE}"]     = $o_other->filterTpl($statik_form_middle);
		
				$mrules["{PM_SHOW_MIDDLE}"]     = $o_other->filterTpl($pm_show_middle);				$mrules["{PM_ALLSHOWM_MIDDLE}"] = $o_other->filterTpl($pm_allshowm_middle);				$mrules["{PM_ADD_MIDDLE}"]      = $o_other->filterTpl($pm_add_middle);		
				$mrules["{ARHNEWS_ALLSHOWM_MIDDLE}"]    = $o_other->filterTpl($arhnews_allshowm_middle);				$mrules["{CATEGORIES_ALLSHOWM_MIDDLE}"] = $o_other->filterTpl($categories_allshowm_middle);				$mrules["{LOSTPASS_MIDDLE}"]            = $o_other->filterTpl($lostpass_middle);
				$mrules["{REGISTR_MIDDLE}"]             = $o_other->filterTpl($registr_middle);				$mrules["{SEARCH_MIDDLE}"]              = $o_other->filterTpl($search_middle);
				$mrules["{PROFILE_MIDDLE}"]             = $o_other->filterTpl($profile_middle);
				$mrules["{STATISTIK_MIDDLE}"]           = $o_other->filterTpl($statistik_middle);		
				$mrules["{MESSCS}"]      = $o_other->filterTpl($messcs);				$mrules["{CALENDARCSS}"] = $o_other->filterTpl($calendarcss);			
				$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);
	        	$MESS = $o_other->showMessA($LANG['wrong_input'], 1);
	        }		}
		
		if (!isset($action) || $sw) { 
	    	
	    	$mrules["{TITLEE}"] = $LANG[$m] .TEMPLATES_DIR;											$mrules["{HEADER}"]         = $o_other->filterTpl($o_other->fileRead(TEMPLATES_DIR."/header.tpl"));			$mrules["{FOOTER}"]         = $o_other->filterTpl($o_other->fileRead(TEMPLATES_DIR."/footer.tpl")); 			   				$mrules["{DEFAULT_MIDDLE}"] = $o_other->filterTpl($o_other->fileRead(TEMPLATES_DIR."/default_middle.tpl"));			$mrules["{DEFAULT_BLOCK}"]  = $o_other->filterTpl($o_other->fileRead(TEMPLATES_DIR."/default_block.tpl"));			$mrules["{SHOW_MESS}"]      = $o_other->filterTpl($o_other->fileRead(TEMPLATES_DIR."/show_mess.tpl"));						
			$mrules["{NEWS_ALLSHOW}"]         = $o_other->filterTpl($o_other->fileRead(TEMPLATES_DIR."/news_allshow.tpl"));			$mrules["{NEWS_SHOW}"]            = $o_other->filterTpl($o_other->fileRead(TEMPLATES_DIR."/news_show.tpl"));
			$mrules["{NEWS_VOTE}"]            = $o_other->filterTpl($o_other->fileRead(TEMPLATES_DIR."/news_vote.tpl"));			$mrules["{NEWS_VOTEA}"]           = $o_other->filterTpl($o_other->fileRead(TEMPLATES_DIR."/news_votea.tpl"));
			$mrules["{NEWS_ALLSHOWM_MIDDLE}"] = $o_other->filterTpl($o_other->fileRead(TEMPLATES_DIR."/news_allshowm_middle.tpl"));
			$mrules["{NEWS_FORM_MIDDLE}"]     = $o_other->filterTpl($o_other->fileRead(TEMPLATES_DIR."/news_form_middle.tpl"));			
			$mrules["{COMMENTS_SHOW}"]        = $o_other->filterTpl($o_other->fileRead(TEMPLATES_DIR."/comments_show.tpl"));			$mrules["{COMMENTS_ADD_MIDDLE1}"] = $o_other->filterTpl($o_other->fileRead(TEMPLATES_DIR."/comments_add_middle1.tpl"));			$mrules["{COMMENTS_ADD_MIDDLE2}"] = $o_other->filterTpl($o_other->fileRead(TEMPLATES_DIR."/comments_add_middle2.tpl"));			$mrules["{COMMENTS_EDIT_MIDDLE}"] = $o_other->filterTpl($o_other->fileRead(TEMPLATES_DIR."/comments_edit_middle.tpl"));
			
			$mrules["{PAGES}"] = $o_other->filterTpl($o_other->fileRead(TEMPLATES_DIR."/pages.tpl")); 			   							
			$mrules["{STATIK_SHOW}"]            = $o_other->filterTpl($o_other->fileRead(TEMPLATES_DIR."/statik_show.tpl"));			$mrules["{STATIK_ALLSHOWM_MIDDLE}"] = $o_other->filterTpl($o_other->fileRead(TEMPLATES_DIR."/statik_allshowm_middle.tpl")); 			   				$mrules["{STATIK_FORM_MIDDLE}"]     = $o_other->filterTpl($o_other->fileRead(TEMPLATES_DIR."/statik_form_middle.tpl"));
			
			$mrules["{PM_SHOW_MIDDLE}"]     = $o_other->filterTpl($o_other->fileRead(TEMPLATES_DIR."/pm_show_middle.tpl"));			$mrules["{PM_ALLSHOWM_MIDDLE}"] = $o_other->filterTpl($o_other->fileRead(TEMPLATES_DIR."/pm_allshowm_middle.tpl"));			$mrules["{PM_ADD_MIDDLE}"]      = $o_other->filterTpl($o_other->fileRead(TEMPLATES_DIR."/pm_add_middle.tpl"));			
			$mrules["{ARHNEWS_ALLSHOWM_MIDDLE}"]    = $o_other->filterTpl($o_other->fileRead(TEMPLATES_DIR."/arhnews_allshowm_middle.tpl"));			$mrules["{CATEGORIES_ALLSHOWM_MIDDLE}"] = $o_other->filterTpl($o_other->fileRead(TEMPLATES_DIR."/categories_allshowm_middle.tpl"));			$mrules["{LOSTPASS_MIDDLE}"]            = $o_other->filterTpl($o_other->fileRead(TEMPLATES_DIR."/lostpass_middle.tpl"));
			$mrules["{REGISTR_MIDDLE}"]             = $o_other->filterTpl($o_other->fileRead(TEMPLATES_DIR."/registr_middle.tpl"));			$mrules["{SEARCH_MIDDLE}"]              = $o_other->filterTpl($o_other->fileRead(TEMPLATES_DIR."/search_middle.tpl"));
			$mrules["{PROFILE_MIDDLE}"]             = $o_other->filterTpl($o_other->fileRead(TEMPLATES_DIR."/profile_middle.tpl"));
			$mrules["{STATISTIK_MIDDLE}"]           = $o_other->filterTpl($o_other->fileRead(TEMPLATES_DIR."/statistik_middle.tpl"));			
			$mrules["{MESSCS}"]      = $o_other->filterTpl($o_other->fileRead(TEMPLATES_DIR."/messcs.tpl"));			$mrules["{CALENDARCSS}"] = $o_other->filterTpl($o_other->fileRead(TEMPLATES_DIR."/calendar.css"));			
			$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);	    }    }	else $MESS1 = $o_other->showMessA($LANG['eaccess'], 1);
	?>
