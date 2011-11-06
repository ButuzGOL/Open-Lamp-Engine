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
// Файл: categories.php
//-----------------------------------------------------------------------------/
// Назначение: Модуль вывода новостей по категориям
//=============================================================================/
*/

	if (!defined("OLE")) die("<script>window.location = \"./\"</script>");
	
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
	
	$id = $o_vars->get['id'];
	$p  = $o_vars->get['p'];
	
	if (!$id) {
	
		$result = $o_categories->makeTree();
        if (!$result) $o_other->showMess($LANG[$m], $LANG[$m.'_egets'], "index.php", $LANG['redir_main'], TEMPLATES_DIR);  
		else {
			$mrules["{TITLE}"]  = $LANG[$m];
			$mrules["{MIDDLE}"] = "";
			foreach ($result as $n) {
				$kol = $o_news->kolNewsS(0, 0, 0, false, $n[0]);
				$mrules1["{MIDDLE}"] .= ($kol) ? "<a href=\"index.php?m=$m&amp;id=$n[0]\">".$n[1]." ($kol)</a><br />" : $n[1]." ($kol) <br />";
			}
			
			$mrules["{MIDDLE}"] .= $o_tpl->gethtml(TEMPLATES_DIR."/".$m."_allshowm_middle.tpl", $mrules1);
			$o_tpl->addhtml(TEMPLATES_DIR."/default_middle.tpl", $mrules);
		}
	}
	else {
		$result = $o_categories->get($id);
		if (!$result) $o_other->showMess($LANG[$m], $LANG['news_egets'], "?m=$m", $LANG['redir_main'], TEMPLATES_DIR); 
		else {  
			foreach ($result as $n);
			
			$news_sort     = (!$n[3]) ? $CONFIG['news_sort']  : $n[3]; 
			$news_msort    = (!$n[4]) ? $CONFIG['news_msort'] : $n[4];
			$kol_news_on_p = (!$n[5]) ? $CONFIG['news_num']   : $n[5];
			$cate_name     = $n[0];
				
			$result = $o_news->getS($p, $kol_news_on_p, 0, 0, 0, false, $news_sort, $news_msort, $cate_name);
			if (!$result)
				if ($result && !$p) $o_other->showMess($LANG[$m], $LANG['news_egets'], "index.php", $LANG['redir_main'], TEMPLATES_DIR);  
				else $o_other->showMess($LANG[$m], $LANG['news_egets'], "index.php", $LANG['redir_main'], TEMPLATES_DIR);
			else { 
			    $kol_news = $o_news->kolNewsS(0, 0, 0, false, $cate_name);     
			    $banners_top    = "";
	            $banners_middle = "";
	            $banners_buttom = "";
	            $result1 = $o_banners->getS(5, $id);
	            if ($result1) {
	                foreach ($result1 as $n) {
	                    if ($n[5]=="1" || $n[5]=="4" || $n[5]=="5" || $n[5]=="7") $banners_top    .= $n[2];
	                    if ($n[5]=="2" || $n[5]=="4" || $n[5]=="6" || $n[5]=="7") $banners_middle .= $n[2];
	                    if ($n[5]=="3" || $n[5]=="5" || $n[5]=="6" || $n[5]=="7") $banners_buttom .= $n[2];
	                } 	
	            }
	            if ($banners_top) $o_tpl->addhtml($banners_top);
	            $banners_help  = floor(($kol_news - $p * $kol_news_on_p) / 2);
	            if (($kol_news - $p * $kol_news_on_p) >= $kol_news_on_p) $banners_help  = floor($kol_news_on_p / 2);  	
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
							if ($k)	$mrules["{BOOKMARKS}"] = "<img src=\"".TEMPLATES_DIR."/images/bookmarks_minus.png\" onclick=\"gogoAj('bookmark_$n[0]','bookmarks','act=del&amp;user_id=$ID&amp;news_id=$n[0]','{TEMPLATE}',2);\" style=\"cursor: pointer;\" title=\"".$LANG['bookmarks_del']."\" alt=\"".$LANG['bookmarks_del']."\" />";
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
							for ($i = 0; $a1[$i]; $i++) $mrules["{CATE}"] .= "<a href='?m=$m&amp;id=$a1[$i]'>".$o_categories->getOne($a1[$i], "name")."</a> &raquo; ";	
							$mrules["{CATE}"] = substr($mrules["{CATE}"], 0, -8);
						}
						else {
							for ($i = 0; $a[$i]; $i++) $mrules["{CATE}"] .= "<a href='?m=$m&amp;id=$a[$i]'>".$o_categories->getOne($a[$i], "name")."</a> &amp; ";
							$mrules["{CATE}"] = substr($mrules["{CATE}"], 0, -7);	          	
						}
					}
					
					$mrules['{DEL}']  = ($USER_RIGHTS['allow_all_edit'] || ($USER_RIGHTS['allow_edit'] && $ID==$n[19])) ? "<a href=\"index.php?m=news&amp;a=del&amp;id=$n[0]\"><img src=\"".TEMPLATES_DIR."/images/del.png\" title=\"".$LANG['del']."\" alt=\"".$LANG['del']."\" /></a>" : "";
					$mrules['{EDIT}'] = ($USER_RIGHTS['allow_all_edit'] || ($USER_RIGHTS['allow_edit'] && $ID==$n[19])) ? "<a href=\"index.php?m=news&amp;a=edit&amp;id=$n[0]\"><img src=\"".TEMPLATES_DIR."/images/edit.png\" title=\"".$LANG['edit']."\" alt=\"".$LANG['edit']."\" /></a>" : "";
					
					$k1++;
			        $o_tpl->addhtml(TEMPLATES_DIR."/news_allshow.tpl", $mrules);
                    if ($k1==$banners_help) if ($banners_middle) $o_tpl->addhtml($banners_middle);
		        }
		    }
			
		    if ($result) {
	            $kol_p = ceil($kol_news / $kol_news_on_p);		        if ($kol_p > 1) {
					
					unset($mrules);
		    				            	
            		if ($p > 0) $mrules["{PRIV}"] = "<a href=\"index.php?m=$m&amp;id=$id&amp;p=".($p-1)."\">".$LANG['spriv']."</a>";
            		else $mrules["{PRIV}"] = "<span>".$LANG['spriv']."</span>";
            
            		$mrules["{LPAGES}"] = "";
            	
			        for ($i = 0, $t1 = 1, $t2 = 1; $i < $kol_p; $i++) {
				        if ($kol_p > 13) {   
				                
				            if ($i < 4 || ($i-$p) < 2 && $p < 6) $mrules["{LPAGES}"] .= ($i==$p) ? "<span class=\"sp\">".($i+1)."</span> " : "<a href=\"index.php?m=$m&amp;id=$id&amp;p=$i\">".($i+1)."</a> "; 
				            elseif ($t1)  {$mrules["{LPAGES}"] .= " ... "; $t1 = 0;}
				                
				            if ($i > ($p-2) && $p > 5 && $p < ($kol_p - 6) && ($i-$p) < 2) $mrules["{LPAGES}"] .= ($i==$p) ? "<span class=\"sp\">".($i+1)."</span> " : "<a href=\"index.php?m=$m&amp;id=$id&amp;p=$i\">".($i+1)."</a> ";
				            elseif ($t2 && $p > 5 && $i > 4 && $p < ($kol_p - 6) && $i > ($kol_p - 5))  {$mrules["{LPAGES}"] .= " ... "; $t2 = 0;}				        
				            
				                
                            if ($i > ($kol_p - 5) || ($p - $i) < 2 && $p > ($kol_p - 7)) $mrules["{LPAGES}"] .= ($i==$p) ? "<span class=\"sp\">".($i+1)."</span> " : "<a href=\"index.php?m=$m&amp;id=$id&amp;p=$i\">".($i+1)."</a> ";
                        }
                        else $mrules["{LPAGES}"] .= ($i==$p) ? "<span class=\"sp\">".($i+1)."</span> " : "<a href=\"index.php?m=$m&amp;id=$id&amp;p=$i\">".($i+1)."</a> ";
            	    }
            	    
			        if ($kol_news - $kol_news_on_p  * ($p + 1) > 0) $mrules["{NEXT}"] = "<a href=\"index.php?m=$m&amp;id=$id&amp;p=".($p+1)."\">".$LANG['snext']."</a>";
            		else $mrules["{NEXT}"] = "<span>".$LANG['snext']."</span>";
            	
            		$o_tpl->addhtml(TEMPLATES_DIR."/pages.tpl", $mrules);
		        }	
		        if ($banners_buttom) $o_tpl->addhtml($banners_buttom);	
		    }
	    }
	}
    	
?>
