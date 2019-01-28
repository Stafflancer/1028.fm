<div class="container news-posts listen-block section">
    <div class="row">
        <div class="col-md-8 offset-md-2 title-row">
            <h2><a href="<?php echo get_field('listen_link'); ?>"><?php echo get_field('listen_title'); ?></a></h2>
        </div>
    </div>

    <div class="post-row row">

                <div class="col-12 col-sm-12 col-md-4 item post-item">
                    <div class="post">
                        <div class="post-image"><img src="/wp-content/uploads/2018/11/news.png" class="post-img" alt="post"></div>
                        <div class="post-content radio-news-in-hour">
                            <a class="post-title">Новости к этому часу</a>
							<?php 
								$time_news = filemtime('/var/www/aradio/data/web_dir/www/doroga/news.mp3');

								$time_news = $time_news + 25200;
								//echo $time_news;
								$date_news = date("d.m.Y в H:i", $time_news);
							?>
                            <p><span class="post-date">обновлено <?php echo $date_news; ?></span></p>
                            <div class="small-player">

                                <div class="player-static track-list-item">
									<div class="audio_player" style="" class="item">
                                
										<button class='btnPlayPause play' title='play' accesskey="P">Play</button>
                                        <div class="additional-control">
										<input type="range" class="progressBar" title="progress" min="0" max="100" step="1" value="0">
                                        <button id='btnMute' class='mute' title='mute'>Mute</button>
                                        <input type="range" class="volume-bar" title="volume" min="0" max="10" step="1" value="9">
                                        <div class="song-source" data-track="http://1028.fm/doroga/news.mp3"></div>
                                        </div>
                                    
									</div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-12 col-sm-12 col-md-4 item post-item">
                    <div class="post">
                        <div class="post-image"><img src="/wp-content/uploads/2018/11/image-post.png" class="post-img" alt="post"></div>
                        <div class="post-content radio-road-in-hour">
                            <a class="post-title">Дорожная служба</a>
							<?php 
								$time_road = filemtime('/var/www/aradio/data/web_dir/www/doroga/doroga.mp3');
								$time_road = $time_road + 25200;
								$date_road = date("d.m.Y в H:i", $time_road);
							?>
                            <p><span class="post-date">обновлено <?php echo $date_road; ?></span></p>
                            <div class="small-player">

                                <div class="player-static track-list-item">
                                    <div class="audio_player" style="" class="item">

                                        <button class='btnPlayPause play' title='play' accesskey="P">Play</button>
                                        <div class="additional-control">
                                            <input type="range" class="progressBar" title="progress" min="0" max="100" step="1" value="0">
                                            <button id='btnMute' class='mute' title='mute'>Mute</button>
                                            <input type="range" class="volume-bar" title="volume" min="0" max="10" step="1" value="9">
                                            <div class="song-source" data-track="http://1028.fm/doroga/doroga.mp3"></div>
                                        </div>

                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>


        <?php $posts = get_posts(array('posts_per_page' => 1, 'orderby' => 'rand', 'post_type' => 'jokes')); if( $posts ): ?>
            <?php foreach ( $posts as $post ) : setup_postdata( $post ); ?>

        <div class="col-12 col-sm-12 col-md-4 item post-item">
            <div class="post">
                <div class="post-image"><img src="/wp-content/uploads/2018/11/img-post2.png" class="post-img" alt="post"></div>
                <div class="post-content">
                    <a class="post-title">Шутка Zажигания</a>
                    <?php //echo get_the_title(); ?>
                    <p><span class="post-date">обновлено <?php echo get_the_date(); ?> в <?php echo get_the_time(); ?></span></p>
                    <div class="small-player">

                        <div class="player-static track-list-item">
                            <div class="audio_player" style="" class="item">

                                <button class='btnPlayPause play' title='play' accesskey="P">Play</button>
                                <div class="additional-control">
                                    <input type="range" class="progressBar" title="progress" min="0" max="100" step="1" value="0">
                                    <button id='btnMute' class='mute' title='mute'>Mute</button>
                                    <input type="range" class="volume-bar" title="volume" min="0" max="10" step="1" value="9">
                                    <div class="song-source" data-track="<?php echo get_field('joke_file'); ?>"></div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
            <?php endforeach; ?>
            <?php wp_reset_postdata(); ?>
        <?php endif; ?>





    </div>
</div>
