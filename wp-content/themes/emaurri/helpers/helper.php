<?php

if ( ! function_exists( 'emaurri_is_installed' ) ) {
	/**
	 * Function that checks if forward plugin installed
	 *
	 * @param string $plugin - plugin name
	 *
	 * @return bool
	 */
	function emaurri_is_installed( $plugin ) {

		switch ( $plugin ) {
			case 'framework':
				return class_exists( 'QodeFramework' );
				break;
			case 'core':
				return class_exists( 'EmaurriCore' );
				break;
			case 'woocommerce':
				return class_exists( 'WooCommerce' );
				break;
			case 'gutenberg-page':
				$current_screen = function_exists( 'get_current_screen' ) ? get_current_screen() : array();

				return method_exists( $current_screen, 'is_block_editor' ) && $current_screen->is_block_editor();
				break;
			case 'gutenberg-editor':
				return class_exists( 'WP_Block_Type' );
				break;
			default:
				return false;
		}
	}
}

if ( ! function_exists( 'emaurri_include_theme_is_installed' ) ) {
	/**
	 * Function that set case is installed element for framework functionality
	 *
	 * @param bool $installed
	 * @param string $plugin - plugin name
	 *
	 * @return bool
	 */
	function emaurri_include_theme_is_installed( $installed, $plugin ) {

		if ( 'theme' === $plugin ) {
			return class_exists( 'Emaurri_Handler' );
		}

		return $installed;
	}

	add_filter( 'qode_framework_filter_is_plugin_installed', 'emaurri_include_theme_is_installed', 10, 2 );
}

