<p class="get_id"><?php $postID = the_ID(); var_dump($postID); ?></p>
<?php

    $categories = get_the_terms(get_the_ID(), 'mota-category');
    
   //declaring for getting the next & previous photos
        $prev_custom_post = get_previous_post($postID);
        $next_custom_post = get_next_post($postID);
?>


<div class="lightbox-overlay inactive" id="lightbox-overlay">
<div class="lightbox-modale inactive">
    <div id="lightbox" class="">

        <div class="Buttons">
        <?php
                $current_post_id = get_the_ID(); // Get the current post ID

                // Get the next adjacent post ID
                $next_post = get_next_post(get_the_ID());
                $next_post_id = ($next_post) ? $next_post->ID : null;

                // Get the previous adjacent post ID
                $prev_post = get_previous_post(get_the_ID());
                $prev_post_id = ($prev_post) ? $prev_post->ID : null;
        ?>

        <img src="<?php echo get_template_directory_uri(); ?>/assets/Icons/previous-lighbox.png" alt="photo suivante" class="lightbox-previous" data-post-id="<?php echo $prev_post_id; ?>"/>
        <img src="<?php echo get_template_directory_uri(); ?>/assets/Icons/next-lightbox.png" alt="photo precendents" class="lightbox-next" data-post-id="<?php echo $next_post_id; ?>"/>
            
        </div>
        
        <div class="lightbox-image"><img src='' alt="image de la lightbox" id="lightbox-info-img"/></div>
        
        <div class="lightbox-infos" id="lightbox-infos">
            <p class='lightbox-info-title'></p> <!-- Placeholder for lightbox image title -->
            <p class='lightbox-info-cat'></p> <!-- Placeholder for lightbox image category -->

        </div>
        </div>    
    <div class="lightbox-cross " id="lightbox-cross">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/Icons/Cross-lighbox.png" alt="bouton de fermeture de modale"/>
    </div>
</div>
</div>