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
// Файл: categories.php
//-----------------------------------------------------------------------------/
// Назначение: Модуль управления категориями новостей (админка)
//=============================================================================/
*/    if (!defined("OLE")) die("<script>window.location = \"./\"</script>");        if ($USER_RIGHTS['id_ug']==1) {		
		include(CLASSES."/categories.class.php");
		
		$o_categories = new categories($o_mysql);
						$a  = $o_vars->get['a'];		$id = $o_vars->get['id'];						if ($a=="add") {			
			$sw = false;
				    	$action = $o_vars->post['action'];	    		        if (!isset($action)) { 
	        	
	        	$mrules["{TITLEE}"] = $LANG[$m.'_fadd'];
	        	
	        	$mrules["{NAME}"]       = "";
	        	$mrules["{NEWS_SORT}"]  = "";
	        	$mrules["{NEWS_MSORT}"] = "";
	     	    $mrules["{PARENT_ID0}"] = "";
	     	        		        	$mrules["{PARENT_ID}"] = "";
	        	$result = $o_categories->makeTree();	        	if ($result) foreach ($result as $n) $mrules["{PARENT_ID}"] .= "<option value=\"$n[0]\">".$n[1]."</option>";				
				$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);
		    }	        else {							$name = stripslashes(htmlspecialchars(strip_tags($o_vars->post['name']), ENT_QUOTES));
								$parent_id  = intval($o_vars->post['parent_id']);				$news_sort  = intval($o_vars->post['news_sort']);				$news_msort = intval($o_vars->post['news_msort']);				$news_num	= intval($o_vars->post['news_num']);				            				if ($name!="") {					
					$sw = true;
					
					$result = $o_categories->add($name, $parent_id, $news_sort, $news_msort, $news_num);
						            	if ($result) $MESS = $o_other->showMessA($LANG[$m.'_add']);
	            	else $MESS = $o_other->showMessA($LANG[$m.'_eadd'], 1);  				}	            else {
	            	
	            	$mrules["{TITLEE}"] = $LANG[$m.'_fadd'];
	            	
	            	$mrules["{NAME}"] = $name;
	            	
	            	$mrules["{PARENT_ID0}"] = $parent_id;
	            	$mrules["{NEWS_SORT}"]  = $news_sort;
	            	$mrules["{NEWS_MSORT}"] = $news_msort;
	            	$mrules["{NEWS_NUM}"]   = $news_num;
	            	
	            	$mrules["{PARENT_ID}"] = "";
	        		$result = $o_categories->makeTree();	        		if ($result) foreach ($result as $n) $mrules["{PARENT_ID}"] .= "<option value=\"$n[0]\">".$n[1]."</option>";
	        		
	            	$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);
	            	$MESS = $o_other->showMessA($LANG['wrong_input'], 1);
	            }	    	}	    }	    elseif ($a=="edit" && isset($id)) {		    
		    $sw = false;
		    			$action = $o_vars->post['action'];				        if (!isset($action)) {	            $result = $o_categories->get($id);	            if (!$result) {$sw = true; $MESS = $o_other->showMessA($LANG[$m.'_eget'], 1);} 				else {		        	foreach ($result as $n);		        	
		        	$mrules["{TITLEE}"] = $LANG[$m.'_fedit']. $n[1];
	    		    	    		    $mrules["{NAME}"]       = $n[1];	                $mrules["{PARENT_ID0}"] = $n[2];	                $mrules["{NEWS_SORT}"]  = $n[3];	                $mrules["{NEWS_MSORT}"] = $n[4];	                $mrules["{NEWS_NUM}"]   = $n[5];	                					$mrules["{PARENT_ID}"] = "";
					$result = $o_categories->makeTree($id);					if ($result) 
						foreach ($result as $n) 
							if ($n[0]!=$id) $mrules["{PARENT_ID}"] .= "<option value=\"$n[0]\">".$n[1]."</option>";											$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);	            }	        } 			else {									$name = stripslashes(htmlspecialchars(strip_tags($o_vars->post['name']), ENT_QUOTES));				
				$parent_id  = intval($o_vars->post['parent_id']);				$news_sort  = intval($o_vars->post['news_sort']);				$news_msort = intval($o_vars->post['news_msort']);				$news_num	  = intval($o_vars->post['news_num']);	        					if ($id!="" && $name!="") {
				
					$sw = true;					
					$result = $o_categories->update($id, $name, $parent_id, $news_sort, $news_msort, $news_num);	            	
	            	if ($result) {
	            		
	            		include(CLASSES."/news.class.php");
	            		include(CLASSES."/vote.class.php");
	            		include(CLASSES."/banners.class.php");
	            		
	            		$o_news    = new news($o_mysql);
						$o_vote    = new vote($o_mysql);
						$o_banners = new banners($o_mysql);
							            		
	            		$result = $o_usersgroup->get();	            		if ($result)	            			foreach ($result as $n) {	            				$allow_cats = @implode(",", $o_categories->makeCats($n[2]));								$cat_add    = @implode(",", $o_categories->makeCats($n[3]));								$o_usersgroup->updateOne($n[0], "allow_cats", $allow_cats);								$o_usersgroup->updateOne($n[0], "cat_add", $cat_add);
							}									
						$result = $o_news->get();	            		if ($result)	            			foreach ($result as $n) {	            				$cats = @implode(",", $o_categories->makeCats($n[7]));								$o_news->updateOne($n[0], "cats", $cats);							}
													$result = $o_vote->get();	            		if ($result)	            			foreach ($result as $n) {	            				$cats = @implode(",", $o_categories->makeCats($n[6]));								$o_vote->updateOne($n[0], "cats", $cats);							}						$result = $o_banners->get();	            		if ($result)	            			foreach ($result as $n) {								$cats = @implode(",", $o_categories->makeCats($n[6]));								$o_banners->updateOne($n[0], "cats", $cats);							}
							
						$MESS = $o_other->showMessA($LANG[$m.'_edit']);
					}	            	else $MESS = $o_other->showMessA($LANG[$m.'_eedit'], 1);	        	}	        	else {
	        	
	        		$mrules["{TITLEE}"] = $LANG[$m.'_fedit']. $o_categories->getOne($id, "name");
	            	
	            	$mrules["{NAME}"] = $name;
	            	
	            	$mrules["{PARENT_ID0}"] = $parent_id;
	            	$mrules["{NEWS_SORT}"]  = $news_sort;
	            	$mrules["{NEWS_MSORT}"] = $news_msort;
	            	$mrules["{NEWS_NUM}"]   = $news_num;
	            	
	            	$mrules["{PARENT_ID}"] = "";
	        		$result = $o_categories->makeTree();	        		if ($result) 
	        			foreach ($result as $n) 
	        				if ($n[0]!=$id) 
	        					$mrules["{PARENT_ID}"] .= "<option value=\"$n[0]\">".$n[1]."</option>";
	        		
	            	$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);
	            	$MESS = $o_other->showMessA($LANG['wrong_input'], 1);
	        	}			}	    }
	    
	    if ((!isset($a) && !isset($id)) || ($a=="del" && isset($id)) || ($a=="add" && $sw) || ($a=="edit" && isset($id) && $sw)) {	 
	    	if ($a=="del") {
	    	
				$result = $o_categories->del($id); 
						    if ($result) {
			    	
			    	$result = $o_usersgroup->get();		    		if ($result)		    			foreach ($result as $n) {
		    				$allow_cats = @implode(",", $o_categories->makeCats($n[2]));
		    				$o_usersgroup->updateOne($n[0], "allow_cats", $allow_cats);						}
					$MESS = $o_other->showMessA($LANG[$m.'_del']);			    }
			    else $MESS = $o_other->showMessA($LANG[$m.'_edel'], 1); 	    	}
	    	
	    	$action = $o_vars->post['action'];	    		    	if (isset($action) && $a!="add" && $a!="edit") {	
	    					$make     = $o_vars->post['make'];				$selected = $o_vars->post['selected'];								$result = $o_categories->makeIn($make, $selected);
								if ($result) $MESS = $o_other->showMessA($LANG[$m.'_make']);	            else $MESS = $o_other->showMessA($LANG[$m.'_emake'], 1);			}						$result = $o_categories->getTree();	        $o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_allshowt.tpl");			if (!$result) $o_tpl->addhtml("<div class=\"nothing\">".$LANG[$m.'_egets']."</div>");	        else {	        	foreach ($result as $n) {		            $mrules["{ID}"]       = $n[0];		            $mrules["{NAME}"]     = $n[1];	                $mrules["{NEWS_NUM}"] = ($n[5]) ? $n[5] : $LANG['conf'];	                					$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_allshowm.tpl", $mrules);	            }	        }	        $o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_allshowb.tpl");		}		elseif ($a!="add" && ($a!="edit" || ($a=="edit" && !isset($id)))) $MESS1 = $o_other->showMessA($LANG['efunction'], 1);	}	else $MESS1 = $o_other->showMessA($LANG['eaccess'], 1);  ?>
