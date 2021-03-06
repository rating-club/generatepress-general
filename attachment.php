<?php

/**
 * The Template for displaying single attachment.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header(); ?>

    <div id="primary" <?php generate_do_element_classes( 'content' ); ?>>
        <main id="main" <?php generate_do_element_classes( 'main' ); ?>>
			<?php

			do_action( 'generate_before_main_content' );

			if ( generate_has_default_loop() ) {
				while ( have_posts() ) :

					the_post();

					get_template_part( 'content-single', 'attachment' );

				endwhile;
			}

			do_action( 'generate_after_main_content' );

			?>
        </main>
    </div>

<?php

do_action( 'generate_after_primary_content_area' );

generate_construct_sidebars();

get_footer();
