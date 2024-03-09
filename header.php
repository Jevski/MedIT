<!doctype html>
<html lang ="fr">
    <head>
        <meta charset ="utf-8"/> <!-- Set character encoding to UTF-8 -->
        <meta name ="viewport" content ="width=device-width, initIal-scale=1" /> <!-- Configure viewport for responsive design -->
        <link rel="preconnect" href="https://fonts.googleapis.com"> <!-- Preconnect to Google Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> <!-- Preconnect to Google Fonts server -->
        <!-- Import Google Fonts: Poppins and Space Mono -->
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;0,400;1,200;1,600&family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script> <!-- Include jQuery library -->
        <title> Mona Photographes </title> <!-- Set the title of the page -->
        <?php wp_head(); ?> <!-- Include WordPress core styles and scripts -->
    </head>
<body>


<header class="header">
<a href="<?php echo home_url(); ?>"> <!-- Link to home page -->
<img class="logoHeader" src="<?php echo get_template_directory_uri(); ?>/assets/Logo.png" alt='logo MotaPhoto'/></a> <!-- Logo image -->

<!-- Display header menu -->
<?php 
    wp_nav_menu(
        array(
            'menu'=> 'Header Menu',
            'container' => '',
        )
    );
?>

<div class="menu-mobile ">
        <img class ="hamburger-menu " src="<?php echo get_template_directory_uri(); ?>/assets/Hamburger.png" alt='bouton du menu' /> <!-- Hamburger menu icon -->
        <img class="cross-menu inactive" src="<?php echo get_template_directory_uri(); ?>/assets/Cross.png" alt='bouton de fermeture du menu' /> <!-- Cross menu icon -->
    </div>
    
<div class="open-nav-menu" style="display:none;"> <!-- Open navigation menu -->

<!-- Display header menu in mobile -->
    <div class="header-nav-mobile">
<?php 
    wp_nav_menu( 
        array(
            'menu'=> 'Header Menu',
            'container' => '',
        )
    );
?>
</div>
</div>

</header>


</body>