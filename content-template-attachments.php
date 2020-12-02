<?php

/**
 * The Template for displaying content of the Featured Images template.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php generate_do_microdata( 'article' ); ?>>
    <div class="inside-article">
		<?php

		do_action( 'generate_before_content' );

		if ( generate_show_entry_header() ) :
			?>

            <header class="entry-header">
				<?php

				do_action( 'generate_before_page_title' );

				if ( generate_show_title() ) {
					$params = generate_get_the_title_parameters();

					the_title( $params['before'], $params['after'] );
				}

				do_action( 'generate_after_page_title' );

				?>
            </header>

		<?php
		endif;

		do_action( 'generate_after_entry_header' );

		$itemprop = '';

		if ( 'microdata' === generate_get_schema_type() ) {
			$itemprop = ' itemprop="text"';
		}

		?>

        <div class="entry-content"<?php echo $itemprop; // phpcs:ignore -- No escaping needed. ?>>
            <p>
                This demo page shows the list of featured images for the blog posts. And, using stars rating method, you can rate individual images (not their posts!). All images belong to the 'attachment' post type, and you only need to know the attachment ID to display rating block. And, if you click on the individual images, you will go the image own page where you can also see it's rating block.
            </p>
            <div class="featured-images-container">
				<?php

				$ids    = gdrts__get_post_attached_images_ids();
				$images = get_posts( array( 'post_type' => 'attachment', 'include' => $ids ) );

				foreach ( $images as $img ) {

					?>

                    <div class="featured-image-single">
						<?php echo wp_get_attachment_link( $img->ID, 'thumbnail', true ); ?>
                        <h5><?php echo $img->post_title; ?></h5>
						<?php

						gdrts_posts_render_rating( array(
							'name' => 'attachment',
							'id'   => $img->ID,
							'echo' => true
						), array(
							'alignment' => 'center'
						) );

						?>
                    </div>

					<?php
				}

				?>
            </div>

			<?php the_content(); ?>
        </div>

		<?php

		do_action( 'generate_after_content' );

		?>
    </div>
</article>
