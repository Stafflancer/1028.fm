<?php
/* Dynamic week dates
Monday	Понедельник	'mʌndei
Tuesday	Вторник	'tju:zdei
Wednesday	Среда	'wenzdei
Thursday	Четверг	ˈθɜːzdei
Friday	Пятница	'fraidei
Saturday	Суббота	'sætədei
Sunday	Воскресенье	'sʌndei
*/

$monday = date( 'd.m', strtotime( 'monday this week' ) );
$tuesday = date( 'd.m', strtotime( 'tuesday this week' ) );
$wednesday = date( 'd.m', strtotime( 'wednesday this week' ) );
$thursday = date( 'd.m', strtotime( 'thursday this week' ) );
$friday = date( 'd.m', strtotime( 'friday this week' ) );
$saturday = date( 'd.m', strtotime( 'saturday this week' ) );
$sunday = date( 'd.m', strtotime( 'sunday this week' ) );
// echo date("d.m");
$current_date = date("d.m");
?>



<div class="container sounds-row songs-block section">
    <div class="row">
        <div class="col-md-8 offset-md-2 title-row">
            <h2><?php the_field('sounds_title')?></h2>
        </div>
        <div class="col-md-8 offset-md-2 list-days-row">
            <div class="col-md-12 day-list items">
                <div class="item day-list-item<?php if($current_date==$monday){ echo ' active'; } ?>">
                    <div class="day">Пн</div>
                    <div class="date"><?php echo $monday; ?></div>
                </div>
                <div class="item day-list-item<?php if($current_date==$tuesday){ echo ' active'; } ?>">
                    <div class="day">Вт</div>
                    <div class="date"><?php echo $tuesday; ?></div>
                </div>
                <div class="item day-list-item<?php if($current_date==$wednesday){ echo ' active'; } ?>">
                    <div class="day">Ср</div>
                    <div class="date"><?php echo $wednesday; ?></div>
                </div>
                <div class="item day-list-item<?php if($current_date==$thursday){ echo ' active'; } ?>">
                    <div class="day">Чт</div>
                    <div class="date"><?php echo $thursday; ?></div>
                </div>
                <div class="item day-list-item<?php if($current_date==$friday){ echo ' active'; } ?>">
                    <div class="day">Пт</div>
                    <div class="date"><?php echo $friday; ?></div>
                </div>
                <div class="item day-list-item<?php if($current_date==$saturday){ echo ' active'; } ?>">
                    <div class="day">Сб</div>
                    <div class="date"><?php echo $saturday; ?></div>
                </div>
                <div class="item day-list-item<?php if($current_date==$sunday){ echo ' active'; } ?>">
                    <div class="day">Вс</div>
                    <div class="date"><?php echo $sunday; ?></div>
                </div>
            </div>
        </div>
        <div class="col-md-8 offset-md-2 list-sounds-row">
            <div class="col-md-12 sounds-list items">
				<?php $list = tve_get_play_list(0); ?>
				<?php foreach($list as $item): ?>
                <div class="item sound-list-item">
                    <div class="time"><?php echo $item['time'];?></div>
                    <div class="sound-item">
                        <div class="artist-sound"><?php echo $item['author'];?></div>
                        <div class="name-sound"><?php echo $item['title'];?></div>
                    </div>
                </div>
				<?php endforeach;?>

            </div>
        </div>
    </div>
</div>
<script>
	jQuery(function($){
		setInterval(function(){
			$.get('<?php echo admin_url('admin-ajax.php')?>', {
				action: 'tve_get_list_song'
			}, function(d){
				console.log(d);
				str = '';
				for (i in d){
					str += '<div class="item sound-list-item">';
						str += '<div class="time">'+d[i].time+'</div>';
						str += '<div class="sound-item">';
							str += '<div class="artist-sound">'+d[i].author+'</div>';
							str += '<div class="name-sound">'+d[i].title+'</div>';
						str += '</div>';
					str += '</div>';
				}
				$('.sounds-list.items').html(str);
			}, 'json');
		}, 600000);
	});
</script>