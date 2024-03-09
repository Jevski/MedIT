<div class="lightbox-icons inactive">
    <?php 
        // Get the URL of the related post
        $urlrelated = get_the_permalink();
        
        // Get the categories of the current post
        $categories = get_the_terms(get_the_ID(), 'mota-category');
    ?>

    <!-- Fullscreen button -->
    <img class="fullscreen-button" title="<?php echo get_the_title() ?>" cat="<?php echo $categories[0]->name ?>" id="post-<?php echo get_the_ID(); ?>" src="<?php echo get_template_directory_uri(); ?>/assets/Icons/Icon_fullscreen.png">
    
    <!-- View button -->
    <a href="<?php echo $urlrelated; ?>"><img class="view-button" src="<?php echo get_template_directory_uri(); ?>/assets/Icons/Icon_eye.png"></a>

    <!-- Lightbox text -->
    <div class="lightbox-text">
         <?php
            // Display the category
            if ($categories && !is_wp_error($categories)) {
                echo '<div class="custom-lightbox-cat">';
                echo $categories[0]->name;
                echo '</div>';
            } 

            // Display the title
            echo '<div class="custom-lightbox-title">';
            echo the_title();
            echo '</div>';
        ?>


    </div>
</div>
