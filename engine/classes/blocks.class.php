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
// Файл: blocks.class.php
//-----------------------------------------------------------------------------/
// Назначение: Класс управления блоками 
//=============================================================================/
*/	
    
    class blocks {
    	var $mysql, $tn = BLOCKS;

        function blocks($mysql_obj) {
            $this->mysql = $mysql_obj;
        }
   
        function add($descr, $title, $onoff, $place, $tpl, $modul, $text) {
        	
        	$pos = $this->getPos($place);
            
            $sql = "insert into $this->tn values(null, '$descr', '$title', '$onoff', '$place', '$pos', '$tpl', '$modul', '$text')";
			if (!$this->mysql->query($sql)) return FALSE;
			
			return TRUE;           
        }
                
        function get($id = 0) {
        	
        	if (!$this->check($id, "/^[0-9]+$/")) return FALSE;
			
			$sql = (!$id) ? "select * from $this->tn order by onoff desc, place, pos asc" : "select * from $this->tn where id='$id'";
            return $this->mysql->fetch_row($sql);
        }
        
        function update($id, $descr, $title, $onoff, $place, $tpl, $modul, $text) {
                    	
        	$sql = "select onoff from $this->tn where id='$id'";
            $old_onoff = $this->mysql->result($sql);
            
            if ($onoff==$old_onoff && $onoff=="1") $this->changePlace($id, $place);
        	else $this->changeOnOff($id, $onoff, $place);
        	
        	$sql = "update $this->tn set descr='$descr', title='$title', tpl='$tpl', modul='$modul', text='$text' where id='$id'";
            if (!$this->mysql->query($sql)) return FALSE;
			
			return TRUE;
        }
       
      	function del($id) {
	        
        	if (!$this->check($id, "/^[0-9]+$/")) return FALSE;
        	if (!$this->get($id)) return FALSE;
			
			$sql = "select place from $this->tn where id='$id'";
        	$old_place = $this->mysql->result($sql);
        	
        	$sql = "select pos from $this->tn where id='$id'";
        	$old_pos   = $this->mysql->result($sql);
			
			$sql = "update $this->tn set pos=pos-1 where place='$old_place' and pos>'$old_pos'";
            if (!$this->mysql->query($sql)) return FALSE;
            
			$sql = "delete from $this->tn where id='$id'";
            if (!$this->mysql->query($sql)) return FALSE;
            
            return TRUE; 			                             
	    }
        
        function makeIn($action, $selected) {
			            
			if ($action=="" || !count($selected)) return FALSE;
			
			switch ($action) { 

				case "1"   : $mk = "1"; break;
				case "1_1" : $mk = "0"; break;
				case "2"   : $mk = "1"; break;
				case "2_1" : $mk = "2"; break;			
				case "2_2" : $mk = "3"; break;
				case "2_3" : $mk = "4"; break;
		
			}
            	            
			if ($action=="3") {
				for ($i = 0; $selected[$i]; $i++) {
					$this->del($selected[$i]);
				}
				return TRUE;
			}
			elseif ($action=="1" || $action=="1_1") {
				for ($i = 0; $selected[$i]; $i++) {
					$this->changeOnOff($selected[$i], $mk, 1);
				}
				return TRUE;
			}
			elseif ($mk) {
				for ($i = 0; $selected[$i]; $i++) {
					$sql = "select onoff from $this->tn where id='$selected[$i]'";
            		$old_onoff = $this->mysql->result($sql);
            		if ($old_onoff!="0") $this->changePlace($selected[$i], $mk);
				}
				return TRUE;
			}
			
			return FALSE;	
		}   
        
        function getPos($place) {
	        
        	if (!$this->check($place, "/^[0-9]+$/")) return FALSE;
        	
			$sql = "select count(*) from $this->tn where place='$place'";
            return $this->mysql->result($sql)+1; 			                             
        }
		
		function changePlace($id, $place) {
        	
        	if (!$this->check($place, "/^[0-9]+$/")) return FALSE;
        	if (!$this->check($id, "/^[0-9]+$/")) return FALSE;
        	
        	$sql = "select place from $this->tn where id='$id'";
        	$old_place = $this->mysql->result($sql);
        	
        	$sql = "select pos from $this->tn where id='$id'";
        	$old_pos   = $this->mysql->result($sql);
			
			if ($old_place!=$place && $old_place!="0") {
				$sql = "update $this->tn set pos=pos-1 where place='$old_place' and pos>'$old_pos'";
            	if (!$this->mysql->query($sql)) return FALSE;
				
				$sql = "update $this->tn set pos=".$this->getPos($place).", place='$place' where id='$id'";
            	if (!$this->mysql->query($sql)) return FALSE;
			
				return TRUE;
			}		                            
			
			return FALSE; 
	    }
        
        function changePos($id, $where) {
	                    
			if (!$this->check($id, "/^[0-9]+$/")) return FALSE;
			
        	$sql = "select place from $this->tn where id='$id'";
        	$old_place = $this->mysql->result($sql);
        	
        	$sql = "select pos from $this->tn where id='$id'";
        	$old_pos = $this->mysql->result($sql);
        	
        	if ($old_pos==0) return FALSE;
        	if ($old_pos==1 && $where=="up") return FALSE;
        	if ($old_pos==($this->getPos($old_place)-1) && $where=="down") return FALSE;
        	
        	if ($where=="down") {
		    	$sql = "update $this->tn set pos=pos-1 where place='$old_place' and pos='".($old_pos+1)."'";
            	if (!$this->mysql->query($sql)) return FALSE;
            	
				$sql = "update $this->tn set pos=pos+1 where id='$id'";
            	if (!$this->mysql->query($sql)) return FALSE;
            	
            	return TRUE;
			}
			elseif ($where=="up") {
				$sql = "update $this->tn set pos=pos+1 where place='$old_place' and pos='".($old_pos-1)."'";
            	if (!$this->mysql->query($sql)) return FALSE;
				
				$sql = "update $this->tn set pos=pos-1 where id='$id'";
            	if (!$this->mysql->query($sql)) return FALSE;
            	
            	return TRUE;
			}	
					                             
	    	return FALSE; 	  
        }
		
		function changeOnOff($id, $onoff, $place) {
	       
        	if (!$this->check($id, "/^[0-9]+$/")) return FALSE;
        	
			$sql = "select onoff from $this->tn where id='$id'";
            $old_onoff = $this->mysql->result($sql);
            
            $sql = "select place from $this->tn where id='$id'";
        	$old_place = $this->mysql->result($sql);
        	
        	$sql = "select pos from $this->tn where id='$id'";
        	$old_pos = $this->mysql->result($sql);
        	
			if ($old_onoff!=$onoff) {
				if ($onoff=="1") {
					$pos = $this->getPos($place);
					$sql = "update $this->tn set pos='$pos', place='$place', onoff='$onoff' where id='$id'";
            		if (!$this->mysql->query($sql)) return FALSE;
				
					return TRUE;
				}
				elseif ($onoff=="0") {
					$sql = "update $this->tn set pos=pos-1 where place='$old_place' and pos>'$old_pos'";
            		if (!$this->mysql->query($sql)) return FALSE;
					
					$sql = "update $this->tn set pos='0', place='0', onoff='$onoff' where id='$id'";
            		if (!$this->mysql->query($sql)) return FALSE;
				
					return TRUE;
				}
			}
			
			return FALSE;  			                             
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
