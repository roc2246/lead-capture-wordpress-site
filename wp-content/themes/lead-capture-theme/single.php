<?php
/**
 * The template for displaying single blog posts
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

						<div class="entry-meta">
							<?php
							$posted_on = sprintf(
								/* translators: %s: post date. */
								esc_html_x( 'Posted on %s', 'post date', 'lead-capture-theme' ),
								'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark"><time class="entry-date published updated" datetime="' . esc_attr( get_the_date( 'c' ) ) . '">' . esc_html( get_the_date() ) . '</time></a>'
							);

							$byline = sprintf(
								/* translators: %s: post author. */
								esc_html_x( 'by %s', 'post author', 'lead-capture-theme' ),
								'<span class="by-author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
							);

							echo $posted_on; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							echo ' | '; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							echo $byline; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							?>
						</div><!-- .entry-meta -->
					</header><!-- .entry-header -->

				<?php the_post_thumbnail(); ?>

					<div class="entry-content">
						<?php
						the_content(
							sprintf(
								wp_kses(
									/* translators: %s: Name of current post. Only visible to screen readers */
									__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'lead-capture-theme' ),
									array(
										'span' => array(
											'class' => array(),
										),
									)
								),
								wp_kses_post( get_the_title() )
							)
						);

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

				// Previous and next post navigation
				the_post_navigation(
					array(
						'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'lead-capture-theme' ) . '</span> <span class="nav-title">%title</span>',
						'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'lead-capture-theme' ) . '</span> <span class="nav-title">%title</span>',
					)
				);
			}
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
