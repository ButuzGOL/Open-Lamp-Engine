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
// Файл: captcha.class.php
//-----------------------------------------------------------------------------/
// Назначение: Класс управления антибот кодом
//=============================================================================/
*/

// ---------- ---------- ---------- ---------- ----------
// Automatic test to tell computers and humans apart
// Copyright by Kruglov Sergei, 2006
// www.captcha.ru, www.kruglov.ru
// ---------- ---------- ---------- ---------- ----------	
    
    class captcha {
		
		var $alphabet = "0123456789abcdefghijklmnopqrstuvwxyz"; 
		
		var $width  = 120;
		var $height = 50;
		
		var $fluctuation_amplitude = 2;
		
		var $no_spaces = true;
		
		var $jpeg_quality = 100;
		
		var $keystring = ""; 
	
		var $allowed_symbols = "023456789"; 
		
		var $length_min = 4; 
		var $length_max = 5; 
		var $length     = 0; 
		
		function genString() {
			
			$length = mt_rand($this->length_min, $this->length_max);
			$this->length = $length;
			
			while (true) { 
				$this->keystring = "";
				for ($i = 0; $i < $length ; $i++) {
					$this->keystring .= $this->allowed_symbols{ mt_rand(0, strlen($this->allowed_symbols) -1) };
				}
				if (!preg_match("/cp|cb|ck|c6|c9|rn|rm|co|do/", $this->keystring)) break;
			}
		}
		
		function genImage() {
	
			$foreground_color = array(mt_rand(0, 100), mt_rand(0, 100), mt_rand(0, 100));
			$background_color = array(255, 255, 255); 
	
			$fonts = array();
			$fontsdir_absolute = SITE_DIR."/".FONTS_DIR; 
	
			if ($handle = opendir($fontsdir_absolute)) { 
				while (false !== ($file = readdir($handle))) {
					if (preg_match("/\.png$/i", $file)) {
						$fonts[] = $fontsdir_absolute."/".$file;
					}
				}
			    closedir($handle);
			}
	
			$alphabet_length = strlen($this->alphabet);
			
			while (true) {
				$font_file = $fonts[mt_rand(0, count($fonts) - 1)]; 
				$font = imagecreatefrompng($font_file);
				$black = imagecolorallocate($font, 0, 0, 0);
				$fontfile_width = imagesx($font);
				$fontfile_height = imagesy($font) - 1;
				$font_metrics = array();
				$symbol = 0;
				$reading_symbol = false;
	
				for ($i = 0; $i < $fontfile_width && $symbol < $alphabet_length; $i++) {
					$transparent = (imagecolorat($font, $i, 0) >> 24) == 127;
	
					if (!$reading_symbol && !$transparent) {
						$font_metrics[$this->alphabet{$symbol}] = array("start" => $i);
						$reading_symbol = true;
						continue;
					}
	
					if ($reading_symbol && $transparent) {
						$font_metrics[$this->alphabet{$symbol}]['end'] = $i;
						$reading_symbol = false;
						$symbol++;
						continue;
					}
				}
	
				$img = imagecreatetruecolor($this->width, $this->height);
	
				$white = imagecolorallocate($img, 255, 255, 255);
				$black = imagecolorallocate($img, 0, 0, 0);
	
				imagefilledrectangle($img, 0, 0, $this->width - 1, $this->height - 1, $white);
	
				$x = 1;
				$shift = 0;
				
				for ($i = 0; $i < $this->length; $i++) {
					$m = $font_metrics[$this->keystring{$i}];
	
					$y = mt_rand(-$this->fluctuation_amplitude, $this->fluctuation_amplitude) + ($this->height - $fontfile_height) / 2 + 2;
						
					if ($this->no_spaces) {
						$shift = 0;
						if ($i > 0) {
							$shift = 1000;
							for ($sy = 1; $sy < $fontfile_height - 15; $sy += 2) {
								for ($sx = $m['start'] - 1; $sx < $m['end']; $sx++) {
									$rgb = imagecolorat($font, $sx, $sy);
									$opacity = $rgb >> 24;
									if ($opacity < 127) {
										$left = $sx - $m['start'] + $x;
										$py = $sy + $y;
										for ($px = min($left, $this->width - 1); $px > $left - 15 && $px >= 0; $px--) {
											$color = imagecolorat($img, $px, $py) & 0xff;
											if ($color + $opacity < 190) {
												if ($shift > $left-$px) {
													$shift = $left - $px;
												}
												break;
											}
										}
										break;
									}
								}
							}
						}
					} else $shift = 1;
					
					imagecopy($img, $font, $x - $shift, $y, $m['start'], 1, $m['end'] - $m['start'], $fontfile_height);
					
					$x += $m['end'] - $m['start'] - $shift;
				}
				if ($x < $this->width - 10) break; 
			}
			$center = $x/2;
			
			$img2 = imagecreatetruecolor($this->width, $this->height);
			$foreground = imagecolorallocate($img2, $foreground_color[0], $foreground_color[1], $foreground_color[2]);
			$background = imagecolorallocate($img2, $background_color[0], $background_color[1], $background_color[2]);
			imagefilledrectangle($img2, 0, $this->height, $this->width, $this->height+12, $foreground);
				
			$rand1 = mt_rand(750000, 1200000) / 10000000;
			$rand2 = mt_rand(750000, 1200000) / 10000000;
			$rand3 = mt_rand(750000, 1200000) / 10000000;
			$rand4 = mt_rand(750000, 1200000) / 10000000;
			$rand5 = mt_rand(0, 3141592) / 500000;
			$rand6 = mt_rand(0, 3141592) / 500000;
			$rand7 = mt_rand(0, 3141592) / 500000;
			$rand8 = mt_rand(0, 3141592) / 500000;
			$rand9 = mt_rand(330, 420) / 110;
			$rand10 = mt_rand(330, 450) / 110;
	
			for ($x = 0; $x < $this->width; $x++) {
				for ($y = 0; $y < $this->height; $y++) {
					$sx = $x + (sin($x * $rand1 + $rand5) + sin($y * $rand3 + $rand6)) * $rand9 - $this->width / 2 + $center + 1;
					$sy = $y + (sin($x * $rand2 + $rand7) + sin($y * $rand4 + $rand8)) * $rand10;
	
					if ($sx < 0 || $sy < 0 || $sx >= $this->width - 1 || $sy >= $this->height - 1) {
						$color = 255;
						$color_x = 255;
						$color_y = 255;
						$color_xy = 255;
					} else {
						$color = imagecolorat($img, $sx, $sy) & 0xFF;
						$color_x = imagecolorat($img, $sx + 1, $sy) & 0xFF;
						$color_y = imagecolorat($img, $sx, $sy + 1) & 0xFF;
						$color_xy = imagecolorat($img, $sx + 1, $sy + 1) & 0xFF;
					}
	
					if ($color == 0 && $color_x == 0 && $color_y == 0 && $color_xy == 0) {
						$newred = $foreground_color[0];
						$newgreen = $foreground_color[1];
						$newblue = $foreground_color[2];
					} else if ($color == 255 && $color_x == 255 && $color_y == 255 && $color_xy == 255) {
						$newred = $background_color[0];
						$newgreen = $background_color[1];
						$newblue = $background_color[2];	
					} else {
						$frsx = $sx - floor($sx);
						$frsy = $sy - floor($sy);
						$frsx1 = 1 - $frsx;
						$frsy1 = 1 - $frsy;
						$newcolor = (
							$color    * $frsx1 * $frsy1 +
							$color_x  * $frsx  * $frsy1 +
							$color_y  * $frsx1 * $frsy  +
							$color_xy * $frsx  * $frsy);
	
						if ($newcolor > 255) $newcolor = 255;
						$newcolor = $newcolor / 255;
						$newcolor0 = 1 - $newcolor;
	
						$newred	  = $newcolor0 * $foreground_color[0] + $newcolor * $background_color[0];
						$newgreen = $newcolor0 * $foreground_color[1] + $newcolor * $background_color[1];
						$newblue  = $newcolor0 * $foreground_color[2] + $newcolor * $background_color[2];
					}
	
					imagesetpixel($img2, $x, $y, imagecolorallocate($img2, $newred, $newgreen, $newblue));
				}
			}
		
			header("Expires: Tue, 11 Jun 1985 05:00:00 GMT");
			header("Last-Modified: " .gmdate("D, d M Y H:i:s") ." GMT");
			header("Cache-Control: no-store, no-cache, must-revalidate");
			header("Cache-Control: post-check=0, pre-check=0", false);
			header("Pragma: no-cache");
			header("Content-Type: image/jpeg");
			imagejpeg($img2, null, $this->jpeg_quality);
		}
	}
    	
?>
