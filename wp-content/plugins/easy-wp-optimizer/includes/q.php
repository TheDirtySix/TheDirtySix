<?php
	if ( ! defined( 'ABSPATH' ) ) exit;
	if(!ewo_check_user()){return;}
	
	if(!function_exists("ewo_get_excluded_termids_easy_wp_optimizer"))
	{
		function ewo_get_excluded_termids_easy_wp_optimizer()
		{
			$default_term_ids = ewo_get_default_taxonomy_termids_easy_wp_optimizer();
			if( ! is_array( $default_term_ids ) )
			{
				$default_term_ids = array();
			}
			$parent_term_ids = ewo_get_parent_termids_easy_wp_optimizer();
			if( ! is_array( $parent_term_ids ) )
			{
				$parent_term_ids = array();
			}
			return array_merge( $default_term_ids, $parent_term_ids );
		}
	}

	
	if(!function_exists("ewo_get_default_taxonomy_termids_easy_wp_optimizer"))
	{
		function ewo_get_default_taxonomy_termids_easy_wp_optimizer()
		{
			$taxonomies = get_taxonomies();
			$default_term_ids = array();
			if( $taxonomies )
			{
				$tax = array_keys( $taxonomies );
				if( $tax )
				{
					foreach( $tax as $t )
					{
						$term_id = intval( get_option( "default_" . $t ) );
						if( $term_id > 0 )
						{
							$default_term_ids[] = $term_id;
						}
					}
				}
			}
			return $default_term_ids;
		}
	}
	

	if(!function_exists("ewo_get_parent_termids_easy_wp_optimizer"))
	{
		function ewo_get_parent_termids_easy_wp_optimizer()
		{
			global $wpdb;
			return $wpdb->get_col
			(
				$wpdb->prepare
				(
					"SELECT tt.parent FROM $wpdb->terms AS t INNER JOIN $wpdb->term_taxonomy AS tt
					ON t.term_id = tt.term_id
					WHERE  tt.parent > %d",
					0
				)
			);
		}
	}

	
	if(isset($_REQUEST["page"]))
	{
		switch($_REQUEST["page"])
		{
			case "ewo_easy_wp_optimizer" :
				if(!function_exists("ewo_count_easy_wp_optimizer"))
				{
					function ewo_count_easy_wp_optimizer($type)
					{
						global $wpdb;
						switch($type)
						{
							case "autodraft":
								$count = $wpdb->get_var
								(
									$wpdb->prepare
									(
										"SELECT COUNT(*) FROM " . $wpdb->posts . " WHERE post_status = %s",
										"auto-draft"
									)
								);
							break;
	
							case "transient_feed":
								$count = $wpdb->get_var
								(
									"SELECT COUNT(*) FROM " . $wpdb->options . " WHERE option_name LIKE '_site_transient_browser_%' OR option_name LIKE '_site_transient_timeout_browser_%' OR option_name LIKE '_transient_feed_%' OR option_name LIKE '_transient_timeout_feed_%'"
								);
							break;
	
							case "pending_comments":
								$count = $wpdb->get_var
								(
									$wpdb->prepare
									(
										"SELECT COUNT(*) FROM " . $wpdb->comments . " WHERE comment_approved = %s",
										"0"
									)
								);
							break;
	
							case "comments_meta":
								$count = $wpdb->get_var
								(
									"SELECT COUNT(*) FROM " . $wpdb->commentmeta . " WHERE comment_id NOT IN (SELECT comment_id FROM " . $wpdb->comments . ")"
								);
							break;
	
							case "posts_meta":
								$count = $wpdb->get_var
								(
									"SELECT COUNT(*) FROM " . $wpdb->postmeta . " pm LEFT JOIN " . $wpdb->posts . " wp ON wp.ID = pm.post_id WHERE wp.ID IS NULL"
								);
							break;
	
							case "relationships":
								$count = $wpdb->get_var
								(
									"SELECT COUNT(*) FROM " . $wpdb->term_relationships . " WHERE term_taxonomy_id = 1 AND object_id NOT IN (SELECT id FROM " . $wpdb->posts . ")"
								);
							break;
	
							case "revision":
								$count = $wpdb->get_var
								(
									$wpdb->prepare
									(
										"SELECT COUNT(*) FROM " . $wpdb->posts . " WHERE post_type = %s",
										"revision"
									)
								);
							break;
	
							case "remove_pingbacks":
								$count = $wpdb->get_var
								(
									"SELECT COUNT(*) FROM " . $wpdb->comments . " WHERE comment_type = 'pingback'"
								);
							break;
	
							case "remove_transient_options":
								$count = $wpdb->get_var
								(
									"SELECT COUNT(*) FROM " . $wpdb->options . " WHERE option_name LIKE '_transient_%' OR option_name LIKE '_site_transient_%'"
								);
							break;
	
							case "remove_trackbacks":
								$count = $wpdb->get_var
								(
									"SELECT COUNT(*) FROM " . $wpdb->comments  . " WHERE comment_type = 'trackback'"
								);
							break;
	
							case "spam":
								$count = $wpdb->get_var
								(
									$wpdb->prepare
									(
										"SELECT COUNT(*) FROM " . $wpdb->comments . " WHERE comment_approved = %s",
										"spam"
									)
								);
							break;
	
							case "trash":
								$count = $wpdb->get_var
								(
									$wpdb->prepare
									(
										"SELECT COUNT(*) FROM " . $wpdb->comments . " WHERE comment_approved = %s",
										"trash"
									)
								);
							break;
	
							case "draft":
								$count = $wpdb->get_var
								(
									$wpdb->prepare
									(
										"SELECT COUNT(*) FROM " . $wpdb->posts . " WHERE post_status = %s AND (post_type = %s OR post_type = %s)",
										"draft",
										"page",
										"post"
									)
								);
							break;
	
							case "deleted_posts":
								$count = $wpdb->get_var
								(
									$wpdb->prepare
									(
										"SELECT COUNT(ID) FROM " . $wpdb->posts . " WHERE post_status = %s",
										"trash"
									)
								);
							break;
	
							case "duplicated_postmeta":
								$query = $wpdb->get_col
								(
									$wpdb->prepare
									(
										"SELECT COUNT(meta_id) AS count FROM " . $wpdb->postmeta . " GROUP BY post_id, meta_key, meta_value HAVING count > %d",
										1
									)
								);
								if(is_array($query))
								{
									$count = array_sum(array_map("intval", $query)) - count($query);
								}
							break;
	
							case "oembed_caches":
								$count = $wpdb->get_var
								(
									$wpdb->prepare
									(
										"SELECT COUNT(meta_id) FROM " . $wpdb->postmeta . " WHERE meta_key LIKE(%s)",
										"%_oembed_%"
									)
								);
							break;
	
							case "duplicated_commentmeta":
								$query = $wpdb->get_col
								(
									$wpdb->prepare
									(
										"SELECT COUNT(meta_id) AS count FROM " . $wpdb->commentmeta . " GROUP BY comment_id, meta_key, meta_value HAVING count > %d",
										1
									)
								);
								if(is_array($query))
								{
									$count = array_sum(array_map("intval", $query)) - count($query);
								}
							break;
	
							case "orphan_user_meta":
								$count = $wpdb->get_var
								(
									"SELECT COUNT(umeta_id) FROM " . $wpdb->usermeta . " WHERE user_id NOT IN (SELECT ID FROM " . $wpdb->users . ")"
								);
							break;
	
							case "duplicated_usermeta":
								$query = $wpdb->get_col
								(
									$wpdb->prepare
									(
										"SELECT COUNT(umeta_id) AS count FROM " . $wpdb->usermeta . " GROUP BY user_id, meta_key, meta_value HAVING count > %d",
										1
									)
								);
								if(is_array($query))
								{
									$count = array_sum(array_map("intval", $query)) - count($query);
								}
							break;
	
							case "orphaned_term_relationships":
								$count = $wpdb->get_var
								(
									"SELECT COUNT(object_id) FROM " . $wpdb->term_relationships . " AS tr INNER JOIN " . $wpdb->term_taxonomy . " AS tt
									ON tr.term_taxonomy_id = tt.term_taxonomy_id
									WHERE tt.taxonomy != 'link_category' AND tr.object_id NOT IN (SELECT ID FROM ".$wpdb->posts.")"
								);
							break;
	
							case "unused_terms":
								$count = $wpdb->get_var
								(
									$wpdb->prepare
									(
										"SELECT COUNT(t.term_id) FROM " . $wpdb->terms . " AS t INNER JOIN " . $wpdb->term_taxonomy . " AS tt
										ON t.term_id = tt.term_id
										WHERE tt.count = %d AND t.term_id NOT IN (" . implode(",", ewo_get_excluded_termids_easy_wp_optimizer()) . ")",
										0
									)
								);
							break;
						}
						return $count;
					}
				}
			break;
		}
	}
?>