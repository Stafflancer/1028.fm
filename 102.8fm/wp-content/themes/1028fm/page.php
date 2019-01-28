<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>
<?php
		// Start the loop.
		while ( have_posts() ) : the_post();
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">


		<div class="main">
			<div class="container-fluid podcast title-section" style="background: url(http://1028fm.w-p.life/html/assets/images/metro-podcast.png); background-position: center; background-size: cover; ">
				<div class="row">
					<div class="col-md-12 title-row pocast-page-title">
						<?php the_title( '<h1 class="title">', '</h1>' ); ?>				
					</div>
				</div>

			</div>

			<div class="container podcast-row section">		
				<div class="row">
					<div class="col-md-8 offset-md-2 col-sm-12">
					<?php the_content(); ?>
					</div>
				</div>
			</div>
		</div>
	</main>			

</div><!-- .content-area -->
<?php 
	endwhile;
?>

<?php get_footer(); ?>
