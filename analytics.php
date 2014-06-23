<?php
/**
 * Plugin Name: Analytics
 * Description: Simple Google Analytics implementation
 * Version: 1.0
 * Author: Bradley Taylor
 */

//load the analytics
function  load_analytics(){
	$value = get_option( "analytics-options", "" );
	if (is_array($value)){
		$tracking = $value['tracking-id'];
		$domain = $value['domain-id'];
		include 'script.php';
	}
}
 
add_action ('wp_footer', 'load_analytics');



//Register Admin Page
function analytics_menu() {
	add_options_page('analytics', 'Analytics', 'manage_options', 'analytics-options', 'analytics_options' );
}
//register settings
function register_settings() { 
	register_setting( 'analytics-options', 'analytics-options' );
	add_settings_section( 'analytics-main', 'Analytics Main', 'draw_analytics_main', 'analytics-options' );
	add_settings_field( 'tracking-id', 'Enter Your Tracking Id', 'draw_tracking_id', 'analytics-options', 'analytics-main', array('label_for' => 'tracking-id') );
	add_settings_field( 'domain-id', 'Enter Your Domain', 'draw_domain_id', 'analytics-options', 'analytics-main', array('label_for' => 'domain-id') );
}
function draw_analytics_main(){
	echo 'Please enter your data from when you signed up to Google analytics';
}
function draw_tracking_id(){
	$value = get_option( "analytics-options", "" );
	if (is_array($value)){
		$value = $value['tracking-id'];
	}
	echo '<input type="text" name="analytics-options[tracking-id]" id="tracking-id" value="'.$value.'"></input>';
}
function draw_domain_id(){
	$value = get_option( "analytics-options", "" );
	if (is_array($value)){
		$value = $value['domain-id'];
	}
	echo '<input type="text" name="analytics-options[domain-id]" id="domain-id" value="'.$value.'"></input>';
}

if (is_admin()){ 
	add_action('admin_menu', 'analytics_menu' );
	add_action('admin_init', 'register_settings' );
}

function analytics_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	include 'settings.php';
}
?>