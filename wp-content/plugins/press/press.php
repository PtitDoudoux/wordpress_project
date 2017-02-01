<?php 
/*
* Plugin Name: press
* Description: Plugin permettant d'ajouter des photos de magazine de presse.
* Version: 1.0
* Author: Kevin Morand
* Author URI: http://www.morand.paris
*/

add_action('init', 'press_init');									// Initialisation de Wordpress
add_action('save_post', 'press_savepost',10, 2);					// Capture l'édition d'article avec 2 arguments
add_action('manage_edit-press_columns', 'press_columnfilter');		// Capture la liste des colonnes pour les magazine
add_action('manage_posts_custom_column', 'press_column');			// Permet d'afficher du contenu en plus pour chaque column

/**
* Permet d'initialiser les fonctionalités liées au carrousel
**/
function press_init(){

	$labels = array(
	  'name' => 'Magazine',
	  'singular_name' => 'Magazine',
	  'add_new' => 'Ajouter un Magazine',
	  'add_new_item' => 'Ajouter un nouveau Magazine',
	  'edit_item' => 'Editer un Magazine',
	  'new_item' => 'Nouveau Magazine',
	  'view_item' => 'Voir Magazine',
	  'search_items' => 'Rechercher un Magazine',
	  'not_found' =>  'Aucun Magazine',
	  'not_found_in_trash' => 'Aucun Magazine dans la corbeille',
	  'parent_item_colon' => '',
	  'menu_name' => 'Press'
	);

	register_post_type('press', array(
		'public' => true,
		'publicly_queryable' => false,
		'labels' => $labels,
		'capability_type'=>'post',
		'supports' => array('title', 'thumbnail'),
	));

	add_image_size('press',1000,300,true);

}

/**
* Gestion des colonnes pour les slides
* @param array $columns tableau associatif contenant les column $id => $name
**/
function press_columnfilter($columns){
	$thumb = array('thumbnail' => 'Image');
	$columns = array_slice($columns, 0, 1) + $thumb + array_slice($columns,1,null);
	return $columns;
}

/**
* Gestion du contenu d'une colonne
* @param String $column Id de la colonne traitée
**/
function press_column($column){
	global $post;
	if($column == 'thumbnail'){
		echo edit_post_link(get_the_post_thumbnail($post->ID),null,null,$post->ID);
	}
}

/**
* Gestion de la sauvegarde d'un article (pour la metabox)
* @param int $post_id Id du contenu édité
* @param object $post contenu édité
**/
function press_savepost($post_id, $post){

	// Le champ est défini et le token est bon ?
	if(!isset($_POST['press_content']) || !wp_verify_nonce($_POST['press_nonce'], 'press')){
		return $post_id;
	}

	// L'utilisateur a le droit ?
	$type = get_post_type_object($post->post_type);
	if(!current_user_can($type->cap->edit_post)){
		return $post_id;
	}

	// On met à jour la meta !
		wp_insert_post($_POST['press_content']);
}

/**
* Permet d'afficher le carrousel
* @param int $limit
**/
function press_show($limit = 10){
	$loop = new WP_Query( array(
				'post_type' => 'press',
				'posts_per_page' => 10 )
				);
?>
<div class="container">
	<div>
	    <div>
	    	<ul id="press">
	    		<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
	    		<li><?php the_post_thumbnail('large'); ?></li>
	    		<?php endwhile; ?>
	    	</ul>
    	</div>
    </div>
</div>
<?php
}
add_shortcode('press', 'press_show');