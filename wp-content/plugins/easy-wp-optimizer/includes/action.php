<?php
	if ( ! defined( 'ABSPATH' ) ) exit;
	if(!ewo_check_user()){return;}

	if(file_exists(EWO_DIR_PATH."includes/languages.php"))
	{
		include EWO_DIR_PATH."includes/languages.php";
	}
				
	if(isset($_REQUEST["param"]))
	{
		switch(esc_attr($_REQUEST["param"]))
		{
			case "manual_clean_up_wp_data_all":
				if(wp_verify_nonce(esc_attr($_REQUEST["_wp_nonce"]),"wordpress_data_manual_clean_up"))
				{
					$types = json_decode(stripslashes(html_entity_decode($_REQUEST["data"])));
					for($flag = 0; $flag < count($types); $flag++)
					{
						ewo_easy_wp_optimizer_data($types[$flag]);
					}
				}
			break;
	
			case "manual_clean_up_wp_data":
				
				if(wp_verify_nonce(esc_attr($_REQUEST["_wp_nonce"]),"empty_manual_clean_up"))
				{
					$types = intval($_REQUEST["delete_id"]);//1
					ewo_easy_wp_optimizer_data($types);
				}
			break;
	
	
			case "restore_data":
				
				if(wp_verify_nonce(esc_attr($_REQUEST["_wp_nonce"]),"ewo_restore_backup_nonce"))
				{
					$types = base64_decode($_REQUEST["fileurl"]);//1
					$arr_types  = explode('|-|', $types);
					$path_url = str_replace("|-|", "",$types);
					
					
					if(file_exists(EWO_DIR_PATH."includes/class/DbManage.class.php"))
					{
						include_once EWO_DIR_PATH."includes/class/DbManage.class.php";
					}				
					
					$db = new ewo_DbManage ( DB_HOST,DB_USER, DB_PASSWORD, DB_NAME, DB_CHARSET );  
					
					$db->restore($path_url);
					
					global $wpdb;
					$prefix = $wpdb->prefix;
					$table = $prefix.'easy_wp_optimizer_backup';  
					$data_array = array(  
					 'e_status' => 'Restored Successfully'  
					);  
					$where_clause = array(  
					'e_name' => $arr_types[1]  
					);  
					$wpdb->update($table,$data_array,$where_clause); 					

				}
			break;	
			
	
			case "delete_backup":
				
				if(wp_verify_nonce(esc_attr($_REQUEST["_wp_nonce"]),"ewo_delete_backup_nonce"))
				{
					$types = base64_decode($_REQUEST["fileurl"]);
					$arr = explode("|-|",$types);
					
					global $wpdb;
					$prefix = $wpdb->prefix;
					$wpdb->delete( $prefix.'easy_wp_optimizer_backup', array( 'e_name' => $arr[1] ), array( '%s' ) );
					
					$sqlfile = WP_CONTENT_DIR.$arr[0].$arr[1].'_v1.sql';
					
					//delete backup file
					if (! file_exists ( $sqlfile )) {
						return ;
					}else{

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
							
							unlink($tmpfile);
	
							$volume_id ++;
							//echo $volume_id;
						}//while ( $volume_id )
					}
					//ewo_easy_wp_optimizer_data($types);
				}
			break;		
		}
		die();
	}

	
	//Specific process data function
	function ewo_easy_wp_optimizer_data($types)
	{
		global $wpdb;
		$where = array();
		switch($types)
		{
			case 1:
				$where["post_status"] = "auto-draft";
				global $wpdb;
				$wpdb->delete($wpdb->posts,$where);
			break;

			case 2:
				$wpdb->query
				(
					$wpdb->prepare
					(
						"DELETE FROM " . $wpdb->options . " WHERE option_name LIKE %s OR option_name LIKE %s OR option_name LIKE %s OR option_name LIKE %s",
						"_site_transient_browser_%",
						"_site_transient_timeout_browser_%",
						"_transient_feed_%",
						"_transient_timeout_feed_%"
					)
				);
			break;
	
			case 3:
				$where["comment_approved"] = "0";
				global $wpdb;
				$wpdb->delete($wpdb->comments,$where);						
				
				
			break;
	
			case 4:
				$wpdb->query
				(
					"DELETE FROM " . $wpdb->commentmeta . " WHERE comment_id NOT IN (SELECT comment_id FROM $wpdb->comments)"
				);
			break;
	
			case 5:
				$wpdb->query
				(
					"DELETE pm FROM " . $wpdb->postmeta . " pm LEFT JOIN $wpdb->posts wp ON wp.ID = pm.post_id WHERE wp.ID IS NULL"
				);
			break;
	
			case 6:
				$wpdb->query
				(
					$wpdb->prepare
					(
						"DELETE FROM " . $wpdb->term_relationships . " WHERE term_taxonomy_id=%d AND object_id NOT IN (SELECT id FROM " . $wpdb->posts . ")",
						1
					)
				);
			break;
	
			case 7:
				$where["post_type"] = "revision";
				global $wpdb;
				$wpdb->delete($wpdb->posts,$where);						
										
				
			break;
	
			case 8:
				$where["comment_type"] = "pingback";
				global $wpdb;
				$wpdb->delete($wpdb->comments,$where);								
				
			break;
	
			case 9:
				$wpdb->query
				(
					$wpdb->prepare
					(
						"DELETE FROM " . $wpdb->options . " WHERE option_name LIKE %s OR option_name LIKE %s",
						"_transient_%",
						"_site_transient_%"
					)
				);
			break;
	
			case 10:
				$where["comment_type"] = "trackback";
				global $wpdb;
				$wpdb->delete($wpdb->comments,$where);							
			break;
	
			case 11:
				$where["comment_approved"] = "spam";
				global $wpdb;
				$wpdb->delete($wpdb->comments,$where);							
			break;
	
			case 12:
				$where["comment_approved"] = "trash";
				global $wpdb;
				$wpdb->delete($wpdb->comments,$where);							
			break;
	
			case 13:
				$where["post_status"] = "draft";
				global $wpdb;
				$wpdb->delete($wpdb->posts,$where);							
			break;
	
			case 14:
				$where["post_status"] = "trash";
				global $wpdb;
				$wpdb->delete($wpdb->posts,$where);							
			break;
	
			case 15:
				$query = $wpdb->get_results
				(
					$wpdb->prepare
					(
						"SELECT GROUP_CONCAT(meta_id ORDER BY meta_id DESC) AS ids, post_id, COUNT(*) AS count FROM $wpdb->postmeta
						GROUP BY post_id, meta_key, meta_value HAVING count > %d",
						1
					)
				);
				if($query)
				{
					foreach($query as $meta)
					{
						$ids = array_map("intval", explode( ",", $meta->ids ));
						array_pop( $ids );
						$wpdb->query
						(
							$wpdb->prepare
							(
								"DELETE FROM $wpdb->postmeta WHERE meta_id IN (" . implode( ",", $ids ) . ") AND post_id = %d", intval($meta->post_id)
							)
						);
					}
				}
			break;
	
			case 16:
				$query = $wpdb->get_results
				(
					$wpdb->prepare
					(
						"SELECT post_id, meta_key FROM $wpdb->postmeta WHERE meta_key LIKE (%s)",
						"%_oembed_%"
					)
				);
				if($query)
				{
					foreach($query as $meta)
					{
						$post_id = intval( $meta->post_id );
						if($post_id === 0)
						{
							$wpdb->query
							(
								$wpdb->prepare
								(
									"DELETE FROM $wpdb->postmeta WHERE post_id = %d AND meta_key = %s", $post_id, $meta->meta_key
								)
							);
						}
						else
						{
							delete_post_meta( $post_id, $meta->meta_key );
						}
					}
				}
			break;
	
			case 17:
				$query = $wpdb->get_results
				(
					$wpdb->prepare
					(
						"SELECT GROUP_CONCAT(meta_id ORDER BY meta_id DESC) AS ids, comment_id, COUNT(*) AS count
						FROM $wpdb->commentmeta GROUP BY comment_id, meta_key, meta_value HAVING count > %d",
						1
					)
				);
				if( $query )
				{
				 foreach ( $query as $meta )
				 {
						$ids = array_map( "intval", explode( ",", $meta->ids ) );
						array_pop( $ids );
						$wpdb->query
						(
							$wpdb->prepare
							(
								"DELETE FROM $wpdb->commentmeta WHERE meta_id IN (" . implode( ",", $ids ) . ") AND comment_id = %d", intval( $meta->comment_id )
							)
						);
					}
				}
			break;
	
			case 18:
				$wpdb->query
				(
						"DELETE FROM " . $wpdb->usermeta . " WHERE user_id NOT IN (SELECT ID FROM " . $wpdb->users . ")"
				);
			break;
	
			case 19:
				$query = $wpdb->get_results
				(
					$wpdb->prepare
					(
						"SELECT GROUP_CONCAT(umeta_id ORDER BY umeta_id DESC) AS ids, user_id, COUNT(*) AS count
						FROM $wpdb->usermeta GROUP BY user_id, meta_key, meta_value HAVING count > %d",
						1
					)
				);
				if($query)
				{
				 foreach ($query as $meta)
				 {
						$ids = array_map( "intval", explode( ",", $meta->ids ) );
						array_pop( $ids );
						$wpdb->query
						(
							$wpdb->prepare
							(
								"DELETE FROM $wpdb->usermeta WHERE umeta_id IN (" . implode( ",", $ids ) . ") AND user_id = %d", intval( $meta->user_id )
							)
						);
					}
				}
			break;
	
			case 20:
				$query = $wpdb->get_results
				(
					"SELECT tr.object_id, tt.term_id, tt.taxonomy FROM $wpdb->term_relationships AS tr
					INNER JOIN $wpdb->term_taxonomy AS tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
					WHERE tt.taxonomy != 'link_category' AND tr.object_id NOT IN (SELECT ID FROM $wpdb->posts)"
				);
				if($query)
				{
					foreach($query as $tax)
					{
					 wp_remove_object_terms( intval( $tax->object_id ), intval( $tax->term_id ), $tax->taxonomy );
					}
				}
			break;
	
			case 21:
				$query = $wpdb->get_results
				(
					$wpdb->prepare
					(
						"SELECT tt.term_taxonomy_id, t.term_id, tt.taxonomy FROM $wpdb->terms AS t
						INNER JOIN $wpdb->term_taxonomy AS tt ON t.term_id = tt.term_id
						WHERE tt.count = %d AND t.term_id NOT IN (" . implode( ",", ewo_get_excluded_termids_easy_wp_optimizer() ) . ")",
						 0
					)
				);
				if($query)
				{
					$check_wp_terms = false;
					foreach($query as $tax)
					{
						if(taxonomy_exists($tax->taxonomy))
						{
							wp_delete_term(intval($tax->term_id), $tax->taxonomy);
						}
						else
						{
							$wpdb->query
							(
								$wpdb->prepare
								(
									"DELETE FROM $wpdb->term_taxonomy WHERE term_taxonomy_id = %d",
									intval($tax->term_taxonomy_id)
								)
							);
							$check_wp_terms = true;
						}
					}
				}
			break;
		
		}
	}	