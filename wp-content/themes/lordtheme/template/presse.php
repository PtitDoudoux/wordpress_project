<?php
/*
Template Name: Presse
*/
?>
<?php get_header(); ?>

<div id="page_<?php the_ID(); ?>" class="container">

<?php if (have_posts()) : while (have_posts()) : the_post();?>
	<h2><?php the_title();?></h2>
	<?php creemsonslider_show(); ?>
</div> 
<!--

<div class="post"> <h2 id="post-"><?php the_title();?></h2> <div class="entrytext"> <?php the_content('<p class="serif">Lire cette page &raquo;</p>'); ?> </div> </div> <?php endwhile; endif; ?> <?php edit_post_link('Modifiez cette entrée.', '<p>', '</p>'); ?> </div> <div id="main"> <?php include (TEMPLATEPATH . '/searchform.php'); ?> <h2>Archives par mois:</h2> <ul> <?php wp_get_archives('type=monthly'); ?> </ul> <h2>Archives par sujet:</h2> <ul> <?php wp_list_cats(); ?> </ul> </div>

-->

<?php echo do_shortcode ( '[creemsonSlider]' ); ?>



<?php get_footer(); ?>