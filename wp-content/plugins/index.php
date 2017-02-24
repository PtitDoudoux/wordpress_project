<?php
// Silence is golden.

$loop = new WP_Query( array(
				'post_type' => 'press',
				'posts_per_page' => 10 )
				);

?>
<div class="container">
<div id="creemsonPortfolio"  style="margin-top: 100px;">
<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
	<?php $creemsonPost = get_post(); 
	?>

    <div class="col-md-4 col-sm-6 col-xs-12 col-lg-3 creemsonPost">
	    <?php the_post_thumbnail('large'); ?>
	    <div class="hover_box">
	    	<div class="inner_hover">
		        <a href="<?= get_permalink();$creemsonPost->post_name; ?>">
		    		<?= $creemsonPost->post_title; ?>
		    	</a>
		    	<br>
		    	<a href="">
		    		<?= the_category(); ?>
		    	</a>
	    	</div>
	    </div>
    </div>

<?php //endif;
endwhile; ?>

</div>
</div>