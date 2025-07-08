<?php

	// Charger le Text Domain
	load_theme_textdomain( 'akartis', get_template_directory() . '/languages' );
    function akartis_theme_support() {
		add_theme_support('title-tag');
		add_theme_support('post-thumbnails');

		register_nav_menus(
			array(
				'primary'   => __( 'Primary menu', 'akartis'), 
				'secondary' => __( 'Secondary menu', 'akartis'),
				'user_nav'  => __('User navigation', 'akartis'),
				'footer'    => __( 'Footer menu', 'akartis'),
			)
		);
	}
	add_action('after_setup_theme', 'akartis_theme_support');

	function wporg_settings_init() {
		// register a new setting for "reading" page
		register_setting('reading', 'wporg_setting_name');

		// register a new section in the "reading" page
		add_settings_section(
			'wporg_settings_section',
			'WPOrg Settings Section', 'wporg_settings_section_callback',
			'reading'
		);

		// register a new field in the "wporg_settings_section" section, inside the "reading" page
		add_settings_field(
			'wporg_settings_field',
			'WPOrg Setting', 'wporg_settings_field_callback',
			'reading',
			'wporg_settings_section'
		);
	}

	/**
	 * register wporg_settings_init to the admin_init action hook
	 */
	add_action('admin_init', 'wporg_settings_init');

/**
 * callback functions
 */

// section content cb
function wporg_settings_section_callback() {
	echo '<p>WPOrg Section Introduction.</p>';
}

// field content cb
function wporg_settings_field_callback() {
	// get the value of the setting we've registered with register_setting()
	$setting = get_option('wporg_setting_name');
	// output the field
	?>
	<input type="text" name="wporg_setting_name" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>">
    <?php
}