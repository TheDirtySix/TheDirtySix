<div class="col-md-3">
    <div class="footer_widget first">
        <?php
        if (is_active_sidebar('first-footer-widget-area')) :
            dynamic_sidebar('first-footer-widget-area');
        endif;
        ?> 
    </div>
</div>
<div class="col-md-3">
    <div class="footer_widget">
        <?php
        if (is_active_sidebar('second-footer-widget-area')) :
            dynamic_sidebar('second-footer-widget-area');
        endif;
        ?> 
    </div>
</div>
<div class="col-md-3">
    <div class="footer_widget">
        <?php
        if (is_active_sidebar('third-footer-widget-area')) :
            dynamic_sidebar('third-footer-widget-area');
        endif;
        ?>
    </div>
</div>
<div class="col-md-3">
    <div class="footer_widget last">
        <?php
        if (is_active_sidebar('fourth-footer-widget-area')) :
            dynamic_sidebar('fourth-footer-widget-area');
        endif;
        ?>
    </div>
</div>