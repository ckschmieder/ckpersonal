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
		<section id="jumbotron" class="lander-section">
			<div class="fullheight">

				

					<script type="text/javascript">
						$(function(){
							var weekdays = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
				            var dayOfWeekIndex = (new Date()).getDay();
				            var dayOfWeek = weekdays[dayOfWeekIndex];
				            var dayOfWeekPastIndex = Math.floor(weekdays.length * Math.random());
				            var dayOfWeekPast;
				            var hourOfDay = new Date().getHours();
				            /*var yourCity = $clientInfo['city'];*/
				            var timeOfDay;
				            // choose day of week other than current one
				            if (dayOfWeekPastIndex == dayOfWeekIndex) {
				              dayOfWeekPast = weekdays[(dayOfWeekPastIndex + 1) % weekdays.length];
				            } else {
				              dayOfWeekPast = weekdays[dayOfWeekPastIndex];
				            }
				            // assign time of day to the hour
				            if ((hourOfDay >= 4) && (hourOfDay <= 11)) {
				              timeOfDay = "morning";
				            } else if ((hourOfDay >= 12) && (hourOfDay <= 16)) {
				              timeOfDay = "afternoon";
				            } else { 
				              timeOfDay = "evening";
				            }


				            // make conversation
				            $('#story').typed({
				                strings: ["Oh hey...^1500 \nYou're a bit early. ^1000 \n<br>The site isn't quite finished,^200 but since you're here you might as well scroll down and check out what I've done so far. ^2000 \n<br>I know it may not look like much right now,^200 but this place is going to be pretty <em>sweet</em> when I'm finished!"],
				                typeSpeed: 20,
				                backDelay: 1500,
				                loop: false,
				                loopCount: false,
				            });
				            
				        });
					</script>
			<div class="container cartoon">
				<div class="row">
					
					<div class="col-md-8 col-xs-12 <?php if (!( get_header_image() )) {echo 'col-md-offset-2';} ?>">
						<span id="story" style="white-space:pre-line"></span>
					</div>

					<?php if ( has_header_image() ) { ?>
						<div class="col-md-4 col-xs-12 header-img"><img id="cartoon-me" src="<?php echo( get_header_image() ); ?>"/></div>
					<?php } ?>

				</div>
					<!-- <div class="row">
						<div class="col-md-12">
							<h4>placeholder text in a 12 col wide h4 element</h4>
						</div>

					</div> -->
					
<?php
function getClientIPInfo($ip = null) {
	if (!$ip) {
		$ip = get_ip();

	}
    $json_data = file_get_contents('http://ipinfo.io/'.$ip.'/json');
    $data = json_decode($json_data, true);
    return $data;
}
$clientInfo = getClientIPInfo();
//echo $clientInfo ['region'];
echo $clientInfo['city'];
var_dump($clientInfo);
?>


<?php

function get_ip(){
$externalContent = @file_get_contents( 'http://checkip.dyndns.com/', 0, $timeout_setting );
preg_match( '/\b(?:\d{1,3}\.){3}\d{1,3}\b/', $externalContent, $m );
if ($externalContent) {return $m[0];}
return '';
}?>




			</div>

		      <!-- <div class="wrap">
			      <div class="type-wrap">

			      	<span id="typed" style="white-space:pre;"></span>
			      </div>		        
		      </div> -->
		    </div>
		</section>
<!-- END Jumbotron -->

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
						the_post_thumbnail('medium','style=max-width:240px;');
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
			<div class="indent clear">
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
						echo '<figure class="work-thumb col-xs-12 col-sm-4">';
						echo '<a href="' . get_permalink() . '" title="Learn more about ' . get_the_title() . '">';
						
						the_post_thumbnail( 'lander-thumb-sm','style=width:100%;max-width:100%;height:auto;');
						
						echo '</a>';
						echo '</figure>';
						echo '<aside class="work-content col-xs-12 col-sm-8">';
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

<!-- Works -->
		<section id="works2" class="lander-section">
			<div class="container">
				<?php 
				$query = new WP_Query( 'pagename=works' );
				$works_id = $query->queried_object->ID;				

				// The Loop
				if ( $query->have_posts() ) {
					while ( $query->have_posts() ) {
						$query->the_post();
						echo '<h2 class="section-title">' . get_the_title() . '</h2>';
						echo '</div>';
						echo '<div class="container-fluid">';
						
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
					
					echo '<div class="row">';
					while ( $works_query->have_posts() ) {
						$works_query->the_post();

						echo '<div class="my-project col-sm-6">';
						echo '<a href="' . get_permalink() . '" title="Learn more about ' . get_the_title() . '">';
						echo '<figure class="work-img">';
						the_post_thumbnail( 'lander-thumb-lg','style=width:100%;max-width:100%;height:auto;');
						echo '</figure>';
						//echo '<aside class="card-content">';
						//echo '<h2 class="works-title">';
						//the_title();
						//echo '</h2>';
						//echo '<p>';
						//the_content();
						//echo '</p>';
						//echo '</aside>';
						echo '</a>';
						echo '</div>';

					}
					echo '</div>';					
				}
				
				/* Restore original Post Data */
				wp_reset_postdata();
				?>
				<div class="section-footer">
					<h4>Check out all my projects on <a href="http://github.com/ckschmieder">Github</a><h4>					
				</div>
			</div><!-- .indent -->
		</section>
<!-- END Works -->

<!-- Contact -->
		<section id="contact" class="lander-section">
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
		</section>
<!-- END Contact -->

<!-- Test -->
		<section id="test" class="lander-section">
			<div class="container-fluid">
				<div class="hover-tile-outer">
				  <div class="hover-tile-container">
				    <div class="hover-tile hover-tile-visible"></div>
				    <div class="hover-tile hover-tile-hidden">
				      <h4>Island Embroidery</h4>
				      <p>Lorem ipsum dolor provident eligendi fugiat ad exercitationem sit amet, consectetur adipisicing elit. Unde, provident eligendi.</p>
				    </div>
				  </div>
				</div>
				<div class="hover-tile-outer">
				  <div class="hover-tile-container">
				    <div class="hover-tile hover-tile-visible"></div>
				    <div class="hover-tile hover-tile-hidden">
				      <h4>Island Embroidery</h4>
				      <p>Lorem ipsum dolor provident eligendi fugiat ad exercitationem sit amet, consectetur adipisicing elit. Unde, provident eligendi.</p>
				    </div>
				  </div>
				</div>
				<div class="hover-tile-outer">
				  <div class="hover-tile-container">
				    <div class="hover-tile hover-tile-visible"></div>
				    <div class="hover-tile hover-tile-hidden">
				      <h4>Island Embroidery</h4>
				      <p>Lorem ipsum dolor provident eligendi fugiat ad exercitationem sit amet, consectetur adipisicing elit. Unde, provident eligendi.</p>
				    </div>
				  </div>
				</div>
				<div class="hover-tile-outer">
				  <div class="hover-tile-container">
				    <div class="hover-tile hover-tile-visible"></div>
				    <div class="hover-tile hover-tile-hidden">
				      <h4>Island Embroidery</h4>
				      <p>Lorem ipsum dolor provident eligendi fugiat ad exercitationem sit amet, consectetur adipisicing elit. Unde, provident eligendi.</p>
				    </div>
				  </div>
				</div>
			</div>
		</section>
<!-- END Test -->
		

	</main><!-- #main -->
</div><!-- #primary -->


<?php get_footer(); ?>