<?php
/*
 * Plugin Name: Elementor Collapsible Link List
 * Plugin URI: https://w4dev.com
 * Description: Custom widget for elementor
 * Version: 1.1.0
 * Author: Shazzad Hossain Khan
 * Author URI: https://shazzad.me
*/


add_action( 'elementor/init', 'ecll_load');

function ecll_load() {
	// Here its safe to include our action class file
	add_action( 'elementor/widgets/widgets_registered', 'ecll_register_elementor_widgets' );
	add_action( 'elementor/frontend/after_register_scripts', 'ecll_widget_scripts' );
}

function ecll_widget_scripts() {
	wp_register_script( 'ecll-frontend', plugins_url( 'frontend.js', __FILE__ ), array( 'jquery' ) );
	wp_enqueue_script( 'ecll-frontend' );
}

function ecll_register_elementor_widgets( $widgets_manager ) {
	include_once( dirname( __FILE__ ) . '/class-elementor-collapsible-link-list.php' );
	$widgets_manager->register_widget_type( new Elementor_Collapsible_Link_List_Widget() );
}
