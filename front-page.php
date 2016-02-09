<?php
/**
 * The custom template for the one-page style front page. Kicks in automatically.
 */
get_header(); ?>

<?php
global $more;		// Should WP display the conent after ---more--- ? (0=false; 1=true)
?>

<div id="primary" class="content-area lander-page">
	<main id="main" class="site-main" role="main">

<!-- Jumbotron -->
		<section id="jumbotron">
			<div class="indent clear">
				<?php 
				$query = new WP_Query( 'pagename=jumbotron' );
				// The Loop
				if ( $query->have_posts() ) {
					while ( $query->have_posts() ) {
						$query->the_post();
						echo '<div class="entry-content">';
						the_content();
						echo '</div>';
					}
				}					
				/* Restore original Post Data */
				wp_reset_postdata();
				?>
			</div>
		</section><!-- #jumbotron -->
<!-- END Jumbotron -->

<!-- Profile -->
		<section id="profile">
			<div class="indent clear">
				<?php 
				$query = new WP_Query( 'pagename=profile' );
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
		</section><!-- #profile -->
<!-- END Profile -->

<!-- Competencies -->
		<section id="competencies">
			<div class="indent clear">
				<?php 
				$query = new WP_Query( 'pagename=competencies' );
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
		</section><!-- #competencies -->
<!-- END Competencies -->

<!-- Works -->
		<section id="works">
			<div class="indent">
				
				<?php 
				$args = array(
					'posts_per_page' => 3,
					'orderby' => 'rand',
					'category_name' => 'works'
				);
				$query = new WP_query( $args );
				// The Loop
				if ( $query->have_posts() ) {
					echo '<ul class="works">';
					while ( $query->have_posts() ) {
						$query->the_post();
						$more = 0;		// Sets value of $more to false
						echo '<li class="clear">';
						echo '<figure class="work-thumb">';
						the_post_thumbnail('work-mug');
						echo '</figure>';
						echo '<aside class="work-text">';
						echo '<h3 class="work-name">' . get_the_title() . '</h3>';
						echo '<div class="work-excerpt">';
						the_excerpt('');
						echo '</div>';
						echo '</aside>';
						echo '</li>';
					}
					echo '</ul>';
				}
				/* Restore original Post Data */
				wp_reset_postdata();
				?>

			</div><!-- .indent -->
		</section><!-- #works -->
<!-- END Works -->

<!-- Contact -->
		<section id="contact">
			<div class="indent clear">			
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
		</section><!-- #contact -->
<!-- END Contact -->
		

	</main><!-- #main -->
</div><!-- #primary -->


<?php get_footer(); ?>