<div class="container carousel-row read-block section">
    <div class="row">
        <div class="col-md-8 offset-md-2 title-row">
            <h2><a href="<?php echo get_field('read_link'); ?>"><?php echo get_field('read_title'); ?></a></h2>
        </div>
    </div>






    <?php
    $articles_objects = get_field('list_articles');

    if( $articles_objects ): ?>




    <div class="row">
        <div class="col-md-8 offset-md-2" >

        	<div class="carousel-slide">
                <?php
                $key = 1;
                foreach( $articles_objects as $post):?>
                
                    <?php setup_postdata($post); ?>

                    <div class="carousel-item<?php if($key==1){ echo " active"; } ?>">
                        <img class="d-block w-100" src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'full'); ?>" alt="<?php the_title(); ?>">
                        <div class="carousel-caption d-none d-md-block">
                            <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                            <p><?php echo get_field('anonce'); ?></p>
                            <span class="post-date"><?php the_date(); ?></span>
                            <div class="more-btn"><a href="<?php the_permalink(); ?>" class="readmore">Узнать больше <i class="fa fa-angle-right" aria-hidden="true"></i></a></div>
                        </div>
                    </div>

                    <?php
                    $key++; ?> 
                  

                    <?php 
                endforeach;
                ?>
               </div>  
        </div>
    </div>



    <?php wp_reset_postdata(); ?>


</div>
<?php endif; ?>