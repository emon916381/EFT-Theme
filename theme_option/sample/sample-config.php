<?php
/**
 * ReduxFramework Sample Config File
 * For full documentation, please visit: http://docs.reduxframework.com/
 *
 * @package Redux Framework
 */

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Redux' ) ) {
	return;
}

// This is your option name where all the Redux data is stored.
$opt_name = 'redux_demo';  // YOU MUST CHANGE THIS.  DO NOT USE 'redux_demo' IN YOUR PROJECT!!!

// Uncomment to disable demo mode.
/* Redux::disable_demo(); */  // phpcs:ignore Squiz.PHP.CommentedOutCode

/*
 * --> Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
 */

$sample_html = '';
if ( file_exists( dirname( __FILE__ ) . '/info-html.html' ) ) {
	ob_start();

	include dirname( __FILE__ ) . '/info-html.html';

	$sample_html = ob_get_clean();
}

// Background Patterns Reader.
$sample_patterns_path = Redux_Core::$dir . '../sample/patterns/';
$sample_patterns_url  = Redux_Core::$url . '../sample/patterns/';
$sample_patterns      = array();

if ( is_dir( $sample_patterns_path ) ) {
	$sample_patterns_dir = opendir( $sample_patterns_path );

	if ( $sample_patterns_dir ) {
		$sample_patterns = array();

		// phpcs:ignore WordPress.CodeAnalysis.AssignmentInCondition
		while ( false !== ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) ) {
			if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
				$name              = explode( '.', $sample_patterns_file );
				$name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
				$sample_patterns[] = array(
					'alt' => $name,
					'img' => $sample_patterns_url . $sample_patterns_file,
				);
			}
		}
	}
}

// Used to execept HTML tags in description arguments where esc_html would remove.
$kses_exceptions = array(
	'a'      => array(
		'href' => array(),
	),
	'strong' => array(),
	'br'     => array(),
	'code'   => array(),
);

/*
 * ---> BEGIN ARGUMENTS
 */

/**
 * All the possible arguments for Redux.
 * For full documentation on arguments, please refer to: https://docs.reduxframework.com/core/arguments/
 */
$theme = wp_get_theme(); // For use with some settings. Not necessary.

