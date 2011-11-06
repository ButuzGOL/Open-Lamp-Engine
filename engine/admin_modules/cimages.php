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
// Файл: cimages.php
//-----------------------------------------------------------------------------/
// Назначение: Модуль управления картинками мини (админка)
//=============================================================================/
*/    if (!defined("OLE")) die("<script>window.location = \"./\"</script>");		$o_tpl->header = $o_tpl->gethtml(ADMIN_TEMPLATES_DIR."/cheader.tpl");	$o_tpl->footer = $o_tpl->gethtml(ADMIN_TEMPLATES_DIR."/cfooter.tpl");	
	if ($USER_RIGHTS['allow_edit'] || $USER_RIGHTS['allow_all_edit'] || $USER_RIGHTS['allow_add'] || $USER_RIGHTS['allow_editst'] || $USER_RIGHTS['allow_all_editst'] || $USER_RIGHTS['allow_addst']) {
		
		include(CLASSES."/images.class.php");	
		
		$o_images = new images();
			$a = $o_vars->get['a'];				if ($a=="add" && $CONFIG['allow_dimg'] && ($USER_RIGHTS['allow_edit'] || $USER_RIGHTS['allow_all_edit'])) {			
			$sw = false;
						$action = $o_vars->post['action'];					    if (!isset($action)) {
		    	
		    	$mrules["{TITLEE}"] = $LANG[$m.'_fadd'];
		    	
		    	$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_add.tpl", $mrules);		    }
		    else {										$images = array();				$names  = array();				for ($i = 0; $i < $o_vars->post['kol_image']; $i++) {									if ($_FILES['image'.$i.'']['tmp_name']!="" && isset($_FILES['image'.$i.'']['tmp_name']) && filesize($_FILES['image'.$i.'']['tmp_name'])<=($CONFIG['simg']*1024)) {											$image['file'] = $_FILES['image'.$i.'']['tmp_name'];									$image['name'] = ($o_vars->post['name_image'.$i.'']) ? $o_vars->post['name_image'.$i.''] : substr($_FILES['image'.$i.'']['name'], 0, strlen($_FILES['image'.$i.'']['name'])-4);											if ($o_other->check($image['name'], RE_IMAGE)) {																$format = substr($_FILES['image'.$i.'']['name'], -4);							$image['name'] .= $format;							$image['type'] = "img";							if (!in_array($image['name'], $names)) array_push($images, $image);							array_push($names, $image['name']);						}					}				}							for ($i = 0; $i < $o_vars->post['kol_urlimage']; $i++) {						if ($o_vars->post['urlimage'.$i.'']!="" && isset($o_vars->post['urlimage'.$i.''])) { 										$image['file'] = $o_vars->post['urlimage'.$i.''];		        		$image['name'] = ($o_vars->post['name_urlimage'.$i.'']) ? $o_vars->post['name_urlimage'.$i.''] : substr($image['file'], strrpos($image['file'],"/")+1,strlen($image['file'])-4-strrpos($image['file'],"/")-1);										if ($o_other->check($image['name'], RE_IMAGE)) {							$format = substr($image['file'], -4);							$image['name'] .= $format;							$image['type'] = "url";							if (!in_array($image['name'], $names)) array_push($images, $image);							array_push($names, $image['name']);						}					}				}											if (count($images)) {
					
					$sw = true;
										$result = $o_images->add($images);		        	
		        	if ($result) $MESS = $o_other->showMessA($LANG[$m.'_add']);
	            	else $MESS = $o_other->showMessA($LANG[$m.'_eadd'], 1); 		        }		        else {
	            
	            	$mrules["{TITLEE}"] = $LANG[$m.'_fadd'];
	        	
	        		$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_add.tpl" , $mrules);
	        		$MESS = $o_other->showMessA($LANG['wrong_input'], 1);
	            }			}		}
		elseif ($a=="add" && (!$CONFIG['allow_dimg'] || (!$USER_RIGHTS['allow_edit'] && !$USER_RIGHTS['allow_all_edit']))) $MESS1 = $o_other->showMessA($LANG['eaccess']. " <a href=\"?m=cimages\">".$LANG[$m]."</a>", 1);		
		if (!isset($a) || ($a=="add" && $sw)) {									    					$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_allshowt.tpl");			$result = $o_images->get();		    if (!$result) $o_tpl->addhtml("<div class=\"nothing\">".$LANG[$m.'_egets']."</div>");		    else {		    	$i = 0; 		    	$k = count($result);		    	$o_tpl->addhtml("<div class=\"conim\">");		    	foreach ($result as $n) {		    				    		$img_size = @getimagesize($n['file']);									$mrules["{SIZE}"]   = filesize($n['file']);		    		$mrules["{IMG}"]    = $n['img'];					$mrules["{WIDTH}"]  = $img_size[0];					$mrules["{HEIGHT}"] = $img_size[1];
									if ($img_size[1] > 110) $mrules["{I_HEIGHT}"] = 100; else $mrules["{I_HEIGHT}"] = $img_size[1]; 					if ($img_size[0] > 110) $mrules["{I_WIDTH}"]  = 100; else $mrules["{I_WIDTH}"]  = $img_size[0]; 				
					$mrules["{FULL_NAME}"] = $n['name'];										if (strlen($n['name']) > 15) {						$a = explode(".",$n['name']);						$mrules["{NAME}"] = substr($a[0], 0, 8)."... .". $a[1];					}					else $mrules["{NAME}"] = $n['name'];		            					$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_allshowm.tpl",$mrules);		        			        	$i++;					if (!($i%4) && $i!=$k) $o_tpl->addhtml("</div><div class=\"conim\">");							elseif ($i!=$k) $o_tpl->addhtml("");					else $o_tpl->addhtml("</div>");				}		    }			$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_allshowb.tpl");  				}		elseif ($a=="add" && $sw!=false) $MESS1 = $o_other->showMessA($LANG['eaccess'], 1);		elseif ($a!="add") $MESS1 = $o_other->showMessA($LANG['efunction'], 1);
    }
    else $MESS1 = $o_other->showMessA($LANG['eaccess'], 1);	    ?>
