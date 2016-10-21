<div id="searchForm" style="color:#000;">
    <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
        <label class="screen-reader-text" for="search_input"><?php _e('Search:', 'variant-landing-page'); ?></label>
        <input type="search" id="search_input" class="search-field" placeholder="<?php echo esc_attr(__('Search topics..', 'variant-landing-page')); ?>" value="" name="s" title="<?php echo esc_attr(__('Search topics..', 'variant-landing-page')); ?>">
        <input type="submit" class="search-submit" value="">
    </form>
</div>