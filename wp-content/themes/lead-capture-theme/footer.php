<?php
/**
 * The template for displaying the footer
 *
 * @package Lead_Capture_Theme
 */
?>
	</main>

	<footer id="colophon" class="site-footer">
		<div class="site-info">
			<span class="sep"> | </span>
			<?php
			/* translators: %s: CMS name, i.e. WordPress. */
			printf( esc_html__( 'Proudly powered by %s', 'lead-capture-theme' ), 'WordPress' );
			?>
			<span class="sep"> | </span>
			<?php
			/* translators: 1: Theme name, 2: Theme author. */
			printf( esc_html__( 'Theme: %1$s by %2$s', 'lead-capture-theme' ), 'Lead Capture Theme', 'Your Name' );
			?>
		</div>
	</footer>
</div>

<?php wp_footer(); ?>
</body>
</html>
