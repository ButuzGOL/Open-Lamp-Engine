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
// Файл: bbcodes.class.php
//-----------------------------------------------------------------------------/
// Назначение: Класс управления ббкодами 
//=============================================================================/
*/	
    
    class bbcodes {
    			
		function filter($text, $hide = 1) {		
								
						
			$text = preg_replace("#\[(left|right|center)\](.+?)\[/\\1\]#is", "<div style=\"text-align:\\1;\">\\2</div>", $text);
			
			$text = preg_replace("#\[b\](.+?)\[/b\]#is", "<span style=\"font-weight:bold;\">\\1</span>", $text);
			$text = preg_replace("#\[i\](.+?)\[/i\]#is", "<span style=\"font-style:italic;\">\\1</span>", $text);
			$text = preg_replace("#\[u\](.+?)\[/u\]#is", "<span style=\"text-decoration:underline;\">\\1</span>", $text);
			$text = preg_replace("#\[s\](.+?)\[/s\]#is", "<span style=\"text-decoration:line-through;\">\\1</span>", $text);
						
			$text = preg_replace("#\[font=([^\]]+)\](.+?)\[/font\]#is", "<span style=\"font-family:\\1;\">\\2</span>", $text);
			$text = preg_replace("#\[size=([^\]]+)\](.+?)\[/size\]#is", "<span style=\"font-size:\\1px;\">\\2</span>", $text);
			$text = preg_replace("#\[color=([^\]]+)\](.+?)\[/color\]#is", "<span style=\"color:\\1;\">\\2</span>", $text);
			
			$text = preg_replace("#\[ileft\](.+?)\[/ileft\]#is", "<span style=\"float:left; padding-right:15px;\">\\1</span>", $text);
			$text = preg_replace("#\[iright\](.+?)\[/iright\]#is", "<span style=\"float:right; padding-left:15px;\">\\1</span>", $text);
			$text = preg_replace("#\[img=([^\]]+)\](.*?)\[/img\]#is", "<img src=\"\\1\" alt=\"\\2\" title=\"\\2\" />", $text);
			
			$text = preg_replace("#\[url=([^\]]+)\](.+?)\[/url\]#is", "<a href=\"\\1\">\\2</a>", $text);
																									
			if ($hide) {
			    $text = str_replace("[hide]",  "", $text);
			    $text = str_replace("[/hide]", "", $text);
			}
			else $text = preg_replace("'\[hide\](.*?)\[/hide\]'si", "", $text);
								
			return $text;
		}
	}
    		?>
