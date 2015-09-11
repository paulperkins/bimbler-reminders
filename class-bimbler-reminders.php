<?php
/**
 * Bimbler Reminders
 *
 * @package   Bimbler_Reminders
 * @author    Paul Perkins <paul@paulperkins.net>
 * @license   GPL-2.0+
 * @link      http://www.paulperkins.net
 * @copyright 2014 Paul Perkins
 */

/**
 * Include dependencies necessary... (none at present)
 *
 */

//if ( current_user_can( 'manage_options' ) )  {
	// Settings page.
//	require_once( plugin_dir_path( __FILE__ ) . 'admin/bimbler-reminders-settings.php' );
//}

/**
 * Bimbler Reminders
 *
 * @package Bimbler_Reminders
 * @author  Paul Perkins <paul@paulperkins.net>
 */
class Bimbler_Reminders {

	public $email_html_head = '
<!DOCTYPE html>
<html lang="en-US">
	
<head>
	<meta charset="UTF-8">
			';
	
	public $email_style = "
		<style type=\"text/css\">
		body { font-family: 'Titillium', Arial, sans-serif; font-size: 18px; xline-height: 1.6em; }
 		p{ margin-bottom: 1em; font-family: 'Titillium', Arial;}
@font-face {
	font-family: 'Titillium';
	src: url('http://bimblers.com/wp-content/themes/hueman/fonts/titillium-light-webfont.eot');
	src: url('http://bimblers.com/wp-content/themes/hueman/fonts/titillium-light-webfont.svg#titillium-light-webfont') format('svg'),
		 url('http://bimblers.com/wp-content/themes/hueman/fonts/titillium-light-webfont.eot?#iefix') format('embedded-opentype'),
		 url('http://bimblers.com/wp-content/themes/hueman/fonts/titillium-light-webfont.woff') format('woff'),
		 url('http://bimblers.com/wp-content/themes/hueman/fonts/titillium-light-webfont.ttf') format('truetype');
	font-weight: 300;
	font-style: normal;
}
@font-face {
	font-family: 'Titillium';
	src: url('http://bimblers.com/wp-content/themes/hueman/fonts/titillium-lightitalic-webfont.eot');
	src: url('http://bimblers.com/wp-content/themes/hueman/fonts/titillium-lightitalic-webfont.svg#titillium-lightitalic-webfont') format('svg'),
		 url('http://bimblers.com/wp-content/themes/hueman/fonts/titillium-lightitalic-webfont.eot?#iefix') format('embedded-opentype'),
		 url('http://bimblers.com/wp-content/themes/hueman/fonts/titillium-lightitalic-webfont.woff') format('woff'),
		 url('http://bimblers.com/wp-content/themes/hueman/fonts/titillium-lightitalic-webfont.ttf') format('truetype');
	font-weight: 300;
	font-style: italic;
}
@font-face {
	font-family: 'Titillium';
	src: url('http://bimblers.com/wp-content/themes/hueman/fonts/titillium-regular-webfont.eot');
	src: url('http://bimblers.com/wp-content/themes/hueman/fonts/titillium-regular-webfont.svg#titillium-regular-webfont') format('svg'),
		 url('http://bimblers.com/wp-content/themes/hueman/fonts/titillium-regular-webfont.eot?#iefix') format('embedded-opentype'),
		 url('http://bimblers.com/wp-content/themes/hueman/fonts/titillium-regular-webfont.woff') format('woff'),
		 url('http://bimblers.com/wp-content/themes/hueman/fonts/titillium-regular-webfont.ttf') format('truetype');
	font-weight: 400;
	font-style: normal;
}
@font-face {
	font-family: 'Titillium';
	src: url('http://bimblers.com/wp-content/themes/hueman/fonts/titillium-regularitalic-webfont.eot');
	src: url('http://bimblers.com/wp-content/themes/hueman/fonts/titillium-regularitalic-webfont.svg#titillium-regular-webfont') format('svg'),
		 url('http://bimblers.com/wp-content/themes/hueman/fonts/titillium-regularitalic-webfont.eot?#iefix') format('embedded-opentype'),
		 url('http://bimblers.com/wp-content/themes/hueman/fonts/titillium-regularitalic-webfont.woff') format('woff'),
		 url('http://bimblers.com/wp-content/themes/hueman/fonts/titillium-regularitalic-webfont.ttf') format('truetype');
	font-weight: 400;
	font-style: italic;
}
@font-face {
    font-family: 'Titillium';
    src: url('http://bimblers.com/wp-content/themes/hueman/fonts/titillium-semibold-webfont.eot');
    src: url('http://bimblers.com/wp-content/themes/hueman/fonts/titillium-semibold-webfont.svg#titillium-semibold-webfont') format('svg'),
         url('http://bimblers.com/wp-content/themes/hueman/fonts/titillium-semibold-webfont.eot?#iefix') format('embedded-opentype'),
         url('http://bimblers.com/wp-content/themes/hueman/fonts/titillium-semibold-webfont.woff') format('woff'),
         url('http://bimblers.com/wp-content/themes/hueman/fonts/titillium-semibold-webfont.ttf') format('truetype');
	font-weight: 600;
	font-style: normal;
}			
		</style>	
			";
	
	public $email_end_head = '</head><body>';
	
	public $email_html_foot = '</body></html>';
	
	public $p_style = '<p style="font-size:13px;line-height:18px;margin:0 0 10px;">';
	
	public $default_days_from = 7;
	public $default_days_to = 30;
	
	public $slug_rsvp_post = 'email-template-event-reminder';
	public $slug_rsvp_conf_post = 'email-template-rsvp-confirmation';
	public $slug_upcoming_post = 'email-template-upcoming-reminder';
	
        /*--------------------------------------------*
         * Constructor
         *--------------------------------------------*/

        /*
         * Instance of this class.
         *
         * @since    1.0.0
         *
         * @var      object
         */
        protected static $instance = null;

        /*
         * Return an instance of this class.
         *
         * @since     1.0.0
         *
         * @return    object    A single instance of this class.
         */
        public static function get_instance() {

                // If the single instance hasn't been set, set it now.
                if ( null == self::$instance ) {
                        self::$instance = new self;
                } // end if

                return self::$instance;

        } // end get_instance