// TYPICAL -> Change these values as you need/desire.
$args = array(
	// This is where your data is stored in the database and also becomes your global variable name.
	'opt_name'                  => $opt_name,

	// Name that appears at the top of your panel.
	'display_name'              => 'EFT Theme Option',

	// Version that appears at the top of your panel.
	'display_version'           => $theme->get( 'Version' ),

	// Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only).
	'menu_type'                 => 'menu',

	// Show the sections below the admin menu item or not.
	'allow_sub_menu'            => true,

	// The text to appear in the admin menu.
	'menu_title'                => esc_html__( 'EFT Option', 'your-domain-here' ),

	// The text to appear on the page title.
	'page_title'                => esc_html__( 'EFT Option', 'your-domain-here' ),

	// Enabled the Webfonts typography module to use asynchronous fonts.
	'async_typography'          => false,

	// Disable to create your own google fonts loader.
	'disable_google_fonts_link' => false,

	// Show the panel pages on the admin bar.
	'admin_bar'                 => true,

	// Icon for the admin bar menu.
	'admin_bar_icon'            => 'dashicons-portfolio',

	// Priority for the admin bar menu.
	'admin_bar_priority'        => 50,

	// Sets a different name for your global variable other than the opt_name.
	'global_variable'           => 'eft_option',

	// Show the time the page took to load, etc (forced on while on localhost or when WP_DEBUG is enabled).
	'dev_mode'                  => true,

	// Enable basic customizer support.
	'customizer'                => true,

	// Allow the panel to opened expanded.
	'open_expanded'             => false,

	// Disable the save warning when a user changes a field.
	'disable_save_warn'         => false,

	// Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
	'page_priority'             => 63,

	// For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters.
	'page_parent'               => 'themes.php',

	// Permissions needed to access the options panel.
	'page_permissions'          => 'manage_options',

	// Specify a custom URL to an icon.
	'menu_icon'                 => '',

	// Force your panel to always open to a specific tab (by id).
	'last_tab'                  => '',

	// Icon displayed in the admin panel next to your menu_title.
	'page_icon'                 => 'icon-themes',

	// Page slug used to denote the panel, will be based off page title, then menu title, then opt_name if not provided.
	'page_slug'                 => $opt_name,

	// On load save the defaults to DB before user clicks save.
	'save_defaults'             => true,

	// Display the default value next to each field when not set to the default value.
	'default_show'              => false,

	// What to print by the field's title if the value shown is default.
	'default_mark'              => '*',

	// Shows the Import/Export panel when not used as a field.
	'show_import_export'        => true,

	// The time transinets will expire when the 'database' arg is set.
	'transient_time'            => 60 * MINUTE_IN_SECONDS,

	// Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output.
	'output'                    => true,

	// Allows dynamic CSS to be generated for customizer and google fonts,
	// but stops the dynamic CSS from going to the page head.
	'output_tag'                => true,

	// Disable the footer credit of Redux. Please leave if you can help it.
	'footer_credit'             => 'EFT - Theme Option',

	// If you prefer not to use the CDN for ACE Editor.
	// You may download the Redux Vendor Support plugin to run locally or embed it in your code.
	'use_cdn'                   => true,

	// Set the theme of the option panel.  Use 'classic' to rever to the Redux 3 style.
	'admin_theme'               => 'wp_',

	// HINTS.
	'hints'                     => array(
		'icon'          => 'el el-question-sign',
		'icon_position' => 'right',
		'icon_color'    => 'lightgray',
		'icon_size'     => 'normal',
		'tip_style'     => array(
			'color'   => 'red',
			'shadow'  => true,
			'rounded' => false,
			'style'   => '',
		),
		'tip_position'  => array(
			'my' => 'top left',
			'at' => 'bottom right',
		),
		'tip_effect'    => array(
			'show' => array(
				'effect'   => 'slide',
				'duration' => '500',
				'event'    => 'mouseover',
			),
			'hide' => array(
				'effect'   => 'slide',
				'duration' => '500',
				'event'    => 'click mouseleave',
			),
		),
	),

	// FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
	// possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
	'database'                  => '',
	'network_admin'             => true,
);


// ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
// PLEASE CHANGE THEME BEFORE RELEASEING YOUR PRODUCT!!
// If these are left unchanged, they will not display in your panel!
$args['admin_bar_links'][] = array(
	'id'    => 'redux-docs',
	'href'  => '//docs.redux.io/',
	'title' => __( 'Documentation', 'your-domain-here' ),
);

$args['admin_bar_links'][] = array(
	'id'    => 'redux-support',
	'href'  => '//github.com/ReduxFramework/redux-framework/issues',
	'title' => __( 'Support', 'your-domain-here' ),
);

$args['admin_bar_links'][] = array(
	'id'    => 'redux-extensions',
	'href'  => 'redux.io/extensions',
	'title' => __( 'Extensions', 'your-domain-here' ),
);

// SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
// PLEASE CHANGE THEME BEFORE RELEASEING YOUR PRODUCT!!
// If these are left unchanged, they will not display in your panel!
$args['share_icons'][] = array(
	'url'   => '//github.com/ReduxFramework/ReduxFramework',
	'title' => 'Visit us on GitHub',
	'icon'  => 'el el-github',
);
$args['share_icons'][] = array(
	'url'   => '//www.facebook.com/pages/Redux-Framework/243141545850368',
	'title' => 'Like us on Facebook',
	'icon'  => 'el el-facebook',
);
$args['share_icons'][] = array(
	'url'   => '//twitter.com/reduxframework',
	'title' => 'Follow us on Twitter',
	'icon'  => 'el el-twitter',
);
$args['share_icons'][] = array(
	'url'   => '//www.linkedin.com/company/redux-framework',
	'title' => 'Find us on LinkedIn',
	'icon'  => 'el el-linkedin',
);

