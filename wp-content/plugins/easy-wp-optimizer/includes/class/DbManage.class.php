<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * @author CooThemes
 * @copyright  Copyright (c) 2016 CooThemes.com
 * @link  https://www.coothemes.com
 * @version 1.1
 * Created Time: 2016.07.13
 * modified Time: 2016.07.13
 
 * Note: the sub-volume file is _v1.sql ending (20120522021241_all_v1.sql)
 * Function: mysql database sub-volume backup, select the table for backup, to achieve sub-volume single sql file and sql import
 * Instructions

 *------------1. database backup (export) ------------------------------------ --------------------------
// Are the localhost, username, password, database name, database coding
$db = new ewo_DbManage ( 'localhost', 'root', 'root', 'test', 'utf8' );
// Parameters: Backup which table (optional), backup directory (optional, defaults to backup), volume size (optional, defaults to 4000, namely 4M)
$db->backup ('','','',);

 *--------------------2. Database Recovery (import) ------------------------------------ -------------------------
// Are the localhost, username, password, database name, database coding
$db = new ewo_DbManage ( 'localhost', 'root', 'root', 'test', 'utf8' );
// Parameters: sql file
$db->restore ( './backup/20120516211738_all_v1.sql');
 *----------------------------------------------------------------------
 */
 
class ewo_DbManage {
    var $db;
    var $database; 
    var $sqldir;

    private $ds = "\n";

    public $sqlContent = "";

    public $sqlEnd = ";";

    /**
     * initialization
     *
     * @param string $host
     * @param string $username
     * @param string $password
     * @param string $database
     * @param string $charset
     */
    function __construct($host = 'localhost', $username = 'root', $password = '', $database = 'test', $charset = 'utf8') {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
        $this->charset = $charset;
        set_time_limit(0);
		@ob_end_flush();
		
        $this->db = @mysql_connect ( $this->host, $this->username, $this->password ) or die( '<p class="dbDebug"><span class="err">Mysql Connect Error : </span>'.mysql_error().'</p>');
        mysql_select_db ( $this->database, $this->db ) or die('<p class="dbDebug"><span class="err">Mysql Connect Error:</span>'.mysql_error().'</p>');
        mysql_query ( 'SET NAMES ' . $this->charset, $this->db );

    }

    function getTables() {
        $res = mysql_query ( "SHOW TABLES" );
        $tables = array ();
        while ( $row = mysql_fetch_array ( $res ) ) {
            $tables [] = $row [0];
        }
        return $tables;
    }

    /*
     *
     * ------------------------------------------Database Backup start----------------------------------------------------------
     */

