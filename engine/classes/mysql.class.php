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
// Файл: mysql.class.php
//-----------------------------------------------------------------------------/
// Назначение: Класс управления mySQL
//=============================================================================/
*/

	class mysql {
        var $id;

		function mysql($h = MYSQL_HOST, $l = MYSQL_USER, $p = MYSQL_PASS, $db = MYSQL_DB) {
            
            $this->id = @mysql_connect($h, $l, $p);
            if (!$this->online()) return FALSE;
            $this->query('SET NAMES utf8 COLLATE utf8_general_ci');
            return mysql_select_db($db); 
        }
        
        function online() {
        
            if (!is_resource($this->id)) return FALSE;    
            return TRUE;
        }
        
        function query($sql) {
            
            if (!$this->online()) return FALSE;
            return @mysql_query($sql,$this->id);
        }
        
		function result($sql, $row = 0, $name = NULL) {
		
            if (!$this->online()) return FALSE;
            
            $q = $this->query($sql);
            return @mysql_result($q, $row, $name);
        }
        
        function fetch_row($sql) {
            
            if (!$this->online()) return FALSE;
            
            $q = $this->query($sql);
            while ($res = @mysql_fetch_row($q)) $res_array[count($res_array)] = $res;
            return $res_array;
        }
        
        function fetch_array($sql) {
        
            if (!$this->online()) return FALSE;
            return @mysql_fetch_array($sql);
        }
               
        function close() {
            @mysql_close($this->id);
        }        
    }
	
?>
