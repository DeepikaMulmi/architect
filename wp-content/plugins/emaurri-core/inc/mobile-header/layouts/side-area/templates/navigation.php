<?php if ( has_nav_menu( 'mobile-navigation' ) || has_nav_menu( 'main-navigation' ) ) { ?>
	<div id="qodef-side-area-mobile-header" class="qodef-m">
		<?php
		emaurri_core_get_opener_icon_html(
			array(
				'option_name'  => 'mobile_menu',
				'custom_class' => 'qodef-m-close',
			),
			false,
			true
		);
		?>
		<nav class="qodef-m-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Mobile Menu', 'emaurri-core' ); ?>">
			<?php
			// Set main navigation menu as mobile if mobile navigation is not set
			$theme_location = has_nav_menu( 'mobile-navigation' ) ? 'mobile-navigation' : 'main-navigation';

			wp_nav_menu(
				array(
					'theme_location' => $theme_location,
					'container'      => '',
					'link_before'    => '<span class="qodef-menu-item-text">',
					'link_after'     => '</span>',
					'walker'         => new EmaurriCoreRootMainMenuWalker(),
				)
			);
			?>
		</nav>
		<?php
		// Include mobile widget area one
		if ( is_active_sidebar( 'qodef-mobile-header-widget-area' ) ) { ?>
			<div class="qodef-widget-holder qodef--one">
				<?php dynamic_sidebar( 'qodef-mobile-header-widget-area' ); ?>
			</div>
		<?php } ?>
	</div>
<?php } ?>
