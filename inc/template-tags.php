<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package alpha_lite
 */

if ( ! function_exists( 'alpha_lite_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function alpha_lite_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'alpha_lite' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'alpha_lite' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'alpha_lite' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'alpha_lite_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function alpha_lite_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'alpha_lite' ); ?></h1>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'alpha_lite' ) );
				next_post_link(     '<div class="nav-next">%link</div>',     _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link',     'alpha_lite' ) );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'alpha_lite_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function alpha_lite_posted_on() {
	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);
	?>
	<span class="byline">
		<i class="fa fa-pencil"></i>
		<?php
		printf( '<span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		);
		?>
	</span>
	<span class="posted-on">
		<i class="fa fa-calendar"></i>
		<?php
		printf( '<a href="%1$s" rel="bookmark">%2$s</a>',
			esc_url( get_permalink() ),
			$time_string
		);
		?>
	</span>
	<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		<span class="comments-link"><i class="fa fa-comments"></i><?php comments_popup_link( __( 'Comments', 'alpha_lite' ), __( '1 Comment', 'alpha_lite' ), __( '% Comments', 'alpha_lite' ) ); ?></span>
	<?php endif;
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function alpha_lite_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'alpha_lite_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'alpha_lite_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so alpha_lite_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so alpha_lite_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in alpha_lite_categorized_blog.
 */
function alpha_lite_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'alpha_lite_categories' );
}
add_action( 'edit_category', 'alpha_lite_category_transient_flusher' );
add_action( 'save_post',     'alpha_lite_category_transient_flusher' );

if ( ! function_exists( 'alpha_lite_author_box' ) ) :
/**
 * Create an author box that will show show after content on single posts.
 */
function alpha_lite_author_box() {
	?>
	<?php // show post footer? theme customizer options ?>
	<?php if ( get_theme_mod( 'alpha_lite_lite_post_footer' ) == 1 ) : ?>
		<div class="single-post-footer clear">
			<div class="post-footer-author">
				<?php echo get_avatar( get_the_author_meta( 'ID' ), 32, '', get_the_author_meta( 'display_name' ) ); ?>
				<span class="author-name"><?php echo __( 'This post was written by ', 'alpha_lite' ) . get_the_author_meta( 'display_name' ); ?></span>	
			</div>
			<?php if ( ! get_the_author_meta( 'description' ) == '' ) : ?>
				<div class="post-footer-author-bio">
					<p><?php echo get_the_author_meta( 'description' ); ?></p>
				</div>
			<?php endif; ?>
			<div class="post-footer-social-profiles">
				<?php do_action( 'social_profiles' ); ?>
			</div>
		</div>
	<?php endif; ?>
	<?php
}
endif;

/**
 * social profiles
 */
function alpha_lite_lite_social_profiles() {
	if ( get_theme_mod( 'alpha_lite_lite_twitter' ) || get_theme_mod( 'alpha_lite_lite_facebook' ) || get_theme_mod( 'alpha_lite_lite_gplus' ) || get_theme_mod( 'alpha_lite_lite_linkedin' ) ) : ?>
		<div class="social-links">
			<?php
				$social_profiles = array( 
					'twitter'	=> array(
						'icon' 		=> '<i class="fa fa-twitter-square"></i>',
						'option'	=> esc_url( get_theme_mod( 'alpha_lite_lite_twitter' ) )
					),
					'facebook'	=> array(
						'icon' 		=> '<i class="fa fa-facebook-square"></i>',
						'option'	=> esc_url( get_theme_mod( 'alpha_lite_lite_facebook' ) )
					),
					'gplus'	=> array(
						'icon' 		=> '<i class="fa fa-google-plus-square"></i>',
						'option'	=> esc_url( get_theme_mod( 'alpha_lite_lite_gplus' ) )
					),
					'linkedin'	=> array(
						'icon' 		=> '<i class="fa fa-linkedin-square"></i>',
						'option'	=> esc_url( get_theme_mod( 'alpha_lite_lite_linkedin' ) )
					),
				);
				foreach ( $social_profiles as $profile ) {
					if ( '' != $profile[ 'option' ] ) :
						echo '<a href="', $profile[ 'option' ], '">', $profile[ 'icon' ], '</a>'; 
					endif;
				}
			?>
		</div>
	<?php 
	endif; // end check for any social profile
}
add_action( 'social_profiles', 'alpha_lite_lite_social_profiles' );