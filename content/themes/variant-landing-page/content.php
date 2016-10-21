<!--Post-->
<div id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
    <h1 class="post-title">
        <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'variant-landing-page'), the_title_attribute('echo=0')); ?>"><?php the_title(); ?></a>
    </h1>
    <ul class="post-meta">
        <li class="posted-by"><?php _e('By ', 'variant-landing-page'); ?><?php
            global $authordata;
            if (get_the_author_meta('url')) {
                echo '<a href="' . esc_url(get_author_posts_url($authordata->ID, $authordata->user_nicename)) . '" title="' . esc_attr(sprintf(__("Visit %s&#8217;s website", 'variant-landing-page'), ucfirst(get_the_author()))) . '" rel="author external">' . ucfirst(get_the_author()) . '</a>';
            } else {
                echo ucfirst(get_the_author());
            };
            ?>
        </li>
        <li class="post-comment"><?php comments_popup_link(__('0 Comments', 'variant-landing-page'), __('1 Comment', 'variant-landing-page'), __('% Comments', 'variant-landing-page')); ?></li>
    </ul>
    <?php if ('' != get_the_post_thumbnail()) { ?>
        <div class="post-thumbnail">
            <?php the_post_thumbnail('variantlp_post_thumbnail'); ?>
        </div>
    <?php } ?>
    <div class="post-content">
        <?php the_excerpt(); ?>
    </div>
    <a class="read-more fbtn bright-blue small" href="<?php the_permalink(); ?>">
        <?php
        printf(
                __('Keep Reading %s <span class="meta-nav">&rarr;</span>', 'variant-landing-page'), the_title('<span class="screen-reader-text">', '</span>', false)
        );
        ?>
    </a>

    <div class="clear"></div>
</div>
<!--Post-->	