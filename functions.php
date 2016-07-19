<?php

/* Theme Support: Titles, etc.
---------------------------------------------------------------------------------------------------- */

add_theme_support('title-tag');

/* Include Works: Customizer, etc.
---------------------------------------------------------------------------------------------------- */

require_once( get_template_directory() . '/assets/works/vendor/plugin-activation.php');
require_once( get_template_directory() . '/assets/works/vendor/mailchimp.php');
require_once(get_template_directory() . '/assets/works/customizer.php');

/* Remove Menus: Removing unused WordPress menu items and taxonomy features.
---------------------------------------------------------------------------------------------------- */

function plasso_remove_menus() {

	// Removes unused top level menus.
	remove_menu_page('edit.php');
	remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'plasso_remove_menus');

function plasso_remove_customizer_settings($wp_customize){

	// Remove nav menus from the customizer.
	$wp_customize->remove_panel('nav_menus');
}
add_action('customize_register', 'plasso_remove_customizer_settings', 20);

/* Enqueue: Adding styles and scripts.
---------------------------------------------------------------------------------------------------- */

function plasso_enqueue() {

	// Loads Google Fonts
	$query_args = array(
		'family' => 'Poppins:300,400,300'
	);
	wp_register_style('plasso_fonts', add_query_arg($query_args, 'https://fonts.googleapis.com/css'), array(), null);
	wp_enqueue_style('plasso_fonts');

	// Loads site styles
	wp_enqueue_style('plasso_site', get_template_directory_uri() . '/assets/styles/site-min.css');

	// Loads site scripts
	wp_enqueue_script('jquery');
	wp_enqueue_script('plasso_site', get_template_directory_uri() . '/assets/scripts/site-min.js', array('jquery'), '1.0', 'in-footer');
	wp_enqueue_script('plasso_overlay', 'https://plasso.co/embed/v2/embed.js', array(), null, 'in-footer');

	// Localizes scripts
	wp_localize_script('plasso_site', 'plassoAjax', array(
		'ajaxUrl' => admin_url('admin-ajax.php'),
		'nonce' => wp_create_nonce('plasso-nonce')
	));
}
add_action('wp_enqueue_scripts', 'plasso_enqueue');

/* Required Plugins: Make sure Kirki gets installed.
---------------------------------------------------------------------------------------------------- */

function plasso_require_plugins() {

	// We need Kirki.
	$plugins = array(

		// Includes the Kirki plugin from the WordPress Plugin Repository.
		array(
			'name' => 'Kirki',
			'slug' => 'kirki',
			'required' => true,
		),
	);

	// Configuration settings.
	$config = array(
		'id' => 'tgmpa', // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '', // Default absolute path to bundled plugins.
		'menu' => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug' => 'themes.php', // Parent menu slug.
		'capability' => 'edit_theme_options', // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices' => true, // Show admin notices or not.
		'dismissable' => true, // If false, a user cannot dismiss the nag message.
		'dismiss_msg' => '', // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false, // Automatically activate plugins after installation or not.
		'message' => '', // Message to output right before the plugins table.
		'strings' => array(
			'page_title' => __('Install and Activate Required Plugins', 'leeflets_textdomain'),
			'menu_title' => __('Required Plugins', 'leeflets_textdomain'),
			'nag_type' => 'updated', // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
		)
	);

	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'plasso_require_plugins' );

/* MailChimp: Form handling for MailChimp subscriptions.
---------------------------------------------------------------------------------------------------- */

// Form processing.
if(isset($_POST['mc-email'])) {

	// Get theme settings.
	$plasso = get_theme_mod('plasso');

    // Get the form fields.
    $email = $_POST["mc-email"];

    if(!empty($email)) {

        // Initiate the MailChimp API.
        $MailChimp = new MailChimp($plasso['newsletter_api']);

        // Add the subscriber to MailChimp.
        $MailChimp->call('lists/subscribe', array(
            'id' => $plasso['newsletter_list'],
            'email' => array('email' => $email),
            'merge_vars' => array('FNAME' => '', 'LNAME' => ''),
            'double_optin' => true,
            'update_existing' => true,
            'replace_interests' => false,
            'send_welcome' => false
        ));

        // Get the success message.
		$subscription = 'success';
    } else {

        // Get the failed message.
		$subscription = 'failed';
    }
}
