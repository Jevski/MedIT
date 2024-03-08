
<?php 



// Définir d'autres tailles d'images : 
set_post_thumbnail_size( 600, 0, false );
add_image_size( 'random-photo', 1450, 960, true );
add_image_size( 'home-gallery-image', 600, 520, true );
add_image_size( 'lightbox-image', 1300, 900, true );


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
    wp_enqueue_script('custom-script', get_template_directory_uri() . '/js/custom-script.js', array('jquery'),'1.0');
    wp_enqueue_script('script', get_template_directory_uri(). '/js/Lightbox.js', array('jquery'), '1.0');
    // Localiser vos scripts_params sur les scripts personnalisés
    wp_localize_script(
        'custom-script', // Utilisez le nom du script personnalisé où vous utilisez les paramètres,
        'scripts_params',
        array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'rest_url' => esc_url_raw(rest_url()),
            'theme_url' => get_template_directory_uri(),
        )
    );
}

add_action('wp_enqueue_scripts', 'mota_enqueue_scripts');






?>


        

