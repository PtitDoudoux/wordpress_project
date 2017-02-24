<?php


function include_styles_scripts(){
	wp_enqueue_style('style-name', get_stylesheet_uri());
}

add_action('wp_enqueue_scripts', 'include_styles_scripts');

function menus(){
	register_nav_menus( 
		array(
	        'Top' => 'Navigation principale',
	    ) 
	);
}
add_action('init', 'menus');

/* BOOTSTRAP */ 
function register_css() {
    wp_register_style( 'bootstrap-min', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css' );
    wp_register_style( 'bootstrap-theme-min', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css' );
    wp_enqueue_style( 'bootstrap-min' );
    wp_enqueue_style( 'bootstrap-theme-min' );
}
add_action( 'wp_enqueue_scripts', 'register_css' );

/*
Zone de widget
*/

function sidebars(){
	register_sidebar(array(
		'name' => __('Main_Sidebar', 'lordtheme'),
		'id' => 'sidebar-1',
		'description' => __('Widgets in this area will be shown ')
		));

	register_sidebar(array( 
		'name'=>'footer-ABOUT', 
		'id' => 'sidebar-2',
		'before_widget' => '<li>', 
		'after_widget' => '</li>', 
		'before_title' => '<h2>', 
		'after_title' => '</h2>', 
	)); 

	register_sidebar(array( 
		'name'=>'footer-NETWORKS', 
		'id' => 'sidebar-3',
		'before_widget' => '<li>', 
		'after_widget' => '</li>', 
		'before_title' => '<h2>', 
		'after_title' => '</h2>', 
	));

	register_sidebar(array( 
		'name'=>'footer-HELP', 
		'id' => 'sidebar-4',
		'before_widget' => '<li>', 
		'after_widget' => '</li>', 
		'before_title' => '<h2>', 
		'after_title' => '</h2>', 
	));
}

add_action('widgets_init', 'sidebars');

/* AJOUTER MEDIA BUTTON */
add_action( 'admin_enqueue_scripts', 'admin_theme_scripts' );

function admin_theme_scripts() {
    wp_enqueue_media();
    wp_enqueue_script( 'custom-admin', get_template_directory_uri() . '/js/admin.js', array(), '1.0.0', true );
}

/*
*Logo d'en tete
*/

//
$defaults = array(
	'default-image'          => '',
	'random-default'         => false,
	'width'                  => 0,
	'height'                 => 0,
	'flex-height'            => false,
	'flex-width'             => false,
	'default-text-color'     => '',
	'header-text'            => true,
	'uploads'                => true,
	'wp-head-callback'       => '',
	'admin-head-callback'    => '',
	'admin-preview-callback' => '',
);

add_theme_support('custom-header', $defaults);

/*
* Page admin
*/

/* ------THEME OPTION DAT FUCK------ */
function changeBackground(){
	add_menu_page('Changement du theme', 'Theme Option', 'administrator', 'manage_options', 'options_page', 'dashicons-store');
}

add_action('admin_menu', 'changeBackground');

function theme_options(){
	register_setting('#menu-main-nav', 'text_color_menu_main');

	register_setting('#Home', 'contact_img');
	register_setting('#Home', 'text_color');
	register_setting('#Home', 'url_vid');
	register_setting('#Home', 'url_ext_vid');

	register_setting('#Work', 'background_color_work');
	register_setting('#Work', 'subTitleWork');

	register_setting('#Films', 'background_color_film');
	register_setting('#Films', 'subTitleFilms');

	register_setting('#Advertising', 'background_color_advertising');
	register_setting('#Advertising', 'subTitleAdvertising');
	register_setting('#Advertising', 'text_color_advert_h1');
	register_setting('#Advertising', 'text_color_advert_subtitle');

	register_setting('#Press', 'background_color_press');
	register_setting('#Press', 'subTitlePress');

	register_setting('#Biography', 'background_color_bio');
	register_setting('#Biography', 'subTitleBio');
	register_setting('#Biography', 'text_color_bio_h1');
	register_setting('#Biography', 'text_color_bio_subtitle');

	register_setting('#Contact', 'background_color_contact');
	register_setting('#Contact', 'subTitleContact');
}

add_action('admin_init', 'theme_options');

function options_page(){
	//MAIN MENU
	echo '<h1 style="text-align:center;">Customizing the theme Lordtheme !</h1><br/><h5 style="text-align:center;">Thanks to the team of Billet Violet :</h5>'
		."<img src='http://img.over-blog-kiwi.com/1/62/73/19/20160212/ob_3989ee_2272077-908-billet-500-euros.jpg' style='width:10%; margin-top: 5px; border: 1px solid grey; margin-left: 45%;'>"
		."<div id='warning' style='display: block; position: relative; height: 7vh; width: 15%; overflow: auto; border: 1px solid #e5e5e5;
			-webkit-box-shadow: 0 1px 1px rgba(0,0,0,.04); box-shadow: 0 1px 1px rgba(0,0,0,.04); background: #fff; font-size: 13px;
			line-height: 2.1em; text-align: center; margin: 10px 20px; padding: 0px 10px 10px; font-weight: bold; color: red;'>
				Don't forget to clean the input whose doesn't use !</div>"
		."<div style='position: relative; overflow: auto; margin: 10px 20px; padding: 0px 10px 10px; border: 1px solid #e5e5e5; -webkit-box-shadow: 0 1px 1px rgba(0,0,0,.04); box-shadow: 0 1px 1px rgba(0,0,0,.04); background: #fff; font-size: 13px; line-height: 2.1em;'><h1 style='text-align:center;'>Change the color of Main Menu</h1>"
	. '<form action="options.php" method="POST" class="formAccueil">';
		settings_fields('#menu-main-nav');
		echo 
		'<label for="text_color_menu_main">Change the text color : </label><input id="text_color_menu_main" name="text_color_menu_main" value="'.get_option('text_color_menu_main').'" type="text"><br/><br/>'
		. '<input type="submit" value="Update" class="button button-primary customize load-customize hide-if-no-customize">
	</form></div>';
	//Partie Accueil
	echo 
		"<div style='position: relative; overflow: auto; margin: 10px 20px; padding: 0px 10px 10px; border: 1px solid #e5e5e5; -webkit-box-shadow: 0 1px 1px rgba(0,0,0,.04); box-shadow: 0 1px 1px rgba(0,0,0,.04); background: #fff; font-size: 13px; line-height: 2.1em;'><h1 style='text-align:center;'>Change the interface of the Home Page</h1>"
		.'<h4 style="text-align:center;">(To change the background image or video, clean the input whose doesn\'t use)</h4>'
	. '<form action="options.php" method="POST" class="formAccueil" id="subTitleAccueil">';
		settings_fields('#Home');
		echo 
		'<label for="contact_img">Change background image :</label>
			<input id="contact_img" type="text" size="36" name="contact_img" value="'.get_option( 'contact_img' ).'" />
			<input id="contact_img_button" class="button" type="button" value="Choose picture" /><br/><br/>'
		.'<label for="url_vid">Change background video :</label>
			<input id="url_vid" type="text" size="36" name="url_vid" value="'.get_option( 'url_vid' ).'" />
			<input id="url_vid_button" class="button" type="button" value="Choose video" /><br/><br/>'
		.'<label for="url_ext_vid">Change background video to external url :</label>
			<input id="url_ext_vid" type="text" size="36" name="url_ext_vid" value="'.get_option( 'url_ext_vid' ).'" />
			<br/><br/>'
		. '<label for="text_color">Change the text color : </label><input id="text_color" name="text_color" value="'.get_option('text_color').'" type="text"><br/><br/>'

		. '<input type="submit" value="Update" class="button button-primary customize load-customize hide-if-no-customize">
	</form></div>';
	//Partie Work
	echo "<div style='position: relative; overflow: auto; margin: 10px 20px; padding: 0px 10px 10px; border: 1px solid #e5e5e5; -webkit-box-shadow: 0 1px 1px rgba(0,0,0,.04); box-shadow: 0 1px 1px rgba(0,0,0,.04); background: #fff; font-size: 13px; line-height: 2.1em;'><h1 style='text-align:center;'>Change the interface of the Work Page</h1>"
	. '<form action="options.php" method="POST" class="formAccueil">';
		settings_fields('#Work');
		echo 
		'<label for="subTitleWork">Change subtitle : </label><input id="subTitleWork" name="subTitleWork" value="'.get_option('subTitleWork').'" type="text"><br/><br/>'
		.'<label for="background_color_work">Change background color : </label><input id="background_color_work" name="background_color_work" value="'.get_option('background_color_work').'" type="text"><br/><br/>'
		. '<input type="submit" value="Update" class="button button-primary customize load-customize hide-if-no-customize">
	</form></div>';
		//Partie Films
	echo "<div style='position: relative; overflow: auto; margin: 10px 20px; padding: 0px 10px 10px; border: 1px solid #e5e5e5; -webkit-box-shadow: 0 1px 1px rgba(0,0,0,.04); box-shadow: 0 1px 1px rgba(0,0,0,.04); background: #fff; font-size: 13px; line-height: 2.1em;'><h1 style='text-align:center;'>Change the interface of the Movie Page</h1>"
	. '<form action="options.php" method="POST" class="formAccueil">';
		settings_fields('#Films');
		echo 
		'<label for="subTitleFilms">Change subtitle : </label><input id="subTitleFilms" name="subTitleFilms" value="'.get_option('subTitleFilms').'" type="text"><br/><br/>'
		.'<label for="background_color_film">Change background color : </label><input id="background_color_film" name="background_color_film" value="'.get_option('background_color_film').'" type="text"><br/><br/>'
		.'<label for="text_color_film_h1">Change text color of h1 : </label><input id="text_color_film_h1" name="text_color_film_h1" value="'.get_option('text_color_film_h1').'" type="text"><br/><br/>'
		.'<label for="text_color_film_subtitle">Change text color of subtitle : </label><input id="text_color_film_subtitle" name="text_color_film_subtitle" value="'.get_option('text_color_film_subtitle').'" type="text"><br/><br/>'
		. '<input type="submit" value="Update" class="button button-primary customize load-customize hide-if-no-customize">
	</form></div>';
		//Partie Advertising
	echo "<div style='position: relative; overflow: auto; margin: 10px 20px; padding: 0px 10px 10px; border: 1px solid #e5e5e5; -webkit-box-shadow: 0 1px 1px rgba(0,0,0,.04); box-shadow: 0 1px 1px rgba(0,0,0,.04); background: #fff; font-size: 13px; line-height: 2.1em;'><h1 style='text-align:center;'>Change the interface of the Advertising Page</h1>"
	. '<form action="options.php" method="POST" class="formAccueil">';
		settings_fields('#Advertising');
		echo 
		'<label for="subTitleAdvertising">Change subtitle : </label><input id="subTitleAdvertising" name="subTitleAdvertising" value="'.get_option('subTitleAdvertising').'" type="text"><br/><br/>'
		.'<label for="background_color_advertising">Change background color : </label><input id="background_color_advertising" name="background_color_advertising" value="'.get_option('background_color_advertising').'" type="text"><br/><br/>'
		.'<label for="text_color_advert_h1">Change text color of h1 : </label><input id="text_color_advert_h1" name="text_color_advert_h1" value="'.get_option('text_color_advert_h1').'" type="text"><br/><br/>'
		.'<label for="text_color_advert_subtitle">Change text color of subtitle : </label><input id="text_color_advert_subtitle" name="text_color_advert_subtitle" value="'.get_option('text_color_advert_subtitle').'" type="text"><br/><br/>'
		. '<input type="submit" value="Update" class="button button-primary customize load-customize hide-if-no-customize">
	</form></div>';
		//Partie Press
	echo "<div style='position: relative; overflow: auto; margin: 10px 20px; padding: 0px 10px 10px; border: 1px solid #e5e5e5; -webkit-box-shadow: 0 1px 1px rgba(0,0,0,.04); box-shadow: 0 1px 1px rgba(0,0,0,.04); background: #fff; font-size: 13px; line-height: 2.1em;'><h1 style='text-align:center;'>Change the interface of the Press Page</h1>"
	. '<form action="options.php" method="POST" class="formAccueil">';
		settings_fields('#Press');
		echo 
		'<label for="subTitlePress">Change subtitle : </label><input id="subTitlePress" name="subTitlePress" value="'.get_option('subTitlePress').'" type="text"><br/><br/>'
		.'<label for="background_color_press">Change background color : </label><input id="background_color_press" name="background_color_press" value="'.get_option('background_color_press').'" type="text"><br/><br/>'
		. '<input type="submit" value="Update" class="button button-primary customize load-customize hide-if-no-customize">
	</form></div>';
	//Partie Biography
	echo "<div style='position: relative; overflow: auto; margin: 10px 20px; padding: 0px 10px 10px; border: 1px solid #e5e5e5; -webkit-box-shadow: 0 1px 1px rgba(0,0,0,.04); box-shadow: 0 1px 1px rgba(0,0,0,.04); background: #fff; font-size: 13px; line-height: 2.1em;'><h1 style='text-align:center;'>Change the interface of the Biography Page</h1>"
	. '<form action="options.php" method="POST" class="formAccueil">';
		settings_fields('#Biography');
		echo 
		'<label for="subTitleBio">Change subtitle : </label><input id="subTitleBio" name="subTitleBio" value="'.get_option('subTitleBio').'" type="text"><br/><br/>'
		.'<label for="background_color_bio">Change background image : </label>
			<input id="background_color_bio" name="background_color_bio" value="'.get_option('background_color_bio').'" type="text">
			<input id="url_bio_button" class="button" type="button" value="Choose image" /><br/><br/>'
		.'<label for="text_color_bio_h1">Change color of title : </label><input id="text_color_bio_h1" name="text_color_bio_h1" value="'.get_option('text_color_bio_h1').'" type="text"><br/><br/>'
		.'<label for="text_color_bio_subtitle">Change color of subtitle : </label><input id="text_color_bio_subtitle" name="text_color_bio_subtitle" value="'.get_option('text_color_bio_subtitle').'" type="text"><br/><br/>'
		. '<input type="submit" value="Update" class="button button-primary customize load-customize hide-if-no-customize">
	</form></div>';
		//Partie Contact
	echo "<div style='position: relative; overflow: auto; margin: 10px 20px; padding: 0px 10px 10px; border: 1px solid #e5e5e5; -webkit-box-shadow: 0 1px 1px rgba(0,0,0,.04); box-shadow: 0 1px 1px rgba(0,0,0,.04); background: #fff; font-size: 13px; line-height: 2.1em;'><h1 style='text-align:center;'>Change the interface of the Contact Page</h1>"
	. '<form action="options.php" method="POST" class="formAccueil">';
		settings_fields('#Contact');
		echo 
		'<label for="subTitleContact">Change subtitle  : </label><input id="subTitleContact" name="subTitleContact" value="'.get_option('subTitleContact').'" type="text"><br/><br/>'
		.'<label for="background_color_contact">Change background color : </label><input id="background_color_contact" name="background_color_contact" value="'.get_option('background_color_contact').'" type="text"><br/><br/>'
		. '<input type="submit" value="Update" class="button button-primary customize load-customize hide-if-no-customize">
	</form></div>';
}

function head_style(){
	echo '<style>
	#menu-main-nav li a{
		color: '. get_option('text_color_menu_main').';
	}

 	#Home{
 		background:	url(img/'.get_option('contact_img').') no-repeat center center fixed;
 		color:'. get_option('text_color').';
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		height: 100vh;
		width: 100%;
		position: relative;
 	}

 	#Work{
 		background: '.get_option('background_color_work').';
 		position: relative;
    	padding-bottom: 6%;
 	}

 	#Films{
 		background: '.get_option('background_color_film').';
 		position: relative;
 	}

 	#Advertising{
 		background: '.get_option('background_color_advertising').';
 		position: relative;
 	}

 	#Advertising h1{
 		color: '.get_option('text_color_advert_h1').';
 	}

 	#Advertising .subTitle{
 		color: '.get_option('text_color_advert_subtitle').';
 	}

 	#Press{
 		background: '.get_option('background_color_press').';
 		position: relative;
 	}

 	#Biography{
 		background: url('.get_option('background_color_bio').') no-repeat center center fixed;
 		background-size: cover;
 		position: relative;
 	}

 	#Biography h1{
 		color: '.get_option('text_color_bio_h1').';
 	}

 	#Biography .subTitle{
 		color: '.get_option('text_color_bio_subtitle').';
 	}

 	#Contact{
 		background: '.get_option('background_color_contact').';
 		position: relative;
 		color: #fff;
 	}
 	.parallax-overlay-3 {
		background-image: url(../wp-content/uploads/2016/07/overlay-pattern.png);
		z-index: -1;
	}
 	</style>';
 }

