<?php 

/*
Template Name: One page
*/
	get_header(); 
	if ( is_page() && $post->post_parent > 0 ) { 
    	header( "url='".site_url()."'/404-not-found" ); 
	}
?>
<?php

	/* -----------CREATION DE SECTION POUR LES PAGES DANS LE MENU PRINCIPAL--------------*/
	$menu_items = wp_get_nav_menu_items('main-nav');
	//var_dump($menu_items);
	if( $menu_items ) {
		foreach ($menu_items as $menu_item ) {
			$title = sanitize_title($menu_item->title);
			$id = $menu_item->object_id;
			$title = $menu_item->title;
			$content = get_post($id);
			$contenu = $content->post_content;
			$contenu = apply_filters('the_content', $contenu);
?>
<?php if($title == "Home"){ ?>
	<section class='menu-item-<?= $id; ?>' id='<?= $title ?>'>
		<div class="content">
			<?php if(!empty(get_option('url_vid'))): ?>
		 		<video id="video_home" name='media' style='margin:0;width:100%;position:fixed;height:100%;max-height:100%;background: black; ' preload='auto' autoplay loop>
		 		 	<source src="<?= get_option('url_vid'); ?>">
		 		</video>
	 		<?php endif; ?>
	 		<?php if(!empty(get_option('url_ext_vid'))): 
	 			echo "
	 				<div class='cache_vimeo'></div>
					<object width='100%' height='auto'>
					<param name='allowfullscreen' value='true' />
					<param name='allowscriptaccess' value='always' />
					<param name='autoplay' value='1' />
					<param name='movie' value='".get_option('url_ext_vid')."' />
					<embed style='height:100%;position:fixed;left:0;' src='".get_option('url_ext_vid')."?autoplay=1&loop=1&title=0&byline=0&portrait=0'
					type='application/x-shockwave-flash' allowfullscreen='true' mozallowfullscreen='1' allowscriptaccess='always'  width='100%' height='auto'></embed>
				 </object>";
	 		?>
	 		<?php endif; ?>
 		</div>
	</section>
<?php }else{ ?>
	<section class="col-s-12 col-m-12 menu-item-<?= $id; ?>" id="<?= $title ?>">
		<div class="col-s-12 col-m-12 content">			
			<?php 
				if($title == "Work"){
					echo "
						<div class='parallax-title'></div>
						<h1 class='section".$title."'>".get_option('selectWork')." ".$title." ".get_option('selectWork')."</h1>
						<div class='sep'></div>
						<span class='subTitle'>".get_option('subTitleWork')."</span> 
					";
					creemsonslider_show();
					//creemsonportfolio_show();
					;
				}elseif($title == "Films") {
					echo "
						<div class='parallax-overlay parallax-overlay-3'></div>
						<div class='parallax-title'></div>
						<h1 class='section_".$title."'>".get_option('selectFilms')." ".$title." ".get_option('selectFilms')."</h1>
						<div class='sep'></div>
						<span class='subTitle'>".get_option('subTitleFilms')."</span> 
					";
				}elseif ($title == "Advertising") {
					echo "
						<div class='parallax-overlay parallax-overlay-3'></div>
						<div class='parallax-title'></div>
						<h1 class='section_".$title."'>".get_option('selectAdvertising')." ".$title." ".get_option('selectAdvertising')."</h1>
						<div class='sep'></div>
						<span class='subTitle'>".get_option('subTitleAdvertising')."</span> 
					";
				}elseif ($title == "Press") {
					echo "
						<div class='parallax-title'></div>
						<h1 class='section_".$title."'>".get_option('selectPress')." ".$title." ".get_option('selectPress')."</h1>
						<div class='sep'></div>
						<span class='subTitle'>".get_option('subTitlePress')."</span> 
					";
				}elseif ($title == "Biography") {
					echo "
						<div class='overlay_bio'></div>
						<div class='parallax-title'></div>
						<h1>".get_option('selectBio')." ".$title." ".get_option('selectBio')."</h1>
						<div class='sep'></div>
						<span class='subTitle'>".get_option('subTitleBio')."</span> 
					";
				}elseif ($title == "Contact") {
					echo "
						<div class='parallax-overlay parallax-overlay-3'></div>
						<div class='parallax-title'></div>
						<h1 class='section_".$title."'>".get_option('selectContact')." ".$title." ".get_option('selectContact')."</h1>
						<div class='sep'></div>
						<span class='subTitle'>".get_option('subTitleContact')."</span> 

					";
				}					
			 	echo $contenu; 
			 ?>
		</div>
	</section>
<?php 
	}}}; 
	/* -------------------------END CREATION DES SECTIONS-------------------------------- */
	get_footer();
?>		
	</body>
</html>