<?php
/**
 * The template for displaying the front page
 *
 * This template is used when a static front page is set in Reading Settings.
 *
 * @package Lead_Capture_Theme
 */

get_header();
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">

		<?php
		if ( have_posts() ) {
			while ( have_posts() ) {
				the_post();
				?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<!-- <h1 class="entry-title"><?php the_title(); ?></h1> -->
					</header><!-- .entry-header -->

				<?php the_post_thumbnail(); ?>

					<div class="entry-content">
						<?php
						the_content();

						wp_link_pages(
							array(
								'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'lead-capture-theme' ),
								'after'  => '</div>',
							)
						);
						?>
					</div><!-- .entry-content -->

					<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
					?>
				</article><!-- #post-<?php the_ID(); ?> -->
				<?php
			}
		} else {
			// No pages found
			get_template_part( 'template-parts/content', 'none' );
		}
		?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
