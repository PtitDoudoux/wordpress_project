<?php


function include_styles_scripts(){
	wp_enqueue_style('style-name', get_stylesheet_uri());
}

add_action('wp_enqueue_scripts', 'include_styles_scripts');


function menus()
{
	register_nav_menus(array(
		'main_menu' => 'Menu Principal',
		'secondary_menu' => 'Menu Secondaire'
	));
	/*register_nav_menu('main menu', 'Menu Principal');
	register_nav_menu('secondary_menu', 'Menu Secondaire');*/
}
add_action('init', 'menus');

/*
*Zone de widget
*/

function sidebars(){
	register_sidebar(array(
		'name' => __('Main_Sidebar', 'lordtheme'),
		'id' => 'sidebar-1',
		'description' => __('Widgets in this area will be shown ')
		));

	register_sidebar(array( 
		'name'=>'footer-ABOUT', 
		'before_widget' => '<li>', 
		'after_widget' => '</li>', 
		'before_title' => '<h2>', 
		'after_title' => '</h2>', 
	)); 

	register_sidebar(array( 
		'name'=>'footer-NETWORKS', 
		'before_widget' => '<li>', 
		'after_widget' => '</li>', 
		'before_title' => '<h2>', 
		'after_title' => '</h2>', 
	));

	register_sidebar(array( 
		'name'=>'footer-HELP', 
		'before_widget' => '<li>', 
		'after_widget' => '</li>', 
		'before_title' => '<h2>', 
		'after_title' => '</h2>', 
	));
}

add_action('widgets_init', 'sidebars');

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

function menu_page(){
	add_menu_page('Options supplementaires', 'Test', 'administrator', 'manage_options', 'options_page');
}
add_action('admin_menu', 'menu_page');

function theme_options(){
	register_setting('lordtheme', 'background');
	register_setting('lordtheme', 'text_color');
}

add_action('admin_init', 'theme_options');

function options_page(){
	echo '<h1>Ma page option</h1>'
	. '<form action="options.php" method="POST">';
		settings_fields('lordtheme');
		echo '<label for="background">Background</label><input id="background" name="background" value="'.get_option('background').'" type="text">'
		. '<label for="text_color">Couleur du texte</label><input id="text_color" name="text_color" value="'.get_option('text_color').'" type="text">'
		. '<input type="submit" value="Mettre à jour">
	</form>';
}

 function head_style(){
	echo '<style>
 	body {
 		background-color:'. get_option('background').';
 		color:'. get_option('text_color').';
 	}
 	</style>';
 }

add_action('wp_head', 'head_style');

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