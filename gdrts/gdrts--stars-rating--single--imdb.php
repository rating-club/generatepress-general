<?php // GDRTS Template: IMDb Inspired // ?>

<div class="<?php gdrts_loop()->render()->classes(); ?>">
    <div class="gdrts-inner-wrapper">

		<?php do_action( 'gdrts-template-rating-block-before' ); ?>

        <div class="gdrts-layout-rating">
            <div class="gdrts-layout-rating-badge">

				<?php gdrts_loop()->render()->badge(); ?>

                <div class="gdrts-rating-text" style="text-align: center;">
					<?php

					if ( gdrts_loop()->render()->has_votes() ) {
						$votes = gdrtsm_stars_rating()->value( 'votes', false );
						echo sprintf( _n( "Based on %s vote", "Based on %s votes", $votes, "gd-rating-system" ), '<strong>' . $votes . '</strong>' );
					} else {
						_e( "No votes yet.", "gd-rating-system" );
					}

					?>
                </div>

            </div>
            <div class="gdrts-layout-rating-main">

				<?php gdrts_loop()->render()->stars( array( 'show_rating' => 'own' ) ); ?>

				<?php

				if ( gdrts_loop()->user()->has_voted() ) {

					?>

                    <div class="gdrts-rating-user">
						<?php gdrts_loop()->render()->vote_from_user(); ?>
                    </div>

					<?php

				}

				if ( gdrts_loop()->is_save() ) {

					?>

                    <div class="gdrts-rating-thanks">
						<?php _e( "Thanks for your vote!", "gd-rating-system" ); ?>
                    </div>

					<?php

				}

				gdrts_loop()->please_wait();

				?>

                <div class="gdrts-rating-distribution">
					<?php gdrts_loop()->render()->distribution(); ?>
                </div>

            </div>
        </div>

		<?php

		gdrts_loop()->json();

		do_action( 'gdrts-template-rating-block-after' );
		do_action( 'gdrts-template-rating-rich-snippet' );

		?>

    </div>
</div>