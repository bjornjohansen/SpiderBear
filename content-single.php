<?php
/**
 * @package SpiderBear
 */

$header = get_header_image();
?>
<?php if ( spiderbear_has_post_thumbnail() ) {
	$thumbnail = spiderbear_get_attachment_image_src( $post->ID, get_post_thumbnail_id( $post->ID ), 'spiderbear-large' ); ?>
	<div class="entry-background" style="background-image:url(<?php echo esc_url( $thumbnail ); ?>)">
		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</header><!-- .entry-header -->
	</div>

<?php } elseif ( ! empty ( $header ) ) { ?>
	<div class="entry-background" style="background-image:url(<?php echo esc_url( $header ); ?>)">
		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</header><!-- .entry-header -->
	</div>
<?php } else { ?>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->
<?php } ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content-wrapper">
		<div class="entry-content">
			<?php the_content(); ?>
			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'spiderbear' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php
				/* translators: used between list items, there is a space after the comma */
				$category_list = get_the_category_list( esc_html__( ', ', 'spiderbear' ) );

				/* translators: used between list items, there is a space after the comma */
				the_tags( sprintf( '<span class="entry-tags"><span class="heading">%s</span> ', esc_html__( 'Tags:', 'spiderbear' ) ), esc_html__( ', ', 'spiderbear' ), '</span>' );

				if ( 'true' == spiderbear_categorized_blog() ) {
					printf( '<span class="entry-categories">' . __( '<span class="heading">Categories:</span> %1$s', 'spiderbear' ) . '</span>', $category_list );
				}
			?>

			<?php edit_post_link( esc_html__( 'Edit', 'spiderbear' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-footer -->

	</div><!-- .entry-content-wrapper -->
</article><!-- #post-## -->
