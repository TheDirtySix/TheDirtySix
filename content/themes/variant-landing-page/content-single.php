<!--Post-->
<div class="post">
    <h1 class="post-title"><?php the_title(); ?></h1>
    <ul class="post-meta">
        <li class="posted-by"><?php _e('By', 'variant-landing-page'); ?><?php the_author_posts_link(); ?></li>
        <li class="post-comment"><?php comments_popup_link(__('0 Comments', 'variant-landing-page'), __('1 Comment', 'variant-landing-page'), __('% Comments', 'variant-landing-page')); ?></li>
    </ul>
    <div class="post-content">
        <?php the_content(); ?>
    </div>
    <div class="clear"></div>
    <?php comments_template(); ?>