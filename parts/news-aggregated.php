<div style="margin-top: 1em; padding-top: 1em; border-top: 1px solid #ddd;">
	<h4>
		Aggregated emotes for all the News
	</h4>
	<?php

	/* Get aggregated rating of all posts belonging to specified term */
	$rating = gdrts_aggregate()->posts_by_type('news', array(
		'method'     => 'emote-this',
		'series'     => 'default'
	));

	/* Render the custom static emote block from the aggregated result */
	$elements = wp_list_pluck($rating->elements, 'votes');

	echo gdrts_render_custom_emotes_block(array(
		'series'          => 'default',
		'elements'        => $elements,
		'style_size'      => 48,
		'style_theme'     => 'standard-overlay',
    ));

	?>
	<p>
		From <?php echo $rating->items; ?> posts and <?php echo $rating->votes; ?> votes.
	</p>
</div>