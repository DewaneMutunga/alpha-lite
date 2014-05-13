<?php
/**
 * @package Alpha
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
			<?php alpha_posted_on(); ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$category_list = get_the_category_list( __( ', ', 'alpha' ) );
	
				/* translators: used between list items, there is a space after the comma */
				$tag_list = get_the_tag_list( '', __( ', ', 'alpha' ) );
	
				if ( ! alpha_categorized_blog() ) {
					// This blog only has 1 category so we just need to worry about tags in the meta text
					if ( '' != $tag_list ) {
						$meta_text = __( '<span class="cats-tags">This entry was tagged %2$s.</span>', 'alpha' );
					}
	
				} else {
					// But this blog has loads of categories so we should probably display them here
					if ( '' != $tag_list ) {
						$meta_text = __( '<span class="cats-tags">This entry was posted in %1$s and tagged %2$s.</span>', 'alpha' );
					} else {
						$meta_text = __( '<span class="cats-tags">This entry was posted in %1$s.</span>', 'alpha' );
					}
	
				} // end check for categories on this blog	
				printf( $meta_text, $category_list, $tag_list );
			?>
		</div>
	</header>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'alpha' ),
				'after'  => '</div>',
			) );
		?>		
		<?php alpha_post_nav(); ?>
	</div>
</article>