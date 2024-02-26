


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

    $random_photo = new WP_Query($random_photo_args);

    if ($random_photo->have_posts()) :
        while ($random_photo->have_posts()) : $random_photo->the_post();
            if (has_post_thumbnail()) {
                the_post_thumbnail('full'); 
            }
        endwhile;
        wp_reset_postdata();
    endif; 
    ?>
    </div>
    <div class="hero-title">
    <img src="<?php echo get_template_directory_uri();?>/assets/Titreheader.png" alt="photographe event"/>
    </div>
</div> 

    
<div class="filters">

    <div class="filters-left">
        <select id="category-select" class="category-filter">
            <label>
            <option value=""></option>
            <?php
                $terms = get_terms(array(
                    'taxonomy' => 'mota-category',
                    'hide_empty' => false,
                ));
                if ($terms && !is_wp_error($terms)) {
                    foreach ($terms as $term) {
                        echo '<option class="test" value="' . $term->slug . '">' . $term->name . '</option>';
                    }
                }
            ?>
            </label>
        </select>
            </div>
        <!-- Format -->
        <div class="filter-middle">
        <select id="format-select" class="format-filter">
            <option value="">Format</option>
            <?php
                $terms = get_terms(array(
                    'taxonomy' => 'mota-format',
                    'hide_empty' => false,
                ));
                
                if ($terms && !is_wp_error($terms)) {
                    foreach ($terms as $term) {
                        echo '<option value="' . $term->slug . '">' . $term->name . '</option>';
                    }
                }
            ?>
        </select>
        </div>
      
     
    <div class="filters-right">
        <select id ="order-select" class="time-filter">
            <option value="">Trier par</option>
            <option value="ASC">Date - Ordre croissant</option>
            <option value="DESC">Date - Ordre décroissant</option>
        </select>
    </div>
</div>
            </div>


</div>


    <div class="ajax-container">
        
    </div>
    
</div>
<div class="load-more-photos-box">
    <button id="load-more-photos">Charger plus</button>
</div>

</section>
<?php get_footer(); ?>