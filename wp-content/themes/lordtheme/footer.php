<footer>
	<?php 
	if(is_front_page()){
		echo "
			<a href='#Home' class='toTop'><i class='fa fa-angle-up' aria-hidden='true' style='color: #ccaa79;margin-left: 25%;margin-right: 25%;'></i></a>";
	}
	?>
	<div class="footer-widget-lebee"> 
		<ul class="widget-lebee"> 
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-HELP')) ?>
		</ul> 
	</div> 
	<div class="footer-widget-lebee"> 
		<ul class="widget-lebee"> 
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-ABOUT')) ?>
		</ul> 
	</div> 
	<div class="footer-widget-lebee"> 
		<ul class="widget-lebee"> 
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-NETWORKS')) ?> 
		</ul> 
	</div>
	<div style="clear:both;float:none;"></div>
	<p class="copyright">
		<a href="<?= site_url(); ?>/home">www.jeanphilippelebee.com</a> - Copyright © <?= date('Y'); ?>
	</p> 
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/admin.js"></script>
</footer>
	<?php wp_footer(); ?>
</body>
</html>