        /*
         * Initializes the plugin by setting localization, admin styles, and content filters.
         */
        private function __construct() {

			// Do nothing - everything is fired from a cron job.
        		         	
        	add_shortcode( 'bimbler_send_rsvp_reminders', array ($this, 'send_rsvp_reminders'));
        	add_shortcode( 'bimbler_send_upcoming_reminders', array ($this, 'send_upcoming_reminders'));

        	// Set up the admin menu. Contained in bimbler-reminders-settings.php.
//        	add_action( 'admin_menu', 'bimbler_reminders_create_admin_menu');
        	
        	// Set up the settings. Contained in bimbler-reminders-settings.php.
//        	add_action ('admin_init', 'bimbler_reminders_create_settings');
        	 
        	$this->reminders_install();
        	 
		} // End constructor.
		
		/**
		 * Install the plugin - create options settings.
		 *
		 */
		function reminders_install() {

			//error_log ('Bimbler_Reminders::reminders_install.');
			
/*			$options = [
				'rsvp_reminders_send_emails' 		=> 1,
				'rsvp_reminders_test_mode' 			=> 0,
				'rsvp_reminders_days_from'			=> 7,
				'rsvp_reminders_events_num'			=> 4,
				'upcoming_reminders_send_emails' 	=> 1,
				'upcoming_reminders_test_mode' 		=> 0,
				'upcoming_reminders_days_from'		=> 7,
				'upcoming_reminders_events_num'		=> 4,
			];

			if( false == get_option( 'bimbler_reminders_options' ) ) {
				update_option( "bimbler_reminders_options", $options );
			
				error_log ('Setting bimbler_reminders_options: ' . print_r(get_option('bimbler_reminders_options'), true));
			} */
  		}
		
		
		
		/*
		 * Returns an array of user IDs of those who have RSVPd to this post.
		 *
		 * TODO: Move SQL to common.
		 *
		 */
		function get_rsvpd_users ($post_id) {
				
			// Make sure we're dealing with an event post.
			if (!tribe_is_event ($post_id))
			{
				return null;
			}
		
			global $wp_query;
			global $wpdb;
			global $rsvp_db_table;
				
			$table_name = $wpdb->base_prefix . $rsvp_db_table;
				
			$sql = 'SELECT user_id ';
			$sql .= ' FROM '. $table_name;
			$sql .= ' WHERE rsvp = \'Y\'';
			$sql .= ' AND event = '. $post_id;
				
			//			  error_log ('    '. $sql);
				
			$rsvps = $wpdb->get_results ($sql);
				
			if (null == $rsvps) {
				return null;
			}
				
			$user_list = array ();
				
			foreach ($rsvps as $rsvp) {
				//error_log ('User '. $rsvp->user_id . ' has RSVPd to event '. $post_id);
		
				$user_list[] = $rsvp->user_id;
			}
		
			return $user_list;
		}
		
		/*
		 * Get all approved users from the DB.
		 * 
		 * TODO: Move SQL to common.
		 */
		function get_all_users () {
			global $wpdb;
				
			$sql =  'SELECT u.id as user_id ';
			$sql .= " FROM {$wpdb->users} u, ";
			$sql .= " {$wpdb->usermeta} m1 ";
			$sql .= ' WHERE u.id = m1.user_id ';
			$sql .= ' AND m1.meta_key = \'wp_capabilities\' ';
			$sql .= ' AND m1.meta_value NOT LIKE \'%unverified%\' ';
			$sql .= ' ORDER BY u.user_registered DESC';
		
			$users = $wpdb->get_results ($sql);
		
			if (null == $users) {
				return null;
			}
				
			$user_list = array ();
				
			foreach ($users as $user) {
		
				$user_list[] = $user->user_id;
			}
		
			return $user_list;
		}
		
		/*
		 * Returns an array of user IDs of those who created the post (will only ever contain a single element).
		 * 
		 */
		function get_event_host_users ($post_id) {
			
			$user_list = array ();
			
			// Make sure we're dealing with an event post.
			if (!tribe_is_event ($post_id))
			{
				return null;
			}

			// Get the Tribe Events Organiser.
			$organiser = tribe_get_organizer ($post_id);
				
			if (isset ($organiser)) {
	
				$organiser_user = get_user_by ('login', $organiser);
	
				if (isset ($organiser_user)) {

					$user_list[] = $organiser_user->ID;
					
				}
			}
			
			// Get the event hosts.
			$meta_hosts_json = get_post_meta ($post_id, 'bimbler_ride_hosts', true);

			if (isset ($meta_hosts_json)) {

				$meta_hosts = json_decode($meta_hosts_json);
				
				if (isset ($meta_hosts)) {
					
					foreach ($meta_hosts as $host) {
						
						$user_list[] = $host;
						
					}
				}
			}

			error_log ('Event Hosts:');
			
			foreach ($user_list as $host) {
			
				error_log ('   ' . $host);
			
			}
			
			return $user_list;
		}
				
		/*
		 * 
		 */
		function get_from_address () {
			return 'website@bimblers.com';
		}
		
		/*
		 * 
		 */
		function get_from_name () {
			return 'Brisbane Bimblers';
		}
		
		/*
		 * 
		 */
		function get_content_type () {
			return 'text/html';
		}
		
		/**
		* Send the email.
		*
		* @access public
		* @param mixed $to
		* @param mixed $subject
		* @param mixed $message
		* @param string $headers (default: "Content-Type: text/html\r\n")
		* @param string $attachments (default: "")
		* @param string $content_type (default: "text/html")
		* @return void
		*/
		function send_email( $to, $subject, $message, $headers = "Content-Type: text/html\r\n", $attachments = "", $content_type = 'text/html' ) {
		
			// Set content type
			$this->_content_type = $content_type;
			
			// Filters for the email
			add_filter( 'wp_mail_from', array( $this, 'get_from_address' ) );
			add_filter( 'wp_mail_from_name', array( $this, 'get_from_name' ) );
			add_filter( 'wp_mail_content_type', array( $this, 'get_content_type' ) );
		
			// Send
			wp_mail( $to, $subject, $message, $headers, $attachments );
		
			// Unhook filters
			remove_filter( 'wp_mail_from', array( $this, 'get_from_address' ) );
			remove_filter( 'wp_mail_from_name', array( $this, 'get_from_name' ) );
			remove_filter( 'wp_mail_content_type', array( $this, 'get_content_type' ) );
		}
		
		/*
		 * 
		 */
		function event_list_table_top() {
			$content = '
	<!-- <div style="border-top:10px solid #fff; background:#fff;"> -->
	<table cellpadding="0" cellspacing="0" style="xwidth:100%;" border="0">
					';
			
			return $content;
		}

		/*
		 * 
		 */
		function event_list_table_bottom() {
		
			$content = '
	</table>
	<!-- </div> -->
					';
			
			return $content;
		}
		
