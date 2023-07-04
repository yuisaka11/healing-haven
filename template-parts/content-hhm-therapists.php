<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Healing_Haven_Massage
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;
		?>
	</header><!-- .entry-header -->

	<?php healing_haven_post_thumbnail(); ?>

	<div class="therapist-details">
		<?php 
		// Output Therapist email
		if ( function_exists( 'get_field' ) ) {
			if ( get_field( 'therapist_email' ) ) { 
				?>
				<a href="mailto:<?php the_field('therapist_email'); ?>"><?php the_field('therapist_email'); ?></a>
			<?php
			};
		};

		// Output therapist specialties
		$specialties = get_the_terms( $post->ID, 'hhm-specialties' ); 
		$specialty_array = array();

		foreach($specialties as $specialty) {
			$specialty_array[] = $specialty->name;
		} ?>
		<p><?php echo implode(", ", $specialty_array) ?></p>


		<?php
		// Output Therapist Availabilities
		if ( function_exists( 'get_field' ) ) {
			if ( get_field( 'days_available' ) ) { 
				$days_available = get_field( 'days_available');
				$days_array = array();

				foreach ( $days_available as $day ) {
					$days_array[] = $day['days_available'];
				} ?>
				<p><?php echo implode(",", $days_array); ?></p>
				<?php
			};
		};
		?>
	</div>

	<div class="entry-content">
		<?php
		// Output therapist bio
		if ( function_exists( 'get_field' ) ) {
			if ( get_field( 'therapist_bio' ) ) {
				the_field('therapist_bio');
			};
		}; 
		?>

		<!-- Output Testimonials -->
		<section class="therapist-testimonial">
			<h2>Testimonials</h2>
			<?php 
			$args = array (
				'post_type' => 'hhm-testimonial',
				'posts_per_page' => '-1',
			);
			$therapist_ID = get_the_ID();

			$query = new WP_Query( $args );
			if ( $query->have_posts() ) {
				while( $query->have_posts() ) {
					$query->the_post();

					if ( function_exists( 'get_field' ) ) {
						if ( get_field( 'therapist_reviewed') ) { 
							$testimonials = get_field('therapist_reviewed');

							foreach( $testimonials as $testimonial) {
								if ($testimonial == $therapist_ID) { ?>
										<h3><?php the_title(); ?></h3> 
										<?php 
										the_content();
								}
								}
						}
					}
				};
			wp_reset_postdata();
			}
			?>
		</section>

		<!-- Output availability calendar -->
		<div class="therapist-availability-calendar">
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'healing-haven' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);
		?>
		</div>

		<?php
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'healing-haven' ),
				'after'  => '</div>',
			)
		);
		?>

	</div><!-- .entry-content -->

	<!-- Call to action button -->
	<a href="<?php echo get_post_type_archive_link('hhm-therapists'); ?>">
		<p>Check out other therapists</p>
	</a>

	<footer class="entry-footer">
		<?php healing_haven_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
