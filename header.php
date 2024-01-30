<!doctype html>
<html lang ="fr">
    <head>
        <meta charset ="utf-8"/>
        <meta name ="viewport" content ="width=device-width, initIal-scale=1" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;0,400;1,200;1,600&family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
        
        <title> Mona Photographes </title>
        <?php wp_head(); ?>
    </head>
<body>


<header class="header">
<a href="<?php echo home_url(); ?>">
<img class="logoHeader" src="<?php echo get_template_directory_uri(); ?>/assets/Logo.png" alt='logo MotaPhoto'/></a>

<?php 
    wp_nav_menu(
        array(
            'menu'=> 'Header Menu',
            'container' => ''
            
        )
    );

?>

</header>

</body>