<?php
/********************************************************************
*
*	Penny Auction Theme for WordPress - sitemile.com
*	http://sitemile.com/products/wordpress-penny-auction-theme/
*	Copyright (c) 2012 sitemile.com
*	Coder: Saioc Dragos Andrei
*	Email: andreisaioc@gmail.com
*
*********************************************************************/
    
    //update_option('gmt_offset','-7.0');

	load_theme_textdomain( 'PennyTheme',  TEMPLATEPATH . '/languages' );
	
	DEFINE("PENNYTHEME_VERSION", "1.3.0");
	DEFINE("PENNYTHEME_RELEASE", "13 September 2014");
    
    DEFINE("BUY_SEATS_PAGE_LINK", get_bloginfo('url')."/buy-seats/");
	global $default_search;
	$default_search = __("Begin to search by typing here...",'PennyTheme');

//---------------------------------------------------------------------------------------
	
	global $current_theme_locale_name;	
	$current_theme_locale_name = 'PennyTheme';
	
	
//---------------------------------------------------------------------------------------	
	
	include 'autosuggest.php';
	include 'lib/login_register/custom2.php';
	include 'lib/first_run.php';
	include 'lib/admin_menu.php';
	include 'lib/cronjob.php';
	include 'lib/first_run_emails.php';
	include 'lib/all_categories.php';
	include 'lib/adv_search.php';
	
	include 'my-upload.php';
	
	include 'lib/my_account/my_account.php';
	include 'lib/my_account/personal_info.php';
	include 'lib/my_account/payments.php';
	include 'lib/my_account/won_items.php';
	include 'lib/my_account/paid_shipped.php';
    include 'lib/my_account/expired_auctions.php';
	include 'lib/my_account/my_bids.php';
    include 'lib/my_account/my_seats.php';
    include 'lib/my_account/my_available_credits.php';
    include 'lib/my_account/my_bid_balance.php';
	include 'lib/my_account/paid_and_not_shipped.php';
	include 'lib/my_account/unpaid.php';
	include 'lib/my_account/purchase_bids.php';
    include 'lib/my_account/purchase_seats.php';
	include 'lib/watch_list.php';
	
	include 'lib/closed_auctions.php';
	
	include 'lib/widgets/browse-by-category.php';
	
	//include 'lib/social/social.php';
	
	add_shortcode('penny_theme_my_account', 							'PennyTheme_display_my_account_home_fncs');
	add_shortcode('penny_theme_my_account_payments', 					'PennyTheme_display_my_account_payments_fncs');
    add_shortcode('penny_theme_my_account_my_bid_balance', 				'PennyTheme_display_my_account_my_bid_balance_fncs');
	add_shortcode('penny_theme_my_account_purchase_bids', 				'PennyTheme_display_my_account_purchase_bids_fncs');
    add_shortcode('penny_theme_my_account_purchase_seats', 				'PennyTheme_display_my_account_purchase_seats_fncs');
	add_shortcode('penny_theme_show_all_categories', 					'PennyTheme_display_show_all_cats');
	 
	add_shortcode('PennyTheme_my_available_credits_page_id', 			'PennyTheme_display_my_available_credits_fncs');
	add_shortcode('penny_theme_my_account_bids', 						'PennyTheme_display_my_account_my_bids_fncs');
    add_shortcode('penny_theme_my_account_seats', 						'PennyTheme_display_my_account_my_seats_fncs');
	add_shortcode('penny_theme_my_account_won_auctions', 				'PennyTheme_display_my_account_won_itms_fncs');
	add_shortcode('penny_theme_my_account_unpaid_items', 				'PennyTheme_display_my_account_unpaid_itms_fncs');
	add_shortcode('penny_theme_my_account_paid_not_ship_items', 		'PennyTheme_display_my_account_paid_and_shipped_itms_fncs');
	add_shortcode('penny_theme_my_account_paid_ship_items', 			'PennyTheme_display_my_account_paid_ship_itms_fncs');
    add_shortcode('penny_theme_my_account_my_expired_auctions', 		'PennyTheme_display_my_account_my_expired_auctions_fncs');
	add_shortcode('penny_theme_my_account_personal_info', 				'PennyTheme_display_my_account_pers_inf_fncs');
	add_shortcode('penny_theme_adv_search', 							'PennyTheme_display_adv_search_fncs');
	add_shortcode('penny_theme_closed_auctions', 						'PennyTheme_display_closed_auctions');
	add_shortcode('penny_theme_watch_list', 							'PennyTheme_display_watch_list');
	
	
	add_action('admin_menu',							'PennyTheme_admin_main_menu_scr');
	add_action('admin_head',							'PennyTheme_admin_style_sheet');
	add_action('save_post',								'PennyTheme_save_custom_fields');
	add_action('init', 									'PennyTheme_create_post_type' );		
	add_action('wp_head', 								'PennyTheme_add_front_style');
	add_action('admin_head', 							'PennyTheme_admin_main_head_scr');
	add_action("manage_posts_custom_column", 			"PennyTheme_my_custom_columns");
	add_filter("manage_edit-auction_columns",			"PennyTheme_my_auctions_columns");
	add_action('widgets_init', 							'PennyTheme_framework_init_widgets' );
//---------------------------------------------------------------------------------------


	
	add_action('template_redirect', 			'pennyTheme_template_redirect');

	add_action('wp_ajax_new_package_action', 			'PennyTheme_new_package_action');
	add_action('wp_ajax_delete_package', 				'PennyTheme_delete_package');
	add_action('wp_ajax_update_package', 				'PennyTheme_update_package');
	add_action('wp_ajax_my_ajax_small_stuff', 			'PennyTheme_my_ajax_small_stuff');
	add_action('wp_ajax_nopriv_my_ajax_small_stuff', 	'PennyTheme_my_ajax_small_stuff');
	
	
	add_action('wp_ajax_bid_now_live_me', 				'PennyTheme_bid_now_live');
	add_action('wp_ajax_nopriv_bid_now_live_me', 		'PennyTheme_bid_now_live');
    
    add_action('wp_ajax_add_auction_timer', 			'PennyTheme_add_auction_timer');
	add_action('wp_ajax_nopriv_add_auction_timer', 		'PennyTheme_add_auction_timer');
	
	add_action('wp_ajax_nopriv_get_credits_act', 		'PennyTheme_get_credits_act');
	add_action('wp_ajax_get_credits_act', 				'PennyTheme_get_credits_act');
	add_action('wp_enqueue_scripts', 					'PennyTheme_add_theme_styles');
	add_action('query_vars', 							'PennyTheme_add_query_vars');
	add_action( 'init', 								'PennyTheme_register_my_menus' );
    
	
//----------------------------------------------------------------------------------------

require_once TEMPLATEPATH . '/lib/TGM-Plugin-Activation-master/class-tgm-plugin-activation.php';


function my_wp_trash_post ($post_id) {
    global $wpdb;
    $post_type = get_post_type( $post_id );
    $post_status = get_post_status( $post_id );
    if( $post_type == 'auction' && in_array($post_status, array('publish','draft','future')) ) {
        $sql = "SELECT seats, uid, total_cost FROM ".$wpdb->prefix."auctions_seats WHERE pid = '$post_id'";
		$res = $wpdb->get_results($sql);
        if( count( $res ) > 0 ){
            foreach( $res as $row ){
                $user_seats = $row->seats;
                $uid        = $row->uid;
                $total_cost = $row->total_cost;
                $sql2 = "SELECT 1 FROM ".$wpdb->prefix."user_available_credits WHERE uid = '$uid'";
                $res2 = $wpdb->get_results($sql2);
                if( count( $res2 ) > 0 ){
                    $wpdb->query("UPDATE ".$wpdb->prefix."user_available_credits SET credit = (credit+$total_cost) WHERE uid = '$uid' LIMIT 1");    
                }else{
                    $wpdb->query("INSERT INTO ".$wpdb->prefix."user_available_credits SET credit = '$total_cost', uid = '$uid' LIMIT 1");
                }
                $wpdb->query("DELETE FROM ".$wpdb->prefix."auctions_seats WHERE uid = '$uid' AND pid = '$post_id' LIMIT 1");        
            }
        }
    }
}
add_action('wp_trash_post', 'my_wp_trash_post');


add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );

function my_theme_register_required_plugins() {
    /**
    * Array of plugin arrays. Required keys are name and slug.
    * If the source is NOT from the .org repo, then source is also required.
    */
    $plugins = array(
        /** This is an example of how to include a plugin pre-packaged with a theme */
        array(
            'name' => 'ML SLIDER', // The plugin name
            'slug' => 'ml-slider', // The plugin slug (typically the folder name)
            'source' => get_stylesheet_directory() . '/plugins/ml-slider.zip', // The plugin source
            'required' => true,
        ),
        array(
            'name' => 'Simple Follow Me Social Buttons Widget', // The plugin name
            'slug' => 'simple-follow-me-social-buttons-widget', // The plugin slug (typically the folder name)
            'source' => get_stylesheet_directory() . '/plugins/simple-follow-me-social-buttons-widget.zip', // The plugin source
            'required' => true,
        ),
        array(
            'name' => 'WP Pagenavi', // The plugin name
            'slug' => 'wp-pagenavi', // The plugin slug (typically the folder name)
            'source' => get_stylesheet_directory() . '/plugins/wp-pagenavi.zip', // The plugin source
            'required' => true,
        ),
        array(
            'name' => 'Breadcrumb NavXT', // The plugin name
            'slug' => 'breadcrumb-navxt', // The plugin slug (typically the folder name)
            'source' => get_stylesheet_directory() . '/plugins/breadcrumb-navxt.zip', // The plugin source
            'required' => true,
        ),
        array(
            'name' => 'SSL Redirect', // The plugin name
            'slug' => 'https-redirection', // The plugin slug (typically the folder name)
            'source' => get_stylesheet_directory() . '/plugins/https-redirection.zip', // The plugin source
            'required' => false,
        ),
        /** This is an example of how to include a plugin from the WordPress Plugin Repository */
        //array(
//            'name' => 'Edit Howdy',
//            'slug' => 'edit-howdy',
//            ),
    );
    
    /** Change this to your theme text domain, used for internationalising strings */
    $theme_text_domain = 'tgmpa';
    /**
    * Array of configuration settings. Uncomment and amend each line as needed.
    * If you want the default strings to be available under your own theme domain,
    * uncomment the strings and domain.
    * Some of the strings are added into a sprintf, so see the comments at the
    * end of each line for what each argument will be.
    */
    $config = array(
                'strings' => array(),
                );
    tgmpa( $plugins, $config );
}  

