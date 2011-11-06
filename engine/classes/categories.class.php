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
// Файл: categories.class.php
//-----------------------------------------------------------------------------/
// Назначение: Класс управления категориями новостей
//=============================================================================/
*/
    
    class categories {
    	var $mysql, $tn = CATEGORIES, $tn1 = USERSGROUP;

        function categories($mysql_obj) {
            $this->mysql = $mysql_obj;
        }
   
        function add($name, $parent_id, $news_sort, $news_msort, $news_num) {
           
            $sql = "insert into $this->tn values(null, '$name', '$parent_id', '$news_sort', '$news_msort', '$news_num')";
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
            else {
				$sql = "update $this->tn set parent_id='0' where parent_id='$id'";
            	if (!$this->mysql->query($sql)) return FALSE;
			} 			                 
			
			return TRUE;            
    	}
                
        function update($id, $name, $parent_id, $news_sort, $news_msort, $news_num) {
        	
        	$sql = "update $this->tn set name='$name', parent_id='$parent_id', news_sort='$news_sort',
				news_msort='$news_msort', news_num='$news_num' where id='$id'";
            if (!$this->mysql->query($sql)) return FALSE;
			
			return TRUE;
        }
        
        function makeTree($id = 0) {
			
			$sql = "select id, parent_id, name from $this->tn";
			$inf = $this->mysql->fetch_row($sql);
			
			$tree  = array();
			$etree = array();
			$help  = array();
			for ($i = 0, $FTree; $inf[$i]; $i++) {
				if (!in_array($inf[$i][0], $etree) && $id!=$inf[$i][0] && !$inf[$i][1]) {
					array_push($etree, $inf[$i][0]);
					array_push($help, $inf[$i][0]);
					$tree[$FTree][0] = $inf[$i][0];
					$tree[$FTree][1] = $inf[$i][2];
					$FTree++;
					$Help = 0;
            		$k  = 1;
					while($k) {
						for ($j = 0, $kk = 1; $inf[$j]; $j++) 
							if ($inf[$j][1]==$help[$Help] && !in_array($inf[$j][0], $etree) && $id!=$inf[$j][0]) {
								for ($p = 0, $pr = ""; $p<=$Help; $p++) $pr .= "-";
								$tree[$FTree][0] = $inf[$j][0];
								$tree[$FTree][1] = $pr." ".$inf[$j][2];
								$FTree++;
								array_push($etree, $inf[$j][0]); 
								array_push($help, $inf[$j][0]); 
								$Help++; 
								$kk = 0; 
								break;	
							}
						
						if ($kk && count($help)==1) $k = 0;  
						if ($kk) {array_pop($help); $Help--; $kk1 = 1;} 
					}			
				}
			}
			if (!count($tree)) return FALSE;
						
			return $tree;
		}
		
		function getTree() {
			
			$make_tree = $this->makeTree(); 
			if (!$make_tree) return FALSE;
			
			foreach($make_tree as $n) {
				$sql = "select * from $this->tn where id='$n[0]'";
				$inf = $this->mysql->fetch_row($sql);
				foreach ($inf as $new) {$tree[$new[0]] = $new; $tree[$new[0]][1] = $n[1];}
			}
			if (!count($tree)) return FALSE;
			
			return $tree;
		}
		
		function makeCats($cats) {
			
			$sql = "select id, parent_id from $this->tn";
			$inf = $this->mysql->fetch_row($sql);
			
			$Cats = array();
			for($i = 0; $cats[$i]; $i++) {
				for ($j = 0; $inf[$j]; $j++)
					if ($cats[$i]==$inf[$j][0])	{
						if ($inf[$j][1]=="0") array_push($Cats, $cats[$i]); 
						else {
							$p_id = $inf[$j][1];
							while($p_id!="0")
								if (in_array($p_id, $Cats)) break;
								else for ($i1 = 0; $inf[$i1]; $i1++) if ($p_id==$inf[$i1][0]) $p_id = $inf[$i1][1];					
							if ($p_id=="0") array_push($Cats, $cats[$i]);						
						}			
						break;
					}
			}
			if (!count($Cats)) return FALSE;	
			
			return $Cats;
		} 
		
		function makeIn($action, $selected) {
        	            
			if ($action=="" || !count($selected)) return FALSE;
            
			switch ($action) { 

				case "1_1" : $rn = "news_sort";  $mk = "0"; break;
				case "1_2" : $rn = "news_sort";  $mk = "1"; break;
				case "1_3" : $rn = "news_sort";  $mk = "2"; break;
				case "1_4" : $rn = "news_sort";  $mk = "3"; break;
				case "1_5" : $rn = "news_sort";  $mk = "4"; break;
				case "2_1" : $rn = "news_msort"; $mk = "0"; break;
				case "2_2" : $rn = "news_msort"; $mk = "1"; break;
				case "2_3" : $rn = "news_msort"; $mk = "2"; break;
							
			}
		
			if ($action=="3") {
				for ($i = 0; $selected[$i]; $i++) {
					$sql = "delete from $this->tn where id='$selected[$i]'";
	            	if (!$this->mysql->query($sql)) return FALSE;
				}
				$sql = "select * from $this->tn1 order by id asc";
         		$result = $this->mysql->fetch_row($sql);
				if ($result)    				foreach ($result as $n) {    					$allow_cats = @implode(",", $this->makeCats($n[2]));						$sql = "update $this->tn1 set allow_cats='$allow_cats' where id='$n[0]'";
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
				
		function getOne($id, $pole) {
			
			if (!$this->check($id, "/^[0-9]+$/")) return FALSE;
			
			$sql = "select $pole from $this->tn where id='$id'";
            return $this->mysql->result($sql);
		}
		
		function makeWayCate($id) {
			
        	$sql = "select id, parent_id from $this->tn";
			$inf = $this->mysql->fetch_row($sql);
			
			$Cats = array();
			
			$i = 0;
			while ($inf[$i][0]) {
				if ($inf[$i][0]==$id) {
					if ($inf[$i][1]!="0") { array_push($Cats,$inf[$i][0]); $id = $inf[$i][1]; $i = -1; } 
					else {array_push($Cats, $inf[$i][0]); break;}
				}
				$i++;
			}
			if (!count($Cats)) return FALSE;			
			
			return array_reverse($Cats);
		}
		
		function isAllowCate($user_cats, $news_cats) {
			
			if (!$user_cats || !$news_cats) return TRUE;
			
			$sql = "select id, parent_id from $this->tn";
			$inf = $this->mysql->fetch_row($sql);
			
			$cats  = explode(",", $news_cats);
			$cats1 = explode(",", $user_cats);		
			for($i = 0; $cats[$i]; $i++) {
				$p_id = $cats[$i];
				for ($j = 0; $inf[$j]; $j++)  
					if ($p_id==$inf[$j][0])	 
						if (in_array($p_id, $cats1)) return TRUE;
						else {
							if ($inf[$j][1]=="0") break;								
							else {$p_id = $inf[$j][1]; $j = 0;} 
						}
			}
			
			$cats  = explode(",", $user_cats);		
			$cats1 = explode(",", $news_cats);
			for($i = 0; $cats[$i]; $i++) {
				$p_id = $cats[$i];
				for ($j = 0; $inf[$j]; $j++)  
					if ($p_id==$inf[$j][0])	 
						if (in_array($p_id, $cats1)) return TRUE;
						else {
							if ($inf[$j][1]=="0") break;								
							else {$p_id = $inf[$j][1]; $j = 0;} 
						}
			}
			
			return FALSE;			
		}	
		        
        function check($str, $type) {
            return preg_match($type, $str);
        }  
	}
    		
?>
