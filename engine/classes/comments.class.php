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
// Файл: comments.class.php
//-----------------------------------------------------------------------------/
// Назначение: Класс управления комментариями новостей
//=============================================================================/
*/
    
    class comments {
    	var $mysql, $tn = COMMENTS;

        function comments($mysql_obj) {
            $this->mysql = $mysql_obj;
        }
   
        function add($news_id, $user_id, $date, $autor, $email, $icq, $text, $ip) {
            
            $sql = "insert into $this->tn values(null, '$news_id', '$user_id', '$date', '$autor', '$email', '$icq', '$text', '$ip')";
			if (!$this->mysql->query($sql)) return FALSE;
			
			return TRUE;           
        }
                
        function get($news_id, $page, $kol_comm_on_page, $comm_msort) {
            
        	$page = ($page=="") ? 0 : $page;
        	
        	if (!$this->check($news_id, "/^[0-9]+$/")) return FALSE;
            if (!$this->check($page, "/^[0-9]+$/")) return FALSE;
            
            switch ($comm_msort) {
				case "1" : $msort = "desc"; break;
				case "2" : $msort = "asc";  break;
			}
			
			$sql = "select * from $this->tn where news_id='$news_id' order by id $msort limit ".$page * $kol_comm_on_page.",$kol_comm_on_page";           
            return $this->mysql->fetch_row($sql);
        }
		
		function getOne($id, $pole) {
		
        	if (!$this->check($id, "/^[0-9]+$/")) return FALSE;
			
			$sql = "select $pole from $this->tn where id='$id'";
            return $this->mysql->result($sql);
        }
		
		function kolInNews($news_id) {
                    
        	if (!$this->check($news_id, "/^[0-9]+$/")) return FALSE;
            
            $sql = "select count(*) from $this->tn where news_id='$news_id'";
            return $this->mysql->result($sql);
        }       
       
      	function del($id) {
	    
	       	if (!$this->check($id, "/^[0-9]+$/")) return FALSE;
		
			$sql = "delete from $this->tn where id='$id'";
            if (!$this->mysql->query($sql)) return FALSE;
            
            return TRUE; 			                             
        }
                
		function getStatistik() {
			
        	$sql1 = "select count(*) from $this->tn";
            $sql2 = "select count(*) from $this->tn where date > ".(time() - 86400)." and date < ".time();
            $sql3 = "select count(*) from $this->tn where date > ".(time() - 7*86400)." and date < ".time();
			$sql4 = "select count(*) from $this->tn where date > ".(time() - 30*86400)." and date < ".time();
			
			$statistik['mon']  = $this->mysql->result($sql4);
			$statistik['week'] = $this->mysql->result($sql3);
			$statistik['day']  = $this->mysql->result($sql2);
			$statistik['kol']  = $this->mysql->result($sql1);
			
			return $statistik;
		}
		
		function getKolUserComm($user_id) {
			
        	if (!$this->check($user_id, "/^[0-9]+$/")) return FALSE;
        	
        	$sql = "select count(*) from $this->tn where user_id='$user_id'";
			return $this->mysql->result($sql);
		}
		
		function update($id, $text) {
                       
            $sql = "update $this->tn set text='$text' where id='$id'";
            if (!$this->mysql->query($sql)) return FALSE;
			
			return TRUE;
        }
		
        function check($str, $type) {
            return preg_match($type, $str);
        }  
	}
    		
?>
