<?php

/* Theme Support: Titles, etc.
---------------------------------------------------------------------------------------------------- */

add_theme_support('title-tag');


/* Theme Support: Titles, etc.
---------------------------------------------------------------------------------------------------- */

function my_error_notice() { ?>
  <div style="width: 340px; height: 90px; position: fixed; top: 20px; right: 20px; z-index: 100000; padding:10px; border-radius: 45px 6px 6px 45px; background-color: #f44c67; box-shadow: rgba(29, 29, 31, 0.5) 0 5px 40px; box-sizing: border-box;">
    <div style="width: 70px; height: 70px; float: left; background-color: #ffffff; background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/icon-plasso.png'); background-size: 45px; background-position: center 12px; background-repeat: no-repeat; border-radius: 50%;"></div>
    <div style="width: 240px; float: left; margin: -2px 0 0 10px;">
      <h6 style="margin: 0; padding: 0; font-size: 12px; color: #ffffff;">Plasso Plugin Required!</h6>
      <p style="margin: 0; padding: 0; font-size: 12px; color: #ffffff; opacity: 0.75;">To use this theme, you’ll have to install and activate the Plasso Plugin.</p>
      <a style="font-size: 12px; color: #ffffff;" href="<?php echo admin_url('plugin-install.php?s=plasso&tab=search&type=term'); ?>">Get the Plasso Plugin</a>
    </div>
  </div>
<?php }
if(!function_exists('plasso_protect_pages')) {
  add_action('admin_notices', 'my_error_notice');
}


/* Include Works: Customizer, etc.
---------------------------------------------------------------------------------------------------- */

require_once( get_template_directory() . '/assets/works/vendor/mailchimp.php');
require_once(get_template_directory() . '/assets/works/customizer.php');


/* Kirki: Including Kirki in this theme.
---------------------------------------------------------------------------------------------------- */

// Including Kirki
require_once(get_template_directory() . '/assets/works/vendor/kirki/kirki.php');

// Config Kirki to work from the theme.
function plasso_kirki_configuration() {
  return array('url_path' => get_stylesheet_directory_uri() . '/assets/works/vendor/kirki/');
}
add_filter('kirki/config', 'plasso_kirki_configuration');


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
	$wp_customize->remove_section('custom_css');
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

	// Localizes scripts
	wp_localize_script('plasso_site', 'plassoAjax', array(
		'ajaxUrl' => admin_url('admin-ajax.php'),
		'nonce' => wp_create_nonce('plasso-nonce')
	));
}
add_action('wp_enqueue_scripts', 'plasso_enqueue');


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
