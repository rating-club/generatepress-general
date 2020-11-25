<?php

/** GeneratePress:
  * Enable entry meta block for 'news' and 'article' post types.
  */
add_filter('generate_entry_meta_post_types', 'gdrts__generate_entry_meta_post_types' );
add_filter( 'generate_footer_meta_post_types', 'gdrts__generate_entry_meta_post_types' );
function gdrts__generate_entry_meta_post_types( $types ) {
	$types[] = 'news';
	$types[] = 'article';

	return $types;
}

/** WordPress:
  * Add 'news' and 'article' post types into category and tags archives.
  */
add_filter( 'pre_get_posts', 'gdrts__pre_get_posts' );
function gdrts__pre_get_posts( $query ) {
	if ( is_category() || is_tag() ) {
		$query->set( 'post_type', array( 'post', 'news', 'article' ) );

		return $query;
	}
}
