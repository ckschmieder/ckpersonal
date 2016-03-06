<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ckpersonal
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'ckpersonal' ); ?></a>
	

		<header id="masthead" class="header-small" role="banner">
		
			<?php // Display site icon or first letter as logo ?>	
			<div class="site-logo">
				<?php $site_title = get_bloginfo( 'name' ); ?> <!-- get site title -->
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"> <!-- setup link that points to homepage -->
					<div class="screen-reader-text">
						<?php printf( esc_html__('Go to the home page of %1$s', 'ckpersonal'), $site_title ); ?>	
					</div>
					<?php
					if ( has_site_icon() ) {
						$site_icon = esc_url( get_site_icon_url( 270 ) ); ?>
						<img class="site-icon" src="<?php echo $site_icon; ?>" alt="">
					<?php } else { ?>
						<div class="site-firstletter" aria-hidden="true"> <!-- so text-to-speech won't read this -->
							<?php echo substr($site_title, 0, 1); ?> <!-- get site title, grab and display the first letter -->
						</div>
					<?php } ?>
				</a>
			</div>
			
		</header><!-- #masthead -->

		<div id="content" class="site-content">
