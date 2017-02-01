<?php
/*
* Plugin Name: cannesFilm
* Description: Plugin permettant d'ajouter des affiches de film avec eventuellement un rating.
* Version: 1.0
* Author: Thomas DUDOUX
*/

add_action('init', 'cannesFilm_init');									// Initialisation de Wordpress
add_action('save_post', 'cannesFilm_savepost',10, 2);					// Capture l'édition d'article avec 2 arguments
add_action('manage_edit-cannesFilm_columns', 'cannesFilm_columnfilter');		// Capture la liste des colonnes pour les magazine
add_action('manage_posts_custom_column', 'cannesFilm_column');			// Permet d'afficher du contenu en plus pour chaque column

/**
* Permet d'initialiser les fonctionalités liées au carrousel
**/
function cannesFilm_init(){

	$labels = array(
	  'name' => 'Affiche de Film',
	  'singular_name' => 'Film',
	  'add_new' => 'Ajouter un film',
	  'add_new_item' => 'Ajouter un nouveaux film',
	  'edit_item' => 'Editer un Film',
	  'new_item' => 'Nouveau Film',
	  'view_item' => 'Voir Film',
	  'search_items' => 'Rechercher un Film',
	  'not_found' =>  'Aucun Film',
	  'not_found_in_trash' => 'Aucun Film dans la corbeille',
	  'parent_item_colon' => '',
	  'menu_name' => 'FilmCannes'
	);

	register_post_type('cannesFilm', array(
		'public' => true,
		'publicly_queryable' => false,
		'labels' => $labels,
		'capability_type'=>'post',
		'supports' => array('title', 'thumbnail'),
	));

	add_image_size('cannesFilm',1000,300,true);

}

/**
* Gestion des colonnes pour les slides
* @param array $columns tableau associatif contenant les column $id => $name
**/
function cannesFilm_columnfilter($columns){
	$thumb = array('thumbnail' => 'Image');
	$columns = array_slice($columns, 0, 1) + $thumb + array_slice($columns,1,null);
	return $columns;
}

/**
* Gestion du contenu d'une colonne
* @param String $column Id de la colonne traitée
**/
function cannesFilm_column($column){
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
function cannesFilm_savepost($post_id, $post){

	// Le champ est défini et le token est bon ?
	if(!isset($_POST['cannesFilm_content']) || !wp_verify_nonce($_POST['cannesFilm_nonce'], 'cannesFilm')){
		return $post_id;
	}

	// L'utilisateur a le droit ?
	$type = get_post_type_object($post->post_type);
	if(!current_user_can($type->cap->edit_post)){
		return $post_id;
	}

	// On met à jour la meta !
		wp_insert_post($_POST['cannesFilm_content']);
}

/**
* Permet d'afficher le rating d'un film
**/
function cannesFilm_rate($rating, $number) {
  $args = array(
   'rating' => $rating,
   'type' => 'rating',
   'number' => $number,
  );
  wp_star_rating($args);
}

/**
* Permet d'afficher le carrousel
* @param int $limit
**/
function cannesFilm_show($limit = 10){
	$loop = new WP_Query( array(
				'post_type' => 'cannesFilm',
				'posts_per_page' => 10 )
				);
?>
<div class="container">
	<div>
	    <div>
	    	<ul id="cannesFilm">
	    		<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
	    		<li><?php the_post_thumbnail('large'); ?></li>
	    		<?php endwhile; ?>
	    	</ul>
    	</div>
    </div>
</div>
<?php
}
add_shortcode('cannesFilm', 'cannesFilm_show');
