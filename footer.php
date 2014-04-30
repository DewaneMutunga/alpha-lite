<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Alpha
 */
?>

			</div><!-- #content -->
		</div>
	</div>

	<div id="footer-area" class="full">
		<div class="main">
			<footer id="colophon" class="site-footer inner" role="contentinfo">
				<div class="site-info">
					<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'alpha' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'alpha' ), 'WordPress' ); ?></a>
					<span class="sep"> | </span>
					<?php printf( __( 'Theme: %1$s by %2$s.', 'alpha' ), 'Alpha', '<a href="http://dewanemutunga.com" rel="designer">Dewane Mutunga</a>' ); ?>
				</div><!-- .site-info -->
			</footer><!-- #colophon -->
		</div>
	</div>
	
<?php wp_footer(); ?>

</body>
</html>
