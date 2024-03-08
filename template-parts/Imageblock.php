<div class="image-block">
        <div class="home-gallery-image">
            
            <div id="img-<?php echo get_the_ID(); ?>" class="gallery-image"><?php  echo get_the_post_thumbnail(); ?></div>
            <?php get_template_part('/template-parts/small-lightbox'); ?>
            
        </div>



    <!-- <div class="error-message">
        <p>Pas de photos trouvées<br/></p>
    </div> error message -->


</div>

