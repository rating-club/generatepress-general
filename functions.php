<?php

/** GD Rating System Pro
 * Display slider rating value badge in the archives.
 */
add_action( 'generate_after_entry_content', 'gdrts__generate_after_entry_content_slider_badge', 5 );
function gdrts__generate_after_entry_content_slider_badge() {
	if ( is_post_type_archive( 'article' ) ) {
		$item   = gdrts_get_rating_item_by_post();
		$rating = $item->get_method_data( 'slider-rating' );

		if ( ! empty( $rating ) ) {
			echo '<div class="slider-rating-archive">';
			echo '<span>' . absint( $rating['rating'] ) . '%</span>';
			echo sprintf( _n( "%s vote", "%s votes", $rating['votes'] ), $rating['votes'] );
			echo '</div>';
		}
	}
}

/** GD Rating System Pro
 * Display active stars rating block in the archives.
 */
add_action( 'generate_after_entry_content', 'gdrts__generate_after_entry_content_stars_block', 5 );
function gdrts__generate_after_entry_content_stars_block() {
	if ( is_posts_page() ) {
		echo '<div class="stars-rating-archive">';
		gdrts_posts_render_rating( array( 'echo' => true ) );
		echo '</div>';
	}
}

/** GeneratePress
 * Load template for aggregated ratings to display after news post type archive.
 */
add_action( 'generate_after_archive_title', 'gdrts__generate_after_archive_title' );
function gdrts__generate_after_archive_title() {
	if ( is_post_type_archive( 'news' ) ) {
		require_once( 'parts/news-aggregated.php' );
	}
}

/** GeneratePress:
 * Enable entry meta block for 'news' and 'article' post types.
 */
add_filter( 'generate_entry_meta_post_types', 'gdrts__generate_entry_meta_post_types' );
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

function gdrts__get_post_attached_images_ids() {
	global $wpdb;

	$sql   = "SELECT a.ID FROM $wpdb->posts a INNER JOIN $wpdb->posts p ON a.post_parent = p.ID WHERE a.post_type = 'attachment' AND p.post_type = 'post'";
	$items = $wpdb->get_results( $sql );

	return wp_list_pluck( $items, 'ID' );
}