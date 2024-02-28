<p class="get_id"><?php $postID = the_ID();
var_dump($postID); ?>
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
                if ($next_custom_post) {
                    $next_custom_post_link = get_permalink($next_custom_post);
                    echo '<a href="' . esc_url($next_custom_post_link) . '"> <img src= "' .get_template_directory_uri() . '/assets/Icons/previous-lighbox.png"  
                    alt="photo suivante" class="lightbox-previous"/> </a>';
                }
                    if ($prev_custom_post) {
                        $prev_custom_post_link = get_permalink($prev_custom_post);
                        echo '<a href="' . esc_url($prev_custom_post_link) . '"> <img src= "' .get_template_directory_uri() . '/assets/Icons/next-lightbox.png"  
                         alt="photo précédente" class="lightbox-next"/></a>';
                    }
                    // $image_ID = get_the_thumbnail(get_the_ID()); 
                    // var_dump($image_ID);
                
                ?>
                </div>
        <div class="lightbox-image"><img src='<?php echo $image_ID?>' alt="image de la lightbox" id="lightbox-info-img"/></div>
    
        <div class="lightbox-infos" id="lightbox-infos">
            <p class='lightbox-info-ref'><?php echo(get_post_meta(get_the_ID(), 'Reference', true)); ?></p>
            <p class='lightbox-info-cat'><?php $categories = get_the_terms(get_the_ID(), 'mota-category');
              echo $categories[0]->name; ?></p>
        </div>
        </div>    
    <div class="lightbox-cross " id="lightbox-cross">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/Icons/Cross-lighbox.png" alt="bouton de fermeture de modale"/>
    </div>
</div>
</div>
