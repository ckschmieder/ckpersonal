<?php
/**
 * The custom template for the one-page style front page. Kicks in automatically.
 */
get_header('home'); ?>

<?php
global $more;		// Should WP display the conent after ---more--- ? (0=false; 1=true)
?>

<div id="primary" class="content-area lander-page">
	<main id="main" class="site-main lander-main" role="main">

		<div id="fullpage">


			<?php if ( get_header_image() ) { ?>
				<header id="masthead" class="site-header dimmed section" style="background-image: url(<?php header_image(); ?>)" role="banner">
			<?php } else { ?>
				<header id="masthead" class="site-header section" role="banner">
			<?php } ?>	
				
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


					<div class="site-branding<?php if ( !is_front_page() || is_page() ) { echo ' screen-reader-text'; } ?>">
						<?php
						if ( is_front_page() && is_home() ) : ?>
							<h1 class="site-title animated fadeIn"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php else : ?>
							<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php
						endif;

						$description = get_bloginfo( 'description', 'display' );
						if ( $description || is_customize_preview() ) : ?>
							<p class="site-description animated lightSpeedIn"><?php echo $description; /* WPCS: xss ok. */ ?></p>
						<?php
						endif; ?>
					</div><!-- .site-branding -->

					
				</header><!-- #masthead -->
		<!-- Jumbotron -->

		<!-- Profile -->
			
			
				<section id="profile" class="lander-section section">
					<div class="container">
						<?php 
						$query = new WP_Query( 'pagename=profile' );
						// The Loop
						if ( $query->have_posts() ) {
							while ( $query->have_posts() ) {
								$query->the_post();
								echo '<h2 class="section-title">' . get_the_title() . '</h2>';
								echo '<div class="entry-content">';
								echo '<figure class="profile-thumb">';
								the_post_thumbnail('medium','style=max-width:220px;');
								echo '</figure>';
								
								the_content();
								echo '</div>';
							}
						}
						/* Restore original Post Data */
						wp_reset_postdata();
						?>
					</div><!-- .indent -->
				</section>
		<!-- END Profile -->

		<!-- Competencies -->

				<section id="competencies" class="lander-section section">
					<div class="container">
						<?php 
						$query = new WP_Query( 'pagename=competencies' );
						// The Loop
						if ( $query->have_posts() ) {
							while ( $query->have_posts() ) {
								$query->the_post();
								/*echo '<h2 class="section-title">' . get_the_title() . '</h2>';*/
								echo '<div class="entry-content">';
								the_content();
								echo '</div>';
							}
						}
						/* Restore original Post Data */
						wp_reset_postdata();
						?>
					</div><!-- .indent -->
				</section>
		<!-- END Competencies -->

		<!-- Works -->
			<div class="section">
				<section id="works" class="lander-section">
					<div class="container-fluid">
						<?php 
						$query = new WP_Query( 'pagename=works' );
						$works_id = $query->queried_object->ID;				

						// The Loop
						if ( $query->have_posts() ) {
							while ( $query->have_posts() ) {
								$query->the_post();
								echo '<div class="slider-header">';
								echo '<h2 class="section-title slider-title">' . get_the_title() . '</h2>';
								echo '<div class="entry-content">';
								the_content('');
								echo '</div>';
								echo '</div>';
							}
						}

						/* Restore original Post Data */
						wp_reset_postdata();

						$args = array(
							'post_type' => 'page',
							'post_parent' => $works_id
						);
						$works_query = new WP_Query( $args );
						
						// The Loop
						if ( $works_query->have_posts() ) {
							
							echo '<div class="container">';
							while ( $works_query->have_posts() ) {
								$works_query->the_post();

								echo '<div class="slide">';
								echo '<div class="project row">';
								echo '<figure class="work-thumb col-xs-12 col-md-6">';
								echo '<a href="' . get_permalink() . '" title="Learn more about ' . get_the_title() . '">';
								
								the_post_thumbnail( 'lander-thumb-sm','style=width:100%;max-width:100%;height:auto;');
								
								echo '</a>';
								echo '</figure>';
								echo '<aside class="work-content col-xs-12 col-md-6">';
								echo '<h2 class="works-title">';
								the_title();
								echo '</h2>';
								echo '<p>';
								the_content();
								echo '</p>';
								echo '</aside>';
								
								echo '</div>';

							}
							echo '</div>';					
						}

						/* Restore original Post Data */
						wp_reset_postdata();
						?>				

					</div><!-- .container -->
				</section>
			</div>
		<!-- END Works -->

		<!-- Contact -->
			<div class="section">
				<section id="contact" class="lander-section">
					<div class="container">			
						<?php 
						$query = new WP_Query( 'pagename=contact' );
						// The Loop
						if ( $query->have_posts() ) {
							while ( $query->have_posts() ) {
								$query->the_post();
								echo '<h2 class="section-title">' . get_the_title() . '</h2>';
								echo '<div class="entry-content">';
								the_content();
								echo '</div>';
							}
						}
						/* Restore original Post Data */
						wp_reset_postdata();
						?>
					</div>
				</section>
			</div>
		<!-- END Contact -->

		</div><!-- #fullpage -->
	</main><!-- #main -->
</div><!-- #primary -->


<nav id="site-navigation" class="main-navigation" role="navigation">
	

	<?php    
	if (is_front_page()){
		wp_nav_menu( array( 'menu' => 'Front Page Menu', 'menu_class' => 'home-menu animate slideInRight', ) );
	} else {
		wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'menu_class' => 'nav-menu', ) );
	}
	?>

	<?php  ?> 

</nav><!-- #site-navigation -->

<?php get_footer(); ?>