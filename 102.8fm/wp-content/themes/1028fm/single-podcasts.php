<?php
/**
 * The template for displaying all single podcast
 */

get_header(); ?>


<div id="primary" class="content-area main homepage-content">
    <main id="main" class="site-main" role="main">

        <?php
        if(get_field('podcast_bg')!=""){
            $podcast_bg = get_field('podcast_bg');
        }else{
            $podcast_bg = get_field('podcast_image_default', 'options');
        }
        ?>
        <div class="main">
            <div class="container-fluid podcast title-section" style="background: url(<?php echo $podcast_bg; ?>); background-position: center; background-size: cover; ">
                <div class="row">
                    <div class="col-md-12 title-row pocast-page-title">
                        <h1 class="title"><?php the_title(); ?></h1>
                    </div>
                </div>

            </div>

            <div class="container podcast-row section">
                <div class="row">
                    <div class="col-md-8 offset-md-2 col-sm-12 custom-info">
                        <?php the_content(); ?>
                    </div>
                </div>

                <div class="podcast-info">


                <?php //get_template_part( 'template-parts/content', 'staffs' ); ?>
                <?php //get_template_part( 'template-parts/content', 'list-tracks' ); ?>

                    <?php
                    $podcast_id = get_the_ID();
                    $staffs_args = array(
                        'numberposts'	=> -1,
                        'post_type'		=> 'records',

                        'meta_key'		=> 'podcast',
                        'meta_value'	=> $podcast_id
                    );
                    $the_query_staffs = new WP_Query( $staffs_args );
					
					global $wpdb;
					$res = $wpdb->get_results($q = '
						select p.ID, p.post_title, pm3.meta_value img
						from(
							select post_id
							from '.$wpdb->postmeta.'
							where meta_key="podcast" and meta_value="'.$podcast_id.'"
						) pm1
						inner join '.$wpdb->postmeta.' pm2 on pm2.post_id = pm1.post_id and pm2.meta_key="staff"
						inner join '.$wpdb->posts.' p on pm2.meta_value = p.ID and p.post_status="publish"
						left join '.$wpdb->postmeta.' pm3 on  pm2.meta_value = pm3.post_id and pm3.meta_key = "link_photo"
						group by p.ID
					');
					//echo $q;
					//print_r($res);
                    ?>


                    <?php if( $the_query_staffs->have_posts() ): ?>

                        <div class="speakers-list">
                            <div class="col-md-8 offset-md-2 col-sm-12 title-row">
                                <div class="row">
                                    <h3 class="title">Ведущие</h3>
                                </div>
                            </div>
                            <div class="col-md-8 offset-md-2">
                                <div class="leading-row row">




									<?php foreach($res as $value): ?>
										<div class="col-4 col-sm-4 col-md-4 col-lg-3 item lead post-item">
                                            <div class="post">
                                                <div class="post-image"><a href="<?php the_permalink($value->ID); ?>"><img src="<?php echo (get_the_post_thumbnail_url($value->ID,'full')? get_the_post_thumbnail_url($value->ID,'full') : $value->img); ?>" class="post-img" alt="<?php echo $value->post_title; ?>"></a></div>
                                                <div class="post-content">
                                                    <a href="<?php the_permalink($value->ID); ?>" class="post-title"><?php 
                                                        $short_name = get_field('short_name', $value->ID);
                                                        if(!empty($short_name)){
                                                            echo get_field('short_name', $value->ID);
                                                        }else{
                                                            echo get_the_title($value->ID);
                                                        }
                                                        ?></a>
                                                </div>
                                            </div>
                                        </div>
									<?php endforeach; ?>
									<div class="clearfix"></div>
                                    <?php while( $the_query_staffs->have_posts() ) : $the_query_staffs->the_post(); ?>
                                        <?php setup_postdata($post);
                                            $track_id = get_field('staff');
                                        ?>
                                    <?php endwhile; ?>

                                </div>
                            </div>
                        </div>

                        <?php wp_reset_postdata(); ?>
                    <?php endif; ?>

                    <!-- -------------------------------------->


                    <?php
                    $podcast_id = get_the_ID();
                    $traks_args = array(
                        'numberposts'	=> -1,
                        'post_type'		=> 'records',
                        'orderby' => 'date',
                        'order'   => 'DESC',
                        'meta_key'		=> 'podcast',
                        'meta_value'	=> $podcast_id
                    );
                    $the_query_traks = new WP_Query( $traks_args );
                    ?>
                    <?php if( $the_query_traks->have_posts() ): ?>
                    <div class="traks section">
                        <div class="col-md-8 offset-md-2  col-sm-12 title-row">
                            <div class="row">
                                <h3 class="title">Список треков</h3>
                            </div>
                        </div>

                        <div class="col-md-8 offset-md-2 col-sm-12 list-track-row">
                            <div class="track-list items" id="newsList">


                                <?php while( $the_query_traks->have_posts() ) : $the_query_traks->the_post(); ?>
                                    <?php setup_postdata($post);
                                    $track_id = get_field('staff');

                                    if(get_field('file')!=""){
                                        $link = get_field('file')? get_field('file') : '';    
                                    }else{
                                        $link = get_field('file_link')? get_field('file_link') : '';    
                                    }
									
                                    //echo $link;
                                    ?>
       
                                        <div class="item track-list-item player-static player-podcast">

                                            <div class="">

                                                <div class="play"><img src="//1028fm.w-p.life/html/assets/images/play-btn-white.png"></div>


                                                <div class="track-item" data-track="<?php echo $link?>">
                                                    <div class="name-sound"><?php the_title(); ?></div>
                                                    <?php if(get_field('guest')!=""){ ?><div class="artist-sound"><span>Гость:</span> <?php echo get_field('guest')?></div><?php } ?>
                                                    <div class="lead-sound"><span>Ведущий:</span> <a href="<?php echo get_the_permalink($track_id); ?>"><?php echo get_the_title($track_id); ?></a></div>
                                                    <div class="date"><?php the_date(); ?></div>
                                                    <div class="tracklist-player">
                                                        <input type="range" class="progressBar" title="progress" min="0" max="100" step="1" value="0">
                                                        <div class="timetrack"></div>

                                                        <button id='btnMute' class='mute' title='mute'>Mute</button>
                                                        <input type="range" class="volume-bar" title="volume" min="0" max="10" step="1" value="5">


                                                        <!-- <img src="//1028fm.w-p.life/html/assets/images/big-player.png"> -->
                                                    </div>
                                                </div>

                                                <div class="like-record"><?php if(function_exists('wp_ulike')) wp_ulike('get'); ?></div>

                                            </div>
                                            <div class="disable-song"></div>
                                        </div>

                                    <?php endwhile; ?>

                                <?php wp_reset_postdata(); ?>
                                <?php endif; ?>
                            </div>
							<input type="hidden" name="podcast_id" value="<?php echo $podcast_id; ?>">
							<?php echo do_shortcode('[load_more_posts]'); ?>
							<script>var page = 2;</script>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </main>
</div>


<?php get_footer(); ?>
