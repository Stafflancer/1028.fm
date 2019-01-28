<?php
/*
  Plugin Name: TVE Load News
  Plugin URI: http://offis5.ru/
  Author: V. Tormyshev
  Author URI: http://offis5.ru/
  Description: 
  Version: 1.0
 */
/**
 * 
 */
class tve_load_news
{
	
	function __construct(){
		add_action('admin_menu', [$this, 'menu']);
		add_action('admin_print_footer_scripts', [$this, 'javascript'], 99);
		add_action( 'wp_ajax_tve_load_news', [$this, 'ajax'] );
	}

	public function menu() {
		$page = add_submenu_page( 'options-general.php', "Upload News", "Upload News", 'manage_options', 'tve_upload_news', [$this, 'upload'] );
	}

	public function upload(){

		global $wpdb;
		// катагории
		$personal = get_option('upload_news_categories', false);
		
		if (!$personal){
			$personal = array();
	
			$res = $wpdb->get_results('SELECT distinct pname, pdescription, pphoto FROM `st`');
			foreach ($res as $key => $value) {
				$r = $wpdb->get_results('select * from wp_posts where post_type="speakers" and post_title="'.wp_strip_all_tags( $value->pname ).'"');
				if (!count($r)){
					$post_data = array(
						'post_title'    => wp_strip_all_tags( $value->pname ),
						'post_content'  => $value->pdescription,
						'post_status'   => 'publish',
						'post_author'   => 1,
						'post_type'		=>'speakers',
					);
					$id = wp_insert_post($post_data);
				}else
					$id = $r[0]->ID;

				$personal[$value->pname] = $id;
			}
			update_option('upload_news_categories', $personal);
		}
		/*
		echo '<pre>';
		print_r($personal);
		echo '</pre>';
		*/

		/*
		$res = $wpdb->get_results('SELECT distinct pname, pdescription, pphoto FROM `st`');
		foreach ($res as $key => $value) {
			if (!empty($value->pphoto))
				update_field('link_photo', 'http://1028.fm'.$value->pphoto, $personal[$value->pname]);
		}
		*/
		echo '<div class="percent"><div></div></div>';
		echo '<table class="table">';
		$res = $wpdb->get_results('select * from st order by id');
		for ($count = 0; $count<18; $count++){
			echo '<tr><td>';
			echo $i++;
			echo '</td><td width="70%">';
			echo ($count*100) . ' &mdash; ' . ($count*100+100);
			echo '</td><td class="new" data-start="'.$count.'">';
			echo 'Подготовлено';
			echo '</td></tr>';
		}
		echo '</table>';
		echo '<style>
			.percent{height:4px; border:1px solid green;}
			.percent>div{width:0; background-color:green;height:4px;}
			.new{color:#777}
			.upload{color:red}
			.sucess{color:green}
		</style>';

		return;
		
		$str = '';
		for($i=40; $i<60; $i++){
			$res = $wpdb2->get_results('select date, title, status, image from news where image <> "" order by date limit ' . ($i*100) . ', 100');
			$str .= 'insert into wp_postmeta(`post_id`, `meta_key`, `meta_value`) values ';
			foreach ($res as $key => $value) {

				$res = $wpdb->get_results('
					select ID from wp_posts where
						post_date="'.$value->date.'"
						and post_title="'.$value->title.'"
						and post_status="'.($value->status? 'publish' : 'draft').'"
				');
				
				if (!empty($res[0]->ID))
					$str .= "(".$res[0]->ID.', "img_old", "http://1028.fm'.$value->image.'"),';
			}
			$str = substr(trim($str), 0, -1) . ";\n";
		}

		echo '<pre>';
		echo $str;
		echo '</pre>';
		return ;


		die;
		//print_r($categories);

		echo '<div class="percent"><div></div></div>';
		echo '<table class="table">';
		$i=1;
		for ($count = 0; $count<268; $count++){
			echo '<tr><td>';
			echo $i++;
			echo '</td><td width="70%">';
			echo ($count*100) . ' &mdash; ' . ($count*100+100);
			echo '</td><td class="new" data-start="'.$count.'">';
			echo 'Подготовлено';
			echo '</td></tr>';
		}
		echo '</table>';
		echo '<style>
			.percent{height:4px; border:1px solid green;}
			.percent>div{width:0; background-color:green;height:4px;}
			.new{color:#777}
			.upload{color:red}
			.sucess{color:green}
		</style>';

		/*
		for ($count = 0; $count<379; $count++){
		}

		

		$results = $wpdb2->get_results("SELECT * FROM news order by id desc limit 3");
		//print_r($results);
		*/
	}

	public function ajax(){
		if (!isset($_POST['start']))
			die(json_encode(['status' => 'fail', 'mess' => 'Не получена позиция старта']));

		$personal = get_option('upload_news_categories', false);

		global $wpdb;
		$res = $wpdb->get_results('
			select * 
			from st 
			-- where date>"2010-06-21 14:18:00" 
			order by id 
			limit ' . ($_POST['start']*100) . ', 100
		');
		foreach ($res as $value) {
			$post_data = array(
				'post_title'    => wp_strip_all_tags( $value->title ),
				'post_content'  => '',
				'post_status'   => 'publish',
				'post_author'   => 1,
				'post_name'		=> $value->alias,
				'post_date'		=> $value->date,
				'post_type'		=>'records',
			);
			// Вставляем запись в базу данных
			$post_id = wp_insert_post( $post_data );

			update_field('podcast', ($value->show_id==4? '83' : '124'), $post_id);
			update_field('staff', $personal[$value->pname], $post_id);
			update_field('guest', $value->gname, $post_id);
			update_field('file_link', 'http://1028.fm'.$value->audio, $post_id);
			//die;
		}

		die(json_encode(['status' => 'success', 'id' => $_POST['start']]));
	}

	public function javascript(){
		?>
		<script type="text/javascript">
			jQuery(function($){
				var percent = 0;
				function start(){
					var ar = $('td.new');
					if (ar.length){
						$(ar[0]).html('Формируется').addClass('upload').removeClass('new');
						var data= {
							action: 'tve_load_news',
							start: $(ar[0]).data('start')
						}
						$.post(ajaxurl, data, function(d){
							if (d.status == 'success'){
								$percent = Math.round(parseInt(d.id)*100/379);
								$('.percent>div').css('width', $percent+"%");
								setTimeout(start, 1);
								$('td[data-start='+d.id+']').html('Загружено').removeClass('upload').addClass('sucess');
							}else{
								alert(d.mess);
							}
						}, 'json');
					}
				}
				setTimeout(start, 1);
			});
		</script>
		<?php
	}
}

if (empty($tve_load_news))
	$tve_load_news = new tve_load_news;