if ( ! function_exists( 'emaurri_template_part' ) ) {
	/**
	 * Function that echo module template part.
	 *
	 * @param string $module name of the module from inc folder
	 * @param string $template full path of the template to load
	 * @param string $slug
	 * @param array $params array of parameters to pass to template
	 */
	function emaurri_template_part( $module, $template, $slug = '', $params = array() ) {
		echo emaurri_get_template_part( $module, $template, $slug, $params ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

if ( ! function_exists( 'emaurri_get_template_part' ) ) {
	/**
	 * Function that load module template part.
	 *
	 * @param string $module name of the module from inc folder
	 * @param string $template full path of the template to load
	 * @param string $slug
	 * @param array $params array of parameters to pass to template
	 *
	 * @return string - string containing html of template
	 */
	function emaurri_get_template_part( $module, $template, $slug = '', $params = array() ) {
		//HTML Content from template
		$html          = '';
		$template_path = EMAURRI_INC_ROOT_DIR . '/' . $module;

		$temp = $template_path . '/' . $template;
		if ( is_array( $params ) && count( $params ) ) {
			extract( $params ); // @codingStandardsIgnoreLine
		}

		$template = '';

		if ( ! empty( $temp ) ) {
			if ( ! empty( $slug ) ) {
				$template = "{$temp}-{$slug}.php";

				if ( ! file_exists( $template ) ) {
					$template = $temp . '.php';
				}
			} else {
				$template = $temp . '.php';
			}
		}

		if ( $template ) {
			ob_start();
			include( $template ); // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
			$html = ob_get_clean();
		}

		return $html;
	}
}

if ( ! function_exists( 'emaurri_get_page_id' ) ) {
	/**
	 * Function that returns current page id
	 * Additional conditional is to check if current page is any wp archive page (archive, category, tag, date etc.) and returns -1
	 *
	 * @return int
	 */
	function emaurri_get_page_id() {
		$page_id = get_queried_object_id();

		if ( emaurri_is_wp_template() ) {
			$page_id = - 1;
		}

		return apply_filters( 'emaurri_filter_page_id', $page_id );
	}
}

if ( ! function_exists( 'emaurri_is_wp_template' ) ) {
	/**
	 * Function that checks if current page default wp page
	 *
	 * @return bool
	 */
	function emaurri_is_wp_template() {
		return is_archive() || is_search() || is_404() || ( is_front_page() && is_home() );
	}
}

if ( ! function_exists( 'emaurri_get_ajax_status' ) ) {
	/**
	 * Function that return status from ajax functions
	 *
	 * @param string $status - success or error
	 * @param string $message - ajax message value
	 * @param string|array $data - returned value
	 * @param string $redirect - url address
	 */
	function emaurri_get_ajax_status( $status, $message, $data = null, $redirect = '' ) {
		$response = array(
			'status'   => esc_attr( $status ),
			'message'  => esc_html( $message ),
			'data'     => $data,
			'redirect' => ! empty( $redirect ) ? esc_url( $redirect ) : '',
		);

		$output = json_encode( $response );

		exit( $output ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

if ( ! function_exists( 'emaurri_get_button_element' ) ) {
	/**
	 * Function that returns button with provided params
	 *
	 * @param array $params - array of parameters
	 *
	 * @return string - string representing button html
	 */
	function emaurri_get_button_element( $params ) {
		if ( class_exists( 'EmaurriCore_Button_Shortcode' ) ) {
			return EmaurriCore_Button_Shortcode::call_shortcode( $params );
		} else {
			$link   = isset( $params['link'] ) ? $params['link'] : '#';
			$target = isset( $params['target'] ) ? $params['target'] : '_self';
			$text   = isset( $params['text'] ) ? $params['text'] : '';

			return '<a itemprop="url" class="qodef-theme-button" href="' . esc_url( $link ) . '" target="' . esc_attr( $target ) . '"><span class="qodef-m-text">' . esc_html( $text ) . '</span>
			<span class="qodef-m-corner qodef--top-left"></span>
            <span class="qodef-m-corner qodef--top-right"></span>
            <span class="qodef-m-corner qodef--bottom-left"></span>
            <span class="qodef-m-corner qodef--bottom-right"></span></a>';
		}
	}
}

if ( ! function_exists( 'emaurri_render_button_element' ) ) {
	/**
	 * Function that render button with provided params
	 *
	 * @param array $params - array of parameters
	 */
	function emaurri_render_button_element( $params ) {
		echo emaurri_get_button_element( $params ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

if ( ! function_exists( 'emaurri_class_attribute' ) ) {
	/**
	 * Function that render class attribute
	 *
	 * @param string|array $class
	 */
	function emaurri_class_attribute( $class ) {
		echo emaurri_get_class_attribute( $class ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

if ( ! function_exists( 'emaurri_get_class_attribute' ) ) {
	/**
	 * Function that return class attribute
	 *
	 * @param string|array $class
	 *
	 * @return string|mixed
	 */
	function emaurri_get_class_attribute( $class ) {
		$value = emaurri_is_installed( 'framework' ) ? qode_framework_get_class_attribute( $class ) : '';

		return $value;
	}
}

if ( ! function_exists( 'emaurri_get_post_value_through_levels' ) ) {
	/**
	 * Function that returns meta value if exists
	 *
	 * @param string $name name of option
	 * @param int $post_id id of
	 *
	 * @return string value of option
	 */
	function emaurri_get_post_value_through_levels( $name, $post_id = null ) {
		return emaurri_is_installed( 'framework' ) && emaurri_is_installed( 'core' ) ? emaurri_core_get_post_value_through_levels( $name, $post_id ) : '';
	}
}

if ( ! function_exists( 'emaurri_get_space_value' ) ) {
	/**
	 * Function that returns spacing value based on selected option
	 *
	 * @param string $text_value - textual value of spacing
	 *
	 * @return int
	 */
	function emaurri_get_space_value( $text_value ) {
		return emaurri_is_installed( 'core' ) ? emaurri_core_get_space_value( $text_value ) : 0;
	}
}

if ( ! function_exists( 'emaurri_get_social_share_element' ) ) {
	/**
	 * Function that returns social share with provided params
	 *
	 * @param $params array - array of parameters
	 *
	 * @return string - string representing social share html
	 */
	function emaurri_get_social_share_element( $params ) {
		return EmaurriCore_Social_Share_Shortcode::call_shortcode( $params );
	}
}

if ( ! function_exists( 'emaurri_render_social_share_element' ) ) {
	/**
	 * Function that render social share with provided params
	 *
	 * @param $params array - array of parameters
	 */
	function emaurri_render_social_share_element( $params ) {
		echo emaurri_get_social_share_element( $params );
	}
}

if ( ! function_exists( 'emaurri_wp_kses_html' ) ) {
	/**
	 * Function that does escaping of specific html.
	 * It uses wp_kses function with predefined attributes array.
	 *
	 * @param string $type - type of html element
	 * @param string $content - string to escape
	 *
	 * @return string escaped output
	 * @see wp_kses()
	 *
	 */
	function emaurri_wp_kses_html( $type, $content ) {
		return emaurri_is_installed( 'framework' ) ? qode_framework_wp_kses_html( $type, $content ) : $content;
	}
}

if ( ! function_exists( 'emaurri_render_svg_icon' ) ) {
	/**
	 * Function that print svg html icon
	 *
	 * @param string $name - icon name
	 * @param string $class_name - custom html tag class name
	 */
	function emaurri_render_svg_icon( $name, $class_name = '' ) {
		echo emaurri_get_svg_icon( $name, $class_name ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

if ( ! function_exists( 'emaurri_get_svg_icon' ) ) {
	/**
	 * Returns svg html
	 *
	 * @param string $name - icon name
	 * @param string $class_name - custom html tag class name
	 *
	 * @return string|html
	 */
	function emaurri_get_svg_icon( $name, $class_name = '' ) {
		$html  = '';
		$class = isset( $class_name ) && ! empty( $class_name ) ? 'class="' . esc_attr( $class_name ) . '"' : '';

		switch ( $name ) {
			case 'menu':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="64px" height="64px" viewBox="0 0 64 64" enable-background="new 0 0 64 64" xml:space="preserve"><line x1="12" y1="21" x2="52" y2="21"/><line x1="12" y1="33" x2="52" y2="33"/><line x1="12" y1="45" x2="52" y2="45"/></svg>';
				break;
			case 'search':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" width="17.06" height="17.06" viewBox="3.47 3.46 17.06 17.06"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><circle cx="11.11" cy="11.11" r="7.11"/><path d="M20 20l-3.87-3.87"/></g></svg>';
				break;
			case 'star':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="13.78px" height="13.03px" viewBox="0 0 13.78 13.03" enable-background="new 0 0 13.78 13.03" xml:space="preserve"><path d="M9.51,8.06l1.62,4.95L6.9,9.95l-4.21,3.06l1.6-4.95L0.07,4.98h5.22l1.6-4.97l1.62,4.97h5.22L9.51,8.06z"/></svg>';
				break;
			case 'menu-arrow-right':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32" height="32" viewBox="0 0 32 32"><g><path d="M 13.8,24.196c 0.39,0.39, 1.024,0.39, 1.414,0l 6.486-6.486c 0.196-0.196, 0.294-0.454, 0.292-0.71 c0-0.258-0.096-0.514-0.292-0.71L 15.214,9.804c-0.39-0.39-1.024-0.39-1.414,0c-0.39,0.39-0.39,1.024,0,1.414L 19.582,17 L 13.8,22.782C 13.41,23.172, 13.41,23.806, 13.8,24.196z"></path></g></svg>';
				break;
			case 'slider-arrow-left':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="27.67px" height="38.13px" viewBox="0 0 27.67 38.13" xml:space="preserve"><g><line fill="none" stroke="#E1E1E1" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="27.05" y1="27.08" x2="19.05" y2="19.08"/><line fill="none" stroke="#E1E1E1" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="27.05" y1="11.08" x2="19.05" y2="19.08"/></g><g><line fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="0.62" y1="0.58" x2="19.12" y2="19.08"/><line fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="0.62" y1="37.58" x2="19.12" y2="19.08"/></g></svg>';
				break;
			case 'slider-arrow-right':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="27.67px" height="38.13px" viewBox="0 0 27.67 38.13" xml:space="preserve"><g><line fill="none" stroke="#E1E1E1" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="27.05" y1="27.08" x2="19.05" y2="19.08"/><line fill="none" stroke="#E1E1E1" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="27.05" y1="11.08" x2="19.05" y2="19.08"/></g><g><line fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="0.62" y1="0.58" x2="19.12" y2="19.08"/><line fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="0.62" y1="37.58" x2="19.12" y2="19.08"/></g></svg>';
				break;
			case 'pagination-arrow-left':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="27.67px" height="38.13px" viewBox="0 0 27.67 38.13" xml:space="preserve"><g><line fill="none" stroke="#E1E1E1" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="27.05" y1="27.08" x2="19.05" y2="19.08"/><line fill="none" stroke="#E1E1E1" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="27.05" y1="11.08" x2="19.05" y2="19.08"/></g><g><line fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="0.62" y1="0.58" x2="19.12" y2="19.08"/><line fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="0.62" y1="37.58" x2="19.12" y2="19.08"/></g></svg>';
				break;
			case 'pagination-arrow-right':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="27.67px" height="38.13px" viewBox="0 0 27.67 38.13" xml:space="preserve"><g><line fill="none" stroke="#E1E1E1" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="27.05" y1="27.08" x2="19.05" y2="19.08"/><line fill="none" stroke="#E1E1E1" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="27.05" y1="11.08" x2="19.05" y2="19.08"/></g><g><line fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="0.62" y1="0.58" x2="19.12" y2="19.08"/><line fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="0.62" y1="37.58" x2="19.12" y2="19.08"/></g></svg>';
				break;
			case 'full-arrow-left':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="71.14px" height="35.25px" viewBox="0 0 71.14 35.25" enable-background="new 0 0 71.14 35.25" xml:space="preserve"><g><line fill="none" stroke="#E1E1E1" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="70.58" y1="26.05" x2="62.16" y2="17.62"/><line fill="none" stroke="#E1E1E1" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="70.58" y1="9.2" x2="62.16" y2="17.62"/></g><g><g><line fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="45.12" y1="0.59" x2="62.16" y2="17.62"/><line fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="45.12" y1="34.67" x2="62.16" y2="17.62"/></g><line fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="0.58" y1="17.62" x2="62.16" y2="17.62"/></g></svg>';
				break;
			case 'full-arrow-right':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="71.14px" height="35.25px" viewBox="0 0 71.14 35.25" enable-background="new 0 0 71.14 35.25" xml:space="preserve"><g><line fill="none" stroke="#E1E1E1" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="70.58" y1="26.05" x2="62.16" y2="17.62"/><line fill="none" stroke="#E1E1E1" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="70.58" y1="9.2" x2="62.16" y2="17.62"/></g><g><g><line fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="45.12" y1="0.59" x2="62.16" y2="17.62"/><line fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="45.12" y1="34.67" x2="62.16" y2="17.62"/></g><line fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="0.58" y1="17.62" x2="62.16" y2="17.62"/></g></svg>';
				break;
			case 'close':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="23.48px" height="23.47px" viewBox="0 0 23.48 23.47" enable-background="new 0 0 23.48 23.47" xml:space="preserve"><g><path fill="currentColor" d="M13.01,11.76l10.18,10.16c0.18,0.18,0.26,0.39,0.26,0.63s-0.09,0.46-0.26,0.63 c-0.09,0.09-0.2,0.16-0.31,0.2s-0.22,0.06-0.34,0.06c-0.11,0-0.21-0.02-0.33-0.06s-0.21-0.11-0.31-0.2L11.75,13.03L1.59,23.19 c-0.09,0.09-0.2,0.16-0.31,0.2s-0.22,0.06-0.33,0.06c-0.12,0-0.23-0.02-0.34-0.06s-0.21-0.11-0.31-0.2 c-0.18-0.18-0.26-0.39-0.26-0.63s0.09-0.46,0.26-0.63l10.18-10.16L0.3,1.59C0.13,1.41,0.04,1.2,0.04,0.95S0.13,0.5,0.3,0.32	s0.39-0.26,0.64-0.26s0.47,0.09,0.64,0.26l10.16,10.16L21.91,0.32c0.18-0.18,0.39-0.26,0.64-0.26s0.47,0.09,0.64,0.26 s0.26,0.39,0.26,0.63s-0.09,0.46-0.26,0.63L13.01,11.76z"/></g></svg>';
				break;
			case 'spinner':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M304 48c0 26.51-21.49 48-48 48s-48-21.49-48-48 21.49-48 48-48 48 21.49 48 48zm-48 368c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.49-48-48-48zm208-208c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.49-48-48-48zM96 256c0-26.51-21.49-48-48-48S0 229.49 0 256s21.49 48 48 48 48-21.49 48-48zm12.922 99.078c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48c0-26.509-21.491-48-48-48zm294.156 0c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48c0-26.509-21.49-48-48-48zM108.922 60.922c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.491-48-48-48z"></path></svg>';
				break;
			case 'link':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32.06999969482422" height="33.58000183105469" viewBox="0 0 32.06999969482422 33.58000183105469"><g><path d="M 7.54,15.77c 1.278,1.278, 3.158,1.726, 4.868,1.216L 2.96,7.54C 2.652,7.232, 2.49,6.786, 2.49,6.254 c0-0.88, 0.46-2.004, 1.070-2.614c 0.8-0.8, 2.97-1.686, 3.98-0.682l 9.446,9.448c 0.138-0.462, 0.208-0.942, 0.208-1.422 c0-1.304-0.506-2.526-1.424-3.446L 9.364,1.134C 7.44-0.79, 3.616-0.068, 1.734,1.814C 0.642,2.906-0.036,4.598-0.036,6.23 c0,1.268, 0.416,2.382, 1.17,3.136L 7.54,15.77zM 24.46,16.23c-1.278-1.278-3.158-1.726-4.868-1.216l 9.448,9.448c 0.308,0.308, 0.47,0.752, 0.47,1.286 c0,0.88-0.46,2.004-1.070,2.614c-0.8,0.8-2.97,1.686-3.98,0.682L 15.014,19.594c-0.138,0.462-0.208,0.942-0.208,1.422 c0,1.304, 0.506,2.526, 1.424,3.446l 6.404,6.404c 1.924,1.924, 5.748,1.202, 7.63-0.68c 1.092-1.092, 1.77-2.784, 1.77-4.416 c0-1.268-0.416-2.382-1.17-3.136L 24.46,16.23zM 9.164,9.162C 8.908,9.416, 8.768,9.756, 8.768,10.116s 0.14,0.698, 0.394,0.952l 11.768,11.77 c 0.526,0.524, 1.38,0.524, 1.906,0c 0.256-0.254, 0.394-0.594, 0.394-0.954s-0.14-0.698-0.394-0.952L 11.068,9.162 C 10.544,8.638, 9.688,8.638, 9.164,9.162z"></path></g></svg>';
				break;
			case 'quote-mark':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="87.25" height="69.42"><path fill="none" stroke="#EAECE1" stroke-miterlimit="10" d="M39.34 49.57c0 11.6-8.2 19.2-19.2 19.2-11.2 0-19.4-7.8-19.4-19.2 0-5.2.8-9 5.4-20L17.74.77h19.8l-8.8 31.8c6.6 2.8 10.6 8.8 10.6 17zm47.2 0c0 11.6-8.2 19.2-19.2 19.2-11.2 0-19.4-7.8-19.4-19.2 0-5.2.8-9 5.4-20L64.94.77h19.8l-8.8 31.8c6.6 2.8 10.6 8.8 10.6 17z"/></svg>';
				break;
			case 'video-button':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="18.56px" height="36.16px" viewBox="0 0 18.56 36.16" enable-background="new 0 0 18.56 36.16" xml:space="preserve"><polyline fill="none" stroke="currentColor" stroke-miterlimit="10" points="0.56,0.44 17.81,17.69 0.56,34.87 0.56,34.65 "/></svg>';
				break;
			case 'circle':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg"><circle cx="50%" cy="50%" r="49.5%"></circle></svg>';
				break;
		}

		return apply_filters( 'emaurri_filter_svg_icon', $html );
	}
}
