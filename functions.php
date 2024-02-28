
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
    wp_enqueue_script('jquery');
    wp_enqueue_style('select2',  "https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" );
    wp_enqueue_script('select2', "https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js", array('jquery'), '4.1.0-rc.0');
    wp_enqueue_script('mon-script', get_template_directory_uri() . '/js/script.js', array('jquery'),'1.0');
    
    
}

add_action('wp_enqueue_scripts', 'mota_enqueue_scripts');



function custom_ajaxurl() {
    echo '<script>';
    echo 'const ajaxurl = "' . admin_url('admin-ajax.php') . '";';
    echo '</script>';
    
}
add_action('wp_head', 'custom_ajaxurl');

function getlightbox_image(){
    
}

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
            echo get_template_part('/template-parts/Imageblock');
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


//Get Image post ids//

function get_image_postID(){
    $post_id = get_the_ID(); // Retrieve the ID of the current post
    $postThumbnail = get_the_post_thumbnail($post_id); // Retrieve the post thumbnail of the current post
    
    // Return an array containing the post ID and the post thumbnail as JSON
    echo json_encode(array(
        'post_id' => $post_id,
        'post_thumbnail' => $postThumbnail
    ));
    wp_die(); // Always include wp_die() at the end of your Ajax callback function.
}
add_action('wp_ajax_get_image_postID', 'get_image_postID');
add_action('wp_ajax_nopriv_get_image_postID', 'get_image_postID');

//Lightbox script//


function motaphoto_enqueue_lightbox() {
    wp_enqueue_script ('lightbox', get_template_directory_uri() . '/js/lightbox.js', array('jquery'), '1.0');
}

add_action('wp_enqueue_scripts', 'motaphoto_enqueue_lightbox');



//testing to get the values here//


?>


        

