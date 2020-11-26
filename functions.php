<?php

/** GeneratePress
  * Load template for aggregated ratings to display after news post type archive.
  */
add_action('generate_after_archive_title', 'gdrts__generate_after_archive_title');
function gdrts__generate_after_archive_title() {
	if (is_post_type_archive('news')) {
		require_once('parts/news-aggregated.php');
	}
}

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
