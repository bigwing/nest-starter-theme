<!DOCTYPE html>
<!--[if lte IE 7]><html <?php language_attributes(); ?> class="no-js ie7"><![endif]-->
<!--[if IE 8]><html <?php language_attributes(); ?> class="no-js ie8"><![endif]-->
<!--[if IE 9]><html <?php language_attributes(); ?> class="no-js ie9"><![endif]-->
<!--[if !IE]><!--><html <?php language_attributes(); ?> class="no-js non-ie"><!--<![endif]-->
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<?php /* Use WordPress SEO to change titles: https://wordpress.org/plugins/wordpress-seo/ */?>
	<link href="//www.google-analytics.com" rel="dns-prefetch">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<?php
		/* Use WordPress SEO to add meta descriptions: https://wordpress.org/plugins/wordpress-seo/
		*/?>
		<script>
			var nest_ajax_url = "<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>";
		</script>
		<?php wp_head(); ?>
		<?php
		global $is_IE;
		if ( $is_IE ) {
			?>
			<!--[if lt IE 9]>
			<link rel='stylesheet' id='ie'  href='<?php echo esc_url( get_stylesheet_directory_uri() . '/css/ie.css' ); ?>' media='all' />
			<script type='text/javascript' src='<?php echo esc_url( get_stylesheet_directory_uri() . '/js/html5.js' ); ?>'></script>
			<script type='text/javascript' src='<?php echo esc_url( get_stylesheet_directory_uri() . '/js/respond.js' ); ?>'></script>
			<![endif]-->
			<?php
		}
		?>
	</head>
	<body <?php body_class(); ?> id="body-wrapper">
		<?php do_action( 'body_open' ); ?>
		<header class="header clear" role="banner">
			<div class="content-wrapper">
				<?php nest_get_social(); ?>
				<a id="logo-wrapper" href="<?php echo esc_url( home_url() ); ?>"><?php echo nest_get_logo_srcset(); ?></a>
				<?php wp_nav_menu( array('theme_location' => 'header-top-nav' )); ?><!--top-nav-->
				<div id="mobile-nav"></div>
				<nav class="nav clear" role="navigation">
					<?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); ?>
				</nav><!--nav-->
			</div><!--content-wrapper-->
		</header><!--header-->