		/*
		 * 
		 */
		function event_list_row_top() {
			$content = '					<tr>
		';
			return $content;
		}
		
		/*
		 * 
		 */
		function event_list_row_bottom() {
			$content = '					</tr>
					';
			return $content;
		}

		/*
		 * 
		 */
		function event_list_calendar ($month, $day, $weekday) {
			$content = '
	<td style="width:32px;vertical-align:middle;border-top:1px solid #fff;padding:8px 0 8px 8px;">
<!--		<div style="border:1px solid #555; box-shadow: 5px 5px 2px #888888; -moz-box-shadow: 5px 5px 2px #888888; -webkit-box-shadow: 5px 5px 2px #888888;"> --> 
		<div style="border:1px solid #555;">
					<div style="background-color:#555;text-transform:uppercase;color:#fff!important;font-weight:bold;text-align:center;font-size:12px;line-height:14px;height:14px;padding:0 4px;"><font color="#fff">' . $weekday . '</font></div>
			<div style="background-color:#fff;font-size:16px;line-height:18px;height:18px;font-weight:bold;text-align:center;padding:1px 4px 0 4px;">' . $day . '</div>
		</div>
	</td>
					';
			
			return $content;
		}

		/*
		 * 
		 */
		function event_list_details ($url, $description, $when, $attendees, $new = false) {
			
			$new_style = '';
			
			if ($new) {
				$new_style = ' background-size: 50px; background-image:url(http://bimblers.com/wp-content/uploads/2015/02/New-50x50.png); background-position:right 0px; background-repeat:no-repeat; ';
			}
			
			$content = '
	<td style="vertical-align:top;padding:8px;border-top:1px solid #fff;">
		<table cellpadding="0" cellspacing="0" style="xwidth:100%;" border="0">
			<tr>
				<td style="vertical-align:top;">
					<a href="' . $url . '" style="font-size:14px; color: #3987CB; text-decoration: none; ">' . $description . '</a><br/>
					<div style="padding:2px 0 4px 0;font-size:12px;line-height:16px;">
										' . $when . '.<nobr>&nbsp;' . $attendees . ' attending.</nobr>
										</div>
				</td>
				<td style="width:50px; vertical-align:top; ' . $new_style . '">&nbsp;</td>
				</tr>
		</table>
	</td>
					';
			
			return $content;
		}

		/*
		 * 
		 */
		function get_venue_address ($event) {
			
			$locationMetaSuffixes = array( 'address', 'city', 'region', 'zip', 'country' );
			$toUrlEncode = "";
			
			$toUrlEncode .= tribe_get_address ($event->ID);
			$toUrlEncode .= ' ' . tribe_get_city ($event->ID);
			$toUrlEncode .= ' ' . tribe_get_region ($event->ID);
			$toUrlEncode .= ' ' . tribe_get_zip ($event->ID);
			$toUrlEncode .= ' ' . tribe_get_country ($event->ID);
				
			return trim($toUrlEncode);
		}
		
		/*
		 *
		*/
		function event_list_map ($event) {

			$address = $this->get_venue_address($event);
			$map_link = TribeEvents::instance()->googleMapLink($event->ID);
			
			$content = '
	<td style="vertical-align:top;padding:8px;border-top:1px solid #fff;" colspan="2">
		<a href="' . $map_link . '" target="_external">
		<img src="https://maps.googleapis.com/maps/api/staticmap?center=' . urlencode($address) . '&zoom=16&size=400x100&markers=color:red%7C' . urlencode($address) . '">
		</a>
	</td>
					';
			
			return $content;
		}
		
