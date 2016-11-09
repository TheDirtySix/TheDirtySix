<?php

/*
Function Name: ewo_check_user
Parameters: No
Description: check user power
Created On: 07-06-2016 10:54
Created By: The CooThemes Team
*/
if ( ! defined( 'ABSPATH' ) ) exit;

function ewo_check_user()
{
	$user_role_permission = array(
		"manage_options",
		"publish_posts",
		"publish_pages",
		"edit_posts"
	);
	
	if(!is_user_logged_in())
	{
		return false;
	}
	else
	{
		foreach($user_role_permission as $permission)
		{
			if(current_user_can($permission))
			{
				$access_granted = true;
				break;
			}
		}
		if( $access_granted)
		{
			return true;
		}else{
			return false;
		}
	}
}


/*
Function Name: ewo_add_css_for_easy_wp_optimizer
Parameters: No
Description: ewo_add_css_for_easy_wp_optimizer
Created On: 07-06-2016 10:54
Created By: The CooThemes Team
*/
if(!function_exists("ewo_add_css_for_easy_wp_optimizer"))
{
	function ewo_add_css_for_easy_wp_optimizer()
	{
		wp_enqueue_style("easy-wp-optimizer-main", plugins_url("inc/css/main.css",__FILE__));
		wp_enqueue_style("toastr", plugins_url("inc/css/toastr.css",__FILE__));
		wp_enqueue_style("html5tooltips", plugins_url("inc/css/html5tooltips.css",__FILE__));		
	}
}


if(!function_exists("ewo_add_js_for_easy_wp_optimizer"))
{
	function ewo_add_js_for_easy_wp_optimizer()
	{
		wp_enqueue_script( 'jquery' );		
		wp_enqueue_script("toastr",plugins_url("inc/js/toastr.js",__FILE__));
		wp_enqueue_script("html5tooltips",plugins_url("inc/js/html5tooltips.js",__FILE__));		
		
	}
}


/*
Function Name: ewo_ajax_register_for_easy_wp_optimizer
Parameters: No
Description: This function is used for register ajax.
Created On: 07-06-2016 10:54
Created By: The CooThemes Team
*/
if(!function_exists("ewo_ajax_register_for_easy_wp_optimizer"))
{
	function ewo_ajax_register_for_easy_wp_optimizer()
	{
		if(isset($_REQUEST["action"]))
		{
			if(file_exists(EWO_DIR_PATH."includes/action.php"))
			{
				include_once EWO_DIR_PATH."includes/action.php";
			}
		}
		include_once EWO_DIR_PATH."includes/download.php";
		
	}
}


/*
Function Name: ewo_create_easy_wp_optimizer_db
Parameters: No
Description: This function is used for create database table.
Created On: 07-06-2016 10:54
Created By: The CooThemes Team
*/
if(!function_exists("ewo_create_easy_wp_optimizer_db"))
{
	function ewo_create_easy_wp_optimizer_db()
	{
		//echo 'ewo_create_easy_wp_optimizer_db';
		global $wpdb;		
		$sql = "CREATE TABLE IF NOT EXISTS ".ewo_get_table_name_easy_wp_optimizer()." (
		  `e_id` bigint(20) NOT NULL AUTO_INCREMENT,
		  `e_name` varchar(255) NOT NULL,
		  `e_file_name` varchar(255) NOT NULL,
		  `e_table` text NOT NULL,
		  `e_execution_time` datetime NOT NULL,
		  `e_description` text NOT NULL,
		  `e_compression_type` varchar(20) NOT NULL,
		  `e_execution_type` varchar(20) NOT NULL,
		  `e_type` varchar(50) NOT NULL,
		  `e_path` varchar(255) NOT NULL,
		  `e_destination` varchar(50) NOT NULL,
		  `e_file_size` varchar(50) NOT NULL,
		  `e_status` varchar(50) NOT NULL,
		  PRIMARY KEY (`e_id`)
		) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
		
		$wpdb->query($sql);
	}
}

/*
Function Name: ewo_get_table_name_easy_wp_optimizer
Parameters: No
Description: This function is used for get the table name.
Created On: 05-07-2016 11:47
Created By: The CooThemes Team
*/

if(!function_exists("ewo_get_table_name_easy_wp_optimizer"))
{
	function ewo_get_table_name_easy_wp_optimizer()
	{
		global $wpdb;
		return $wpdb->prefix."easy_wp_optimizer_backup";
	}
}


/*
Function Name: ewo_load_textdomain_for_easy_wp_optimizer
Parameters: No
Description: This function is used to load languages.
Created On: 27-07-2016 12:18
Created By: The CooThemes Team
*/

if(!function_exists("ewo_load_textdomain_for_easy_wp_optimizer"))
{
	function ewo_load_textdomain_for_easy_wp_optimizer()
	{
		load_plugin_textdomain( 'Easy WP Optimizer', false, dirname( plugin_basename( __FILE__ ) ) . '/includes/languages' ); 
	}
}


/*
Function Name: ewo_uninstall_easy_wp_optimizer
Parameters: No
Description: This function is used to delete options on Uninstall plugin.
Created On: 27-07-2016 12:18
Created By: The CooThemes Team
*/

if(!function_exists("ewo_uninstall_easy_wp_optimizer"))
{
	function ewo_uninstall_easy_wp_optimizer()
	{
		//uninstall 
	}
}