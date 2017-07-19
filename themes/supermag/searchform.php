<div class="search-block">
    <form action="<?php echo esc_url( home_url() ); ?>" class="searchform" id="searchform" method="get" role="search">
        <div>
            <label for="menu-search" class="screen-reader-text"></label>
            <?php
            $supermag_customizer_all_values = supermag_get_theme_options();
            $placeholder_text = '';
            if ( isset( $supermag_customizer_all_values['supermag-search-placholder']) ):
                $placeholder_text = ' placeholder="' . esc_attr( $supermag_customizer_all_values['supermag-search-placholder'] ). '" ';
            endif; ?>
            <input type="text" <?php echo  $placeholder_text ;?> id="menu-search" name="s" value="<?php echo esc_attr( get_search_query() );?>">
            <button class="fa fa-search" type="submit" id="searchsubmit"></button>
        </div>
    </form>
</div>
