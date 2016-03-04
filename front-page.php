<?php
/**
 * The custom template for the one-page style front page. Kicks in automatically.
 */
get_header(); ?>

<?php
global $more;		// Should WP display the conent after ---more--- ? (0=false; 1=true)
?>

<div id="primary" class="content-area lander-page">
	<main id="main" class="site-main lander-main" role="main">

<!-- Jumbotron -->

<!-- Profile -->
		<section id="profile" class="lander-section">
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
		<section id="competencies" class="lander-section">
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
		<section id="works" class="lander-section">
			<div class="container">
				<?php 
				$query = new WP_Query( 'pagename=works' );
				$works_id = $query->queried_object->ID;				

				// The Loop
				if ( $query->have_posts() ) {
					while ( $query->have_posts() ) {
						$query->the_post();
						echo '<h2 class="section-title">' . get_the_title() . '</h2>';
						echo '<div class="entry-content">';
						the_content('');
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
					
					echo '<div class="pointless-wrap">';
					while ( $works_query->have_posts() ) {
						$works_query->the_post();

						echo '<div class="project row">';
						echo '<figure class="work-thumb col-xs-12 col-sm-6">';
						echo '<a href="' . get_permalink() . '" title="Learn more about ' . get_the_title() . '">';
						
						the_post_thumbnail( 'lander-thumb-sm','style=width:100%;max-width:100%;height:auto;');
						
						echo '</a>';
						echo '</figure>';
						echo '<aside class="work-content col-xs-12 col-sm-6">';
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

			</div><!-- .indent -->
		</section>
<!-- END Works -->

<!-- Contact -->
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
			</div><!-- .indent -->
		</section>
<!-- END Contact -->

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