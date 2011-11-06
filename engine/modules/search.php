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
// Файл: search.php
//-----------------------------------------------------------------------------/
// Назначение: Модуль поиска новостей
//=============================================================================/
*/

	if (!defined("OLE")) die("<script>window.location = \"./\"</script>");
	
	if ($USER_RIGHTS['allow_search']) {
	
		include(CLASSES ."/news.class.php");
		include(CLASSES ."/categories.class.php");
		include(CLASSES ."/vote.class.php");
		include(CLASSES ."/banners.class.php");
		include(CLASSES ."/comments.class.php");
		include(CLASSES ."/bbcodes.class.php");
	
		$o_news 	  = new news($o_mysql);
		$o_categories = new categories($o_mysql);
		$o_vote 	  = new vote($o_mysql);
		$o_banners 	  = new banners($o_mysql);
		$o_comments   = new comments($o_mysql);
		$o_bbcodes    = new bbcodes();
	
	    $action_search = ($o_vars->post['action_search']) ? $o_vars->post['action_search'] : $o_vars->post['action_searchf'];
		
	    if ($action_search) {
	
		    $keyword           = stripslashes(htmlspecialchars(strip_tags($o_vars->post['keyword']), ENT_QUOTES));
		    $autor             = stripslashes(htmlspecialchars(strip_tags($o_vars->post['autor']), ENT_QUOTES));
		    $w_find            = intval($o_vars->post['w_find']);
		    $search_date       = intval($o_vars->post['search_date']);
		    $type_search_date  = intval($o_vars->post['type_search_date']);
		    $sort              = intval($o_vars->post['sort']);
		    $order             = intval($o_vars->post['order']);
		    $search            = stripslashes(htmlspecialchars(strip_tags($o_vars->post['search']), ENT_QUOTES));
		
		    if (@in_array("0", $o_vars->post['cats'])) $cats = "0";
		    else $cats = @implode(",", $o_categories->makeCats($o_vars->post['cats']));
		
		    if (!$search) $result = $o_news->getSearch($keyword, $autor, $w_find, $search_date, $type_search_date, $sort, $order, $cats);
	     	else $result = $o_news->getSearch($search);
		    if (!$result) $o_other->showMess($LANG[$m], $LANG[$m.'_egets'], "?m=$m", $LANG[$m], TEMPLATES_DIR);
		    else {
		        $kol_news = count($result);
	       	    $banners_top    = "";
	            $banners_middle = "";
	            $banners_buttom = "";
	            $result1 = $o_banners->getS(4);
	            if ($result1) {
	                foreach ($result1 as $n) {
	                    if ($n[5]=="1" || $n[5]=="4" || $n[5]=="5" || $n[5]=="7") $banners_top    .= $n[2];
	                    if ($n[5]=="2" || $n[5]=="4" || $n[5]=="6" || $n[5]=="7") $banners_middle .= $n[2];
	                    if ($n[5]=="3" || $n[5]=="5" || $n[5]=="6" || $n[5]=="7") $banners_buttom .= $n[2];
	                } 	
	            }
	            if ($banners_top) $o_tpl->addhtml($banners_top);
	            $banners_help  = floor($kol_news / 2); 	   	
	       	    $k1 = 0;      
		       	foreach ($result as $n) {
		       		
			        $mrules["{ID}"]          = $n[0];
			        $mrules["{DATE}"]        = $o_other->makeNormalDate($n[2],1);
		            $mrules["{AUTOR}"]       = ($o_users->getOne($n[19], "name")) ? "<a href=\"?m=profile&amp;id=$n[19]\">".$o_users->getOne($n[19], "name")."</a>" : $n[1];
		            $mrules["{TITLE}"]       = $n[5];
	                $mrules["{KOL_COMM}"]    = $o_comments->kolInNews($n[0]);
	                $mrules["{SHORT_STORY}"] = $o_bbcodes->filter(nl2br($n[3]), $USER_RIGHTS['allow_hide']);
	                $mrules["{NEWS_READ}"]   = $n[13];
	                
	                $mrules["{FULL}"] = ($USER_RIGHTS['allow_short'] && $o_categories->isAllowCate($USER_RIGHTS['allow_cats'], $n[7]) && $o_other->isAllowAccess($USER_RIGHTS['id_ug'], $n[17])) ? "<a href=\"?m=news&amp;id=$n[0]#comment\">".$LANG['comm']." (".$o_comments->kolInNews($n[0]).")</a> <a href=\"?m=news&amp;id=$n[0]\">".$LANG['news_fs']."</a>" : "".$LANG['comm']." (".$o_comments->kolInNews($n[0]).")"; 
	                
				    $mrules["{BOOKMARKS}"]  = "";
				    if ($ID) {
		            	$result1 = $o_users->getUserBookmarks($ID);
					    $mrules["{BOOKMARKS}"] = "<img src=\"".TEMPLATES_DIR."/images/bookmarks_plus.png\" onclick=\"gogoAj('bookmark_$n[0]','bookmarks','act=add&amp;user_id=$ID&amp;news_id=$n[0]','{TEMPLATE}',2);\" style=\"cursor: pointer;\" title=\"".$LANG['bookmarks_add']."\" alt=\"".$LANG['bookmarks_add']."\" />";
					    if ($result1) { 
						    $k = 0;
						    foreach($result1 as $n1) 
						    if ($n1[0]==$n[0]) {$k = 1; break;}
						    if ($k)	$mrules["{BOOKMARKS}"] = "<img src=\"".TEMPLATES_DIR."/images/bookmarks_minus.png\" align=\"top\" onclick=\"gogoAj('bookmark_$n[0]','bookmarks','act=del&amp;user_id=$ID&amp;news_id=$n[0]','{TEMPLATE}',2);\" style=\"cursor: pointer;\" title=\"".$LANG['bookmarks_del']."\" alt=\"".$LANG['bookmarks_del']."\" />";
					    }
				    }
				
				    if ($n[10]) {
					    $sum_kol = $o_vote->SumKolVotesNews($n[0]);
					    if ($sum_kol[0][1])	$pr = round($sum_kol[0][0]/$sum_kol[0][1]*17);
					    else $pr = 0;
			
					    if (!$o_vote->getKolRateOnIp($n[0], IP) && $USER_RIGHTS['allow_rating']) {
						    $mrules["{RATE}"] = "
							    <ul class=\"unit-rating\">
								    <li class=\"current-rating\" style=\"width: ".$pr."px;\">$pr</li>
								    <li><a href=\"#\" title=\"".$LANG['rate_1']."\" class=\"r1-unit\" onclick=\"gogoAj('rate_$n[0]','rate','vote=1&amp;id=$n[0]','{TEMPLATE}',1); return false;\">1</a></li>
								    <li><a href=\"#\" title=\"".$LANG['rate_2']."\" class=\"r2-unit\" onclick=\"gogoAj('rate_$n[0]','rate','vote=2&amp;id=$n[0]','{TEMPLATE}',1); return false;\">2</a></li>
								    <li><a href=\"#\" title=\"".$LANG['rate_3']."\" class=\"r3-unit\" onclick=\"gogoAj('rate_$n[0]','rate','vote=3&amp;id=$n[0]','{TEMPLATE}',1); return false;\">3</a></li>
								    <li><a href=\"#\" title=\"".$LANG['rate_4']."\" class=\"r4-unit\" onclick=\"gogoAj('rate_$n[0]','rate','vote=4&amp;id=$n[0]','{TEMPLATE}',1); return false;\">4</a></li>
								    <li><a href=\"#\" title=\"".$LANG['rate_5']."\" class=\"r5-unit\" onclick=\"gogoAj('rate_$n[0]','rate','vote=5&amp;id=$n[0]','{TEMPLATE}',1); return false;\">5</a></li>
							    </ul>";	
					    }
					    else $mrules["{RATE}"] = "<ul class=\"unit-rating\"><li class=\"current-rating\" style=\"width: ".$pr."px;\">$pr</li></ul>";
				    }
				    else $mrules["{RATE}"] = "";
	
				    $mrules["{CATE}"] = "";
					if ($n[7]) {
						$a = explode(",", $n[7]);
						if (count($a)==1) {
							$a1 = $o_categories->makeWayCate($a[0]);
							for ($i = 0; $a1[$i]; $i++) $mrules["{CATE}"] .= "<a href='?m=categories&amp;id=$a1[$i]'>".$o_categories->getOne($a1[$i], "name")."</a> &raquo; ";	
							$mrules["{CATE}"] = substr($mrules["{CATE}"], 0, -8);
						}
						else {
							for ($i = 0; $a[$i]; $i++) $mrules["{CATE}"] .= "<a href='?m=categories&amp;id=$a[$i]'>".$o_categories->getOne($a[$i], "name")."</a> &amp; ";
							$mrules["{CATE}"] = substr($mrules["{CATE}"], 0, -7);	          	
						}
					}
				
				    $mrules['{DEL}']  = ($USER_RIGHTS['allow_all_edit'] || ($USER_RIGHTS['allow_edit'] && $ID==$n[19])) ? "<a href=\"index.php?m=news&amp;a=del&amp;id=$n[0]\"><img src=\"".TEMPLATES_DIR."/images/del.png\" title=\"".$LANG['del']."\" alt=\"".$LANG['del']."\" /></a>" : "";
					$mrules['{EDIT}'] = ($USER_RIGHTS['allow_all_edit'] || ($USER_RIGHTS['allow_edit'] && $ID==$n[19])) ? "<a href=\"index.php?m=news&a=edit&id=$n[0]\"><img src=\"".TEMPLATES_DIR."/images/edit.png\" title=\"".$LANG['edit']."\" alt=\"".$LANG['edit']."\" /></a>" : "";
				
				    $k1++;
			        $o_tpl->addhtml(TEMPLATES_DIR."/news_allshow.tpl", $mrules);
                    if ($k1==$banners_help) if ($banners_middle) $o_tpl->addhtml($banners_middle);
	            }
	            if ($banners_buttom) $o_tpl->addhtml($banners_buttom);
	        }	
	    }
	
	    if (!$action_search) {
		    $mrules1["{CATS}"] = "";
		    $result = $o_categories->makeTree();
		    if ($result) 
		    	foreach ($result as $n)
			    	$mrules1["{CATS}"] .= "<option value=\"$n[0]\">$n[1]</option>";
		
		    $mrules["{TITLE}"]  = $LANG[$m];
		    $mrules["{MIDDLE}"] = $o_tpl->gethtml(TEMPLATES_DIR."/".$m."_middle.tpl", $mrules1);
	
		    $o_tpl->addhtml(TEMPLATES_DIR."/default_middle.tpl", $mrules);
        }
    }
    else $o_other->showMess($LANG['mess'], $LANG['eaccess'], "index.php", $LANG['redir_main'], TEMPLATES_DIR);	

?>
