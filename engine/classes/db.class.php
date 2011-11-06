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
// Файл: db.class.php
//-----------------------------------------------------------------------------/
// Назначение: Класс управления базой данных
//=============================================================================/
*/
    
    class db {
    	var $mysql, $tn = BANNED, $tn1 = BOOKMARKS, $tn2 = NEWS, $tn3 = USERS, $tn4 = COMMENTS, $tn5 = PM, $tn6 = VOTE, $tn7 = VOTES, $tn8 = STATIK;

        function db($mysql_obj) {
            $this->mysql = $mysql_obj;
		}
                
        function getTables() {
            
            $sql = "show tables";
            return $this->mysql->fetch_row($sql);
        }
        
        function makeOptim($tables) {
            
            if (!$tables) return FALSE;
			$opt = "optimize table ";
			foreach ($tables as $n) {
				
				$opt .= $n .", "; 
				
				if ($n==$this->tn) {
					$sql = "delete from $this->tn where date < ".time();
           			if (!$this->mysql->query($sql)) return FALSE;
            	}
            	
				if ($n==$this->tn1) {
					$sql = "delete from $this->tn1 where 0 = (select count(*) from $this->tn2 where news_id in (select id from $this->tn2))";
            		if (!$this->mysql->query($sql)) return FALSE;
            
					$sql = "delete from $this->tn1 where 0 = (select count(*) from $this->tn3 where user_id in (select id from $this->tn3))";
            		if (!$this->mysql->query($sql)) return FALSE;
            	}
            	
				if ($n==$this->tn4) {
					$sql = "delete from $this->tn4 where 0 = (select count(*) from $this->tn2 where news_id in (select id from $this->tn2))";
            		if (!$this->mysql->query($sql)) return FALSE;
            	}
            	
				if ($n==$this->tn5) {
					$sql = "delete from $this->tn5 where 0 = (select count(*) from $this->tn3 where user_id in (select id from $this->tn3)) and  0 = (select count(*) from $this->tn3 where user_from in (select id from $this->tn3))";
            		if (!$this->mysql->query($sql)) return FALSE;
            	}
                        	
            	if ($n==$this->tn7) {
            		$sql = "delete from $this->tn7 where 0 = (select count(*) from $this->tn6 where vote_id in (select id from $this->tn6)) and vote_id<>0";
            		if (!$this->mysql->query($sql)) return FALSE;
            
            		$sql = "delete from $this->tn7 where 0 = (select count(*) from $this->tn2 where news_id in (select id from $this->tn2)) and news_id<>0";
            		if (!$this->mysql->query($sql)) return FALSE;
            
            		$sql = "delete from $this->tn7 where locate(answer, (select body from $this->tn6 where id=vote_id))=0 and vote_id<>0";
            		if (!$this->mysql->query($sql)) return FALSE;
          		}
          	
			}
			
			$opt = substr($opt, 0, -2);
			if (!$this->mysql->query($opt)) return FALSE;
          	
			return TRUE;
        }
        
        function makeRepair($tables) {
            
            if (!$tables) return FALSE;
            
			$rep = "repair table ";
			
			foreach ($tables as $n)	$rep .= $n .", "; 
			              					
			$rep = substr($rep, 0, -2);
			
			if (!$this->mysql->query($rep)) return FALSE;
          	
          	return TRUE;  	
        }
        
        function makeVOptim($news_date, $comm_date, $pm_date, $vote_date, $statik_date) {
           		
           		if (!$news_date && !$comm_date && !$pm_date && !$vote_date && !$statik_date) return FALSE;
           				
				if ($news_date!=0) {
					$sql = ($news_date==1) ? "delete from $this->tn2" : "delete from $this->tn2 where date < '$news_date'";
                	if (!$this->mysql->query($sql)) return FALSE;
                	
					$sql = "delete from $this->tn6 where 0 = (select count(*) from $this->tn2 where
id in (select vote_id from $this->tn2))";
                	if (!$this->mysql->query($sql)) return FALSE;
                	
                	$sql = "delete from $this->tn7 where 0 = (select count(*) from $this->tn2 where
news_id in (select id from $this->tn2)) and news_id<>0";
                	if (!$this->mysql->query($sql)) return FALSE;
                }
                
                if ($comm_date!=0) {
					$sql = ($comm_date==1) ? "delete from $this->tn4" : "delete from $this->tn4 where date < '$comm_date'";
                	if (!$this->mysql->query($sql)) return FALSE;
                }
                
                if ($pm_date!=0) {
					$sql = ($pm_date==1) ? "delete from $this->tn5" : "delete from $this->tn5 where date < '$pm_date'";
                	if (!$this->mysql->query($sql)) return FALSE;
                }
                
                if ($vote_date!=0) {
					$sql = ($vote_date==1) ? "delete from $this->tn6 where type='0'" : "delete from $this->tn6 where type='0' and date < '$vote_date'";
                	if (!$this->mysql->query($sql)) return FALSE;
                }
                
                if ($statik_date!=0) {
					$sql = ($statik_date==1) ? "delete from $this->tn8" : "delete from $this->tn8 where date < '$statik_date'";
                	if (!$this->mysql->query($sql)) return FALSE;
                }
                
                return TRUE;	
        }
		
		function makeBackUp() {
           							
			$str = MYSQL_DB ." " .date("Y.m.d H:i:s"). "\n\n";
			
			$sql    = "show tables";	
			$result = $this->mysql->query($sql);               
			while ($row = $this->mysql->fetch_array($result)) $tables[] = $row[0];
    		
			foreach ($tables as $table) {
			
				$sql    = "show create table $table";
				$result = $this->mysql->query($sql);
				$tab    = $this->mysql->fetch_array($result);
        		
				$tab = preg_replace('/(default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP|DEFAULT CHARSET=\w+|COLLATE=\w+|character set \w+|collate \w+)/i', '/*!40101 \\1 */', $tab); 
				
				$str .= "drop table if exists `$table`;\n\n" .strtolower($tab[1]). ";\n\n";					
				
				$sql    = "select * from `$table`";
				$result = $this->mysql->fetch_row($sql);
				if ($result) {
					$str .= "insert into `$table` values";
	           		$h    = 0;	
					foreach ($result as $row) {
					
						for($k = 0; count($row) > $k; $k++) $row[$k] = isset($row[$k]) ? "'" .$row[$k]. "'" : "NULL";						
					
						$str .= ($h == 0 ? "" : ",") . "\n(" . implode(", ", $row) . ")";			
					
						$h = 1;
						}
					$str .= ";\n\n";			
    			}
			}	
    		
			$name = MYSQL_DB.'_'.date("Y-m-d_H-i-s");
        	$fp   = @fopen(DB_BACKUP_DIR."/".$name.".sql", "w");
        	
			@fwrite($fp, $str); 
			
			if (@!fclose($fp)) return FALSE;
			
			return TRUE;
        }
		
		function getBackUpFiles() {
        				
			$dir = @opendir(DB_BACKUP_DIR);
			while ($file = @readdir($dir)) {
				if ($file!="." && $file!=".." && is_file(DB_BACKUP_DIR ."/" .$file) && substr($entry,0,1)!='.' && strtolower(substr($file, -3))=="sql") {
		    	
					$dbbackup[$i]['name'] = $file;
			    	$dbbackup[$i]['file'] = DB_BACKUP_DIR ."/" .$file; 
					$i++;			
				}
			}
	    	@closedir($dir);
	    	
			if (!count($dbbackup)) return FALSE;
			
			return $dbbackup;
		}		
		
		function makeRestoreBackUp($file) {
                        
        	$fp = @fopen($file, "r");
        	
			$str = "";
			while ($s = @fread($fp, 4096)) $str .= $s; 
			
			$q = explode("\n\n", $str);

			for ($i = 0; $i < count($q); $i++) {
				
				if (preg_match("/^drop table if exists `?([^` ]+)`?/i", $q[$i])) if (!$this->mysql->query($q[$i])) return FALSE;	
				
				if (preg_match("/^create table `?([^` ]+)`? /i", $q[$i])) {
					$q[$i] = preg_replace("/engine\s?=/", "type=", $q[$i]);
					if (!$this->mysql->query($q[$i])) return FALSE;
				}
						
				if (preg_match("/^insert into `?([^` ]+)`? /i", $q[$i])) if (!$this->mysql->query($q[$i])) return FALSE;
			}
			
			if (@!fclose($fp)) return FALSE;
			
			return TRUE;	
        }
    }		
	
?>
