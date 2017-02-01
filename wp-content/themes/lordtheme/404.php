<?php
/**
 * 
 *
 * @package WordPress
 * @subpackage Lordtheme
 * @since Lordtheme 1.0
Template Name: 404, not found
 */

get_header(); ?>

<section class='col-s-12 col-m-12 menu-item-404'>
	<div class="col-s-12 col-m-12 content">
		<h1><?php _e( 'Error 404, not found !', 'lordtheme' ); ?></h1>
		<div class='sep'></div>
		<span class='subTitle'><?php _e( 'Oops! That page can&rsquo;t be found.', 'lordtheme' ); ?></span>
		<?php		
			$content = get_post('329');
			$contenu = $content->post_content;
			$contenu = apply_filters('the_content', $contenu);

			echo $contenu; 
		?> 
	</div>
</section>

<?php get_footer(); ?>
