<div style="margin-top: 1em; padding-top: 1em; border-top: 1px solid #ddd;">
    <h4>
        Aggregated Rating for the Author
    </h4>
	<?php

	/* Get current queries user object */
	$user = get_queried_object();

	/* Get aggregated rating of all posts belonging to specified term */
	$rating = gdrts_aggregate()->posts_by_author( $user->ID, array(
		'method'    => 'stars-rating',
		'post_type' => 'post'
	) );

	/* Render the custom static stars with the max stars of 5, and specified rating from the aggregated result */
	echo gdrts_render_custom_stars_block( array(
		'stars'      => 5,
		'rating'     => $rating->rating,
		'style_size' => 48
	) );

	?>
    <p>
        From <?php echo $rating->items; ?> posts and <?php echo $rating->votes; ?> votes.
    </p>
</div>