add_action('wp_head', 'head_style');

/* -----------END THEME OPTION DAT FUCK-------------- */

/*
*
*Widget
*
*/
function my_widget(){
	register_widget('link_custom');

}

add_action('widgets_init', 'my_widget');

/**
* 
*/
class link_custom extends WP_Widget
{
	
	function link_custom()
	{
		parent::__construct(false, 'link_custom');
		$options = array(
			'classname' => 'link_custom',
			'description' => 'Ceci est notre first widget'
			);
		$this->WP_Widget('link_custom', 'Lien personnalisé', $options);
	}
	function widget($args, $instance){
		echo '<a href="'.$instance['url'].'">'.$instance['name'].'</a>';
	}
	function update($new_instance, $old_instance){
		return $new_instance;
	}
	function form($instance){
		$params = array(
			'url' => '',
			'name' => ""
			);
		$instance = wp_parse_args($instance, $params);
		echo '<label for="'.$this->get_field_id('url').'">URL du lien</label><br>
		<input type ="text" id="'.$this->get_field_id('url').'" name="'.$this->get_field_name('url').'" value="'.$instance['url'].'"><br>
		<label for="'.$this->get_field_id('name').'">Titre du lien</label><br>
		<input type ="text" id="'.$this->get_field_id('name'). '" name="'.$this->get_field_name('name').'" value="'.$instance['name']. '">';
	}
}

