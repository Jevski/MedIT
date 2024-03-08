<div class="lightbox-icons inactive">
    <?php $urlrelated = get_the_permalink();
    $categories = get_the_terms(get_the_ID(), 'mota-category');?>

    
    <img class="fullscreen-button" title=" <?php echo get_the_title()?>" cat=" <?php  echo $categories[0]->name ?>" id="post-<?php echo get_the_ID(); ?>" src="<?php echo get_template_directory_uri(); ?>/assets/Icons/Icon_fullscreen.png">
    <a href="<?php echo $urlrelated; ?>"><img class="view-button" src="<?php echo get_template_directory_uri(); ?>/assets/Icons/Icon_eye.png"></a>

    
    <div class="lightbox-text">
         <?php
        $categories = get_the_terms(get_the_ID(), 'mota-category');
        if ($categories && !is_wp_error($categories)) {
            echo '<div class="custom-lightbox-cat">';
            echo $categories[0]->term_id;
            echo '</div>';
        } 


        echo '<div class="custom-lightbox-title">';
        echo the_title();
        echo '</div>';
        
        ?>


    </div>
</div>