// Panel Intro text -> before the form.
if ( ! isset( $args['global_variable'] ) || false !== $args['global_variable'] ) {
	if ( ! empty( $args['global_variable'] ) ) {
		$v = $args['global_variable'];
	} else {
		$v = str_replace( '-', '_', $args['opt_name'] );
	}

	// translators:  Panel opt_name.
	$args['intro_text'] = '<p>' . sprintf( esc_html__( 'Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: $%1$s', 'your-domain-here' ), '<strong>' . $v . '</strong>' ) . '<p>';
} else {
	$args['intro_text'] = '<p>' . esc_html__( 'This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.', 'your-domain-here' ) . '</p>';
}

// Add content after the form.
$args['footer_text'] = '<p>' . esc_html__( 'EFT theme option. You change everything here ', 'your-domain-here' ) . '</p>';

Redux::set_args( $opt_name, $args );

/*
 * ---> END ARGUMENTS
 */

/*
 * ---> START HELP TABS
 */
$help_tabs = array(
	array(
		'id'      => 'redux-help-tab-1',
		'title'   => esc_html__( 'Theme Information 1', 'your-domain-here' ),
		'content' => '<p>' . esc_html__( 'This is the tab content, HTML is allowed.', 'your-domain-here' ) . '</p>',
	),
	array(
		'id'      => 'redux-help-tab-2',
		'title'   => esc_html__( 'Theme Information 2', 'your-domain-here' ),
		'content' => '<p>' . esc_html__( 'This is the tab content, HTML is allowed.', 'your-domain-here' ) . '</p>',
	),
);
Redux::set_help_tab( $opt_name, $help_tabs );

// Set the help sidebar.
$content = '<p>' . esc_html__( 'This is the sidebar content, HTML is allowed.', 'your-domain-here' ) . '</p>';

Redux::set_help_sidebar( $opt_name, $content );

/*
 * <--- END HELP TABS
 */

/*
 * ---> START SECTIONS
 */

 // -> START Color Selection.
Redux::set_section(
	$opt_name,
	array(
		'title' => esc_html__( 'Color Selection', 'eft-domain' ),
		'id'    => 'color',
		'icon'  => 'el el-brush',
	)
);

Redux::set_section(
	$opt_name,
	array(
		'title'      => esc_html__( 'Color', 'eft-domain' ),
		'id'         => 'eft-all-color',
		'desc'       => esc_html__( ' You can change your theme\'s all color here', 'eft-domain'),
		'subsection' => true,
		'fields'     => array(
			array(
				'id'          => 'eft-bg-color',
				'type'        => 'color',
				'title'       => esc_html__( 'Site Background Color', 'eft-domain' ),
				'subtitle'    => esc_html__( 'Pick a Background color for the theme (default: #343a40).', 'eft-domain' ),
				'default'     => '#343a40',
				'color_alpha' => true,
			),
			array(
				'id'       => 'eft-layout',
				'type'     => 'color',
				'title'    => esc_html__( 'Content Background Color', 'eft-domain' ),
				'subtitle' => esc_html__( 'Pick a Background color for the content background (default: #2b3035).', 'eft-domain' ),
				'default'  => '#2b3035',
				'validate' => 'color',
			),
			array(
				'id'       => 'eft-cont-head',
				'type'     => 'color',
				'title'    => esc_html__( 'Article Title Color', 'eft-domain' ),
				'subtitle' => esc_html__( 'Pick a Article Title Color (default: #d0d0cb).', 'eft-domain' ),
				'default'  => '#d0d0cb',
				'validate' => 'color',
			),
			array(
				'id'       => 'eft-link',
				'type'     => 'color',
				'title'    => esc_html__( 'Link Color', 'eft-domain' ),
				'subtitle' => esc_html__( 'Pick a Link Color (default: #bbbbbb).', 'eft-domain' ),
				'default'  => '#bbbbbb',
				'validate' => 'color',
			),
			array(
				'id'       => 'link-hover-color',
				'type'     => 'color',
				'title'    => esc_html__( 'Link Hover Color', 'eft-domain' ),
				'subtitle' => esc_html__( 'Pick a Link Effect Color (default: #ffffff).', 'eft-domain' ),
				'default'  => '#ffffff',
				'validate' => 'color',
			),
			array(
				'id'       => 'eft-quote',
				'type'     => 'color',
				'title'    => esc_html__( 'Quote Bar Color', 'eft-domain' ),
				'subtitle' => esc_html__( 'Pick a Quote Bar Color (default: #fff).', 'eft-domain' ),
				'default'  => '#fd7e14',
				'validate' => 'color',
			),
		),
	)
);
//
//End Color Section

