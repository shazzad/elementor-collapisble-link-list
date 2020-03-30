<?php
/*
 * Plugin Name: Collapsible Link List
 * Plugin URI: https://w4dev.com
 * Description: Custom widget for image text flip
 * Version: 1.0.0
 * Author: Shazzad Hossain Khan
 * Author URI: https://shazzad.me
*/


add_action( 'elementor/init', 'coll_load');

function coll_load() {
	// Here its safe to include our action class file
	add_action( 'elementor/widgets/widgets_registered', 'coll_register_elementor_widgets' );
	add_action( 'elementor/frontend/after_register_scripts', 'coll_widget_scripts' );
}

function coll_widget_scripts() {
	wp_register_style( 'coll-frontend', plugins_url( 'frontend.css', __FILE__ ) );
	wp_register_script( 'coll-frontend', plugins_url( 'frontend.js', __FILE__ ), array( 'jquery' ) );
	wp_enqueue_style( 'coll-frontend' );
	wp_enqueue_script( 'coll-frontend' );
}

function coll_register_elementor_widgets( $widgets_manager ) {
	include_once( dirname( __FILE__ ) . '/class-elementor-collapsible-link-list.php' );
	$widgets_manager->register_widget_type( new Elementor_Collapsible_Link_List_Widget() );
}
