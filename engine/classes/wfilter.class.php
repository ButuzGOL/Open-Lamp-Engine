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
// Файл: wfiter.class.php
//-----------------------------------------------------------------------------/
// Назначение: Класс управления фильтрами слов
//=============================================================================/
*/
    
    class wfilter {
    	var $mysql, $tn = WFILTER;

        function wfilter($mysql_obj) {
            $this->mysql = $mysql_obj;
        }
   
        function add($word0, $word1) {
            
            $sql = "insert into $this->tn values(null, '$word0', '$word1')";
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
                
        function update($id, $word0, $word1) {
           
			$sql = "update $this->tn set word0='$word0', word1='$word1' where id='$id'";
            if (!$this->mysql->query($sql)) return FALSE;
			
			return TRUE;
        }
        
        function makeIn($action, $selected) {
			            
			if ($action=="" || !count($selected)) return FALSE;
            		
			if ($action=="1") {
				for ($i = 0; $selected[$i]; $i++) {
					$sql = "delete from $this->tn where id='$selected[$i]'";
	            	if (!$this->mysql->query($sql)) return FALSE;
				}
				return TRUE;
			}
			
			return FALSE;			
		}   
		
		 function wordFilter($text) {
            
            $result = $this->get();
            
            if (!$result) return $text;
	        else foreach ($result as $n) $text = str_replace($n[1], $n[2], $text);           
						
			return $text;
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