		/*
		 * TODO: Remove - no longer used.
		 */
		function get_other_events_html () {
			
			$content = '
<div style="background-color:#eee;border-top:10px solid #fff; background:#fff;">
<div style="background-color:#eee;font-weight:bold;border:8px solid #eee;color:#545454!important;font-size:16px;"><a href="http://www.meetup.com/Brisbane-Midweek-Mingles/" style="color:#545454!important;text-decoration:none;"><font color="#545454">More Meetups from this group</font></a></div>
<table cellpadding="0" cellspacing="0" style="width:100%;background-color:#eee;">
<tr>
	<td class="other-meetups-tearsheet" style="width:32px;background-color:#eee;vertical-align:top;border-top:1px solid #fff;padding:8px 0 8px 8px;">
		<div style="border:1px solid #555;">
			<div style="background-color:#555;text-transform:uppercase;color:#fff!important;font-weight:bold;text-align:center;font-size:9px;line-height:14px;height:14px;padding:0 4px;"><font color="#fff">Dec</font></div>
			<div style="background-color:#fff;font-size:16px;line-height:18px;height:18px;font-weight:bold;text-align:center;padding:1px 4px 0 4px;">26</div>
		</div>
	</td>
	<td style="vertical-align:top;padding:8px;border-top:1px solid #fff;">
		<table cellpadding="0" cellspacing="0" style="width:100%;">
			<tr>
				<td style="background-color:#eee;vertical-align:top;">
					<a href="http://www.meetup.com/__ms9276606/Brisbane-Midweek-Mingles/events/219237438/t/md1_evn/?rv=md1&_af_eid=219237438&_af=event&expires=1419521111436&sig=93f65610fed5a59c8d0f60af4c073e1d702044a7" style="font-size:14px; color: #3987CB; text-decoration: none; ">City to Shorncliffe and Return with option to start and finish in Nundah</a><br/>
					<div style="padding:2px 0 4px 0;font-size:12px;line-height:16px;">
										Friday, December 26, 2014 6:30 AM
										&middot;
																				<nobr>20 attending</nobr>
										</div>
				</td>
				<td style="background-color:#eee;width:76px;vertical-align:top;">
					<div style="display:inline-block;border:1px solid #9d1328;background-color:#e9003c;-moz-border-radius: 3px 3px 3px 3px;-webkit-border-radius: 3px 3px 3px 3px;border-radius: 3px 3px 3px 3px;text-align:center;"><span class="meetup-button-gradient" style="background-color:#e9003c;display:inline-block;"><a href="http://www.meetup.com/__ms9276606/Brisbane-Midweek-Mingles/events/219237438/t/md1_evn/?rv=md1&_af_eid=219237438&_af=event&expires=1419521111436&sig=93f65610fed5a59c8d0f60af4c073e1d702044a7" class="meetup-button-link" style="border-color:#e9003c;border-width:5px 18px;border-style:solid;font-family:arial,sans-serif;font-weight:bold;white-space:nowrap;color:#fff!important;display:inline-block;text-decoration:none;text-align:center;cursor:pointer;"><font color="#fff"><nobr>RSVP</nobr></font></a></span></div>
				</td>
			</tr>
		</table>
	</td>
</tr>
<tr>
	<td class="other-meetups-tearsheet" style="width:32px;background-color:#eee;vertical-align:top;border-top:1px solid #fff;padding:8px 0 8px 8px;">
		<div style="border:1px solid #555;">
			<div style="background-color:#555;text-transform:uppercase;color:#fff!important;font-weight:bold;text-align:center;font-size:9px;line-height:14px;height:14px;padding:0 4px;"><font color="#fff">Dec</font></div>
			<div style="background-color:#fff;font-size:16px;line-height:18px;height:18px;font-weight:bold;text-align:center;padding:1px 4px 0 4px;">29</div>
		</div>
	</td>
	<td style="vertical-align:top;padding:8px;border-top:1px solid #fff;">
		<table cellpadding="0" cellspacing="0" style="width:100%;">
			<tr>
				<td style="background-color:#eee;vertical-align:top;">
					<a href="http://www.meetup.com/__ms9276606/Brisbane-Midweek-Mingles/events/219237532/t/md1_evn/?rv=md1&_af_eid=219237532&_af=event&expires=1419521111438&sig=ccdf41bc1224bd05b1bb16d097981bf99a60eac8" style="font-size:14px; color: #3987CB; text-decoration: none; ">Samford Loop and more</a><br/>
					<div style="padding:2px 0 4px 0;font-size:12px;line-height:16px;">
										Monday, December 29, 2014 6:30 AM
										&middot;
																				<nobr>15 attending</nobr>
										</div>
				</td>
				<td style="background-color:#eee;width:76px;vertical-align:top;">
					<div style="display:inline-block;border:1px solid #9d1328;background-color:#e9003c;-moz-border-radius: 3px 3px 3px 3px;-webkit-border-radius: 3px 3px 3px 3px;border-radius: 3px 3px 3px 3px;text-align:center;"><span class="meetup-button-gradient" style="background-color:#e9003c;display:inline-block;"><a href="http://www.meetup.com/__ms9276606/Brisbane-Midweek-Mingles/events/219237532/t/md1_evn/?rv=md1&_af_eid=219237532&_af=event&expires=1419521111438&sig=ccdf41bc1224bd05b1bb16d097981bf99a60eac8" class="meetup-button-link" style="border-color:#e9003c;border-width:5px 18px;border-style:solid;font-family:arial,sans-serif;font-weight:bold;white-space:nowrap;color:#fff!important;display:inline-block;text-decoration:none;text-align:center;cursor:pointer;"><font color="#fff"><nobr>RSVP</nobr></font></a></span></div>
				</td>
			</tr>
		</table>
	</td>
</tr>
<tr>
	<td class="other-meetups-tearsheet" style="width:32px;background-color:#eee;vertical-align:top;border-top:1px solid #fff;padding:8px 0 8px 8px;">
		<div style="border:1px solid #555;">
			<div style="background-color:#555;text-transform:uppercase;color:#fff!important;font-weight:bold;text-align:center;font-size:9px;line-height:14px;height:14px;padding:0 4px;"><font color="#fff">Jan</font></div>
			<div style="background-color:#fff;font-size:16px;line-height:18px;height:18px;font-weight:bold;text-align:center;padding:1px 4px 0 4px;">03</div>
		</div>
	</td>
	<td style="vertical-align:top;padding:8px;border-top:1px solid #fff;">
		<table cellpadding="0" cellspacing="0" style="width:100%;">
			<tr>
				<td style="background-color:#eee;vertical-align:top;">
					<a href="http://www.meetup.com/__ms9276606/Brisbane-Midweek-Mingles/events/219214618/t/md1_evn/?rv=md1&_af_eid=219214618&_af=event&expires=1419521111439&sig=af696a57a900ffabb8d3afc2fee915a36ce0bca6" style="font-size:14px; color: #3987CB; text-decoration: none; ">Sandgate to Redcliffe</a><br/>
					<div style="padding:2px 0 4px 0;font-size:12px;line-height:16px;">
										Saturday, January 3, 2015 7:00 AM
										&middot;
																				<nobr>9 attending</nobr>
										</div>
				</td>
				<td style="background-color:#eee;width:76px;vertical-align:top;">
					<div style="display:inline-block;border:1px solid #9d1328;background-color:#e9003c;-moz-border-radius: 3px 3px 3px 3px;-webkit-border-radius: 3px 3px 3px 3px;border-radius: 3px 3px 3px 3px;text-align:center;"><span class="meetup-button-gradient" style="background-color:#e9003c;display:inline-block;"><a href="http://www.meetup.com/__ms9276606/Brisbane-Midweek-Mingles/events/219214618/t/md1_evn/?rv=md1&_af_eid=219214618&_af=event&expires=1419521111439&sig=af696a57a900ffabb8d3afc2fee915a36ce0bca6" class="meetup-button-link" style="border-color:#e9003c;border-width:5px 18px;border-style:solid;font-family:arial,sans-serif;font-weight:bold;white-space:nowrap;color:#fff!important;display:inline-block;text-decoration:none;text-align:center;cursor:pointer;"><font color="#fff"><nobr>RSVP</nobr></font></a></span></div>
				</td>
			</tr>
		</table>
	</td>
</tr>
</table>
</div>
					';
			
			return $content;
		}

