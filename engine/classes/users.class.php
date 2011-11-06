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
// Файл: users.class.php
//-----------------------------------------------------------------------------/
// Назначение: Класс управления пользователями
//=============================================================================/
*/
    
    class users {
    	var $mysql, $tn = USERS, $tn1 = USERSGROUP, $tn2 = BOOKMARKS;

        function users($mysql_obj) {
            $this->mysql = $mysql_obj;
        }
   
        function add($name, $email, $password, $lastdate, $usersgroup, $reg_date, $banned, $allow_mail, $avatar, $fullname, $land, $icq, $info, $allowed_ip, $hash, $last_ip, $avatar_name = "", $avatar_size = "") {
        	        	
        	$sql = "insert into $this->tn values(null, '$name', '$email', '$password', '$lastdate', '$usersgroup', '$reg_date', '$banned', '$allow_mail', '', '$fullname', '$land', '$icq', '$info', '$allowed_ip', '$hash', '', '$last_ip')";
			if (!$this->mysql->query($sql)) return FALSE;
			
			if ($avatar) {
        		$sql = "select id from $this->tn order by id desc limit 1";
            	$id  = $this->mysql->result($sql);
      
        		$avatar_name_a      = explode(".", $avatar_name);
				$avatar_type        = end($avatar_name_a);
				$allowed_extensions = array("jpg", "png", "jpe", "jpeg", "gif");
				if ($avatar_size < 100000 && in_array(strtolower($avatar_type), $allowed_extensions) && $avatar_name) {
					$avatar_way = AVATARS_DIR."/$id.png";
					if (@copy($avatar, $avatar_way)) {
						$size = GetImageSize($avatar_way);
						if ($size[0] <= 100 && $size[1] <= 100) {
							$sql = "update $this->tn set avatar='".$id.".png' where id='$id'";
            				if (!$this->mysql->query($sql)) return FALSE; 
						}
						else @unlink(SITE_DIR .AVATARS_DIR."/".$id.".png");
					}
				}  
        	}
			
			return TRUE;           
        }
                
        function get($id = 0) {
        	
        	if (!$this->check($id, "/^[0-9]+$/")) return FALSE;
			
			$sql = (!$id) ? "select * from $this->tn order by id asc" : "select * from $this->tn where id='$id'";
            return $this->mysql->fetch_row($sql);
        }

		function del($id) {
            
            if (!$this->check($id, "/^[0-9]+$/")) return FALSE;
			if (!$this->get($id)) return FALSE; 
			
			$sql = "delete from $this->tn where id='$id'";
            if (!$this->mysql->query($sql)) return FALSE;
            @unlink(SITE_DIR .AVATARS_DIR."/".$id.".png");
            
            return TRUE; 			                             
	    }
                
        function update($id, $name, $email, $password, $usersgroup, $banned, $allow_mail, $avatar, $avatar_name, $avatar_size, $del_avatar, $fullname, $land, $icq, $info, $allowed_ip) {
        	
			if (!$del_avatar && $avatar) {
            	$avatar_name_a      = explode(".", $avatar_name);
				$avatar_type        = end($avatar_name_a);
				$allowed_extensions = array("jpg", "png", "jpe", "jpeg", "gif");
				if ($avatar_size < 100000 && in_array(strtolower($avatar_type),$allowed_extensions) && $avatar_name) {
					$avatar_way = AVATARS_DIR."/$id.png";
					if (@copy($avatar, $avatar_way)) {
						$size = GetImageSize($avatar_way);
						if ($size[0] <= 100 && $size[1] <= 100) {
							$sql = "update $this->tn set avatar='".$id.".png' where id='$id'";
            				if (!$this->mysql->query($sql)) return FALSE; 
						}
						else @unlink(AVATARS_DIR."/".$id.".png");
					}
				}  
			}
			elseif ($del_avatar) {
				@unlink(AVATARS_DIR."/".$id.".png");
				$sql = "update $this->tn set avatar='' where id='$id'";
				if (!$this->mysql->query($sql)) return FALSE;
			}
				
			if ($password!="") {
				$password = md5(md5($password));
				$sql = "update $this->tn set password='$password' where id='$id'";
            	if (!$this->mysql->query($sql)) return FALSE;
			}
			$sql = "update $this->tn set name='$name', email='$email', usersgroup='$usersgroup', banned='$banned', allow_mail='$allow_mail', fullname='$fullname', land='$land', icq='$icq',	info='$info', allowed_ip='$allowed_ip' where id='$id'";
            if (!$this->mysql->query($sql)) return FALSE;
			
			return TRUE;
        }
    	
    	function chNPInLogCoockSess($name, $password) {
        
	    	if (!$this->check($name) && $this->check($password)) return FALSE;
			
			$sql = "select count(*) from $this->tn where name='$name' and password='$password' and hash=''";
            return $this->mysql->result($sql);
    	}
    	
    	function getId($name) {
    		
    		$sql = "select id from $this->tn where name='$name'";
            return $this->mysql->result($sql);
        }
				
		function getOne($id, $pole) {
			
			if (!$this->check($id, "/^[0-9]+$/")) return FALSE;
						
			$sql = "select $pole from $this->tn where id='$id'";
            return $this->mysql->result($sql);
        }
		
		function getKol() {
			
			$sql = "select count(*) from $this->tn";
			return $this->mysql->result($sql);
        }
				
		function changePass($id, $old_password, $password) {
	    	
	    	$sql = "select password from $this->tn where id='$id'";
			$pass = $this->mysql->result($sql);
			
			if ($pass!=md5(md5($old_password))) return FALSE;
			 
			$password = md5(md5($password));
			 
			$sql = "update $this->tn set password='$password' where id='$id'";
        	if (!$this->mysql->query($sql)) return FALSE;
     	
        	return TRUE;
        }
		
		function changePass2($id, $password) {
			
			$password = md5(md5($password)); 
			$sql = "update $this->tn set password='$password' where id='$id'";
            if (!$this->mysql->query($sql)) return FALSE;
        
        	return TRUE;
        }
				    	
		function makeIn($action, $selected) {
        	            
				if ($action=="" || !count($selected)) return FALSE;
				if (count($selected)==1 && $selected[0]==1 && ($action=="1" || $action=="1_1" || $action=="5")) return FALSE;
	            
				switch ($action) { 
	
					case "1"   : $rn = "banned";     $mk = "1"; break;
					case "1_1" : $rn = "banned";     $mk = "0"; break;
					case "2"   : $rn = "allow_mail"; $mk = "1"; break;
					case "2_1" : $rn = "allow_mail"; $mk = "0"; break;
				}
			
				if ($action=="3") {
					for ($i = 0; $selected[$i]; $i++) {
						if ($selected[$i]!=1) {
							$sql = "delete from $this->tn where id='$selected[$i]'";
		            		if (!$this->mysql->query($sql)) return FALSE;
		            		@unlink(SITE_DIR .AVATARS_DIR."/".$selected[$i].".png");
						}
					}
					return TRUE;
				}
				elseif ($rn) {
					for ($i = 0; $selected[$i]; $i++) {
						if ($selected[$i]!=1 || $rn=="allow_mail") {
							$sql = "update $this->tn set $rn='$mk' where id='$selected[$i]'";
		            		if (!$this->mysql->query($sql)) return FALSE;
						}
					}
					return TRUE;
				}
			
			return FALSE;					
		}
		
		function getStatistik() {
				
        	$sql1 = "select count(*) from $this->tn";
            $sql2 = "select count(*) from $this->tn where banned='1'";
			$sql3 = "select count(*) from $this->tn where reg_date > ".(time() - 86400);
            $sql4 = "select count(*) from $this->tn where reg_date > ".(time() - 7*86400);
			$sql5 = "select count(*) from $this->tn where reg_date > ".(time() - 30*86400);
			
			$statistik['mon']  = $this->mysql->result($sql5);
			$statistik['week'] = $this->mysql->result($sql4);
			$statistik['day']  = $this->mysql->result($sql3);
			$statistik['bann'] = $this->mysql->result($sql2);
			$statistik['kol']  = $this->mysql->result($sql1);
			
			return $statistik;
        }
		
		function addBookmark($user_id, $news_id) {
         	         	
            $sql = "insert into $this->tn2 values(null, '$user_id', '$news_id')";
			
			if (!$this->mysql->query($sql)) return FALSE;
			return TRUE;           
        }
        
        function delBookmark($user_id, $news_id) {
            
            $sql = "delete from $this->tn2 where user_id='$user_id' and news_id='$news_id'";
			if (!$this->mysql->query($sql)) return FALSE;
			
			return TRUE;           
        }
		
		function getUserBookmarks($user_id) {
            
        	if (!$this->check($user_id, "/^[0-9]+$/")) return FALSE;
        	
			$sql = "select news_id from $this->tn2 where user_id='$user_id'";
            return $this->mysql->fetch_row($sql);
        }
        
        function hashActiv($hash) {
           
        	if (!$this->check($hash, "/^[0-9a-z]+$/")) return FALSE;
        	
        	$sql  = "select count(*) from $this->tn where hash<>''";
        	$kol1 = $this->mysql->result($sql);
        	 
			$sql = "update $this->tn set hash='' where hash='$hash'";
			if (!$this->mysql->query($sql)) return FALSE;
			
			$sql  = "select count(*) from $this->tn where hash<>''";
			$kol2 = $this->mysql->result($sql);
			
			if (($kol1-$kol2)!=1) return FALSE;
            
            return TRUE;
        }
        
        function hashLostPass($id, $hash) {
           
			$sql  = "update $this->tn set hashlp='$hash' where id='$id'";
			if (!$this->mysql->query($sql)) return FALSE;
			
			return TRUE;           
        }
        
        function hashLostPassActiv($hash) {
            
        	if (!$this->check($hash, "/^[0-9a-z]+$/")) return FALSE;
        	
        	$sql  = "select name from $this->tn where hashlp='$hash'";
        	$name = $this->mysql->result($sql); 
        	
        	if (!$name) return FALSE;
        	
			$sql  = "update $this->tn set hashlp='' where hashlp='$hash'";
			if (!$this->mysql->query($sql)) return FALSE;
			            
            return $name;
        }
               
        function allowedIp($id, $ip) {
		
			$sql = "select allowed_ip from $this->tn where id='$id'";
            $ip1 = $this->mysql->result($sql);
            
            if (!$ip1) return TRUE;
            
            $a  = explode(".", $ip);
            $a1 = explode(".", $ip1);
            
			if ($a1[0]==$a[0] && $a1[1]==$a[1] && ($a1[2]==$a[2] || $a1[2]=="*") && ($a1[3]==$a[3] || $a1[3]=="*")) return TRUE;
			 
            return FALSE;
        }
        
        function valueExists($pole, $value, $id = 0) {
        	
        	$sql = "select count(*) from $this->tn where $pole='$value' and id<>'$id'";
            if (!$this->mysql->result($sql)) return FALSE;
            
            return TRUE;
        }
        
        function updateOne($id, $pole, $value) {
        	
        	$sql = "update $this->tn set $pole='$value' where id='$id'";
			if (!$this->mysql->query($sql)) return FALSE;
			
			return TRUE;				
        }
                        		
        function check($str, $type = RE_LOGIN) {
            return preg_match($type, $str);
        }  	
	}

?>
