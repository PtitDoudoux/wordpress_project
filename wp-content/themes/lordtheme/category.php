
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
/*
#page_78{
	margin-top: 100px;
}
*/
#creemsonPortfolio{
	margin-top: 100px;
}
.creemsonPost{
	margin: 15px 0;
	padding: 0;
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

<?php 


 $the_link = $_SERVER['REQUEST_URI'];
 $the_link = str_replace('/lebee/category','',$the_link);
 $the_category = str_replace('/','',$the_link);
 //var_dump($the_link);
 	$loop = new WP_Query( array(
				'post_type' => 'work',
				'category_name' => $the_category,
				'posts_per_page' => 10 )
				);
?>

<?php get_header(); ?>
<div class="container" style="height:100%;">
<div id="creemsonPortfolio">
<?php //var_dump($loop); ?>
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
		    	<!-- <br>
		    	<a href="">
		    		<?= $creemsonPost->post_name; ?>
		    	</a>	-->
	    	</div>
	    </div>
    </div>

<?php endwhile; ?>

</div>
</div>

<?php get_footer(); ?>