	/*
	 * 
	 */
	function event_is_new ($event, $num_days) {
		
		$date = new DateTime($event->post_date);
		$now = new DateTime();
		
		//error_log ('Post: ' . $event->post_title . ', post date: ' . $date->format('Y-m-d H:i:s') . ', now: ' . $now->format('Y-m-d H:i:s'));
		
		$diff = $now->diff($date);
		
		if($diff->days <= $num_days) {
			
			return true;
		}
		
		return false;
	}
	
	
	/*
	 * Create HTML message for comment notification messages.
	 * Gets the content of the private post with the slug 'email-template-comment'.
	 * To
	 * Post title
	 * Comment user
	 * Comment text
	 * 
	 */
	function build_rsvp_notification_email ($user_to, $post_title, $event_date, $event_time, $post_url, $rsvp_event, $upcoming_events) {

		$slug = $this->slug_rsvp_post; // TODO: Move this into settings.
			
		$my_post = get_page_by_path($slug, OBJECT, 'post');
		
		if( !isset ($my_post) ) {
			error_log ('Cannot get_page_by_path for slug \''. $slug .'\'.');
			return null;
		}
		
		$email_content = apply_filters('the_content', get_post_field('post_content', $my_post->ID));
			
		// Replace fields.
		$email_content = str_replace ('[name]', $user_to, $email_content);
		$email_content = str_replace ('[event_title]', $post_title, $email_content);
		$email_content = str_replace ('[event_date]', $event_date, $email_content);
		$email_content = str_replace ('[event_time]', $event_time, $email_content);
		$email_content = str_replace ('__EVENT_URL__', $post_url, $email_content);

		$email_content = str_replace ('<p>[rsvp_events_list]</p>', $this->build_event_bullets($rsvp_event, true), $email_content);
		
		// Add up-coming events to the email.
		if (isset ($upcoming_events)) {

			$email_content = str_replace ('<p>[upcoming_events_list]</p>', $this->build_event_bullets($upcoming_events), $email_content);
		}

		$email_content = str_replace ('<p>', $this->p_style, $email_content);
		
		// Work around the UTC bug...
		date_default_timezone_set('Australia/Brisbane');
		
		$head_lines  = '<meta name="bimbler-generated" content="' . date("Y-m-d H:i:s") . '">' . PHP_EOL;
		$head_lines .= '<meta name="bimbler-generated-by" content="' . $_SERVER["REMOTE_ADDR"] . '">' . PHP_EOL;
		
		return $this->email_html_head . PHP_EOL . $head_lines . PHP_EOL . $this->email_end_head . PHP_EOL .$this->email_style . PHP_EOL . $email_content . $this->email_html_foot;
	}

	/*
	 * Create HTML message for comment notification messages.
	 * Gets the content of the private post with the slug 'email-template-comment'.
	 * To
	 * Post title
	 * Comment user
	 * Comment text
	 *
	 */
	function build_rsvp_confirmation_email ($user_to, $post_title, $event_date, $event_time, $post_url, $rsvp_event, $upcoming_events) {
	
		$slug = $this->slug_rsvp_conf_post; // TODO: Move this into settings.
			
		$my_post = get_page_by_path($slug, OBJECT, 'post');
	
		if( !isset ($my_post) ) {
			error_log ('Cannot get_page_by_path for slug \''. $slug .'\'.');
			return null;
		}
	
		$email_content = apply_filters('the_content', get_post_field('post_content', $my_post->ID));
			
		// Replace fields.
		$email_content = str_replace ('[name]', $user_to, $email_content);
		$email_content = str_replace ('[event_title]', $post_title, $email_content);
		$email_content = str_replace ('[event_date]', $event_date, $email_content);
		$email_content = str_replace ('[event_time]', $event_time, $email_content);
		$email_content = str_replace ('__EVENT_URL__', $post_url, $email_content);
	
		$email_content = str_replace ('<p>[rsvp_events_list]</p>', $this->build_event_bullets($rsvp_event, true), $email_content);
	
		// Add up-coming events to the email.
		if (isset ($upcoming_events)) {
	
			$email_content = str_replace ('<p>[upcoming_events_list]</p>', $this->build_event_bullets($upcoming_events), $email_content);
		}
	
		$email_content = str_replace ('<p>', $this->p_style, $email_content);
	
		// Work around the UTC bug...
		date_default_timezone_set('Australia/Brisbane');
		
		$head_lines  = '<meta name="bimbler-generated" content="' . date("Y-m-d H:i:s") . '">' . PHP_EOL;
		$head_lines .= '<meta name="bimbler-generated-by" content="' . $_SERVER["REMOTE_ADDR"] . '">' . PHP_EOL;
	
		return $this->email_html_head . PHP_EOL . $head_lines . PHP_EOL . $this->email_end_head . PHP_EOL .$this->email_style . PHP_EOL . $email_content . $this->email_html_foot;
	}
	/*
	 * 
	 */
	function build_event_bullets ($events, $map = false, $new_days = 28) {
		
		$event_bullets = $this->event_list_table_top() . PHP_EOL;
			
		// [upcoming_events_list] is to be replaced with a bulletted list of event descriptions and URLs.
		foreach ($events as $event) {
				
			$event_url = get_permalink ($event->ID);
			$event_title = $event->post_title;
			$event_start = tribe_get_start_date($event->ID, false, 'l, j F') . ' at ' . tribe_get_start_date($event->ID, false, 'g:ia');
			$event_month = tribe_get_start_date($event->ID, false, 'M');
			$event_day = tribe_get_start_date($event->ID, false, 'j');
			$event_weekday = tribe_get_start_date($event->ID, false, 'D');
			$event_attendees = Bimbler_RSVP::get_instance()->count_rsvps ($event->ID);
		
			if (!isset ($event_attendees)) { 
				$event_attendees = '0'; 
			}
			
			$event_bullets .= $this->event_list_row_top() . PHP_EOL;
			$event_bullets .= $this->event_list_calendar($event_month, $event_day, $event_weekday) . PHP_EOL;
			$event_bullets .= $this->event_list_details($event_url, $event_title, $event_start, $event_attendees, $this->event_is_new ($event, $new_days)) . PHP_EOL;
			$event_bullets .= $this->event_list_row_bottom() . PHP_EOL;
			
			if ($map && tribe_has_venue($event->ID)) {
				$event_bullets .= $this->event_list_row_top() . PHP_EOL;
				$event_bullets .= $this->event_list_map($event) . PHP_EOL;				
				$event_bullets .= $this->event_list_row_bottom() . PHP_EOL;
			}
		}
		
		$event_bullets .= $this->event_list_table_bottom() . PHP_EOL;
		
		return $event_bullets;
	}
	
