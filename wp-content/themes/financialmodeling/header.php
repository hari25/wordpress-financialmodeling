<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	

		<header class="header" role="banner" itemscope itemtype="http://schema.org/WPHeader">
			<div class="container">
				<?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); ?>
			</div>
		</header>
</div>
	
