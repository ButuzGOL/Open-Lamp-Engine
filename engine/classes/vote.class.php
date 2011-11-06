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
// Файл: vote.class.php
//-----------------------------------------------------------------------------/
// Назначение: Класс управления голосованиями
//=============================================================================/
*/
    
    class vote {
    	var $mysql, $tn = VOTE, $tn1 = VOTES;

        function vote($mysql_obj) {
        	$this->mysql = $mysql_obj;
		}
   
        function add($title, $date, $onoff, $is_reg, $cats, $body, $type) {
            
            $sql = "insert into $this->tn values(null, '$type', '$title', '$date', '$onoff', '$is_reg', '$cats', '$body')";
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
                
        function update($id, $title, $onoff, $is_reg, $cats, $body) {
        
        	if (!$this->check($id, "/^[0-9]+$/")) return FALSE;
			if (!$this->get($id)) return FALSE;
            
            $sql = "update $this->tn set title='$title', onoff='$onoff', is_reg='$is_reg', cats='$cats', body='$body' where id='$id'";
            if (!$this->mysql->query($sql)) return FALSE;
			
			return TRUE;
        }
                
        function updateOne($id, $pole, $value) {
        	
    		$sql = "update $this->tn set $pole='$value' where id='$id'";
			if (!$this->mysql->query($sql)) return FALSE;
			
			return TRUE;				
        }
        
        function reset($id) {
            
        	if (!$this->check($id, "/^[0-9]+$/")) return FALSE;
        	if (!$this->get($id)) return FALSE; 
        	
            $sql = "delete from $this->tn1 where vote_id='$id'";
            if (!$this->mysql->query($sql)) return FALSE;
			
			return TRUE;
        }   
        
        function kolVotes($id) {
            
        	$sql = "select body from $this->tn where id='$id'";
            $body = $this->mysql->result($sql);
            
            $sql = "select answer from $this->tn1 where vote_id='$id'";
            $inf = $this->mysql->fetch_row($sql);
            
            $kol = 0;
            if (!$inf) return $kol;
			foreach ($inf as $n) if (strpos(" ".$body,$n[0])) $kol++; 
            
            return $kol;
        }        
    	
    	function getLastId() {
		
			$sql = "select id from $this->tn order by id desc limit 1";
            return $this->mysql->result($sql);
		}
		
		function makeIn($action, $selected) {
        	           
			if ($action=="" || !count($selected)) return FALSE;
            
			switch ($action) { 

				case "1"   : $rn = "onoff";  $mk = "1"; break;
				case "1_1" : $rn = "onoff";  $mk = "0"; break;
				case "2"   : $rn = "is_reg"; $mk = "1"; break;
				case "2_1" : $rn = "is_reg"; $mk = "0"; break;
							
			}
			
			if ($action=="3") {
				for ($i = 0; $selected[$i]; $i++) {
					$sql = "delete from $this->tn1 where vote_id='$selected[$i]'";
	            	if (!$this->mysql->query($sql)) return FALSE;
				}
				
				return TRUE;
			}
			elseif ($action=="4") {
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
		
		function getS($cate = 0, $is_reg = 0) {
			
        	$qcate   = ($cate)   ? "and (locate(',$cate,', concat(',',cats,','))>0 or cats=0)" : "and cats=0";
        	$qis_reg = ($is_reg) ? "" : "and is_reg=1";
        	
        	$sql = "select * from $this->tn where onoff='1' and type='0' $qis_reg $qcate order by rand() limit 1";
            return $this->mysql->fetch_row($sql);
		}
		
		function getKolAnsw($id, $answer) {
			
			$sql = "select count(*) from $this->tn1 where vote_id='$id' and answer='$answer'";
            return $this->mysql->result($sql);
		}
		
		function addVote($vote_id, $ip, $vote, $news_id = 0) {
            
        	if (!$news_id) {
				
				if ($this->getKolVoteOnIp($vote_id, $ip)) return FALSE;
			
        		$sql  = "select body from $this->tn where id='$vote_id'";
            	$body = $this->mysql->result($sql);
            	
            	$body = explode("\n", $body);
            	$answer = $body[$vote-1];
            	if ($answer=="") return FALSE;
           	}
           	else {
           		if ($this->getKolRateOnIp($news_id, $ip)) return FALSE;
				$answer = $vote;	
			}
			
			$sql  = "insert into $this->tn1 values(null, '$vote_id', '$ip', '$answer', '$news_id')";
			if (!$this->mysql->query($sql)) return FALSE;
			
			return TRUE;           
        }
        
        function getKolRateOnIp($id, $ip) {
			            	
			$sql = "select count(*) from $this->tn1 where news_id='$id' and ip='$ip'";
            return $this->mysql->result($sql);
		}
		
		function getKolVoteOnIp($id, $ip) {
			            	
			$sql = "select count(*) from $this->tn1 where vote_id='$id' and ip='$ip'";
            return $this->mysql->result($sql);
		}
				
		function SumKolVotesNews($id) {
            
        	$sql = "select sum(answer), count(answer) from $this->tn1 where news_id='$id'";
            return $this->mysql->fetch_row($sql);
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