    /**
	 * database backup
	 *Parameters: Backup which table (optional), backup directory (optional, defaults to backup), volume size (optional, defaults to 4000, namely 4M)
     *
     * @param $string $dir
     * @param int $size
     * @param $string $tablename
     */
    function backup($tablename = '', $dir, $size) {
        $dir = $dir ? $dir : './backup/';
        
        if (! is_dir ( $dir )) {
            mkdir ( $dir, 0777, true ) or die ( 'Create Folder Failed!' );
        }
        $size = $size ? $size : 4096;
        $sql = '';
		
        // Backup only part of the table
        if (! empty ( $tablename )) {

            $this->_showMsg('Being backed up...');

            $sql .= $this->_retrieve ();
			
            $filename = date ( 'YmdHis' ) . "_part";
						
            $p = 1;
			
            // Loop table to export
			foreach ($tablename as $tablename_single)
			{
               	// Get the table structure
                $sql .= $this->_insert_table_structure ( $tablename_single );
                $data = mysql_unbuffered_query ( "select * from  `".$tablename_single."` " );	

                $num_fields = mysql_num_fields ( $data );

                // Loop each record
                while ( $record = mysql_fetch_array ( $data ) )
				{
                    // A single record
                    $sql .= $this->_insert_record ( $tablename_single, $num_fields, $record );
                    
                    if (strlen ( $sql ) >= $size * 1000)
					{
                        $file = $filename . "_v" . $p . ".sql";
                        //Write to file
                        if ($this->_write_file ( $sql, $file, $dir ))
						{
                            $this->_showMsg("-Volume-<b>" . $p . "</b>-Data backup is complete, the backup file [ <span class='imp'>".$dir.$file."</span> ]");
                        }
						else
						{
                            $this->_showMsg("Volume-<b>" . $p . "</b>-Backup Failed!",true);
                            return false;
                        }                        
                        $p ++;// Next sub-volume
                        $sql = "";// Reset The $sql variable is empty, recalculate the size of the variables
                    }
                }
			}
			
            // Sql size is not enough volume size
            if ($sql != "")
			{
                $filename .= "_v" . $p . ".sql";
                if ($this->_write_file ( $sql, $filename, $dir ))
				{
					$this->_showMsg("-Volume-<b>" . $p . "</b>-Data backup is complete, the backup file [ <span class='imp'>".$dir.$filename."</span> ]");
                }
				else
				{
					$this->_showMsg("Volume-<b>" . $p . "</b>-Backup Failed!",true);
                    return false;
                }
            }
            $this->_showMsg("congratulations! <span class='imp'>Backup Success!</span>");
        }
		else
		{// Backup all tables
            $this->_showMsg('Being backed up...');

            if ($tables = mysql_query ( "show table status from " . $this->database )) {
                $this->_showMsg("Reads the database structure success!");
            } else {
                $this->_showMsg("Reads the database structure failed!");
                exit ( 0 );
            }
            // Insert dump information
            $sql .= $this->_retrieve ();
			
            $filename = date ( 'YmdHis' ) . "_all";
			
            $tables = mysql_query ( 'SHOW TABLES' );
			
            $p = 1;// Volume
			
            // loop through all tables
            while ( $table = mysql_fetch_array ( $tables ) )
			{
                $tablename = $table [0];
                $sql .= $this->_insert_table_structure ( $tablename );
                $data = mysql_unbuffered_query ( "select * from " . $tablename );				
                $num_fields = mysql_num_fields ( $data );

                while ( $record = mysql_fetch_array ( $data ) )
				{
                    $sql .= $this->_insert_record ( $tablename, $num_fields, $record );
					
                    if (strlen ( $sql ) >= $size * 1000)
					{
                        $file = $filename . "_v" . $p . ".sql";
                       
                        if ($this->_write_file ( $sql, $file, $dir ))
						{
							$this->_showMsg("-Volume-<b>" . $p . "</b>-Data backup is complete, the backup file [ <span class='imp'>".$dir.$file."</span> ]");
                        }
						else
						{
							$this->_showMsg("Volume-<b>" . $p . "</b>-Backup Failed!",true);
                            return false;
                        }
                        $p ++;
                        $sql = "";
                    }
                }
            }
            if ($sql != "")
			{
                $filename .= "_v" . $p . ".sql";
                if ($this->_write_file ( $sql, $filename, $dir ))
				{
					$this->_showMsg("-Volume-<b>" . $p . "</b>-Data backup is complete, the backup file [ <span class='imp'>".$dir.$filename."</span> ]");
                }
				else
				{
                    $this->_showMsg("Volume-<b>" . $p . "</b>-Backup Failed!",true);
                    return false;
                }
            }
            $this->_showMsg("congratulations! <span class='imp'>Backup Success!</span>");
        }
    }

    private function _showMsg($msg,$err=false){
        $err = $err ? "<span class='err'>ERROR:</span>" : '' ;
        echo "<p class='dbDebug'>".$err . $msg."</p>";
        flush();

    }

    /**
     * Basic information into the database backup
     *
     * @return string
     */
    private function _retrieve() {
        $value = '';
        $value .= '--' . $this->ds;
        $value .= '-- MySQL database dump' . $this->ds;
        $value .= '-- Created by DbManage class, Power By Lei. ' . $this->ds;
        $value .= '-- http://www.coothemes.com ' . $this->ds;
        $value .= '--' . $this->ds;
        $value .= '-- Localhost: ' . $this->host . $this->ds;
        $value .= '-- Created data: ' . date ( 'Y' ) . '-' . date ( 'm' ) . '-' . date ( 'd' ) . '-' . date ( 'H:i' ) . $this->ds;
        $value .= '-- MySQL Version: ' . mysql_get_server_info () . $this->ds;
        $value .= '-- PHP Version: ' . phpversion () . $this->ds;
        $value .= $this->ds;
        $value .= '--' . $this->ds;
        $value .= '-- Database: `' . $this->database . '`' . $this->ds;
        $value .= '--' . $this->ds . $this->ds;
        $value .= '-- -------------------------------------------------------';
        $value .= $this->ds . $this->ds;
        return $value;
    }

