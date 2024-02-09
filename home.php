


<?php 
get_header(); ?>
<section class="page">
<div class="hero-banner">
    <div class="random-photo">
    <?php
    
    $random_photo_args = array(
        'post_type'      => 'photos', 
        'posts_per_page' => 1,
        'orderby'        => 'rand',
    );

    $random_photo_query = new WP_Query($random_photo_args);

    if ($random_photo_query->have_posts()) :
        while ($random_photo_query->have_posts()) : $random_photo_query->the_post();
            // affiche l'image random
            if (has_post_thumbnail()) {
                the_post_thumbnail('full'); 
            }
        endwhile;
        wp_reset_postdata();
    endif; 
    ?>
    <div class="hero-title">
    
    <img src="<?php echo get_template_directory_uri();?>/assets/Titreheader.png" alt="photographe event"/>
</div>
  

    <div class="photos-container">
        
</div>
</section>
<?php
get_footer(); ?>