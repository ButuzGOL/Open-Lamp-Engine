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
// Файл: other.class.php
//-----------------------------------------------------------------------------/
// Назначение: Класс для разного
//=============================================================================/
*/
    
    class other {
    	var $mysql, $tpl, $lang, $langa;

        function other($mysql_obj, $tpl_obj, $lang, $langa = 0) {
            $this->mysql = $mysql_obj;
            $this->tpl   = $tpl_obj;
            $this->lang  = $lang;
            $this->langa = $langa;
        }   
		
		function makeNormalDate($date, $type = 0) {
		
			$help = getdate($date);
			
			$date  = (strlen($help['mday'])==2) ? $help['mday']."." : "0".$help['mday'].".";
			$date .= (strlen($help['mon'])==2)  ? ($help['mon']).".".$help['year'] : "0".($help['mon']).".".$help['year'];
			
			if ($type) return $date;
			
			$time  = (strlen($help['hours'])==2)   ? $help['hours'].":"   : "0".$help['hours'].":";
			$time .= (strlen($help['minutes'])==2) ? $help['minutes'].":" : "0".$help['minutes'].":";
			$time .= (strlen($help['seconds'])==2) ? $help['seconds']     : "0".$help['seconds'];
			
			return $date." ".$time;	
		}    
		
		function makeToTime($date) {
			
			if (!$date) return 0;
			
			$a = explode(" ", $date);
			
			$Date = $a[0];
			$Time = $a[1]; 
			
			$a = explode(".", $Date);
			$day   = intval($a[0]);
			$month = intval($a[1]);
			$year  = intval($a[2]);
			
			$a = explode(":", $Time);
			$hour = intval($a[0]);
			$min  = intval($a[1]);
			$sec  = intval($a[2]);
			
			return mktime($hour, $min, $sec, $month, $day, $year);
			
		}
		
		function getMonthAb($month_number, $type = 0) {
			
			switch ($month_number) {
				case "01" : $month_name = (!$type) ? $this->lang['jan'] : $this->lang['jan1']; break;
				case "02" : $month_name = (!$type) ? $this->lang['feb'] : $this->lang['feb1']; break;
				case "03" : $month_name = (!$type) ? $this->lang['mar'] : $this->lang['mar1']; break;
				case "04" : $month_name = (!$type) ? $this->lang['apr'] : $this->lang['apr1']; break;
				case "05" : $month_name = (!$type) ? $this->lang['may'] : $this->lang['may1']; break;
				case "06" : $month_name = (!$type) ? $this->lang['jun'] : $this->lang['jun1']; break;
				case "07" : $month_name = (!$type) ? $this->lang['jul'] : $this->lang['jul1']; break;
				case "08" : $month_name = (!$type) ? $this->lang['aug'] : $this->lang['aug1']; break;
				case "09" : $month_name = (!$type) ? $this->lang['sep'] : $this->lang['sep1']; break;
				case "10" : $month_name = (!$type) ? $this->lang['oct'] : $this->lang['oct1']; break;
				case "11" : $month_name = (!$type) ? $this->lang['nov'] : $this->lang['nov1']; break;
				case "12" : $month_name = (!$type) ? $this->lang['dec'] : $this->lang['dec1']; break;
			}
			
			return $month_name;
			
		}
		
		function filterIp($ip) {
			
			$a = explode(".", $ip);
			
			if (count($a)!=4) return "";			
			
			if (intval($a[0]) < 1 || intval($a[0]) > 223) return "";
			if (intval($a[1]) < 0 || intval($a[1]) > 255) return "";
			if ((intval($a[2]) < 0 || intval($a[2]) > 255) && $a[2]!="*") return "";
			if ((intval($a[3]) < 0 || intval($a[3]) > 255) && $a[3]!="*") return "";
			
			return $ip;			
			 		
		}
		
		function changeText($table, $text0, $text1) {
            
            	if (@in_array("1", $table)) {
					$sql = "update ".NEWS." set short_story=replace(short_story, '$text0', '$text1')";
					if (!$this->mysql->query($sql)) return FALSE;
					
					$sql = "update ".NEWS." set full_story=replace(full_story, '$text0', '$text1')";
					if (!$this->mysql->query($sql)) return FALSE;
				}
				if (@in_array("2", $table)) {
					$sql = "update ".COMMENTS." set text=replace(text, '$text0', '$text1')";
					if (!$this->mysql->query($sql)) return FALSE;
				}
				if (@in_array("3", $table)) {
					$sql = "update ".PM." set text=replace(text, '$text0', '$text1')";
					if (!$this->mysql->query($sql)) return FALSE;
				}
				if (@in_array("4", $table)) {
					$sql = "update ".STATIK." set story=replace(story, '$text0', '$text1')";
					if (!$this->mysql->query($sql)) return FALSE;
				}
				
			return TRUE;           
        }
        
        function getBannerPlace($num_place) {
			
			switch ($num_place) {
				case "1" : $place = $this->langa['top'];      										               break;
				case "2" : $place = $this->langa['middle'];   										               break;
				case "3" : $place = $this->langa['bottom'];   										               break;
				case "4" : $place = $this->langa['top'].", ". $this->langa['middle']; 						       break;
				case "5" : $place = $this->langa['top'].", ". $this->langa['bottom'];       				       break;
				case "6" : $place = $this->langa['buttom'].", ". $this->langa['middle'];       				       break;
				case "7" : $place = $this->langa['top'].", ". $this->langa['middle'].", ". $this->langa['buttom']; break;
			}
			
			return $place;
		}
		
		function fileRead($file) {
			
			$f = @fopen($file, "r");
			if (!$f) return FALSE;
			
			$text = "";
			
			while(!@feof($f)) $text .= @fgets($f);
			
			@fclose($f);
			
			return $text;
		}
		
		function fileWrite($file, $text) {
			
			$f = @fopen($file, "w+");
			if (!$f) return FALSE;
			
			@fwrite($f, $text);
			
			@fclose($f);
			
			return $text;
		}
		
		function getDir($way) {

			$dir = @opendir(SITE_DIR. "/". $way);
			while ($folder = @readdir())
				if ($folder!="." && $folder!=".." && is_dir(SITE_DIR. "/". $way. "/". $folder)) 
					$folders[count($folders)] = $folder;
				
			@closedir($dir);			
			
			return $folders;
		}
		
		function makeHash() {
			
			$chars = "AEUYBDGHJLMNPQRSTVWXZ123456789";
			for($i = 0, $hash = ""; $i < 10; $i++)
				$hash .= $chars{mt_rand(0,29)};
				
			return md5($hash);
		}
		
		function makePass() {
			
			$chars = "AEUYBDGHJLMNPQRSTVWXZ123456789";
			for($i = 0, $pass = ""; $i < 10; $i++)
				$pass .= $chars{mt_rand(0,29)};
				
			return $pass;
		}
				
		function showMess($top, $result, $link, $tlink) {

			$frules["{TITLE}"]  = $top;
			$frules["{MIDDLE}"] = $result."<br /><br /><a href=\"$link\">$tlink</a>";                
         	
			$this->tpl->addhtml(TEMPLATES_DIR ."/show_mess.tpl", $frules);
     					
		}
		
		function isAllowAccess($user_group, $access) {
			
			if ($user_group==1 || !$access) return TRUE;
			
			$access = explode(",", $access);
			if (in_array($user_group, $access)) return TRUE;
			
			return FALSE;						
		}
		
		function showMessA($mess, $type = 0) {

        	$frules["{MESS}"] = $mess;
			$frules["{BC}"]   = (!$type) ? "#ffeb6e" : "#ff6e6e";
			$frules["{BGC}"]  = (!$type) ? "#fdf9bf" : "#fdbfbf";
						
			return $this->tpl->gethtml(ADMIN_TEMPLATES_DIR ."/show_mess.tpl", $frules);
     					
		}	
		
		function filterTpl($tpl) {

        	$tpl = str_replace("{TITLE}", "{*TITLE*}", $tpl);
     		$tpl = str_replace("{THEME}", "{*THEME*}", $tpl);
     		$tpl = str_replace("{HURL}", "{*HURL*}", $tpl);
     		$tpl = str_replace("{MESS1}", "{*MESS1*}", $tpl);
     		$tpl = str_replace("{MESS}", "{*MESS*}", $tpl);
     		
     		$tpl = "<!--".$tpl."-->"; 
     		
     		return $tpl;
		}
		
		function otfilterTpl($tpl) {

        	$tpl = str_replace("{*TITLE*}", "{TITLE}", $tpl);
     		$tpl = str_replace("{*THEME*}", "{THEME}", $tpl);
     		$tpl = str_replace("{*HURL*}", "{HURL}", $tpl);
     		$tpl = str_replace("{*MESS1*}", "{MESS1}", $tpl);
     		$tpl = str_replace("{*MESS*}", "{MESS}", $tpl);
     		
     		$tpl = stripslashes(substr($tpl, 4, -3));
     		
     		return $tpl;
		}		
		
		function strRepl($text) {
	    
	        $this->filter("/[']/", "&#039;", $text);
	        
	        return $text;
	    }
		
		function check($str, $type) {
            return @eregi($type, $str);
        }
        
        function filter($regexp,$with,&$str) {
            $str = preg_replace($regexp,$with,$str);
        }
        
	}
    
?>
