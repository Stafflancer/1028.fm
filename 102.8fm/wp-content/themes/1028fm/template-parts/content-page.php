<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="container">

		<div class="entry-content">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			<?php
			the_content();
		?>
		</div>
	</div>

</article><!-- #post-## -->
