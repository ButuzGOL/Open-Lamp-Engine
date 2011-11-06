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
// Назначение: Класс управления email сообщениями
//=============================================================================/
*/

    class email {
    		
    	var $mysql, $tn = EMAIL;

    	function email($mysql_obj) {
        	$this->mysql = $mysql_obj;
    	}
    	
    	function get($id) {
           
        	$sql = "select template from $this->tn where id='$id'";
            return $this->mysql->result($sql);
        }
        
        function update($reg_email, $ofs_email, $lopa_email, $news_email) {
            
			$sql = "update $this->tn set template='$reg_email' where id='1'";
            if (!$this->mysql->query($sql)) return FALSE;
            
            $sql = "update $this->tn set template='$ofs_email' where id='2'";
            if (!$this->mysql->query($sql)) return FALSE;
            
            $sql = "update $this->tn set template='$lopa_email' where id='3'";
            if (!$this->mysql->query($sql)) return FALSE;
            
            $sql = "update $this->tn set template='$news_email' where id='4'";
            if (!$this->mysql->query($sql)) return FALSE;
            
            return TRUE;
        }
    	
    	function sendEMail($to, $subj, $message, $headers) {
    	    		        	
        	if (!@mail($to, $subj, $message, $headers)) return FALSE;
        	
        	return TRUE;
    	}
    }
?>
