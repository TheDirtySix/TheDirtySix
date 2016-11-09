<script type="text/javascript">
	if(typeof(ewo_bulk_empty_easy_wp_optimizer) != "function")
	{
		function ewo_bulk_empty_easy_wp_optimizer()
		{
			var confirm_action = jQuery("#ewo_bulk_action").val();
			if(confirm_action == "")
			{
				alert(<?php echo json_encode($ewo_choose_action); ?>);
			}
			else
			{
				chk_array = [];
				var checks = jQuery(".check-all input:checkbox:checked").each(function()
				{
					chk_array.push(jQuery(this).val());
				}).get();
				if(chk_array.length < 1)
				{
					alert(<?php echo json_encode($ewo_choose_clean_data); ?>);

				}
				else
				{
					var empty_data = confirm(<?php echo json_encode($ewo_confirm_clean); ?>);
					if(empty_data == true)
					{
						ewo_overlay_loading_easy_wp_optimizer("empty_manual_clean_up");
						jQuery.post(ajaxurl,
						{
							data: JSON.stringify(chk_array),
							param: "manual_clean_up_wp_data_all",
							action: "clean_up_wp_data_action",
							_wp_nonce: "<?php echo $wordpress_data_manual_clean_up;?>"
						},
						function(data)
						{
							setTimeout(function()
							{
								ewo_remove_overlay_loading_easy_wp_optimizer();
								window.location.href = "admin.php?page=ewo_easy_wp_optimizer";
							}, 2000);
						});
					}
				}
			}//if(confirm_action == "") else
			
		}//function ewo_bulk_empty_easy_wp_optimizer()
	}
	

	if(typeof(ewo_overlay_loading_easy_wp_optimizer) != "function")
	{
		function ewo_overlay_loading_easy_wp_optimizer(control_id)
		{
			var overlay_opacity = jQuery("<div class=\"opacity_overlay\"></div>");
			jQuery("body").append(overlay_opacity);
			var overlay = jQuery("<div class=\"loader_opacity\"><div class=\"processing_overlay\"></div></div>");
			jQuery("body").append(overlay);
	
			if(control_id != undefined)
			{
				switch(control_id)
				{
					case "empty_manual_clean_up":
						var message = <?php echo json_encode($ewo_empty_manual_clean_up_data);?>;
						var success = <?php echo json_encode($ewo_success);?>;
					break;
					case "empty_manual_clean_up1":
						var message = <?php echo json_encode($ewo_empty_manual_clean_up1);?>;
						var success = <?php echo json_encode($ewo_success);?>;
					break;
					case "empty_manual_clean_up2":
						var message = <?php echo json_encode($ewo_empty_manual_clean_up2);?>;
						var success = <?php echo json_encode($ewo_success);?>;
					break;

					case "empty_manual_clean_up3":
						var message = <?php echo json_encode($ewo_empty_manual_clean_up3);?>;
						var success = <?php echo json_encode($ewo_success);?>;
					break;

					case "empty_manual_clean_up4":
						var message = <?php echo json_encode($ewo_empty_manual_clean_up4);?>;
						var success = <?php echo json_encode($ewo_success);?>;
					break;

					case "empty_manual_clean_up5":
						var message = <?php echo json_encode($ewo_empty_manual_clean_up5);?>;
						var success = <?php echo json_encode($ewo_success);?>;
					break;

					case "empty_manual_clean_up6":
						var message = <?php echo json_encode($ewo_empty_manual_clean_up6);?>;
						var success = <?php echo json_encode($ewo_success);?>;
					break;

					case "empty_manual_clean_up7":
						var message = <?php echo json_encode($ewo_empty_manual_clean_up7);?>;
						var success = <?php echo json_encode($ewo_success);?>;
					break;

					case "empty_manual_clean_up8":
						var message = <?php echo json_encode($ewo_empty_manual_clean_up8);?>;
						var success = <?php echo json_encode($ewo_success);?>;
					break;

					case "empty_manual_clean_up9":
						var message = <?php echo json_encode($ewo_empty_manual_clean_up9);?>;
						var success = <?php echo json_encode($ewo_success);?>;
					break;

					case "empty_manual_clean_up10":
						var message = <?php echo json_encode($ewo_empty_manual_clean_up10);?>;
						var success = <?php echo json_encode($ewo_success);?>;
					break;

					case "empty_manual_clean_up11":
						var message = <?php echo json_encode($ewo_empty_manual_clean_up11);?>;
						var success = <?php echo json_encode($ewo_success);?>;
					break;

					case "empty_manual_clean_up12":
						var message = <?php echo json_encode($ewo_empty_manual_clean_up12);?>;
						var success = <?php echo json_encode($ewo_success);?>;
					break;

					case "empty_manual_clean_up13":
						var message = <?php echo json_encode($ewo_empty_manual_clean_up13);?>;
						var success = <?php echo json_encode($ewo_success);?>;
					break;

					case "empty_manual_clean_up14":
						var message = <?php echo json_encode($ewo_empty_manual_clean_up14);?>;
						var success = <?php echo json_encode($ewo_success);?>;
					break;

					case "empty_manual_clean_up15":
						var message = <?php echo json_encode($ewo_empty_manual_clean_up15);?>;
						var success = <?php echo json_encode($ewo_success);?>;
					break;

					case "empty_manual_clean_up16":
						var message = <?php echo json_encode($ewo_empty_manual_clean_up16);?>;
						var success = <?php echo json_encode($ewo_success);?>;
					break;

					case "empty_manual_clean_up17":
						var message = <?php echo json_encode($ewo_empty_manual_clean_up17);?>;
						var success = <?php echo json_encode($ewo_success);?>;
					break;

					case "empty_manual_clean_up18":
						var message = <?php echo json_encode($ewo_empty_manual_clean_up18);?>;
						var success = <?php echo json_encode($ewo_success);?>;
					break;

					case "empty_manual_clean_up19":
						var message = <?php echo json_encode($ewo_empty_manual_clean_up19);?>;
						var success = <?php echo json_encode($ewo_success);?>;
					break;

					case "empty_manual_clean_up20":
						var message = <?php echo json_encode($ewo_empty_manual_clean_up20);?>;
						var success = <?php echo json_encode($ewo_success);?>;
					break;

					case "empty_manual_clean_up21":
						var message = <?php echo json_encode($ewo_empty_manual_clean_up21);?>;
						var success = <?php echo json_encode($ewo_success);?>;
					break;
					
					case "Restore_database1":
						var message = <?php echo json_encode($ewo_restore_database1);?>;
						var success = <?php echo json_encode($ewo_success);?>;
					break;	
				
					case "Restore_database2":
						var message = <?php echo json_encode($ewo_restore_database2);?>;
						var success = <?php echo json_encode($ewo_success);?>;
					break;						
					
					case "delete_backup":
						var message = <?php echo json_encode($delete_backup);?>;
						var success = <?php echo json_encode($ewo_success);?>;
					break;							
				}

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
				  "timeOut": "4000",
				  "extendedTimeOut": "1000",
				  "showEasing": "swing",
				  "hideEasing": "linear",
				  "showMethod": "fadeIn",
				  "hideMethod": "fadeOut"
				}

				toastr.success(success+ '  ' +message);
			}	
		}
	}	
	
	if (typeof(ewo_remove_overlay_loading_easy_wp_optimizer) != "function")
	{
		function ewo_remove_overlay_loading_easy_wp_optimizer()
		{
			jQuery(".loader_opacity").remove();
			jQuery(".opacity_overlay").remove();
		}
	}

	if(typeof(ewo_selected_empty_easy_wp_optimizer) != "function")
	{
		function ewo_selected_empty_easy_wp_optimizer(id)
		{
			var selected_empty = confirm(<?php echo json_encode($ewo_confirm_clean); ?>);
			if(selected_empty == true)
			{
				ewo_overlay_loading_easy_wp_optimizer("empty_manual_clean_up"+id);
				jQuery.post(ajaxurl,
				{
					delete_id: id,
					param: "manual_clean_up_wp_data",
					action: "clean_up_wp_data_action",
					_wp_nonce: "<?php echo $empty_manual_clean_up;?>"
				},
				function(data)
				{
					setTimeout(function()
					{
						ewo_remove_overlay_loading_easy_wp_optimizer();
						window.location.href = "admin.php?page=ewo_easy_wp_optimizer";
					}, 3000);
				});
			}
		}
	}
	
	
	jQuery(document).ready(function()
	{
		jQuery("#ewo_manual_clean_up_select_all").click(function()
		{
			var check1 = jQuery(this);
			jQuery("#ewo_manual_clean_up input[type=checkbox]").each(function()
			{
				jQuery(this).prop("checked", check1.is(":checked"));
			})
		});
		
	});		
	
	/*jQuery(".tooltips").tooltip_tip({placement: "right"});*/	

</script>