
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
                'category' => isset($categories[0]) ? $categories[0]->name : '', // Check if categories exist
            );
            $photo_objects[] = $photo_data;
        }
        wp_reset_postdata();
    }
?>
<script>
    // Check if $photo_objects is set before encoding
    let dataPhotos = <?php echo isset($photo_objects) ? json_encode($photo_objects) : '[]'; ?>;
</script>

<div class="lightbox-overlay " id="lightbox-overlay"></div>
<div class="lightbox-modale">
    <div id="lightbox" class="">
        <div class="lightbox-previous" id="lightbox-previous"><img src="<?php echo get_template_directory_uri(); ?>/assets/Icons/next-lightbox.png"></div>
        <div class="lightbox-image"><img src='<?php echo get_the_post_thumbnail_url(); ?>' alt="image de la lightbox" id="lightbox-info-img"/></div>
        <div class="lightbox-next" id="lightbox-previous"><img src="<?php echo get_template_directory_uri(); ?>/assets/Icons/previous-lighbox.png"></div>
    </div>
    <div class="lightbox-infos" id="lightbox-infos">
        <p id='lightbox-info-ref'><?php echo(get_post_meta(get_the_ID(), 'reference', true)); ?></p>
        <p id='lightbox-info-cat'><?php foreach ($categories as $categorie) { echo($categorie->name); } ?></p>
    </div>
    <div class="lightbox-cross " id="lightbox-cross">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/Icons/Cross-lighbox.png" alt="bouton de fermeture de modale"/>
    </div>
</div>
