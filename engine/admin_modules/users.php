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
// Файл: users.php
//-----------------------------------------------------------------------------/
// Назначение: Модуль управления пользователями (админка)
//=============================================================================/
*/    if (!defined("OLE")) die("<script>window.location = \"./\"</script>");		if ($USER_RIGHTS['id_ug']==1) {		
		include(CLASSES."/news.class.php");
		include(CLASSES."/comments.class.php");
		
		$o_news     = new news($o_mysql);
		$o_comments = new comments($o_mysql);
				$a  = $o_vars->get['a'];		$id = $o_vars->get['id'];						if ($a=="add") {			
			$sw = false;
				    	$action = $o_vars->post['action'];	    		        if (!isset($action)) {
	        
	        	$mrules["{TITLEE}"] = $LANG[$m.'_fadd'];
	        	
	        	$mrules["{NAME}"]    		= "";
	        	$mrules["{EMAIL}"]    		= "";
	        	$mrules["{PASSWORD}"] 		= "";
	        	$mrules["{BANNED_YES}"] 	= "";				$mrules["{BANNED_NO}"]      = "checked=\"checked\"";
				$mrules["{ALLOW_MAIL_YES}"] = "checked=\"checked\"";				$mrules["{ALLOW_MAIL_NO}"]  = "";
				$mrules["{FULLNAME}"]       = "";
				$mrules["{LAND}"]           = "";
				$mrules["{ICQ}"]            = "";
				$mrules["{INFO}"]           = "";
	        	$mrules["{ALLOWED_IP}"]     = "";
	        	
	        	$mrules["{DEL_AVATAR_CHE}"] = "";
	        	$mrules["{DEL_AVATAR_DIS}"] = "disabled=\"disabled\"";
				
				$mrules["{AVATAR}"] = AVATARS_DIR."/0.png";
				
				$mrules["{IS_ADM}"] = "";
					        					$mrules["{USERSGROUP}"] = ""; 	        	$result = $o_usersgroup->get();	        	foreach ($result as $n) $mrules["{USERSGROUP}"] .= "<option value='$n[0]'> $n[1]</option>";				
				$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);
		    }	        else {							$login      = $o_vars->post['login'];				$email      = $o_vars->post['email'];				$password   = $o_vars->post['password'];				$usersgroup = intval($o_vars->post['usersgroup']);				$allow_mail = intval($o_vars->post['allow_mail']);
				$banned 	= intval($o_vars->post['banned']);				$fullname 	= stripslashes(htmlspecialchars(strip_tags($o_vars->post['fullname']), ENT_QUOTES));				$land	    = stripslashes(htmlspecialchars(strip_tags($o_vars->post['land']), ENT_QUOTES));				$icq		= stripslashes(htmlspecialchars(strip_tags($o_vars->post['icq']), ENT_QUOTES));				$info 	    = stripslashes(htmlspecialchars(strip_tags($o_vars->post['info']), ENT_QUOTES));
				$allowed_ip = $o_other->filterIp($o_vars->post['allowed_ip']);
				
				$avatar      = $_FILES['avatar']['tmp_name'];	        	$avatar_name = $_FILES['avatar']['name'];	    		$avatar_size = $_FILES['avatar']['size'];							if ($o_users->check($login) && $o_users->check($password, RE_PASSWORD) && $o_other->check($email, RE_MAIL) && !$o_users->valueExists("name", $login) && !$o_users->valueExists("email", $email)) {
				
					$sw = true;
										$result = $o_users->add($login, $email, md5(md5($password)), time(), $usersgroup, time(), $banned, $allow_mail, $avatar, $fullname, $land, $icq, $info, $allowed_ip, "", "", $avatar_name, $avatar_size);	            	
	            	if ($result) $MESS = $o_other->showMessA($LANG[$m.'_add']);
	            	else $MESS = $o_other->showMessA($LANG[$m.'_eadd'], 1); 				}	            else {
	            
	            	$mrules["{TITLEE}"] = $LANG[$m.'_fadd'];
	            
	            	$mrules["{NAME}"]    		= $login;
			    	$mrules["{EMAIL}"]    		= $email;
			    	$mrules["{PASSWORD}"] 		= $password;
			    	$mrules["{BANNED_YES}"]     = ($banned)  	 ? "checked=\"checked\"" : "";					$mrules["{BANNED_NO}"]      = (!$banned) 	 ? "checked=\"checked\"" : "";
					$mrules["{ALLOW_MAIL_YES}"] = ($allow_mail)  ? "checked=\"checked\"" : "";					$mrules["{ALLOW_MAIL_NO}"]  = (!$allow_mail) ? "checked=\"checked\"" : "";
					$mrules["{FULLNAME}"]       = $fullname;
					$mrules["{LAND}"]           = $land;
					$mrules["{ICQ}"]            = $icq;
					$mrules["{INFO}"]           = $info;
			    	$mrules["{ALLOWED_IP}"]     = $allowed_ip;
			    	
			    	$mrules["{DEL_AVATAR_CHE}"] = "";
			    	$mrules["{DEL_AVATAR_DIS}"] = "disabled=\"disabled\"";
				
					$mrules["{AVATAR}"] = AVATARS_DIR."/0.png";
					
					$mrules["{USERSGROUP}"] = "";
					
					$mrules["{IS_ADM}"] = ""; 	        		
	        		$result = $o_usersgroup->get();	        		foreach ($result as $n1) 						$mrules["{USERSGROUP}"] .= ($n1[0]==$usersgroup) ? "<option value='$n1[0]' selected=\"selected\"> $n1[1]</option>" : "<option value='$n1[0]'> $n1[1]</option>";			
					
	            	$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);
	            	$MESS = $o_other->showMessA($LANG['wrong_input']. $LANG[$m.'_eform'], 1);
	            }	    	}	    }		elseif ($a=="edit" && isset($id)) {		    
		    $sw = false;
		    			$action = $o_vars->post['action'];				        if (!isset($action)) {	            $result = $o_users->get($id);	            if (!$result) {$sw = true; $MESS = $o_other->showMessA($LANG[$m.'_eget'], 1);}				else {		        	foreach ($result as $n);
		        	
		        	$mrules["{TITLEE}"] = $LANG[$m.'_fedit']. $n[1];		        	        			            $mrules["{NAME}"]       = $n[1];		            $mrules["{EMAIL}"]      = $n[2];	                $mrules["{FULLNAME}"]   = $n[10];					$mrules["{LAND}"]       = $n[11];					$mrules["{ICQ}"]        = $n[12];					$mrules["{INFO}"]       = $n[13];					$mrules["{ALLOWED_IP}"] = $n[14];					$mrules["{PASSWORD}"]   = "";
					
					$mrules["{DEL_AVATAR_CHE}"] = "";
			    	$mrules["{DEL_AVATAR_DIS}"] = (!$n[9]) ? "disabled=\"disabled\"" : "";
										$mrules["{AVATAR}"] = ($n[9])  ? AVATARS_DIR ."/" .$n[9] : AVATARS_DIR ."/0.png";										$mrules["{BANNED_YES}"]     = ($n[7])   ? "checked=\"checked\"" : "";					$mrules["{BANNED_NO}"]      = (!$n[7])  ? "checked=\"checked\"" : "";	                $mrules["{ALLOW_MAIL_YES}"] = ($n[8])  ? "checked=\"checked\"" : "";					$mrules["{ALLOW_MAIL_NO}"]  = (!$n[8]) ? "checked=\"checked\"" : "";										$mrules["{IS_ADM}"] = ($id==1) ? "disabled=\"disabled\"" : "";															$mrules["{USERSGROUP}"] = ""; 	        		
	        		$result = $o_usersgroup->get();	        		foreach ($result as $n1) 						$mrules["{USERSGROUP}"] .= ($n1[0]==$n[5]) ? "<option value='$n1[0]' selected=\"selected\"> $n1[1]</option>" : "<option value='$n1[0]'> $n1[1]</option>";																$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);	            }	        } 			else {								$login      = $o_vars->post['login'];				$email      = $o_vars->post['email'];				$password   = $o_vars->post['password'];				$usersgroup = ($id==1) ? "1" : intval($o_vars->post['usersgroup']);				$banned     = intval($o_vars->post['banned']);				$allow_mail = intval($o_vars->post['allow_mail']);				$fullname 	= stripslashes(htmlspecialchars(strip_tags($o_vars->post['fullname']), ENT_QUOTES));				$land	    = stripslashes(htmlspecialchars(strip_tags($o_vars->post['land']), ENT_QUOTES));				$icq		= stripslashes(htmlspecialchars(strip_tags($o_vars->post['icq']), ENT_QUOTES));				$info 	    = stripslashes(htmlspecialchars(strip_tags($o_vars->post['info']), ENT_QUOTES));				        	$allowed_ip = $o_other->filterIp($o_vars->post['allowed_ip']);				$del_avatar = $o_vars->post['del_avatar'];								$avatar      = $_FILES['avatar']['tmp_name'];	        	$avatar_name = $_FILES['avatar']['name'];	    		$avatar_size = $_FILES['avatar']['size'];												if ($o_users->check($login) && ($o_users->check($password , RE_PASSWORD) || $password=="") && $o_other->check($email, RE_MAIL) && $id!="" && !$o_users->valueExists("name", $login, $id) && !$o_users->valueExists("email", $email, $id)) {
				
					$sw = true;
									$result = $o_users->update($id, $login, $email, $password, $usersgroup, $banned, $allow_mail, $avatar, $avatar_name, $avatar_size, $del_avatar, $fullname, $land, $icq, $info, $allowed_ip);
					
					if ($result && $id==$ID) {
				
						setcookie("name", "", time()-(365*86400));
						setcookie("password", "", time()-(365*86400));
						@session_destroy();
						@session_unset();
				
						$name     = $login;
					 	$password = ($password) ? md5(md5($password)) : $o_users->getOne($ID, "password");
					 	@session_register("name");	
					 	@session_register("password");	
						if (!$CONFIG['allow_renter']) {
					 	    setcookie("name", $name, time()+(365*86400));
						    setcookie("password", $password, time()+(365*86400));
					 	}
					}	
						            	if ($result) $MESS = $o_other->showMessA($LANG[$m.'_edit']);
	            	else $MESS = $o_other->showMessA($LANG[$m.'_eedit'], 1); 
	            }	        	else {
	        		
	        		$mrules["{TITLEE}"] = $LANG[$m.'_fedit']. $o_users->getOne($id, "name");
	        		
	        		$mrules["{NAME}"]    		= $login;
			    	$mrules["{EMAIL}"]    		= $email;
			    	$mrules["{PASSWORD}"] 		= ($password) ? $password : "";
			    	$mrules["{BANNED_YES}"]     = ($banned)  	 ? "checked=\"checked\"" : "";					$mrules["{BANNED_NO}"]      = (!$banned) 	 ? "checked=\"checked\"" : "";
					$mrules["{ALLOW_MAIL_YES}"] = ($allow_mail)  ? "checked=\"checked\"" : "";					$mrules["{ALLOW_MAIL_NO}"]  = (!$allow_mail) ? "checked=\"checked\"" : "";
					$mrules["{FULLNAME}"]       = $fullname;
					$mrules["{LAND}"]           = $land;
					$mrules["{ICQ}"]            = $icq;
					$mrules["{INFO}"]           = $info;
			    	$mrules["{ALLOWED_IP}"]     = $allowed_ip;
			    	
			    	$mrules["{DEL_AVATAR_CHE}"] = ($del_avatar) ? "checked=\"checked\"" : "";
			    	$mrules["{DEL_AVATAR_DIS}"] = (!$o_users->getOne($id, "avatar")) ? "disabled=\"disabled\"" : "";
			    	
			    	$mrules["{IS_ADM}"] = ($id==1) ? "disabled=\"disabled\"" : "";
				
					$mrules["{AVATAR}"] = (!$o_users->getOne($id, "avatar")) ? AVATARS_DIR."/0.png" : AVATARS_DIR."/".$o_users->getOne($id, "avatar");
					
					$mrules["{USERSGROUP}"] = ""; 	        		
	        		$result = $o_usersgroup->get();	        		foreach ($result as $n1) 						$mrules["{USERSGROUP}"] .= ($n1[0]==$usersgroup) ? "<option value='$n1[0]' selected=\"selected\"> $n1[1]</option>" : "<option value='$n1[0]'> $n1[1]</option>";			
					
	            	$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);
	            	$MESS = $o_other->showMessA($LANG['wrong_input']. $LANG[$m.'_eform'], 1);
	        	}			}	    }
	    
	    if ((!isset($a) && !isset($id)) || ($a=="del" && isset($id))  || ($a=="add" && $sw) || ($a=="edit" && isset($id) && $sw)) {
	    	
	    	if ($a=="del") {
				if ($id==1) $MESS = $o_other->showMessA($LANG[$m.'_edel'], 1);				else {
								$result = $o_users->del($id); 			    	
			    	if ($result) $MESS = $o_other->showMessA($LANG[$m.'_del']);			        else $MESS = $o_other->showMessA($LANG[$m.'_edel'], 1);				}
			}	
	    	
	    	$action = $o_vars->post['action'];	    		    	if (isset($action) && $a!="add" && $a!="edit") {					$make     = $o_vars->post['make'];				$selected = $o_vars->post['selected'];								$result = $o_users->makeIn($make, $selected);				
				if ($result) $MESS = $o_other->showMessA($LANG[$m.'_make']);	            else $MESS = $o_other->showMessA($LANG[$m.'_emake'], 1);
			}			$result = $o_users->get();	        $o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_allshowt.tpl");			if (!$result) $o_tpl->addhtml("<div class=\"nothing\">".$LANG[$m.'_egets']."</div>");	        else {	        	foreach ($result as $n) {		            					$mrules["{ID}"]         = $n[0];		            $mrules["{NAME}"]       = $n[1];					$mrules["{REG_DATE}"]   = $o_other->makeNormalDate($n[6]);	                $mrules["{LAST_DATE}"]  = $o_other->makeNormalDate($n[4]);	                $mrules["{NEWS_NUM}"]   = $o_news->getKolUserNews($n[0]);	                $mrules["{COMM_NUM}"]   = $o_comments->getKolUserComm($n[0]);	                $mrules["{USERSGROUP}"] = $o_usersgroup->getOne($n[5], "group_name");	                					$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_allshowm.tpl", $mrules);	            }	        }	        $o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_allshowb.tpl");		}		elseif ($a!="add" && ($a!="edit" || ($a=="edit" && !isset($id)))) $MESS1 = $o_other->showMessA($LANG['efunction'], 1);	}	else $MESS1 = $o_other->showMessA($LANG['eaccess'], 1);        ?>
