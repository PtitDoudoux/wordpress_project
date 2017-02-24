<?php 
/*
* Plugin Name: films
* Description: Plugin permettant d'ajouter des films.
* Version: 1.0
* Author: Paul, Thomas
*/

add_action('init', 'films_init');									// Initialisation de Wordpress
add_action('save_post', 'films_savepost',10, 2);					// Capture l'édition d'article avec 2 arguments
add_action('manage_edit-films_columns', 'films_columnfilter');		// Capture la liste des colonnes pour les films
add_action('manage_posts_custom_column', 'films_column');			// Permet d'afficher du contenu en plus pour chaque column

/**
* Permet d'initialiser les fonctionalités liées au carrousel
**/
function films_init(){

	$labels = array(
	  'name' => 'Films',
	  'singular_name' => 'Films',
	  'add_new' => 'Ajouter un Films',
	  'add_new_item' => 'Ajouter un nouveau Films',
	  'edit_item' => 'Editer un Films',
	  'new_item' => 'Nouveau Films',
	  'view_item' => 'Voir Films',
	  'search_items' => 'Rechercher un Films',
	  'not_found' =>  'Aucun Films',
	  'not_found_in_trash' => 'Aucun Films dans la corbeille',
	  'parent_item_colon' => '',
	  'menu_name' => 'Films'
	);

	register_post_type('films', array(
		'public' => true,
		'publicly_queryable' => false,
		'labels' => $labels,
		'capability_type'=>'post',
		'supports' => array('title', 'thumbnail'),
	));

	add_image_size('films',1000,300,true);

}

/**
* Gestion des colonnes pour les slides
* @param array $columns tableau associatif contenant les column $id => $name
**/
function films_columnfilter($columns){
	$thumb = array('thumbnail' => 'Image');
	$columns = array_slice($columns, 0, 1) + $thumb + array_slice($columns,1,null);
	return $columns;
}

/**
* Gestion du contenu d'une colonne
* @param String $column Id de la colonne traitée
**/
function films_column($column){
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
function films_savepost($post_id, $post){

	// Le champ est défini et le token est bon ?
	if(!isset($_POST['films_content']) || !wp_verify_nonce($_POST['films_nonce'], 'films')){
		return $post_id;
	}

	// L'utilisateur a le droit ?
	$type = get_post_type_object($post->post_type);
	if(!current_user_can($type->cap->edit_post)){
		return $post_id;
	}

	// On met à jour la meta !
		wp_insert_post($_POST['films_content']);
}

/**
* Permet d'afficher le carrousel
* @param int $limit
**/
function films_show($limit = 10){
	$loop = new WP_Query( array(
				'post_type' => 'films',
				'posts_per_page' => 10 )
				);
?>
<div class="container">
	<div>
	    <div>
	    	<ul id="films">
	    		<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
	    		<li><?php the_post_thumbnail('large'); ?></li>
	    		<?php endwhile; ?>
	    	</ul>
    	</div>
    </div>
</div>
<?php
}
add_shortcode('films', 'films_show');