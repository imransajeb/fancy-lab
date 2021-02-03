<?php
/**
* Template Overides for woooCommerce pages
* @link https://docs.woocommerce.com/document/woocommerce-theme-devloper-handbook/#section-3
*
* @package Fancy Lab 
*/
function fancy_lab_wc_modify(){
	/**
	* Modify WooCommerce opening and  closing HTML tags
	* We need Bootstrap-link opening/closeing HTML tags
	*/
	add_action('woocommerce_before_main_content', 'fancy_lab_open_container_row', 5);
	function fancy_lab_open_container_row(){
		echo '<div class ="container shop-content"><div class="row">';
	}

	add_action('woocommerce_after_main_content', 'fancy_lab_close_container_row', 5 );
	function fancy_lab_close_container_row() {
		echo '</div></div>';
	}

	/**
	* Remove the main sidebar from its original option
	* We'll be including it somewhere else on
	*/
	remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar' );

		if(is_shop()){
		add_action('woocommerce_before_main_content', 'fancy_lab_add_sidebar_tags', 6);
		function fancy_lab_add_sidebar_tags(){
		echo '<div class="sidebar-shop col-lg-3 col-md-4 order-2 order-md-1">';
		}
		//Put the amin WC sidebar back , but using other action hook and on a different position
		add_action( 'woocommerce_before_main_content' , 'woocommerce_get_sidebar', 7);

		add_action ( 'woocommerce_before_main_content', 'fancy_lab_close_sidebar_tags', 8 );
		function fancy_lab_close_sidebar_tags(){
		echo '</div>';
		} 
		add_action( 'woocommerce_after_shop_loop_item_title', 'the_excerpt', 1);
	}

	// Modify HTML tags on a shop page . we also want Bootstrap-link markup here (.primary div)

	add_action ( 'woocommerce_before_main_content', 'fancy_lab_add_shop_taggs', 9 );
	function fancy_lab_add_shop_taggs(){
		if(is_shop()){
			echo '<div class= "col-lg-9 col-md-8 order-1 order-md-2">';			
		} else{
			echo '<div class="col"';
		}


	}

	add_action( 'woocommerce_after_main_content', 'fancy_lab_close_shop_tags', 4 );
	function fancy_lab_close_shop_tags (){
		echo '</div>';
	}

	/*
	add_filter( 'woocommerce_show_page_title', 'fancy_lab_remove_shop_title' );
	function fancy_lab_remove_shop_title( $val){
		$val = false;
		return $val;
	}
	*/
	
}
add_action ( 'wp', 'fancy_lab_wc_modify' );
