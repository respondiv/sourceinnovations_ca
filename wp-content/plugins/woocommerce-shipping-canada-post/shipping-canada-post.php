<?php
/*
	Plugin Name: WooCommerce Canada Post
	Plugin URI: http://woothemes.com/woocommerce
	Description: Obtain shipping rates dynamically via the Canada Post API for your orders.
	Version: 2.3.4
	Author: WooThemes
	Author URI: http://woothemes.com

	Copyright: 2009-2011 WooThemes.
	License: GNU General Public License v3.0
	License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

/**
 * Required functions
 */
if ( ! function_exists( 'woothemes_queue_update' ) )
	require_once( 'woo-includes/woo-functions.php' );

/**
 * Plugin updates
 */
woothemes_queue_update( plugin_basename( __FILE__ ), 'ac029cdf3daba20b20c7b9be7dc00e0e', '18623' );

/**
 * Plugin activation check
 */
function wc_canada_post_activation_check(){
	if ( ! function_exists( 'simplexml_load_string' ) ) {
        deactivate_plugins( basename( __FILE__ ) );
        wp_die( "Sorry, but you can't run this plugin, it requires the SimpleXML library installed on your server/hosting to function." );
	}
}

register_activation_hook( __FILE__, 'wc_canada_post_activation_check' );

/**
 * Localisation
 */
load_plugin_textdomain( 'wc_canada_post', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

/**
 * Plugin page links
 */
function wc_canada_post_plugin_links( $links ) {

	$plugin_links = array(
		'<a href="' . admin_url( ( function_exists( 'WC' ) ? 'admin.php?page=wc-settings&tab=shipping&section=wc_shipping_canada_post' : 'admin.php?page=woocommerce_settings&tab=shipping&section=WC_Shipping_Canada_Post' ) ) . '">' . __( 'Settings', 'wc_canada_post' ) . '</a>',
		'<a href="http://support.woothemes.com/">' . __( 'Support', 'wc_canada_post' ) . '</a>',
		'<a href="http://wcdocs.woothemes.com/user-guide/canada-post/">' . __( 'Docs', 'wc_canada_post' ) . '</a>',
	);

	return array_merge( $plugin_links, $links );
}
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'wc_canada_post_plugin_links' );

/**
 * Check if WooCommerce is active
 */
if ( is_woocommerce_active() ) {

	define( 'WC_CANADA_POST_REGISTRATION_ENDPOINT', 'http://woothemes.com/wc-api/canada_post_registration' );

	/**
	 * Add admin notices
	 */
	function wc_canada_post_admin_notices() {
		global $woocommerce;

		if ( empty( $_GET['token-id'] ) && empty( $_GET['registration-status'] ) && ! get_option( 'wc_canada_post_customer_number' ) ) {
			?>
			<div id="message" class="updated woocommerce-message">
				<p><strong><?php _e( 'Connect your Canada Post Account', 'wc_canada_post' ); ?></strong> &ndash; <?php _e( 'Before you can start using Canada Post you need to register for an account, or connect an existing one.', 'wc_canada_post' ); ?></p>
				<p class="submit"><a href="<?php echo esc_url( add_query_arg( 'return_url', $woocommerce->api_request_url( 'canada_post_return' ), WC_CANADA_POST_REGISTRATION_ENDPOINT ) ); ?>" class="wc-update-now button-primary"><?php _e( 'Register/Connect', 'wc_canada_post' ); ?></a></p>
			</div>
			<?php
		}
	}
	add_action( 'admin_notices', 'wc_canada_post_admin_notices' );

	/**
	 * When returning from CP, redirect to settings
	 */
	function wc_canada_post_api_canada_post_return() {
		if ( isset( $_GET['token-id'] ) && isset( $_GET['registration-status'] ) ) {
			switch ( $_GET['registration-status'] ) {
				case 'CANCELLED' :
					wp_die( __( 'The Canada Post extension will be unable to get quotes on your behalf until you accept the terms and conditons.', 'wc_canada_post' ) );
				break;
				case 'SUCCESS' :
					// Get details
					$details = wp_remote_get( 
						add_query_arg( 'token', sanitize_text_field( $_GET['token-id'] ), WC_CANADA_POST_REGISTRATION_ENDPOINT ),
						array(
							'method'      => 'GET',
							'timeout'     => 45,
							'redirection' => 5,
							'httpversion' => '1.0',
							'blocking'    => true,
							'headers'     => array( 'user-agent' => 'WCAPI/1.0.0' ),
							'cookies'     => array(),
							'sslverify'   => false
						)
					);
					$details = (array) json_decode( $details['body'] );

					if ( ! empty( $details['customer-number'] ) ) {

						update_option( 'wc_canada_post_customer_number', sanitize_text_field( $details['customer-number'] ) );
						update_option( 'wc_canada_post_contract_number', sanitize_text_field( $details['contract-number'] ) );
						update_option( 'wc_canada_post_merchant_username', sanitize_text_field( $details['merchant-username'] ) );
						update_option( 'wc_canada_post_merchant_password', sanitize_text_field( $details['merchant-password'] ) );
						
					} else {
						wp_die( __( 'Unable to get merchant info - please try again later.', 'wc_canada_post' ) );
					}
				break;
				default :
					wp_die( __( 'Unable to get registration token - please try again later.', 'wc_canada_post' ) );
				break;
			}

			wp_redirect( admin_url( ( function_exists( 'WC' ) ? 'admin.php?page=wc-settings&tab=shipping&section=wc_shipping_canada_post' : 'admin.php?page=woocommerce_settings&tab=shipping&section=WC_Shipping_Canada_Post' ) ) );
			exit;
		}
	}
	add_action( 'woocommerce_api_canada_post_return', 'wc_canada_post_api_canada_post_return' );

	/**
	 * woocommerce_init_shipping_table_rate function.
	 *
	 * @access public
	 * @return void
	 */
	function wc_canada_post_init() {
		include_once( 'classes/class-wc-shipping-canada-post.php' );
	}
	add_action( 'woocommerce_shipping_init', 'wc_canada_post_init' );

	/**
	 * wc_canada_post_add_method function.
	 *
	 * @access public
	 * @param mixed $methods
	 * @return void
	 */
	function wc_canada_post_add_method( $methods ) {
		$methods[] = 'WC_Shipping_Canada_Post';
		return $methods;
	}
	add_filter( 'woocommerce_shipping_methods', 'wc_canada_post_add_method' );

	/**
	 * wc_canada_post_scripts function.
	 *
	 * @access public
	 * @return void
	 */
	function wc_canada_post_scripts() {
		wp_enqueue_script( 'jquery-ui-sortable' );
	}
	add_action( 'admin_enqueue_scripts', 'wc_canada_post_scripts' );
}