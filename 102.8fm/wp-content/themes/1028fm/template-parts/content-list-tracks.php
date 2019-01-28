<?php
$tracks_objects = get_field('tracks_list');

if( $tracks_objects ): ?>

<div class="traks section">
    <div class="col-md-8 offset-md-2  col-sm-12 title-row">
        <div class="row">
            <h3 class="title">Список треков</h3>
        </div>
    </div>

    <div class="col-md-8 offset-md-2 col-sm-12 list-track-row">
        <div class="track-list row items">

            <?php foreach( $tracks_objects as $post): ?>
                <?php setup_postdata($post);
                $track_id = get_field('staff');

                ?>

                <div class="item track-list-item">
                    <div class="play"><img src="http://1028fm.w-p.life/html/assets/images/play-btn-white.png"></div>
                    <div class="track-item">
                        <div class="name-sound"><?php the_title(); ?></div>
                        <div class="artist-sound"><span>Гость:</span> Владислав Логинов, вице-мэр Красноярска</div>
                        <div class="lead-sound"><span>Ведущий:</span> <a href="<?php echo get_the_permalink($track_id); ?>"><?php echo get_the_title($track_id); ?></a></div>
                        <div class="date"><?php the_date(); ?></div>
                        <div class="tracklist-player"><img src="http://1028fm.w-p.life/html/assets/images/big-player.png"></div>
                    </div>
                </div>


            <?php endforeach; ?>

            <?php wp_reset_postdata(); ?>
            <?php endif; ?>

        </div>
    </div>

</div>