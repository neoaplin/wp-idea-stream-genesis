<?php
global $wp_idea_stream_submit_errors, $current_user;
if(!wp_verify_nonce($_POST['wp-ideastream-check'],'wp-ideastream-check-referrer')){
	wp_die(__('You need to use the IdeaStream form to submit an idea', 'wp-idea_stream'));
}
if( !is_user_logged_in() ){
	wp_die(__('You need to be a member of this site to submit an idea', 'wp-idea_stream'));
}

if(!$_POST["_wp_is_title"]){
	$wp_idea_stream_submit_errors[] = __('Title is required','wp-idea-stream');
}
if(!$_POST["content"]){
	$wp_idea_stream_submit_errors[] = __('Content is required','wp-idea-stream');
}
if(!$_POST["_wp_is_category"] || count($_POST["_wp_is_category"])==0){
	$wp_idea_stream_submit_errors[] = __('Category is required','wp-idea-stream');
}

do_action('wp_idea_stream_check_extra_fields');


if(count($wp_idea_stream_submit_errors)>0){
	return false;
}

// On enregistre

$post_title = wp_kses($_POST["_wp_is_title"], array());
$post_content = wp_kses($_POST["content"], wp_idea_stream_allowed_html_tags());
$post_author = $current_user->ID;
$post_category = $_POST["_wp_is_category"];

$idea_status = get_option('_ideastream_submit_status');
if(!$idea_status || $idea_status=="") $idea_status = 'publish';

$post = array(
'post_author'	=> $post_author,
'post_title'	=> $post_title,
'post_content'	=> $post_content,
'post_status'	=> $idea_status,
'post_type'		=> 'ideas'
);
$post_id = wp_insert_post($post);

do_action('wp_idea_stream_save_extra_fieds', $post_id);

//set category
if($post_category) wp_set_post_terms( $post_id, $post_category, 'category-ideas', false);

//set tags :
if($_POST['_wp_is_tags']) wp_set_post_terms( $post_id, str_replace(' ',',', $_POST['_wp_is_tags']), 'tag-ideas', false);

//redirect to published idea
if($idea_status == 'publish') wp_redirect( get_permalink($post_id) );
else wp_redirect( wp_idea_stream_new_form().'?moderation=1');
die();
?>