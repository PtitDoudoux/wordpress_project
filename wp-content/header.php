<!DOCTYPE html>
<html>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>" />
        <title><?php wp_title(); ?></title>
        <?php wp_head(); ?>
    </head>
<body>
	<header>
		<img src="<?php header_image();?>">
	</header><!-- /header --> 
   <h1><?php bloginfo( 'name' ); ?></h1>
   <h2><?php bloginfo( 'description' ); ?></h2>  

	<?php 
		if ( has_nav_menu('main_menu') ) {
		wp_nav_menu(array('theme-location' => 'main_menu') ); 
	}