<?php
/**
 * Bimbler Reminders Settings
 *
 * @package   Bimbler_Reminders
 * @author    Paul Perkins <paul@paulperkins.net>
 * @license   GPL-2.0+
 * @link      http://bimblers.com/plugins
 * @copyright 2015 Paul Perkins
 */


/*
 * TODO: 
 *  
 */

/*
 * 
 */
function bimbler_reminders_create_admin_menu () {

	// Always add the top-level menu page as a container for other plugins.
	// This will likely fail, but that's OK.
	add_menu_page( 	'Bimblers',
					'Bimblers',
					'manage_options',
					'bimblers',
					'bimbler_display_options_page'); 
	
	// Create the menu for this plugin
	add_submenu_page( 'bimblers', 
						'Bimbler Reminders', 
						'Bimbler Reminders', 
						'manage_options', 
						'bimbler-reminders', 
						'bimbler_reminders_display_options_page');
	
}


function bimbler_reminders_display_options_page () {
?>
	<div class="wrap">
	
		<h2>Bimbler Reminders Options</h2>	
	
    	<?php settings_errors(); ?>
         
        <form method="post" action="options.php">
            <?php settings_fields( 'bimbler_reminders_options' ); ?>
            <?php do_settings_sections( 'bimbler_reminders_options' ); ?>         
            <?php submit_button(); ?>
		</form>
		
	</div>
<?php 
}


