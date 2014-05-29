<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package alpha_lite
 */
?>

			</div><!-- #content -->
		</div>
	</div>

	<div id="footer-area" class="full">
		<div class="main">
			<footer id="colophon" class="site-footer inner" role="contentinfo">
				<div class="site-info">
					<?php
						$credits = sprintf( __( 'Built with WordPress & %s', 'alpha_lite' ), '<a href="' . AL_HOME . '">' . AL_NAME . '</a>' );
                        // If copyright & credits are left empty or have not been set, display default info.
                        if ( '' == get_theme_mod( 'alpha_lite_credits_copyright' ) ) :
                                echo $credits;
                        else :
                                echo get_theme_mod( 'alpha_lite_credits_copyright', $credits );
                        endif;
					?>
				</div><!-- .site-info -->
			</footer><!-- #colophon -->
		</div>
	</div>
	
<?php wp_footer(); ?>

</body>
</html>
