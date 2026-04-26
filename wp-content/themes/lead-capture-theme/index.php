<?php
/**
 * The main template file
 *
 * @package Lead_Capture_Theme
 */

get_header();
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">

		<?php
		if ( have_posts() ) {
			// Start the Loop
			while ( have_posts() ) {
				the_post();

				// Include the appropriate template for the content.
				get_template_part( 'template-parts/content', get_post_type() );
			}

			// Previous/next page navigation
			the_posts_pagination(
				array(
					'prev_text' => esc_html__( 'Previous', 'lead-capture-theme' ),
					'next_text' => esc_html__( 'Next', 'lead-capture-theme' ),
				)
			);
		} else {
			// No posts found
			get_template_part( 'template-parts/content', 'none' );
		}
		?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
