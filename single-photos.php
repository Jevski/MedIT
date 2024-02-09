<?php get_header(); ?>
<p class="get_id"><?php $postID = the_ID(); ?></p>
<section class="page">
    <section>
<article class="photo-article">

    <div class="photo-infos">
        <!-- titre -->
        <div class="info-container">
        <h1 class="entry-title"><?php the_title(); ?></h1>
        <div class="category">
            <?php
            $categories = get_the_terms(get_the_ID(), 'mota-category');
                if ($categories && !is_wp_error($categories)) {
                    echo '<div class="custom-taxonomy">';
                    echo 'Categorie : ' . $categories[0]->name;
                    echo '</div>';
                    
                }
            ?>
        </div>

        <div class="format">
            <?php
            $formats = get_the_terms(get_the_ID(), 'mota-format');
                if ($formats && !is_wp_error($formats)) {
                    echo '<div class="custom-taxonomy">';
                    echo 'Format : ' . $formats[0]->name;
                    echo '</div>';
                    }
            ?>
        </div>

        <div class="type">
            <?php
            $types = get_post_meta(get_the_ID(), 'Type', true);
                if ($types) {
                    echo 'Type : ' . esc_html($types);
                }
            ?>
        </div>
        

        <div class="ref">
            <?php
            $references = get_post_meta(get_the_ID(), 'Reference', true);
                if ($references) {
                    echo 'Reference : ' . esc_html($references);
                }
            ?>
        </div>
        <div class="year">Année : <?php the_time('Y'); ?></div>
            </div>
    </div>

        <div class="main-image-container">
            <?php the_content(); ?>
        </div>
        
    </div>
</article>
    <div class="photo-contact-container">
        <span class="photo-contact-text">Cette photo vous interesse ? </span>
        <button class="photo-contact-button"> Contact</button>
        <div class="contact-arrows-container">
        <div class="photo-contact-image">
            <?php 
                $prev_custom_post = get_previous_post($postID);
                $next_custom_post = get_next_post($postID);
        
                $next_post_thumbnail = get_the_post_thumbnail($next_custom_post, 'thumbnail');

            
                echo $next_post_thumbnail;
            ?>
        </div>
            <div class="photo-arrows">
                <?php
                if ($next_custom_post) {
                    $next_custom_post_link = get_permalink($next_custom_post);
                    echo '<a href="' . esc_url($next_custom_post_link) . '"><img src="' .get_template_directory_uri() .'/assets/Icons/left-arrow.png" 1=Default.png" 
                    alt="photo suivante" class="photo-right-arrow"/></a>';
                }
                    if ($prev_custom_post) {
                        $prev_custom_post_link = get_permalink($prev_custom_post);
                        echo '<a href="' . esc_url($prev_custom_post_link) . '"><img src="' . get_template_directory_uri() . '/assets/Icons/right-arrow.png"
                         alt="photo précédente" class="photo-left-arrow"/></a>';
                    }

                
                ?>
            </div>
    </div>
</section>

    <section class="aimerez-aussi">
        <div class="aussi-container">
            <h3 class="aussi-title">Vous aimerez aussi</h3>
            <div class="photos-related">
                
        <?php 
        $args = array(
            'post_type' => 'photos', // CPT photos
            'posts_per_page' => 2, // Récupère 2 images
            'tax_query' => array(
                array(
                    'taxonomy' => 'mota-category', // on veut filtrer sur les catégories
                    'field' => 'id',
                    'terms' => get_term_by('name', $categories[0]->name, 'mota-category')->term_id, // on veut la catégorie du post en cours
                ),
            ),
        );
        
        $query = new WP_Query($args);
        
        if ($query->have_posts()) {
            while ($query->have_posts()) {
            $query->the_post();
            $urlrelated = get_the_permalink();
            echo("<a href='".$urlrelated."'><div class='photos-two-related'>");
                $query->the_post_thumbnail();
                the_post_thumbnail(); 
            echo("</div></a>");
            }
            wp_reset_postdata(); 
        }
        ?>
    </div> 
        </div>
    

    </section>
    </section>
<?php get_footer();?>