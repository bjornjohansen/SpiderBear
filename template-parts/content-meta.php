<?php
/**
 * Template part for showing post meta.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package SpiderBear
 */

?>
<?php if ( 'post' === get_post_type() ) : ?>
	<div class="entry-meta">
		<div><span class="author vcard"><a class="url fn n" href="<?=esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php esc_html_e( get_the_author() ); ?></a></span></div>
		<div><?php esc_html_e( 'Published:' ); ?> <time class="entry-date published" datetime="<?=get_the_date( 'c' ); ?>"><?=get_the_date(); ?></time></div>
	</div>
<?php endif; ?>
