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
// Файл: statik.class.php
//-----------------------------------------------------------------------------/
// Назначение: Класс управления статическими страницами
//=============================================================================/
*/
    
    class statik {
    	var $mysql, $tn = STATIK;

        function statik($mysql_obj) {
            $this->mysql = $mysql_obj;
        }
   
        function add($title, $descr, $story, $keywords, $access, $auter, $date, $onoff, $user_id) {
            
            $sql = "insert into $this->tn values(null, '$title', '$story', '$descr', '$keywords', '$access', 0, '$auter', '$date', '$onoff', '$user_id')";
			if (!$this->mysql->query($sql)) return FALSE;
			
			return TRUE;           
        }
                
        function get($id = 0, $user_id = 0) {
        
        	if (!$this->check($id, "/^[0-9]+$/")) return FALSE;
        
        	$quser = ($user_id) ? "where user_id = '$user_id'" : "";
        	
			$sql = (!$id) ? "select * from $this->tn $quser order by id asc" : "select * from $this->tn where id='$id'";
            return $this->mysql->fetch_row($sql);
        }

		function del($id) {
            
            if (!$this->check($id, "/^[0-9]+$/")) return FALSE;
			if (!$this->get($id)) return FALSE; 
			
			$sql = "delete from $this->tn where id='$id'";
            if (!$this->mysql->query($sql)) return FALSE;
            
            return TRUE; 			                             
	    }
                
        function update($id, $title, $descr, $story, $keywords, $access, $onoff) {
        
        	if (!$this->check($id, "/^[0-9]+$/")) return FALSE;
		
			$sql = "update $this->tn set title='$title', descr='$descr', story='$story', keywords='$keywords', access='$access', onoff='$onoff' where id='$id'";
            if (!$this->mysql->query($sql)) return FALSE;
			
			return TRUE;
        }
        
        function makeIn($action, $selected) {
			
			if ($action=="" || !count($selected)) return FALSE;
            	            
			switch ($action) {
				
				case "1"    : $rn = "onoff"; $mk = "1"; break;
				case "1_1"  : $rn = "onoff"; $mk = "0"; break;
			}
				
			if ($action=="2") {
				for ($i = 0; $selected[$i]; $i++) {
					$sql = "delete from $this->tn where id='$selected[$i]'";
	            	if (!$this->mysql->query($sql)) return FALSE;
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
		
		function statikReadPP($id) {
		 	
		 	if (!$this->check($id, "/^[0-9]+$/")) return FALSE;	
			
			$sql = "update $this->tn set views=views+1 where id='$id'";
            
            if (!$this->mysql->query($sql)) return FALSE;
			
			return TRUE;
        }
    	
		function getOne($id, $pole) {
		 	
		 	if (!$this->check($id, "/^[0-9]+$/")) return FALSE;	
					 	
		 	$sql = "select $pole from $this->tn where id='$id'";
            return $this->mysql->result($sql);
        }
		                
        function getS($id = 0) {
        
        	if (!$this->check($id, "/^[0-9]+$/")) return FALSE;
               	
			$sql = (!$id) ? "select * from $this->tn where onoff='1' order by id asc" : "select * from $this->tn where onoff='1' and id='$id'";
            return $this->mysql->fetch_row($sql);
        }
        
        function check($str, $type) {
            return preg_match($type, $str);
        }  
	}

?>
