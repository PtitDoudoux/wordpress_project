
<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

?>
<style type="text/css">
	html, body, footer{
	display: block;
	float: left;
	width: 100%;
}
header{
	margin: unset;
}
.creemsonPost{
	margin: 15px 0;
	/*padding: 0;*/
}
.creemsonPost img{
	width: 100%;
}
.creemsonPost .hover_box {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255,255,255,0.8);
    text-align: center;
    transition: all 0.2s ease-in-out;
    -moz-transition: all 0.2s ease-in-out;
    -webkit-transition: all 0.2s ease-in-out;
    -o-transition: all 0.2s ease-in-out;
    opacity: 0;
    overflow: hidden;
}
.creemsonPost .inner_hover{
	position: absolute;
    width: 100%;
    top: 50%;
    margin-top: -30px;
}

.creemsonPost .hover_box:hover{
	opacity: 1;
}
.creemsonPost .hover_box a{
	text-decoration: none;
}
.creemsonPost .hover_box a:hover{
	color: black;
}
</style>
<?php $loop = new WP_Query( array(
				'post_type' => 'work',
				//'category_name' => 'creemson',
				'posts_per_page' => 10 )
				);

?>
<div class="container">
<div id="creemsonPortfolio"  style="margin-top: 100px;">
<?php //var_dump($loop); ?>
<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
	<?php $creemsonPost = get_post(); 
	//var_dump($creemsonPost);
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