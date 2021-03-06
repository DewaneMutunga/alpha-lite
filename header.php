<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package alpha_lite
 */
 
 /**
 * the template for the document <head>
 */
$title = get_bloginfo('name');

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="header-area" class="full">
		<div class="main">
			<header id="masthead" class="site-header inner" role="banner">
				<div class="site-branding">
					<span class="site-title">
						<?php if ( get_theme_mod( 'alpha_lite_logo' ) ) : ?>
						    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
						        <img src="<?php echo get_theme_mod( 'alpha_lite_logo' ); ?>" alt="<?php echo esc_attr( $title ); ?>">
						    </a>
						<?php else : ?>
						    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( $title ); ?>">
						        <?php echo $title; ?>
						    </a>
						<?php endif; ?>
					</span>
					<h1 class="site-description"><?php bloginfo( 'description' ); ?></h1>
					<nav id="header-navigation" class="header-menu" role="navigation">
						<?php wp_nav_menu( array( 'theme_location' => 'header', 'fallback_cb' => 'alpha_lite_nav_fallback' ) ); ?>
					</nav>
				</div>
			</header><!-- #masthead -->
		</div>
	</div>

	<div id="content-area" class="full">
		<div class="main">	
			<div id="content" class="site-content">
