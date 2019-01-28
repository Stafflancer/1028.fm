<?php
/**
 * Template name: News page
 */

get_header(); ?>

    <div id="primary" class="content-area main homepage-content">
        <main id="main" class="site-main main articles-list" role="main">



            <div class="container news-row section">
                <div class="row">
                    <div class="col-md-8 offset-md-2 list-news-row">
                        <div class="archive-filter">
                            <span>Новости за:&nbsp;&nbsp;</span>
                            <input type="text" class="datepicker" value="<?php echo date("d.m.Y");?>" readonly="readonly">
                            <input type="hidden" name="load_news_from_date" value="0">

                            <?php

                            ?>
                            <script>
                                //init_datepicker();
                            </script>


                        </div>



                        <div class="news-list items" id="newsList">
                            <?php
                            $lastposts = get_posts( array(
                                'posts_per_page' => 20,
                                'orderby' => 'date',
                                'order'   => 'DESC',
                            ) );

                            if ( $lastposts ) {
                                foreach ( $lastposts as $post ) :
                                    setup_postdata( $post ); ?>


                                    <div class="item news-list-item">
                                        <div class="news-item">
                                            <div class="name-new"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
                                            <div class="excerpt"><?php echo kama_excerpt( array('maxchar'=>200, 'text'=>'') ); ?></div>
                                            <div class="date"><?php echo get_the_date(); ?>, <?php the_time(); ?></div>
                                        </div>
                                    </div>

                               <?php
                                endforeach;
                                //wp_reset_postdata();
                            }
                            ?>
                        </div>
                        <?php
                        $categories = get_the_category();
                        $category_id = $categories[0]->cat_ID;
                        ?>
                        <input type="hidden" name="category_id" value="<?php echo $category_id; ?>">
                        <?php echo do_shortcode('[load_more_posts]'); ?>
                        <script>var page = 2;</script>
                    </div>
                </div>
            </div>

        </main><!-- .site-main -->
    </div><!-- .content-area -->

<?php get_footer(); ?>