	/*
	 * Create HTML message for upcoming event reminder messages.
	 * Gets the content of the private post with the slug 'email-template-upcoming-reminder'.
	 * To
	 * Post title
	 * Comment user
	 * Comment text
	 * 
	 */
	//function build_upcoming_notification_email ($events, $user_to) {
	function build_upcoming_notification_email ($bimbler_events, $mingler_events, $social_events, $user_to) {
		
		$slug = $this->slug_upcoming_post; // TODO: Move this into settings.
	
		$my_post = get_page_by_path($slug, OBJECT, 'post');
			
		if( !isset ($my_post) ) {
			error_log ('Cannot get_page_by_path for slug \''. $slug .'\'.');
			return null;
		}
			
		$email_content = apply_filters('the_content', get_post_field('post_content', $my_post->ID));
	
		// Replace fields.
		$email_content = str_replace ('[name]', $user_to, $email_content);

		// Bimbles.
		$event_bullets = $this->build_event_bullets($bimbler_events);
		$email_content = str_replace ('<p>[upcoming_bimbler_events_list]</p>', $event_bullets, $email_content);

		// Mingles.
		$event_bullets = $this->build_event_bullets($mingler_events);
		$email_content = str_replace ('<p>[upcoming_mingler_events_list]</p>', $event_bullets, $email_content);

		// Social.
		$event_bullets = $this->build_event_bullets($social_events);
		$email_content = str_replace ('<p>[upcoming_social_events_list]</p>', $event_bullets, $email_content);

		//$event_bullets = $this->build_event_bullets($events);
		//$email_content = str_replace ('<p>[upcoming_events_list]</p>', $event_bullets, $email_content);
		
		$email_content = str_replace ('<p>', $this->p_style, $email_content);

		// Work around the UTC bug...
		date_default_timezone_set('Australia/Brisbane');
		
		$head_lines  = '<meta name="bimbler-generated" content="' . date("Y-m-d H:i:s") . '">' . PHP_EOL;
		$head_lines .= '<meta name="bimbler-generated-by" content="' . $_SERVER["REMOTE_ADDR"] . '">' . PHP_EOL;
					
		return $this->email_html_head . PHP_EOL . $head_lines . PHP_EOL . $this->email_style . PHP_EOL . $this->email_end_head . PHP_EOL . $email_content . $this->email_html_foot;
	}
		
	/*
	 * 
	 *
	 */
	function send_rsvp_reminders($atts) {
		
		$content = '';
		
		$content .= '<p>Remote host: ' . $_SERVER["REMOTE_ADDR"] . '</p>';
		
		$host = $_SERVER["REMOTE_ADDR"];
		$local_ip = getHostByName(getHostName());
		
		error_log ('HTTP host: ' . $host . ', Local IP: ' . $local_ip);
		
//		if ( !current_user_can( 'manage_options' ) && ('103.16.128.51' != $host))  {
		if ( !current_user_can( 'manage_options' ) && ($local_ip != $host))  {
			$content = '<div class="bimbler-alert-box error"><span>Error: </span>You must be an admin user to view this page.</div>';
			
			error_log ('send_rsvp_reminders called by non-admin or not from localhost.');
				
			return $content;
		} 
		
		$a = shortcode_atts (array (
								'ahead' 	=> 7,
								'send_mail' => 'Y',
								'test' 		=> 'N',
		), $atts);
		
		if (!isset ($a)) {
			error_log ('send_rsvp_reminders called with no parameters set.');
			return;
		}
		
		// Work around the UTC bug...
		date_default_timezone_set('Australia/Brisbane');
		
		$date_from = date('Y-m-d', strtotime($a['ahead'] . ' days'));
		$date_to = date('Y-m-d', strtotime($a['ahead'] + 1 . ' days'));
		
		error_log ('Considering RSVP reminders from ' . $date_from . ' to ' . $date_to);
		
		$content .= '<h5>Input Parameters</h5>';
		$content .= 'Days ahead: ' . $a['ahead'] . '<br>';
		$content .= 'From (&gt;=): ' . $date_from . '<br>';
		$content .= 'To (&lt;): ' . $date_to . '<br>';
		$content .= 'Send emails: ' . $a['send_mail'] . '<br>';
		$content .= 'Test mode: ' . $a['test'] . '<br><br>';
		
/*		$get_posts = tribe_get_events(array('eventDisplay'		=> 'all',
											'start_date' 		=> $date_from,
											'end_date' 			=> $date_to,
											'posts_per_page' 	=> -1) ); */  
		
		// Show events which have a start date between the from- and to-dates.
		// Don't show in-flight events which have already started.
		$get_posts = tribe_get_events( array(
				'eventDisplay' 	=> 'custom',
				'posts_per_page'=>	-1,
				'meta_query' 	=> array(
						'relation' => 'AND',
						array(
								'key' 		=> '_EventStartDate',
								'value' 	=> $date_from,
								'compare' 	=> '>=',
								'type' 		=> 'date'
						),
						array(
								'key' 		=> '_EventStartDate',
								'value' 	=> $date_to,
								'compare' 	=> '<',
								'type' 		=> 'date'
						),
						'orderby' 	=> '_EventEndDate',
						'order'	 	=> 'ASC'
				)));
		
		
		// Get any up-coming events. Get events from the day after the RSVPd event.
		$upcoming_events = $this->get_upcoming_events($date_to, null);
		
		$content .= '<h5>Events to Consider</h5>';
		
		foreach($get_posts as $post) { 
			
			error_log('Sending reminder emails for event \'' .  $post->post_title . '\' on ' . tribe_get_start_date($post->ID, true, 'Y-m-d'));
			
			$rsvp_events = array ();
			$rsvp_events[] = $post;
			
			$notify_users = array ();
			
			// Always send mails to admins. // Paul (user ID 1).
			$notify_users = array_merge ($notify_users, Bimbler_RSVP::get_instance()->get_admin_users());
			
			$users_rsvp = $this->get_rsvpd_users ($post->ID);
			$users_hosts = $this->get_event_host_users ($post->ID);
			
			$post_url = get_permalink ($post->ID);
			
			if (isset ($users_rsvp)) {
				$notify_users = array_merge ($notify_users, $users_rsvp);
			}
			
			if (isset ($users_hosts)) {
				$notify_users = array_merge ($notify_users, $users_hosts);
			}

			$content .= 'ID: ' . $post->ID;
			$content .= '; Date: ' . tribe_get_start_date($post->ID, true, 'Y-m-d');
			$content .= '; Title: \'' . $post->post_title . '\'';
			$content .= '; URL: \'' . $post_url . '\'';
			$content .= '<br>';
			$content .= '; Users: ';
				
			foreach (array_unique ($notify_users) as $notify_user) {
				
				$user_object = get_userdata ($notify_user);
					
				if (!isset ($user_object)) {
					error_log ('Cannot get_userdata for user ID '. $notify_user);
					return null;
				}
			
				$content .= $notify_user . ', ';

				if ('Y' == $a['send_mail']) {
					error_log ('Notifying user '. $notify_user .' ('. $user_object->first_name .' ' . $user_object->last_name .') at '. $user_object->user_email);
						
					$email_content = $this->build_rsvp_notification_email ($user_object->first_name,
																		$post->post_title,
																		tribe_get_start_date($post->ID, false, 'l, j F'),
																		tribe_get_start_date($post->ID, false, 'g:ia'),
																		$post_url,
																		$rsvp_events,
																		$upcoming_events);
						
					if (!isset ($email_content)) {
						error_log ('Cannot create comment notification email content.');
						return null;
					}
					
					//error_log ('RSVP Email content:');
					//error_log ($email_content);
				
					$subject = 'Brisbane Bimblers - '. $post->post_title;
				
					// Filters for the email
					add_filter( 'wp_mail_from', array( $this, 'get_from_address' ) );
					add_filter( 'wp_mail_from_name', array( $this, 'get_from_name' ) );
					add_filter( 'wp_mail_content_type', array( $this, 'get_content_type' ) );
						
					// Test mode - only send emails to Paul (one for each RSVPd member).
					if ('Y' == $a['test']) {
						error_log ('Test mode set: sending mail to paul@paulperkins.net');
						wp_mail( 'paul@paulperkins.net', $subject, $email_content);
						
					} else {
						
						wp_mail( $user_object->user_email, $subject, $email_content);
					}
						
					// Unhook filters
					remove_filter( 'wp_mail_from', array( $this, 'get_from_address' ) );
					remove_filter( 'wp_mail_from_name', array( $this, 'get_from_name' ) );
					remove_filter( 'wp_mail_content_type', array( $this, 'get_content_type' ) ); 
				}
				
				unset ($notify_users);
			}

			$content .= '<br>';
		} 
		
		return $content;
	}
	
