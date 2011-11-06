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
// Файл: template.class.php
//-----------------------------------------------------------------------------/
// Назначение: Класс для управления html шаблонами сайта
//=============================================================================/
*/
	
	class tpl {
		var $header = "", $middle = "", $footer = "";
                
		function tpl($header = "", $footer = "", $title = "") {
          
            if (is_file($header)) {
            	$this->header = join("", file($header));
                if ($title) $this->header = str_replace("{TITLE}", $title, $this->header);
            }
			
			if (is_file($footer)) $this->footer = join("", file($footer));
        }
                
        function addhtml($html, $rep_words = array()) {
        
            if (is_file($html)) $html = join("", file("$html"));
				
			if (count($rep_words))
        		foreach ($rep_words as $rule => $word)
            		$html = str_replace($rule, $word, $html);
        
        	$this->middle .= $html;
        }
        
	    function init($rep_words = array()) {
                
            $this->header .= $this->middle .$this->footer;
            
            if (count($rep_words))
            	foreach ($rep_words as $rule => $word)
                	$this->header = str_replace($rule, $word, $this->header);
            
	        echo $this->header;
        }
	}

?>
