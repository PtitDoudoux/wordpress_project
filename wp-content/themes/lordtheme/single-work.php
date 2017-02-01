<?php get_header(); ?>
<style type="text/css">
	#single-work{
		text-align: center;
	}
	/*.work_image img{
		width: 100%;
	}*/
</style>
<?php if (have_posts()) : while (have_posts()) : the_post();?>
	<div id="single-work" class="container" style="margin-top:50px;">
		<h2><?php the_title();?></h2>
		<div class="work_image">
			<?php the_post_thumbnail('large'); ?>
		</div>
		<div><?php the_content(); ?></div>
	</div>
</div> 
<?php
endwhile;
endif;
?>
		
	</body>
</html>