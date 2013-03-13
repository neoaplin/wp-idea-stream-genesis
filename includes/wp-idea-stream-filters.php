<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

add_filter( 'mce_external_plugins', 'wp_idea_stream_tinymce_plugin' );

function wp_idea_stream_tinymce_plugin( $plugin_array ) {
	if( is_new_idea() ){
		(1 == wp_idea_stream_editor_settings( 'image' ) ) ? $plugin_array['WPideaStreamImg'] = WP_IDEA_STREAM_PLUGIN_URL_JS .'/img/editor_plugin.js' : false ;
		(1 == wp_idea_stream_editor_settings( 'link' ) ) ? $plugin_array['WPideaStreamLink'] = WP_IDEA_STREAM_PLUGIN_URL_JS .'/link/editor_plugin.js' : false ;
		
	}
   
	return $plugin_array;
}

add_filter( 'mce_buttons', 'wp_idea_stream_register_mce_button' );

function wp_idea_stream_register_mce_button($buttons) {
	if( is_new_idea() ) {
		$config_string = array();
		
		if( 1 == wp_idea_stream_editor_settings( 'image' ) )
			$config_string[]= " WPideaStreamImg";
		
		if( 1 == wp_idea_stream_editor_settings( 'link' ) )
			$config_string[]= " WPideaStreamLink";
			
		if( count( $config_string ) >= 1 ) {
			$config = ' separator,' . implode(',', $config_string ); 
			array_push( $buttons, $config );
		}
		
	}
	
	return $buttons;
}



add_filter('mce_buttons', 'wp_idea_stream_teeny_button_filter', 9, 1);

function wp_idea_stream_teeny_button_filter($buttons){
	if( is_new_idea() ) {
		$config_string = array();
		$config = '';
		if( 1 == wp_idea_stream_editor_settings( 'image' ) )
			$config_string[]= "WPideaStreamImg";
		
		if( 1 == wp_idea_stream_editor_settings( 'link' ) )
			$config_string[]= "WPideaStreamLink, unlink";
			
		if( count( $config_string ) >= 1 ) {
			$config = implode(',', $config_string ) .','; 
		}
		
		return array('bold, italic, underline, blockquote, separator, strikethrough, bullist, numlist,justifyleft, justifycenter, justifyright, undo, redo, '.$config.' fullscreen');
	}
	
	else return $buttons;
}

add_filter( 'wpis_editor_the_title', 'wp_idea_stream_the_title_filter', 1, 1 );

function wp_idea_stream_the_title_filter( $title ) {
	return wp_kses( stripslashes( $title ), array() );
}

add_filter( 'wpis_editor_the_content', 'wp_idea_stream_the_content_filter', 1, 1 );

function wp_idea_stream_the_content_filter( $content ) {
	$allowedhtml = wp_idea_stream_allowed_html_tags();
	
	return wp_kses( stripslashes( $content ), $allowedhtml );
}
