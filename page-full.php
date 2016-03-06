<?php
/**
 * The template page for the fullPage layout.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ckpersonal
 */

get_header('small'); ?>

	<div id="primary" class="content-area">
		<main id="main" class="full-main" role="main">

			<div id="fullpage">
			    <section class="section" data-anchor="top-data">
			    	<h2>Lorem ipsum dolor sit amet, prima posidonium pro ei. Quis ferri ut his, sit possit offendit.</h2>
			    	<p>Lorem ipsum dolor sit amet, prima posidonium pro ei. Quis ferri ut his, sit possit offendit epicurei an, vocibus philosophia nam ne. Quod euismod repudiandae eu qui. Te summo eirmod qui, ad cum magna graeci cotidieque, porro melius qui id. Ad libris aliquip commune eos, ei vix liber nihil accusam, nostro nusquam pro ea. Eius legere eligendi at his, in ponderum facilisis sit, et tantas labore nec. At ludus corrumpit sit, id eum magna tractatos.</p>
			    </section>
			    	
			    	<!-- #profile -->	
				<section id="profile" class="section" data-anchor="profile-data">
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
					</div><!-- .container -->
				</section>
				<!-- END #profile -->

			    <section class="section" data-anchor="slides-data">
				    <div class="slide"> Slide 1 </div>
				    <div class="slide">
				    	<p>Lorem ipsum dolor sit amet, prima posidonium pro ei. Quis ferri ut his, sit possit offendit epicurei an, vocibuTe summo eirmod qui, ad cum magna graeci cotidieque, porro melius qui gere eligendi at his, in ponderum facilisis sit, et tantas labore nec. At ludus corrumpit sit, id eum magna tractatos.</p>	
				    	<p>Lorem ipsum dolor sit amet, prima posidonium pro ei. Quis ferri ut his, sit possit offendit epicurei an, vocibus philosophia nam ne. Quod euismod repudiandae eu qui. Te summo eirmod qui, ad cum magna graeci cotidieque, porro melius qui id. Ad l Eius legere eligendi at his, in ponderum facilisis sit, et tantas labore nec. At ludus corrumpit sit, id eum magna tractatos.</p>    	
				    </div>
				    <div class="slide"> Slide 3 </div>
				    <div class="slide"> Slide 4 </div>
				</section>

				<section class="section" data-anchor="lorum-data">
					<h2>Lorem ipsum dolor sit amet, prima posidonium pro ei. Quis ferri ut his, sit possit offendit epicurei an, vocibus philosophia </h2>
					<p>Lorem ipsum dolor sit amet, prima posidonium pro ei. Quis ferri ut his, sit possit offendit epicurei an, vocibus philosophia nam ne. Quod euismod repudiandae eu qui. Te summo eirmod qui, ad cum magna graeci cotidieque, porro melius qui id. Ad libris aliquip commune eos, ei vix.</p>

				</section>

			<!-- #contact -->			
				<section id="contact" class="section" data-anchor="contact-data">
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
			<!-- END #contact -->
			</div><!-- #fullpage -->

		</main><!-- #main -->
	</div><!-- #primary -->

	<nav id="site-navigation" class="main-navigation" role="navigation">		

		<?php    
		if (is_front_page()){
			wp_nav_menu( array( 'menu' => 'Front Page Menu' ) );
		} else {
			wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'fullPage', 'menu_class' => 'nav-menu', ) );
		}
		?>

		<?php  ?> 
	</nav><!-- #site-navigation -->


<script>
	$('#fullpage').fullpage({
	    
	    //Navigation
        menu: '#fullPage',
        lockAnchors: false,
        //anchors:['firstPage', 'secondPage', 'thirdPage', 'fourthPage'],
        navigation: true,
        navigationPosition: 'left',
        navigationTooltips: ['top-data', 'profile-data', 'slides-data', 'contact-data'],
        showActiveTooltip: true,
        slidesNavigation: true,
        slidesNavPosition: 'bottom',

        //Accessibility
        keyboardScrolling: true,
        animateAnchor: true,
        recordHistory: true,

        //Design
        sectionsColor: ['green', '#313131', 'goldenrod', 'whitesmoke', 'purple'],
        controlArrows: true,
        verticalCentered: true,
        resize : true,
        paddingTop: '3em',
        paddingBottom: '10px',
        fixedElements: '#header, .footer',
        responsiveWidth: 0,
        responsiveHeight: 0,

        //Custom selectors
        sectionSelector: '.section',
        slideSelector: '.slide',

        //events
        onLeave: function(index, nextIndex, direction){},
        afterLoad: function(anchorLink, index){},
        afterRender: function(){},
        afterResize: function(){},
        afterSlideLoad: function(anchorLink, index, slideAnchor, slideIndex){},
        onSlideLeave: function(anchorLink, index, slideIndex, direction, nextSlideIndex){}
	});
</script>

<?php
get_footer();