	/*
	 *
	 *
	 */
	function send_rsvp_confirmation($user_id, $event_id) {
	
		$test_mode = 'N';
		
		$post = get_post ($event_id);
		
		error_log('Sending RSVP confirmation email for event \'' .  $post->post_title . '\' on ' . tribe_get_start_date($post->ID, true, 'Y-m-d'));
		
		$rsvp_events = array ();
		$rsvp_events[] = $post;
			
		$notify_users = array ();
			
		// Always send mails to admins.
		$notify_users = array_merge ($notify_users, Bimbler_RSVP::get_instance()->get_admin_users());

		$users_rsvp = array ();
		$users_rsvp [] = $user_id;
		
		$users_hosts = $this->get_event_host_users ($post->ID);
			
		$post_url = get_permalink ($post->ID);
			
		if (isset ($users_rsvp)) {
			$notify_users = array_merge ($notify_users, $users_rsvp);
		}
			
		if (isset ($users_hosts)) {
			$notify_users = array_merge ($notify_users, $users_hosts);
		}

		// RSVP user.
		$rsvp_user_object = get_userdata ($user_id);
		
		// Work around the UTC bug...
		date_default_timezone_set('Australia/Brisbane');
		
		// Get any up-coming events. Get events from tomorrow, exclude this event.
		$upcoming_events = $this->get_upcoming_events_exclude(date('Y-m-d', strtotime('1 days')), $post->ID);
		
		foreach (array_unique ($notify_users) as $notify_user) {

			$user_object = get_userdata ($notify_user);
				
			if (!isset ($user_object)) {
				error_log ('Cannot get_userdata for user ID '. $notify_user);
				return null;
			}
			
			error_log ('Notifying user '. $notify_user .' ('. $user_object->first_name .' ' . $user_object->last_name .') at '. $user_object->user_email);

			$email_content = $this->build_rsvp_confirmation_email ($rsvp_user_object->first_name,
					$post->post_title,
					tribe_get_start_date($post->ID, false, 'l, j F'),
					tribe_get_start_date($post->ID, false, 'g:ia'),
					$post_url,
					$rsvp_events,
					$upcoming_events);

			if (!isset ($email_content)) {
				error_log ('Cannot create RSVP confirmation email content.');
				return null;
			}
				
			//error_log ('RSVP Email content:');
			//error_log ($email_content);

			$subject = 'Brisbane Bimblers - RSVP Confirmation for '. $post->post_title;

			// Filters for the email
			add_filter( 'wp_mail_from', array( $this, 'get_from_address' ) );
			add_filter( 'wp_mail_from_name', array( $this, 'get_from_name' ) );
			add_filter( 'wp_mail_content_type', array( $this, 'get_content_type' ) );

			// Test mode - only send emails to Paul (one for each RSVPd member).
			if ('Y' == $test_mode) {
				error_log ('Test mode set: sending mail to paul@paulperkins.net');
				wp_mail( 'paul@paulperkins.net', $subject, $email_content);

			} else {

				wp_mail( $user_object->user_email, $subject, $email_content);
			}

			// Unhook filters
			remove_filter( 'wp_mail_from', array( $this, 'get_from_address' ) );
			remove_filter( 'wp_mail_from_name', array( $this, 'get_from_name' ) );
			remove_filter( 'wp_mail_content_type', array( $this, 'get_content_type' ) );

			unset ($notify_users);
		}
	
		return null;
	}
	
	/*
	 * 
	 * 
	 * Called from externally.
	 */
	public function get_upcoming_events_html ($date_from) {
		
		// Second parameter is not used.
		$upcoming_events = $this->get_upcoming_events($date_from, null, 5);

		$output = $this->build_event_bullets($upcoming_events);
		
		return $output;
	}

	/*
	 * 
	 */
	function get_upcoming_events ($date_from, $date_to, $count = 4) {
		
		$get_posts = tribe_get_events(array('eventDisplay'		=> 'all',
				'start_date' 		=> $date_from,
				//'end_date' 			=> $date_to,
				'posts_per_page' 	=> $count) );
		
		return $get_posts;
	}

