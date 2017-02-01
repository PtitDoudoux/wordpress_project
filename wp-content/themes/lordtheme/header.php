<!DOCTYPE html>
<html style="margin: 0 !important;">
    <head>
        <meta charset="<?php bloginfo('charset'); ?>" />
        <link rel="stylesheet" type="text/css" href="../wp-content/themes/lordtheme/css/creemson.css">
        <link rel="stylesheet" type="text/css" href="../wp-content/themes/lordtheme/css/font-awesome.css">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <title>
            - Lebee -
        </title>
        <?php wp_head(); ?>
    </head>
    <body>
    	<!-- header -->
		<header>
            <a href="<?= site_url(); ?>">
                <img src="<?php header_image(); ?>" class="logo">
            </a>
            <?php 
                $menu_items = wp_get_nav_menu_items('main-nav');
                if( $menu_items ) {
                    echo "<ul id='nav-menu-PP'>";
                    foreach ($menu_items as $menu_item ) {
                        $title = $menu_item->title;
                        $id = $menu_item->object_id;
                        echo "
                            <li class='menu-".$title."'>"
                        ?>
                        <?php 
                            if(is_page('Home')){
                                echo "<a href='#".$title."'>".ucfirst($title)."</a>";
                            }else{
                                echo "<a href='".site_url()."/home/#".$title."'>".ucfirst($title)."</a>";
                            }
                        ?>
                        <?= 
                            "</li>
                            ";
                    }
                    echo "</ul>";
                }
                if(is_page('home')){
                    echo "<a class='mute'><img src='../wp-content/uploads/2016/07/sound.png' class='sound_header'></a>";
                }
            ?>      		
		</header>
		<!-- /header --> 
