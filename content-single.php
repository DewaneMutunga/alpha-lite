<?php
/**
 * @package alpha_lite
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php 
		if ( has_post_thumbnail() ) : ?>
			<div class="featured-img-container">
				<?php the_post_thumbnail( 'content-thumb', array( 'class' => 'featured-img' ) ); ?>
			</div>
		<?php
		endif;
	?>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>

		<div class="entry-meta">
			<?php alpha_lite_posted_on(); ?>
		</div>
	</header>

	<div class="entry-content">
		<?php the_content(); ?>
	</div>
	
	<footer class="entry-meta entry-footer">
		<?php
				/* translators: used between list items, there is a space after the comma */
				$category_list = get_the_category_list( __( ', ', 'alpha_lite' ) );
	
				/* translators: used between list items, there is a space after the comma */
				$tag_list = get_the_tag_list( '', __( ', ', 'alpha_lite' ) );
	
				if ( ! alpha_lite_categorized_blog() ) {
					// This blog only has 1 category so we just need to worry about tags in the meta text
					if ( '' != $tag_list ) {
						$meta_text = __( '<span class="cats-tags">This entry was tagged %2$s.</span>', 'alpha_lite' );
					}
	
				} else {
					// But this blog has loads of categories so we should probably display them here
					if ( '' != $tag_list ) {
						$meta_text = __( '<span class="cats-tags">This entry was posted in %1$s and tagged %2$s.</span>', 'alpha_lite' );
					} else {
						$meta_text = __( '<span class="cats-tags">This entry was posted in %1$s.</span>', 'alpha_lite' );
					}
	
				} // end check for categories on this blog	
				printf( $meta_text, $category_list, $tag_list );
			?>
			<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'alpha_lite' ),
				'after'  => '</div>',
			) );
			?>		
			<?php alpha_lite_post_nav(); ?>
	</footer>
</article>

<?php alpha_lite_author_box(); ?>