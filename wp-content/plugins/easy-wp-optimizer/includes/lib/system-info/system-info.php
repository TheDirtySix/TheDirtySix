<?php
	if ( ! defined( 'ABSPATH' ) ) exit;
	if(!ewo_check_user()){return;}
?>
<div id="ewo_page" class="warp">

<?php
	if(file_exists(EWO_DIR_PATH."includes/inc/sidebar.php"))
	{
		include_once EWO_DIR_PATH."includes/inc/sidebar.php";
	}	
?>  
    <div class="content">	
        <div class="page">
        
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="iconfont-home"></i>
                        <a href="admin.php?page=ewo_easy_wp_optimizer">Easy WP Optimizer</a>
                        <span>&gt;</span>
                    </li>
                    <li>
                        <a href="admin.php?page=ewo_system_info">System Information</a>
                    </li>
                </ul>
            </div>

			<div class="page-form">
				<h3 class="form-section">Server Information</h3>
				<table class="table table-striped table-bordered table-hover" >
					<thead class="align-thead-left">
						<tr>
							<th class="custom-table-th-left width40percent" >Environment Key</th>
							<th class="custom-table-th-right">Environment Value</th>
						</tr>
					</thead>
					<tbody>
                        <tr>
                            <td>
                                <strong>
                                    <?php echo $ewo_system_information_home_url; ?> :
                                </strong>
                            </td>
                            <td>
                                <span>
                                    <?php echo home_url(); ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>
                                    <?php echo $ewo_system_information_site_url; ?> :
                                </strong>
                            </td>
                            <td>
                                <span>
                                    <?php echo site_url(); ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>
                                    <?php echo $ewo_system_information_wp_version; ?> :
                                </strong>
                            </td>
                            <td>
                                <span>
                                    <?php echo bloginfo("version");?>
                                </span>
                            </td>
                        </tr>
 
                        <tr>
                            <td>
                                <strong>
                                    <?php echo $ewo_system_information_web_server_info; ?> :
                                </strong>
                            </td>
                            <td>
                                <span>
                                    <?php echo esc_html($_SERVER["SERVER_SOFTWARE"]);?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>
                                    <?php echo $ewo_system_information_php_version; ?> :
                                </strong>
                            </td>
                            <td>
                                <span>
                                    <?php if (function_exists("phpversion")) echo esc_html(phpversion());?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>
                                    <?php echo $ewo_system_information_mysql_version; ?> :
                                </strong>
                            </td>
                            <td>
                                <span>
                                    <?php global $wpdb; echo $wpdb->db_version();?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>
                                    <?php echo $ewo_system_information_wp_debug_mode; ?> :
                                </strong>
                            </td>
                            <td>
                                <span>
                                    <?php if (defined("WP_DEBUG") && WP_DEBUG) echo "Yes"; else echo "No"; ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>
                                    <?php echo $ewo_system_information_wp_language; ?> :
                                </strong>
                            </td>
                            <td>
                                <span>
                                    <?php echo get_locale(); ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>
                                    <?php echo $ewo_system_information_wp_max_upload; ?> :
                                </strong>
                            </td>
                            <td>
                                <span>
                                    <?php echo size_format(wp_max_upload_size()); ?>
                                </span>
                            </td>
                        </tr>

                        <?php if (function_exists("ini_get")) : ?>
                        <tr>
                            <td>
                                <strong>
                                    <?php echo $ewo_system_information_max_execution_time; ?> :
                                </strong>
                            </td>
                            <td>
                                <span>
                                    <?php echo ini_get("max_execution_time"); ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>
                                    <?php echo $ewo_system_information_max_input_vars; ?> :
                                </strong>
                            </td>
                            <td>
                                <span>
                                    <?php echo ini_get("max_input_vars"); ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>
                                    <?php echo $ewo_system_information_suhosin_install; ?> :
                                </strong>
                            </td>
                            <td>
                                <span>
                                    <?php echo extension_loaded("suhosin") ? "Yes" : "No";?>
                                </span>
                            </td>
                        </tr>
                        <?php endif; ?>                        
                        
                        <tr>
                            <td>
                                <strong>
                                    <?php echo $ewo_system_information_default_timezone; ?> :
                                </strong>
                            </td>
                            <td>
                                <span>
                                    <?php
                                        $timezone = date_default_timezone_get();
                                        if ("UTC" !== $timezone)
                                        {
                                            echo sprintf("Default timezone is %s - it should be UTC", $timezone);
                                        }
                                        else
                                        {
                                            echo sprintf("Default timezone is %s", $timezone);
                                        }
                                    ?>
                                </span>
                            </td>
                        </tr>
                        
						<?php
                        global $wpdb, $bb;
                        // Get MYSQL Version
                        $sql_version = $wpdb->get_var("SELECT VERSION() AS version");
                        // GET SQL Mode
                        $my_sql_info = $wpdb->get_results("SHOW VARIABLES LIKE \"sql_mode\"");
                        if (is_array($my_sql_info)) $sqlmode = $my_sql_info[0]->Value;
                        if (empty($sqlmode)) $sqlmode = "Not set";
                        // Get PHP Safe Mode
                        if (ini_get("safemode")) $safemode = "On";
                        else $safemode = "Off";
                        // Get PHP allow_url_fopen
                        if (ini_get("allow-url-fopen")) $allowurlfopen = "On";
                        else $allowurlfopen = "Off";
                        // Get PHP Max Upload Size
                        if (ini_get("upload_max_filesize")) $upload_maximum = ini_get("upload_max_filesize");
                        else $upload_maximum = "N/A";
                        // Get PHP Output buffer Size
                        if (ini_get("pcre.backtrack_limit")) $backtrack_lmt = ini_get("pcre.backtrack_limit");
                        else $backtrack_lmt = "N/A";
                        // Get PHP Max Post Size
                        if (ini_get("post_max_size")) $post_maximum = ini_get("post_max_size");
                        else $post_maximum = "N/A";
                        // Get PHP Memory Limit
                        if (ini_get("memory_limit")) $memory_limit = ini_get("memory_limit");
                        else $memory_limit = "N/A";
                        // Get actual memory_get_usage
                        if (function_exists("memory_get_usage")) $memory_usage = round(memory_get_usage() / 1024 / 1024, 2) . " MByte";
                        else $memory_usage = "N/A";
                        // required for EXIF read
                        if (is_callable("exif_read_data")) $exif = "Yes" . " ( V" . substr(phpversion("exif"), 0, 4) . ")";
                        else $exif = "No";
                        // required for meta data
                        if (is_callable("iptcparse")) $iptc = "Yes";
                        else $iptc = "No";
                        // required for meta data
                        if (is_callable("xml_parser_create")) $xml = "Yes";
                        else $xml = "No";
                        ?>
                        <tr>
                            <td>
                                <strong>
                                    <?php echo $ewo_system_information_operating_system; ?> :
                                </strong>
                            </td>
                            <td>
                                <span>
                                    <?php echo PHP_OS; ?>&nbsp;(<?php echo(PHP_INT_SIZE * 8) ?>&nbsp;Bit)
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>
                                    <?php echo $ewo_system_information_memory_usage; ?> :
                                </strong>
                            </td>
                            <td>
                                <span>
                                    <?php echo $memory_usage; ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>
                                    <?php echo $ewo_system_information_sql_mode; ?> :
                                </strong>
                            </td>
                            <td>
                                <span>
                                    <?php echo $sqlmode; ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>
                                    <?php echo $ewo_system_information_php_safe_mode; ?> :
                                </strong>
                            </td>
                            <td>
                                <span>
                                    <?php echo $safemode; ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>
                                    <?php echo $ewo_system_information_url_fopen; ?> :
                                </strong>
                            </td>
                            <td>
                                <span>
                                    <?php echo $allowurlfopen; ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>
                                    <?php echo $ewo_system_information_php_memory_limit; ?> :
                                </strong>
                            </td>
                            <td>
                                <span>
                                    <?php echo $memory_limit; ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>
                                    <?php echo $ewo_system_information_max_post_size; ?> :
                                </strong>
                            </td>
                            <td>
                                <span>
                                    <?php echo $post_maximum; ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>
                                    <?php echo $ewo_system_information_backtracking_limit; ?> :
                                </strong>
                            </td>
                            <td>
                                <span>
                                    <?php echo $backtrack_lmt; ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>
                                    <?php echo $ewo_system_information_exif_support; ?> :
                                </strong>
                            </td>
                            <td>
                                <span>
                                    <?php echo $exif; ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>
                                    <?php echo $ewo_system_information_iptc_support; ?> :
                                </strong>
                            </td>
                            <td>
                                <span>
                                    <?php echo $iptc; ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>
                                    <?php echo $ewo_system_information_xml_support; ?> :
                                </strong>
                            </td>
                            <td>
                                <span>
                                    <?php echo $xml; ?>
                                </span>
                            </td>
                        </tr>
					</tbody>
				</table>
			</div><!--div class="page-form"-->
    
            
			<div class="page-form">
                <h3 class="form-section">
                    <?php echo $ewo_system_information_active_plugin_information; ?>
                </h3>
                <table class="table table-striped table-bordered table-hover">
                    <thead class="align-thead-left">
                        <tr>
                            <th class="custom-table-th-left width40percent">
                                <?php echo $ewo_system_information_plugin_key; ?>
                            </th>
                            <th class="custom-table-th-right">
                                <?php echo $ewo_system_information_plugin_value; ?>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $active_plugins = (array)get_option("active_plugins", array());

                         $get_plugins = array();
    
                        foreach ($active_plugins as $plugin)
                        {
                            $plugin_data = @get_plugin_data(WP_PLUGIN_DIR . "/" . $plugin);
                            $version_string = "";
                            if (!empty($plugin_data["Name"]))
                            {
                                $plugin_name = $plugin_data["Name"];
                                if (!empty($plugin_data["PluginURI"]))
                                {
                                    $plugin_name = "<tr><td><strong>" . $plugin_name . " :</strong></td><td><span>". "By " . $plugin_data["Author"] . "<br/> Version " . $plugin_data["Version"] . $version_string."</span></td></tr>";
                                }
                                echo $plugin_name;
                            }
                        }
                    ?>
                    </tbody>
                </table>
			</div><!--div class="page-form"-->
 
 
			<?php
            global $wp_version;
            if($wp_version >= 3.4)
            {
                $active_theme = wp_get_theme ();
            ?>
            <div class="page-form">
                <h3 class="form-section">
                    <?php echo $ewo_system_information_theme_information; ?>
                </h3>
                <table class="table table-striped table-bordered table-hover">
                    <thead class="align-thead-left">
                        <tr>
                            <th class="width40percent custom-table-th-left">
                                <?php echo $ewo_system_information_theme_key; ?>
                            </th>
                            <th class="custom-table-th-right">
                                <?php echo $ewo_system_information_theme_value; ?>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <strong>
                                    <?php echo $ewo_system_information_theme_name; ?> :
                                </strong>
                            </td>
                            <td>
                                <span>
                                    <?php echo $active_theme->Name; ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>
                                    <?php echo $ewo_system_information_theme_version; ?> :
                                </strong>
                            </td>
                            <td>
                                <span>
                                    <?php echo $active_theme->Version;?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>
                                    <?php echo $ewo_system_information_author_url; ?> :
                                </strong>
                            </td>
                            <td>
                                <span>
                                    <a href="<?php echo $active_theme->{"Author URI"}; ?>"
                                        target="_blank"><?php echo $active_theme->{"Author URI"}; ?>
                                    </a>
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <?php
            }
            ?> 

    	</div><!--div class="page"-->
    </div><!--div class="content"-->
    <p class="ewo_clear"></p>
</div>