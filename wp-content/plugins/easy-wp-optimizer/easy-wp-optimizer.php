<?php
/*
Plugin Name: Easy WP Optimizer
Plugin URI: https://www.coothemes.com/plugins/Easy-WP-Optimizer-Manual.php
Description: Easy WP Optimizer allows you to optimize database,Backup WordPress database and non WordPress-based database (including very large databases),Restore database.
Author: coothemes Team
Author URI: https://www.coothemes.com
Version: 1.0.5
License: GPLv3
*/
if ( ! defined( 'ABSPATH' ) ) exit;
/*define path and url*/
if(!defined("EWO_DIR_PATH")) define("EWO_DIR_PATH",plugin_dir_path(__FILE__));
if(!defined("EWO_URL_PATH")) define("EWO_URL_PATH",plugins_url(__FILE__));
if(!defined("EWO_PLUGIN_DIRNAME")) define("EWO_PLUGIN_DIRNAME", plugin_basename(dirname(__FILE__)));
if(!defined("easy_wp_optimizer")) define("easy_wp_optimizer","easy-wp-optimizer");

if(is_ssl())
{
	if(!defined("ewo_the_coothemes_url")) define("ewo_the_coothemes_url","https://www.coothemes.com");
}
else
{
	if(!defined("ewo_the_coothemes_url")) define("ewo_the_coothemes_url","http://www.coothemes.com");
}

include EWO_DIR_PATH."includes/functions.php";


if(!function_exists("ewo_call_functions_for_easy_wp_optimizer"))
{
	function ewo_call_functions_for_easy_wp_optimizer()
	{
		//if(isset($_REQUEST["page"]))
		//{
			//if(!(strpos($_REQUEST["page"],'ewo_') === false)){
			ewo_add_css_for_easy_wp_optimizer();
			ewo_add_js_for_easy_wp_optimizer();	
			ewo_ajax_register_for_easy_wp_optimizer();
			//}
		//}
	}
}

if(!function_exists("ewo_activation_easy_wp_optimizer"))
{
	function ewo_activation_easy_wp_optimizer()
	{		
		ewo_create_easy_wp_optimizer_db();
	}
}

if(!function_exists("ewo_sidebar_menu_for_easy_wp_optimizer"))
{
	function ewo_sidebar_menu_for_easy_wp_optimizer()
	{
		if(file_exists(EWO_DIR_PATH."includes/languages.php"))
		{
			include EWO_DIR_PATH."includes/languages.php";
		}		
				
		if(file_exists(EWO_DIR_PATH."includes/ewo-page.php"))
		{
			include_once EWO_DIR_PATH."includes/ewo-page.php";
		}		
		
	}
}

/* Hooks */
/* add_action for ewo_call_functions_for_easy_wp_optimizer
Description: This hook is used for calling all the Functions
Created On: 07-06-2016 10:54
Created By: The CooThemes Team
*/
add_action("admin_init", "ewo_call_functions_for_easy_wp_optimizer");


/* register_activation_hook
Description: This hook is used for Activating Easy WP Optimizer.
Created On: 07-06-2016 10:54
Created By: The CooThemes Team
*/
register_activation_hook(__FILE__,"ewo_activation_easy_wp_optimizer");


/* add_action for ewo_sidebar_menu_for_easy_wp_optimizer
Description: This hook is uesd for calling the function of sidebar menu.
Created On: 07-06-2016 10:54
Created By: The CooThemes Team
*/
add_action("admin_menu","ewo_sidebar_menu_for_easy_wp_optimizer");


/*
add_action for ewo_load_textdomain_for_easy_wp_optimizer
Description: This hook is used for calling the function of languages.
Created On: 07-06-2016 10:54
Created By: The CooThemes Team
*/
add_action("plugins_loaded", "ewo_load_textdomain_for_easy_wp_optimizer");


/* register_uninstall_hook  ewo_uninstall_easy_wp_optimizer
Description: This hook is used for calling the function of uninstall Easy WP Optimizer.
Created On: 07-06-2016 10:54
Created By: The CooThemes Team
*/
register_uninstall_hook( __FILE__, "ewo_uninstall_easy_wp_optimizer");