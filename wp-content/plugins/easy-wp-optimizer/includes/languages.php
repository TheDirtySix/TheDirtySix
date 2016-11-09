<?php
/*
This document is intended for translation-ready.
*/
if ( ! defined( 'ABSPATH' ) ) exit;	
	// Common Variables
	if(!ewo_check_user()){return;}
	
	$ewo_easy_wp_optimizer = __("Easy WP Optimizer",easy_wp_optimizer);
	$ewo_clean_up_wp_data = __("Clean Up WP Data",easy_wp_optimizer);
	$ewo_manual_clean_up_label = __("Manual Clean Up",easy_wp_optimizer);
	

	$ewo_type_of_data = __("Type Of Data",easy_wp_optimizer);
	$ewo_count = __("Count",easy_wp_optimizer);
	$ewo_auto_drafts = __("Auto Drafts",easy_wp_optimizer);
	$ewo_auto_drafts_tooltip = __("Auto Drafts are the Pages & Posts saved as draft automatically in WordPress Database.", easy_wp_optimizer);
	$ewo_empty = __("Empty",easy_wp_optimizer);
	$ewo_dashboard_transient_feed = __("Dashboard Transient Feed",easy_wp_optimizer);
	$ewo_dashboard_transient_feed_tooltip = __("Transient Feed in WordPress use Database entries to cache a certain entries.", easy_wp_optimizer);
	//$ewo_unapproved_comments = __("Unapproved Comments",easy_wp_optimizer);
	$ewo_pending_comments = __("Pending Comments",easy_wp_optimizer);	
	
	//$ewo_unapproved_comments_tooltip = __("Unapproved Comments are the Comments which are not approved.", easy_wp_optimizer);
	$ewo_pending_comments_tooltip = __("Pending Comments are the Comments which are waiting for admin's approval.", easy_wp_optimizer);
		
	$ewo_orphan_comment_meta = __("Orphan Comments Meta",easy_wp_optimizer);
	$ewo_orphan_comment_meta_tooltip = __("Orphan Comments Meta holds the miscellaneous bits of extra information of comment.", easy_wp_optimizer);
	$ewo_orphan_post_meta = __("Orphan Posts Meta",easy_wp_optimizer);
	$ewo_orphan_post_meta_tooltip = __("Orphan Posts Meta holds the junk or obsolete data.", easy_wp_optimizer);
	$ewo_orphan_relationships = __("Orphan Relationships",easy_wp_optimizer);
	$ewo_orphan_relationships_tooltip = __("Orphan Relationships holds the junk or obsolete Category and Tag.", easy_wp_optimizer);
	$ewo_revisions = __("Revisions",easy_wp_optimizer);
	$ewo_revisions_tooltip = __("The WordPress Revision System stores a record of each saved draft or published update. Revisions are stored in the Posts Table.", easy_wp_optimizer);
	$ewo_remove_pingbacks = __("Pingbacks",easy_wp_optimizer);
	$ewo_remove_pingbacks_tooltip = __("A Pingback is a type of comment that's created when you link to another blog post where Pingbacks are enabled.", easy_wp_optimizer);
	$ewo_remove_transient_options = __("Transient Options",easy_wp_optimizer);
	$ewo_remove_transient_options_tooltip = __("Transient Options are like a basic cache system used by WordPress. Clearing these options before a backup will help to save space in your backup files.", easy_wp_optimizer);
	$ewo_remove_trackbacks = __("Trackbacks",easy_wp_optimizer);
	$ewo_remove_trackbacks_tooltip = __("Trackbacks are a way to notify legacy blog systems that you have linked to them. If you link to a WordPress blog they will be notified automatically using pingbacks, no other action necessary.", easy_wp_optimizer);
	$ewo_spam_comments = __("Spam Comments",easy_wp_optimizer);
	$ewo_spam_comments_tooltip = __("Spam Comments are the unwanted Comments in the WordPress Database.", easy_wp_optimizer);
	$ewo_trash_comments = __("Trash Comments",easy_wp_optimizer);
	$ewo_trash_comments_tooltip = __("Trash Comments are the Comments which are stored in the WordPress Trash.", easy_wp_optimizer);
	$ewo_drafts = __("Drafts",easy_wp_optimizer);
	$ewo_drafts_tooltip = __("New Post & Page created as Draft in WordPress.", easy_wp_optimizer);
	$ewo_deleted_posts = __("Deleted Posts",easy_wp_optimizer);
	$ewo_deleted_posts_tooltip = __("Deleted Posts are the posts which are removed from the WordPress Data.", easy_wp_optimizer);
	$ewo_duplicated_post_meta = __("Duplicated Post Meta",easy_wp_optimizer);
	$ewo_duplicated_post_meta_tooltip = __("Duplicated Post Meta holds the duplicate data in the Posts Table.", easy_wp_optimizer);
	$ewo_oEmbed_caches_post_meta  = __("oEmbed Caches in Post Meta",easy_wp_optimizer);
	$ewo_oEmbed_caches_post_meta_tooltip = __("oEmbed Caches in Post Meta holds the data related to Embeddable Content.", easy_wp_optimizer);
	$ewo_duplicated_comment_meta = __("Duplicated Comment Meta",easy_wp_optimizer);
	$ewo_duplicated_comment_meta_tooltip = __("Duplicated Comment Meta holds the information of Duplicate Comments.", easy_wp_optimizer);
	$ewo_orphan_user_meta = __("Orphan User Meta",easy_wp_optimizer);
	$ewo_orphan_user_meta_tooltip = __("Orphan User Meta holds the orphan data of Usermeta Table in the Database.", easy_wp_optimizer);
	$ewo_duplicated_user_meta = __("Duplicated User Meta",easy_wp_optimizer);
	$ewo_duplicated_user_meta_tooltip = __("Duplicated User Meta holds the information of Duplicate user data.", easy_wp_optimizer);
	$ewo_orphaned_term_relationships = __("Orphaned Term Relationships",easy_wp_optimizer);
	$ewo_orphaned_term_relationships_tooltip = __("Orphaned Term Relationships holds the junk or obsolete term Category and Tag.", easy_wp_optimizer);
	$ewo_unused_terms = __("Unused Terms",easy_wp_optimizer);
	$ewo_unused_terms_tooltip = __("Unused Terms holds the term data which is not used by WordPress.", easy_wp_optimizer);


	$ewo_apply = __("Apply",easy_wp_optimizer);

	$ewo_bulk_action_dropdown = __("Bulk Action",easy_wp_optimizer);
	$ewo_action = __("Action",easy_wp_optimizer);	
	
	$ewo_wordpress_data = __("WordPress Data",easy_wp_optimizer);
	
	$ewo_database = __("Backup & Restore Database",easy_wp_optimizer);

	$ewo_backup_database_label = __("Backup Database",easy_wp_optimizer);
	$ewo_restore_database_label = __("Restore Database",easy_wp_optimizer);
	$ewo_system_info_label = __("System Information",easy_wp_optimizer);	

	$ewo_wordpress_manual_clean_up_label = __("WordPress Data - Manual Clean Up",easy_wp_optimizer);
	$ewo_database_manual_clean_up = __("Database - Manual Clean Up",easy_wp_optimizer);

	// Footer
	$ewo_empty_manual_clean_up_data = __("Selected Data has been cleaned Successfully.",easy_wp_optimizer);
	
	
	$ewo_empty_manual_clean_up1 = __("Auto Drafts has been cleaned Successfully.",easy_wp_optimizer);
	$ewo_empty_manual_clean_up2 = __("Dashboard Transient Feed has been cleaned Successfully.",easy_wp_optimizer);
	$ewo_empty_manual_clean_up3 = __("Pending Comments has been cleaned Successfully.",easy_wp_optimizer);
	$ewo_empty_manual_clean_up4 = __("Orphan Comments Meta has been cleaned Successfully.",easy_wp_optimizer);
	$ewo_empty_manual_clean_up5 = __("Orphan Posts Meta has been cleaned Successfully.",easy_wp_optimizer);
	$ewo_empty_manual_clean_up6 = __("Orphan Relationships has been cleaned Successfully.",easy_wp_optimizer);
	$ewo_empty_manual_clean_up7 = __("Revisions has been cleaned Successfully.",easy_wp_optimizer);
	$ewo_empty_manual_clean_up8 = __("Pingbacks has been cleaned Successfully.",easy_wp_optimizer);
	$ewo_empty_manual_clean_up9 = __("Transient Options has been cleaned Successfully.",easy_wp_optimizer);
	$ewo_empty_manual_clean_up10 = __("Trackbacks has been cleaned Successfully.",easy_wp_optimizer);
	$ewo_empty_manual_clean_up11 = __("Spam Comments has been cleaned Successfully.",easy_wp_optimizer);
	$ewo_empty_manual_clean_up12 = __("Trash Comments has been cleaned Successfully.",easy_wp_optimizer);
	$ewo_empty_manual_clean_up13 = __("Drafts has been cleaned Successfully.",easy_wp_optimizer);
	$ewo_empty_manual_clean_up14 = __("Deleted Posts has been cleaned Successfully.",easy_wp_optimizer);
	$ewo_empty_manual_clean_up15 = __("Duplicated Post Meta has been cleaned Successfully.",easy_wp_optimizer);
	$ewo_empty_manual_clean_up16 = __("oEmbed Caches in Post Meta has been cleaned Successfully.",easy_wp_optimizer);
	$ewo_empty_manual_clean_up17 = __("Duplicated Comment Meta has been cleaned Successfully.",easy_wp_optimizer);
	$ewo_empty_manual_clean_up18 = __("Orphan User Meta has been cleaned Successfully.",easy_wp_optimizer);
	$ewo_empty_manual_clean_up19 = __("Duplicated User Meta has been cleaned Successfully.",easy_wp_optimizer);
	$ewo_empty_manual_clean_up20 = __("Orphaned Term Relationships has been cleaned Successfully.",easy_wp_optimizer);
	$ewo_empty_manual_clean_up21 = __("Unused Terms has been cleaned Successfully.",easy_wp_optimizer);

	$ewo_choose_action = __("Please choose an Action!", easy_wp_optimizer);
	$ewo_choose_clean_data = __("Please choose atleast 1 type of Data to Clean!",easy_wp_optimizer);
	$ewo_confirm_clean = __("Are you sure you want to Clean ?", easy_wp_optimizer);

	$ewo_choose_delete = __("Please choose atleast 1 record to delete!",easy_wp_optimizer);

	$ewo_add_data_type = __("Please choose atleast 1 Type of Data for scheduling!",easy_wp_optimizer);
	$ewo_perform_action = __("Are you sure you want to perform this action ?", easy_wp_optimizer);

	$ewo_success = __("Success!",easy_wp_optimizer);

	//alert setup

	// System Information

	$ewo_close_system_information = __("Close System Information!",easy_wp_optimizer);
	$ewo_get_system_information = __("Get System Information!",easy_wp_optimizer);
	$ewo_system_information_server_information = __("Server Information",easy_wp_optimizer);
	
	$ewo_system_information_environment_key = __("Environment Key",easy_wp_optimizer);
	$ewo_system_information_environment_value = __("Environment Value",easy_wp_optimizer);
	$ewo_system_information_home_url = __("Home URL",easy_wp_optimizer);
	$ewo_system_information_site_url = __("Site URL",easy_wp_optimizer);
	$ewo_system_information_wp_version = __("WP Version",easy_wp_optimizer);
	$ewo_system_information_wp_multisite = __("WP Multisite Enabled",easy_wp_optimizer);
	$ewo_system_information_wp_remote_post = __("WP Remote Post",easy_wp_optimizer);
	$ewo_system_information_web_server_info = __("Web Server Info",easy_wp_optimizer);
	$ewo_system_information_php_version = __("PHP Version",easy_wp_optimizer);
	$ewo_system_information_mysql_version = __("MySQL Version",easy_wp_optimizer);
	$ewo_system_information_wp_debug_mode = __("WP Debug Mode",easy_wp_optimizer);
	$ewo_system_information_wp_language = __("WP Language",easy_wp_optimizer);
	$ewo_system_information_default = __("Default",easy_wp_optimizer);
	$ewo_system_information_wp_max_upload = __("WP Max Upload Size",easy_wp_optimizer);
	$ewo_system_information_max_execution_time = __("PHP Max Script Execute Time",easy_wp_optimizer);
	$ewo_system_information_max_input_vars = __("PHP Max Input Vars",easy_wp_optimizer);
	$ewo_system_information_suhosin_install = __("SUHOSIN Installed",easy_wp_optimizer);
	$ewo_system_information_default_timezone = __("Default Timezone",easy_wp_optimizer);
	$ewo_system_information_operating_system = __("Operating System",easy_wp_optimizer);
	$ewo_system_information_memory_usage = __("Memory usage",easy_wp_optimizer);
	$ewo_system_information_sql_mode = __("SQL Mode",easy_wp_optimizer);
	$ewo_system_information_php_safe_mode = __("PHP Safe Mode",easy_wp_optimizer);
	$ewo_system_information_url_fopen = __("PHP Allow URL fopen",easy_wp_optimizer);
	$ewo_system_information_php_memory_limit = __("PHP Memory Limit",easy_wp_optimizer);
	$ewo_system_information_max_post_size = __("PHP Max Post Size",easy_wp_optimizer);
	$ewo_system_information_backtracking_limit = __("PCRE Backtracking Limit",easy_wp_optimizer);
	$ewo_system_information_exif_support = __("PHP Exif support",easy_wp_optimizer);
	$ewo_system_information_iptc_support = __("PHP IPTC support",easy_wp_optimizer);
	$ewo_system_information_xml_support = __("PHP XML support",easy_wp_optimizer);
	$ewo_system_information_active_plugin_information = __("Active Plugin Information",easy_wp_optimizer);
	$ewo_system_information_plugin_key = __("Plugin Key",easy_wp_optimizer);
	$ewo_system_information_plugin_value = __("Plugin Value",easy_wp_optimizer);
	$ewo_system_information_theme_information = __("Active Theme Information",easy_wp_optimizer);
	$ewo_system_information_theme_key = __("Theme Key",easy_wp_optimizer);
	$ewo_system_information_theme_value = __("Theme Value",easy_wp_optimizer);
	$ewo_system_information_theme_name = __("Theme Name",easy_wp_optimizer);
	$ewo_system_information_theme_version = __("Theme Version",easy_wp_optimizer);
	$ewo_system_information_author_url = __("Author URL",easy_wp_optimizer);	
	$ewo_system_information_default = __("Default",easy_wp_optimizer);


	// Disclaimer
	$ewo_here_disclaimer = __("here",easy_wp_optimizer);
	$ewo_important_disclaimer = __("Important Disclaimer!",easy_wp_optimizer);
	
	$ewo_easy_wp_optimizer_demos_disclaimer = __("* For Easy WP Optimizer Demos, click ",easy_wp_optimizer);	
	$ewo_easy_wp_optimizer_manual_disclaimer = __("* For Easy WP Optimizer Manual for this page, click ",easy_wp_optimizer);
	
	$ewo_confirm_download = __("Are you sure you want to Download this backp ?", easy_wp_optimizer);	
	$ewo_confirm_restore = __("Are you sure you want to restore this backp ?", easy_wp_optimizer);
	$ewo_confirm_delete = __("Are you sure you want to delete this backp ?", easy_wp_optimizer);
		
	$ewo_restore_database1 = __("Please do not refresh or close the browser, to prevent the program is aborted, if inadvertently! It may result in damage to the structure of the database! ",easy_wp_optimizer);		
	$ewo_restore_database2 = __("Backup data is being imported, please wait!",easy_wp_optimizer);	

	$ewo_download_backup = __("Backup data is being download, please wait!",easy_wp_optimizer);
	
	$delete_backup = 	__("This backup has been deleted Successfully!",easy_wp_optimizer);	
?>