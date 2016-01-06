<?php
	/* The footer widget area is triggered if any of the areas
	 * have widgets. So let's check that first.
	 *
	 * If none of the sidebars have widgets, then let's bail early.
	 */
	if (   ! is_active_sidebar( 'footer1'  )
		&& ! is_active_sidebar( 'footer2' )
		&& ! is_active_sidebar( 'footer3'  )
		&& ! is_active_sidebar( 'footer4' )
	)
		return;
	// If we get this far, we have widgets. Let do this.
?>

			

<?php if ( is_active_sidebar( 'footer1' ) ) : ?>
				<div class="threecol first">
					
						<?php dynamic_sidebar( 'footer1' ); ?>
					
				</div><!-- #first .widget-area -->
<?php endif; ?>

<?php if ( is_active_sidebar( 'footer2' ) ) : ?>
				<div class="threecol">
					
						<?php dynamic_sidebar( 'footer2' ); ?>
					
				</div><!-- #second .widget-area -->
<?php endif; ?>

<?php if ( is_active_sidebar( 'footer3' ) ) : ?>
				<div class="threecol">
					
						<?php dynamic_sidebar( 'footer3' ); ?>
					
				</div><!-- #third .widget-area -->
<?php endif; ?>

<?php if ( is_active_sidebar( 'footer4' ) ) : ?>
				<div class="threecol last">
					
						<?php dynamic_sidebar( 'footer4' ); ?>
					
				</div><!-- #third .widget-area -->
<?php endif; ?>

			
