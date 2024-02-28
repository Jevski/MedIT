<div class="lightbox-icons inactive">
    <?php $urlrelated = get_the_permalink();?>
    <img class="fullscreen-button" onclick="openFullscreen()" src="<?php echo get_template_directory_uri(); ?>/assets/Icons/Icon_fullscreen.png">
    <a href="<?php echo $urlrelated; ?>"><img class="view-button" src="<?php echo get_template_directory_uri(); ?>/assets/Icons/Icon_eye.png"></a>

    
    <div class="lightbox-text">
        <?php
        $categories = get_the_terms(get_the_ID(), 'mota-category');
        if ($categories && !is_wp_error($categories)) {
            echo '<div class="custom-lightbox-cat">';
            echo $categories[0]->name;
            echo '</div>';
        }

        $references = get_post_meta(get_the_ID(), 'Reference', true);
        if ($references) {
            echo '<div class="custom-lightbox-ref">';
            echo esc_html($references);
            echo '</div>';
        }
        ?>

        
    </div>
</div>
