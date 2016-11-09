<?php
	if(!ewo_check_user()){return;}
			
	$flag=1;
	if($flag == "1")
	{	
		add_menu_page($ewo_easy_wp_optimizer,$ewo_easy_wp_optimizer,"read","ewo_easy_wp_optimizer","",plugins_url("includes/images/icons.png",dirName(__FILE__)));
		add_submenu_page("ewo_easy_wp_optimizer",$ewo_manual_clean_up_label,$ewo_wordpress_data,"read","ewo_easy_wp_optimizer","ewo_easy_wp_optimizer");

		add_submenu_page("ewo_easy_wp_optimizer",$ewo_backup_database_label,$ewo_database,"read","ewo_backup_database","ewo_backup_database");
		add_submenu_page($ewo_database,$ewo_restore_database_label,"","read","ewo_restore_database","ewo_restore_database");	

		add_submenu_page("ewo_easy_wp_optimizer",$ewo_system_info_label,$ewo_system_info_label,"read","ewo_system_info","ewo_system_info");
	}


	/*
	Function Name: ewo_easy_wp_optimizer
	Parameters: No
	Description: This function is used to create manual Clean Up Menu.
	Created On: 07-06-2016 10:54
	Created By: The CooThemes Team
	*/
	if(!function_exists("ewo_easy_wp_optimizer"))
	{
		function ewo_easy_wp_optimizer()
		{
			if(file_exists(EWO_DIR_PATH."includes/languages.php"))
			{
				include EWO_DIR_PATH."includes/languages.php";
			}
			if(file_exists(EWO_DIR_PATH."includes/q.php"))
			{
				include_once EWO_DIR_PATH."includes/q.php";
			}					
			if(file_exists(EWO_DIR_PATH."includes/lib/wordpress-data/manual-wp-data-optimize.php"))
			{
				include_once EWO_DIR_PATH."includes/lib/wordpress-data/manual-wp-data-optimize.php";
			}			
		}
	}

	/*
	Function Name: ewo_backup_database
	Parameters: No
	Description: This function is used to create backup.
	Created On: 23-07-2016 1:00
	Created By: The CooThemes Team
	*/

	if(!function_exists("ewo_backup_database"))
	{
		function ewo_backup_database()
		{
			if(file_exists(EWO_DIR_PATH."includes/languages.php"))
			{
				include EWO_DIR_PATH."includes/languages.php";
			}


			if(file_exists(EWO_DIR_PATH."includes/q.php"))
			{
				include_once EWO_DIR_PATH."includes/q.php";
			}
			
			if(file_exists(EWO_DIR_PATH."includes/lib/wordpress-data/backup-database.php"))
			{
				include_once EWO_DIR_PATH."includes/lib/wordpress-data/backup-database.php";
			}	

		}
	}
	
	/*
	Function Name: ewo_restore_database
	Parameters: No
	Description: This function is used to restore database.
	Created On: 23-07-2016 1:00
	Created By: The CooThemes Team
	*/

	if(!function_exists("ewo_restore_database"))
	{
		function ewo_restore_database()
		{

			if(file_exists(EWO_DIR_PATH."includes/languages.php"))
			{
				include EWO_DIR_PATH."includes/languages.php";
			}


			if(file_exists(EWO_DIR_PATH."includes/q.php"))
			{
				include_once EWO_DIR_PATH."includes/q.php";
			}
			
			if(file_exists(EWO_DIR_PATH."includes/lib/wordpress-data/restore-database.php"))
			{
				include_once EWO_DIR_PATH."includes/lib/wordpress-data/restore-database.php";
			}	

		}
	}			

	
	/*
	Function Name: ewo_system_info
	Parameters: No
	Description: This function is used to show system informations.
	Created On: 23-07-2016 1:00
	Created By: The CooThemes Team
	*/
	if(!function_exists("ewo_system_info"))
	{
		function ewo_system_info()
		{
			if(file_exists(EWO_DIR_PATH."includes/languages.php"))
			{
				include EWO_DIR_PATH."includes/languages.php";
			}


			if(file_exists(EWO_DIR_PATH."includes/q.php"))
			{
				include_once EWO_DIR_PATH."includes/q.php";
			}
			
			if(file_exists(EWO_DIR_PATH."includes/lib/system-info/system-info.php"))
			{
				include_once EWO_DIR_PATH."includes/lib/system-info/system-info.php";
			}	

		}
	}