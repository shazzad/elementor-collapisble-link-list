<?php
/*
 * Plugin Name:       Elementor Collapsible Link List
 * Plugin URI:        https://w4dev.com
 * Description:       Custom widget for elementor
 * Version:           1.2.3
 * Requires at least: 5.5.3
 * Requires PHP:      7.2
 * Author:            Shazzad Hossain Khan
 * Author URI:        https://shazzad.me
*/

/**
 * Load widgets on elementor init.
 */
function ecll_load() {
	add_action( 'elementor/widgets/widgets_registered', 'ecll_register_elementor_widgets' );
	add_action( 'elementor/frontend/after_register_scripts', 'ecll_widget_scripts' );
}
add_action( 'elementor/init', 'ecll_load');

/**
 * Register additional widget
 */
function ecll_register_elementor_widgets( $widgets_manager ) {
	include_once( dirname( __FILE__ ) . '/class-elementor-collapsible-link-list.php' );
	$widgets_manager->register_widget_type( new Elementor_Collapsible_Link_List_Widget() );
}

/**
 * Register Scripts
 */
function ecll_widget_scripts() {
	wp_register_style( 'ecll-frontend', plugins_url( 'frontend.css', __FILE__ ) );
	wp_enqueue_style( 'ecll-frontend' );

	wp_register_script( 'ecll-frontend', plugins_url( 'frontend.js', __FILE__ ), array( 'jquery' ) );
	wp_enqueue_script( 'ecll-frontend' );
}
