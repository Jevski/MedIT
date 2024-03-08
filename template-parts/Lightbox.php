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

        <img src="<?php echo get_template_directory_uri(); ?>/assets/Icons/previous-lighbox.png" alt="photo suivante" class="lightbox-previous"/>
        <img src="<?php echo get_template_directory_uri(); ?>/assets/Icons/next-lightbox.png" alt="photo precendents" class="lightbox-next"/>
            
        
                </div>

        
        <div class="lightbox-image"><img src='' alt="image de la lightbox" id="lightbox-info-img"/></div>
        
        <div class="lightbox-infos" id="lightbox-infos">
            <p class='lightbox-info-title'></p>
            <p class='lightbox-info-cat'></p>
            






        </div>
        </div>    
    <div class="lightbox-cross " id="lightbox-cross">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/Icons/Cross-lighbox.png" alt="bouton de fermeture de modale"/>
    </div>
</div>
</div>
