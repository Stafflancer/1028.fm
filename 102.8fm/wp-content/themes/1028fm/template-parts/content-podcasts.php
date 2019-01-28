<div class="container podcasts-row podcasts-block section">
    <div class="row">
        <div class="col-md-8 offset-md-2 title-row">
            <h2><a href="<?php echo get_field('podcasts_link'); ?>"><?php echo get_field('podcasts_title', 2); ?></a></h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 offset-md-2 podcast-list">
            <?php
            //$list_tracks =  get_field('list_tracks');
            $podcast_objects = get_field('list_podcasts', 2);

            if( $podcast_objects ): ?>

                <?php foreach( $podcast_objects as $post): // variable must be called $post (IMPORTANT) ?>
                    <?php setup_postdata($post); ?>


                    <div class="podcast-item item row">
                        <div class="post-image col-6 col-sm-6 col-md-6"><a href="<?php the_permalink(); ?>"><img src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'full'); ?>" class="post-img" alt="<?php the_title(); ?>"></a></div>


                        <div class="post-content col-6 col-sm-6 col-md-6">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"></a>
                            <h3 class="podcast-name"><div class="post-title"><?php the_title(); ?></div></h3>

                        </div>

                    </div>


                <?php endforeach; ?>

                <?php wp_reset_postdata(); ?>
            <?php endif; ?>


        </div>
    </div>
</div>