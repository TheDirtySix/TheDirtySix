<?php
	if ( ! defined( 'ABSPATH' ) ) exit;
	if(!ewo_check_user()){return;}
	$wordpress_data_manual_clean_up = wp_create_nonce("wordpress_data_manual_clean_up");
	$empty_manual_clean_up = wp_create_nonce("empty_manual_clean_up");
	
	global $wpdb;
	$prefix = $wpdb->prefix;
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
                        <a href="admin.php?page=ewo_backup_database">Backup Database</a>
                    </li>
                </ul>
            </div>
                                  
			<?php
                if(isset($_REQUEST["action"]))
                {
                    if($_REQUEST["action"] == 'ewo_backup_submit')
                    {
                        echo '<div class="note note-danger margin20px">';
						$tablestr ='';
                        if(count($_POST['ewo_backup_table_name'])>0){
                            foreach ($_POST['ewo_backup_table_name'] as $value)
                            {
                                $arr[]=$value;
								$tablestr .= $value.'|-|';
                            }
                        }
                        
            
                        if(file_exists(EWO_DIR_PATH."includes/class/DbManage.class.php"))
                        {
                            include_once EWO_DIR_PATH."includes/class/DbManage.class.php";
                        }				
                        
                        $db = new ewo_DbManage ( DB_HOST,DB_USER, DB_PASSWORD, DB_NAME, DB_CHARSET );			

                        $filename = date ( 'YmdHis' ) . "_part";
						if(substr($tablestr, -3) == '|-|'){ $tablestr = substr($tablestr,0,strlen($tablestr)-3);}
						
						ewo_create_easy_wp_optimizer_db();
						
						$data = date("Y/m/d/");
						
						$wpdb->insert( 
							$prefix.'easy_wp_optimizer_backup', 
							array( 
								'e_name' => $filename, 
								'e_file_name' => $filename, 								
								'e_table' => $tablestr, 		
								'e_execution_time' => date("Y-m-d h:i:sa"), 
								'e_path' => '/Easy-WP-Optimizer/'.$data, 																					
								'e_status' => '	Backup Successfully'
							), 
							array( 
								'%s','%s','%s','%s',
								'%s' 
							) 
						);
												
                        $db->backup ($arr,WP_CONTENT_DIR.'/Easy-WP-Optimizer/'.$data,'');
  
                        echo '</div>'; 
						
						
						$db_size = $db->getfilesize(WP_CONTENT_DIR.'/Easy-WP-Optimizer/'.$data.$filename.'_v1.sql');
						
						$table = $prefix.'easy_wp_optimizer_backup';  
						$data_array = array(  
						 'e_file_size' => $db_size 
						);  
						$where_clause = array(  
						'e_name' => $filename 
						);  
						$wpdb->update($table,$data_array,$where_clause); 					

						
						
                    }
                }            
            ?>

			<div class="page-form">
                <form id="ewo_backup_db_form" method="post" action="">

                <?php
					$prefix = $wpdb->prefix;
					$sql = sprintf("
					 SHOW FULL TABLES
					 FROM `%s`
					WHERE table_type = 'BASE TABLE'		
					", DB_NAME);	
					
					$ewo_db_arr = $wpdb->get_results($sql, ARRAY_N);	
					
					$ewo_db_num = count($ewo_db_arr);//19
				?>
				<label class="control-label">             
                	Backup Tables :
					<i class="icon-custom-question tooltips" data-original-title="Please select the Tables for which you want to create Backup." data-placement="right"></i>
					<span class="required" aria-required="true">*&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    
                    <sapn>                    
                        <input id="ewo_select_all_db_backup" name="ewo_select_all_db_backup" type="checkbox" checked="checked" value="1">Check All &nbsp;&nbsp;&nbsp;&nbsp;
                        <input id="ewo_select_all_wordPress_db_backup" name="ewo_select_all_wordPress_db_backup" type="checkbox" value="1">Check all WordPress tables                   
                    </span>                      
                    
				</label> 
 				<p></p>
                             
				<table class="table table-striped table-bordered table-hover table-margin-top" id="ewo_database_tables">
					<tbody>				
					<?php	
		
					for($i=0;$i<$ewo_db_num;$i++){//$ewo_db_num
						if($i%2 == 0)
						{
					?> 
                        <tr>          
                            <td class="table-checked">
                                <input id="ewo_<?php echo $ewo_db_arr[$i][0];?>" name="ewo_backup_table_name[]" type="checkbox" checked="checked" value="<?php echo $ewo_db_arr[$i][0];?>">
                                
                            </td>
                            <td>
                            	<label class="f13"><?php echo $ewo_db_arr[$i][0];?></label>
                            </td>
                        <?php 
							}
							else{
						?>    
                            <td class="table-checked">
                                <input id="ewo_<?php echo $ewo_db_arr[$i][0];?>" name="ewo_backup_table_name[]" type="checkbox" checked="checked" value="<?php echo $ewo_db_arr[$i][0];?>">
                                
                            </td>
                            <td>
                            	<label class="f13"><?php echo $ewo_db_arr[$i][0];?></label>
                            </td>
                        </tr>  
                       	<?php 
							}
							if($i == $ewo_db_num - 1 && $i % 2 == 0)
							{
						?>

								<td class="table-checked">
								</td>
								<td>
									<label></label>
								</td>
							</tr>
						<?php
							}					
						}
						?>
					</tbody>
				</table>
				<input name="action" type="hidden" value="ewo_backup_submit" />
				<div class="buttom-right"><input type="submit" class="backup_button" name="submit" id="submit"  value="<?php echo 'Create Backup'//_e('Create Backup','backup_db');  ?>"  /></div>
                </form>
                
				<style type="text/css">
                *{
                    margin: 0;
                    padding: 0;
                }
                
                
                .dbDebug{
                }
                
                .dbDebug .err{
                    color: #f00;
                    margin: 0 5px 0 0;
                
                }
                .dbDebug .ok{
                    color: #06f;
                    margin: 0 5px 0 0;
                
                }
                .dbDebug b{
                    color: #06f;
                    font-weight: normal;
                }
                
                .dbDebug .imp{
                    color: #f06;
                }
                </style>
 

			</div><!--div class="page-form"-->
    	</div><!--div class="page"-->
    </div><!--div class="content"-->  
    <p class="ewo_clear"></p>
</div>
<script>

	jQuery(document).ready(function()
	{
		jQuery("#ewo_select_all_db_backup").click(function()
		{
			var check = jQuery(this);
			jQuery("#ewo_backup_db_form input[type=checkbox]").each(function()
			{
				jQuery(this).prop("checked", check.is(":checked"));
			})
		});	
		
		jQuery("#ewo_select_all_wordPress_db_backup").click(function()
		{
			var check = jQuery(this);
			jQuery("#ewo_backup_db_form input[id^=ewo_<?php echo $prefix;?>]").each(function()
			{
				jQuery(this).prop("checked", check.is(":checked"));
			})
		});
	});	

</script>
<?php
	if(file_exists(EWO_DIR_PATH."includes/inc/footer.php"))
	{
		include_once EWO_DIR_PATH."includes/inc/footer.php";
	}	
?> 