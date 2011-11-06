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
// Файл: pm.class.php
//-----------------------------------------------------------------------------/
// Назначение: Класс управления персональными сообщениями
//=============================================================================/
*/
    
    class pm {
    	var $mysql, $tn = PM;

        function pm($mysql_obj) {
            $this->mysql = $mysql_obj;
        }
   
        function add($subj, $text, $user_id, $user_from, $date, $pm_read, $is_del, $is_del_from, $autor, $autor_to) {
            
            $sql = "insert into $this->tn values(null, '$subj', '$text', '$user_id', '$user_from', '$date', '$pm_read', '$is_del', '$is_del_from', '$autor', '$autor_to')";
            if (!$this->mysql->query($sql)) return FALSE;
			
			return TRUE;           
        }
                
        function get($user_id, $type, $id = 0) {
        	
        	if (!$this->check($id, "/^[0-9]+$/")) return FALSE;
        	
        	$idd = ($id) ? "and id='$id'" : "" ;
        	
			$sql = (!$type) ? "select * from $this->tn where user_id='$user_id' and is_del='0' $idd order by id desc" : "select * from $this->tn where user_from='$user_id' and is_del_from='0' $idd order by id desc";
           	return $this->mysql->fetch_row($sql);
        }  
         
        function makeIn($action, $selected, $type, $ID) {
			
			if ($action=="" || !count($selected)) return FALSE;
            		
			if ($action=="1") {
				for ($i = 0; $selected[$i]; $i++) {
					
					$sql = ($type) ? "select user_from from $this->tn where id='$selected[$i]'" : "select user_id from $this->tn where id='$selected[$i]'";
				   	if ($ID!=$this->mysql->result($sql)) return FALSE;
					
					$sql = ($type) ? "update $this->tn set is_del_from='1' where id='$selected[$i]'" : "update $this->tn set is_del='1' where id='$selected[$i]'";
				   	if (!$this->mysql->query($sql)) return FALSE;
				}
				return TRUE;
			}
			
			return FALSE;					
		}
		
		function makeRead($id) {
			
			if (!$this->check($id, "/^[0-9]+$/")) return FALSE;
			
			$sql = "update $this->tn set pm_read='1' where id='$id'";
			if (!$this->mysql->query($sql)) return FALSE;
			
			return TRUE;					
		}
		
		function kolPM($user_id) {
			
			if (!$this->check($user_id, "/^[0-9]+$/")) return FALSE;
			
			$sql = "select count(*) from $this->tn where pm_read='0' and user_id='$user_id' and is_del='0'";
			$kol_pm['read'] = $this->mysql->result($sql);
			
			$sql = "select count(*) from $this->tn where user_id='$user_id' and is_del='0'";
			$kol_pm['all'] = $this->mysql->result($sql);
			
			return $kol_pm;
		}	
		
		function delNot($id, $type) {
            
            if (!$this->check($id, "/^[0-9]+$/")) return FALSE;
						
			$sql = ($type) ? "update $this->tn set is_del_from='1' where id='$id'" : "update $this->tn set is_del='1' where id='$id'";;
            if (!$this->mysql->query($sql)) return FALSE;
            
            return TRUE; 			                             
	    }	
	    
	    function getOne($id, $pole) {
		 	
		 	if (!$this->check($id, "/^[0-9]+$/")) return FALSE;	
					 	
		 	$sql = "select $pole from $this->tn where id='$id'";
            return $this->mysql->result($sql);
        }
		
        function check($str, $type) {
            return preg_match($type, $str);
        }  
	}
    		
?>
