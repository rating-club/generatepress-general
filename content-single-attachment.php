<?php

/**
 * The Template for displaying single attachment content.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
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

				do_action( 'generate_before_entry_title' );

				if ( generate_show_title() ) {
					$params = generate_get_the_title_parameters();

					the_title( $params['before'], $params['after'] );
				}

				do_action( 'generate_after_entry_title' );

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
			<?php

			echo wp_get_attachment_link( get_the_ID(), 'full' );

			gdrts_posts_render_rating( array(
				'name' => 'attachment',
				'id'   => get_the_ID(),
				'echo' => true
			), array(
				'alignment' => 'center'
			) );

			?>
        </div>

		<?php

		do_action( 'generate_after_entry_content' );

		do_action( 'generate_after_content' );

		?>
    </div>
</article>
