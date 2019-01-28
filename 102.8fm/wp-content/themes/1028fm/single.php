<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main main one-article" role="main">

        <?php
        while ( have_posts() ) : the_post();
        ?>

            <div class="container news-page-row section">
                <div class="row">
                    <div class="col-md-8 offset-md-2 breadcrumb-row">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="home"></a></li>
                                <li class="breadcrumb-item active" aria-current="page"><a href="/category/society/" class="">Читать</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 offset-md-2 date-row">
                        <div class="date"><?php the_date(); ?></div>
                    </div>
                    <div class="col-md-8 offset-md-2">
                        <h1 class="title"><?php the_title(); ?></h1>
                    </div>
                    <div class="col-md-8 offset-md-2 news-row">
						<?php if (get_post_meta($post->ID, 'img_old', true)){?>
							<img src="<?php echo get_post_meta($post->ID, 'img_old', true)?>">
						<?php } ?>
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>

        <?php
        endwhile;
        ?>

	</main><!-- .site-main -->

</div><!-- .content-area -->


<?php get_footer(); ?>
