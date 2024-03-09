<div class="image-block"> <!-- Container for the image block -->
    <div class="home-gallery-image"> <!-- Container for the home gallery image -->
        
        <div id="img-<?php echo get_the_ID(); ?>" class="gallery-image"><?php echo get_the_post_thumbnail(); ?></div> <!-- Display the post thumbnail image -->
        <?php get_template_part('/template-parts/small-lightbox'); ?> <!-- Include the small lightbox template -->
        
    </div>
</div>

