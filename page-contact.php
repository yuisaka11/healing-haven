<?php
/**
 * The template for displaying all contact page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Healing_Haven_Massage
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php

		while ( have_posts() ) :
			?>
		<?php
		$contact_field = get_field('contact_form_intro');
		$phone_number = get_field('phone_number');
		$clinic_email = get_field('clinic_email');
		$clinic_address = get_field('address');
		$google_map = get_field('address_map');
			
		if ($phone_number) {
			?>
			<div class="contact-form-phone">
				<?php echo $phone_number; ?>
			</div>
			<?php
		}
		?>
		<?php
		if ($clinic_email) {
			?>
			<div class="contact-form-email">
				<?php echo $clinic_email; ?>
			</div>
			<?php
		}
		?>
		<?php
		if ($clinic_address) {
			?>
			<div class="contact-form-address">
				<?php echo $clinic_address; ?>
			</div>
			<?php
		}
		?>
		<?php
		if ($google_map) {
			?>
			<div class="contact-form-map">
				<?php echo $google_map; ?>
			</div>
			<?php
		}
		?>
		<?php
		if ($contact_field) {
			?>
			<div class="contact-form-intro">
				<?php echo $contact_field; ?>
			</div>
			<?php
		}
		?>
		<?php
		if ($contact_field) {
			?>
			<div class="contact-form-intro">
				<?php echo $contact_field; ?>
			</div>
			<?php
		}
		?>
		<?php
			the_post();

			get_template_part( 'template-parts/content', 'page' );

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
