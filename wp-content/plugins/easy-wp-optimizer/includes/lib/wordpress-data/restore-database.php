<?php
	if ( ! defined( 'ABSPATH' ) ) exit;
	if(!ewo_check_user()){return;}
	$ewo_download_backup_nonce  = wp_create_nonce("ewo_download_backup_nonce");
	$ewo_restore_backup_nonce = wp_create_nonce("ewo_restore_backup_nonce");
	$ewo_delete_backup_nonce = wp_create_nonce("ewo_delete_backup_nonce");	
	
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
                        <a href="admin.php?page=ewo_restore_database">Restore Database</a>
                    </li>
                </ul>
            </div>
            
            
			<?php

				if(file_exists(EWO_DIR_PATH."includes/class/DbManage.class.php"))
				{
					include_once EWO_DIR_PATH."includes/class/DbManage.class.php";
				}				
				
				$db = new ewo_DbManage ( DB_HOST,DB_USER, DB_PASSWORD, DB_NAME, DB_CHARSET );            
       
            ?>              
            
			<div class="page-form">

            <form id="ewo_restore_db_form" method="post" action="">               
			<table class="table table-striped table-bordered table-hover table-margin-top" id="ewo_manage_backups">
            
                <?php
				
					
					$i=0;
					$a = $wpdb->get_results("SELECT * FROM wp_easy_wp_optimizer_backup order by e_id desc");
					
					if( empty($a))
					{
				?>		
					<p class="ewo_clear"></p>
					<p class="f20">No Backup!  Click <a href="admin.php?page=ewo_backup_database">Backup Database</a> to Backup</p>
				
				<?php		
					}            
            	?>
                
				<?php
					if( !empty($a))
					{
				?>                
            
				<thead>
					<tr>
						<th class="center chk-action"  style="width:5%;">
							<input type="checkbox" name="ewo_chk_all_manage_backups" id="ewo_chk_all_manage_backups">
						</th>
						<th style="width:35%;">
							<label>Backup Details</label>
						</th>
                        
                        <th style="width:15%;">
							<label>Status</label>
						</th>                        

                        <th class="center"  style="width:25%;">
                            <label>Download</label>
                        </th>
                        
                         <th class="center"  style="width:10%;">
                            <label>Retore</label>
                        </th>                       
                         <th class="center"  style="width:10%;">
                            <label>Delete</label>
                        </th>
					</tr>
				</thead>
                <?php }?>
				<tbody>
                
				<?php
					if( !empty($a))
					{
					
						foreach ($a as $b)
						{
							$i++;						
							//$num = $db->getfilenum ( WP_CONTENT_DIR.$b->e_path.$b->e_file_name.'_v1.sql');
				?>                
						<tr>
							<td class="center">
								<input type="checkbox" name="ewo_chk_manage_backups_15" id="ewo_chk_manage_backups_15" onclick="check_all_manage_backups(15)" value="15">
							</td>
							<td>
								<label class="control-label">
									<strong>Backup Name: </strong><?php echo $b->e_name;?>
								</label><br>
								<?php if ($b->e_type !=''){?>
								<label class="control-label">
									<strong>Backup Type: </strong><?php echo $b->e_type;?>
								</label><br>
								<?php }?>
								<?php if ($b->e_destination !=''){?>
								<label class="control-label">
									<strong>Backup Destination: </strong><?php echo $b->e_destination;?>
								</label><br>
								<?php }?>
								<?php if ($b->e_compression_type !=''){?>
								<label class="control-label">
									<strong>Compression Type: </strong><?php echo $b->e_compression_type;?>
								</label><br>
								<?php }?>
								<?php if ($b->e_execution_type !=''){?>
								<label class="control-label">
									<strong>Execution: </strong><?php echo $b->e_execution_type;?>
								</label><br>
								<?php }?>
								<?php if ($b->e_execution_time !=''){?>
								<label class="control-label">
									<strong>Executed In: </strong><?php echo $b->e_execution_time;?>
								</label><br>
								<?php }?>
								<?php if ($b->e_file_size !=''){?>
								<label class="control-label">
									<strong>Total Size: </strong><?php echo $b->e_file_size;?>
								</label><br>
								<?php }?>	
								<?php 
									if ($b->e_table !='')
									{
								?>
								<label class="control-label">
									<strong>Backup table: </strong><?php echo str_replace("|-|", ", ", $b->e_table);?>
								</label><br>
								<?php }?>                           
								
							</td>
                            
							<td>
								<?php echo $b->e_status;?>
							</td>                            
                            
							
							<td class="execss">
								
								<select name="ewo_download_backup_<?php echo $i;?>" id="ewo_download_backup_<?php echo $i;?>" class="form-control" style="display:none">
									<option value="<?php echo WP_CONTENT_URL.$b->e_path.$b->e_file_name.'_v1.sql';?>"><?php echo $b->e_file_name;?></option>
								</select> 
                                
                                                  
 								<a href="admin.php?page=ewo_restore_database&path=<?php echo $b->e_path?>&filename=<?php echo $b->e_file_name?>"  class="myButton">
									Download
								</a>
							</td>
							
                            
							<td class="execss">	
								<select name="ewo_restore_backup_<?php echo $i;?>" id="ewo_restore_backup_<?php echo $i;?>" class="form-control" style="display:none;">	
									<option value="<?php echo base64_encode(WP_CONTENT_DIR.$b->e_path.'|-|'.$b->e_file_name.'|-|_v1.sql');?>"><?php echo $b->e_file_name;?></option>				
								</select>
								<a href="javascript:void(0);"  data-popup-open="ewo_open_popup" onclick="ewo_restore_backup(<?php echo $i;?>);" class="myButton">
									Restore
								</a>
							</td>
							
							
							<td class="execsswith">
								<a href="javascript:void(0);" onclick="ewo_delete_backup(<?php echo "'".base64_encode($b->e_path.'|-|'.$b->e_file_name)."'";?>);" class="myButton">
									Delete
								</a>
							</td>
						</tr>

				<?php
						} //foreach ($a as $b)
					}//if( empty($a))
				?>                    
                    
				<input name="action" type="hidden" value="ewo_restore_submit" />
            	</tbody>
			</table>
            </form>                    

                
			</div><!--div class="page-form"-->
    	</div><!--div class="page"-->


    </div><!--div class="content"-->
    <p class="ewo_clear"></p>
