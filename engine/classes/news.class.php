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
// Файл: news.class.php
//-----------------------------------------------------------------------------/
// Назначение: Класс управления новостями
//=============================================================================/
*/
    
    class news {
    	var $mysql, $tn = NEWS, $tn1 = VOTE, $tn2 = BOOKMARKS;

        function news($mysql_obj) {
        	$this->mysql = $mysql_obj;
        }
   
        function add($auter, $date, $short_story, $full_story, $title, $keywords, $cats, $allow_comm, $allow_main, $allow_rate, $vote_id, $onoff, $news_read, $expires, $moderation, $fixed, $access, $descr, $user_id) {
           
            $sql = "insert into $this->tn values(null, '$auter', '$date', '$short_story', '$full_story', '$title', '$keywords', '$cats', '$allow_comm', '$allow_main', '$allow_rate', '$vote_id', '$onoff', '$news_read', '$expires', '$moderation', '$fixed', '$access', '$descr', '$user_id')";
			if (!$this->mysql->query($sql)) return FALSE;
			
			return TRUE;           
        }
                
        function get($id = 0 , $k = 0, $user_id = 0) {
           
        	if (!$this->check($id, "/^[0-9]+$/")) return FALSE;
        	
        	$qshow = ($k)       ? "and onoff='1' and (expires > ".time()." or expires=0) and date < ".time() : "";
			$quser = ($user_id) ? "where user_id = '$user_id'" : "";
			
			$sql = (!$id) ? "select * from $this->tn $quser order by fixed desc, date desc" : "select * from $this->tn where id='$id' $qshow";
           	return $this->mysql->fetch_row($sql);  
        }
        
        function getS($page, $kol_news_on_page, $year = 0, $mon = 0, $day = 0, $main = true, $news_sort = 1, $news_msort = 1, $cate = 0) {
            
        	$page = ($page=="") ? 0 : $page;
			
			if (!$this->check($page, "/^[0-9]+$/")) return FALSE;
			if (!$this->check($year, "/^[0-9]+$/")) return FALSE;
        	if (!$this->check($mon, "/^[0-9]+$/")) return FALSE;
			if (!$this->check($day, "/^[0-9]+$/")) return FALSE;
			if ($mon > 12) return FALSE;
			
			switch ($news_sort) {
				case "1" : $sort = "date";      break;
				case "2" : $sort = "news_read"; break;
				case "3" : $sort = "title";     break;
			}
			
			switch ($news_msort) {
				case "1" : $msort = "desc"; break;
				case "2" : $msort = "asc";  break;
			}
			
			$qcate = ($cate) ? "and (locate(',$cate,', concat(',',cats,','))>0 or cats='0')" : "";
			$qmain = ($main) ? "and allow_main='1'" : ""; 
							
			if ($mon && $year && !$day) {
				$sd = mktime(0, 0, 0, $mon, 1, $year);
            	$fd = mktime(23, 59, 59, $mon, date('t', mktime(0, 0, 0, $mon, 1, $year)), $year);
            	$qdate = "and date > $sd and date < $fd";
			} 
			elseif ($mon && $year && $day) {
			
				if (!checkdate($mon, $day, $year)) return FALSE;
				
				$sd = mktime(0, 0, 0, $mon, $day, $year);
            	$fd = mktime(23, 59, 59, $mon, $day, $year);
            	$qdate = "and date > $sd and date < $fd";
			} 
			else $qdate = ""; 
		
        	$sql  = "select * from $this->tn where onoff='1' $qmain and date < ".time()." and (expires > ".time()." or expires=0) $qdate $qcate order by fixed desc, $sort $msort limit ".$page * $kol_news_on_page.",$kol_news_on_page";
                	
		    return $this->mysql->fetch_row($sql);
        }
        
        function getB($page, $kol_news_on_page, $user_id, $news_sort, $news_msort) {
            
        	$page = ($page=="") ? 0 : $page;
        	
        	if (!$this->check($page, "/^[0-9]+$/")) return FALSE;
			
			$sql = "select news_id from $this->tn2 where user_id='$user_id'";
            $inf = $this->mysql->fetch_row($sql);
            if (!$inf) return FALSE;
            
            switch ($news_sort) {
				case "1" : $sort = "date";      break;
				case "2" : $sort = "news_read"; break;
				case "3" : $sort = "title";     break;
			}
			
			switch ($news_msort) {
				case "1" : $msort = "desc"; break;
				case "2" : $msort = "asc";  break;
			}
            
            $str = ",";
			foreach ($inf as $n) $str .= $n[0].",";
	       	
	       	$sql = "select * from $this->tn where onoff='1' and (expires > ".time()." or expires=0) and date < ".time()." and locate(concat(',',id,','), '$str')>0 order by $sort $msort limit ".$page * $kol_news_on_page.",$kol_news_on_page";
	       	return $this->mysql->fetch_row($sql);
	    }
        
        function kolNewsB($user_id) {
            
        	$sql = "select news_id from $this->tn2 where user_id='$user_id'";
            $inf = $this->mysql->fetch_row($sql);
            
            if (!$inf) return FALSE;
            
            $str = ",";
			foreach ($inf as $n) $str .= $n[0].",";
        	
        	$sql = "select count(*) from $this->tn where onoff='1' and locate(concat(',',id,','), '$str')>0 and (expires > ".time()." or expires=0) and date < ".time();
		    return $this->mysql->result($sql);
        }
        
        function kolNewsS($year = 0, $mon = 0, $day = 0, $main = true, $cate = 0) {
            	
			$qcate = ($cate) ? "and (locate(',$cate,', concat(',',cats,','))>0 or cats='0')" : "";
			$qmain = ($main) ? "and allow_main='1'" : "";
			 
			if ($mon && $year && !$day) {
				$sd = mktime(0, 0, 0, $mon, 1, $year);
            	$fd = mktime(23, 59, 59, $mon, date('t', mktime(0, 0, 0, $mon, 1, $year)), $year);
            	$qdate = "and date > $sd and date < $fd";
			} 
			elseif ($mon && $year && $day) {
				if (!checkdate($mon, $day, $year)) return FALSE;
				$sd = mktime(0, 0, 0, $mon, $day, $year);
            	$fd = mktime(23, 59, 59, $mon, $day, $year);
            	$qdate = "and date > $sd and date < $fd";
			}
			else $qdate = "";
			$sql = "select count(*) from $this->tn where onoff='1' $qcate $qmain $qdate and (expires > ".time()." or expires=0) and date < ".time();
		    return $this->mysql->result($sql);
        }

		function del($id) {
        	
        	if (!$this->check($id, "/^[0-9]+$/")) return FALSE;
			if (!$this->get($id)) return FALSE; 
			
			$sql = "select vote_id from $this->tn where id='$id'";
			$vote_id = $this->mysql->result($sql);
			
			$sql = "delete from $this->tn1 where id='$vote_id'";
			$result = $this->mysql->query($sql);
			
			$sql = "delete from $this->tn where id='$id'";
            if (!$this->mysql->query($sql)) return FALSE;
            
            return TRUE; 			                             
	    }
                
        function update($id, $date, $short_story, $full_story, $title, $keywords, $cats, $allow_comm, $allow_main, $allow_rate, $vote_id, $onoff, $expires, $moderation, $fixed, $access, $descr) {
                        
            $sql = "update $this->tn set date='$date', short_story='$short_story', full_story='$full_story', title='$title', keywords='$keywords', cats='$cats', allow_comm='$allow_comm', allow_main='$allow_main', allow_rate='$allow_rate', vote_id='$vote_id', onoff='$onoff', expires='$expires', moderation='$moderation', fixed='$fixed', access='$access', descr='$descr' where id='$id'";
            if (!$this->mysql->query($sql)) return FALSE;
			
			return TRUE;
        }
        
        function updateOne($id, $pole, $value) {
        	
    		$sql = "update $this->tn set $pole='$value' where id='$id'";
			if (!$this->mysql->query($sql)) return FALSE;
			
			return TRUE;				
        }
        
        function makeIn($action, $selected) {
        	
			if ($action=="" || !count($selected)) return FALSE;
            
			switch ($action) { 

				case "1"   : $rn = "onoff";      $mk = "1"; break;
				case "1_1" : $rn = "onoff";      $mk = "0"; break;
				case "2"   : $rn = "moderation"; $mk = "1"; break;
				case "2_1" : $rn = "moderation"; $mk = "0"; break;
				case "3"   : $rn = "fixed";      $mk = "1"; break;
				case "3_1" : $rn = "fixed";      $mk = "0"; break;
				case "4"   : $rn = "allow_comm"; $mk = "1"; break;
				case "4_1" : $rn = "allow_comm"; $mk = "0"; break;
				case "5"   : $rn = "allow_rate"; $mk = "1"; break;
				case "5_1" : $rn = "allow_rate"; $mk = "0"; break;
				case "6"   : $rn = "allow_main"; $mk = "1"; break;
				case "6_1" : $rn = "allow_main"; $mk = "0"; break;
			
			}
			
			if ($action=="7") {
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
		
		function newsReadPP($id) {
			
			if (!$this->check($id, "/^[0-9]+$/")) return FALSE;
            
            $sql = "update $this->tn set news_read=news_read+1 where id='$id'";
            if (!$this->mysql->query($sql)) return FALSE;
			
			return TRUE;
        }
    	
		function getKM() {
            
        	$sql = "select date from $this->tn where onoff='1' and (expires > ".time()." or expires=0) and date < ".time(). " order by date";
        	$inf = $this->mysql->fetch_row($sql);
		    
			for ($i = 0, $p = 0; $inf[$i]; $i++) {
				$date = getdate($inf[$i][0]);
				for ($j = 0, $k = 0; $a[$j]; $j++) {
					if ($date['year']==$a[$j]['year'] && $date['mon']==$a[$j]['mon']) {$a[$j]['kol']++; $k = 1; break;}
				}
				if (!$k) {
					$a[$p]['year'] = $date['year'];
					$a[$p]['mon']  = $date['mon'];
					$a[$p]['kol']  = 1;
					$p++;
				}
			}
			
			return $a;
        }
        
        function getKP() {
	  		
	  		$sql = "select id, title, news_read from $this->tn where onoff='1' and (expires > ".time()." or expires=0) and date < ".time(). " order by news_read desc limit 15";	
			return $this->mysql->fetch_row($sql);    
        }
        
        function getOne($id, $pole) {
			
			if (!$this->check($id, "/^[0-9]+$/")) return FALSE;
						
			$sql = "select $pole from $this->tn where id='$id'";
            return $this->mysql->result($sql);
        }
		
		function checkNewsOnDate($year, $mon, $day) {
			
			$sd = mktime(0, 0, 0, $mon, $day, $year);
            $fd = mktime(23, 59, 59, $mon, $day, $year);
        	$sql = "select * from $this->tn where onoff='1' and date > $sd and date < $fd and (expires > ".time()." or expires=0) and date < ".time();
            
            return $this->mysql->fetch_row($sql);
        }
		
		function getStatistik() {
				
        	$sql1 = "select count(*) from $this->tn";
            $sql2 = "select count(*) from $this->tn where onoff='1' and date < ".time();
            $sql3 = "select count(*) from $this->tn where onoff='1' and allow_main='1' and date < ".time();
            $sql4 = "select count(*) from $this->tn where moderation='1'";
			$sql5 = "select count(*) from $this->tn where onoff='1' and date > ".(time() - 86400)." and date < ".time();
            $sql6 = "select count(*) from $this->tn where onoff='1' and date > ".(time() - 7*86400)." and date < ".time();
			$sql7 = "select count(*) from $this->tn where onoff='1' and date > ".(time() - 30*86400)." and date < ".time();
			
			$statistik['mon']  = $this->mysql->result($sql7);
			$statistik['week'] = $this->mysql->result($sql6);
			$statistik['day']  = $this->mysql->result($sql5);
			$statistik['mode'] = $this->mysql->result($sql4);
			$statistik['main'] = $this->mysql->result($sql3);				
			$statistik['opub'] = $this->mysql->result($sql2);
			$statistik['kol']  = $this->mysql->result($sql1);
			
			return $statistik;
        }
		
		function getKolUserNews($user_id) {
			
			$sql = "select count(*) from $this->tn where user_id='$user_id'";
			return $this->mysql->result($sql);
        }
		
		function getSearch($keyword, $autor = "", $w_find = 0, $search_date = 0, $type_search_date = 0, $sort = 0, $msort = 0, $cate = 0) {
        	
        	if ($keyword=="" && $autor=="") return FALSE;
        	
        	$qkeyword = "";
			if ($keyword) $qkeyword .= "title like '%$keyword%' or short_story like '%$keyword%' or full_story like '%$keyword%' or keywords like '%$keyword%'";
			if ($autor && $keyword) $qkeyword .= " or autor like '%$autor%'";
			elseif($autor) $qkeyword .= "autor like '%$autor%'";
        	
        	$qdate = "";
        	if ($search_date && !$type_search_date) $qdate .= " and date > ".(time() - 86400 * $search_date);
        	if ($search_date && $type_search_date)  $qdate .= " and date < ".(time() - 86400 * $search_date);
        	
        	$qcate = ($cate) ? "and (locate(',$cate,', concat(',',cats,','))>0 or $cate='0')" : "";
							
			switch ($sort) {
				case "0" : $sort = "date";      break;
				case "1" : $sort = "title";     break;
				case "2" : $sort = "news_read"; break;
				case "3" : $sort = "autor";     break;
			}
			
			switch ($msort) {
				case "0" : $msort = "desc"; break;
				case "1" : $msort = "asc";  break;
			}
						
        	$sql  = "select * from $this->tn where ($qkeyword) and onoff='1' and (expires > ".time()." or expires=0) and date < ".time()." $qdate $qcate order by $sort $msort";
        
		    return $this->mysql->fetch_row($sql);
		}
		
        function check($str, $type) {
            return preg_match($type, $str);
        }  
	}
?>
