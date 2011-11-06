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
// Файл: blocks.php
//-----------------------------------------------------------------------------/
// Назначение: Модуль управления блоками сайта (админка)
//=============================================================================/
*/
	
		include(CLASSES."/blocks.class.php");
	
		$o_blocks = new blocks($o_mysql);
			$sw = false;
			
	        	
	        	$mrules["{TITLEE}"] = $LANG[$m.'_fadd'];
	        	
	        	$mrules["{DESCR}"] = "";
	        	$mrules["{TITLE}"] = "";
	        	$mrules["{PLACE}"] = 1;
	        	$mrules["{TEXT}"]  = "";
	        	$mrules["{TPL}"]   = "";
	        	$mrules["{MODUL}"] = "";
	        	
	        	
	        	$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);
	        else {
					$sw = true;
					
					$result = $o_blocks->add($descr, $title, $onoff, $place, $tpl, $modul, $text);
	            	if ($result) $MESS = $o_other->showMessA($LANG[$m.'_add']);
	            	else $MESS = $o_other->showMessA($LANG[$m.'_eadd'], 1); 
	            	
	            	$mrules["{TITLEE}"] = $LANG[$m.'_fadd'];
	        	
			    	$mrules["{DESCR}"] = $descr;
			    	$mrules["{TITLE}"] = $title;
			    	$mrules["{PLACE}"] = $place;
			    	$mrules["{TEXT}"]  = $text;
			    	$mrules["{TPL}"]   = $tpl;
			    	$mrules["{MODUL}"] = $modul;
			    	
	            	
	            	$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);
	            	$MESS = $o_other->showMessA($LANG['wrong_input'], 1);
	            }
	    elseif ($a=="edit" && isset($id)) {
		    $sw = false;
		    
		        	$mrules["{TITLEE}"] = $LANG[$m.'_fedit']. $n[1];
		        	
					$sw = true;
					
					$result = $o_blocks->update($id, $descr, $title, $onoff, $place, $tpl, $modul, $text);
	            	if ($result) $MESS = $o_other->showMessA($LANG[$m.'_edit']);
	            	else $MESS = $o_other->showMessA($LANG[$m.'_eedit'], 1);	
	        	
	        		$mrules["{TITLEE}"] = $LANG[$m.'_fedit']. $o_blocks->getOne($id, "descr");
	        		
	        		$mrules["{DESCR}"] = $descr;
			    	$mrules["{TITLE}"] = $title;
			    	$mrules["{PLACE}"] = $place;
			    	$mrules["{TEXT}"]  = $text;
			    	$mrules["{TPL}"]   = $tpl;
			    	$mrules["{MODUL}"] = $modul;
			    	
				
					$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);
					$MESS = $o_other->showMessA($LANG['wrong_input'], 1);
				}
	    
	    	if ($a=="del") {
			    
			    if ($result) $MESS = $o_other->showMessA($LANG[$m.'_del']);
	    	
				if ($result) $MESS = $o_other->showMessA($LANG[$m.'_make']);
					elseif ($n[4]==2) $mrules["{PLACE}"] = "<a href=\"?m=$m&amp;a=1&amp;id=$n[0]\"><img src=\"".ADMIN_TEMPLATES_DIR."/images/blocks_left.png\" alt=\"".$LANG['left']."\" title=\"".$LANG['left']."\" /></a> <img src=\"".ADMIN_TEMPLATES_DIR."/images/blocks_right_dis.png\" alt=\"".$LANG['right']."\" title=\"".$LANG['right']."\" /> <a href=\"?m=$m&amp;a=3&amp;id=$n[0]\"><img src=\"".ADMIN_TEMPLATES_DIR."/images/blocks_top.png\" alt=\"".$LANG['top']."\" title=\"".$LANG['top']."\" /></a> <a href=\"?m=$m&amp;a=4&amp;id=$n[0]\"><img src=\"".ADMIN_TEMPLATES_DIR."/images/blocks_bottom.png\" alt=\"".$LANG['bottom']."\" title=\"".$LANG['bottom']."\" /></a>";
					elseif ($n[4]==3) $mrules["{PLACE}"] = "<a href=\"?m=$m&amp;a=1&amp;id=$n[0]\"><img src=\"".ADMIN_TEMPLATES_DIR."/images/blocks_left.png\" alt=\"".$LANG['left']."\" title=\"".$LANG['left']."\" /></a> <a href=\"?m=$m&amp;a=2&amp;id=$n[0]\"><img src=\"".ADMIN_TEMPLATES_DIR."/images/blocks_right.png\" alt=\"".$LANG['right']."\" title=\"".$LANG['right']."\" /></a> <img src=\"".ADMIN_TEMPLATES_DIR."/images/blocks_top_dis.png\" alt=\"".$LANG['top']."\" title=\"".$LANG['top']."\" /> <a href=\"?m=$m&amp;a=4&amp;id=$n[0]\"><img src=\"".ADMIN_TEMPLATES_DIR."/images/blocks_bottom.png\" alt=\"".$LANG['bottom']."\" title=\"".$LANG['bottom']."\" /></a>";
					elseif ($n[4]==4) $mrules["{PLACE}"] = "<a href=\"?m=$m&amp;a=1&amp;id=$n[0]\"><img src=\"".ADMIN_TEMPLATES_DIR."/images/blocks_left.png\" alt=\"".$LANG['left']."\" title=\"".$LANG['left']."\" /></a> <a href=\"?m=$m&amp;a=2&amp;id=$n[0]\"><img src=\"".ADMIN_TEMPLATES_DIR."/images/blocks_right.png\" alt=\"".$LANG['right']."\" title=\"".$LANG['right']."\" /></a> <a href=\"?m=$m&amp;a=3&amp;id=$n[0]\"><img src=\"".ADMIN_TEMPLATES_DIR."/images/blocks_top.png\" alt=\"".$LANG['top']."\" title=\"".$LANG['top']."\" /></a> <img src=\"".ADMIN_TEMPLATES_DIR."/images/blocks_bottom_dis.png\" alt=\"".$LANG['bottom']."\" title=\"".$LANG['bottom']."\" />";
					else $mrules["{PLACE}"] = "&nbsp;";