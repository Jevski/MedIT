<p class="get_id"><?php $postID = the_ID();
var_dump($postID); ?>
<?php
    $categories = get_the_terms(get_the_ID(), 'mota-category');

    $args = array(
        'post_type' => 'photos',
        'posts_per_page' => -1,
    );
    
    $query = new WP_Query($args);

    $photo_objects = array(); // Initialize the array outside the loop

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $categories = get_the_terms(get_the_ID(), 'mota-category');
            
            $photo_data = array(
                'thumbnail' => get_the_post_thumbnail_url(),
                'reference' => get_post_meta(get_the_ID(), 'mota-reference', true),
                'category' => $categories[0]->name, 
            );
            $photo_objects[] = $photo_data;
        }
        wp_reset_postdata();
    }
//declaring for getting the next & previous photos
        $prev_custom_post = get_previous_post($postID);
        $next_custom_post = get_next_post($postID);
    
            ?>
<script>
//     // Check if $photo_objects is set before encoding
   let dataPhotos = <?php echo isset($photo_objects) ? json_encode($photo_objects) : '[]'; ?>;
// </script>

<div class="lightbox-overlay inactive" id="lightbox-overlay">
<div class="lightbox-modale ">
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

                
                ?>
                </div>
        <div class="lightbox-image"><img src='<?php echo get_the_post_thumbnail_url(); ?>' alt="image de la lightbox" id="lightbox-info-img"/></div>
    
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
