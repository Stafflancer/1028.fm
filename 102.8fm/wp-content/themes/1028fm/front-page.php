<?php
/*
 * Template name: Front page
 */

get_header(); ?>

<div id="primary" class="content-area main homepage-content">
	<main id="main" class="site-main" role="main">

        <?php get_template_part( 'template-parts/content', 'listen' ); ?>

        <?php get_template_part( 'template-parts/content', 'articles' ); ?>

        <!-- Background row -->
        <div class="banner-row">
        
            <?php if(get_field('banner_carousel')): ?>

                <div class="slick-slider js-slick">

                <?php while(has_sub_field('banner_carousel')): ?>

                    <a href="<?php the_sub_field('banner_link'); ?>"><img src="<?php the_sub_field('banner_image'); ?>" alt="<?php the_sub_field('banner_alt'); ?>"></a>
                     
                <?php endwhile; ?>

                 </div>

            <?php endif; ?>

           
        </div>

        <?php get_template_part( 'template-parts/content', 'podcasts' ); ?>

        <?php get_template_part( 'template-parts/content', 'songs-stream' ); ?>


	</main>
</div>

<?php get_footer(); ?>