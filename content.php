<?php
/**
 * @package alpha_lite
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php 
		if ( has_post_thumbnail() ) : ?>
			<div class="featured-img-container">
				<a href="<?php the_permalink(); ?>" rel="bookmark">
					<?php the_post_thumbnail( 'content-thumb', array( 'class' => 'featured-img' ) ); ?>
				</a>
			</div>
		<?php endif;
	?>
	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
	</header>

	<div class="entry-summary">
		<?php the_excerpt(); ?>
		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php alpha_lite_posted_on(); ?>
			<?php echo '<a class="read-more" href="'. get_permalink( get_the_ID() ) . '">Read More <i class="fa fa-arrow-circle-right"></i></a>'; ?>
		</div>
		<?php endif; ?>
	</div>
</article>