function bimbler_reminders_create_settings () {

	//error_log ('bimbler_create_rsvp_settings: Started.');
	
	// If the options don't exist, create them.
	/*if( false == get_option( 'bimbler_reminders_options' ) ) {
		add_option( 'bimbler_reminders_options' );
	}*/
	
	// First, we register a section. This is necessary since all future options must belong to one.
	add_settings_section(
		'rsvp_reminders_settings_section',		// ID used to identify this section and with which to register options
		'Bimblers RSVP Reminders Options',		// Title to be displayed on the administration page
		'rsvp_reminders_options_callback',		// Callback used to render the description of the section
		'bimbler_reminders_options'				// Page on which to add this section of options
	);

	// First, we register a section. This is necessary since all future options must belong to one.
	add_settings_section(
		'upcoming_reminders_settings_section',			// ID used to identify this section and with which to register options
		'Bimblers Upcoming Event Reminders Options',	// Title to be displayed on the administration page
		'upcoming_reminders_options_callback',			// Callback used to render the description of the section
		'bimbler_reminders_options'						// Page on which to add this section of options
		);
	
	// RSVP Reminders.	
	add_settings_field(
		'rsvp_reminders_send_emails',			// ID used to identify the field throughout the theme
		'Send Emails',							// The label to the left of the option interface element
		'rsvp_reminders_send_emails_callback',	// The name of the function responsible for rendering the option interface
		'bimbler_reminders_options',			// The page on which this option will be displayed
		'rsvp_reminders_settings_section',		// The name of the section to which this field belongs
		array(									// The array of arguments to pass to the callback. In this case, just a description.
		'Send RSVP reminder emails. Enable functionality.')
		);

	add_settings_field(
		'rsvp_reminders_test_mode',				// ID used to identify the field throughout the theme
		'Test Mode',							// The label to the left of the option interface element
		'rsvp_reminders_test_mode_callback',	// The name of the function responsible for rendering the option interface
		'bimbler_reminders_options',			// The page on which this option will be displayed
		'rsvp_reminders_settings_section',		// The name of the section to which this field belongs
		array(									// The array of arguments to pass to the callback. In this case, just a description.
		'Test mode - only send mails to admin.')
		);
		
	add_settings_field(
		'rsvp_reminders_days_from',				// ID used to identify the field throughout the theme
		'Days from Today',						// The label to the left of the option interface element
		'rsvp_reminders_days_from_callback',	// The name of the function responsible for rendering the option interface
		'bimbler_reminders_options',			// The page on which this option will be displayed
		'rsvp_reminders_settings_section',		// The name of the section to which this field belongs
		array(									// The array of arguments to pass to the callback. In this case, just a description.
		'Send RSVP reminders for events this many days ahead from today.')		
		);

	add_settings_field(
		'rsvp_reminders_events_num',			// ID used to identify the field throughout the theme
		'Events to Show',						// The label to the left of the option interface element
		'rsvp_reminders_events_num_callback',	// The name of the function responsible for rendering the option interface
		'bimbler_reminders_options',			// The page on which this option will be displayed
		'rsvp_reminders_settings_section',		// The name of the section to which this field belongs
		array(									// The array of arguments to pass to the callback. In this case, just a description.
		'Number of other events to show in the email.')
		);
	
	// Upcoming events reminders.
	add_settings_field(
		'upcoming_reminders_send_emails',			// ID used to identify the field throughout the theme
		'Send Emails',							// The label to the left of the option interface element
		'upcoming_reminders_send_emails_callback',	// The name of the function responsible for rendering the option interface
		'bimbler_reminders_options',			// The page on which this option will be displayed
		'upcoming_reminders_settings_section',		// The name of the section to which this field belongs
		array(									// The array of arguments to pass to the callback. In this case, just a description.
		'Send upcoming event reminder emails. Enable functionality.')
		);
		
	add_settings_field(
		'upcoming_reminders_test_mode',				// ID used to identify the field throughout the theme
		'Test Mode',							// The label to the left of the option interface element
		'upcoming_reminders_test_mode_callback',	// The name of the function responsible for rendering the option interface
		'bimbler_reminders_options',			// The page on which this option will be displayed
		'upcoming_reminders_settings_section',		// The name of the section to which this field belongs
		array(									// The array of arguments to pass to the callback. In this case, just a description.
		'Test mode - only send mails to admin.')
		);
		
	add_settings_field(
		'upcoming_reminders_days_from',				// ID used to identify the field throughout the theme
		'Days from Today',						// The label to the left of the option interface element
		'upcoming_reminders_days_from_callback',	// The name of the function responsible for rendering the option interface
		'bimbler_reminders_options',			// The page on which this option will be displayed
		'upcoming_reminders_settings_section',		// The name of the section to which this field belongs
		array(									// The array of arguments to pass to the callback. In this case, just a description.
		'Send upcoming events reminders for events this many days ahead from today.')
		);
		
	add_settings_field(
		'upcoming_reminders_num_events',			// ID used to identify the field throughout the theme
		'Events to Show',						// The label to the left of the option interface element
		'upcoming_reminders_events_num_callback',	// The name of the function responsible for rendering the option interface
		'bimbler_reminders_options',			// The page on which this option will be displayed
		'upcoming_reminders_settings_section',		// The name of the section to which this field belongs
		array(									// The array of arguments to pass to the callback. In this case, just a description.
		'Number of other events to show in the email.')
		);
	
	// Finally, we register the fields with WordPress
	register_setting(
		'bimbler_reminders_options',
		'bimbler_reminders_options'
			);
}


/**
 * This function provides a simple description for the General Options page.
 *
 * It is called from the 'sandbox_initialize_theme_options' function by being passed as a parameter
 * in the add_settings_section function.
 */
function rsvp_reminders_options_callback() {
	echo '<p>Adjust behaviour of the RSVP reminders email process.</p>';
}

/**
 * This function renders the interface elements for toggling the visibility of the header element.
 *
 * It accepts an array of arguments and expects the first element in the array to be the description
 * to be displayed next to the checkbox.
 */
function rsvp_reminders_send_emails_callback($args) {
	 
	// First, we read the options collection
	$options = get_option('bimbler_reminders_options');

	error_log ('bimbler_reminders_options: ' . print_r ($options, true));
	 
	// Next, we update the name attribute to access this element's ID in the context of the display options array
	// We also access the show_header element of the options collection in the call to the checked() helper function
	$html = '<input type="checkbox" id="rsvp_reminders_send_emails" name="bimbler_reminders_options[rsvp_reminders_send_emails]" value="1" ' . checked(1, (isset ($options['rsvp_reminders_send_emails']) ? $options['rsvp_reminders_send_emails'] : ''), false) . '/>';
	 
	// Here, we'll take the first argument of the array and add it to a label next to the checkbox
	$html .= '<label for="rsvp_reminders_send_emails"> '  . $args[0] . '</label>';
	 
	echo $html;
	 
} // end sandbox_toggle_header_callback