add_filter('manage_users_columns', 'PennyTheme_add_user_id_column');
function PennyTheme_add_user_id_column($columns) {
    $columns['user_ip'] = 'User IP';
    return $columns;
}
function get_auction_users_email( $bid ){
    global $wpdb;
    $user_emails_rs = $wpdb->get_results( " SELECT DISTINCT u.user_email
                                                FROM ".$wpdb->prefix."users u
                                                LEFT JOIN ".$wpdb->prefix."auctions_seats au ON au.uid = u.ID
                                                LEFT JOIN ".$wpdb->prefix."penny_bids pb ON pb.uid = u.ID
                                                WHERE ( pb.pid = $bid OR au.pid = $bid )
                                          " );
    return $user_emails_rs;  
    
}
 
add_action('manage_users_custom_column',  'PennyTheme_show_user_id_column_content', 10, 3);
function PennyTheme_show_user_id_column_content($value, $column_name, $user_id) {
    $user_ip = get_user_meta( $user_id, 'user_ip', true );
	if ( 'user_ip' == $column_name ) return $user_ip;
    return $value;
}

add_action( 'show_user_profile', 'Penny_add_user_custom_field' );
add_action( 'edit_user_profile', 'Penny_add_user_custom_field' );
function Penny_add_user_custom_field($user){
    echo '<table class="form-table">';
    for( $i = 1; $i <= 10; $i++ ){
        $field_text = get_option('registration_field'.$i);
        if( $field_text == '' ) continue;
        $field_type = get_option('registration_field_type'.$i);                       
    ?>
        <tr>
            <th><label for="<?php echo $field_text; ?>"><?php echo $field_text; ?></label></th>
            <td>
                <?php if( $field_type == 'text' ){ ?>
			        <input type="text" class="do_input" name="<?php echo 'registration_field'.$i; ?>" value="<?php echo esc_attr( get_the_author_meta( 'registration_field'.$i, $user->ID ) ) ?>" />
                <?php }else{ ?>
                    <textarea name="<?php echo 'registration_field'.$i; ?>"><?php echo esc_attr( get_the_author_meta( 'registration_field'.$i, $user->ID ) ) ?></textarea>
                <?php } ?>
            </td>
        </tr>
    <?php
    }
    echo '</table>';
}

add_action( 'personal_options_update', 'Penny_save_user_custom_field' );
add_action( 'edit_user_profile_update', 'Penny_save_user_custom_field' );

function Penny_save_user_custom_field( $user_id ){
    for( $i = 1; $i <= 10; $i++ ){
        $field_text = get_option('registration_field'.$i);
        if( $field_text == '' ) continue;
        update_user_meta( $user_id, 'registration_field'.$i, sanitize_text_field( $_POST['registration_field'.$i] ) );
        update_user_meta( $user_id, 'registration_field'.$i.'_orig', sanitize_text_field( $_POST['registration_field'.$i] ) );    
    }
    return 1;
}

function send_auction_start_email( $bid ){
    $user_emails = get_auction_users_email($bid);
    if( count( $user_emails ) > 0 ){
        foreach( $user_emails as $emails ){
            $recipients = $emails->user_email;
            
            $subject = 'Auction < '.get_the_title( $bid ).' > is now live.';
            $message = 'Dear User<br /><br />
            
                        Your auction < '.get_the_title( $bid ).' > is now live.
                        Please <a href="'.get_permalink( $bid ).'" target="_blank">click here</a> to go to auction or copy paste this link <strong>'.get_permalink( $bid ).'</strong> into your browser<br /><br />
                        
                        Happy Bidding.';
            
            $headers .= "MIME-Version: 1.0\n";
        	$headers .= "Content-Type: " . get_bloginfo('html_type') . "; charset=\"". get_bloginfo('charset') . "\"\n";
        	$mailtext = "<html><head><title>" . $subject . "</title></head><body>" . nl2br($message) . "</body></html>";
            
        	wp_mail($recipients, $subject, $mailtext, $headers);
    
        }
    }
}

function get_username_by_email( $email ){
    global $wpdb;
    $rs = $wpdb->get_results("                        
                        SELECT um.meta_value first_name, um2.meta_value last_name, u.user_nicename FROM ".$wpdb->prefix."users u
                        JOIN ".$wpdb->prefix."usermeta um ON um.user_id = u.ID
                        JOIN ".$wpdb->prefix."usermeta um2 ON um2.user_id = u.ID
                        WHERE u.user_email = '$email' AND um.meta_key = 'first_name'
                        AND um2.meta_key = 'last_name'
                        ");
    if( count( $rs ) > 0 ){
        if( $rs[0]->first_name == '' && $rs[0]->last_name == '' ){
            return $rs[0]->user_nicename;
        }else{
            return $rs[0]->first_name.' '.$rs[0]->last_name;    
        }
    }
}

function get_user_available_credits( $uid ){
    global $wpdb;
    $user_credits = $wpdb->get_results( " SELECT credit FROM ".$wpdb->prefix."user_available_credits WHERE uid = '$uid' " );  
    if( count( $user_credits ) > 0 ){
        return $user_credits[0]->credit;
    }else{
        return 0;
    }
}

function send_auction_free_credit_empty_email( $bid ){
    global $wpdb;
    $user_emails = $wpdb->get_results( " SELECT DISTINCT u.user_email, u.ID user_id
                                                FROM ".$wpdb->prefix."users u
                                                JOIN ".$wpdb->prefix."free_auction_bid_assistant ba ON ba.uid = u.ID
                                                WHERE ba.pid = $bid AND credits_current = 0 AND email_sent = 0
                                          " );  
        
    if( count( $user_emails ) > 0 ){
        
        $subject 	= get_option('PennyTheme_free_credit_empty_email_subject');
    	$message 	= get_option('PennyTheme_free_credit_empty_email_message');	
        $site_login_url = PennyTheme_login_url();
		$site_name 		= get_bloginfo('name');
		$account_url 	= get_permalink(get_option('PennyTheme_my_account_page_id'));

		$item_name 	= $post->post_title;
		$item_link 	= get_permalink($bid);
                        
        foreach( $user_emails as $emails ){
            $recipients = $emails->user_email;
            $user_id    = $emails->user_id;
            $user_name = get_username_by_email($recipients);
    		$find 		= array( '##site_login_url##', '##your_site_name##', '##your_site_url##' , '##my_account_url##', '##auction_title##', '##username##', '##item_link##');
       		$replace 	= array( $site_login_url, $site_name, get_bloginfo('url'), $account_url, get_the_title( $bid ), $user_name, $item_link);
    		
    		$tag		= 'PennyTheme_send_email_posted_item_approved';
    		$find 		= apply_filters( $tag . '_find', 	$find );
    		$replace 	= apply_filters( $tag . '_replace', $replace );
    		
    		$message 	= PennyTheme_replace_stuff_for_me($find, $replace, $message);
    		$subject 	= PennyTheme_replace_stuff_for_me($find, $replace, $subject);
            
            PennyTheme_send_email($recipients, $subject, $message);
            $user_emails = $wpdb->query( " UPDATE ".$wpdb->prefix."free_auction_bid_assistant SET email_sent = 1
                                                WHERE pid = $bid AND uid = '$user_id' LIMIT 1" ); 
        }
    }
}

function send_auction_reserve_not_met_email( $bid ){
    $user_emails = get_auction_users_email($bid);
    if( count( $user_emails ) > 0 ){
        
        $subject 	= get_option('PennyTheme_reserve_not_met_user_email_subject');
    	$message 	= get_option('PennyTheme_reserve_not_met_user_email_message');	
        $site_login_url = PennyTheme_login_url();
		$site_name 		= get_bloginfo('name');
		$account_url 	= get_permalink(get_option('PennyTheme_my_account_page_id'));

		$item_name 	= $post->post_title;
		$item_link 	= get_permalink($bid);
                        
        foreach( $user_emails as $emails ){
            $recipients = $emails->user_email;
            $user_name = get_username_by_email($recipients);
    		$find 		= array( '##site_login_url##', '##your_site_name##', '##your_site_url##' , '##my_account_url##', '##auction_title##', '##username##');
       		$replace 	= array( $site_login_url, $site_name, get_bloginfo('url'), $account_url, get_the_title( $bid ), $user_name);
    		
    		$tag		= 'PennyTheme_send_email_posted_item_approved';
    		$find 		= apply_filters( $tag . '_find', 	$find );
    		$replace 	= apply_filters( $tag . '_replace', $replace );
    		
    		$message 	= PennyTheme_replace_stuff_for_me($find, $replace, $message);
    		$subject 	= PennyTheme_replace_stuff_for_me($find, $replace, $subject);
            PennyTheme_send_email($recipients, $subject, $message);
        }
    }
}

function send_auction_reserve_not_met_email_admin( $bid ){
    $recipients = get_option( 'admin_email' );
            
    $subject 	= get_option('PennyTheme_reserve_not_met_admin_email_subject');
	$message 	= get_option('PennyTheme_reserve_not_met_admin_email_message');	

	$site_login_url = PennyTheme_login_url();
	$site_name 		= get_bloginfo('name');
	$account_url 	= get_permalink(get_option('PennyTheme_my_account_page_id'));

	$item_name 	= $post->post_title;
	$item_link 	= get_permalink($bid);

	$find 		= array( '##site_login_url##', '##your_site_name##', '##your_site_url##' , '##my_account_url##', '##auction_title##');
	$replace 	= array( $site_login_url, $site_name, get_bloginfo('url'), $account_url, get_the_title( $bid ));
	
	$tag		= 'PennyTheme_send_email_posted_item_approved';
	$find 		= apply_filters( $tag . '_find', 	$find );
	$replace 	= apply_filters( $tag . '_replace', $replace );
	
	$message 	= PennyTheme_replace_stuff_for_me($find, $replace, $message);
	$subject 	= PennyTheme_replace_stuff_for_me($find, $replace, $subject);
    PennyTheme_send_email($recipients, $subject, $message);
}

function get_auction_item_buy_time( $pid ){
    $auction_item_stock           = get_post_meta( $pid, 'auction_item_stock', true );
    if( $auction_item_stock == 0 || $auction_item_stock == '' ) return 0;
    return $auction_item_stock - get_auction_item_sold_times( $pid );
}

function get_auction_item_sold_times( $pid ){
    global $wpdb;
    $rs = $wpdb->query( " SELECT COUNT(pid) total_sold FROM ".$wpdb->prefix."penny_bids WHERE ( pid = '$pid' OR buy_id = '$pid' ) AND paid = 1 " );
    if( $rs > 0 ){
        return $rs;
    }else{
        return 0;
    }
}

function is_user_bought_auction_item( $pid, $uid ){
    global $wpdb;
    $rs = $wpdb->query( " SELECT 1 FROM ".$wpdb->prefix."penny_bids WHERE ( pid = '$pid' OR buy_id = '$pid' ) AND paid = 1 " );
    if( $rs > 0 ){
        return 1;
    }else{
        return 0;
    }
}

function send_auction_start_email_admin( $bid ){
    $recipients = get_option( 'admin_email' );
            
    $subject = 'Auction < '.get_the_title( $bid ).' > is now live.';
    $message = 'Dear Admin<br /><br />
    
                Auction < '.get_the_title( $bid ).' > is now live.
                Please <a href="'.get_permalink( $bid ).'" target="_blank">click here</a> to go to auction or copy paste this link <strong>'.get_permalink( $bid ).'</strong> into your browser<br /><br />
                
                Thanks.';
    
    $headers .= "MIME-Version: 1.0\n";
	$headers .= "Content-Type: " . get_bloginfo('html_type') . "; charset=\"". get_bloginfo('charset') . "\"\n";
	$mailtext = "<html><head><title>" . $subject . "</title></head><body>" . nl2br($message) . "</body></html>";
    
	wp_mail($recipients, $subject, $mailtext, $headers);
}

function get_auction_remaining_seats($bid){
    $total_seats     = get_post_meta( $bid, 'seats', true );
    $purchased_seats = get_total_purchased_auction_seats( $bid );
    return ( $total_seats - $purchased_seats );
}

function get_per_seat_price( $bid ){
    
    if( get_custom_seat_price($bid) != '' ){
        return get_custom_seat_price($bid);
    }else{
        $buy_now        = get_post_meta( $bid, 'retail_price', true );
        $total_seats    = get_post_meta( $bid, 'seats', true );
        return number_format( $buy_now / $total_seats, 2 );   
    }
}

function get_custom_seat_price( $bid ){
    return get_post_meta( $bid, 'custom_seat_price', true );
}

function PennyTheme_add_auction_timer(){
    
    $uid = (int) $_POST['_uid'];
    $pid = (int) $_POST['_pid'];
    
    $user_timer =  get_user_auction_timer( $pid, $uid );
    if( $user_timer > 0 ){
        
        update_option( '_auction_time_added_', 2 );
                                
        $old_timing  = get_post_meta($pid, 'ending', true);
        $new_timing  = $old_timing + get_auction_time_increase( $pid );    
        
        update_post_meta($pid, 'ending', $new_timing);
        
        $user_timer = $user_timer - 1;
        set_user_auction_timer( $pid, $uid, $user_timer );
        if( $user_timer == 0 ){
            echo (get_post_meta($pid, 'ending', true) - current_time('timestamp',0)).'~~_hide_btn_time';    
        }else{
            echo (get_post_meta($pid, 'ending', true) - current_time('timestamp',0)).'~~no';
        }
        exit;    
    }else{
        echo 0;
        exit;
    }
    
}


function set_user_auction_timer( $pid, $uid, $timer ){
    global $wpdb;
    $rs = $wpdb->get_results(" SELECT timer FROM ".$wpdb->prefix."user_auction_timer WHERE pid = '$pid' AND uid = '$uid' ");
    if( count( $rs ) > 0 ){
        $rs = $rs[0];
        $wpdb->query(" UPDATE ".$wpdb->prefix."user_auction_timer SET timer = '$timer' WHERE pid = '$pid' AND uid = '$uid' ");
    }else{
        $wpdb->query(" INSERT INTO ".$wpdb->prefix."user_auction_timer SET timer = '$timer', pid = '$pid', uid = '$uid' ");
    }
}

function get_user_auction_timer( $pid, $uid ){
    global $wpdb;
    $rs = $wpdb->get_results(" SELECT timer FROM ".$wpdb->prefix."user_auction_timer WHERE pid = '$pid' AND uid = '$uid' ");
    if( count( $rs ) > 0 ){
        $rs = $rs[0];
        return $rs->timer;
    }else{
        return 0;
    }
}

function PennyTheme_register_my_menus() {
		register_nav_menu( 'primary-pennytheme-header', 'PennyTheme top-header Menu' );
		register_nav_menu( 'primary-penny-main-header', 'PennyTheme Big Main Menu' );		
		register_nav_menu( 'primary-penny-my-account', 'PennyTheme My Account Menu' );
}
	

function PennyTheme_get_custom_taxonomy_count($ptype,$pterm) {
	global $wpdb;
	
	$s = "select * from ".$wpdb->prefix."terms where slug='$pterm'";
	$r = $wpdb->get_results($s);
	$r = $r[0];
	
	$term_id = $r->term_id;
	

	
	//--------
	
	$s = "select * from ".$wpdb->prefix."term_taxonomy where term_id='$term_id'";
	$r = $wpdb->get_results($s);
	$r = $r[0];
	
	$term_taxonomy_id = $r->term_taxonomy_id;

	
	//--------
	
	$s = "select distinct posts.ID from ".$wpdb->prefix."term_relationships rel, $wpdb->postmeta wpostmeta, $wpdb->posts posts 
	 where rel.term_taxonomy_id='$term_taxonomy_id' AND rel.object_id = wpostmeta.post_id AND posts.ID = wpostmeta.post_id AND posts.post_status = 'publish' AND posts.post_type = 'auction' AND wpostmeta.meta_key = 'closed' AND wpostmeta.meta_value = '0'";
	$r = $wpdb->get_results($s);
	

	
	return count($r);
}


function PennyTheme_replace_stuff_for_me($find, $replace, $subject)
{
	$i = 0;
	foreach($find as $item)
	{
		$replace_with = $replace[$i];
		$subject = str_replace($item, $replace_with, $subject);	
		$i++;
	}
	
	return $subject;
}


function PennyTheme_login_url()
{
	return get_bloginfo('url') . "/wp-login.php";	
}

function PennyTheme_get_total_nr_of_auction()
{
	$query = new WP_Query( "post_type=auction&order=DESC&orderby=id&posts_per_page=-1&paged=1" );	
	return $query->post_count;
}
/*************************************************************
*
*	PennyTheme (c) sitemile.com - function
*
**************************************************************/
function PennyTheme_get_total_nr_of_open_auction()
{
	$query = new WP_Query( "meta_key=closed&meta_value=0&post_type=auction&order=DESC&orderby=id&posts_per_page=-1&paged=1" );	
	return $query->post_count; 
}
/*************************************************************
*
*	PennyTheme (c) sitemile.com - function
*
**************************************************************/
function PennyTheme_get_total_nr_of_closed_auction()
{
	$query = new WP_Query( "meta_key=closed&meta_value=1&post_type=auction&order=DESC&orderby=id&posts_per_page=-1&paged=1" );	
	return $query->post_count;
}


function PennyTheme_add_query_vars($public_query_vars) 
{  
		$public_query_vars[] = 'a_action'; 
		$public_query_vars[] = 'bid_id';
		 
		$public_query_vars[] = 'step'; 
		$public_query_vars[] = 'my_second_page';
		$public_query_vars[] = 'third_page';
		$public_query_vars[] = 'username';
		$public_query_vars[] = 'pid';
		$public_query_vars[] = 'term_search';		//job_sort, job_category, page
		$public_query_vars[] = 'method';
		$public_query_vars[] = 'post_author';
		$public_query_vars[] = 'page';
		$public_query_vars[] = 'rid';
		
    	return $public_query_vars;  
}


function PennyTheme_add_theme_styles()  
{ 

	//wp_register_script( 'social_pr', get_bloginfo('template_url').'/js/connect.js');
	//wp_enqueue_script( 'social_pr' );
	
}



function PennyTheme_get_post_big( $arr = '')
{
			$highest_bid = PennyTheme_get_show_price(get_post_meta(get_the_ID(), 'current_bid', true));
			$ending = get_post_meta(get_the_ID(), 'ending', true);
			$sec 	= $ending - current_time('timestamp',0);	
			$closed = get_post_meta(get_the_ID(), 'closed', true);
			$post 	= get_post(get_the_ID());
		
			$now 	= current_time('timestamp',0);
			
			global $current_user;
			get_currentuserinfo();
			$uid = $current_user->ID;
			
			$rnd = rand(1,999);
			$retail_price 	= PennyTheme_get_show_price(get_post_meta(get_the_ID(), 'retail_price', true),2);
			$time_increase 	= get_post_meta(get_the_ID(), 'time_increase', true);
			$rem = $ending - $now;
					
?>
				<div class="post" id="post-<?php the_ID(); ?>-<?php echo $rnd; ?>">
                <input type="hidden" class="my-total-ids-no-delete" value="<?php the_ID(); ?>_<?php echo $rnd; ?>" />
                <div class="padd10_bottom">
                <div class="image_holder">
                <a href="<?php the_permalink(); ?>"><img width="75" height="65" class="image_class" 
                src="<?php echo PennyTheme_get_first_post_image(get_the_ID(),75,65); ?>" /></a>
                </div>
                <div  class="title_holder5" > 
                     <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
                        <?php  the_title();   ?></a></h2>
     
     					<!-- ## end-title ## -->
                        
                        <div class="my-bid-live-detail2">
                        	<div class="my-current-bidder-live">
                            
                            <ul class="auction-details1">
							<li>
								<img src="<?php echo get_bloginfo('template_url'); ?>/images/price.png" alt="price" width="15" height="15" /> 
								<h3><?php echo __("Retail Price",'PennyTheme'); ?>:</h3>
								<p><?php echo $retail_price; ?></p>
							</li>
                           
                           
                           <li>
								<img src="<?php echo get_bloginfo('template_url'); ?>/images/posted.png" alt="posted" width="15" height="15" /> 
								<h3><?php echo __("Highest Bidder",'PennyTheme'); ?>:</h3>
								<p><span id="highest_bidder_<?php the_ID(); ?>_<?php echo $rnd; ?>"></span></p>
							</li>
                            
                            <li>
								<img src="<?php echo get_bloginfo('template_url'); ?>/images/clock.png" alt="clock" width="15" height="15" /> 
								<h3><?php echo __("Timer",'PennyTheme'); ?>:</h3>
								<p><?php echo sprintf(__("%s seconds",'PennyTheme'), $time_increase); ?></p>
							</li>
                           
                            </ul>
                            
                            
                            </div>                        
                        </div>
                        
                        
                        
     					<div class="my-bid-live-detail2">
                            <div class="my-time-live" id="my-auction-time_<?php the_ID(); ?>_<?php echo $rnd; ?>"><?php echo $rem; ?></div>
                            
                            <?php if( is_user_buy_this_auction( get_the_ID(), $uid ) == 0 ){ ?>
                                <div class="bid-btn"><a href="<?php the_permalink() ?>" class="mm_bid_mmp" rel="<?php the_ID(); ?>"><?php _e('Bid Now','PennyTheme'); ?></a></div>
                            <?php } ?>
                            <div class="my-gap-thing"></div>
                            <div class="my-current-price-live" >
                            <span class="my-current-price-live-content" id="my-current-price_<?php the_ID(); ?>_<?php echo $rnd; ?>"><?php echo $highest_bid; ?></span>
                            </div>  
                            
                            
            			</div>
                
                        
                        
                        
                     </div>
                     </div></div>
                     
                     <?php

}

function get_user_auction_cost( $pid, $uid ){
    global $wpdb;
    $rs_total = $wpdb->get_results( " SELECT total_cost FROM ".$wpdb->prefix."auctions_seats WHERE pid = '$pid' AND uid = '$uid' LIMIT 1 " );
    if( count( $rs_total ) > 0 ){
        $rs_total = $rs_total[0];
        $cost = $rs_total->total_cost;     
    }else{
        $cost = 0;
    }
    
    $price_increase = get_post_meta( $pid, 'price_increase', true );
    $rs_total_bids = $wpdb->get_results( " SELECT COUNT(uid) total_bids FROM ".$wpdb->prefix."penny_bids WHERE pid = '$pid' AND uid = '$uid' LIMIT 1 " );
    if( count( $rs_total_bids ) > 0 ){
        $total = $price_increase * $rs_total_bids[0]->total_bids; 
        return ( $total + $cost );
    }else{
        return $cost;
    }
    
}

function is_user_buy_this_auction( $pid, $uid ){
    global $wpdb;
    $rs = $wpdb->get_results( " SELECT 1 FROM ".$wpdb->prefix."penny_bids WHERE buy_id = '$pid' AND uid = '$uid' AND buy = 1 " );
    if( count( $rs ) > 0 ){
        return 1;
    }else{
        return 0;
    }
}


function PennyTheme_get_post_my_account_won()
{
			$highest_bid = PennyTheme_get_show_price(get_post_meta(get_the_ID(), 'current_bid', true));
			$ending = get_post_meta(get_the_ID(), 'ending', true);
			$sec 	= $ending - current_time('timestamp',0);	
			$closed = get_post_meta(get_the_ID(), 'closed', true);
			$post 	= get_post(get_the_ID());
		
			$now 	= current_time('timestamp',0);
			
			global $current_user;
			get_currentuserinfo();
			$uid = $current_user->ID;
			
			$rnd = rand(1,999);
			$retail_price 	= PennyTheme_get_show_price(get_post_meta(get_the_ID(), 'retail_price', true),2);
			$time_increase 	= get_post_meta(get_the_ID(), 'time_increase', true);
			$rem = $ending - $now;
					
?>
				<div class="post">
        
                <div class="padd10_bottom">
                <div class="image_holder">
                <a href="<?php the_permalink(); ?>"><img width="75" height="65" class="image_class" 
                src="<?php echo PennyTheme_get_first_post_image(get_the_ID(),75,65); ?>" /></a>
                </div>
                <div  class="title_holder5" > 
                     <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
                        <?php the_title(); ?></a></h2>
     
     					<!-- ## end-title ## -->
                        
               
                        
                        
     					<div class="my-bid-live-detail2">
                         <?php
                                    if( is_user_buy_this_auction( get_the_ID(), $uid ) ){
                                        $price = get_post_meta( get_the_ID(), 'buy_now', true ) - get_user_auction_cost( get_the_ID(), $uid );
                                        $text = 'bought';    
                                    }else{
                                        $price = get_post_meta(get_the_ID(), 'current_bid', true);
                                        $text = 'won';    
                                    }
                                    
						 			$highest_bid = PennyTheme_get_show_price($price);
						 			echo 'You <strong>'.$text.'</strong> this item for the price of:'.$highest_bid; 
									echo '<br/>';
									
									$PennyTheme_paypal_enable = get_option('PennyTheme_paypal_enable');
									if($PennyTheme_paypal_enable == "yes" && is_user_bought_auction_item( get_the_ID(), $uid ) == 0 ):
									?>   
                                        <a class="pay_now" href="<?php bloginfo('url'); ?>/?a_action=pay_for_auction&pid=<?php the_ID(); ?>"><?php _e('Pay Now','PennyTheme'); ?></a>
                                    <?php endif; 
							
							
							do_action('PennyTheme_pay_for_item_payments_link');
							
							?>
                            
            			</div>
                
                        
                        
                        
                     </div>
                     </div></div>
                     
                     <?php

}


function PennyTheme_get_post_my_account_paid()
{
			$highest_bid = PennyTheme_get_show_price(get_post_meta(get_the_ID(), 'current_bid', true));
			$ending = get_post_meta(get_the_ID(), 'ending', true);
			$sec 	= $ending - current_time('timestamp',0);	
			$closed = get_post_meta(get_the_ID(), 'closed', true);
			$post 	= get_post(get_the_ID());
		
			$now 	= current_time('timestamp',0);
			
			global $current_user;
			get_currentuserinfo();
			$uid = $current_user->ID;
			
			$rnd = rand(1,999);
			$retail_price 	= PennyTheme_get_show_price(get_post_meta(get_the_ID(), 'retail_price', true),2);
			$time_increase 	= get_post_meta(get_the_ID(), 'time_increase', true);
			$rem = $ending - $now;
					
?>
				<div class="post">
        
                <div class="padd10_bottom">
                <div class="image_holder">
                <a href="<?php the_permalink(); ?>"><img width="75" height="65" class="image_class" 
                src="<?php echo PennyTheme_get_first_post_image(get_the_ID(),75,65); ?>" /></a>
                </div>
                <div  class="title_holder5" > 
                     <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
                        <?php the_title(); ?></a></h2>
     
     					<!-- ## end-title ## -->
                        
               
                        
                        
     					<div class="my-bid-live-detail2">
                         <?php 
						 			$highest_bid = PennyTheme_get_show_price(get_post_meta(get_the_ID(), 'current_bid', true));
						 			echo sprintf(__('You won this item for the price of: %s','PennyTheme'), $highest_bid); 
									echo '<br/>';
				 				
								$winner = PennyTheme_get_highest_bid_owner_obj(get_the_ID());	
								$dt = get_post_meta(get_the_ID(), 'paid_on_'.$winner->id, true);
								echo sprintf(__('Paid on: %s','PennyTheme'), date_i18n('d-M-Y H:i:s', $dt));
								
							?>
                            
            			</div>
                
                        
                        
                        
                     </div>
                     </div></div>
                     
                     <?php

}



function PennyTheme_get_post_my_account_shpd()
{
			$highest_bid = PennyTheme_get_show_price(get_post_meta(get_the_ID(), 'current_bid', true));
			$ending = get_post_meta(get_the_ID(), 'ending', true);
			$sec 	= $ending - current_time('timestamp',0);	
			$closed = get_post_meta(get_the_ID(), 'closed', true);
			$post 	= get_post(get_the_ID());
		
			$now 	= current_time('timestamp',0);
			
			global $current_user;
			get_currentuserinfo();
			$uid = $current_user->ID;
			
			$rnd = rand(1,999);
			$retail_price 	= PennyTheme_get_show_price(get_post_meta(get_the_ID(), 'retail_price', true),2);
			$time_increase 	= get_post_meta(get_the_ID(), 'time_increase', true);
			$rem = $ending - $now;
					
?>
				<div class="post">
        
                <div class="padd10_bottom">
                <div class="image_holder">
                <a href="<?php the_permalink(); ?>"><img width="75" height="65" class="image_class" 
                src="<?php echo PennyTheme_get_first_post_image(get_the_ID(),75,65); ?>" /></a>
                </div>
                <div  class="title_holder5" > 
                     <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
                        <?php the_title(); ?></a></h2>
     
     					<!-- ## end-title ## -->
                        
               
                        
                        
     					<div class="my-bid-live-detail2">
                         <?php 
						 			$highest_bid = PennyTheme_get_show_price(get_post_meta(get_the_ID(), 'current_bid', true));
						 			echo sprintf(__('You won this item for the price of: %s','PennyTheme'), $highest_bid); 
									echo '<br/>';
				 				
								$winner = PennyTheme_get_highest_bid_owner_obj(get_the_ID());	
								$dt = $winner->shipped_on;
								echo sprintf(__('Shipped on: %s','PennyTheme'), date_i18n('d-M-Y H:i:s', $dt));
								
							?>
                            
            			</div>
                
                        
                        
                        
                     </div>
                     </div></div>
                     
                     <?php

}

function PennyTheme_get_post_my_account_expired_auctions()
{	
			$post 	= get_post(get_the_ID());
			
			global $current_user;
			get_currentuserinfo();
			$uid = $current_user->ID;
			$retail_price 	= PennyTheme_get_show_price(get_post_meta(get_the_ID(), 'retail_price', true),2);
					
?>
				<div class="post">
        
                <div class="padd10_bottom">
                <div class="image_holder">
                <a href="<?php the_permalink(); ?>"><img width="75" height="65" class="image_class" 
                src="<?php echo PennyTheme_get_first_post_image(get_the_ID(),75,65); ?>" /></a>
                </div>
                <div  class="title_holder5" > 
                     <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
                        <?php the_title(); ?></a></h2>
     					<div class="my-bid-live-detail2">
                         <?php 
						 			echo sprintf(__('Auction Reserve(%s) is not met, No one won the item','PennyTheme'), PennyTheme_get_show_price(get_post_meta(get_the_ID(), 'reserve', true))); 
									echo '<br/>';
							?>
            			</div>
                     </div>
                     </div></div>
                     <?php

}


function PennyTheme_framework_init_widgets()
{


	register_sidebar( array(
		'name' => __( 'Single Page Sidebar', 'PennyTheme' ),
		'id' => 'single-widget-area',
		'description' => __( 'The sidebar area of the single blog post', 'PennyTheme' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	
	
		
	register_sidebar( array(
		'name' => __( 'PennyTheme - Stretch Wide MainPage Sidebar', 'PennyTheme' ),
		'id' => 'main-stretch-area',
		'description' => __( 'This sidebar is site wide stretched in home page, just under the slider/menu.', 'PennyTheme' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	
	
	register_sidebar( array(
		'name' => __( 'Other Page Sidebar', 'PennyTheme' ),
		'id' => 'other-page-area',
		'description' => __( 'The sidebar area of any other page than the defined ones', 'PennyTheme' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	
	
	
	register_sidebar( array(
		'name' => __( 'Home Page Sidebar - Right', 'PennyTheme' ),
		'id' => 'home-right-widget-area',
		'description' => __( 'The right sidebar area of the homepage', 'PennyTheme' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	
	
	
	register_sidebar( array(
		'name' => __( 'Home Page Sidebar - Left', 'PennyTheme' ),
		'id' => 'home-left-widget-area',
		'description' => __( 'The left sidebar area of the homepage', 'PennyTheme' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	
	
	register_sidebar( array(
		'name' => __( 'First Footer Widget Area', 'PennyTheme' ),
		'id' => 'first-footer-widget-area',
		'description' => __( 'The first footer widget area', 'PennyTheme' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 4, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Second Footer Widget Area', 'PennyTheme' ),
		'id' => 'second-footer-widget-area',
		'description' => __( 'The second footer widget area', 'PennyTheme' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 5, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Third Footer Widget Area', 'PennyTheme' ),
		'id' => 'third-footer-widget-area',
		'description' => __( 'The third footer widget area', 'PennyTheme' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 6, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Fourth Footer Widget Area', 'PennyTheme' ),
		'id' => 'fourth-footer-widget-area',
		'description' => __( 'The fourth footer widget area', 'PennyTheme' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	

		
	register_sidebar( array(
		'name' => __( 'PennyTheme - Auction Single Sidebar', 'PennyTheme' ),
		'id' => 'auction-widget-area',
		'description' => __( 'The sidebar of the single auction page', 'PennyTheme' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
		
		
	register_sidebar( array(
		'name' => __( 'PennyTheme - HomePage Area','PennyTheme' ),
		'id' => 'main-page-widget-area',
		'description' => __( 'The sidebar for the main page, just under the slider.', 'PennyTheme' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
		

	
}

function PennyTheme_get_option_drop_down($arr, $name)
{
	$opts = get_option($name);
	$r = '<select name="'.$name.'">';
	foreach ($arr as $key => $value)
	{
		$r .= '<option value="'.$key.'" '.($opts == $key ? ' selected="selected" ' : "" ).'>'.$value.'</option>';		
		
	}
    return $r.'</select>'; 
}



/*****************************************************************************
*
*	Function - pennyTheme -
*
*****************************************************************************/

function PennyTheme_get_credits_act()
{
		$pidipid = $_POST['pidipid'];
		
		global $current_user, $wpdb;
		get_currentuserinfo();
		$uid = $current_user->ID;
		
		if($pidipid != 0)
		{
			$sk = "select * from ".$wpdb->prefix."penny_assistant where pid='$pidipid' And uid='$uid'";
			$r = $wpdb->get_results($sk);	
			$rhm = $r[0];
			
			$arr['remleft'] = $rhm->credits_start - $rhm->credits_current;
		} else $arr['remleft'] = "";
		
		
		$arr['crds'] = PennyTheme_get_credits($uid);
		echo json_encode($arr);	
}


/*****************************************************************************
*
*	Function - pennyTheme -
*
*****************************************************************************/

function add_free_seat_additional_seats( $pid ){
    if( get_post_meta( $pid, 'custom_seat_price', true ) != 0 ) return;
    
    $total_bids = get_auction_bids( $pid );
    $current_seats         = get_post_meta( $pid, 'seats', true );
    $additional_seats      = get_post_meta( $pid, 'additional_seats', true );
    $additional_seats_bids = get_post_meta( $pid, 'additional_seats_bids', true );
    if( $additional_seats > 0 && $additional_seats_bids > 0 ){
        if( $total_bids % $additional_seats_bids == 0 ){
            $new_seats = $current_seats + $additional_seats;
            update_post_meta( $pid, 'seats', $new_seats );
            update_post_meta( $pid, 'additional_seats_update', 1 );    
        }    
    }
}

function PennyTheme_bid_now_live()
{

	
		global $current_user, $wpdb;
		get_currentuserinfo();
		$uid = $current_user->ID;
			
		$pid	= $_POST['_pid'];
        $do_inc	= $_POST['do_inc'];
        $uincb	= $_POST['uincb'];
        
		if(!is_user_logged_in()) { echo "NO_USER_LOGIN"; exit; }
        
        $bid_per_user = get_post_meta( $_POST['_pid'], 'bid_per_user', true );
        if( $bid_per_user != '' && $bid_per_user > 0 ){
            $user_bids = $wpdb->get_results( " SELECT COUNT(uid) total_bids FROM ".$wpdb->prefix."penny_bids WHERE pid = '".mysql_real_escape_string($_POST['_pid'])."' AND uid = '$uid'" );
            $get_user_auction_seats = get_user_auction_seats( $_POST['_pid'], $uid );
            if( $get_user_auction_seats != '' && $get_user_auction_seats > 0 ){
                $bid_per_user = $bid_per_user * $get_user_auction_seats; 
            }
            if( ( $user_bids[0]->total_bids ) >= $bid_per_user ){
                echo "NO_FURTHER_BIDDING_ALLOWED"; exit; 
            }    
        }
        
		$user_credits = get_user_meta($uid, 'user_credits', true);
		if( ( $user_credits <= 0 || empty($user_credits ) ) && ( is_auction_seats_enabled( $pid ) == 0 ) && get_post_meta( $_POST['_pid'], 'free_auction', true ) == 0 ) { echo "NO_USER_CREDITS"; }
		else {		
		
		$old_ending = get_post_meta($pid, 'ending', 		true);
		
		$ctm = current_time('timestamp', 0);
		
		if($old_ending < $ctm) { echo "TIME_IS_UP"; }
		else {
		
		$price_increase = get_post_meta($pid, 'price_increase', true);
		$retail_price 	= get_post_meta($pid, 'retail_price', 	true);
		$time_increase 	= get_post_meta($pid, 'time_increase', 	true);
		$ending		 	= $old_ending + $time_increase;
		$tm 			= current_time('timestamp', 0);
		$bid			= PennyTheme_get_highest_bid_new($pid);
        
        if( $bid != 'NULL' ){
            $uids_max  = $bid->uid;
            $add_price = $bid->bid;    
        }else{
            $add_price = get_post_meta($pid, 'start_price', true);
            $uids_max  = 0;
        }
        
		$bid = $add_price +  $price_increase;
        
        // user increment
        if( $do_inc == 'on' ){
            if( get_post_meta($pid, 'price_increase', true) != '' && $uincb >= get_post_meta($pid, 'price_increase', true) ){
                $bid = $add_price +  $uincb;    
            }    
        }
        
		//echo $uids_max.' ##'.$bid;exit; 
				if($uid != $uids_max)
				{
			 
					$old_diff = $old_ending - $ctm;
					$dffff = get_option('PennyTheme_dfff_tm');
					if(empty($dffff)) $dffff = 9999999;
					
					if($old_diff <= $dffff)
					update_post_meta($pid, 'ending', 		$ending);
					
					
					
					update_post_meta($pid, 'current_bid', 	$bid);
                    if( is_auction_seats_enabled( $pid ) == 0 && get_post_meta( $pid, 'free_auction', true ) == 0 ){
                        update_user_meta($uid, 'user_credits', 	$user_credits - 1);    
                    }
					
					add_post_meta($pid, 'bidded_auction', $uid );
					
					
					$query = "insert into ".$wpdb->prefix."penny_bids (pid,uid,date_made,bid) values('$pid','$uid','$tm','$bid')";
					$wpdb->query($query);
                    
                    add_free_seat_additional_seats($pid);
				
					PennyTheme_second_cronjob_thing();
                    PennyTheme_free_auction_cronjob_thing();
				
				}
			}
		}
		
}
/*****************************************************************************
*
*	Function - pennyTheme -
*
*****************************************************************************/

function PennyTheme_send_email($recipients, $subject = '', $message = '') {
		
	$PennyTheme_email_addr_from 	= get_option('PennyTheme_email_addr_from');	
	$PennyTheme_email_name_from  	= get_option('PennyTheme_email_name_from');
	
	$message = stripslashes($message);
	$subject = stripslashes($subject); 
	
	if(empty($PennyTheme_email_name_from)) $PennyTheme_email_name_from  = "Penny Theme";
	if(empty($PennyTheme_email_addr_from)) $PennyTheme_email_addr_from  = "PennyTheme@wordpress.org";
		
	$headers = 'From: '. $PennyTheme_email_name_from .' <'. $PennyTheme_email_addr_from .'>' . PHP_EOL;
	$PennyTheme_allow_html_emails = get_option('PennyTheme_allow_html_emails');
	if($PennyTheme_allow_html_emails != "yes") $html = false;
	else $html = true;

	$ok_send_email = true;
	$ok_send_email = apply_filters('PennyTheme_ok_to_send_emails', $ok_send_email);

	if($ok_send_email == true)
	{
		if ($html) {
			$headers .= "MIME-Version: 1.0\n";
			$headers .= "Content-Type: " . get_bloginfo('html_type') . "; charset=\"". get_bloginfo('charset') . "\"\n";
			$mailtext = "<html><head><title>" . $subject . "</title></head><body>" . nl2br($message) . "</body></html>";
			return wp_mail($recipients, $subject, $mailtext, $headers);
			
		} else {
			$headers .= "MIME-Version: 1.0\n";
			$headers .= "Content-Type: text/plain; charset=\"". get_bloginfo('charset') . "\"\n";
			$message = preg_replace('|&[^a][^m][^p].{0,3};|', '', $message);
			$message = preg_replace('|&amp;|', '&', $message);
			$mailtext = wordwrap(strip_tags($message), 80, "\n");
			return wp_mail($recipients, stripslashes($subject), stripslashes($mailtext), $headers);
		}

	}

}
/*****************************************************************************
*
*	Function - pennyTheme -
*
*****************************************************************************/

function PennyTheme_send_email_when_seats_have_been_purchased($uid, $pid, $seats)
{
 
	$subject 	= get_option('PennyTheme_seats_purchase_user_email_subject');
	$message 	= get_option('PennyTheme_seats_purchase_user_email_message');	
	
	if($enable != "no"):
	
		$user 			= get_userdata($uid);
		$site_login_url = PennyTheme_login_url();
		$site_name 		= get_bloginfo('name');
		$account_url 	= get_permalink(get_option('PennyTheme_my_account_page_id'));


		$item_name 	= $post->post_title;
		$item_link 	= get_permalink($pid);

		$find 		= array('##username##', '##username_email##', '##site_login_url##', '##your_site_name##', '##your_site_url##' , '##my_account_url##', '##seats_number##');
   		$replace 	= array($user->user_login, $user->user_email, $site_login_url, $site_name, get_bloginfo('url'), $account_url, $seats);
		
		$tag		= 'PennyTheme_send_email_posted_item_approved';
		$find 		= apply_filters( $tag . '_find', 	$find );
		$replace 	= apply_filters( $tag . '_replace', $replace );
		
		$message 	= PennyTheme_replace_stuff_for_me($find, $replace, $message);
		$subject 	= PennyTheme_replace_stuff_for_me($find, $replace, $subject);
		
		//---------------------------------------------
		
		$email = $user->user_email;
		PennyTheme_send_email($email, $subject, $message);
		
	endif;		
	
}

function PennyTheme_send_email_when_bids_have_been_purchased($uid, $bids)
{
 
	$subject 	= get_option('PennyTheme_bids_purchase_user_email_subject');
	$message 	= get_option('PennyTheme_bids_purchase_user_email_message');	
	
	if($enable != "no"):
	
		$user 			= get_userdata($uid);
		$site_login_url = PennyTheme_login_url();
		$site_name 		= get_bloginfo('name');
		$account_url 	= get_permalink(get_option('PennyTheme_my_account_page_id'));


		$item_name 	= $post->post_title;
		$item_link 	= get_permalink($pid);

		$find 		= array('##username##', '##username_email##', '##site_login_url##', '##your_site_name##', '##your_site_url##' , '##my_account_url##', '##bids_number##');
   		$replace 	= array($user->user_login, $user->user_email, $site_login_url, $site_name, get_bloginfo('url'), $account_url, $bids);
		
		$tag		= 'PennyTheme_send_email_posted_item_approved';
		$find 		= apply_filters( $tag . '_find', 	$find );
		$replace 	= apply_filters( $tag . '_replace', $replace );
		
		$message 	= PennyTheme_replace_stuff_for_me($find, $replace, $message);
		$subject 	= PennyTheme_replace_stuff_for_me($find, $replace, $subject);
		
		//---------------------------------------------
		
		$email = $user->user_email;
		PennyTheme_send_email($email, $subject, $message);
		
	endif;		
	
}

function get_total_purchased_auction_seats( $pid ){
    global $wpdb;
    $resultData = $wpdb->get_results( "SELECT SUM(seats) total_seats FROM ".$wpdb->prefix."auctions_seats WHERE pid = '$pid' " );
    $result = $resultData[0];
    return $result->total_seats;  
}

function get_user_auction_seats( $pid, $uid ){
    global $wpdb;
    $resultData = $wpdb->get_results( "SELECT seats FROM ".$wpdb->prefix."auctions_seats WHERE pid = '$pid' AND uid = '$uid' " );
    $result = $resultData[0];
    return $result->seats;  
}

function get_user_bids( $pid, $uid ){
    global $wpdb;
    $resultData = $wpdb->get_results( "SELECT COUNT(uid) total_bids FROM ".$wpdb->prefix."penny_bids WHERE pid = '$pid' AND uid = '$uid' " );
    $result = $resultData[0];
    return $result->total_bids;  
}

function get_auction_bids( $pid ){
    global $wpdb;
    $resultData = $wpdb->get_results( "SELECT COUNT(uid) total_bids FROM ".$wpdb->prefix."penny_bids WHERE pid = '$pid' " );
    $result = $resultData[0];
    return $result->total_bids;  
}

function is_auction_seats_enabled( $bid ){
    return get_post_meta( $bid, 'enable_seats', true );
}

function get_auction_timer_type( $pid ){
    return get_post_meta( $pid, 'timer_type', true );
}

function get_auction_user_time_limit( $pid ){
    return get_post_meta( $pid, 'time_limit_per_user', true );
}

function get_auction_time_cost( $pid ){
    return get_post_meta( $pid, 'time_cost', true );
}

function get_auction_time_increase( $pid ){
    return get_post_meta( $pid, 'time_increase', true );
}



/*****************************************************************************
*
*	Function - pennyTheme -
*
*****************************************************************************/

function PennyTheme_send_email_when_seats_have_been_purchased_admin($uid, $pid, $seats)
{
 
	$subject 	= get_option('PennyTheme_seats_purchase_admin_email_subject');
	$message 	= get_option('PennyTheme_seats_purchase_admin_email_message');	
	
	if($enable != "no"):
	
		$user 			= get_userdata($uid);
		$site_login_url = PennyTheme_login_url();
		$site_name 		= get_bloginfo('name');
		$account_url 	= get_permalink(get_option('PennyTheme_my_account_page_id'));


		$item_name 	= $post->post_title;
		$item_link 	= get_permalink($pid);

		$find 		= array('##username##', '##username_email##', '##site_login_url##', '##your_site_name##', '##your_site_url##' , '##my_account_url##', '##seats_number##');
   		$replace 	= array($user->user_login, $user->user_email, $site_login_url, $site_name, get_bloginfo('url'), $account_url, $seats);
		
		$tag		= 'PennyTheme_send_email_posted_item_approved';
		$find 		= apply_filters( $tag . '_find', 	$find );
		$replace 	= apply_filters( $tag . '_replace', $replace );
		
		$message 	= PennyTheme_replace_stuff_for_me($find, $replace, $message);
		$subject 	= PennyTheme_replace_stuff_for_me($find, $replace, $subject);
		
		//---------------------------------------------
		
		$email = get_bloginfo('admin_email');
		PennyTheme_send_email($email, $subject, $message);
		
	endif;		
	
}

function PennyTheme_send_email_when_bids_have_been_purchased_admin($uid, $bids)
{
 
	$subject 	= get_option('PennyTheme_bids_purchase_admin_email_subject');
	$message 	= get_option('PennyTheme_bids_purchase_admin_email_message');	
	
	if($enable != "no"):
	
		$user 			= get_userdata($uid);
		$site_login_url = PennyTheme_login_url();
		$site_name 		= get_bloginfo('name');
		$account_url 	= get_permalink(get_option('PennyTheme_my_account_page_id'));


		$item_name 	= $post->post_title;
		$item_link 	= get_permalink($pid);

		$find 		= array('##username##', '##username_email##', '##site_login_url##', '##your_site_name##', '##your_site_url##' , '##my_account_url##', '##bids_number##');
   		$replace 	= array($user->user_login, $user->user_email, $site_login_url, $site_name, get_bloginfo('url'), $account_url, $bids);
		
		$tag		= 'PennyTheme_send_email_posted_item_approved';
		$find 		= apply_filters( $tag . '_find', 	$find );
		$replace 	= apply_filters( $tag . '_replace', $replace );
		
		$message 	= PennyTheme_replace_stuff_for_me($find, $replace, $message);
		$subject 	= PennyTheme_replace_stuff_for_me($find, $replace, $subject);
		
		//---------------------------------------------
		
		$email = get_bloginfo('admin_email');
		PennyTheme_send_email($email, $subject, $message);
		
	endif;		
	
}

function PennyTheme_send_email_when_item_won($winner, $pid, $price)
{
 
	$subject 	= get_option('PennyTheme_item_purchase_user_email_subject');
	$message 	= get_option('PennyTheme_item_purchase_user_email_message');	
	
	if($enable != "no"):
	
		$user 			= get_userdata($winner);
		$site_login_url = PennyTheme_login_url();
		$site_name 		= get_bloginfo('name');
		$account_url 	= get_permalink(get_option('PennyTheme_my_account_page_id'));
		
		$price 		= pennytheme_get_show_price($price);
		$post 		= get_post($pid);
		$item_name 	= $post->post_title;
		$item_link 	= get_permalink($pid);

		$find 		= array('##username##', '##username_email##', '##site_login_url##', '##your_site_name##', '##your_site_url##' , '##my_account_url##', '##item_name##' , '##item_link##' , '##item_price##');
   		$replace 	= array($user->user_login, $user->user_email, $site_login_url, $site_name, get_bloginfo('url'), $account_url, $post->post_title, get_permalink($pid), $price);
		
		$tag		= 'PennyTheme_send_email_when_item_won';
		$find 		= apply_filters( $tag . '_find', 	$find );
		$replace 	= apply_filters( $tag . '_replace', $replace );
		
		$message 	= PennyTheme_replace_stuff_for_me($find, $replace, $message);
		$subject 	= PennyTheme_replace_stuff_for_me($find, $replace, $subject);
		
		//---------------------------------------------
		
		//$email = get_bloginfo('admin_email');
		PennyTheme_send_email($user->user_email, $subject, $message);
		
	endif;		
	
}

function PennyTheme_send_email_when_item_won_admin($winner, $pid, $price)
{
 
	$subject 	= get_option('PennyTheme_item_purchase_user_email_subject');
	$message 	= get_option('PennyTheme_item_purchase_user_email_message');	
	
	if($enable != "no"):
	
		$user 			= get_userdata($winner);
		$site_login_url = PennyTheme_login_url();
		$site_name 		= get_bloginfo('name');
		$account_url 	= get_permalink(get_option('PennyTheme_my_account_page_id'));
		
		$price 		= pennytheme_get_show_price($price);
		$post 		= get_post($pid);
		$item_name 	= $post->post_title;
		$item_link 	= get_permalink($pid);

		$find 		= array('##username##', '##username_email##', '##site_login_url##', '##your_site_name##', '##your_site_url##' , '##my_account_url##', '##item_name##' , '##item_link##' , '##item_price##');
   		$replace 	= array($user->user_login, $user->user_email, $site_login_url, $site_name, get_bloginfo('url'), $account_url, $post->post_title, get_permalink($pid), $price);
		
		$tag		= 'PennyTheme_send_email_when_item_won_admin';
		$find 		= apply_filters( $tag . '_find', 	$find );
		$replace 	= apply_filters( $tag . '_replace', $replace );
		
		$message 	= PennyTheme_replace_stuff_for_me($find, $replace, $message);
		$subject 	= PennyTheme_replace_stuff_for_me($find, $replace, $subject);
		
		//---------------------------------------------
		
		$email = get_bloginfo('admin_email');
		PennyTheme_send_email($email, $subject, $message);
		
	endif;		
	
}


/*****************************************************************************
*
*	Function - pennyTheme -
*
*****************************************************************************/

function PennyAuction_mark_bid_winner($id)
{
	global $wpdb;
	$s1 = "update ".$wpdb->prefix."penny_bids set winner='1' where id='$id'";
	$wpdb->query($s1);
}
/*****************************************************************************
*
*	Function - pennyTheme -
*
*****************************************************************************/
function PennyTheme_get_highest_bid($pid)
{
	global $wpdb;
	$s = "select bid, uid from ".$wpdb->prefix."penny_bids where pid='$pid' order by bid desc limit 1";
	$r = $wpdb->get_results($s);
	
	if(count($r) == 0) return get_post_meta($pid, 'start_price', true);
	
		
	$r = $r[0];
	return $r->bid;
}

function PennyTheme_get_highest_bid2($pid)
{
	global $wpdb;
	$s = "select bid, uid from ".$wpdb->prefix."penny_bids where pid='$pid' order by bid desc limit 1";
	$r = $wpdb->get_results($s);
	
	if(count($r) == 0) return get_post_meta($pid, 'start_price', true);
	
		
	$r = $r[0];
	return $r;
}

function PennyTheme_get_highest_bid_new($pid){
	global $wpdb;
	$s = "select bid, uid from ".$wpdb->prefix."penny_bids where pid='$pid' order by bid desc limit 1";
	$r = $wpdb->get_results($s);
    if( count( $r ) == 0 ){
        return 'NULL';
    }else{
        $r = $r[0];
        return $r;    
    }
}
/*****************************************************************************
*
*	Function - pennyTheme -
*
*****************************************************************************/
function PennyTheme_get_highest_bid_owner($pid)
{
	global $wpdb;
	$s = "select * from ".$wpdb->prefix."penny_bids where pid='$pid' order by bid desc limit 1";
	$r = $wpdb->get_results($s);
	
	if(count($r) == 0)
	 return false;
	
	$r = $r[0];
	return $r->uid;
}

/*****************************************************************************
*
*	Function - pennyTheme -
*
*****************************************************************************/
function PennyTheme_get_highest_bid_owner_obj($pid)
{
	global $wpdb;
	$s = "select * from ".$wpdb->prefix."penny_bids where ( pid='$pid' OR buy_id='$pid' ) order by bid desc limit 1";
	$r = $wpdb->get_results($s);
	
	if(count($r) == 0)
	 return false;
	
	$r = $r[0];
	return $r;
}

/*****************************************************************************
*
*	Function - pennyTheme -
*
*****************************************************************************/
function PennyTheme_my_ajax_small_stuff()
{
	
	$info = array(); global $wpdb;
	$my_arr = $_POST['my_values'];
	$OKOK = $_POST['OKOK'];
	
    if( $my_arr != '' ){
    
    	foreach($my_arr as $id_plus_rand)
    	{
    		$exp = explode("_",$id_plus_rand);
    		$pid = $exp[0];
    		$rnd = $exp[1];
    		
    		//----------------------
    		$newpid = array();
    		
    		
    		$highest_bidder_id 	= PennyTheme_get_highest_bid_owner_obj($pid);
     		
    			
    		if($highest_bidder_id == false) $highest_bidder = "0";
    		else {
    			
    			$s = "select user_login from ".$wpdb->users." where ID='{$highest_bidder_id->uid}'";
    			$r = $wpdb->get_results($s); $r = $r[0];
    			$highest_bidder = 	$r->user_login;
    		
    		}
    		
            // if user add time from front, then send notice to js file and reset the timer on all users
            $auction_time_added = get_option( '_auction_time_added_' );             
            if( $auction_time_added > 0 ){
                $newpid['time_added_by_user'] = 1;
                update_option( '_auction_time_added_', ( $auction_time_added - 1 ) );                
            }else{
                $newpid['time_added_by_user'] = 0;                
            }               
            
            	
    		$newpid['highest_bidder'] = $highest_bidder;	
    		$newpid['highest_bidder_id'] = $highest_bidder_id->id;		
    		$newpid['pid'] = $pid;
    		$newpid['rnd'] = $rnd;
    		$newpid['remaining_time'] = get_post_meta($pid, 'ending', true) - current_time('timestamp',0);
            
    		$newpid['current_bid'] = PennyTheme_get_show_price(get_post_meta($pid, 'current_bid', true));
    		
    		
    				if($OKOK == "1"):
    		   
    	 			//$closed = get_post_meta($pid, 'closed', true);
    				//$post = get_post($pid);				
    				
    				$bids = "select * from ".$wpdb->prefix."penny_bids where pid='$pid' order by id DESC limit 13";
    				$res  = $wpdb->get_results($bids);
    			
    				$all_bids = '';
    				
    				if(count($res) > 0)
    				{
    					
    				
    					
    						$all_bids .= '<table width="100%">';
    						$all_bids .= '<thead><tr>';
    							$all_bids .= '<th>'.__('Username','PennyTheme').'</th>';
    							$all_bids .= '<th>'.__('Bid Amount','PennyTheme').'</th>';
    					//		echo '<th>'.__('Date Made','PennyTheme').'</th>';
    						
    							
    						$all_bids .= '</tr></thead><tbody>';
    					
    					
    					//-------------
    					
    					foreach($res as $row)
    					{
    						
    						
    						$user = get_userdata($row->uid);
    						
    						$s = "select user_login from ".$wpdb->users." where ID='{$row->uid}'";
    						$r = $wpdb->get_results($s);
    						
    						$all_bids .= '<tr>';
    						$all_bids .= '<th>'.$r[0]->user_login.'</th>';
    						$all_bids .= '<th>'.PennyTheme_get_show_price($row->bid).'</th>';
    					//	echo '<th>'.date("d-M-Y H:i:s", $row->date_made).'</th>';
    						
    						$all_bids .= '</tr>';
    						
    					}
    					
    					$all_bids .= '</tbody></table>';
    				}
    				else $all_bids .= __("No bids placed yet.", 'PennyTheme');
    		
    				$newpid['bidders'] = $all_bids;
    				endif;
    				
    		array_push($info,$newpid); 
    		
    	}
    
    }
		header('Content-type: application/json');
		echo json_encode($info);	
	
}
/*****************************************************************************
*
*	Function - pennyTheme -
*
*****************************************************************************/
function PennyTheme_update_package()
{
	if($_POST['action'] == "update_package")
	{

		$new_package_name_cell 	= trim($_POST['new_package_name_cell']);
		$new_package_cost_cell 	= trim($_POST['new_package_cost_cell']);
		$new_package_bid_cell 	= trim($_POST['new_package_bid_cell']);
		$id = $_POST['id'];
		
		global $wpdb;
		
		$s = "update ".$wpdb->prefix."penny_packages set package_name='$new_package_name_cell', bids='$new_package_bid_cell' 
		, cost='$new_package_cost_cell' where id='$id'";	
		$wpdb->query($s);
		
		
	}
	
}
/*****************************************************************************
*
*	Function - pennyTheme -
*
*****************************************************************************/
function PennyTheme_delete_package()
{
	if($_POST['action'] == "delete_package")
	{

		$id 	= trim($_POST['id']);

		global $wpdb;
		
		$s = "delete from ".$wpdb->prefix."penny_packages where id='$id'";	
		$wpdb->query($s);
		
	}
	
}
/*****************************************************************************
*
*	Function - pennyTheme -
*
*****************************************************************************/
function PennyTheme_new_package_action()
{
	if($_POST['action'] == "new_package_action")
	{

		$new_package_name 	= trim($_POST['new_package_name']);
		$new_package_cost 	= trim($_POST['new_package_cost']);
		$new_package_bid 	= trim($_POST['new_package_bid']);
	
		global $wpdb;
		
		$s = "insert into ".$wpdb->prefix."penny_packages (package_name, cost, bids) values('$new_package_name', '$new_package_cost', '$new_package_bid')";	
		$wpdb->query($s);
		
		$s = "select id from ".$wpdb->prefix."penny_packages where package_name='$new_package_name' and cost='$new_package_cost' and bids='$new_package_bid'";	
		$r = $wpdb->get_results($s);
		$row = $r[0];
		
		$arr = array();
		
		$arr['new_package_name'] 	= $new_package_name;
		$arr['new_package_cost'] 	= $new_package_cost;
		$arr['new_package_bid'] 	= $new_package_bid;
		$arr['id'] 					= $row->id;
		
		echo json_encode($arr);
	}
	
}
/*****************************************************************************
*
*	Function - pennyTheme -
*
*****************************************************************************/

function PennyTheme_update_credits($uid,$am)
{

	update_user_meta($uid,'user_credits',$am);	

}

function PennyTheme_get_credits($uid)
{
	$c = get_user_meta($uid,'user_credits',true);
	if(empty($c))
	{
		update_user_meta($uid,'user_credits',"0");	
		return 0;
	}
	
	return $c;
}

/*****************************************************************************
*
*	Function - pennyTheme -
*
*****************************************************************************/
function PennyTheme_add_front_style()
	{
		?>
  		<script type="text/javascript">
			
			var $ = jQuery;
			
			var MY_SITE_URL = "<?php echo get_bloginfo('url'); ?>";
			var NO_BIDS = "<?php echo __('No Bids','PennyTheme'); ?>";
		</script>

		<script type="text/javascript" src="<?php echo get_bloginfo('template_url'); ?>/js/countdown.js"></script>	
        <script type="text/javascript" src="<?php echo get_bloginfo('template_url'); ?>/js/smart-updater.js"></script>	
        <script type="text/javascript" src="<?php echo get_bloginfo('template_url'); ?>/js/jquery.color.js"></script>	
        <script type="text/javascript" src="<?php echo get_bloginfo('template_url'); ?>/js/penny_scripts8.js"></script>	
         
        <script type="text/javascript" src="<?php echo get_bloginfo('template_url'); ?>/js/jquery.colorbox.js"></script>

        <link rel="stylesheet" type="text/css" media="all" href="<?php echo get_bloginfo('template_url'); ?>/css/colorbox.css" />
      
		<?php
	}

/*****************************************************************************
*
*	Function - pennyTheme -
*
*****************************************************************************/
function PennyTheme_slider_post()
{

			$highest_bid = PennyTheme_get_show_price(get_post_meta(get_the_ID(), 'current_bid', true));
			$ending = get_post_meta(get_the_ID(), 'ending', true);
			$sec 	= $ending - current_time('timestamp',0);	
			$closed = get_post_meta(get_the_ID(), 'closed', true);
			$post 	= get_post(get_the_ID());
		
			$now 	= current_time('timestamp',0);
			
			global $current_user;
			get_currentuserinfo();
			$uid = $current_user->ID;
			
			$rnd = rand(1,999);
			$retail_price 	= PennyTheme_formats(get_post_meta(get_the_ID(), 'retail_price', true),2);
			$time_increase 	= get_post_meta(get_the_ID(), 'time_increase', true);
			
			$rem = $ending - $now;
	?>
	
	<div class="slider-post"><div class="clear10"></div>
    
		<a href="<?php the_permalink(); ?>"><img width="140" height="100" class="image_class_slider" 
                src="<?php echo PennyTheme_get_first_post_image(get_the_ID(),140,100); ?>" /></a>
                <br/>
                
                 <p class="small-tttl"><b><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
                        <?php         echo substr(get_the_title(),0,26);  ?></a></b>
                       </p>
		
        	<input type="hidden" class="my-total-ids-no-delete" value="<?php the_ID(); ?>_<?php echo $rnd; ?>" />
            <div class="my-bid-live-detail">
                            <div class="my-time-live2" id="my-auction-time_<?php the_ID(); ?>_<?php echo $rnd; ?>"><?php echo $rem; ?></div>
                            
                            <div class="bid-btn2"><a href="<?php the_permalink() ?>" class="mm_bid_mmp" rel="<?php the_ID(); ?>"><?php _e('Bid Now','PennyTheme'); ?></a></div>
                            
                            <div class="my-current-price-live2" >
                            <span class="my-current-price-live-content" id="my-current-price_<?php the_ID(); ?>_<?php echo $rnd; ?>"><?php echo $highest_bid; ?></span>
                            </div>  
                            
                         <div class="clear10"></div>   
            			</div>
            
        
        
	</div>
	
	<?php
}

/*****************************************************************************
*
*	Function - pennyTheme -
*
*****************************************************************************/

function PennyTheme_prepare_seconds_to_words($seconds)
	{
		$res = pennyTheme_seconds_to_words_new($seconds); 
		if($res == "Expired") return __('Expired','PennyTheme');	
		
		if($res[0] == 0) return sprintf(__("%s hours, %s min, %s sec",'PennyTheme'), $res[1], $res[2], $res[3]);
		if($res[0] == 1){
			
			$plural = $res[1] > 1 ? __('days','PennyTheme') : __('day','PennyTheme');
			return sprintf(__("%s %s, %s hours, %s min",'PennyTheme'), $res[1], $plural , $res[2], $res[3]);
		}
	}

/*************************************************************
*
*	PennyTheme (c) sitemile.com - function
*
**************************************************************/
function pennyTheme_seconds_to_words_new($seconds)
{
		if($seconds < 0 ) return 'Expired';
			
        /*** number of days ***/
        $days=(int)($seconds/86400); 
        /*** if more than one day ***/
        $plural = $days > 1 ? 'days' : 'day';
        /*** number of hours ***/
        $hours = (int)(($seconds-($days*86400))/3600);
        /*** number of mins ***/
        $mins = (int)(($seconds-$days*86400-$hours*3600)/60);
        /*** number of seconds ***/
        $secs = (int)($seconds - ($days*86400)-($hours*3600)-($mins*60));
        /*** return the string ***/
                if($days == 0 || $days < 0)
				{
					$arr[0] = 0;
					$arr[1] = $hours;
					$arr[2] = $mins;
					$arr[3] = $secs;
					return $arr;//sprintf("%d hours, %d min, %d sec", $hours, $mins, $secs);
				}
				else
				{
					$arr[0] = 1;
					$arr[1] = $days;
					$arr[2] = $hours;
					$arr[3] = $mins;
					
					return $arr; //sprintf("%d $plural, %d hours, %d min", $days, $hours, $mins);
        		}			
	
}
/*****************************************************************************
*
*	Function - pennyTheme -
*
*****************************************************************************/
function PennyTheme_get_first_post_image($pid, $w = 100, $h = 100)
{
	
	//---------------------
	// build the exclude list
	$exclude = array();
	
	$args = array(
	'order'          => 'ASC',
	'post_type'      => 'attachment',
	'post_parent'    => get_the_ID(),
	'meta_key'		 => 'another_reserved1',
	'meta_value'	 => '1',
	'numberposts'    => -1,
	'post_status'    => null,
	);
	$attachments = get_posts($args);
	if ($attachments) {
	    foreach ($attachments as $attachment) {
		$url = $attachment->ID;
		array_push($exclude, $url);
	}
	}
	
	//-----------------

	$args = array(
	'order'          => 'ASC',
	'orderby'        => 'post_date',
	'post_type'      => 'attachment',
	'post_parent'    => $pid,
	'exclude'    		=> $exclude,
	'post_mime_type' => 'image',
	'post_status'    => null,
	'numberposts'    => 1,
	);
	$attachments = get_posts($args);
	if ($attachments) {
	    foreach ($attachments as $attachment) 
	    {
			$url = wp_get_attachment_url($attachment->ID);
			return PennyTheme_generate_thumb($url, $w, $h);	  
		}
	}
	else{
			return get_bloginfo('template_url').'/images/nopic.png';
			
	}
}
/*****************************************************************************
*
*	Function - pennyTheme -
*
*****************************************************************************/
function PennyTheme_my_auctions_columns($columns) //this function display the columns headings
{
	$columns["cb"] = 		"<input type=\"checkbox\" />";
	$columns["title"] = 		__("Auction Title","PennyTheme");
	$columns["author"] =		__("Author","PennyTheme");
	$columns["posted"] = 	__("Posted On","PennyTheme");
	$columns["price"] =		__("Price","PennyTheme");
	$columns["exp"] = 		__("Expires in","PennyTheme");
	$columns["feat"] = 		__("Featured","PennyTheme");
	$columns["thumbnail"] =	__("Thumbnail","PennyTheme");
	$columns["options"] = 	__("Options","PennyTheme");	
	
	return $columns;
}
/*****************************************************************************
*
*	Function - pennyTheme -
*
*****************************************************************************/
function PennyTheme_my_custom_columns($column)
{
	global $post;
	if ("ID" == $column) echo $post->ID; //displays title
	elseif ("description" == $column) echo $post->ID; //displays the content excerpt
	elseif ("posted" == $column) echo date('jS \of F, Y \<\b\r\/\>H:i:s',strtotime($post->post_date)); //displays the content excerpt
	elseif ("thumbnail" == $column) 
	{
		echo '<a href="'.get_bloginfo('url').'/wp-admin/post.php?post='.$post->ID.'&action=edit"><img class="image_class" 
	src="'.PennyTheme_get_first_post_image($post->ID,75,65).'" width="75" height="65" /></a>'; //shows up our post thumbnail that we previously created.
	}
	
	elseif ("author" == $column)
	{
		echo $post->post_author;	
	}
	
	
	elseif ("feat" == $column)
	{
		$f = get_post_meta($post->ID,'featured', true);	
		if($f == "1") echo __("Yes","PennyTheme");
		else  echo __("No","PennyTheme");
	}
	
	elseif ("price" == $column)
	{	
		echo PennyTheme_get_show_price(get_post_meta($post->ID,'current_bid',true));
	}
	
	elseif ("exp" == $column)
	{
		$ending = get_post_meta($post->ID, 'ending', true);		
		echo PennyTheme_prepare_seconds_to_words($ending - current_time('timestamp',0));	
	}
	
	elseif ("options" == $column)
	{
		echo '<div style="padding-top:20px">';
		echo '<a class="awesome" href="'.get_bloginfo('url').'/wp-admin/post.php?post='.$post->ID.'&action=edit">Edit</a> ';	
		echo '<a class="awesome" href="'.get_permalink($post->ID).'" target="_blank">View</a> ';
		echo '<a class="trash" href="'.get_delete_post_link($post->ID).'">Trash</a> ';
		echo '</div>';
	}
	
}		
/*****************************************************************************
*
*	Function - pennyTheme -
*
*****************************************************************************/

function PennyTheme_admin_main_head_scr()
{
 
	wp_enqueue_script("jquery-ui-widget");
	wp_enqueue_script("jquery-ui-mouse");
	wp_enqueue_script("jquery-ui-tabs");
	wp_enqueue_script("jquery-ui-datepicker");
	wp_enqueue_script("jquery-ui-slider");
	
	wp_enqueue_script(
          'jquery-ui-timepicker-addon',
          get_bloginfo('template_url') . '/js/jquery-ui-timepicker-addon.js',
          array('jquery')
      );
	
?>	
	
     

    <link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/css/admin.css" type="text/css" />    
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/colorpicker.css" type="text/css" />
    <link rel="stylesheet" media="screen" type="text/css" href="<?php bloginfo('template_url'); ?>/css/layout.css" />
	<link type="text/css" href="<?php bloginfo('template_url'); ?>/css/jquery-ui-1.8.16.custom.css" rel="stylesheet" />	
	
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/idtabs.js"></script>	
	
        <link rel="stylesheet" media="all" type="text/css" href="<?php echo get_bloginfo('template_url'); ?>/css/ui-thing.css" />
 

		
		<script type="text/javascript">
			
	 
		jQuery(document).ready(function() {		
  jQuery("#usual2 ul").idTabs("tabs1"); 
		});
		</script>
	

 	

<?php	
}	
/*****************************************************************************
*
*	Function - pennyTheme -
*
*****************************************************************************/	
	
function PennyTheme_set_metaboxes()
{
		add_meta_box( 'auction_images', 'Auction Images',	'PennyTheme_theme_auction_images', 	'auction', 'advanced',	'high' );
		add_meta_box( 'penny_bids', 	'Auction Bids',		'PennyTheme_theme_penny_bids', 		'auction', 'advanced',	'high' );
		add_meta_box( 'auction_dets', 	'Auction Details',	'PennyTheme_theme_auction_dts', 	'auction', 'side',		'high' );	
}
/*****************************************************************************
*
*	Function - pennyTheme -
*
*****************************************************************************/
function PennyTheme_theme_penny_bids()
{
	global $post;
	$pid = $post->ID;
	
	$closed = get_post_meta($pid, 'closed', true);
	$post = get_post($pid);
	global $wpdb;
				
	$bids = "select * from ".$wpdb->prefix."penny_bids where pid='$pid' order by id DESC";
	$res  = $wpdb->get_results($bids);
	
				if(count($res) > 0)
				{
					
				
					
						echo '<table width="100%">';
						echo '<thead><tr>';
							echo '<th>'.__('Username','PennyTheme').'</th>';
							echo '<th>'.__('Bid Amount','PennyTheme').'</th>';
							echo '<th>'.__('Date Made','PennyTheme').'</th>';
							
							echo '<th>'.__('Winner','PennyTheme').'</th>';
							
						echo '</tr></thead><tbody>';
					
					
					//-------------
					
					foreach($res as $row)
					{
						
						
						$user = get_userdata($row->uid);
						echo '<tr>';
						echo '<th>'.$user->user_login.'</th>';
						echo '<th>'.PennyTheme_get_show_price($row->bid).'</th>';
						echo '<th>'.date("d-M-Y H:i:s", $row->date_made).'</th>';
						
						
						if($row->winner == 1) echo '<th>Yes</th>'; else echo '<th>&nbsp;</th>'; 
						
						echo '</tr>';
						
					}
					
					echo '</tbody></table>';
				}
				else _e("No bids placed yet.");
			
	
}
/*****************************************************************************
*
*	Function - pennyTheme -
*
*****************************************************************************/
function PennyTheme_get_show_price($price, $cents = 2)
{	
	$PennyTheme_currency_position = get_option('PennyTheme_currency_position');	
	if($PennyTheme_currency_position == "front") return PennyTheme_get_currency()."".PennyTheme_formats($price, $cents);	
	return PennyTheme_formats($price,$cents)."".PennyTheme_get_currency();	
		
}
/*****************************************************************************
*
*	Function - pennyTheme -
*
*****************************************************************************/
function PennyTheme_formats_special($number, $cents = 1) { // cents: 0=never, 1=if needed, 2=always
  
	$dec_sep = '.';
	$tho_sep = ',';
  
  //dec,thou
  
  if (is_numeric($number)) { // a number
    if (!$number) { // zero
      $money = ($cents == 2 ? '0'.$dec_sep.'00' : '0'); // output zero
    } else { // value
      if (floor($number) == $number) { // whole number
        $money = number_format($number, ($cents == 2 ? 2 : 0), $dec_sep, '' ); // format
      } else { // cents
        $money = number_format(round($number, 2), ($cents == 0 ? 0 : 2), $dec_sep, '' ); // format
      } // integer or decimal
    } // value
    return $money;
  } // numeric
} // formatMoney
/*****************************************************************************
*
*	Function - pennyTheme -
*
*****************************************************************************/

function PennyTheme_formats($number, $cents = 1) { // cents: 0=never, 1=if needed, 2=always
  
  $dec_sep = get_option('PennyTheme_decimal_sum_separator');
  if(empty($dec_sep)) $dec_sep = '.';
  
  $tho_sep = get_option('PennyTheme_thousands_sum_separator');
  if(empty($tho_sep)) $tho_sep = ',';
  
  //dec,thou
  
  if (is_numeric($number)) { // a number
    if (!$number) { // zero
      $money = ($cents == 2 ? '0'.$dec_sep.'00' : '0'); // output zero
    } else { // value
      if (floor($number) == $number) { // whole number
        $money = number_format($number, ($cents == 2 ? 2 : 0), $dec_sep, $tho_sep ); // format
      } else { // cents
        $money = number_format(round($number, 2), ($cents == 0 ? 0 : 2), $dec_sep, $tho_sep ); // format
      } // integer or decimal
    } // value
    return $money;
  } // numeric
} // formatMoney
/*****************************************************************************
*
*	Function - pennyTheme -
*
*****************************************************************************/
function PennyTheme_get_currency()
{
	$c = trim(get_option('PennyTheme_currency_symbol'));
	if(empty($c)) return get_option('PennyTheme_currency');
	return $c;	
	
}
/*****************************************************************************
*
*	Function - pennyTheme -
*
*****************************************************************************/
function PennyTheme_currency()
{
	return PennyTheme_get_currency();	
}
/*****************************************************************************
*
*	Function - pennyTheme -
*
*****************************************************************************/
function PennyTheme_theme_auction_images()
{

	global $current_user;
	get_currentuserinfo();
	$cid = $current_user->ID;
	
	global $post;
	$pid = $post->ID;


?>
	
    
    <script type="text/javascript" src="<?php echo get_bloginfo('template_url'); ?>/lib/uploadify/jquery.uploadify-3.1.js"></script>     
	<link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/lib/uploadify/uploadify.css" type="text/css" />
	
    <script type="text/javascript">
	
	function delete_this(id)
	{
		 $.ajax({
						method: 'get',
						url : '<?php echo get_bloginfo('url');?>/index.php/?_ad_delete_pid='+id,
						dataType : 'text',
						success: function (text) {   $('#image_ss'+id).remove();  }
					 });
		  //alert("a");
	
	}

	
	
	$(function() {
		
		$("#fileUpload3").uploadify({
			height        : 30,
			auto:			true,
			swf           : '<?php echo get_bloginfo('template_url'); ?>/lib/uploadify/uploadify.swf',
			uploader      : '<?php echo get_bloginfo('template_url'); ?>/lib/uploadify/uploady.php',
			width         : 120,
			fileTypeExts  : '*.jpg;*.jpeg;*.gif;*.png',
			formData    : {'ID':<?php echo $pid; ?>,'author':<?php echo $cid; ?>},
			onUploadSuccess : function(file, data, response) {
			
			//alert(data);
			var bar = data.split("|");
			
$('#thumbnails').append('<div class="div_div" id="image_ss'+bar[1]+'" ><img width="70" class="image_class" height="70" src="' + bar[0] + '" /><a href="javascript: void(0)" onclick="delete_this('+ bar[1] +')"><img border="0" src="<?php echo get_bloginfo('template_url'); ?>/images/delete_icon.png" border="0" /></a></div>');
}
	
			
			
    	});
		
		
	});
	
	
	</script>
	
    <style type="text/css">
	.div_div
	{
		margin-left:5px; float:left; 
		width:110px;margin-top:10px;
	}
	
	</style>
    
    <div id="fileUpload3">You have a problem with your javascript</div>
    <div id="thumbnails" style="overflow:hidden;margin-top:20px">
    
    <?php

		$args = array(
		'order'          => 'ASC',
		'orderby'        => 'post_date',
		'post_type'      => 'attachment',
		'post_parent'    => $post->ID,
		'post_mime_type' => 'image',
		'numberposts'    => -1,
		); $i = 0;
		
		$attachments = get_posts($args);



	if ($attachments) {
	    foreach ($attachments as $attachment) {
		$url = wp_get_attachment_url($attachment->ID);
		
			echo '<div class="div_div"  id="image_ss'.$attachment->ID.'"><img width="70" class="image_class" height="70" src="' .
			PennyTheme_generate_thumb($url, 70, 70). '" />
			<a href="javascript: void(0)" onclick="delete_this(\''.$attachment->ID.'\')"><img border="0" src="'.get_bloginfo('template_url').'/images/delete_icon.png" /></a>
			</div>';
	  
	}
	}


	?>
    
    </div>
    
<?php 

}
/*****************************************************************************
*
*	Function - pennyTheme -
*
*****************************************************************************/
function PennyTheme_theme_auction_dts()
{
	global $post;
	$pid = $post->ID;
	$price = get_post_meta($pid, "price", true);
	$location = get_post_meta($pid, "Location", true);
	$f = get_post_meta($pid, "featured", true);
	$t = get_post_meta($pid, "closed", true);
	
	$reverse = get_post_meta($pid, "reverse", true);
	
    $seats_style = 'display:none;';
    if( get_post_meta( $pid, 'enable_seats', true ) == 1 ){
        $seats_style = 'display:block;';
    }
    
	?>
    <script>
        jQuery(function(){
            jQuery('#seats_checkbox').change(function(){
                if( jQuery(this).is(':checked') == false ){
                    jQuery('#seats_wrapper').slideUp();
                    jQuery('#ending').val('<?php echo date('m/d/Y H:i', strtotime('+1 days')); ?>');
                }else{
                    jQuery('#seats_wrapper').slideDown();
                    jQuery('#free_seats_wrapper').slideUp();
                    jQuery('#free_auction').prop('checked',false);
                    jQuery('#ending').val('<?php echo date('m/d/Y H:i', strtotime('+6 months')); ?>');   
                }
            })
            jQuery('#free_auction').change(function(){
                if( jQuery(this).is(':checked') == false ){
                    jQuery('#free_seats_wrapper').slideUp();
                }else{
                    jQuery('#free_seats_wrapper').slideDown();
                    jQuery('#seats_wrapper').slideUp();
                    jQuery('#seats_checkbox').prop('checked',false);   
                }
            })
        })
    </script>
    <ul id="post-new4" class="post_right_side"> 
    <input name="fromadmin" type="hidden" value="1a" />
        
        <li>
        	<h2><input  id="free_auction" type="checkbox" name="free_auction" class="do_input" value="1" <?php echo get_post_meta($pid, 'free_auction', true) != 0 ? 'checked="checked"' : '' ; ?> /><?php echo __('Free Auction','PennyTheme'); ?>:</h2>
            <p>&nbsp;</p>
        </li>
        
        <li>
        	<h2><input  id="seats_checkbox" type="checkbox" name="enable_seats" class="do_input" value="1" <?php echo get_post_meta($pid, 'enable_seats', true) != 0 ? 'checked="checked"' : '' ; ?> /><?php echo __('Enable Seats','PennyTheme'); ?>:</h2>
            <p>&nbsp;</p>
        </li>
        
        <li id="seats_wrapper" style="padding-left: 20px;<?php echo $seats_style; ?>">
            <ul>    
                <li><h2><?php echo __('Seats','PennyTheme'); ?>:</h2>
                <p><input type="text" size="10" id="seats_input" name="seats" class="do_input" value="<?php echo get_post_meta($pid, 'seats', true); ?>" /></p>
                </li>
                
                <li><h2><?php echo __('Additional Seats','PennyTheme'); ?>:</h2>
                <p style="width: 100%;">Add&nbsp;<input value="<?php echo get_post_meta($pid, 'additional_seats', true) > 0 ? get_post_meta($pid, 'additional_seats', true) : 0; ?>" style="width: 35px;" type="text" name="additional_seats"/> seats after each<input value="<?php echo get_post_meta($pid, 'additional_seats_bids', true) > 0 ? get_post_meta($pid, 'additional_seats_bids', true) : 0; ?>" style="width: 35px;" type="text" name="additional_seats_bids"/> bids</p>
                (In free seat case only)<br /><br />
                </li>
                
                <li>
                	<h2><?php echo __('Seats limit per User','PennyTheme'); ?>:</h2>
                <p><input type="text" size="10" name="seats_per_user" class="do_input" value="<?php echo get_post_meta($pid, 'seats_per_user', true) != '' ? get_post_meta($pid, 'seats_per_user', true) : 0 ; ?>" />
                (zero to allow all)</p>
                </li>
                
                <li>
                	<h2><?php echo __('Custom Seat Price','PennyTheme'); ?>:</h2>
                <p><input type="text" size="10" name="custom_seat_price" class="do_input" value="<?php echo get_post_meta($pid, 'custom_seat_price', true); ?>" />
                <?php echo PennyTheme_currency(); ?><br />(zero for free)</p>
                </li>
                
                <li><hr style="color: black;border: 1px solid black;" /></li>
                
                
                
                <!--li>
                	<h2><?php //echo __('Auction Buy Limit Per Seat','PennyTheme'); ?>:</h2>
                    <p>
                        <input type="radio" id="is_buy_limit_per_seat_yes" name="is_buy_limit_per_seat" value="1" <?php //echo get_post_meta($pid, 'is_buy_limit_per_seat', true) != 0 ? 'checked="checked"' : '' ; ?> />&nbsp;<label for="is_buy_limit_per_seat_yes">Yes</label>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" id="is_buy_limit_per_seat_no" name="is_buy_limit_per_seat" value="0" <?php //echo ( get_post_meta($pid, 'is_buy_limit_per_seat', true) == 0 || get_post_meta($pid, 'is_buy_limit_per_seat', true) == '' ) ? 'checked="checked"' : '' ; ?> />&nbsp;<label for="is_buy_limit_per_seat_no">No</label>
                    </p>
                </li-->    
                
                <li><h2><?php echo __('Auction Validity','PennyTheme'); ?>:</h2>
                        <div style="float: left;width: 30%;">
                            <select name="add_time">
                                <?php for( $i = 0; $i <= 100; $i++ ){
                                    $selected = '';
                                    if( $i == get_post_meta($pid, 'add_time', true) ){ $selected = 'selected="selected"'; }
                                    echo '<option '.$selected.' value="'.$i.'">'.$i.'</option>';   
                                } ?>
                            </select>&nbsp;Days
                        </div>
                        <div style="float: left;width: 30%;">
                            <select name="add_hours">
                                <?php for( $i = 0; $i <= 24; $i++ ){
                                    $selected_hr = '';
                                    if( $i == get_post_meta($pid, 'add_hours', true) ){ $selected_hr = 'selected="selected"'; }
                                    echo '<option '.$selected_hr.' value="'.$i.'">'.$i.'</option>';   
                                } ?>
                            </select>&nbsp;Hours
                        </div>
                        <div style="float: left;width: 30%;">
                            <select name="add_mins">
                                <?php for( $i = 0; $i <= 59; $i++ ){
                                    $selected_min = '';
                                    if( $i == get_post_meta($pid, 'add_mins', true) ){ $selected_min = 'selected="selected"'; }
                                    echo '<option '.$selected_min.' value="'.$i.'">'.$i.'</option>';   
                                } ?>
                            </select>&nbsp;Minutes
                        </div>
                        <div style="clear: both;"></div>
                </li>
                
                <li><h2><?php echo __('Time Tokens Per User','PennyTheme'); ?>:</h2>
                <p><input type="text" size="10" name="time_limit_per_user" class="do_input" value="<?php echo get_post_meta($pid, 'time_limit_per_user', true); ?>" />
                (0 to disable time addition)</p>
                </li>
                
                <li><h2><?php echo __('Time Token Type','PennyTheme'); ?>:</h2>
                <p>
                    <select name="timer_type">
                        <option value="free" <?php if( get_post_meta($pid, 'timer_type', true) == 'free' ) echo 'selected="selected"'; ?>>Free</option>
                        <option value="paid" <?php if( get_post_meta($pid, 'timer_type', true) == 'paid' ) echo 'selected="selected"'; ?>>Paid</option>
                    </select>
                </p>
                </li>
                
                <li><h2><?php echo __('Time Token Cost','PennyTheme'); ?>:</h2>
                <p><input type="text" size="10" name="time_cost" class="do_input" value="<?php echo get_post_meta($pid, 'time_cost', true); ?>" />
                <?php echo PennyTheme_currency(); ?></p>
                </li>
                
                <li>
                	<h2><?php echo __('Time Increase','PennyTheme'); ?>:</h2>
                <p><input type="text" size="5" name="time_increase" class="do_input" 
                	value="<?php echo get_post_meta($pid, 'time_increase', true); ?>" /> seconds</p>
                </li>
                
            </ul>
        </li>
        
        <li>
        	<h2><?php echo __('Auction Item Stock','PennyTheme'); ?>:</h2>
            <br /><br />
            <input type="text" size="10" name="auction_item_stock" class="do_input" value="<?php echo get_post_meta($pid, 'auction_item_stock', true) != '' ? get_post_meta($pid, 'auction_item_stock', true) : 0 ; ?>" />
            <br />
            (zero to set unlimited)
            <br /><br />
        </li>
        
        <li>
        	<h2><?php echo __('Remaining Auction Item Stock','PennyTheme'); ?>:</h2>
            <br /><br />
            <?php
                $remaining_stock = get_post_meta($pid, 'auction_item_stock', true) - get_auction_item_sold_times( $pid );
                if( $remaining_stock < 0 ) $remaining_stock = 0;
            ?>
            <input type="text" size="10" readonly="readonly" class="do_input" value="<?php echo $remaining_stock; ?>" />
            <br />
        </li>
        
        <li><hr style="color: black;border: 1px solid black;" /><br /></li>
                
        <li>
        	<h2><?php echo __('Bids limit per User','PennyTheme'); ?>:</h2>
        <p><input type="text" size="10" name="bid_per_user" class="do_input" value="<?php echo get_post_meta($pid, 'bid_per_user', true) == '' ? 0 : get_post_meta($pid, 'bid_per_user', true); ?>" />
            (zero to allow all)</p>
        </li>
        
        
        <li>
        	<h2><?php echo __('Shipping','PennyTheme'); ?>:</h2>
        <p><input type="text" size="10" name="shipping" class="do_input" 
        	value="<?php echo get_post_meta($pid, 'shipping', true); ?>" /> 
			<?php echo PennyTheme_currency(); ?></p>
        </li>

        <li>
        	<h2><?php echo __('Start Price','PennyTheme'); ?>:</h2>
        <p><input id="start_price" type="text" size="10" name="start_price" class="do_input" 
        	value="<?php echo get_post_meta($pid, 'start_price', true); ?>" /> 
			<?php echo PennyTheme_currency(); ?></p>
        </li>
        
        
          <li>
        	<h2><?php echo __('Reserve','PennyTheme'); ?>:</h2>
        <p><input type="text" size="10" name="reserve" class="do_input" 
        	value="<?php echo get_post_meta($pid, 'reserve', true); ?>" /> 
			<?php echo PennyTheme_currency(); ?> (can be empty)</p>
        </li>
        
         <li>
        	<h2><?php echo __('Buy Now','PennyTheme'); ?>:</h2>
        <p><input id="buy_now" type="text" size="10" name="buy_now" class="do_input" 
        	value="<?php echo get_post_meta($pid, 'buy_now', true); ?>" /> 
			<?php echo PennyTheme_currency(); ?> (can be empty)</p>
        </li>
        
        
        <li>
        	<h2><?php echo __('Retail Price','PennyTheme'); ?>:</h2>
        <p><input type="text" size="10" name="retail_price" class="do_input" 
        	value="<?php echo get_post_meta($pid, 'retail_price', true); ?>" /> 
			<?php echo PennyTheme_currency(); ?></p>
        </li>
        
        
        <li>
        	<h2><?php echo __('Bid Increase Price','PennyTheme'); ?>:</h2>
        <p><input type="text" size="10" name="price_increase" class="do_input" 
        	value="<?php echo get_post_meta($pid, 'price_increase', true); ?>" /> <?php echo PennyTheme_currency(); ?></p>
        </li>
        
     	<li>
        <h2><?php _e("Feature this auction",'PennyTheme');?>:</h2>
        <p><input type="checkbox" value="1" name="featureds" <?php if($f == '1') echo ' checked="checked" '; ?> /></p>
        </li>
        
        <li>
        <h2><?php _e("Feature Text",'PennyTheme');?>:</h2>
        <p><input type="text" value="<?php echo get_post_meta($pid, 'featured_text', true); ?>" name="featured_text" /></p>
        </li>
        
        
        <li>
        <h2><?php _e("Closed",'PennyTheme');?>:</h2>
        <p><input type="checkbox" value="1" name="closed" <?php if($t == '1') echo ' checked="checked" '; ?> /></p>
        </li>
        
        <style>
		
		.ui-timepicker-div .ui-widget-header { margin-bottom: 8px; }
.ui-timepicker-div dl { text-align: left; }
.ui-timepicker-div dl dt { height: 25px; margin-bottom: -25px; }
.ui-timepicker-div dl dd { margin: 0 10px 10px 65px; }
.ui-timepicker-div td { font-size: 90%; }
.ui-tpicker-grid-label { background: none; border: none; margin: 0; padding: 0; }

.ui-timepicker-rtl{ direction: rtl; }
.ui-timepicker-rtl dl { text-align: right; }
.ui-timepicker-rtl dl dd { margin: 0 65px 10px 10px; }
		
		</style>
        
        
                 <li>
        <h2>
        
 
          
          <?php
		  
		  	$d = get_post_meta($pid,'ending',true);
	  
		  ?>
          
       <?php _e("Auction Ending On",'PennyTheme'); ?>:</h2>
        <p><input type="text" name="ending" id="ending" value="<?php
		
		
		
		if(!empty($d)) {
		$r = date('m/d/Y H:i', $d);
		echo $r;
		}
		 ?>" class="do_input"  /></p>
        </li>
        
 <script>

var $ = jQuery;

$(document).ready(function() {
	 $('#ending').datetimepicker({
showSecond: false
}); });
 
 </script>
        
        
	</ul>    

	
	<?php
	
}

	function PennyTheme_get_avatar($uid, $w = 25, $h = 25)
	{
		$av = get_user_meta($uid, 'avatar', true);
		if(empty($av)) return get_bloginfo('template_url')."/images/noav.jpg";
		else return PennyTheme_generate_thumb($av, $w, $h);
	}


/*****************************************************************************
*
*	Function - pennyTheme -
*
*****************************************************************************/
function PennyTheme_generate_thumb($img_url, $width, $height, $cut = true)
{

	
	require_once(ABSPATH . '/wp-admin/includes/image.php');
	$uploads = wp_upload_dir();
	$basedir = $uploads['basedir'].'/';
	$exp = explode('/',$img_url);
	
	$nr = count($exp);
	$pic = $exp[$nr-1];
	$year = $exp[$nr-3];
	$month = $exp[$nr-2];

	if($uploads['basedir'] == $uploads['path'])
	{
		$img_url = $basedir.'/'.$pic;
		$ba = $basedir.'/';
		$iii = $uploads['url'];
	}
	else
	{
		$img_url = $basedir.$year.'/'.$month.'/'.$pic;
		$ba = $basedir.$year.'/'.$month.'/';
		$iii = $uploads['baseurl']."/".$year."/".$month;
	}
	list($width1, $height1, $type1, $attr1) = getimagesize($img_url);
	
	//return $height;
	$a = false;
	if($width == -1)
	{
		$a = true;
	
	}


	if($width > $width1) $width = $width1-1;
	if($height > $height1) $height = $height1-1;

	if($a == true)
	{
		$prop = $width1 / $height1;
		$width = round($prop * $height);
	}
	
		$width = $width-1;
	$height = $height-1;
	
	
	$xxo = "-".$width."x".$height;
	$exp = explode(".", $pic);
	$new_name = $exp[0].$xxo.".".$exp[1];
	
	$tgh = str_replace("//","/",$ba.$new_name);

	if(file_exists($tgh)) return $iii."/".$new_name;	



	$thumb = image_resize($img_url,$width,$height,$cut);
	
	if(is_wp_error($thumb)) return "is-wp-error";
	
	$exp = explode($basedir, $thumb);	
    return $uploads['baseurl']."/".$exp[1]; 
}


add_action( 'admin_footer-post.php', 'ending_auction_action_javascript' ); // Write our JS below here
function ending_auction_action_javascript() {
    $pid = intval( $_GET['post'] ); 
    if( $pid > 0 ){ 
        ?>
    	<script type="text/javascript" >
    	jQuery(document).ready(function() {
    	    setInterval(function(){ 
    	        var data = {
        			'action': 'ending_auction_action',
        			'pid': '<?php echo $pid; ?>'
        		};
        		// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
        		jQuery.post(ajaxurl, data, function(response) {
        		  if( response != '' ){
        		      jQuery('#ending').val(response);    
        		  }
        		});
    	    },3000)
    	});
    	</script> <?php
    }  
}

add_action( 'wp_ajax_ending_auction_action', 'ending_auction_action_callback' );
function ending_auction_action_callback() {
	$pid = intval( $_POST['pid'] );
    $update_time = get_post_meta( $pid, 'ending_admin_update',true );
    if( $update_time == 1 ){
        update_post_meta($pid, 'ending_admin_update', 0);
        echo date( 'm/d/Y H:i', get_post_meta( $pid, 'ending', true ) );    
    }else{
        echo '';
    }
	wp_die();
}

add_action( 'wp_ajax_get_user_available_creadits', 'get_user_available_creadits' );
add_action( 'wp_ajax_nopriv_get_user_available_creadits', 'get_user_available_creadits' );
function get_user_available_creadits() {
	$uid = intval( $_POST['uid'] );
    echo get_user_available_credits( $uid );
	wp_die();
}

add_action( 'wp_ajax_check_auction_seats', 'check_auction_seats_ajax' );
add_action( 'wp_ajax_nopriv_check_auction_seats', 'check_auction_seats_ajax' );
function check_auction_seats_ajax() {
    global $wpdb;
	$pid = intval( $_POST['pid'] );
    $uid = intval( $_POST['uid'] );
    $selected_seats = intval( $_POST['selected_seats'] );
    $data = '';
    if( $selected_seats > get_auction_remaining_seats($pid) ){
        echo 0;
    }else{
        $wpdb->query(" INSERT INTO ".$wpdb->prefix."auctions_seats SET uid = '$uid', pid = '$pid', seats = '$selected_seats' ");
        echo '';
    }
	wp_die();
}

add_action( 'wp_ajax_get_auction_users', 'get_auction_users' );
add_action( 'wp_ajax_nopriv_get_auction_users', 'get_auction_users' );
function get_auction_users() {
    global $wpdb;
	$pid = intval( $_POST['pid'] );
    $data = '';
    $auction_users = $wpdb->get_results(" SELECT u.display_name, u.ID FROM ".$wpdb->prefix."users u JOIN ".$wpdb->prefix."auctions_seats au
                                            ON u.ID = au.uid WHERE au.pid = '$pid' GROUP BY au.uid ");
    if( count( $auction_users ) > 0 ){
        $data .= '<option value="0" selected="selected">Select User</option>';
        foreach( $auction_users as $row ){
            $data .= '<option value="'.$row->ID.'">'.$row->display_name.'</option>';    
        }
    }
    echo $data;
	wp_die();
}

add_action( 'admin_footer', 'additional_seats_action_javascript' ); // Write our JS below here
function additional_seats_action_javascript() {
    $pid = intval( $_GET['post'] );
    if( $pid > 0 ){ 
        ?>
    	<script type="text/javascript" >
    	jQuery(document).ready(function() {
    	    setInterval(function(){ 
    	        var data = {
        			'action': 'additional_seats_action',
        			'pid': '<?php echo $pid; ?>'
        		};
        		// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
        		jQuery.post(ajaxurl, data, function(response) {
        		  if( response != '' ){
        		      jQuery('#seats_input').val(response);    
        		  }
        		});
    	    },3500)
    	});
    	</script> <?php
    }  
}

add_action( 'wp_ajax_additional_seats_action', 'additional_seats_action_callback' );
function additional_seats_action_callback() {
	$pid = intval( $_POST['pid'] );
    $update_time = get_post_meta( $pid, 'additional_seats_update',true );
    if( $update_time == 1 ){
        update_post_meta($pid, 'additional_seats_update', 0);
        echo get_post_meta( $pid, 'seats',true );    
    }else{
        echo '';
    }
	wp_die();
}

/*****************************************************************************
*
*	Function - pennyTheme -
*
*****************************************************************************/
function PennyTheme_save_custom_fields($pid)
{

	if(isset($_POST['fromadmin']))
	{	

	$now = current_time('timestamp',0);
	$time_increase 		= get_post_meta($pid,"time_increase",true);
	$price_increase 	= get_post_meta($pid,"price_increase",true);
	$views 				= get_post_meta($pid,"views",true);
	$closed 			= get_post_meta($pid,"closed",true);
	
	
		
	update_post_meta($pid,"shipping", trim($_POST['shipping']));	
	update_post_meta($pid,"time_increase",$_POST['time_increase']);	
	update_post_meta($pid,"price_increase",$_POST['price_increase']);	
		
	update_post_meta($pid,"ending",strtotime(trim($_POST['ending']), current_time('timestamp',0)));	
 
	
	if(empty($views)) update_post_meta($pid,"views",0);	
	
	
	if($_POST['featureds'] == '1') 
	update_post_meta($pid,"featured",'1');
	else
	update_post_meta($pid,"featured",'0');
    
     
	update_post_meta($pid,"featured_text",$_POST['featured_text']);
	
	
	if($_POST['closed'] == '1') 
		{
			
			update_post_meta($pid,"closed",'1');
		}
	else
	{
		//if($closed == "1") 	update_post_meta($pid,"ending",current_time('timestamp',0) + 30*24*3600);		
		update_post_meta($pid,"closed",'0');
		
	}
	
	//---------------------
	
	$shipped = get_post_meta($pid,'shipped',true);
	if(empty($shipped)) { update_post_meta($pid,'shipped',0);  }
	
	//---------------------
               
			if(isset($_POST['seats']))
			update_post_meta($pid, "seats", PennyTheme_clear_sums_of_cash($_POST['seats']));
            
            if(isset($_POST['seats_per_user']))
			update_post_meta($pid, "seats_per_user", PennyTheme_clear_sums_of_cash($_POST['seats_per_user']));
            
            if(isset($_POST['additional_seats']))
			update_post_meta($pid, "additional_seats", PennyTheme_clear_sums_of_cash($_POST['additional_seats']));
            
            if(isset($_POST['additional_seats_bids']))
			update_post_meta($pid, "additional_seats_bids", PennyTheme_clear_sums_of_cash($_POST['additional_seats_bids']));
            
            if(isset($_POST['custom_seat_price'])){
                update_post_meta($pid, "custom_seat_price", PennyTheme_clear_sums_of_cash($_POST['custom_seat_price']));
                if( $_POST['custom_seat_price'] == 0 ){
                    if( get_post_meta($pid, "starting_seats_filled", true) != 1 ){
                        update_post_meta($pid, "starting_seats_filled", 0);    
                    }    
                }    
            }
            
            if( $_POST['free_auction'] == 1 ){
                update_post_meta($pid, "free_auction", 1);
                update_post_meta($pid, "enable_seats", 0);    
            }else{
                update_post_meta($pid, "free_auction", 0);
            }
            
            if( $_POST['enable_seats'] == 1 ){
                update_post_meta($pid, "enable_seats", 1);
                update_post_meta($pid, "free_auction", 0);    
            }else{
                update_post_meta($pid, "enable_seats", 0);
            }
            
            if(isset($_POST['auction_item_stock'])){
                $auction_item_stock = $_POST['auction_item_stock']; 
                if( $_POST['auction_item_stock'] == '' ) $auction_item_stock = 0;
                update_post_meta($pid, "auction_item_stock", PennyTheme_clear_sums_of_cash($auction_item_stock));    
            }
                        
            //if(isset($_POST['auction_item_remaining_stock'])){
//                $auction_item_remaining_stock = $_POST['auction_item_remaining_stock']; 
//                if( $_POST['auction_item_remaining_stock'] == '' ) $auction_item_remaining_stock = 0;
//                update_post_meta($pid, "auction_item_remaining_stock", PennyTheme_clear_sums_of_cash($auction_item_remaining_stock));    
//            }
            
            //if(isset($_POST['is_buy_limit_per_seat']))
//			update_post_meta($pid, "is_buy_limit_per_seat", PennyTheme_clear_sums_of_cash($_POST['is_buy_limit_per_seat']));
            
            if(isset($_POST['add_time']))
			update_post_meta($pid, "add_time", PennyTheme_clear_sums_of_cash($_POST['add_time']));
            
            if(isset($_POST['add_hours']))
			update_post_meta($pid, "add_hours", PennyTheme_clear_sums_of_cash($_POST['add_hours']));
            
            if(isset($_POST['add_mins']))
			update_post_meta($pid, "add_mins", PennyTheme_clear_sums_of_cash($_POST['add_mins']));
            
            if(isset($_POST['timer_type']))
			update_post_meta($pid, "timer_type", PennyTheme_clear_sums_of_cash($_POST['timer_type']));
            
            if(isset($_POST['time_cost']))
			update_post_meta($pid, "time_cost", PennyTheme_clear_sums_of_cash($_POST['time_cost']));
            
            if(isset($_POST['time_limit_per_user']))
			update_post_meta($pid, "time_limit_per_user", PennyTheme_clear_sums_of_cash($_POST['time_limit_per_user']));
            
            if(isset($_POST['bid_per_user'])){
                $bid_per_user_val = $_POST['bid_per_user'];
                if( $bid_per_user_val == '' ){
                    $bid_per_user_val = 0;
                }
                update_post_meta($pid, "bid_per_user", PennyTheme_clear_sums_of_cash($bid_per_user_val));    
            }
            
			if(isset($_POST['start_price']))
			update_post_meta($pid, "start_price", PennyTheme_clear_sums_of_cash($_POST['start_price']));
            
			
			if(isset($_POST['buy_now']))
			update_post_meta($pid, "buy_now", PennyTheme_clear_sums_of_cash($_POST['buy_now']));
			
			if(isset($_POST['reserve']))
			update_post_meta($pid, "reserve", PennyTheme_clear_sums_of_cash($_POST['reserve']));
			
			if(isset($_POST['retail_price']))
			update_post_meta($pid, "retail_price", PennyTheme_clear_sums_of_cash($_POST['retail_price']));
			
			$ggcbd = get_post_meta($pid, "current_bid", true);
	
			if(empty($ggcbd)) 
			{
				update_post_meta($pid, "current_bid", $_POST['start_price']);
		  	}
	}
}

/*****************************************************************************
*
*	Function - pennyTheme -
*
*****************************************************************************/
function PennyTheme_clear_sums_of_cash($cash)
{
	$cash = str_replace(" ","",$cash);
	$cash = str_replace(",","",$cash);
	//$cash = str_replace(".","",$cash);
	
	return strip_tags($cash);
}
/*****************************************************************************
*
*	Function - pennyTheme -
*
*****************************************************************************/

function PennyTheme_create_post_type() {

  $icn = get_bloginfo('template_url')."/images/auctionicon.gif";
  register_post_type( 'auction',
    array(
      'labels' => array(
        'name' 			=> __('Auctions',		'PennyTheme' ),
        'singular_name' => __('Auction',		'PennyTheme' ),
		'add_new' 		=> __('Add New Auction','PennyTheme'),
		'new_item' 		=> __('New Auction',	'PennyTheme'),
		'edit_item'		=> __('Edit Auction',	'PennyTheme'),
		'add_new_item' 	=> __('Add New Auction','PennyTheme'),
		'search_items' 	=> __('Search Auctions','PennyTheme'),
		
		
      ),
      'public' 				=> true,
	  'menu_position'		 => 5,
	  'register_meta_box_cb' => 'PennyTheme_set_metaboxes',
	  'has_archive' => "auction-list",
      'rewrite' => true, // array('slug'=>"auctions/%auction_cat%",'with_front'=>true),
	   'supports' => array('title','editor','author','thumbnail','excerpt','comments'),
	  '_builtin' 			=> false,
	  'menu_icon' 			=> $icn,
	  'publicly_queryable' 	=> true,
	  'hierarchical' 		=> false 

    )
  );

	register_taxonomy( 'auction_cat', 'auction', array( 'hierarchical' => true, 'label' => __('Auction Categories','PennyTheme'),
	'rewrite'                       => true ));
	add_post_type_support( 'auction', 'author' );
	//add_post_type_support( 'auction', 'custom-fields' );
	register_taxonomy_for_object_type('post_tag', 'auction');	
	flush_rewrite_rules();

}

/*****************************************************************************
*
*	Function - pennyTheme -
*
*****************************************************************************/
function PennyTheme_get_users_links()
{
	
	ob_start();
	
?>
	
    	<div id="right-sidebar">
			<ul class="xoxo">
			
			<li class="widget-container widget_text"><h3 class="widget-title"><?php _e("My Account Menu",'PennyTheme'); ?></h3>
			<p>
			
            <ul id="my-account-admin-menu">
                    
                    <?php
                        $show_defaults_menu = false;
                        if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ 'primary-penny-my-account' ] ) ) {
                        	$menu = wp_get_nav_menu_object( $locations[ 'primary-penny-my-account' ] );
                        	$menu_items = wp_get_nav_menu_items($menu->term_id);
                            if( $menu_items[0]->ID > 0 ){   
                                foreach( $menu_items as $value ){
                                    if( ! get_option( 'show_seats_based_auctions' ) ){
                                        if( get_option('PennyTheme_my_account_latest_seats_page_id') == $value->object_id ){
                                            continue;  
                                        }
                                    }
                                    if( ! get_option( 'show_bid_based_auctions' ) ){
                                        if( ( get_option('PennyTheme_my_account_my_bid_balance_page_id') == $value->object_id ) || ( get_option('PennyTheme_my_account_payments_page_id') == $value->object_id ) ){
                                            continue;  
                                        }
                                    }
                                    if( ! get_option( 'show_bid_based_auctions' ) && ! get_option( 'show_seats_based_auctions' ) ){
                                        if( get_option('PennyTheme_available_credits_id') == $value->object_id ){
                                            continue;  
                                        }
                                    }
                                    echo '<li><a href="' . $value->url . '">' . $value->title . '</a></li>';
                                }
                            }else{
                                $show_defaults_menu = true;
                            }
                        }else{
                            $show_defaults_menu = true;
                        }
                        
                        if( $show_defaults_menu ){ ?>    
                            <li><a href="<?php echo PennyTheme_my_account_link(); ?>"><?php _e("My Account Home",'PennyTheme');?></a></li>
                            
                            <?php if( get_option( 'show_bid_based_auctions' ) || get_option( 'show_seats_based_auctions' ) ){ ?>
                                <li><a href="<?php echo get_permalink(get_option('PennyTheme_available_credits_id')); ?>"><?php _e("My Wallet",'PennyTheme');?></a></li>
                            <?php } ?>
                            
                            <?php if( get_option( 'show_bid_based_auctions' ) ){ ?>
                                <li><a href="<?php echo get_permalink(get_option('PennyTheme_my_account_my_bid_balance_page_id')) ?>"><?php _e("My Bids Balance",'PennyTheme');?></a></li>
                                <li><a href="<?php echo get_permalink(get_option('PennyTheme_my_account_payments_page_id')) ?>"><?php _e("Purchase Bids",'PennyTheme');?></a></li>
                            <?php } ?>
                            <li><a href="<?php echo get_permalink(get_option('PennyTheme_my_account_personal_info_page_id')) ?>"><?php _e("Personal Info",'PennyTheme');?></a></li>
                            <li><a href="<?php echo get_permalink(get_option('PennyTheme_my_account_latest_bids_page_id')) ?>"><?php _e("My Active Bidding",'PennyTheme');?></a></li>
                            <?php if( get_option( 'show_seats_based_auctions' ) ){ ?>
                                <li><a href="<?php echo get_permalink(get_option('PennyTheme_my_account_latest_seats_page_id')) ?>"><?php _e("My Seats",'PennyTheme');?></a></li>
                            <?php } ?>
                            <li><a href="<?php echo get_permalink(get_option('PennyTheme_my_account_won_auctions_page_id')) ?>"><?php _e("My Won Items",'PennyTheme');?></a></li>
                            <li><a href="<?php echo get_permalink(get_option('PennyTheme_my_account_unpaid_auctions_page_id')) ?>"><?php _e("My Unpaid Items",'PennyTheme');?></a></li>
                            <li><a href="<?php echo get_permalink(get_option('PennyTheme_my_account_paid_and_not_shipped_page_id')) ?>"><?php _e("Paid and Not Shipped",'PennyTheme');?></a></li>
                            <li><a href="<?php echo get_permalink(get_option('PennyTheme_my_account_paid_and_shipped_page_id')) ?>"><?php _e("Paid & Shipped",'PennyTheme');?></a></li>
                            <li><a href="<?php echo get_permalink(get_option('PennyTheme_my_account_my_expired_auctions_page_id')) ?>"><?php _e("My Expired Auctions",'PennyTheme');?></a></li>
                    
                    <?php } ?>
            </ul>
            
            </p>
			</li>
            
            <!-- ###### -->
			
        
			</ul>
		</div>
		
  
<?php
	
	$output = ob_get_contents();
	ob_end_clean();
	return $output;

}
/*****************************************************************************
*
*	Function - pennyTheme -
*
*****************************************************************************/


function PennyTheme_insert_pages($page_ids, $page_title, $page_tag, $parent_pg = 0 )
{
	
		$opt = get_option($page_ids);			
		if(!PennyTheme_check_if_page_existed($opt))
		{
			
			$post = array(
			'post_title' 	=> $page_title, 
			'post_content' 	=> $page_tag, 
			'post_status' 	=> 'publish', 
			'post_type' 	=> 'page',
			'post_author' 	=> 1,
			'ping_status' 	=> 'closed', 
			'post_parent' 	=> $parent_pg);
			
			$post_id = wp_insert_post($post);
				
			update_post_meta($post_id, '_wp_page_template', 'penny-special-page-template.php');
			update_option($page_ids, $post_id);
		
		}
				
	
}
/*****************************************************************************
*
*	Function - pennyTheme -
*
*****************************************************************************/
function PennyTheme_check_if_page_existed($pid)
{
	global $wpdb;
	$s = "select * from ".$wpdb->prefix."posts where post_type='page' AND post_status='publish' AND ID='$pid'";
	$r = $wpdb->get_results($s);
	
	if(count($r) > 0) return true;
	return false;	
	
}
/*****************************************************************************
*
*	Function - pennyTheme -
*
*****************************************************************************/

function PennyTheme_is_home()
{
	global $current_user, $wp_query;
	$a_action 	=  $wp_query->query_vars['a_action'];	
	
	if(!empty($a_action)) return false;
	if(is_home()) return true;
	return false;
	
}
/*****************************************************************************
*
*	Function - pennyTheme -
*
*****************************************************************************/	
function PennyTheme_watch_list()
{
	return get_permalink(get_option('PennyTheme_watch_list_id'));
}
/*****************************************************************************
*
*	Function - pennyTheme -
*
*****************************************************************************/
function PennyTheme_post_new_link()
{
	
}
/*****************************************************************************
*
*	Function - pennyTheme -
*
*****************************************************************************/
function PennyTheme_curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}


function PennyTheme_get_post( $arr = '')
{
			$highest_bid = PennyTheme_get_show_price(get_post_meta(get_the_ID(), 'current_bid', true));
			
			$ending = get_post_meta(get_the_ID(), 'ending', true);
			$sec 	= $ending - current_time('timestamp',0);	
			$closed = get_post_meta(get_the_ID(), 'closed', true);
			$post 	= get_post(get_the_ID());
		
			$now 	= current_time('timestamp',0);
			
			global $current_user;
			get_currentuserinfo();
			$uid = $current_user->ID;
			
			$rnd = rand(1,999);
			$retail_price 	= PennyTheme_get_show_price(get_post_meta(get_the_ID(), 'retail_price', true),2);
			$time_increase 	= get_post_meta(get_the_ID(), 'time_increase', true);
			$rem = $ending - $now;
					
?>
                <style>
                    .ribbon {
                      background: none repeat scroll 0 0 #d93131;
                      border: 2px solid black;
                      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2), 0 5px 30px rgba(255, 255, 255, 0.2) inset;
                      display: inline-block;
                      left: -36px;
                      padding: 3px 10px;
                      position: absolute;
                      text-align: center;
                      text-transform: uppercase;
                      top: 17px;
                      -webkit-transform: rotate(-48deg);
            		  -moz-transform: rotate(-48deg);
            		  -o-transform: rotate(-48deg);
            		  -ms-transform: rotate(-48deg);
                      width: 100px;
                      font-weight: bold;
                    }
                </style>
				<div style="position: relative;overflow: hidden;" class="post_hm box_post" id="post-<?php the_ID(); ?>">
                <?php if( get_post_meta( get_the_ID(), 'featured', true ) == 1 ){ ?>
                    <span class="ribbon"><?php echo get_post_meta( get_the_ID(), 'featured_text', true ) != '' ? get_post_meta( get_the_ID(), 'featured_text', true ) : 'V.I.P'; ?></span>
                <?php } ?>
                <input type="hidden" class="my-total-ids-no-delete" value="<?php the_ID(); ?>_<?php echo $rnd; ?>" />
                <div class="padd10">
                <div class="image_holder1">
                <?php
                    $bid_link = get_permalink();
                    if( get_option('PennyTheme_auction_show_signin') == 1 ){
                        if( !is_user_logged_in() ){
                            $bid_link = wp_login_url( $bid_link );    
                        }    
                    }
                ?>
                <a href="<?php echo $bid_link; ?>"><img width="133" height="95" class="image_class" 
                src="<?php echo PennyTheme_get_first_post_image(get_the_ID(),133,95); ?>" /></a>
                </div>
                <div  class="title_holder1" > 
                     <h2><a href="<?php echo $bid_link; ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
                        <?php   the_title(); 
                        
                        
                        ?></a></h2>
     
     					<!-- ## end-title ## -->
                        
                        <div class="my-bid-live-detail">
                        	<div class="my-current-bidder-live">
                            
                            <ul class="auction-details1">
					
                           
                           <li><span id="highest_bidder_<?php the_ID(); ?>_<?php echo $rnd; ?>"></span></li>
                           <?php 
                                $show_timer = true;
                                if( is_auction_seats_enabled( get_the_ID() ) == 1 ){
                                    if( get_auction_remaining_seats( get_the_ID() ) > 0 ){
                                        $show_timer = false;
                                    }
                                } 
                           ?>
                           <?php if( $show_timer ){ ?> 
                                <li><div class="my-time-live_2" id="my-auction-time_<?php the_ID(); ?>_<?php echo $rnd; ?>"><?php echo $rem; ?></div></li>
                           <?php } ?>
                           <li><span class="my-current-price-live-content" id="my-current-price_<?php the_ID(); ?>_<?php echo $rnd; ?>"><?php echo $highest_bid; ?></span></li>
                           <li class="my_bid_btn"><a href="<?php echo $bid_link; ?>" class="mm_bid_mmp bid_now_v_small" rel="<?php the_ID(); ?>"><?php _e('Bid Now','PennyTheme'); ?></a></li>
                           
                           	
                            </ul>
                            
                            
                            </div>                        
                        </div>
                        
                        
                        
     		
                        
                        
                        
                     </div>
                     </div></div>
                     
                     <?php

}


function PennyTheme_blog_link()
{
	
	
}

function PennyTheme_get_post_images($pid, $limit = -1)
{
	
		//---------------------
		// build the exclude list
		$exclude = array();
		
		$args = array(
		'order'          => 'ASC',
		'post_type'      => 'attachment',
		'post_parent'    => get_the_ID(),
		'meta_key'		 => 'another_reserved1',
		'meta_value'	 => '1',
		'numberposts'    => -1,
		'post_status'    => null,
		);
		$attachments = get_posts($args);
		if ($attachments) {
			foreach ($attachments as $attachment) {
			$url = $attachment->ID;
			array_push($exclude, $url);
		}
		}
		
		//-----------------
	
	
		$arr = array();
		
		$args = array(
		'order'          => 'ASC',
		'orderby'        => 'post_date',
		'post_type'      => 'attachment',
		'post_parent'    => $pid,
		'exclude'    		=> $exclude,
		'post_mime_type' => 'image',
		'numberposts'    => $limit,
		); $i = 0;
		
		$attachments = get_posts($args); 
		if ($attachments) {
		
			foreach ($attachments as $attachment) {
						
				$url = wp_get_attachment_url($attachment->ID);
				array_push($arr, $url);
			  
		}
			return $arr;
		}
		return false;
}

/*****************************************************************************
*
*	Function - pennyTheme -
*
*****************************************************************************/
function PennyTheme_my_account_link()
{
	return get_permalink(get_option('PennyTheme_my_account_page_id'));	
}
/*****************************************************************************
*
*	Function - pennyTheme -
*
*****************************************************************************/
function PennyTheme_advanced_search_link()
{
	return get_permalink(get_option('PennyTheme_adv_search_id'));	
}

function PennyTheme_sm_replace_me($s)
{
	return urlencode($s);
}

function PennyTheme_curPageURL_me() {
	 $pageURL = 'http';
	 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	 $pageURL .= "://";
	 if ($_SERVER["SERVER_PORT"] != "80") {
	  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	 } else {
	  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	 }
	 return $pageURL;
}

function PennyTheme_check_if_pid_is_in_watchlist($pid, $uid)
	{
		global $wpdb;
		$s = "select * from ".$wpdb->prefix."penny_watchlist where pid='$pid' AND uid='$uid'";	
		$r = $wpdb->get_results($s);
		
		if(count($r) == 0) return false;		
		return true;
	}
	
	function PennyTheme_add_pid_in_watchlist($pid, $uid)
	{
		global $wpdb;
		$s = "insert into ".$wpdb->prefix."penny_watchlist (pid,uid) values('$pid','$uid')";	
		$wpdb->query($s);
		
	}
	
	function PennyTheme_delete_pid_in_watchlist($pid, $uid)
	{
		global $wpdb;
		$s = "delete from ".$wpdb->prefix."penny_watchlist where pid='$pid' AND uid='$uid'";	
		$wpdb->query($s);
		
	}


	add_action('wp_ajax_remove_from_watchlist', 		'PennyTheme_remove_from_watchlist');
	add_action('wp_ajax_nopriv_remove_from_watchlist', 	'PennyTheme_remove_from_watchlist');
	
	add_action('wp_ajax_add_to_watchlist', 				'PennyTheme_add_to_watchlist');
	add_action('wp_ajax_nopriv_add_to_watchlist', 		'PennyTheme_add_to_watchlist');
	
	function PennyTheme_remove_from_watchlist()
	{
		$pid = $_POST['pid'];
		
		if(is_user_logged_in()):
		
			global $current_user;
			get_currentuserinfo();
			$uid = $current_user->ID;
			
			PennyTheme_delete_pid_in_watchlist($pid, $uid);
			
			echo "removed-".$uid."-".$pid."-";
		
		else:
		
			echo "NO_LOGGED";	
		
		endif;	
		
	}
	
 	function PennyTheme_add_to_watchlist()
	{
		$pid = $_POST['pid'];
		
		if(is_user_logged_in()):
		
			global $current_user;
			get_currentuserinfo();
			$uid = $current_user->ID;
			
			if(PennyTheme_check_if_pid_is_in_watchlist($pid, $uid) == false)
				PennyTheme_add_pid_in_watchlist($pid, $uid);
			
			echo "added-".$uid."-".$pid."-";
			
		else:
		
			echo "NO_LOGGED";	
		
		endif;
	}

function pennyTheme_template_redirect()
{
	
 	global $wp;
	global $wp_query, $wp_rewrite, $post;
	$a_action 	=  $wp_query->query_vars['a_action'];
	
	$my_pid = $post->ID;
	$PennyTheme_my_account_page_id = get_option('PennyTheme_my_account_page_id');
	$PennyTheme_watch_list_id	   = get_option('PennyTheme_watch_list_id');
	
	 
	
	if($post->post_parent == $PennyTheme_my_account_page_id or $my_pid == $PennyTheme_my_account_page_id or $PennyTheme_watch_list_id == $my_pid)
	{
		if(!is_user_logged_in())
		{
			wp_redirect(get_bloginfo('url') . "/wp-login.php?redirect_to=" . PennyTheme_sm_replace_me(PennyTheme_curPageURL_me()));
			exit;	
		}
			
	}
	
	if($a_action == "buy_now")
	{
		include 'lib/buy_now.php';
		exit;	
	}
	
	
	if($a_action == "purchase_bid"){
		include 'lib/gateways/purchase_bid_paypal.php';
		exit;	
	}
    
    if($a_action == "purchase_seats"){
		include 'lib/gateways/purchase_seats_paypal.php';
		exit;	
	}
	
	if($a_action == "pay_for_auction")
	{
		include 'lib/gateways/pay_paypal_auction.php';
		exit;	
	}
	
	if(isset($_GET['cronjob']))
	{
		
		global $wpdb;
		$closed = array(
			'key' => 'closed',
			'value' => "0",
			'compare' => '='
		);
		
		
		$ending = array(
			'key' => 'ending',
			'value' => current_time('timestamp',0),
			'type' => 'numeric',
			'compare' => '>'
		);
		
		//echo "from cron   ";
	$args2 = array( 'posts_per_page' =>'-1', 'post_type' => 'auction', 'post_status' => 'publish', 'meta_query' => array($closed, $ending));
	$the_query = new WP_Query( $args2 );
	
	 
	
		if($the_query->have_posts()):
		while ( $the_query->have_posts() ) : $the_query->the_post();
			
				$pid = get_the_ID();
				PennyTheme_set_after_set_credits_to_use($pid);
				//mail("andreisaioc@gmail.com","ppp","asdasd_".$pid);
		
		endwhile;
		endif;
		
		die();	
	}
	
}

function PennyTheme_using_permalinks()
{
	global $wp_rewrite;
	if($wp_rewrite->using_permalinks()) return true; 
	else return false; 	
}

function PennyTheme_adv_search_featured_ac()
{
	
}

function PennyTheme_set_after_set_credits_to_use($pid)
{
	global $wpdb;
	$my_sql = "select id,pid,uid,credits_current from ".$wpdb->prefix."penny_assistant where pause='0' AND credits_current>0 AND pid='$pid' order by credits_current asc limit 2";
	$my_row = $wpdb->get_results($my_sql);	
	$ctm 		= current_time('timestamp', 0);
	
	
	
	if(count($my_row) > 1)
	{
		
		$lowest_limit = $my_row[0]->credits_current;
		
		$my_sql = "select id,pid,uid,credits_current from ".$wpdb->prefix."penny_assistant where pause='0' AND credits_current>0 AND pid='$pid' order by credits_current asc";
		$my_row = $wpdb->get_results($my_sql);	
		
		for($i=0;$i<=$lowest_limit;$i++)
		{
			foreach($my_row as $row)
			{
				
				$old_ending = get_post_meta($pid, 'ending', 		true);
				if($old_ending > $ctm):
			
					$price_increase = get_post_meta($pid, 'price_increase', true);
					$retail_price 	= get_post_meta($pid, 'retail_price', 	true);
					$time_increase 	= get_post_meta($pid, 'time_increase', 	true);
					$ending		 	= $old_ending + $time_increase;
					$tm 			= current_time('timestamp', 0);
					$bid			= PennyTheme_get_highest_bid($pid) +  $price_increase;	
					$old_diff 		= $old_ending - $ctm;
						
						//if($old_diff <= 50)
					$uid = $row->uid;
					$user_credits = get_user_meta($uid, 'user_credits', true);
					
					if($user_credits > 0)
					{
						
						update_user_meta($row->uid, 'user_credits', 	$user_credits - 1);						
						add_post_meta($pid, 'bidded_auction', 	$uid , 	true);							
						
						$query = "insert into ".$wpdb->prefix."penny_bids (pid,uid,date_made,bid) values('$pid','$uid','$ctm','$bid')";
						$wpdb->query($query);
						
						update_post_meta($pid, 'ending', 		$ending);						
						update_post_meta($pid, 'current_bid', 	$bid);
					
					}
					
				endif;	
				
								
			}
				
			
		
		foreach($my_row as $row)
		{
			$new_credits_current 	= $row->credits_current - $lowest_limit;
			$assid 					= $row->id;
			
			$wpdb->query("update ".$wpdb->prefix."penny_assistant set credits_current='$new_credits_current' where id='$assid' ");					
		}
		
		}
	}
	
	elseif(count($my_row) == 1)
	{
				
				$row = $my_row[0];
				$old_ending = get_post_meta($pid, 'ending', 		true);
				if($old_ending > $ctm):
			
					$price_increase = get_post_meta($pid, 'price_increase', true);
					$retail_price 	= get_post_meta($pid, 'retail_price', 	true);
					$time_increase 	= get_post_meta($pid, 'time_increase', 	true);
					$ending		 	= $old_ending + $time_increase;
					$tm 			= current_time('timestamp', 0);					
					$latest_bid 	= PennyTheme_get_highest_bid_owner_obj($pid);
					
					$bid			= $latest_bid->bid +  $price_increase;	
					$old_diff 		= $old_ending - $ctm;
						
						//if($old_diff <= 50)
					
						
					$uid = $row->uid;
					
					
					$user_credits = get_user_meta($uid, 'user_credits', true);
					
					if($user_credits > 0 && $latest_bid->uid != $row->uid)
					{
						
						update_post_meta($pid, 'ending', 		$ending);
						update_post_meta($pid, 'current_bid', 	$bid);
						
						update_user_meta($row->uid, 'user_credits', 	$user_credits - 1);						
						add_post_meta($pid, 'bidded_auction', 	$uid , 	true);						
						
						$query = "insert into ".$wpdb->prefix."penny_bids (pid,uid,date_made,bid) values('$pid','$uid','$ctm','$bid')";
						$wpdb->query($query);
						
						$assid 					= $row->id;
						$new_credits_current 	= $row->credits_current - 1;
						$wpdb->query("update ".$wpdb->prefix."penny_assistant set credits_current='$new_credits_current' where id='$assid' ");
					}
					
				endif;	
		
	}
	
	
}

add_action('admin_notices', 						'pennyTheme_admin_notices');

	function pennyTheme_admin_notices(){
    	
		$opt = get_option('PennyTheme_set_cronjob_me_as');
		if($opt != "yes")
		{
			
		echo '<div class="updated">
		   <p>For the <strong>Penny Theme</strong> you will need to setup a cronjob for this url: <b>'.get_bloginfo('url').'/?crons=yes</b> .</p>
		</div>';
			
		}
		
		
		//if(!function_exists('wp_pagenavi')) {
//		echo '<div class="updated">
//		   <p>For the <strong>Penny Theme</strong> you need to install the wp pagenavi plugin. 
//		   Install it from <a href="http:wordpress.org/extend/plugins/wp-pagenavi"><strong>here</strong></a>.</p>
//		</div>';
//								}
								
	//if(!function_exists('bcn_display')) {
//		echo '<div class="updated">
//		   <p>For the <strong>Penny Theme</strong> you need to install the Breadcrumb NavXT plugin. 
//		   Install it from <a href="http:wordpress.org/extend/plugins/breadcrumb-navxt/"><strong>here</strong></a>.</p>
//		</div>';
//								}	
	}
	
	
function PennyTheme_free_auction_cronjob_thing()
{	
	global $wpdb;
	$my_sql = "select id,pid,uid,credits_current from ".$wpdb->prefix."free_auction_bid_assistant where pause='0'";
	$my_row = $wpdb->get_results($my_sql);
	
	foreach($my_row as $row):
		
		$assid = $row->id;
		$pid = $row->pid;
		$uid = $row->uid;
        
        $price_increase = get_post_meta( $pid, 'price_increase', true );
        
		$credits_current = $row->credits_current - $price_increase;
		
		$user_credits = get_user_meta($uid, $pid.'free_auction_user_credits', true);
		
		$hbd = PennyTheme_get_highest_bid_owner($pid);
		
		if($hbd != $uid):		
			if($user_credits > 0 && $user_credits >= $price_increase){
				
				$ctm 		= current_time('timestamp', 0);
				$old_ending = get_post_meta($pid, 'ending', 		true);
				if($old_ending > $ctm):
			
					$price_increase = get_post_meta($pid, 'price_increase', true);
					$retail_price 	= get_post_meta($pid, 'retail_price', 	true);
					$time_increase 	= get_post_meta($pid, 'time_increase', 	true);
					$ending		 	= $old_ending + $time_increase;
					$tm 			= current_time('timestamp', 0);
					$bid			= PennyTheme_get_highest_bid($pid) +  $price_increase;	
					$old_diff = $old_ending - $ctm;
					
					//if($old_diff <= 50)
					update_post_meta($pid, 'ending', 		$ending);
					
		
					update_post_meta($pid, 'current_bid', 	$bid);
                    update_user_meta($uid, $pid.'free_auction_user_credits', $user_credits - $price_increase);    
					
					add_post_meta($pid, 'bidded_auction', 	$uid , 	true);
					
					$query = "insert into ".$wpdb->prefix."penny_bids (pid,uid,date_made,bid) values('$pid','$uid','$ctm','$bid')";
					$wpdb->query($query);
					
					$wpdb->query("update ".$wpdb->prefix."free_auction_bid_assistant set credits_current='$credits_current' where id='$assid' ");
					echo $uid." ".$pid." ".$bid.'<br/>';
				
				endif;
			}else{
			     $wpdb->query("update ".$wpdb->prefix."free_auction_bid_assistant set credits_current='0' where id='$assid' AND uid = '$uid' ");
			     send_auction_free_credit_empty_email($pid);
			}
		endif;
	endforeach;
	
}

function PennyTheme_second_cronjob_thing()
{	
	global $wpdb;
	$my_sql = "select id,pid,uid,credits_current from ".$wpdb->prefix."penny_assistant where pause='0' AND credits_current>0";
	$my_row = $wpdb->get_results($my_sql);
	
	foreach($my_row as $row):
		
		$assid = $row->id;
		$pid = $row->pid;
		$uid = $row->uid;
		$credits_current = $row->credits_current - 1;
		
		$user_credits = get_user_meta($uid, 'user_credits', true);
		
		$hbd = PennyTheme_get_highest_bid_owner($pid);
		
		if($hbd != $uid):		
			if($user_credits > 0):
				
				$ctm 		= current_time('timestamp', 0);
				$old_ending = get_post_meta($pid, 'ending', 		true);
				if($old_ending > $ctm):
			
					$price_increase = get_post_meta($pid, 'price_increase', true);
					$retail_price 	= get_post_meta($pid, 'retail_price', 	true);
					$time_increase 	= get_post_meta($pid, 'time_increase', 	true);
					$ending		 	= $old_ending + $time_increase;
					$tm 			= current_time('timestamp', 0);
					$bid			= PennyTheme_get_highest_bid($pid) +  $price_increase;	
					$old_diff = $old_ending - $ctm;
					
					//if($old_diff <= 50)
					update_post_meta($pid, 'ending', 		$ending);
					
		
					update_post_meta($pid, 'current_bid', 	$bid);
                    if( is_auction_seats_enabled($pid) == 0 ){
                        update_user_meta($uid, 'user_credits', 	$user_credits - 1);    
                    }
					
					add_post_meta($pid, 'bidded_auction', 	$uid , 	true);
					
					
					$query = "insert into ".$wpdb->prefix."penny_bids (pid,uid,date_made,bid) values('$pid','$uid','$ctm','$bid')";
					$wpdb->query($query);
					
					$wpdb->query("update ".$wpdb->prefix."penny_assistant set credits_current='$credits_current' where id='$assid' ");
					echo $uid." ".$pid." ".$bid.'<br/>';
				
				endif;
			endif;
		endif;
	endforeach;
	
}

function PennyTheme__curl_get_data($url) {
  $ch = curl_init();
  $timeout = 5;
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
  $data = curl_exec($ch);
  curl_close($ch);
  return $data;
}

if(isset($_GET['crons']))
{
 
	  // Cron settings
	  $cron_url= get_bloginfo("url") . "/?cronjob=1"; // Cron URL here.
	  $time_interval=2; // Time interval needed (second).
	  $real_time_interval=1; // Real time interval (minute).

	  set_time_limit(0);
	  ignore_user_abort(1);
	  
	  $number_of_execution=floor($real_time_interval*60/$time_interval);
	  for($i=0; $i<$number_of_execution; $i++) {
		$time=microtime(1);
		PennyTheme__curl_get_data($cron_url);
		$time=microtime(1)-$time;
		$i<$number_of_execution and sleep($time_interval-$time);
	  }
?>
Done	 

<?php	
exit;

}

include 'ajax-stuff.php';

?>