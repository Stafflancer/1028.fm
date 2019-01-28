<?php
/**
 * Template name: Speakers page
 */

get_header(); ?>


<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">


        <div class="main">
            <div class="container leads-row section speakers-list">
                <div class="col-md-8 offset-md-2">
                    <div class="leading-row row">

                        <?php
                        $speakers_objects = get_field('speakers_list');
                        if( $speakers_objects ): ?>
                            <?php foreach( $speakers_objects as $post): // variable must be called $post (IMPORTANT) ?>
                                <?php setup_postdata($post); ?>

                                <div class="col-4 col-sm-4 col-md-4 col-lg-3 item lead post-item">
                                    <div class="post">
                                        <div class="post-image"><a href="<?php the_permalink(); ?>"><img src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'full'); ?>" class="post-img" alt="<?php the_title(); ?>"></a></div>
                                        <div class="post-content">
                                            <a href="<?php the_permalink(); ?>" class="post-title">
                                                <?php
                                                $short_name = get_field('short_name');
                                                if(!empty($short_name)){
                                                    echo get_field('short_name');
                                                }else{
                                                    echo get_the_title();
                                                }
                                                ?></a>
                                        </div>
                                    </div>
                                </div>

                            <?php endforeach; ?>

                            <?php wp_reset_postdata(); ?>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>

    </main>
</div>

<?php get_footer(); ?>