</div>

<?php
	if(file_exists(EWO_DIR_PATH."includes/inc/footer.php"))
	{
		include_once EWO_DIR_PATH."includes/inc/footer.php";
	}	
?>

<script>

	if(typeof(ewo_restore_backup) != "function")
	{
		function ewo_restore_backup(id)
		{
			var selected_restore = confirm(<?php echo json_encode($ewo_confirm_restore); ?>);
			
			if(selected_restore == true)
			{
				var restore_link = jQuery("#ewo_restore_backup_"+id+" option:selected").val();

				if(restore_link != "")
				{
					ewo_overlay_loading_easy_wp_optimizer("Restore_database2");
					
					toastr.options = {
					  "closeButton": true,
					  "debug": false,
					  "newestOnTop": false,
					  "progressBar": false,
					  "positionClass": "toast-top-center",
					  "preventDuplicates": false,
					  "onclick": null,
					  "showDuration": "300",
					  "hideDuration": "1000",
					  "timeOut": "400000",
					  "extendedTimeOut": "40000",
					  "showEasing": "swing",
					  "hideEasing": "linear",
					  "showMethod": "fadeIn",
					  "hideMethod": "fadeOut"
					}
	
					toastr.warning('Please do not refresh or close the browser, to prevent the program is aborted, if inadvertently! It may result in damage to the structure of the database!');

					jQuery.post(ajaxurl,
					{
						fileurl: JSON.stringify(restore_link),
						param: "restore_data",
						action: "restore_data_action",
						_wp_nonce: "<?php echo $ewo_restore_backup_nonce;?>"
					},
					function(data)
					{
						setTimeout(function()
						{
							ewo_remove_overlay_loading_easy_wp_optimizer();
							window.location.href = "admin.php?page=ewo_restore_database";
						}, 3000);
					});	
				}
				else
				{
					window.location.href = "admin.php?page=ewo_restore_database";
				}
			}
		}
	}	
	
	if(typeof(ewo_delete_backup) != "function")
	{
		function ewo_delete_backup(str)
		{
			var selected_del = confirm(<?php echo json_encode($ewo_confirm_delete); ?>);
			
			if(selected_del == true)
			{
				var path_str = str;
				if(path_str != "")
				{
					ewo_overlay_loading_easy_wp_optimizer("delete_backup");
					jQuery.post(ajaxurl,
					{
						fileurl: JSON.stringify(path_str),
						param: "delete_backup",
						action: "delete_backup_action",
						_wp_nonce: "<?php echo $ewo_delete_backup_nonce;?>"
					},
					function(data)
					{
						setTimeout(function()
						{
							ewo_remove_overlay_loading_easy_wp_optimizer();
							window.location.href = "admin.php?page=ewo_restore_database";
						}, 3000);
					});		
				}
				else
				{
					window.location.href = "admin.php?page=ewo_restore_database";
				}
			}
		}		
	}	
</script>