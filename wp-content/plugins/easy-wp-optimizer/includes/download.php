<?php
	ob_start();//for win8  Warning: Cannot modify header information - headers already sent by (output started at
	if ( ! defined( 'ABSPATH' ) ) exit;
	if(!ewo_check_user()){return;}
	
	if(isset($_REQUEST['path']))
	{
		$files_name = $_REQUEST['filename'].'_v1.sql';			
		$files = WP_CONTENT_DIR.$_REQUEST['path'].$files_name;	

		if(file_exists(EWO_DIR_PATH."includes/class/DbManage.class.php"))
		{
			include_once EWO_DIR_PATH."includes/class/DbManage.class.php";
		}				
		
		$db = new ewo_DbManage ( DB_HOST,DB_USER, DB_PASSWORD, DB_NAME, DB_CHARSET );  

		$num = $db->getfilenum ( $files );

		$valid_files = array();
		$files = array();		
		for($j=1;$j<=$num;$j++){
			$files_name_arr[] = $_REQUEST['filename'].'_v'.$j.'.sql';
			$files[] = WP_CONTENT_DIR.$_REQUEST['path'].$_REQUEST['filename'].'_v'.$j.'.sql';
		}
		
		if(is_array($files)) {
			foreach($files as $filecheck) {
				if(file_exists($filecheck)) {				
					$valid_files[] = $filecheck;
				}
			}
		}
		
		if(count($valid_files) > 0){
			$zip = new ZipArchive();
			$zip_name = $_REQUEST['filename'].".zip";
			if($zip->open($zip_name, ZIPARCHIVE::CREATE)!==TRUE){
				$error .= "* Sorry ZIP creation failed at this time";
			}
			
			for($k=0;$k<count($valid_files);$k++)
			{
				$zip->addFile($valid_files[$k],$files_name_arr[$k]);
			}
		 
			$zip->close();
			
			if(file_exists($zip_name)){
				// force to download the zip
				header("Pragma: public");
				header("Expires: 0");
				header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
				header("Cache-Control: private",false);
				header('Content-type: application/zip');
				header('Content-Disposition: attachment; filename="'.$zip_name.'"');
				readfile($zip_name);
				
				// remove zip file from temp path
				unlink($zip_name);
			}
		 
		} else {
			header( "Location:admin.php?page=ewo_restore_database" );exit;
			exit;
		}

	}