	/*
	 * 
	 */
	function get_upcoming_events_by_cat ($date_from, $date_to, $category, $count = 4) {
		
/*		$get_posts = tribe_get_events(array('eventDisplay'		=> 'all',
				'start_date' 		=> $date_from,
				//'end_date' 			=> $date_to,
				'posts_per_page' 	=> $count) ); */
		
		$get_posts = tribe_get_events(array(
			'start_date' 		=> $date_from,
			'posts_per_page' 	=> $count,
			'eventDisplay' 		=> 'all',
			'tax_query' 		=> array(
										array(
											'taxonomy' => TribeEvents::TAXONOMY,
														'field' => 'slug',
														'terms' => $category),
										)
										));
		
		return $get_posts;
	}
	
	
	function get_upcoming_events_exclude ($date_from, $exclude, $count = 4) {
	
		$get_posts = tribe_get_events(array('eventDisplay'		=> 'all',
				'start_date' 		=> $date_from,
				'posts_per_page' 	=> $count,
				'post__not_in' => array ($exclude)) );
	
		return $get_posts;
	}
	
	
	/*
	 *
	 *
	 */
	function send_upcoming_reminders($atts) {
	
		$host = $_SERVER["REMOTE_ADDR"];
		$local_ip = getHostByName(getHostName());
		
		error_log ('HTTP host: ' . $host . ', Local IP: ' . $local_ip);
		
//		if ( !current_user_can( 'manage_options' ) && ('103.16.128.51' != $host))  {
		if ( !current_user_can( 'manage_options' ) && ($local_ip != $host))  {
			$content = '<div class="bimbler-alert-box error"><span>Error: </span>You must be an admin user to view this page.</div>';
			
			error_log ('send_upcoming_reminders called by non-admin or not from localhost.');
			
			return $content;
		} 
				
		$a = shortcode_atts (array (
				'days_from' => $this->default_days_from,
				'days_to' 	=> $this->default_days_to,
				'num_events' => 4,
				'send_mail' => 'Y',
				'test' 		=> 'N',
		), $atts);
	
		if (!isset ($a)) {
			error_log ('send_upcoming_reminders called with no parameters set.');
			return;
		}
	
		// Work around the UTC bug...
		date_default_timezone_set('Australia/Brisbane');
		
		$date_from = date('Y-m-d', strtotime($a['days_from'] . ' days'));
		$date_to = date('Y-m-d', strtotime($a['days_to'] + 1 . ' days'));
	
		//error_log ('Considering upcoming event reminders from ' . $date_from . ' to ' . $date_to);
		error_log ('Considering upcoming event reminders from ' . $date_from . ', maximum ' . $a['num_events'] . ' events.');
		
		$content  = '<h5>Input Parameters</h5>';
		$content .= 'Days ahead from: ' . $a['days_from'] . '<br>';
		//$content .= 'Days ahead to: ' . $a['days_to'] . '<br>';
		$content .= 'From (&gt;=): ' . $date_from . '<br>';
		//$content .= 'To (&lt;): ' . $date_to . '<br>';
		$content .= 'Max events: ' . $a['num_events'] . '<br>';
		$content .= 'Send emails: ' . $a['send_mail'] . '<br>';
		$content .= 'Test mode: ' . $a['test'] . '<br><br>';
	
	
	// xxxx 
		$get_posts = $this->get_upcoming_events($date_from, $date_to, $a['num_events']);
		$bimble_posts = $this->get_upcoming_events_by_cat($date_from, $date_to, 'bimble', $a['num_events']);
		$mingle_posts = $this->get_upcoming_events_by_cat($date_from, $date_to, 'mingle', $a['num_events']);
		$social_posts = $this->get_upcoming_events_by_cat($date_from, $date_to, 'social', $a['num_events']);
		
		/*$get_posts = tribe_get_events(array('eventDisplay'		=> 'all',
				'start_date' 		=> $date_from,
				'end_date' 			=> $date_to,
				'posts_per_page' 	=> -1) ); */
	
		$content .= '<h5>Events to Consider</h5>';
	
/*		foreach($get_posts as $post) {
				
			error_log('Sending reminder emails for event \'' .  $post->post_title . '\' on ' . tribe_get_start_date($post->ID, true, 'Y-m-d'));
				
			$content .= 'ID: ' . $post->ID;
			$content .= '; Date: ' . tribe_get_start_date($post->ID, true, 'Y-m-d');
			$content .= '; Title: \'' . $post->post_title . '\'';
			$content .= '; URL: \'' . get_permalink ($post->ID) . '\'';
			$content .= '<br>';
		} */

		error_log('Sending reminder emails for:');
		error_log('    Bimbles: ' . count ($bimble_posts));
		error_log('    Mingles: ' . count ($mingle_posts));
		error_log('    Social : ' . count ($social_posts));

		$content .= 'Sending reminder emails for: <br>';
		$content .= '    Bimbles: ' . count ($bimble_posts) . '<br>';
		$content .= '    Mingles: ' . count ($mingle_posts) . '<br>';
		$content .= '    Social : ' . count ($social_posts) . '<br><br>';

		
//		if (0 < count ($get_posts))
		if (0 < (count ($bimble_posts) + count ($mingle_posts) + count ($social_posts)))
		{
			//setup_postdata($post);
			$notify_users = array ();
			
			// Always send mails to admin team.
			$notify_users = array_merge ($notify_users, Bimbler_RSVP::get_instance()->get_admin_users());

			// Send to all users if not in test mode.
			if ('Y' != $a['test']) {
				$users_rsvp = $this->get_all_users ();
				
				if (isset ($users_rsvp)) {
					$notify_users = array_merge ($notify_users, $users_rsvp);
				} 
			}
			
			foreach (array_unique ($notify_users) as $notify_user) {
	
				$user_object = get_userdata ($notify_user);
					
				if (!isset ($user_object)) {
					error_log ('Cannot get_userdata for user ID '. $notify_user);
					return null;
				}
	
				if ('Y' == $a['send_mail']) {
					error_log ('Notifying user '. $notify_user .' ('. $user_object->first_name .' ' . $user_object->last_name .') at '. $user_object->user_email);
						
					$email_content = $this->build_upcoming_notification_email (
							//$get_posts, // xxxx
							$bimble_posts,
							$mingle_posts,
							$social_posts,
							$user_object->first_name);
	
					if (!isset ($email_content)) {
						error_log ('Cannot create comment notification email content.');
						return null;
					}
	
					//error_log ('Upcoming Email content:');
					//error_log ($email_content);
					
					// Work around the UTC bug...
					date_default_timezone_set('Australia/Brisbane');
						
					$subject = 'Brisbane Bimblers - Up-coming Events (' . date("d/m/Y") . ')';
	
					// Filters for the email
					add_filter( 'wp_mail_from', array( $this, 'get_from_address' ) );
					add_filter( 'wp_mail_from_name', array( $this, 'get_from_name' ) );
					add_filter( 'wp_mail_content_type', array( $this, 'get_content_type' ) );
	
					//error_log ('Email content:');
					//error_log ($email_content);
					
					// Test mode - only send emails to Paul (one for each RSVPd member).
					if ('Y' == $a['test']) {
						error_log ('Test mode set: sending mail to paul@paulperkins.net');
						wp_mail( 'paul@paulperkins.net', $subject, $email_content);
					} else {
						wp_mail( $user_object->user_email, $subject, $email_content);
					}
	
					// Unhook filters
					remove_filter( 'wp_mail_from', array( $this, 'get_from_address' ) );
					remove_filter( 'wp_mail_from_name', array( $this, 'get_from_name' ) );
					remove_filter( 'wp_mail_content_type', array( $this, 'get_content_type' ) );
				}
	
				unset ($notify_users);
			}
	
			$content .= '<br>';
		}
	
		return $content;
	}
		
		
} // End class
