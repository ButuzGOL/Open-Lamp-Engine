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
// Файл: categories.php
//-----------------------------------------------------------------------------/
// Назначение: Модуль управления категориями новостей (админка)
//=============================================================================/
*/
		include(CLASSES."/categories.class.php");
		
		$o_categories = new categories($o_mysql);
				
			$sw = false;
			
	        	
	        	$mrules["{TITLEE}"] = $LANG[$m.'_fadd'];
	        	
	        	$mrules["{NAME}"]       = "";
	        	$mrules["{NEWS_SORT}"]  = "";
	        	$mrules["{NEWS_MSORT}"] = "";
	     	    $mrules["{PARENT_ID0}"] = "";
	     	        	
	        	$result = $o_categories->makeTree();
				$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);
		    }
				
					$sw = true;
					
					$result = $o_categories->add($name, $parent_id, $news_sort, $news_msort, $news_num);
					
	            	else $MESS = $o_other->showMessA($LANG[$m.'_eadd'], 1);  
	            	
	            	$mrules["{TITLEE}"] = $LANG[$m.'_fadd'];
	            	
	            	$mrules["{NAME}"] = $name;
	            	
	            	$mrules["{PARENT_ID0}"] = $parent_id;
	            	$mrules["{NEWS_SORT}"]  = $news_sort;
	            	$mrules["{NEWS_MSORT}"] = $news_msort;
	            	$mrules["{NEWS_NUM}"]   = $news_num;
	            	
	            	$mrules["{PARENT_ID}"] = "";
	        		$result = $o_categories->makeTree();
	        		
	            	$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);
	            	$MESS = $o_other->showMessA($LANG['wrong_input'], 1);
	            }
		    $sw = false;
		    
		        	$mrules["{TITLEE}"] = $LANG[$m.'_fedit']. $n[1];
	    		    
					$result = $o_categories->makeTree($id);
						foreach ($result as $n) 
							if ($n[0]!=$id) $mrules["{PARENT_ID}"] .= "<option value=\"$n[0]\">".$n[1]."</option>";
				$parent_id  = intval($o_vars->post['parent_id']);
				
					$sw = true;
					$result = $o_categories->update($id, $name, $parent_id, $news_sort, $news_msort, $news_num);
	            	if ($result) {
	            		
	            		include(CLASSES."/news.class.php");
	            		include(CLASSES."/vote.class.php");
	            		include(CLASSES."/banners.class.php");
	            		
	            		$o_news    = new news($o_mysql);
						$o_vote    = new vote($o_mysql);
						$o_banners = new banners($o_mysql);
							            		
	            		$result = $o_usersgroup->get();
							}									
						$result = $o_news->get();
							
							
						$MESS = $o_other->showMessA($LANG[$m.'_edit']);
					}
	        	
	        		$mrules["{TITLEE}"] = $LANG[$m.'_fedit']. $o_categories->getOne($id, "name");
	            	
	            	$mrules["{NAME}"] = $name;
	            	
	            	$mrules["{PARENT_ID0}"] = $parent_id;
	            	$mrules["{NEWS_SORT}"]  = $news_sort;
	            	$mrules["{NEWS_MSORT}"] = $news_msort;
	            	$mrules["{NEWS_NUM}"]   = $news_num;
	            	
	            	$mrules["{PARENT_ID}"] = "";
	        		$result = $o_categories->makeTree();
	        			foreach ($result as $n) 
	        				if ($n[0]!=$id) 
	        					$mrules["{PARENT_ID}"] .= "<option value=\"$n[0]\">".$n[1]."</option>";
	        		
	            	$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);
	            	$MESS = $o_other->showMessA($LANG['wrong_input'], 1);
	        	}
	    
	    if ((!isset($a) && !isset($id)) || ($a=="del" && isset($id)) || ($a=="add" && $sw) || ($a=="edit" && isset($id) && $sw)) {
	    	if ($a=="del") {
	    	
				$result = $o_categories->del($id); 
			
			    	
			    	$result = $o_usersgroup->get();
		    				$allow_cats = @implode(",", $o_categories->makeCats($n[2]));
		    				$o_usersgroup->updateOne($n[0], "allow_cats", $allow_cats);
					$MESS = $o_other->showMessA($LANG[$m.'_del']);
			    else $MESS = $o_other->showMessA($LANG[$m.'_edel'], 1); 
	    	
	    	$action = $o_vars->post['action'];
	    	
				