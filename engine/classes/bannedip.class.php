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
// Файл: banned.class.php
//-----------------------------------------------------------------------------/
// Назначение: Класс управления забаненными IP или пользователями
//=============================================================================/
*/	

    
    class bannedip {
    	var $mysql, $tn = BANNEDIP;

        function bannedip($mysql_obj) {
            $this->mysql = $mysql_obj;
        }
   
        function add($ip, $date, $descr) {
            
            $sql = "insert into $this->tn values(null, '$ip', '$date', '$descr')";
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
                
        function update($id, $ip, $date, $descr) {
        	            
            $sql = "update $this->tn set ip='$ip', date='$date', descr='$descr' where id='$id'";
			if (!$this->mysql->query($sql)) return FALSE;
			
			return TRUE;
        }
        
        function makeIn($action, $selected) {
			
			if ($action=="" || !count($selected)) return FALSE;
            
			if ($action=="1") {
				for ($i = 0; $selected[$i]; $i++) {
					$sql = "update $this->tn set date='0' where id='$selected[$i]'";
	            	if (!$this->mysql->query($sql)) return FALSE;
				}
				return TRUE;
			}		
			
			if ($action=="2") {
				for ($i = 0; $selected[$i]; $i++) {
					$sql = "delete from $this->tn where id='$selected[$i]'";
	            	if (!$this->mysql->query($sql)) return FALSE;
				}
				return TRUE;
			}
			
			return FALSE;			
		}
		
		function checkIsBann($ip) {
		
			$sql = "select ip from $this->tn";
            $inf = $this->mysql->fetch_row($sql);
            if (!$inf) return FALSE;
            
            $a  = explode(".", $ip);
			foreach ($inf as $n) {
				$a1 = explode(".", $n[0]);
				if ($a1[0]==$a[0] && $a1[1]==$a[1] && ($a1[2]==$a[2] || $a1[2]=="*") && ($a1[3]==$a[3] || $a1[3]=="*")) return TRUE;
			}
            
            return FALSE;
        }
        
        function getOne($id, $pole) {
		
        	if (!$this->check($id, "/^[0-9]+$/")) return FALSE;
			
			$sql = "select $pole from $this->tn where id='$id'";
            return $this->mysql->result($sql);
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
