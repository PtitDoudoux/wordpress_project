<?php 
/*
Template Name: Other Page
*/
	get_header(); 
?>
<style>
	.vc_row{
		margin: 0 !important;
	}
</style>
	<section class="col-s-12 col-m-12 menu-item">
		<div class="col-s-12 col-m-12 content">			
		<?php		
		 	$id = get_the_ID();
			$content = get_post($id);
			$contenu = $content->post_content;
			$contenu = apply_filters('the_content', $contenu);

			echo '<h1>';
			echo the_title();
			echo '</h1>';

			echo $contenu; 
		?>
		</div>
	</section>
<?php
	get_footer();
?>		
	</body>
</html>