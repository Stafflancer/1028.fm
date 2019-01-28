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
    <div id="main" class="site-main" role="main">


<main class="main">

    <div class="container lead-row">
        <div class="row section">
            <div class="col-md-8 offset-md-2 breadcrumb-row">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="home"></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="/speakers/" class="">Ведущие</a></li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-8 offset-md-2 photo-row">
                
                <?php if(get_field('speaker_photo')) { ?>
                <img src="<?php the_field('speaker_photo'); ?>" class="aligncenter post-img" alt="<?php the_title(); ?>"> 
                <?php } else { ?>
                <img src="<?php echo get_field('speaker_image_default', 'options'); ?>" class="aligncenter post-img" alt="<?php the_title(); ?>">
                <?php } ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 offset-md-2 title-row">
                <h1 class="title"><?php the_title(); ?></h1>
            </div>
            <div class="col-md-8 offset-md-2 lead-info">
                <?php the_content(); ?>
            </div>
        </div>

        <div class="podcast-row">
            <div class="podcast-info">


                <?php get_template_part( 'template-parts/content', 'list-tracks' ); ?>

            </div>



        </div>

    </div>


    </main>
</div>


<?php get_footer(); ?>