/**
 * This function renders the interface elements for toggling the visibility of the header element.
 *
 * It accepts an array of arguments and expects the first element in the array to be the description
 * to be displayed next to the checkbox.
 */
function rsvp_reminders_test_mode_callback($args) {
	 
	// First, we read the options collection
	$options = get_option('bimbler_reminders_options');

	//error_log ('Options: ' . print_r ($options, true));
	 
	// Next, we update the name attribute to access this element's ID in the context of the display options array
	// We also access the show_header element of the options collection in the call to the checked() helper function
	$html = '<input type="checkbox" id="rsvp_reminders_test_mode" name="bimbler_reminders_options[rsvp_reminders_test_mode]" value="1" ' . checked(1, (isset ($options['rsvp_reminders_test_mode']) ? $options['rsvp_reminders_test_mode'] : ''), false) . '/>';
	 
	// Here, we'll take the first argument of the array and add it to a label next to the checkbox
	$html .= '<label for="rsvp_reminders_test_mode"> '  . $args[0] . '</label>';
	 
	echo $html;
	 
} // end sandbox_toggle_header_callback


/**
 * This function renders the interface elements for toggling the visibility of the header element.
 *
 * It accepts an array of arguments and expects the first element in the array to be the description
 * to be displayed next to the checkbox.
 */
function rsvp_reminders_days_from_callback($args) {
     
    // First, we read the options collection
    $options = get_option('bimbler_reminders_options');
    
    error_log ('Options: ' . print_r ($options, true));
     
    // Next, we update the name attribute to access this element's ID in the context of the display options array
    // We also access the show_header element of the options collection in the call to the checked() helper function
    $html = '<input type="text" id="rsvp_reminders_days_from" name="bimbler_reminders_options[rsvp_reminders_days_from]" value="' . isset ($options['rsvp_reminders_days_from']) ? $options['rsvp_reminders_days_from'] : '' . '"/>'; 
     
    // Here, we'll take the first argument of the array and add it to a label next to the checkbox
    $html .= '<label for="rsvp_reminders_days_from"> '  . $args[0] . '</label>'; 
     
    echo $html;
     
} // end sandbox_toggle_header_callback


/**
 * This function renders the interface elements for toggling the visibility of the header element.
 *
 * It accepts an array of arguments and expects the first element in the array to be the description
 * to be displayed next to the checkbox.
 */
function rsvp_reminders_events_num_callback($args) {
	 
	// First, we read the options collection
	$options = get_option('bimbler_reminders_options');

	//error_log ('Options: ' . print_r ($options, true));
	 
	// Next, we update the name attribute to access this element's ID in the context of the display options array
	// We also access the show_header element of the options collection in the call to the checked() helper function
	$html = '<input type="checkbox" id="rsvp_reminders_events_num" name="bimbler_reminders_options[rsvp_reminders_events_num]" value="1" ' . checked(1, (isset ($options['rsvp_reminders_events_num']) ? $options['rsvp_reminders_events_num'] : ''), false) . '/>';
	 
	// Here, we'll take the first argument of the array and add it to a label next to the checkbox
	$html .= '<label for="rsvp_reminders_events_num"> '  . $args[0] . '</label>';
	 
	echo $html;
	 
} // end sandbox_toggle_header_callback



/**
 * This function provides a simple description for the General Options page.
 *
 * It is called from the 'sandbox_initialize_theme_options' function by being passed as a parameter
 * in the add_settings_section function.
 */
function upcoming_reminders_options_callback() {
	echo '<p>Adjust behaviour of the upcoming event reminders email process.</p>';
}


/**
 * This function renders the interface elements for toggling the visibility of the header element.
 *
 * It accepts an array of arguments and expects the first element in the array to be the description
 * to be displayed next to the checkbox.
 */
