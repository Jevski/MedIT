<!-- /**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
 -->
 
 <?php get_header(); ?> <!-- Include header -->

<p class="get_id"><?php $postID = the_ID(); ?></p> <!-- Get the post ID -->

<section class="page">
    <section>
<article class="photo-article">

    <div class="photo-infos">
        <!-- Title -->
        <div class="info-container">
        <h1 class="entry-title"><?php the_title(); ?></h1>
        <!-- Category -->
        <div class="category">
            <?php
            // Display category information
            $categories = get_the_terms(get_the_ID(), 'mota-category');
                if ($categories && !is_wp_error($categories)) {
                    echo '<div class="custom-taxonomy">';
                    echo 'Categorie : ' . $categories[0]->name;
                    echo '</div>';
                    
                }
            ?>
        </div>

        <!-- Format -->
        <div class="format">
            <?php
            // Display format information
            $formats = get_the_terms(get_the_ID(), 'mota-format');
                if ($formats && !is_wp_error($formats)) {
                    echo '<div class="custom-taxonomy">';
                    echo 'Format : ' . $formats[0]->name;
                    echo '</div>';
                    }
            ?>
        </div>

        <!-- Type -->
        <div class="type">
            <?php
            // Display type information
            $types = get_post_meta(get_the_ID(), 'Type', true);
                if ($types) {
                    echo 'Type : ' . esc_html($types);
                }
            ?>
        </div>
        
        <!-- Reference -->
        <div class="ref">
            <?php
            // Display reference information
            $references = get_post_meta(get_the_ID(), 'Reference', true);
                if ($references) {
                    echo 'Reference : ' . esc_html($references);
                }
            ?>
             <script>
            // Pass PHP reference variable to JavaScript for prewriting in the form
            var prepopulateRef = <?php echo json_encode($references); ?>;
        </script>

        </div>
        <!-- Year -->
        <div class="year">Année : <?php the_time('Y'); ?></div>
            </div>
    </div>
        <div class="main-image-container">
            <?php the_content(); ?> <!-- Display main image content -->
        </div>
    </div>
</article>

    <div class="photo-contact-container">
        <span class="photo-contact-text">Cette photo vous interesse ? </span>

        <!-- Contact button -->
        <button class="photo-contact-button"> Contact</button>
        <!-- Previous and next photo navigation -->
        <div class="contact-arrows-container">
        <div class="photo-contact-image">
            <?php 
                // Get previous post's thumbnail
                $prev_custom_post = get_previous_post($postID);
                $next_custom_post = get_next_post($postID);
        
                $next_post_thumbnail = get_the_post_thumbnail($prev_custom_post, 'thumbnail');

                echo $next_post_thumbnail;
            ?>
        </div>

            <div class="photo-arrows">
                <?php
                // Display previous and next photo navigation arrows
                if ($next_custom_post) {
                    $next_custom_post_link = get_permalink($next_custom_post);
                    echo '<a href="' . esc_url($next_custom_post_link) . '"><img src="' .get_template_directory_uri() .'/assets/Icons/left-arrow.png" 1=Default.png" 
                    alt="photo suivante" class="photo-right-arrow nextButton"/></a>';
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
            <!-- Related photos section -->
            <div class="photos-related">
                
             <?php 
                // Query to display related photos
                $categories = get_the_terms(get_the_ID(), 'mota-category');

                $args = array(
                    'post_type' => 'photos', 
                    'posts_per_page' => 2, 
                    'orderby' => 'rand', // Order by random
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'mota-category',
                            'terms' => $categories[0]->term_id,
                            // Use the first category of the current post
                        ),
                    ),
                );
                
                $query = new WP_Query($args);
                
                if ($query->have_posts()) {
                    while ($query->have_posts()) {
                        $query->the_post();
                        echo get_template_part('/template-parts/Imageblock'); // Include related photo template
                    }
                    wp_reset_postdata(); 
                }
            ?> 
    </div> 
        </div>
    

    </section>
    </section>
<?php get_footer();?> <!-- Include footer -->