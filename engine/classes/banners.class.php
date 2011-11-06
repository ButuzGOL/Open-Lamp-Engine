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
// Файл: banners.class.php
//-----------------------------------------------------------------------------/
// Назначение: Класс управления рекламными материалами 
//=============================================================================/
*/	
    
    class banners {
    	var $mysql, $tn = BANNERS;

        function banners($mysql_obj) {
            $this->mysql = $mysql_obj;
        }
   
        function add($descr, $code, $onoff, $fixed, $place, $cats, $access, $allow_main, $allow_cate, $allow_statik, $allow_news, $allow_arhnews, $allow_search) {
        	
        	$sql = "insert into $this->tn values(null, '$descr', '$code', '$onoff', '$fixed', '$place', '$cats', '$access', '$allow_main', '$allow_cate', '$allow_statik', '$allow_news', '$allow_arhnews', '$allow_search')";
			if (!$this->mysql->query($sql)) return FALSE;
			
			return TRUE;
		}
                
        function get($id = 0) {
            
            if (!$this->check($id, "/^[0-9]+$/")) return FALSE;
			
			$sql = (!$id) ? "select * from $this->tn order by id asc" : "select * from $this->tn where id='$id'";
            return $this->mysql->fetch_row($sql);
        }
        
        function getS($type = 0, $cate = 0) {
            	
        	switch ($type) {
        	    case "0": $q = "and allow_main='1'";    break;
        	    case "1": $q = "and allow_statik='1'";  break;
        	    case "2": $q = "and allow_arhnews='1'"; break;
        	    case "3": $q = "and allow_news='1'";    break;
        	    case "4": $q = "and allow_search='1'";  break;
        	    case "5": $q = "and allow_cate='1'";    break;
        	}
        	
        	$sql = ($cate) ? "and (locate('$cate,', concat(cats,','))>0 or cats=0)" : "select * from $this->tn where onoff='1' $q $qc order by fixed desc";
            return $this->mysql->fetch_row($sql);
        }

		function del($id) {
	        
            if (!$this->check($id, "/^[0-9]+$/")) return FALSE;
			if (!$this->get($id)) return FALSE; 
			
			$sql = "delete from $this->tn where id='$id'";
            if (!$this->mysql->query($sql)) return FALSE;
            
            return TRUE; 			                             
	    }
                
        function update($id, $descr, $code, $onoff, $fixed, $place, $cats, $access, $allow_main, $allow_cate, $allow_statik, $allow_news, $allow_arhnews, $allow_search) {
            
            $sql = "update $this->tn set descr='$descr', code='$code', onoff='$onoff', fixed='$fixed', place='$place', cats='$cats', 
            	access='$access', allow_main='$allow_main', allow_cate='$allow_cate', allow_statik='$allow_statik', allow_news='$allow_news', 
            	allow_arhnews='$allow_arhnews', allow_search='$allow_search' where id='$id'";
            if (!$this->mysql->query($sql)) return FALSE;
  			
  			return TRUE;
        }
               
        function makeIn($action, $selected) {
			
			if ($action=="" || !count($selected)) return FALSE;
			
			switch ($action) { 

				case "1"   : $rn = "onoff";         $mk = "1"; break;
				case "1_1" : $rn = "onoff";         $mk = "0"; break;
				case "2"   : $rn = "fixed";         $mk = "1"; break;
				case "2_1" : $rn = "fixed";         $mk = "0"; break;
				case "3"   : $rn = "allow_main";    $mk = "1"; break;
				case "3_1" : $rn = "allow_main";    $mk = "0"; break;
				case "4"   : $rn = "allow_cate";    $mk = "1"; break;
				case "4_1" : $rn = "allow_cate";    $mk = "0"; break;
				case "5"   : $rn = "allow_statik";  $mk = "1"; break;
				case "5_1" : $rn = "allow_statik";  $mk = "0"; break;
				case "6"   : $rn = "allow_news";    $mk = "1"; break;
				case "6_1" : $rn = "allow_news";    $mk = "0"; break;
				case "7"   : $rn = "allow_arhnews"; $mk = "1"; break;
				case "7_1" : $rn = "allow_arhnews"; $mk = "0"; break;
				case "8"   : $rn = "allow_search";  $mk = "1"; break;
				case "8_1" : $rn = "allow_search";  $mk = "0"; break;
				case "9"   : $rn = "place";         $mk = "1"; break;
				case "9_1" : $rn = "place";         $mk = "2"; break;			
				case "9_2" : $rn = "place";         $mk = "3"; break;
				case "9_3" : $rn = "place";         $mk = "4"; break;
				case "9_4" : $rn = "place";         $mk = "5"; break;
				case "9_5" : $rn = "place";         $mk = "6"; break;
				case "9_6" : $rn = "place";         $mk = "7"; break;
			}
            	            
			if ($action=="10") {
				for ($i = 0; $selected[$i]; $i++) {
					$sql = "delete from $this->tn where id='$selected[$i]'";
	            	if (!$this->mysql->query($sql)) return FALSE;
				}
				return TRUE;
			}
			elseif ($rn) {
				for ($i = 0; $selected[$i]; $i++) {
					$sql = "update $this->tn set $rn='$mk' where id='$selected[$i]'";
	            	if (!$this->mysql->query($sql)) return FALSE;
				}
				return TRUE;
			}
			
			return FALSE;
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
			        
        function check($str, $type) {
            return preg_match($type, $str);
        }  
	}
    		
?>
