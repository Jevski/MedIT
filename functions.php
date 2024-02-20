
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

function motaphoto_enqueue_lightbox() {
    wp_enqueue_script('lightbox', get_template_directory_uri() . '/js/lightbox.js', array('jquery'), '1.0');
}

add_action('wp_enqueue_scripts', 'motaphoto_enqueue_lightbox');





function custom_ajaxurl() {
    echo '<script>';
    echo 'const ajaxurl = "' . admin_url('admin-ajax.php') . '";';
    echo '</script>';
}
add_action('wp_head', 'custom_ajaxurl');
  	


function load_custom_image_callback() {
    // Verify the AJAX nonce
    check_ajax_referer('ajax-nonce', 'nonce');

    // Your custom logic to fetch the image URL
    $image_url = get_field('mota-category'); // Replace 'image_field_name' with the actual field name
    
    // Send the image URL back as a response
    wp_send_json_success(array('image_url' => $image_url));
}
add_action('wp_ajax_load_custom_image', 'load_custom_image_callback');
add_action('wp_ajax_nopriv_load_custom_image', 'load_custom_image_callback'); 




function load_more_photos() {
    // Your code to fetch additional images and return the HTML
    $page = $_POST['page'];

    
    $args = array(
        'post_type' => 'photos', 
        'posts_per_page' => "2", 
    );
    
    $query = new WP_Query($args); //on envoie la requette avec les arguments

    if ($query->have_posts()) : //si la requette retourne des résultats
        while ($query->have_posts()) : $query->the_post();
            $urlrelated = get_the_permalink();
            echo '<div class="more-photos">'; //on affiche les résultats dans la div
            echo get_the_post_thumbnail();
            echo '</div>';
        endwhile;
        wp_reset_postdata();
    else :
        echo 'Pas de photos trouvées<br/>'; //sinon message d'erreur
    endif;

    die();
}


add_action('wp_ajax_load_more_photos', 'load_more_photos');
add_action('wp_ajax_nopriv_load_more_photos', 'load_more_photos');
//ajax//







        // Chargment des commentaires en Ajax



?>


        

