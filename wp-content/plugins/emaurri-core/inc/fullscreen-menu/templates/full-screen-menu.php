<div id="qodef-fullscreen-area">
	<?php if ( $fullscreen_menu_in_grid ) { ?>
	<div class="qodef-content-grid">
	<?php } ?>

		<div id="qodef-fullscreen-area-inner">
			<?php if ( has_nav_menu( 'fullscreen-menu-navigation' ) ) { ?>
				<nav class="qodef-fullscreen-menu">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'fullscreen-menu-navigation',
							'container'      => '',
							'link_before'    => '<span class="qodef-menu-item-text">',
							'link_after'     => '</span>',
							'walker'         => new EmaurriCoreRootMainMenuWalker(),
						)
					);
					?>
				</nav>
			<?php } ?>
			<div class="qodef-fullscreen-menu-overlay-close-holder"></div>
		</div>

	<?php if ( $fullscreen_menu_in_grid ) { ?>
	</div>
	<?php } ?>
</div>
