
<?php
$staffs_objects = get_field('staffs');
if( $staffs_objects ): ?>

<div class="speakers-list">
    <div class="col-md-8 offset-md-2 col-sm-12 title-row">
        <div class="row">
            <h3 class="title">Ведущие</h3>
        </div>
    </div>
    <div class="col-md-8 offset-md-2">
        <div class="leading-row row">



            <?php foreach( $staffs_objects as $post): ?>
                <?php setup_postdata($post); ?>

                <div class="col-4 col-sm-4 col-md-4 col-lg-3 item lead post-item">
                    <div class="post">
                        <div class="post-image"><a href="<?php the_permalink(); ?>"><img src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'full'); ?>" class="post-img" alt="<?php the_title(); ?>"></a></div>
                        <div class="post-content">
                            <a href="<?php the_permalink(); ?>" class="post-title"><?php if(!empty(get_field('short_name'))){
                                    echo get_field('short_name');
                                }else{
                                    echo get_the_title();
                                }
                                ?></a>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>



        </div>
    </div>
</div>

    <?php wp_reset_postdata(); ?>
<?php endif; ?>