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
// Файл: usersgroup.class.php
//-----------------------------------------------------------------------------/
// Назначение: Класс управления группами пользователей
//=============================================================================/
*/
    
    class usersgroup {
    	var $mysql, $tn = USERSGROUP, $tn1 = USERS, $tn2 = CATEGORIES;

        function usersgroup($mysql_obj) {
            $this->mysql = $mysql_obj;
        }

        function add($group_name, $allow_cats, $cat_add, $allow_offline, $allow_admin, $allow_short, $allow_poll, $allow_adds, $moderation, $allow_main, $allow_edit, $allow_all_edit, $allow_addc, $allow_editc, $allow_delc, $captcha, $edit_allc, $del_allc, $allow_hide, $allow_pm, $allow_search, $allow_rating, $allow_addst, $allow_editst, $allow_all_editst, $moderationst, $allow_html) {
        
       	$sql = "insert into $this->tn values(null, '$group_name', '$allow_cats', '$cat_add', '$allow_offline', '$allow_admin', '$allow_short', '$allow_poll', '$allow_adds', '$moderation', '$allow_main', '$allow_edit', '$allow_all_edit', '$allow_addc', '$allow_editc', '$allow_delc', '$captcha', '$edit_allc', '$del_allc', '$allow_hide', '$allow_pm', '$allow_search', '$allow_rating', '$allow_addst', '$allow_editst', '$allow_all_editst', '$moderationst', '$allow_html')";
			if (!$this->mysql->query($sql)) return FALSE;
						
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
            return TRUE; 			                             
	    }
                
        function update($id, $group_name, $allow_cats, $cat_add, $allow_offline, $allow_admin, $allow_short, $allow_poll, $allow_adds, $moderation, $allow_main, $allow_edit, $allow_all_edit, $allow_addc, $allow_editc, $allow_delc, $captcha, $edit_allc, $del_allc, $allow_hide, $allow_pm, $allow_search, $allow_rating, $allow_addst, $allow_editst, $allow_all_editst, $moderationst, $allow_html) {
    
        	if (!$this->check($id, "/^[0-9]+$/")) return FALSE;
        	
			$sql = "update $this->tn set group_name='$group_name', allow_cats='$allow_cats', cat_add='$cat_add', allow_offline='$allow_offline', allow_admin='$allow_admin',	allow_short='$allow_short', allow_poll='$allow_poll', allow_adds='$allow_adds', moderation='$moderation', allow_main='$allow_main', 			allow_edit='$allow_edit', allow_all_edit='$allow_all_edit', allow_addc='$allow_addc', allow_editc='$allow_editc', allow_delc='$allow_delc', captcha='$captcha', 			edit_allc='$edit_allc', del_allc='$del_allc', allow_hide='$allow_hide', allow_pm='$allow_pm', allow_search='$allow_search', allow_rating='$allow_rating', allow_addst='$allow_addst', allow_editst='$allow_editst', allow_all_editst='$allow_all_editst', moderationst='$moderationst', allow_html='$allow_html' where id='$id'";
            if (!$this->mysql->query($sql)) return FALSE;
			
			return TRUE;
        }
                
        function updateOne($id, $pole, $value) {
        	
        	$sql = "update $this->tn set $pole='$value' where id='$id'";
			if (!$this->mysql->query($sql)) return FALSE;
			
			return TRUE;				
        }
        
        function getOne($id, $pole) {
			
			if (!$this->check($id, "/^[0-9]+$/")) return FALSE;
						
			$sql = "select $pole from $this->tn where id='$id'";
            return $this->mysql->result($sql);
        }
		
		function kolGroupUsers($id) {
			
        	$sql = "select count(*) from $this->tn1 where usersgroup='$id'";
            return $this->mysql->result($sql);
		}
		
		function makeIn($action, $selected) {
        	           
			if ($action=="" || !count($selected)) return FALSE;
			if (count($selected)==1 && $selected[0]==1) return FALSE;
            
			switch ($action) { 

				case "1"    : $rn = "allow_offline";    $mk = "1"; break;
				case "1_1"  : $rn = "allow_offline";    $mk = "0"; break;
				case "2"    : $rn = "allow_admin";      $mk = "1"; break;
				case "2_1"  : $rn = "allow_admin";      $mk = "0"; break;
				case "3"    : $rn = "allow_short";      $mk = "1"; break;
				case "3_1"  : $rn = "allow_short";      $mk = "0"; break;
				case "4"    : $rn = "allow_poll";       $mk = "1"; break;
				case "4_1"  : $rn = "allow_poll";       $mk = "0"; break;
				case "5"    : $rn = "allow_adds";       $mk = "1"; break;
				case "5_1"  : $rn = "allow_adds";       $mk = "0"; break;
				case "6"    : $rn = "moderation";       $mk = "1"; break;
				case "6_1"  : $rn = "moderation";       $mk = "0"; break;
				case "7"    : $rn = "allow_main";       $mk = "1"; break;
				case "7_1"  : $rn = "allow_main";       $mk = "0"; break;
				case "8"    : $rn = "allow_edit";       $mk = "1"; break;
				case "8_1"  : $rn = "allow_edit";       $mk = "0"; break;
				case "9"    : $rn = "allow_all_edit";   $mk = "1"; break;
				case "9_1"  : $rn = "allow_all_edit";   $mk = "0"; break;
				case "10"   : $rn = "allow_addc";       $mk = "1"; break;
				case "10_1" : $rn = "allow_addc";       $mk = "0"; break;
				case "11"   : $rn = "allow_editc";      $mk = "1"; break;
				case "11_1" : $rn = "allow_editc";      $mk = "0"; break;
				case "12"   : $rn = "allow_delc";       $mk = "1"; break;
				case "12_1" : $rn = "allow_delc";       $mk = "0"; break;
				case "13"   : $rn = "captcha";          $mk = "1"; break;
				case "13_1" : $rn = "captcha";          $mk = "0"; break;
				case "14"   : $rn = "edit_allc";        $mk = "1"; break;
				case "14_1" : $rn = "edit_allc";        $mk = "0"; break;
				case "15"   : $rn = "del_allc";         $mk = "1"; break;
				case "15_1" : $rn = "del_allc";         $mk = "0"; break;
				case "16"   : $rn = "allow_hide";       $mk = "1"; break;
				case "16_1" : $rn = "allow_hide";       $mk = "0"; break;
				case "17"   : $rn = "allow_pm";         $mk = "1"; break;
				case "17_1" : $rn = "allow_pm";         $mk = "0"; break;
				case "18"   : $rn = "allow_search";     $mk = "1"; break;
				case "18_1" : $rn = "allow_search";     $mk = "0"; break;
				case "19"   : $rn = "allow_rating";     $mk = "1"; break;
				case "19_1" : $rn = "allow_rating";     $mk = "0"; break;
				case "20"   : $rn = "allow_addst";      $mk = "1"; break;
				case "20_1" : $rn = "allow_addst";      $mk = "0"; break;
				case "21"   : $rn = "moderationst";     $mk = "1"; break;
				case "21_1" : $rn = "moderationst";     $mk = "0"; break;
				case "22"   : $rn = "allow_editst";     $mk = "1"; break;
				case "22_1" : $rn = "allow_editst";     $mk = "0"; break;
				case "23"   : $rn = "allow_all_editst"; $mk = "1"; break;
				case "23_1" : $rn = "allow_all_editst"; $mk = "0"; break;
				case "24"   : $rn = "allow_html"; 		$mk = "1"; break;
				case "24_1" : $rn = "allow_html"; 		$mk = "0"; break;
			}
		
			if ($action=="25") {
				for ($i = 0; $selected[$i]; $i++) {
					if ($selected[$i]!=1) {
						$sql = "delete from $this->tn where id='$selected[$i]'";
	            		if (!$this->mysql->query($sql)) return FALSE;
					}
				}
				return TRUE;
			}
			elseif ($rn) {
				for ($i = 0; $selected[$i]; $i++) {
					if ($selected[$i]!=1) {
						$sql = "update $this->tn set $rn='$mk' where id='$selected[$i]'";
	            		if (!$this->mysql->query($sql)) return FALSE;
					}
				}
				return TRUE;
			}
				
			return FALSE;
		}
		
		function valueExists($pole, $value, $id = 0) {
        	
        	$sql = "select count(*) from $this->tn where $pole='$value' and id<>'$id'";
            if (!$this->mysql->result($sql)) return FALSE;
            
            return TRUE;
        }
		    		        
		function check($str, $type) {
            return preg_match($type, $str);
        }  
	}
    		
?>
