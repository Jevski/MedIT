


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
        <!-- Category-->
        <label class="select2filter">
        <select id="category-select" class="category-filter">
            <option selected value="all">Catégories</option>
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
        </select>
        </label>

        <!-- Format -->
        <select id="format-select" class="format-filter">
            <option value="all">Format</option>
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
    <select id ="order-select" class="time-filter">
        <option value="ASC">Trier par</option>
        <option value="ASC">Date - Ordre croissant</option>
        <option value="DESC">Date - Ordre décroissant</option>
    </select>
</div>
</div>

<div class="photos-container">
    <div class="home-gallery-container">
        <?php 
        $categories = get_the_terms(get_the_ID(), 'mota-category');
        $args = array(
            'post_type' => 'photos', 
            'posts_per_page' => "2", 
        );
        
        $query = new WP_Query($args);
        
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $urlrelated = get_the_permalink();
                ?>
                <div class="home-gallery-image">
                    
                        <?php 
                        the_post_thumbnail(); 
                        ?>
                    </a>
                    <div class="lightbox-icons inactive">
                        <img class="fullscreen-button" src="<?php echo get_template_directory_uri(); ?>/assets/Icons/Icon_fullscreen.png">
                        <a href="<?php echo $urlrelated; ?>"><img class="view-button" src="<?php echo get_template_directory_uri(); ?>/assets/Icons/Icon_eye.png"></a>
                        <div class="lightbox-text">
                        <p>
                        <?php
                            $categories = get_the_terms(get_the_ID(), 'mota-category');
                                if ($categories && !is_wp_error($categories)) {
                                    echo '<div class="custom-lightbox-cat">';
                                    echo  $categories[0]->name;
                                    echo '</div>';
                                    
                                }
                            ?>
                        </p>
                        <span>
                        <?php
                            $references = get_post_meta(get_the_ID(), 'Reference', true);
                                if ($references) {
                                    echo '<div class="custom-lightbox-ref">';
                                    echo  esc_html($references);
                                    echo '</div';
                                }
                                
                        ?>
                        </span>
                            </div>
                    </div>
                </div>
                <?php
            }
            wp_reset_postdata(); 
        }
        ?>
    </div>
</div>
<div > 


    <div class="ajax-container">

    
    </div>
    
</div>
<div class="load-more-photos-box">
    <button id="load-more-photos">Charger plus</button>
</div>

</section>
<?php get_footer(); ?>