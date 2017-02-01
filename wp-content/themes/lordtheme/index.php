<?php
	header( "refresh:2;url=home" ); 
?>
<!DOCTYPE html>
<html lang="en" style="margin: 0 !important;">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>- Welcome to Lebee -</title>
		<?= wp_head(); ?>
	</head>
	<body>
		<section class="section section">
			<!-- <h1 class="loading_h1">Waiting to go on the site of Lebee ...</h1> -->
			<span class="loader loader-circles"></span>
		</section>
	</body>
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/admin.js"></script>
</html>