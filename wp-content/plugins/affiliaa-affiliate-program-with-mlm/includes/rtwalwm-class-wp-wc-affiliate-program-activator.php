<?php

/**
 * Fired during plugin activation
 *
 * @link       http://www.redefiningtheweb.com
 * @since      1.0.0
 *
 * @package    Rtwalwm_Wp_Wc_Affiliate_Program
 * @subpackage Rtwalwm_Wp_Wc_Affiliate_Program/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Rtwalwm_Wp_Wc_Affiliate_Program
 * @subpackage Rtwalwm_Wp_Wc_Affiliate_Program/includes
 * @author     RedefiningTheWeb <developer@redefiningtheweb.com>
 */
class Rtwalwm_Wp_Wc_Affiliate_Program_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function rtwalwm_activate() {

		update_option( 'rtwalwm_affiliate_lite', true );
		// create custom page for affiliates
		$rtwwwap_aff_page_id 		= get_option( 'rtwwwap_affiliate_page_id','' );
		$rtwalwm_if_page_exists 	= get_post( $rtwwwap_aff_page_id );

		if( empty( $rtwalwm_if_page_exists ) ){
		    $rtwalwm_my_post = array(
		      'post_title'    => wp_strip_all_tags( 'Affiliate Page' ),
		      'post_content'  => '[rtwwwap_affiliate_page]',
		      'post_status'   => 'publish',
		      'post_author'   => 1,
		      'post_type'     => 'page'
		    );

		    update_option( 'rtwwwap_affiliate_page_id', wp_insert_post( $rtwalwm_my_post ) );
		}



		$custom_email = array(

			'Signup Email'=> array(
				'subject'=> esc_html__('Welcome to our MLM system', 'rtwalwm-wp-wc-affiliate-program'),
				'content'=> esc_html__('Thank you for registering, You are now member of our team.', 'rtwalwm-wp-wc-affiliate-program'),
			),
			'Become an affiliate Email'=> array(
				'subject'=> esc_html__('You are now Member of our Team', 'rtwalwm-wp-wc-affiliate-program'),
				'content'=> esc_html__('An affiliate is Requested to be an affiliate of your site', 'rtwalwm-wp-wc-affiliate-program'),
			),
			'Email on Withdral Request'=> array(
				'subject'=> esc_html__('Request for commission withdraw', 'rtwalwm-wp-wc-affiliate-program'),
				'content'=> esc_html__('A new withdrawal request is generated of amount', 'rtwalwm-wp-wc-affiliate-program'),
			),
			'Email on Generating Commission'=> array(
				'subject'=> esc_html__('One new Commission is generated', 'rtwalwm-wp-wc-affiliate-program'),
				'content'=> esc_html__('Generated a new referral of amount', 'rtwalwm-wp-wc-affiliate-program'), 
			),
			'Email on Generating MLM Commission'=> array(
				'subject'=> esc_html__('One new MLM Commission is generated', 'rtwalwm-wp-wc-affiliate-program'),
				'content'=> esc_html__('You got a new MLM commission of amount', 'rtwalwm-wp-wc-affiliate-program'),
			)
		);

		update_option('customize_email',$custom_email);

		// Khi hiển thị trên giao diện người dùng:
foreach ($custom_email as $email_key => $email_data) {
    $translated_key = esc_html__($email_key, 'rtwalwm-wp-wc-affiliate-program');
    echo '<tr>';
    echo '<td>' . $translated_key . '</td>';
    echo '<td>' . $email_data['subject'] . '</td>';
    echo '<td>' . $email_data['content'] . '</td>';
    echo '</tr>';
}

		// create table
		global $wpdb;
		global $rtwalwm_db_version;
		$sql 				= array();
		$rtwalwm_db_version = '2.0.0';
		$rtwalwm_install_ver= get_option( "rtwalwm_db_version" );
		$charset_collate 	= $wpdb->get_charset_collate();

		// referral table
		$table_name_referral = $wpdb->prefix . 'rtwwwap_referrals';

		if( $wpdb->get_var("show tables like '". $table_name_referral . "'") !== $table_name_referral || ( $rtwalwm_install_ver != $rtwalwm_db_version ) )
		{
			$sql[] = "CREATE TABLE $table_name_referral (
				id mediumint(9) NOT NULL AUTO_INCREMENT,
				aff_id bigint(20) NOT NULL,
				type tinyint(1) NOT NULL,
				order_id bigint(20) NOT NULL,
				batch_id varchar(100) NOT NULL,
				date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
				status tinyint(2) DEFAULT '0' NOT NULL,
				amount decimal(12,2) NOT NULL,
				capped tinyint(1) DEFAULT '0' NOT NULL,
				currency varchar(55) DEFAULT '' NOT NULL,
				product_details longtext NOT NULL,
				payment_type varchar(50) NOT NULL,
				device varchar(50) NOT NULL,
				signed_up_id int(10) NOT NULL,
				payment_create_date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
				payment_update_date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
				message varchar(150) DEFAULT '',
				PRIMARY KEY  (id)
			) $charset_collate;";
		}

		// mlm table
		$table_name_mlm = $wpdb->prefix.'rtwwwap_mlm';

		if( $wpdb->get_var("show tables like '". $table_name_mlm . "'") !== $table_name_mlm )
		{
			$sql[] = "CREATE TABLE $table_name_mlm (
				id mediumint(9) NOT NULL AUTO_INCREMENT,
				aff_id bigint(20) NOT NULL,
				parent_id bigint(20) NOT NULL,
				status tinyint(1) DEFAULT '1' NOT NULL,
				last_activity datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
				added_date datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
				PRIMARY KEY  (id)
			) $charset_collate;";
		}


		if( !empty( $sql ) ){
			if( ! function_exists( 'dbDelta' ) ){
				require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			}
			dbDelta( $sql );

			add_option( 'rtwalwm_db_version', $rtwalwm_db_version );

			if( $rtwalwm_install_ver != $rtwalwm_db_version ){
				update_option( 'rtwalwm_db_version', $rtwalwm_db_version );
			}
		}
	}
}