function upcoming_reminders_send_emails_callback($args) {

	// First, we read the options collection
	$options = get_option('bimbler_reminders_options');

	//error_log ('Options: ' . print_r ($options, true));

	// Next, we update the name attribute to access this element's ID in the context of the display options array
	// We also access the show_header element of the options collection in the call to the checked() helper function
	$html = '<input type="checkbox" id="upcoming_reminders_send_emails" name="bimbler_reminders_options[upcoming_reminders_send_emails]" value="1" ' . checked(1, (isset ($options['upcoming_reminders_send_emails']) ? $options['upcoming_reminders_send_emails'] : ''), false) . '/>';

	// Here, we'll take the first argument of the array and add it to a label next to the checkbox
	$html .= '<label for="upcoming_reminders_send_emails"> '  . $args[0] . '</label>';

	echo $html;

} // end sandbox_toggle_header_callback


/**
 * This function renders the interface elements for toggling the visibility of the header element.
 *
 * It accepts an array of arguments and expects the first element in the array to be the description
 * to be displayed next to the checkbox.
 */
function upcoming_reminders_test_mode_callback($args) {

	// First, we read the options collection
	$options = get_option('bimbler_reminders_options');

	//error_log ('Options: ' . print_r ($options, true));

	// Next, we update the name attribute to access this element's ID in the context of the display options array
	// We also access the show_header element of the options collection in the call to the checked() helper function
	$html = '<input type="checkbox" id="upcoming_reminders_test_mode" name="bimbler_reminders_options[upcoming_reminders_test_mode]" value="1" ' . checked(1, (isset ($options['upcoming_reminders_test_mode']) ? $options['upcoming_reminders_test_mode'] : ''), false) . '/>';

	// Here, we'll take the first argument of the array and add it to a label next to the checkbox
	$html .= '<label for="upcoming_reminders_test_mode"> '  . $args[0] . '</label>';

	echo $html;

} // end sandbox_toggle_header_callback


/**
 * This function renders the interface elements for toggling the visibility of the header element.
 *
 * It accepts an array of arguments and expects the first element in the array to be the description
 * to be displayed next to the checkbox.
 */
function upcoming_reminders_days_from_callback($args) {
	 
	// First, we read the options collection
	$options = get_option('bimbler_reminders_options');

	//error_log ('Options: ' . print_r ($options, true));
	 
	// Next, we update the name attribute to access this element's ID in the context of the display options array
	// We also access the show_header element of the options collection in the call to the checked() helper function
	$html = '<input type="checkbox" id="upcoming_reminders_days_from" name="bimbler_reminders_options[upcoming_reminders_days_from]" value="1" ' . checked(1, (isset ($options['upcoming_reminders_days_from']) ? $options['upcoming_reminders_days_from'] : ''), false) . '/>';
	 
	// Here, we'll take the first argument of the array and add it to a label next to the checkbox
	$html .= '<label for="upcoming_reminders_days_from"> '  . $args[0] . '</label>';
	 
	echo $html;
	 
} // end sandbox_toggle_header_callback


/**
 * This function renders the interface elements for toggling the visibility of the header element.
 *
 * It accepts an array of arguments and expects the first element in the array to be the description
 * to be displayed next to the checkbox.
 */
function upcoming_reminders_events_num_callback($args) {

	// First, we read the options collection
	$options = get_option('bimbler_reminders_options');

	//error_log ('Options: ' . print_r ($options, true));

	// Next, we update the name attribute to access this element's ID in the context of the display options array
	// We also access the show_header element of the options collection in the call to the checked() helper function
	$html = '<input type="checkbox" id="upcoming_reminders_events_num" name="bimbler_reminders_options[upcoming_reminders_events_num]" value="1" ' . checked(1, (isset ($options['upcoming_reminders_events_num']) ? $options['upcoming_reminders_events_num'] : ''), false) . '/>';

	// Here, we'll take the first argument of the array and add it to a label next to the checkbox
	$html .= '<label for="upcoming_reminders_events_num"> '  . $args[0] . '</label>';

	echo $html;

} // end sandbox_toggle_header_callback


?>