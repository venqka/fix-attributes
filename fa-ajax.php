<?php

function fix_attributes() {

	
$products_args = array(
	'post_type'			=>	'product',
	'posts_per_page'	=>	-1
	// 'post__in'	=> array('3230', '839')
);

$products = NEW WP_Query( $products_args );


ob_start();
$count = 1;

while( $products->have_posts() ) {	
	$products->the_post();

	$attributes_raw = get_post_meta( get_the_ID(), '_product_attributes' );

	
	echo $count . ' <h2>' . the_title() . '</h2><br/>';
	foreach ( $attributes_raw as $attr ) {
		foreach ( $attr as $att ) {
			$atts_exploded = explode( "|", $att["value"] );
			if( $att["name"]=="Colour" ){

				echo '<span style="font-weight: 600;">Colours fixed: </span><br/>';
				foreach ( $atts_exploded as $colours ) {
					echo $colours  . ' ';
					$coloured = wp_insert_term( $colours, 'pa_colour' );
				
					$obj_terms = wp_set_object_terms( get_the_ID(), $colours, 'pa_colour', true ); 
					
				}
				echo '<br><br/>';	
			}

			if( $att["name"]=="Size" ){
				echo '<span style="font-weight: 600;">Sizes fixed: </span><br/>';
				foreach ( $atts_exploded as $size ) {
					echo $size  . ' ';
					$sized = wp_insert_term( $size, 'pa_size' );
					//var_dump( $coloured );
					$obj_terms = wp_set_object_terms( get_the_ID(), $size, 'pa_size', true ); 
					
					//var_dump($obj_terms);
				}	
			}
			
		}
		
	}
	echo '<br><br><hr><br>';

	
	$count ++;
}
$response = ob_get_clean();
	wp_send_json_success( $response );

	// echo $respo
	// wp_send_json_success( 'fix_attributes' );
	die();
}
add_action( 'wp_ajax_fix_attributes', 'fix_attributes' );
// add_action( 'wp_ajax_nopriv_fix_attributes', 'fix_attributes' )