    /**
     * Insert Table Structure
     *
     * @param unknown_type $table
     * @return string
     */
    private function _insert_table_structure($table) {
        $sql = '';
        $sql .= "--" . $this->ds;
        $sql .= "-- Structure of the table" . $table . $this->ds;
        $sql .= "--" . $this->ds . $this->ds;

        $sql .= "DROP TABLE IF EXISTS `" . $table . '`' . $this->sqlEnd . $this->ds;

        $res = mysql_query ( 'SHOW CREATE TABLE `' . $table . '`' );
        $row = mysql_fetch_array ( $res );
        $sql .= $row [1];
        $sql .= $this->sqlEnd . $this->ds;
        //add
        $sql .= $this->ds;
        $sql .= "--" . $this->ds;
        $sql .= "-- Data dump table " . $table . $this->ds;
        $sql .= "--" . $this->ds;
        $sql .= $this->ds;
        return $sql;
    }

    /**
     * Insert a single record
     *
     * @param string $table
     * @param int $num_fields
     * @param array $record
     * @return string
     */
    private function _insert_record($table, $num_fields, $record) {
        //sql comma-separated fields
        $insert = '';
        $comma = "";
        $insert .= "INSERT INTO `" . $table . "` VALUES(";
        // Loop through each field the following content
        for($i = 0; $i < $num_fields; $i ++) {
            $insert .= ($comma . "'" . mysql_real_escape_string ( $record [$i] ) . "'");
            $comma = ",";
        }
        $insert .= ");" . $this->ds;
        return $insert;
    }

    /**
     * write file
     *
     * @param string $sql
     * @param string $filename
     * @param string $dir
     * @return boolean
     */
    private function _write_file($sql, $filename, $dir) {
        $dir = $dir ? $dir : './backup/';
        
        if (! is_dir ( $dir )) {
            mkdir ( $dir, 0777, true );
        }
        $re = true;
        if (! @$fp = fopen ( $dir . $filename, "w+" )) {
            $re = false;
            $this->_showMsg("Open the sql file failed!",true);
        }
        if (! @fwrite ( $fp, $sql )) {
            $re = false;
            $this->_showMsg("Write sql file failed, please confirm whether the file can be written!",true);
        }
        if (! @fclose ( $fp )) {
            $re = false;
            $this->_showMsg("Close sql file failed!",true);
        }
        return $re;
    }

    /*
     *
     * -------------------------------On: database export under ----------- ---------- dividing line: database import ---------------------
     */

    /**
	  * Import backup data
      * Note: sub-volume file format 20120516211738_all_v1.sql
      * Parameters: Path (required)
     *
     * @param string $sqlfile = ./backup/20160712115556_part_v1.sql
     */
    function restore($sqlfile) {
        // Detect whether a file exists
        if (! file_exists ( $sqlfile )) {
            //$this->_showMsg("sql file does not exist, please check!",true);
            exit ();
        }
        $this->lock ( $this->database );
        // Get the database storage location
        $sqlpath = pathinfo ( $sqlfile );
        $this->sqldir = $sqlpath ['dirname']; 

        $volume = explode ( "_v", $sqlfile );
        $volume_path = $volume [0];// ./backup/20160712115556_part
        $this->_showMsg("Please do not refresh or close the browser, to prevent the program is aborted, if inadvertently! It may result in damage to the structure of the database!");
        $this->_showMsg("Backup data is being imported, please wait!");
        if (empty ( $volume [1] ))//
		{
            if ($this->_import ( $sqlfile )) {
                //$this->_showMsg( "Database import was successful!");
            } else {
                //$this->_showMsg('Database import failed!',true);
                exit ();
            }
        }
		else
		{
           // Sub-volume exists, it is the first to get the current volume fraction, the remaining sub-volume loop execution
            $volume_id = explode ( ".sq", $volume [1] );
            // the current volume:$volume_id
            $volume_id = intval ( $volume_id [0] ); // 1
            while ( $volume_id )
			{
                $tmpfile = $volume_path . "_v" . $volume_id . ".sql";
                // There are other sub-volumes continue
                if (file_exists ( $tmpfile ))
				{
                    // The import method
					$this->_showMsg(" $volume_id : <span class='dbred'>" . $tmpfile . 'Sub-volume being imported</span><br />');
                    if ($this->_import ( $tmpfile ))
					{
						$this->_showMsg("$volume_id :<span class='dbred'>" . $tmpfile . 'Sub-volume import success!</span><br />');
                    } else {
                        $volume_id = $volume_id ? $volume_id :1;
                        exit ( "Import into the sub-volume:<span class='dbred'>" . $tmpfile . '</span> failed! Database structure may be corrupted! Try to start the import volume from points 1...' );
                    }
                } else {
					$this->_showMsg("This sub-volume backup all imported successfully!<br />");
                    return;
                }
                $volume_id ++;
            }//while ( $volume_id )
        }
		
		//Repeat the import steps
    }
	
	
    function getfilenum($sqlfile) {
		$num = 0;		
        if (! file_exists ( $sqlfile )) {
            return $num;
        }

        $volume = explode ( "_v", $sqlfile );
        $volume_path = $volume [0];

		$volume_id = explode ( ".sq", $volume [1] );

		$volume_id = intval ( $volume_id [0] ); // 1
		while ( $volume_id )
		{
			$tmpfile = $volume_path . "_v" . $volume_id . ".sql";
			// There are other sub-volumes continue
			if (!file_exists ( $tmpfile ))
			{
				break;
			}
			$volume_id ++;
		}
		$num = $volume_id-1;
		return $num;
		//Repeat the import steps
    }	
	

