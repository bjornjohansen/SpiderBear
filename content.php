<?php
/**
 * @package SpiderBear
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( spiderbear_has_post_thumbnail() ) {
		$thumbnail = spiderbear_get_attachment_image_src( $post->ID, get_post_thumbnail_id( $post->ID ), 'medium' ); ?>
		<div class="entry-background" style="background-image:url(<?php echo esc_url( $thumbnail ); ?>)"></div>
	<?php } ?>
	<header class="entry-header">
		<?php if ( is_sticky() ) {
			echo '<span class="sticky-flag">' . esc_html__( 'Featured', 'spiderbear' ) . '</span>';
		} ?>
		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->

	<footer class="entry-footer">
		<div class="entry-meta">
			<?php edit_post_link( esc_html__( 'Edit', 'spiderbear' ), '<span class="edit-link">', '</span>' ); ?>
		</div><!-- .entry-meta -->
	</footer>
</article><!-- #post-## -->
