
<?php 



// Setting additional image sizes
set_post_thumbnail_size( 600, 0, false );
add_image_size( 'random-photo', 1450, 960, true ); // Adding custom image size for random photos
add_image_size( 'gallery-image', 600, 520, true ); // Adding custom image size for home gallery images
add_image_size( 'lightbox-image', 1300, 900, true ); // Adding custom image size for lightbox images


// Function to register navigation menus
function add_nav_menus(){
    $locations= array(
        'header' => "Header Menu", // Header menu location
        'footer' => "Footer Menu"  // Footer menu location
    );
    register_nav_menus($locations);
}
add_action('init', 'add_nav_menus');

// Function to enqueue styles
function mota_enqueue_styles() {
    // Enqueue theme style
    wp_enqueue_style( 'theme-style',
        get_stylesheet_directory_uri() . '/style.css',
        wp_get_theme()->get('1.0.0')
    );
}
add_action( 'wp_enqueue_scripts', 'mota_enqueue_styles' );

// Function to enqueue scripts
function mota_enqueue_scripts() {
    // Enqueue jQuery
    wp_enqueue_script('jquery');

    // Enqueue Select2 styles and scripts
    wp_enqueue_style('select2',  "https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" );
    wp_enqueue_script('select2', "https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js", array('jquery'), '4.1.0-rc.0');

    // Enqueue custom scripts
    wp_enqueue_script('mon-script', get_template_directory_uri() . '/js/script.js', array('jquery'),'1.0');
    wp_enqueue_script('custom-script', get_template_directory_uri() . '/js/custom-script.js', array('jquery'),'1.0');
    wp_enqueue_script('script', get_template_directory_uri(). '/js/Lightbox.js', array('jquery'), '1.0');

    // Localize custom scripts with necessary parameters
    wp_localize_script(
        'custom-script', // Script handle
        'scripts_params', // Object name in JavaScript
        array(
            'ajaxurl' => admin_url('admin-ajax.php'), // URL for admin AJAX requests
            'rest_url' => esc_url_raw(rest_url()), // REST API URL
            'theme_url' => get_template_directory_uri(), // Theme directory URL
        )
    );
}

add_action('wp_enqueue_scripts', 'mota_enqueue_scripts');



// Add AJAX action for fetching next post ID
add_action('wp_ajax_get_next_post_id', 'get_next_post_id_callback');
add_action('wp_ajax_nopriv_get_next_post_id', 'get_next_post_id_callback');

function get_next_post_id() {
    // Check if the request is coming from a valid AJAX call
    check_ajax_referer('my_ajax_nonce', 'security');

    // Get the current post ID
    $current_post_id = isset($_POST['.lightbox-image']) ? $_POST['current_post_id'] : '';

    // Your logic to get the next post ID goes here
    // For demonstration purposes, let's assume the next post ID is the current post ID + 1
    $next_post_id = $current_post_id + 1;

    // Prepare the response
    $response = array(
        'next_post_id' => $next_post_id
    );

    // Send the response back as JSON
    wp_send_json($response);

    // It's important to exit after sending the response to avoid extra output
    exit;
}


?>


        