if ( file_exists( dirname( __FILE__ ) . '/../README.md' ) ) {
	$section = array(
		'icon'   => 'el el-list-alt',
		'title'  => esc_html__( 'Documentation', 'your-domain-here' ),
		'fields' => array(
			array(
				'id'           => 'opt-raw-documentation',
				'type'         => 'raw',
				'markdown'     => true,
				'content_path' => dirname( __FILE__ ) . '/../README.md', // FULL PATH, not relative please.
			),
		),
	);

	Redux::set_section( $opt_name, $section );
}

/*
 * <--- END SECTIONS
 */

/*
 * ---> BEGIN METABOX CONFIG
 */

// Regardless how you create your Metabox arrays, whether via a separate file on inyour actual option config,
// It MUST, MUST, MUST be set via this action hook.  Otherwise, your Metaboxes will NOT render.
add_filter( 'redux/' . $opt_name . '/extensions/metaboxes/config/load', 'redux_load_metabox_config' );

if ( ! function_exists( 'redux_load_metabox_config' ) ) {
	/**
	 * Load Metabox config on action hook.  This ensures proper load order, otherwise Metaboxes may not display.
	 *
	 * @param string $opt_name Panel opt_name.
	 */
	function redux_load_metabox_config( $opt_name ) {

		// File containing sample Metabox Lite option arrays.
		require_once Redux_Core::$dir . '../sample/sample-metabox-config.php';
	}
}

/*
 * ---> END METABOX CONFIG
 */

/*
 * YOU MUST PREFIX THE FUNCTIONS BELOW AND ACTION FUNCTION CALLS OR OTHER CONFIGS MAY OVERRIDE YOUR CODE.
 */

/*
 * --> Action hook examples.
 */

// Function to test the compiler hook and demo CSS output.
// Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
// add_filter('redux/options/' . $opt_name . '/compiler', 'compiler_action', 10, 3);
//
// Change the arguments after they've been declared, but before the panel is created.
// add_filter('redux/options/' . $opt_name . '/args', 'change_arguments' );
//
// Change the default value of a field after it's been set, but before it's been useds.
// add_filter('redux/options/' . $opt_name . '/defaults', 'change_defaults' );
//
// Dynamically add a section. Can be also used to modify sections/fields.
// add_filter('redux/options/' . $opt_name . '/sections', 'dynamic_section');
// .
if ( ! function_exists( 'compiler_action' ) ) {
	/**
	 *
	 * This is a test function that will let you see when the compiler hook occurs.
	 * It only runs if a field's value has changed and compiler=>true is set.
	 *
	 * @param array  $options        Options values.
	 * @param string $css            Compiler selector CSS values  compiler => array( CSS SELECTORS ).
	 * @param array  $changed_values Values changed since last save.
	 */
	function compiler_action( $options, $css, $changed_values ) {
		echo '<h1>The compiler hook has run!</h1>';
		echo '<pre>';
		// phpcs:ignore WordPress.PHP.DevelopmentFunctions
		print_r( $changed_values ); // Values that have changed since the last save.
		// echo '<br/>';
		// print_r($options); //Option values.
		// echo '<br/>';
		// print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS ).
		echo '</pre>';
	}
}

