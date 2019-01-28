<?php
/*
Plugin Name: Load more posts
Plugin URI: https://w-p.life/plugins/load-more-posts
Description: Load more wp post with Rest-Api
Author: Anatoliy Dovgun
Author URI: https://dovgun.com
Version: 990.1
Text Domain: load-more-posts
License: GPL version 2 or later - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*/


/*Load scripts*/
function load_my_script(){
    wp_register_script( 
        'my_script', 
        plugin_dir_url( __FILE__ ) . 'assets/js/custom.js', 
        array( 'jquery' )
    );
    wp_enqueue_script( 'my_script' );
}
add_action('wp_enqueue_scripts', 'load_my_script');


/*Add params to /wp-admin/options-reading.php */
class Add_Settings_Field {
     public function __construct() {
          add_action( 'admin_init' , array( $this , 'register_fields' ) );
     }

     public function register_fields() {
          register_setting( 'reading', 'posts_block_id', 'esc_attr' );
          add_settings_field(
               'posts_block_id',
               '<label for="posts_block_id">' . __( 'Posts Load more #id' , 'posts_block_id' ) . '</label>',
               array( $this, 'post_load_id_html' ),
               'reading'
          );

          register_setting( 'reading', 'load_more_float', 'esc_attr' );
          add_settings_field(
               'load_more_float',
               '<label for="load_more_float">' . __( 'BTN Load more float' , 'load_more_float' ) . '</label>',
               array( $this, 'load_more_float_html' ),
               'reading'
          );
          register_setting( 'reading', 'load_more_float_text', 'esc_attr' );
          add_settings_field(
               'load_more_float_text',
               '<label for="load_more_float_text">' . __( 'BTN Load more float text' , 'load_more_float_text' ) . '</label>',
               array( $this, 'load_more_float_text_html' ),
               'reading'
          );          
     }

     public function post_load_id_html() {
          $value = get_option( 'posts_block_id', '' );
          echo '<input type="text" id="posts_block_id" name="posts_block_id" value="' . esc_attr( $value ) . '" />';
     }

     public function  load_more_float_html() {
          $options = get_option('load_more_float');
          //echo $options;
          $items = array("left", "center", "right");
          echo "<select id='load_more_float' name='load_more_float'>";
          foreach($items as $item) {
               $selected = ($options==$item) ? 'selected="selected"' : '';
               echo "<option value='$item' $selected>$item</option>";
          }
          echo "</select>";
     }

     public function  load_more_float_text_html() {
          $options = get_option('load_more_float_text');
          //echo $options;
          $items = array("left", "center", "right");
          echo "<select id='load_more_float_text' name='load_more_float_text'>";
          foreach($items as $item) {
               $selected = ($options==$item) ? 'selected="selected"' : '';
               echo "<option value='$item' $selected>$item</option>";
          }
          echo "</select>";
     }     

}
new Add_Settings_Field();



//Add short code [load_more_posts]
function load_more_posts_func( $atts ){
	return '
	<style>
		/*Hide standart navigations*/

		/* Align Btn & Text*/
		.load-more-prev-next{
			 text-align: '.get_option('load_more_float').';
		}
		.btn-load-more-next{
			 text-align: '.get_option('load_more_float_text').';
			 
		}

	</style>
	<p class="load-more-prev-next" style="display: none;">                      
	   <button class="btn-load-more-next">Загрузить еще <i class="fa fa-angle-right" aria-hidden="true"></i></button>
	   <noscript>Please enable JavaScript.</noscript>
	</p>
	<script type="text/javascript">

		var posts_block_id = "'.get_option('posts_block_id').'"; 
		var post_per_page = "'.get_option('posts_per_page').'";

	</script>
    ';
}
add_shortcode( 'load_more_posts', 'load_more_posts_func' );

