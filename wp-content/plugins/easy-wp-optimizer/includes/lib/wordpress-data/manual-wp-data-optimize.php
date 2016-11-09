<?php
	if ( ! defined( 'ABSPATH' ) ) exit;
	if(!ewo_check_user()){return;}
	$wordpress_data_manual_clean_up = wp_create_nonce("wordpress_data_manual_clean_up");
	$empty_manual_clean_up = wp_create_nonce("empty_manual_clean_up");
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
                        <a href="admin.php?page=ewo_easy_wp_optimizer">Manual Optimize</a>
                    </li>
                </ul>
            </div>

			<div class="page-form">

                <form id="ewo_manual_clean_up">
                    <div class="form-body">
                    
                        <div class="note note-danger">
                            <h4 class="block">
                                <?php echo $ewo_important_disclaimer; ?>
                            </h4>
                            <ul>
                                <!--li> <?php echo $ewo_easy_wp_optimizer_demos_disclaimer; ?><a href="<?php echo ewo_the_coothemes_url."/";?>" target="_blank" class='custom_links'><?php echo $ewo_here_disclaimer; ?></a>.</li-->
                                <li> <?php echo $ewo_easy_wp_optimizer_manual_disclaimer; ?><a href="<?php echo ewo_the_coothemes_url."/plugins/Easy-WP-Optimizer-Manual.php";?>" target="_blank" class='custom_links'><?php echo $ewo_here_disclaimer; ?></a>.</li>

                            </ul>
                        </div>
                        
                        <div class="table-margin-top">
                            <select name="ewo_bulk_action" id="ewo_bulk_action" class="custom-bulk-width">
                                <option value=""><?php echo $ewo_bulk_action_dropdown;?></option>
                                <option value="empty"><?php echo $ewo_empty;?></option>
                            </select>
                            <input type="button" id="ewo_btn_apply" name="ewo_btn_apply" class="btn green-haze" value="<?php echo $ewo_apply;?>" onclick="ewo_bulk_empty_easy_wp_optimizer();">
                        </div>

                        <div class="line-separator"></div>  
                        
                        <table class="table table-striped table-bordered table-hover table-margin-top" id="ewo_tbl_wp_manual_clean_up">
                            <thead>
                                <tr>
                                    <th class="center width5">
                                        <input type="checkbox" id="ewo_manual_clean_up_select_all" name="ewo_manual_clean_up_select_all">
                                    </th>
                                    <th class="width65">
                                        <?php echo $ewo_type_of_data;?>
                                    </th>
                                    <th class="center width15">
                                        <?php echo $ewo_count;?>
                                    </th>
                                    <th class="center width15">
                                        <?php echo $ewo_action;?>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="check-all">
                                <tr>
                                    <td class="custom-align-chk">
                                        <input type="checkbox" id="ewo_chk_auto_draft" name="ewo_chk_auto_draft" value="1" class="checkall" >
                                    </td>
                                    <td class="width65">
                                        <label>
                                            <?php echo $ewo_auto_drafts;?>
                                            <i class="iconfont ewo_auto_drafts_tooltip">&#xe716;</i>
                                        </label>
                                    </td>
                                    <td class="custom-align">
                                        <label>
                                           <?php echo ewo_count_easy_wp_optimizer("autodraft"); ?>
                                        </label>
                                    </td>
                                    <td class="custom-align">
                                        <input type="button" id="ewo_btn_auto_draft" class="btn green-haze btn-align" value="<?php echo $ewo_empty;?>" onclick="ewo_selected_empty_easy_wp_optimizer(1);">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="custom-align-chk">
                                        <input type="checkbox" id="ewo_chk_dashboard_transient_feed" value="2" name="ewo_chk_dashboard_transient_feed" class="checkall">
                                    </td>
                                    <td class="width65">
                                        <label>
                                            <?php echo $ewo_dashboard_transient_feed;?>
                                            <i class="iconfont ewo_dashboard_transient_feed_tooltip" >&#xe716;</i>
                                        </label>
                                    </td>
                                    <td class="custom-align">
                                        <label>
                                            <?php echo ewo_count_easy_wp_optimizer("transient_feed"); ?>
                                        </label>
                                    </td>
                                    <td class="custom-align">
                                        <input type="button" id="ewo_btn_dashboard_transient_feed" class="btn green-haze btn-align" value="<?php echo $ewo_empty;?>" onclick="ewo_selected_empty_easy_wp_optimizer(2);">
                                    </td>
                                </tr>
                                
                                
								<tr>
                                    <td class="custom-align-chk">
                                        <input type="checkbox" id="ewo_chk_Pending_comments" value="3" name="ewo_chk_Pending_comments" class="checkall">
                                    </td>
                                    <td class="width65">
                                        <label>
                                            <?php echo $ewo_pending_comments;?>
                                            <i class="iconfont ewo_pending_comments_tooltip">&#xe716;</i>
                                        </label>
                                    </td>
                                    <td class="custom-align">
                                        <label>
                                            <?php echo ewo_count_easy_wp_optimizer("pending_comments"); ?>
                                        </label>
                                    </td>
                                    <td class="custom-align">
                                        <input type="button" id="ewo_chk_Pending_comments" class="btn green-haze btn-align" value="<?php echo $ewo_empty;?>" onclick="ewo_selected_empty_easy_wp_optimizer(3);">
                                    </td>
                                </tr>                                
                                
                                <tr>
                                    <td class="custom-align-chk">
                                        <input type="checkbox" id="ewo_chk_orphan_comments_meta" value="4" name="ewo_chk_orphan_comments_meta" class="checkall">
                                    </td>
                                    <td class="width65">
                                        <label>
                                            <?php echo $ewo_orphan_comment_meta;?>
                                            <i class="iconfont ewo_orphan_comment_meta_tooltip">&#xe716;</i>
                                        </label>
                                    </td>
                                    <td class="custom-align">
                                        <label>
                                            <?php echo ewo_count_easy_wp_optimizer("comments_meta"); ?>
                                        </label>
                                    </td>
                                    <td class="custom-align">
                                        <input type="button" id="ewo_btn_orphan_comments_meta" class="btn green-haze btn-align" value="<?php echo $ewo_empty;?>" onclick="ewo_selected_empty_easy_wp_optimizer(4);">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="custom-align-chk">
                                        <input type="checkbox" id="ewo_chk_orphan_posts_meta" value="5" name="ewo_chk_orphan_posts_meta" class="checkall">
                                    </td>
                                    <td class="width65">
                                        <label>
                                            <?php echo $ewo_orphan_post_meta;?>
                                            <i class="iconfont ewo_orphan_post_meta_tooltip" >&#xe716;</i>
                                        </label>
                                    </td>
                                    <td class="custom-align">
                                        <label>
                                            <?php echo ewo_count_easy_wp_optimizer("posts_meta"); ?>
                                        </label>
                                    </td>
                                    <td class="custom-align">
                                        <input type="button" id="ewo_btn_orphan_posts_meta" class="btn green-haze btn-align" value="<?php echo $ewo_empty;?>" onclick="ewo_selected_empty_easy_wp_optimizer(5);">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="custom-align-chk">
                                        <input type="checkbox" id="ewo_chk_orphan_relationships" value="6" name="ewo_chk_orphan_relationships" class="checkall">
                                    </td>
                                    <td class="width65">
                                        <label>
                                            <?php echo $ewo_orphan_relationships;?>
                                            <i class="iconfont ewo_orphan_relationships_tooltip" >&#xe716;</i>
                                        </label>
                                    </td>
                                    <td class="custom-align">
                                        <label>
                                            <?php echo ewo_count_easy_wp_optimizer("relationships"); ?>
                                        </label>
                                    </td>
                                    <td class="custom-align">
                                        <input type="button" id="ewo_btn_orphan_relationships" class="btn green-haze btn-align" value="<?php echo $ewo_empty;?>" onclick="ewo_selected_empty_easy_wp_optimizer(6);">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="custom-align-chk">
                                        <input type="checkbox" id="ewo_chk_revision" value="7" name="ewo_chk_revision" class="checkall">
                                    </td>
                                    <td class="width65">
                                        <label>
                                            <?php echo $ewo_revisions;?>
                                            <i class="iconfont ewo_revisions_tooltip" >&#xe716;</i>
                                        </label>
                                    </td>
                                    <td class="custom-align">
                                        <label>
                                            <?php echo ewo_count_easy_wp_optimizer("revision"); ?>
                                        </label>
                                    </td>
                                    <td class="custom-align">
                                        <input type="button" id="ewo_btn_revision" class="btn green-haze btn-align" value="<?php echo $ewo_empty;?>" onclick="ewo_selected_empty_easy_wp_optimizer(7);">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="custom-align-chk">
                                        <input type="checkbox" id="ewo_chk_remove_pingbacks" value="8" name="ewo_chk_remove_pingbacks" class="checkall">
                                    </td>
                                    <td class="width65">
                                        <label>
                                            <?php echo $ewo_remove_pingbacks;?>
                                            <i class="iconfont ewo_remove_pingbacks_tooltip" >&#xe716;</i>
                                        </label>
                                    </td>
                                    <td class="custom-align">
                                        <label>
                                            <?php echo ewo_count_easy_wp_optimizer("remove_pingbacks"); ?>
                                        </label>
                                    </td>
                                    <td class="custom-align">
                                        <input type="button" id="ewo_btn_remove_pingbacks" class="btn green-haze btn-align" value="<?php echo $ewo_empty;?>"onclick="ewo_selected_empty_easy_wp_optimizer(8);">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="custom-align-chk">
                                        <input type="checkbox" id="ewo_chk_remove_transient_options" value="9" name="ewo_chk_remove_transient_options" class="checkall">
                                    </td>
                                    <td class="width65">
                                        <label>
                                            <?php echo $ewo_remove_transient_options;?>
                                            <i class="iconfont ewo_remove_transient_options_tooltip">&#xe716;</i>
                                        </label>
                                    </td>
                                    <td class="custom-align">
                                        <label>
                                            <?php echo ewo_count_easy_wp_optimizer("remove_transient_options"); ?>
                                        </label>
                                    </td>
                                    <td class="custom-align">
                                        <input type="button" id="ewo_btn_remove_transient_options" class="btn green-haze btn-align" value="<?php echo $ewo_empty;?>" onclick="ewo_selected_empty_easy_wp_optimizer(9);">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="custom-align-chk">
                                        <input type="checkbox" id="ewo_chk_remove_trackbacks" value="10" name="ewo_chk_remove_trackbacks" class="checkall">
                                    </td>
                                    <td class="width65">
                                        <label>
                                            <?php echo $ewo_remove_trackbacks;?>
                                            <i class="iconfont ewo_remove_trackbacks_tooltip" >&#xe716;</i>
                                        </label>
                                    </td>
                                    <td class="custom-align">
                                        <label>
                                            <?php echo ewo_count_easy_wp_optimizer("remove_trackbacks"); ?>
                                        </label>
                                    </td>
                                    <td class="custom-align">
                                        <input type="button" id="ewo_btn_remove_trackbacks" class="btn green-haze btn-align" value="<?php echo $ewo_empty;?>" onclick="ewo_selected_empty_easy_wp_optimizer(10);">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="custom-align-chk">
                                        <input type="checkbox" id="ewo_chk_spam_comments" value="11" name="ewo_chk_spam_comments" class="checkall">
                                    </td>
                                    <td class="width65">
                                        <label>
                                            <?php echo $ewo_spam_comments;?>
                                            <i class="iconfont ewo_spam_comments_tooltip">&#xe716;</i>
                                        </label>
                                    </td>
                                    <td class="custom-align">
                                        <label>
                                            <?php echo ewo_count_easy_wp_optimizer("spam"); ?>
                                        </label>
                                    </td>
                                    <td class="custom-align">
                                        <input type="button" id="ewo_btn_spam_comments" class="btn green-haze btn-align" value="<?php echo $ewo_empty;?>" onclick="ewo_selected_empty_easy_wp_optimizer(11);">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="custom-align-chk">
                                        <input type="checkbox" id="ewo_chk_trash_comments" value="12" name="ewo_chk_trash_comments" class="checkall">
                                    </td>
                                    <td class="width65">
                                        <label>
                                            <?php echo $ewo_trash_comments;?>
                                            <i class="iconfont ewo_trash_comments_tooltip">&#xe716;</i>
                                        </label>
                                    </td>
                                    <td class="custom-align">
                                        <label>
                                            <?php echo ewo_count_easy_wp_optimizer("trash"); ?>
                                        </label>
                                    </td>
                                    <td class="custom-align">
                                        <input type="button" id="ewo_chk_trash_comments" class="btn green-haze btn-align" value="<?php echo $ewo_empty;?>" onclick="ewo_selected_empty_easy_wp_optimizer(12);">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="custom-align-chk">
                                        <input type="checkbox" id="ewo_chk_draft" value="13" name="ewo_chk_draft" class="checkall">
                                    </td>
                                    <td class="width65">
                                        <label>
                                            <?php echo $ewo_drafts;?>
                                            <i class="iconfont ewo_drafts_tooltip" >&#xe716;</i>
                                        </label>
                                    </td>
                                    <td class="custom-align">
                                        <label>
                                            <?php echo ewo_count_easy_wp_optimizer("draft"); ?>
                                        </label>
                                    </td>
                                    <td class="custom-align">
                                        <input type="button" id="ewo_chk_draft" class="btn green-haze btn-align" value="<?php echo $ewo_empty;?>" onclick="ewo_selected_empty_easy_wp_optimizer(13);">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="custom-align-chk">
                                        <input type="checkbox" id="ewo_chk_deleted_posts" value="14" name="ewo_chk_deleted_posts" class="checkall">
                                    </td>
                                    <td class="width65">
                                        <label>
                                            <?php echo $ewo_deleted_posts;?>
                                            <i class="iconfont ewo_deleted_posts_tooltip">&#xe716;</i>
                                        </label>
                                    </td>
                                    <td class="custom-align">
                                        <label>
                                            <?php echo ewo_count_easy_wp_optimizer("deleted_posts"); ?>
                                        </label>
                                    </td>
                                    <td class="custom-align">
                                        <input type="button" id="ewo_chk_deleted_posts" class="btn green-haze btn-align" value="<?php echo $ewo_empty;?>" onclick="ewo_selected_empty_easy_wp_optimizer(14);">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="custom-align-chk">
                                        <input type="checkbox" id="ewo_chk_duplicated_postmeta" value="15" name="ewo_chk_duplicated_postmeta" class="checkall">
                                    </td>
                                    <td class="width65">
                                        <label>
                                            <?php echo $ewo_duplicated_post_meta;?>
                                            <i class="iconfont ewo_duplicated_post_meta_tooltip" >&#xe716;</i>
                                        </label>
                                    </td>
                                    <td class="custom-align">
                                        <label>
                                            <?php echo ewo_count_easy_wp_optimizer("duplicated_postmeta"); ?>
                                        </label>
                                    </td>
                                    <td class="custom-align">
                                        <input type="button" id="ewo_chk_duplicated_postmeta" class="btn green-haze btn-align" value="<?php echo $ewo_empty;?>" onclick="ewo_selected_empty_easy_wp_optimizer(15);">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="custom-align-chk">
                                        <input type="checkbox" id="ewo_chk_oembed_caches_in_post_meta" value="16" name="ewo_chk_oembed_caches_in_post_meta" class="checkall">
                                    </td>
                                    <td class="width65">
                                        <label>
                                            <?php echo $ewo_oEmbed_caches_post_meta;?>
                                            <i class="iconfont ewo_oEmbed_caches_post_meta_tooltip" >&#xe716;</i>
                                        </label>
                                    </td>
                                    <td class="custom-align">
                                        <label>
                                            <?php echo ewo_count_easy_wp_optimizer("oembed_caches"); ?>
                                        </label>
                                    </td>
                                    <td class="custom-align">
                                        <input type="button" id="ewo_chk_oembed_caches_in_post_meta" class="btn green-haze btn-align" value="<?php echo $ewo_empty;?>" onclick="ewo_selected_empty_easy_wp_optimizer(16);">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="custom-align-chk">
                                        <input type="checkbox" id="ewo_chk_duplicated_comment_meta" value="17" name="ewo_chk_duplicated_comment_meta" class="checkall">
                                    </td>
                                    <td class="width65">
                                        <label>
                                            <?php echo $ewo_duplicated_comment_meta;?>
                                            <i class="iconfont ewo_duplicated_comment_meta_tooltip" >&#xe716;</i>
                                        </label>
                                    </td>
                                    <td class="custom-align">
                                        <label>
                                            <?php echo ewo_count_easy_wp_optimizer("duplicated_commentmeta"); ?>
                                        </label>
                                    </td>
                                    <td class="custom-align">
                                        <input type="button" id="ewo_chk_duplicated_comment_meta" class="btn green-haze btn-align" value="<?php echo $ewo_empty;?>" onclick="ewo_selected_empty_easy_wp_optimizer(17);">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="custom-align-chk">
                                        <input type="checkbox" id="ewo_chk_orphan_user_meta" value="18" name="ewo_chk_orphan_user_meta" class="checkall">
                                    </td>
                                    <td class="width65">
                                        <label>
                                            <?php echo $ewo_orphan_user_meta;?>
                                            <i class="iconfont ewo_orphan_user_meta_tooltip" >&#xe716;</i>
                                        </label>
                                    </td>
                                    <td class="custom-align">
                                        <label>
                                            <?php echo ewo_count_easy_wp_optimizer("orphan_user_meta"); ?>
                                        </label>
                                    </td>
                                    <td class="custom-align">
                                        <input type="button" id="ewo_chk_orphan_user_meta" class="btn green-haze btn-align" value="<?php echo $ewo_empty;?>" onclick="ewo_selected_empty_easy_wp_optimizer(18);">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="custom-align-chk">
                                        <input type="checkbox" id="ewo_chk_duplicated_usermeta" value="19" name="ewo_chk_duplicated_usermeta" class="checkall">
                                    </td>
                                    <td class="width65">
                                        <label>
                                            <?php echo $ewo_duplicated_user_meta;?>
                                            <i class="iconfont ewo_duplicated_user_meta_tooltip">&#xe716;</i>
                                        </label>
                                    </td>
                                    <td class="custom-align">
                                        <label>
                                            <?php echo ewo_count_easy_wp_optimizer("duplicated_usermeta"); ?>
                                        </label>
                                    </td>
                                    <td class="custom-align">
                                        <input type="button" id="ewo_chk_duplicated_usermeta" class="btn green-haze btn-align" value="<?php echo $ewo_empty;?>"onclick="ewo_selected_empty_easy_wp_optimizer(19);">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="custom-align-chk">
                                        <input type="checkbox" id="ewo_chk_orphaned_term_relationships" value="20" name="ewo_chk_orphaned_term_relationships" class="checkall">
                                    </td>
                                    <td class="width65">
                                        <label>
                                            <?php echo $ewo_orphaned_term_relationships;?>
                                            <i class="iconfont ewo_orphaned_term_relationships_tooltip" >&#xe716;</i>
                                        </label>
                                    </td>
                                    <td class="custom-align">
                                        <label>
                                            <?php echo ewo_count_easy_wp_optimizer("orphaned_term_relationships"); ?>
                                        </label>
                                    </td>
                                    <td class="custom-align">
                                        <input type="button" id="ewo_chk_orphaned_term_relationships" class="btn green-haze btn-align" value="<?php echo $ewo_empty;?>" onclick="ewo_selected_empty_easy_wp_optimizer(20);">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="custom-align-chk">
                                        <input type="checkbox" id="ewo_chk_unused_terms" value="21" name="ewo_chk_unused_terms" class="checkall">
                                    </td>
                                    <td class="width65">
                                        <label>
                                            <?php echo $ewo_unused_terms;?>
                                            <i class="iconfont ewo_unused_terms_tooltip">&#xe716;</i>
                                        </label>
                                    </td>
                                    <td class="custom-align">
                                        <label>
                                            <?php echo ewo_count_easy_wp_optimizer("unused_terms"); ?>
                                        </label>
                                    </td>
                                    <td class="custom-align">
                                        <input type="button" id="ewo_chk_unused_terms" class="btn green-haze btn-align" value="<?php echo $ewo_empty;?>" onclick="ewo_selected_empty_easy_wp_optimizer(21);">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
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

	<script type="text/javascript">

	html5tooltips([
	  {
	    contentText: "<?php echo $ewo_auto_drafts_tooltip;?>",
	    targetSelector: ".ewo_auto_drafts_tooltip",
	    stickTo: "top",
	    maxWidth: 180 ,
	    animateFunction: "slidein"
	  },
	  {
	    contentText: "<?php echo $ewo_dashboard_transient_feed_tooltip;?>",
	    targetSelector: ".ewo_dashboard_transient_feed_tooltip",
	    stickTo: "top",
	    maxWidth: 180 ,
	    animateFunction: "slidein"
	  },
	  
	  {
	    contentText: "<?php echo $ewo_pending_comments_tooltip;?>",
	    targetSelector: ".ewo_pending_comments_tooltip",
	    stickTo: "top",
	    maxWidth: 180 ,
	    animateFunction: "slidein"
	  },	  
	  {
	    contentText: "<?php echo $ewo_orphan_comment_meta_tooltip;?>",
	    targetSelector: ".ewo_orphan_comment_meta_tooltip",
	    stickTo: "top",
	    maxWidth: 180 ,
	    animateFunction: "slidein"
	  },	  
	  
	  {
	    contentText: "<?php echo $ewo_orphan_post_meta_tooltip;?>",
	    targetSelector: ".ewo_orphan_post_meta_tooltip",
	    stickTo: "top",
	    maxWidth: 180 ,
	    animateFunction: "slidein"
	  },	  
	  
	  {
	    contentText: "<?php echo $ewo_orphan_relationships_tooltip;?>",
	    targetSelector: ".ewo_orphan_relationships_tooltip",
	    stickTo: "top",
	    maxWidth: 180 ,
	    animateFunction: "slidein"
	  },	  
	  {
	    contentText: "<?php echo $ewo_revisions_tooltip;?>",
	    targetSelector: ".ewo_revisions_tooltip",
	    stickTo: "top",
	    maxWidth: 180 ,
	    animateFunction: "slidein"
	  },	  
	  
	  {
	    contentText: "<?php echo $ewo_remove_pingbacks_tooltip;?>",
	    targetSelector: ".ewo_remove_pingbacks_tooltip",
	    stickTo: "top",
	    maxWidth: 180 ,
	    animateFunction: "slidein"
	  },	  
	  
	  {
	    contentText: "<?php echo $ewo_remove_transient_options_tooltip;?>",
	    targetSelector: ".ewo_remove_transient_options_tooltip",
	    stickTo: "top",
	    maxWidth: 180 ,
	    animateFunction: "slidein"
	  },	  
	  
	  {
	    contentText: "<?php echo $ewo_remove_trackbacks_tooltip;?>",
	    targetSelector: ".ewo_remove_trackbacks_tooltip",
	    stickTo: "top",
	    maxWidth: 180 ,
	    animateFunction: "slidein"
	  },	  
	  {
	    contentText: "<?php echo $ewo_spam_comments_tooltip;?>",
	    targetSelector: ".ewo_spam_comments_tooltip",
	    stickTo: "top",
	    maxWidth: 180 ,
	    animateFunction: "slidein"
	  },	  
	  
	  {
	    contentText: "<?php echo $ewo_trash_comments_tooltip;?>",
	    targetSelector: ".ewo_trash_comments_tooltip",
	    stickTo: "top",
	    maxWidth: 180 ,
	    animateFunction: "slidein"
	  },	  
	  
	  {
	    contentText: "<?php echo $ewo_drafts_tooltip;?>",
	    targetSelector: ".ewo_drafts_tooltip",
	    stickTo: "top",
	    maxWidth: 180 ,
	    animateFunction: "slidein"
	  },	  
	  
	  {
	    contentText: "<?php echo $ewo_deleted_posts_tooltip;?>",
	    targetSelector: ".ewo_deleted_posts_tooltip",
	    stickTo: "top",
	    maxWidth: 180 ,
	    animateFunction: "slidein"
	  },	  
	  {
	    contentText: "<?php echo $ewo_duplicated_post_meta_tooltip;?>",
	    targetSelector: ".ewo_duplicated_post_meta_tooltip",
	    stickTo: "top",
	    maxWidth: 180 ,
	    animateFunction: "slidein"
	  },	  
	  
	  {
	    contentText: "<?php echo $ewo_oEmbed_caches_post_meta_tooltip;?>",
	    targetSelector: ".ewo_oEmbed_caches_post_meta_tooltip",
	    stickTo: "top",
	    maxWidth: 180 ,
	    animateFunction: "slidein"
	  },	  
	  
	  {
	    contentText: "<?php echo $ewo_duplicated_comment_meta_tooltip;?>",
	    targetSelector: ".ewo_duplicated_comment_meta_tooltip",
	    stickTo: "top",
	    maxWidth: 180 ,
	    animateFunction: "slidein"
	  },	  
	  
	  {
	    contentText: "<?php echo $ewo_orphan_user_meta_tooltip;?>",
	    targetSelector: ".ewo_orphan_user_meta_tooltip",
	    stickTo: "top",
	    maxWidth: 180 ,
	    animateFunction: "slidein"
	  },	  
	  {
	    contentText: "<?php echo $ewo_duplicated_user_meta_tooltip;?>",
	    targetSelector: ".ewo_duplicated_user_meta_tooltip",
	    stickTo: "top",
	    maxWidth: 180 ,
	    animateFunction: "slidein"
	  },	  
	  
	  {
	    contentText: "<?php echo $ewo_orphaned_term_relationships_tooltip;?>",
	    targetSelector: ".ewo_orphaned_term_relationships_tooltip",
	    stickTo: "top",
	    maxWidth: 180 ,
	    animateFunction: "slidein"
	  },	  
	  
	  {
	    contentText: "<?php echo $ewo_auto_drafts_tooltip;?>",
	    targetSelector: ".ewo_auto_drafts_tooltip",
	    stickTo: "top",
	    maxWidth: 180 ,
	    animateFunction: "slidein"
	  },	  
	  
	  {
	    contentText: "<?php echo $ewo_auto_drafts_tooltip;?>",
	    targetSelector: ".ewo_auto_drafts_tooltip",
	    stickTo: "top",
	    maxWidth: 180 ,
	    animateFunction: "slidein"
	  },	  
	  {
	    contentText: "<?php echo $ewo_auto_drafts_tooltip;?>",
	    targetSelector: ".ewo_auto_drafts_tooltip",
	    stickTo: "top",
	    maxWidth: 180 ,
	    animateFunction: "slidein"
	  },	  
	  
	  {
	    contentText: "<?php echo $ewo_auto_drafts_tooltip;?>",
	    targetSelector: ".ewo_auto_drafts_tooltip",
	    stickTo: "top",
	    maxWidth: 180 ,
	    animateFunction: "slidein"
	  },	  
	  
	  {
	    contentText: "<?php echo $ewo_auto_drafts_tooltip;?>",
	    targetSelector: ".ewo_auto_drafts_tooltip",
	    stickTo: "top",
	    maxWidth: 180 ,
	    animateFunction: "slidein"
	  },	  
	  
	  {
	    contentText: "<?php echo $ewo_auto_drafts_tooltip;?>",
	    targetSelector: ".ewo_auto_drafts_tooltip",
	    stickTo: "top",
	    maxWidth: 180 ,
	    animateFunction: "slidein"
	  },	  
	  
	  
	  {
	    contentText: "<?php echo $ewo_unused_terms_tooltip;?>",
	    targetSelector: ".ewo_unused_terms_tooltip",
	    stickTo: "top",
	    maxWidth: 180 ,
	    animateFunction: "slidein"
	  }
	]);


	</script>