if ( ! function_exists( 'redux_validate_callback_function' ) ) {
	/**
	 * Custom function for the callback validation referenced above
	 *
	 * @param array $field          Field array.
	 * @param mixed $value          New value.
	 * @param mixed $existing_value Existing value.
	 *
	 * @return mixed
	 */
	function redux_validate_callback_function( $field, $value, $existing_value ) {
		$error   = false;
		$warning = false;

		// Do your validation.
		if ( 1 === $value ) {
			$error = true;
			$value = $existing_value;
		} elseif ( 2 === $value ) {
			$warning = true;
			$value   = $existing_value;
		}

		$return['value'] = $value;

		if ( true === $error ) {
			$field['msg']    = 'your custom error message';
			$return['error'] = $field;
		}

		if ( true === $warning ) {
			$field['msg']      = 'your custom warning message';
			$return['warning'] = $field;
		}

		return $return;
	}
}

if ( ! function_exists( 'redux_my_custom_field' ) ) {
	/**
	 * Custom function for the callback referenced above.
	 *
	 * @param array $field Field array.
	 * @param mixed $value Set value.
	 */
	function redux_my_custom_field( $field, $value ) {
		print_r( $field ); // phpcs:ignore WordPress.PHP.DevelopmentFunctions
		echo '<br/>';
		print_r( $value ); // phpcs:ignore WordPress.PHP.DevelopmentFunctions
	}
}

if ( ! function_exists( 'dynamic_section' ) ) {
	/**
	 * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
	 * Simply include this function in the child themes functions.php file.
	 * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
	 * so you must use get_template_directory_uri() if you want to use any of the built in icons.
	 *
	 * @param array $sections Section array.
	 *
	 * @return array
	 */
	function dynamic_section( $sections ) {
		$sections[] = array(
			'title'  => esc_html__( 'Section via hook', 'your-domain-here' ),
			'desc'   => '<p class="description">' . esc_html__( 'This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.', 'your-domain-here' ) . '</p>',
			'icon'   => 'el el-paper-clip',

			// Leave this as a blank section, no options just some intro text set above.
			'fields' => array(),
		);

		return $sections;
	}
}

if ( ! function_exists( 'change_arguments' ) ) {
	/**
	 * Filter hook for filtering the args.
	 * Good for child themes to override or add to the args array. Can also be used in other functions.
	 *
	 * @param array $args Global arguments array.
	 *
	 * @return array
	 */
	function change_arguments( $args ) {
		$args['dev_mode'] = true;

		return $args;
	}
}

if ( ! function_exists( 'change_defaults' ) ) {
	/**
	 * Filter hook for filtering the default value of any given field. Very useful in development mode.
	 *
	 * @param array $defaults Default value array.
	 *
	 * @return array
	 */
	function change_defaults( $defaults ) {
		$defaults['str_replace'] = esc_html__( 'Testing filter hook!', 'your-domain-here' );

		return $defaults;
	}
}

if ( ! function_exists( 'redux_custom_sanitize' ) ) {
	/**
	 * Function to be used if the field santize argument.
	 *
	 * Return value MUST be the formatted or cleaned text to display.
	 *
	 * @param string $value Value to evaluate or clean.  Required.
	 *
	 * @return string
	 */
	function redux_custom_sanitize( $value ) {
		$return = '';

		foreach ( explode( ' ', $value ) as $w ) {
			foreach ( str_split( $w ) as $k => $v ) {
				if ( ( $k + 1 ) % 2 !== 0 && ctype_alpha( $v ) ) {
					$return .= mb_strtoupper( $v );
				} else {
					$return .= $v;
				}
			}
			$return .= ' ';
		}

		return $return;
	}
}
