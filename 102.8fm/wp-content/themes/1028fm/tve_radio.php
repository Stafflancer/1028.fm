<?php

class tve_radio{

	function __construct()
	{
		//add_action('wp_ajax_nopriv_tve_get_last_news', array($this, 'get_last_news'));
		//add_action('wp_ajax_nopriv_tve_get_last_road',  array($this, 'get_last_road'));

        //add_action('wp_ajax_tve_get_last_news',  array($this, 'get_last_news'));
        //add_action('wp_ajax_tve_get_last_road',  array($this, 'get_last_road'));

	}
	/*
	function get_last_news(){
		$dir = wp_upload_dir();
		return $this->get_last_file($dir['basedir'] . '/records-news', $dir['baseurl'] . '/records-news');
	}

	function get_last_road(){
		$dir = wp_upload_dir();
		return $this->get_last_file($dir['basedir'] . '/records-road', $dir['baseurl'] . '/records-road');
	}
	*/

	function get_last_file($dir, $http){
		$ar = scandir($dir);
		//print_r($ar); die;
		$date = 0;
		$res = new stdClass;
		foreach ($ar as $file) {
			if ($file == '.' or $file == '..')
				continue;
			$time = filemtime($dir .'/' . $file);
			//echo $dir .'/' . $file . ' ==== ' . 
			if ($time > $date){
				$date = $time;
				$res->file = $http .'/'. $file;
				$res->date = $date;
			}
		}
		if (!empty($res->date)){
			$res->date = date("d.m.Y в H:i", $res->date);
			$res->status = 'success';
		}else
			$res->status = 'fail';

		die( json_encode($res) );
	}

}

if (empty($tve_radio))
	$tve_radio = new tve_radio;