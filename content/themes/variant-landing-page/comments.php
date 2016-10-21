<!--Comments-->
<div id="commentsbox">
    <h2 class="comments-heading"><span><?php _e('Comments and Responses', 'variant-landing-page'); ?></span></h2>
    <!--<h3 id="comments"></h3>-->
    <?php
    if (comments_open()) :
        $req = get_option('require_name_email');
        $aria_req = ($req ? " aria-required='true'" : '');
        $html_req = ($req ? " required='required'" : '');
        $format = current_theme_supports('html5', 'comment-form') ? 'html5' : 'xhtml';
        $html5 = 'html5' === $format;
        $submit_btn = '<input class="fbtn bright-blue" name="submit" type="submit" id="commentSubmit" value="' . __('Submit Comment', 'variant-landing-page') . '"/>';
        $fields = array(
            'author' => '<div id="comment-author" class="form-row"><label for="author">' . __('Name (required)', 'variant-landing-page') . '</label><input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30"' . $aria_req . $html_req . ' /></div>',
            'email' => '<div id="comment-email" class="form-row"><label for="email">' . __('Mail (will not be published) (required)', 'variant-landing-page') . '</label><input id="email" name="email" ' . ($html5 ? 'type="email"' : 'type="text"') . ' value="' . esc_attr($commenter['comment_author_email']) . '" size="30" ' . $aria_req . $html_req . ' /></div>',
            'url' => '<div id="comment-url" class="form-row"><label for="url">' . __('Website', 'variant-landing-page') . '</label><input id="url" name="url" ' . ($html5 ? 'type="url"' : 'type="text"') . ' value="' . esc_attr($commenter['comment_author_url']) . '" size="30" /></div>',
        );
        $comment_field = '<div id="comment-message" class="form-row"><label for="comment">' . __('Comment', 'variant-landing-page') . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-describedby="form-allowed-tags" aria-required="true" required="required"></textarea></div>';


        comment_form(
                array(
                    'fields' => $fields,
                    'comment_field' => $comment_field,
                    'title_reply' => '',
                    'submit_button' => $submit_btn,
                )
        );

    endif; // if you delete this the sky will fall on your head    
    ?>
</div>
<!--/Post-->
<!--Comment List-->
<div id="comment_list">
    <?php if (have_comments()) : ?>
        <h2 class="comments-heading"><span><?php _e('Leave a Reply', 'variant-landing-page'); ?></span></h2>
        <ol class="commentlist">
            <?php wp_list_comments(array('type' => 'comment', 'avatar_size' => 64)); ?>
        </ol>
        <div class="comment-nav">
            <div class="alignleft">
                <?php previous_comments_link() ?>
            </div>
            <div class="alignright">
                <?php next_comments_link() ?>
            </div>
        </div>
        <?php
    else : // this is displayed if there are no comments so far   
        if (comments_open()) :
            ?>
            <!-- If comments are open, but there are no comments. -->
        <?php else : // comments are closed          ?>
            <!-- If comments are closed. -->
            <p class="nocomments"><?php _e('Comments are closed.', 'variant-landing-page'); ?></p>
        <?php
        endif;
    endif;
    ?>
    <!--/Comment List-->
</div>