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
// Файл: users.php
//-----------------------------------------------------------------------------/
// Назначение: Модуль управления пользователями (админка)
//=============================================================================/
*/
		include(CLASSES."/news.class.php");
		include(CLASSES."/comments.class.php");
		
		$o_news     = new news($o_mysql);
		$o_comments = new comments($o_mysql);
		
			$sw = false;
			
	        
	        	$mrules["{TITLEE}"] = $LANG[$m.'_fadd'];
	        	
	        	$mrules["{NAME}"]    		= "";
	        	$mrules["{EMAIL}"]    		= "";
	        	$mrules["{PASSWORD}"] 		= "";
	        	$mrules["{BANNED_YES}"] 	= "";
				$mrules["{ALLOW_MAIL_YES}"] = "checked=\"checked\"";
				$mrules["{FULLNAME}"]       = "";
				$mrules["{LAND}"]           = "";
				$mrules["{ICQ}"]            = "";
				$mrules["{INFO}"]           = "";
	        	$mrules["{ALLOWED_IP}"]     = "";
	        	
	        	$mrules["{DEL_AVATAR_CHE}"] = "";
	        	$mrules["{DEL_AVATAR_DIS}"] = "disabled=\"disabled\"";
				
				$mrules["{AVATAR}"] = AVATARS_DIR."/0.png";
				
				$mrules["{IS_ADM}"] = "";
					        	
				$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);
		    }
				$banned 	= intval($o_vars->post['banned']);
				$allowed_ip = $o_other->filterIp($o_vars->post['allowed_ip']);
				
				$avatar      = $_FILES['avatar']['tmp_name'];
				
					$sw = true;
					
	            	if ($result) $MESS = $o_other->showMessA($LANG[$m.'_add']);
	            	else $MESS = $o_other->showMessA($LANG[$m.'_eadd'], 1); 
	            
	            	$mrules["{TITLEE}"] = $LANG[$m.'_fadd'];
	            
	            	$mrules["{NAME}"]    		= $login;
			    	$mrules["{EMAIL}"]    		= $email;
			    	$mrules["{PASSWORD}"] 		= $password;
			    	$mrules["{BANNED_YES}"]     = ($banned)  	 ? "checked=\"checked\"" : "";
					$mrules["{ALLOW_MAIL_YES}"] = ($allow_mail)  ? "checked=\"checked\"" : "";
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
	        		$result = $o_usersgroup->get();
					
	            	$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);
	            	$MESS = $o_other->showMessA($LANG['wrong_input']. $LANG[$m.'_eform'], 1);
	            }
		    $sw = false;
		    
		        	
		        	$mrules["{TITLEE}"] = $LANG[$m.'_fedit']. $n[1];
					
					$mrules["{DEL_AVATAR_CHE}"] = "";
			    	$mrules["{DEL_AVATAR_DIS}"] = (!$n[9]) ? "disabled=\"disabled\"" : "";
					
	        		$result = $o_usersgroup->get();
				
					$sw = true;
				
					
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
					
	            	else $MESS = $o_other->showMessA($LANG[$m.'_eedit'], 1); 
	            }
	        		
	        		$mrules["{TITLEE}"] = $LANG[$m.'_fedit']. $o_users->getOne($id, "name");
	        		
	        		$mrules["{NAME}"]    		= $login;
			    	$mrules["{EMAIL}"]    		= $email;
			    	$mrules["{PASSWORD}"] 		= ($password) ? $password : "";
			    	$mrules["{BANNED_YES}"]     = ($banned)  	 ? "checked=\"checked\"" : "";
					$mrules["{ALLOW_MAIL_YES}"] = ($allow_mail)  ? "checked=\"checked\"" : "";
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
	        		$result = $o_usersgroup->get();
					
	            	$o_tpl->addhtml(ADMIN_TEMPLATES_DIR."/".$m."_form.tpl", $mrules);
	            	$MESS = $o_other->showMessA($LANG['wrong_input']. $LANG[$m.'_eform'], 1);
	        	}
	    
	    if ((!isset($a) && !isset($id)) || ($a=="del" && isset($id))  || ($a=="add" && $sw) || ($a=="edit" && isset($id) && $sw)) {
	    	
	    	if ($a=="del") {
				if ($id==1) $MESS = $o_other->showMessA($LANG[$m.'_edel'], 1);
			
			    	if ($result) $MESS = $o_other->showMessA($LANG[$m.'_del']);
			}	
	    	
	    	$action = $o_vars->post['action'];
				if ($result) $MESS = $o_other->showMessA($LANG[$m.'_make']);
			}