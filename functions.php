
<?php 

function add_nav_menus(){
    $locations= array(
        'header' => "Header Menu",
        'footer' => "Footer Menu"
    );
    register_nav_menus($locations);
}
add_action('init', 'add_nav_menus');



function mota_enqueue_styles() {
    wp_enqueue_style( 'theme-style',
        get_stylesheet_directory_uri() . '/style.css',
        wp_get_theme()->get('1.0.0')
    );
  }
  add_action( 'wp_enqueue_scripts', 'mota_enqueue_styles' );
  


function mota_enqueue_scripts() {
    wp_enqueue_script('mon-script', get_template_directory_uri() . '/js/script.js', array('jquery'),'1.0');
    
    
}

add_action('wp_enqueue_scripts', 'mota_enqueue_scripts');



function custom_ajaxurl() {
    echo '<script>';
    echo 'const ajaxurl = "' . admin_url('admin-ajax.php') . '";';
    echo '</script>';
}
add_action('wp_head', 'custom_ajaxurl');

  	
function custom_template_lightbox(){
    echo '<script>';
    echo 'const templateParts = "/template-parts/lightbox-main.php" ';
    echo '</script>';
}
add_action( 'wp_head', 'custom_template_lightbox');


function load_more_photos() {
    // Your code to fetch additional images and return the HTML
    $numberphoto = $_POST['numberphoto'];
    $offset = $_POST['offset'];
    $format = $_POST['format'];
    $category = $_POST['category'];
    $order = $_POST['order'];
    
        
    $query= array();
//if category filter has been changed//
    if ($category != ''){
        $query[] = array(
            'taxonomy' => 'mota-category',
            'field' => 'slug',
            'terms' => $category,
        );
    }
//if format filter has been changed//
    if ($format != ''){
        $query[] = array(
            'taxonomy' => 'mota-format',
            'field' => 'slug',
            'terms' => $format,
        );
    }
// If both filters have been changed//
    if (count($query) > 1){
        $query['relation'] = 'AND';
        
    }
    // var_dump($query);
        $args = array(
            'post_type' => 'photos', 
            'posts_per_page' => $numberphoto,
            'offset' => $offset,
            'order' => $order,
            'tax_query' => $query
        );
      

    $query = new WP_Query($args); 

    if ($query->have_posts()) : 
        while ($query->have_posts()) :
            $query->the_post();
            $urlrelated = get_the_permalink();
            echo '<div class="home-gallery-image">'; 
            echo get_the_post_thumbnail();
            echo    '<div class="lightbox-icons ">
                    <img class="fullscreen-button" src="' . get_template_directory_uri() . '/assets/Icons/Icon_fullscreen.png">
                    <a href="' . $urlrelated . '"><img class="view-button" src="' . get_template_directory_uri() . '/assets/Icons/Icon_eye.png"></a>';
            
            echo '<div class="lightbox-text">';
            $categories = get_the_terms(get_the_ID(), 'mota-category');
            if ($categories && !is_wp_error($categories)) {
                echo '<div class="custom-lightbox-cat">';
                echo $categories[0]->name;
                echo '</div>';
            }
            $references = get_post_meta(get_the_ID(), 'Reference', true);
            if ($references) {
                echo '<div class="custom-lightbox-ref">';
                echo  esc_html($references);
                }


            
            echo '</div></div></div></div>';
        endwhile;
        wp_reset_postdata();
    else :
        echo '<div class="error-message">';
        echo '<p>Pas de photos trouvées<br/></p>';
        echo' </div>'; //error message
    endif;

   

    die();
}


add_action('wp_ajax_load_more_photos', 'load_more_photos');
add_action('wp_ajax_nopriv_load_more_photos', 'load_more_photos');




function motaphoto_enqueue_lightbox() {
    wp_enqueue_script ('lightbox', get_template_directory_uri() . '/js/lightbox.js', array('jquery'), '1.0');
}

add_action('wp_enqueue_scripts', 'motaphoto_enqueue_lightbox');




?>


        

