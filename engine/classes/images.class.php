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
// Файл: email.class.php
//-----------------------------------------------------------------------------/
// Назначение: Класс управления картинками
//=============================================================================/
*/    
    
    class images {
    	var $dest_dir = IMAGES_DIR, $allowable = array("bmp", "gif", "jpg", "png");
    	
        function add($images) {
        	
			foreach($images as $image) {
							
				if (file_exists(SITE_DIR. $this->dest_dir."/".strtolower($image['name']))) return FALSE;
											
				if (!in_array(strtolower(substr($image['name'], -3)), $this->allowable)) return FALSE;	
			}
	       
	        foreach ($images as $image) 	        	
        		if (@!copy($image['file'], SITE_DIR. "/". $this->dest_dir."/".strtolower($image['name']))) return FALSE;
				
			return TRUE;      	
		}
                
        function get() {
        	 
			$i = 0;
			
			$dir = @opendir(SITE_DIR."/". $this->dest_dir);
			
			$images = array();
			while ($file = @readdir($dir)) {
				if ($file!="." && $file!=".." && is_file(SITE_DIR. "/" .$this->dest_dir."/".$file) && substr($entry, 0, 1)!="." && in_array(strtolower(substr($file, -3)),$this->allowable)) {
		    		
			    	$images[$i]['name'] = $file;
			    	$images[$i]['file'] = SITE_DIR. "/". $this->dest_dir ."/" .$file;
					$images[$i]['img']  = URL. "/". $this->dest_dir ."/" .$file; 
					$i++;	
							
				}
			}
	    	@closedir($dir);
	    	
			if (!count($images)) return FALSE;
			
			return $images;
		}
		
		function del($file) {
			
			if (!$this->check($file, "/^[0-9a-zA-Z-_.]+$/")) return FALSE;
			if (!in_array(strtolower(substr($file, -3)), $this->allowable)) return FALSE;
		
			if (@!unlink(SITE_DIR. "/". $this->dest_dir ."/" .$file)) return FALSE;
			
			return TRUE;			
	    }
        
        function makeIn($action, $selected) {
			           
			if ($action=="" || !count($selected)) return FALSE;
	            		
			if ($action=="1") {
				for ($i = 0; $selected[$i]; $i++) {
					
					if (!$this->check($selected[$i], "/^[0-9a-zA-Z-_.]+$/")) return FALSE;
					if (!in_array(strtolower(substr($selected[$i], -3)), $this->allowable)) return FALSE;
		
					if (!@unlink(SITE_DIR. "/". $this->dest_dir ."/" .$selected[$i])) return FALSE;
				}
				
				return TRUE;
			}
		
			return FALSE;
		}
    	
    	function check($str, $type) {
        	return preg_match($type, $str);
        }  
	}

?>
