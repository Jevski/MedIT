<?php
$query = new WP_Query($args); 

if ($query->have_posts()) : 
    while ($query->have_posts()) : $query->the_post();
        $urlrelated = get_the_permalink();
        echo '<div class="home-gallery-image">'; 
        echo get_the_post_thumbnail();
        echo    '<div class="lightbox-icons">
                <img class="fullscreen-button" src="' . get_template_directory_uri() . '/assets/Icons/Icon_fullscreen.png">
                <a href="' . $urlrelated . '"><img class="view-button" src="' . get_template_directory_uri() . '/assets/Icons/Icon_eye.png"></a>';
        
        echo '<div class="lightbox-text">';
        $categories = get_the_terms(get_the_ID(), 'mota-category');
        if ($categories && !is_wp_error($categories)) {
            echo '<div class="custom-lightbox-cat">';
            echo $categories[0]->name;
            echo '</div>';
        }
        $references = get_post_meta(get_the_ID(), 'Reference', true);
        if ($references) {
            echo '<div class="custom-lightbox-ref">';
            echo  esc_html($references);
            }


        
        echo '</div></div></div></div>';

        ?>