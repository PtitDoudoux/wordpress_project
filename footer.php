<footer>
	<div class="footer-widget-lebee"> 
		<ul class="widget-lebee"> 
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-HELP') )?> 
		</ul> 
	</div> 
	<div class="footer-widget-lebee"> 
		<ul class="widget-lebee"> 
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-ABOUT') )?>
		</ul> 
	</div> 
	<div class="footer-widget-lebee"> 
		<ul class="widget-lebee"> 
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-NETWORKS') )?> 
		</ul> 
	</div> 
	<div style="clear:both;float:none;"></div>
	<p> Copyright &#169; 
		<?php print(date(Y)); ?> 
		<?php bloginfo('name'); ?> 
		<br /> 
		Blog propulser par <a href="http://wordpress.org/">WordPress</a> et con&ccedil;u par 
		<a href="http://img.over-blog-kiwi.com/1/62/73/19/20160212/ob_3989ee_2272077-908-billet-500-euros.jpg" target="_blank">Le Billet Violet</a>
	</p> 
</footer>
	<?php wp_footer(); ?>
</body>
</html>