/* -------------------- SNIPPET ------------------*/ 
/* ------------------TinyMCE ---------------------*/
function gn_tinymce_filtre($in){
	//Liste de Paragraphe + Gras / Italic / Souligne et autres
    $in['toolbar1']='formatselect,bold,italic,underline,bullist,numlist,blockquote,hr,alignleft,aligncenter,alignright,alignjustify,link,unlink,wp_more,spellchecker,wp_fullscreen,wp_adv ';
    $in['toolbar2']='pastetext,removeformat,charmap,outdent,indent,undo,redo,wp_help ';
    $in['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5';
    return $in;
}
add_filter('tiny_mce_before_init', 'gn_tinymce_filtre');
/* -------------PALETTE MAISON TinyMCE------------*/
function colors($init) {
	$couleurs = '
	"000000", "Black",
	"993300", "Burnt orange",
	"333300", "Dark olive",
	"003300", "Dark green",
	"003366", "Dark azure",
	"000080", "Navy Blue",
	"333399", "Indigo",
	"333333", "Very dark gray",
	"800000", "Maroon",
	"FF6600", "Orange",
	"808000", "Olive",
	"008000", "Green",
	"008080", "Teal",
	"0000FF", "Blue",
	"666699", "Grayish blue",
	"808080", "Gray",
	"FF0000", "Red",
	"FF9900", "Amber",
	"99CC00", "Yellow green",
	"339966", "Sea green",
	"33CCCC", "Turquoise",
	"3366FF", "Royal blue",
	"800080", "Purple",
	"999999", "Medium gray",
	"FF00FF", "Magenta",
	"FFCC00", "Gold",
	"FFFF00", "Yellow",
	"00FF00", "Lime",
	"00FFFF", "Aqua",
	"00CCFF", "Sky blue",
	"993366", "Red violet",
	"FFFFFF", "White",
	"FF99CC", "Pink",
	"FFCC99", "Peach",
	"FFFF99", "Light yellow",
	"CCFFCC", "Pale green",
	"CCFFFF", "Pale cyan",
	"99CCFF", "Light sky blue",
	"CC99FF", "Plum"
	';
	// COULEUR PERSONNALISABLE ICI
	$custom_couleurs = '
	"ff7f0f", "Orange DF",
	"323232", "Gris foncé DF",
	"f5f7f6", "Gris Clair DF"
	';
	$init['textcolor_map'] = '['.$custom_couleurs.','.$couleurs.']';
	$init['textcolor_rows'] = 6;
	return $init;
}

add_filter('tiny_mce_before_init', 'colors');


    	//add_action('init','CreemsonSlider_init');
/* Portfolio */
/*
add_action( 'init', 'create_post_type' );
function create_post_type() {
	        $labels = array(
            'name' => 'Lebee Works',
            'singular_name' => 'Work',
            'add_new' => 'Add a work',
            'add_new_item' => 'Add a new work'
        );

	register_post_type( 'acme_product',array(
		'labels' => $labels,
		'public' => true,
	 	'has_archive' => true,
	 	'supports'=> array('title','thumbnail')
		));
}
*/
