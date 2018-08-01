<?php
/**
 * Plugin Name: Fix attributes
 * Plugin URI: venqka.cf
 * Description: This plugin taxonomy attributes from custom ones.
 * Version: 1.0.0
 * Author: venqka 
 * License: GPL2
 */

//enqueue scripts
function fa_enqueue_scripts() {

	//nt scripts
  wp_register_script( 'fa', plugin_dir_url( __FILE__ ) . 'fa-scripts.js', array( 'jquery' ), '1.0', false );

  wp_enqueue_script( 'fa', plugin_dir_url( __FILE__ ) . 'fa-scripts.js', array( 'jquery' ), '1.0', false );

  $ajax_args = array(
    'ajax_url'    => admin_url( 'admin-ajax.php' ), 
    // 'ajax_nonce'  => wp_create_nonce( 'ajax-nonce' )      
  );
  wp_localize_script( 'fa', 'fa_ajax', $ajax_args );
}
add_action( 'admin_enqueue_scripts', 'fa_enqueue_scripts', 30 );


function my_cool_plugin_create_menu() {

	add_menu_page( 'Fix attribites', 'Fix attributes', 'administrator', 'fix-attributes', 'fix_attributes_page' , 'dashicons-admin-tools' );
}
add_action('admin_menu', 'my_cool_plugin_create_menu');

add_action('wp_head', 'myplugin_ajaxurl');


require( 'fa-ajax.php' );

function fix_attributes_page() {
?>
<div class="wrap">
	<h1>Fix attributes</h1>
	<p>This plugin creates taxonomy attributes form custom ones. Just press the button.</p>
	<p>This plugin handles only custom atributes with the name Colour and Size</p>

	<button class="button button-primary" id="fa-trigger">Fix attributes</button>
</div>
<div class="response"></div>	
<?php }

