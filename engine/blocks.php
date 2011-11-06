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
// Файл: blocks.php
//-----------------------------------------------------------------------------/
// Назначение: Блоки
//=============================================================================/
*/

	if (!defined("OLE")) die("<script>window.location = \"./\"</script>");

	include(CLASSES ."/blocks.class.php");
	
	$o_blocks = new blocks($o_mysql);
	
	$rules["{LEFT_BLOCKS}"]   = "";
	$rules["{RIGHT_BLOCKS}"]  = "";	$rules["{TOP_BLOCKS}"]    = "";
	$rules["{BUTTOM_BLOCKS}"] = "";	    $result = $o_blocks->get();
        if ($result) {     	foreach ($result as $n) {     
            if ($n[3]) {                
                $blocks = "";
                
                if ($n[7] && file_exists(BLOCKSS."/".$n[7])) include(BLOCKSS."/".$n[7]);
                
                $rules1["{TITLE}"]  = $n[2];
                $rules1["{MIDDLE}"] = ($blocks) ? $blocks : $n[8];
                
                switch ($n[4]) {
                    case "1" : $rules["{LEFT_BLOCKS}"]   .= ($n[6] && file_exists(BLOCK_TEMPLATES_DIR."/".$n[6])) ? $o_tpl->gethtml(BLOCK_TEMPLATES_DIR."/".$n[6], $rules1) : $o_tpl->gethtml(TEMPLATES_DIR."/default_block.tpl", $rules1);
                    break;
                    case "2" : $rules["{RIGHT_BLOCKS}"]  .= ($n[6] && file_exists(BLOCK_TEMPLATES_DIR."/".$n[6])) ? $o_tpl->gethtml(BLOCK_TEMPLATES_DIR."/".$n[6], $rules1) : $o_tpl->gethtml(TEMPLATES_DIR."/default_block.tpl", $rules1);
                    break;
                    case "3" : $rules["{TOP_BLOCKS}"]    .= ($n[6] && file_exists(BLOCK_TEMPLATES_DIR."/".$n[6])) ? $o_tpl->gethtml(BLOCK_TEMPLATES_DIR."/".$n[6], $rules1) : $o_tpl->gethtml(TEMPLATES_DIR."/default_block.tpl", $rules1);
                    break;
                    case "4" : $rules["{BUTTOM_BLOCKS}"] .= ($n[6] && file_exists(BLOCK_TEMPLATES_DIR."/".$n[6])) ? $o_tpl->gethtml(BLOCK_TEMPLATES_DIR."/".$n[6], $rules1) : $o_tpl->gethtml(TEMPLATES_DIR."/default_block.tpl", $rules1);
                    break;
                }     
                unset($rules1);                 
            }
        }                        					            	}
	
?>