   	function getfilesize($sqlfile) {
		$size = 0;
		$mb = 0;
		
        if (! file_exists ( $sqlfile )) {
            return $mb;
        }

        $volume = explode ( "_v", $sqlfile );
        $volume_path = $volume [0];

		$volume_id = explode ( ".sq", $volume [1] );
		// the current volume:$volume_id
		$volume_id = intval ( $volume_id [0] ); // 1
		while ( $volume_id )
		{
			$tmpfile = $volume_path . "_v" . $volume_id . ".sql";
			if (!file_exists ( $tmpfile ))
			{
				break;
			}
			$size += filesize($tmpfile);
			$volume_id ++;
		}//while ( $volume_id )

		if($size>1024 && $size < 1024*1024)
		{ 
			$mb = sprintf("%.2f", $size/1024 ).'Kb';
		}
		else if($size>1024*1024 && $size < 1024*1024*1024)
		{ 
			$mb = sprintf("%.2f",$size/(1024*1024) ).'Mb';
		}
		else if( $size > 1024*1024*1024)
		{ 
			$mb = sprintf("%.2f", $size/(1024*1024*1024)).'Gb';	
		}
		else {$mb =$size.'b';}

		return $mb;
    }	

	

    /**
     * The sql into the database (Common import)
     *
     * @param string $sqlfile
     * @return boolean
     */
    private function _import($sqlfile) {
		//exe The sql query in the sql file
        $sqls = array ();
        $f = fopen ( $sqlfile, "rb" );
        // Create a table variable buffer
        $create_table = '';
        while ( ! feof ( $f ) ) {
            // Read each line sql
            $line = fgets ( $f );
            if (! preg_match ( '/;/', $line ) || preg_match ( '/ENGINE=/', $line )) {

                $create_table .= $line;

                if (preg_match ( '/ENGINE=/', $create_table)) {

                    $this->_insert_into($create_table);

                    $create_table = '';
                }

                continue;
            }
            $this->_insert_into($line);
        }
        fclose ( $f );
        return true;
    }

	// Insert a single sql statement
    private function _insert_into($sql){
        if (! mysql_query ( trim ( $sql ) )) {
            $this->msg .= mysql_error ();
            return false;
        }
    }

    /*
     * -------------------------------Database import end---------------------------------
     */

    // Close the database connection
    private function close() {
        mysql_close ( $this->db );
    }

    // Lock the database to avoid making mistakes when a backup or import
    private function lock($tablename, $op = "WRITE") {
        if (mysql_query ( "lock tables " . $tablename . " " . $op ))
            return true;
        else
            return false;
    }

    // unlock
    private function unlock() {
        if (mysql_query ( "unlock tables" ))
            return true;
        else
            return false;
    }

    
    function __destruct() {
        if($this->db){
            mysql_query ( "unlock tables", $this->db );
            mysql_close ( $this->db );
        }
    }

}