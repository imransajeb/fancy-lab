<?php
/**
*
 * Fancy Lab functions ad definitions
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Fancy Lab
 */

/**
* Enqueue scripts and styles.
*/
function fancy_lab_scripts(){

	//Bootstrap javascript and css files
	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/inc/bootstrap.min.js',  array('jquery'), '4.3.1', true);
	wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/inc/bootstrap.min.css', array(), '4.3.1', 'all' );

	//Theme's main stylesheet
	wp_enqueue_style( 'fancy-lab-style', get_stylesheet_uri(), array(), filemtime( get_template_directory() . '/style.css' ), 'all' );
}
add_action( 'wp_enqueue_scripts', 'fancy_lab_scripts' );
/**
*Sets up theme defaults and registers support for various WordPress features.
*
*Note that this function is hooked into the after_setup_theme hook, which
*runs before the init hook, The init hook is too late for some features, such
*as indicating support for post thumbnails.
*/

function fancy_lab_config(){
	register_nav_menus(
		array(
			'fancy_lab_main_menu'  	=> 'Fancy Lab Main Menu',
			'fancy_lab_footer_menu'	=> 'Fancy Lab Footer Menu'
		)
	); 

	add_theme_support('woocommerce', array(
		'thumbnail_image_width'	=> 255,
		'single_image_width'	=> 255,
		'product_grid'			=> array(
			'default_rows'		=> 10,
			'mix_rows'			=> 5,
			'max_rows'			=> 10,
			'default_columns'	=> 1,
			'min_columns'		=> 1,
			"max_columns"		=> 1,
		)
	));
	add_theme_support('wc-product-gallery-zoom');
	add_theme_support('wc-product-gallery-lightbox');
	add_theme_support('wc-product-gallery-slider');
	
	if(!isset( $content_width) ){
		$content_width = 600;
	}
}

add_action('after_setup_theme', 'fancy_lab_config', 0);

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

add_action('woocommerce_before_main_content', 'fancy_lab_add_sidebar_tags', 6);
function fancy_lab_add_sidebar_tags(){
	echo '<div class="sidebar-shop col-lg-3 col-md-4 order-2 order-md-1">';
}
/**
* Remove the main sidebar from its original option
* We'll be including it somewhere else on
*/

remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar' );

//Put the amin WC sidebar back , but using other action hook and on a different position

add_action( 'woocommerce_before_main_content' , 'woocommerce_get_sidebar', 7);

add_action ( 'woocommerce_before_main_content', 'fancy_lab_close_sidebar_tags', 8 );
function fancy_lab_close_sidebar_tags(){
	echo '</div>';
}

// Modify HTML tags on a shop page . we also want Bootstrap-link markup here (.primary div)

add_action ( 'woocommerce_before_main_content', 'fancy_lab_add_shop_taggs', 9 );
function fancy_lab_add_shop_taggs(){
	echo '<div class= "col-lg-9 col-md-8 order-1 order-md-2">';
}

add_action( 'woocommerce_after_main_content', 'fancy_lab_close_shop_tags', 4 );
function fancy_lab_close_shop_tags (){
	echo '</div>';
}