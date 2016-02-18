<?php
/***************************************************************************
*
*	PennyTheme - copyright (c) - sitemile.com
*
*	Coder: Andrei Dragos Saioc
*	Email: sitemile[at]sitemile.com | andreisaioc[at]gmail.com
*	More info about the theme here: http://sitemile.com/p/penny
*	since v1.2
*
***************************************************************************/

global $pagenow, $wpdb;
if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) 
{
	
    update_option( 'show_bid_based_auctions', 1 );
    update_option( 'show_seats_based_auctions', 1 );
    update_option( 'show_free_auctions', 1 );
    
    update_option( 'PennyTheme_show_tc', 1 );
    update_option( 'PennyTheme_show_pv', 1 );
    update_option( 'PennyTheme_show_sr', 1 );
    
    update_option( 'PennyTheme_show_tc_reqd', 1 );
    update_option( 'PennyTheme_show_pv_reqd', 1 );
    update_option( 'PennyTheme_show_sr_reqd', 1 );
        
    // slider
    
    
    $slider_data = array( 'post_title' => 'New Slider', 'post_name' => 'new-slider', 'post_status' => 'publish', 'post_type' => 'ml-slider', 'guid' => get_bloginfo('url').'/?post_type=ml-slider&#038;p=1' );
    $slider_id = wp_insert_post( $slider_data );

    $meta_value = 'a:35:{s:4:"type";s:4:"flex";s:6:"random";s:5:"false";s:8:"cssClass";s:0:"";s:8:"printCss";s:4:"true";s:7:"printJs";s:4:"true";s:5:"width";s:3:"700";s:6:"height";s:3:"300";s:3:"spw";i:7;s:3:"sph";i:5;s:5:"delay";s:4:"3000";s:6:"sDelay";i:30;s:7:"opacity";d:0.6999999999999999555910790149937383830547332763671875;s:10:"titleSpeed";i:500;s:6:"effect";s:4:"fade";s:10:"navigation";s:4:"true";s:5:"links";s:4:"true";s:10:"hoverPause";s:4:"true";s:5:"theme";s:7:"default";s:9:"direction";s:10:"horizontal";s:7:"reverse";s:5:"false";s:14:"animationSpeed";s:3:"600";s:8:"prevText";s:1:"<";s:8:"nextText";s:1:">";s:6:"slices";i:15;s:6:"center";s:4:"true";s:9:"smartCrop";s:4:"true";s:12:"carouselMode";s:5:"false";s:14:"carouselMargin";s:1:"5";s:6:"easing";s:6:"linear";s:8:"autoPlay";s:4:"true";s:11:"thumb_width";i:150;s:12:"thumb_height";i:100;s:9:"fullWidth";s:4:"true";s:10:"noConflict";s:4:"true";s:12:"smoothHeight";s:5:"false";}';        
    $wpdb->query( "INSERT INTO $wpdb->postmeta SET post_id = '$slider_id', meta_key = 'ml-slider_settings', meta_value = '$meta_value'" );
    
    PennyTheme_insert_pages('PennyTheme_home_slider_page_id', 	'Home Slider', "[metaslider id=$slider_id]" );
    
    //$upload_dir = wp_upload_dir();
//    $upload_subdir = $upload_dir['subdir'];
//    $upload_subdir_url = $upload_dir['url'];
//    
//    $filename2 = $upload_dir['path'].'/2.jpg';
//    
//    copy( get_template_directory() . '/slider/2.jpg', $filename2 );
//        
//    $slider_images_data2 = array( 'post_title' => '2', 'post_name' => '2', 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image/jpeg', 'guid' => $upload_subdir_url.'/2.jpg' );
//    $slider_images_id2   = wp_insert_post( $slider_images_data2 );
//    update_post_meta( $slider_images_id2, 'ml-slider_crop_position', 'center-center' );
//    update_post_meta( $slider_images_id2, 'ml-slider_type', 'image' );
//    update_post_meta( $slider_images_id2, '_wp_attached_file', ltrim($upload_subdir,'/').'/2.jpg' );
//    $meta_value_slider2 = 'a:5:{s:5:"width";i:700;s:6:"height";i:300;s:4:"file";s:13:"2015/02/2.jpg";s:5:"sizes";a:5:{s:9:"thumbnail";a:4:{s:4:"file";s:13:"2-150x150.jpg";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:10:"image/jpeg";}s:6:"medium";a:4:{s:4:"file";s:13:"2-300x128.jpg";s:5:"width";i:300;s:6:"height";i:128;s:9:"mime-type";s:10:"image/jpeg";}s:14:"shop_thumbnail";a:4:{s:4:"file";s:12:"2-120x51.jpg";s:5:"width";i:120;s:6:"height";i:51;s:9:"mime-type";s:10:"image/jpeg";}s:12:"shop_catalog";a:4:{s:4:"file";s:13:"2-500x214.jpg";s:5:"width";i:500;s:6:"height";i:214;s:9:"mime-type";s:10:"image/jpeg";}s:11:"shop_single";a:4:{s:4:"file";s:13:"2-500x214.jpg";s:5:"width";i:500;s:6:"height";i:214;s:9:"mime-type";s:10:"image/jpeg";}}s:10:"image_meta";a:10:{s:8:"aperture";i:0;s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";i:0;s:9:"copyright";s:0:"";s:12:"focal_length";i:0;s:3:"iso";i:0;s:13:"shutter_speed";i:0;s:5:"title";s:0:"";}}';
//    $wpdb->query( "INSERT INTO $wpdb->postmeta SET post_id = '$slider_images_id2', meta_key = '_wp_attachment_metadata', meta_value = '$meta_value_slider2'" );
    
    
    // slider end
    	
	update_option('PennyTheme_right_side_footer', 'Car for Pennies');
	update_option('PennyTheme_left_side_footer', 'Copyright (c) '.get_bloginfo('name'));	
	
	update_option('PennyTheme_email_name_from', 				get_bloginfo('name'));
	update_option('PennyTheme_email_addr_from', 				get_bloginfo('admin_email'));
	
	
    
    
	PennyTheme_insert_pages('PennyTheme_all_cats_id', 						'Show All Categories', 		'[penny_theme_show_all_categories]' );
	PennyTheme_insert_pages('PennyTheme_watch_list_id', 					'Watch List', 				'[penny_theme_watch_list]' );
	PennyTheme_insert_pages('PennyTheme_adv_search_id', 					'Available Auctions', 				'[penny_theme_adv_search]' );
	
	PennyTheme_insert_pages('PennyTheme_my_account_page_id', 				'My Account', 				'[penny_theme_my_account]' );
	PennyTheme_insert_pages('PennyTheme_my_account_personal_info_page_id', 	'Personal Information', 	'[penny_theme_my_account_personal_info]', 	get_option('PennyTheme_my_account_page_id') );
	PennyTheme_insert_pages('PennyTheme_my_account_payments_page_id', 		'Payments', 				'[penny_theme_my_account_payments]', 		get_option('PennyTheme_my_account_page_id') );
    PennyTheme_insert_pages('PennyTheme_my_account_my_bid_balance_page_id', 'My Bids Balance', 		'[penny_theme_my_account_my_bid_balance]', 		get_option('PennyTheme_my_account_page_id') );	
	PennyTheme_insert_pages('PennyTheme_my_account_purchase_bid_page_id', 	'Purchase Bids', 		    '[penny_theme_my_account_purchase_bids]', 	get_option('PennyTheme_my_account_page_id') );
    PennyTheme_insert_pages('PennyTheme_my_account_latest_seats_page_id', 	'My Seats', 		        '[penny_theme_my_account_seats]', 	        get_option('PennyTheme_my_account_page_id') );
    
	PennyTheme_insert_pages('PennyTheme_available_credits_id', 						'My Wallet', 		'[PennyTheme_my_available_credits_page_id]', get_option('PennyTheme_my_account_page_id') );
	PennyTheme_insert_pages('PennyTheme_my_account_latest_bids_page_id', 		'My Active Bidding', 				'[penny_theme_my_account_bids]', 		 get_option('PennyTheme_my_account_page_id') );	
	PennyTheme_insert_pages('PennyTheme_my_account_won_auctions_page_id', 		'Won Items', 			'[penny_theme_my_account_won_auctions]', get_option('PennyTheme_my_account_page_id') );	
	PennyTheme_insert_pages('PennyTheme_my_account_unpaid_auctions_page_id', 	'Unpaid Items', 		'[penny_theme_my_account_unpaid_items]', get_option('PennyTheme_my_account_page_id') );
	PennyTheme_insert_pages('PennyTheme_my_account_paid_and_not_shipped_page_id', 	'Paid and Not Shipped', 		'[penny_theme_my_account_paid_not_ship_items]', get_option('PennyTheme_my_account_page_id') );	
	PennyTheme_insert_pages('PennyTheme_my_account_paid_and_shipped_page_id', 	'Paid & Shipped', 		'[penny_theme_my_account_paid_ship_items]', get_option('PennyTheme_my_account_page_id') );    
    PennyTheme_insert_pages('PennyTheme_my_account_my_expired_auctions_page_id', 	'My Expired Auctions', 		'[penny_theme_my_account_my_expired_auctions]', get_option('PennyTheme_my_account_page_id') );
	PennyTheme_insert_pages('PennyTheme_closed_auctions_page_id', 	'Closed Auctions', 		'[penny_theme_closed_auctions]' );
    PennyTheme_insert_pages('PennyTheme_terms_conditions_page_id', 	'Terms and Conditions', 		'Terms and Conditions' );
    PennyTheme_insert_pages('PennyTheme_privacy_policy_page_id', 	'Privacy Policy', 		'Privacy Policy' );
    PennyTheme_insert_pages('PennyTheme_site_rules_page_id', 	'Site Rules', 		'Site Rules' );
    
    PennyTheme_insert_pages('PennyTheme_buy_seats_page_id', 	'Buy Seats', '[penny_theme_my_account_purchase_seats]' );
    
    PennyTheme_insert_pages('PennyTheme_about_us_page_id', 	'About Us', '' );		
    PennyTheme_insert_pages('PennyTheme_how_it_works_page_id', 	'How it works?', '' );
    PennyTheme_insert_pages('PennyTheme_contact_us_page_id', 	'Contact Us', '' );
    
	
	
	
	       $ss = "CREATE TABLE `".$wpdb->prefix."penny_assistant` (
			`id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
			`date_made` BIGINT NOT NULL ,
			`pid` BIGINT NOT NULL ,
			`uid` BIGINT NOT NULL ,
			`credits_start` BIGINT NOT NULL ,
			`credits_current` BIGINT NOT NULL ,
			`pause` TINYINT NOT NULL DEFAULT '0'
			) ENGINE = MYISAM ";
			
			$wpdb->query($ss);
            
            
            $ss = "CREATE TABLE `".$wpdb->prefix."user_available_credits` (
                    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
                    `uid` INT NOT NULL ,
                    `credit` FLOAT NOT NULL
                    )";
            $wpdb->query($ss);
            
            $ss = "CREATE TABLE `".$wpdb->prefix."credit_refund_history` (
                    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
                    `uid` INT NOT NULL ,
                    `credit` FLOAT NOT NULL ,
                    `date` timestamp NOT NULL default CURRENT_TIMESTAMP,
                    `method` varchar(10) NOT NULL,
                    `txn_id` VARCHAR( 100 ) NOT NULL
                    )";
            $wpdb->query($ss);

            
            $ss = "CREATE TABLE `".$wpdb->prefix."free_auction_bid_assistant` (
			`id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
			`date_made` BIGINT NOT NULL ,
			`pid` BIGINT NOT NULL ,
			`uid` BIGINT NOT NULL ,
			`credits_start` BIGINT NOT NULL ,
			`credits_current` BIGINT NOT NULL ,
			`pause` TINYINT NOT NULL DEFAULT '0',
            `email_sent` tinyint(1) NOT NULL DEFAULT '0',
			) ENGINE = MYISAM ";
			
			$wpdb->query($ss);
			
			//--------------------------------------------
			
			$ss = "CREATE TABLE `".$wpdb->prefix."penny_bids` (
			`id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
			`date_made` BIGINT NOT NULL ,
			`bid` DOUBLE NOT NULL ,
			`pid` BIGINT NOT NULL ,
			`uid` BIGINT NOT NULL ,
			`winner` TINYINT NOT NULL DEFAULT '0',
			`paid` TINYINT NOT NULL DEFAULT '0',
			`reserved1` VARCHAR( 255 ) NOT NULL ,
			`date_choosen` BIGINT NOT NULL,
            `shipped` tinyint(4) NOT NULL DEFAULT '0',
            `shipped_on` bigint(20) NOT NULL DEFAULT '0',
            `buy` tinyint(1) NOT NULL DEFAULT '0',
            `buy_id` int(11) NOT NULL DEFAULT '0'
			) ENGINE = MYISAM ";
			
			$wpdb->query($ss);
			
			//$ss = "ALTER TABLE `".$wpdb->prefix."penny_bids` ADD  `shipped` TINYINT NOT NULL DEFAULT '0';";
//			$wpdb->query($ss);
//			
//			$ss = "ALTER TABLE `".$wpdb->prefix."penny_bids` ADD  `shipped_on` BIGINT NOT NULL DEFAULT '0';";
//			$wpdb->query($ss);
			
			//-----------------------
			
            $ss = "CREATE TABLE `".$wpdb->prefix."penny_packages` (
			`id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
			`date_made` BIGINT NOT NULL ,
			`cost` DOUBLE NOT NULL ,
			`bids` BIGINT NOT NULL ,
			`showhide` TINYINT NOT NULL DEFAULT '0',
			`package_name` VARCHAR( 255 ) NOT NULL 			
			) ENGINE = MYISAM ";
			
			$wpdb->query($ss);
            
            // -----------------
            
			$ss = "CREATE TABLE `".$wpdb->prefix."user_auction_timer` (
                  `id` int(11) NOT NULL,
                  `uid` int(11) NOT NULL,
                  `pid` int(11) NOT NULL,
                  `timer` int(11) NOT NULL DEFAULT '0',
                  PRIMARY KEY (`id`)
                ) ENGINE = MYISAM ";
			
			$wpdb->query($ss);
            
            // -----------------
            
			$ss = "CREATE TABLE `".$wpdb->prefix."auctions_seats` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `pid` int(11) NOT NULL,
                  `uid` int(11) NOT NULL,
                  `seats` int(11) NOT NULL,
                  `total_cost` float NOT NULL DEFAULT '0',
                  PRIMARY KEY (`id`)
                ) ENGINE = MYISAM ";
			
			$wpdb->query($ss);
			
			
			
				//----------------
			
					 $ss = " CREATE TABLE `".$wpdb->prefix."penny_coupons` (
					`id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
					`coupon_name` VARCHAR( 255 ) NOT NULL ,
					`coupon_solid_reduction` VARCHAR( 255 ) NOT NULL,
					`coupon_percent_reduction` VARCHAR( 255 ) NOT NULL,
					
					`ending` VARCHAR( 255 ) NOT NULL,
					`coupon_code` VARCHAR( 255 ) NOT NULL ,
					`datemade` VARCHAR( 255 ) NOT NULL ,
					`featured_free` INT NOT NULL DEFAULT '0',
					`pause` INT NOT NULL DEFAULT '0'
					) ENGINE = MYISAM ";
			 $wpdb->query($ss);
			 
		//-------------------------------------------
		
		 $ss = " CREATE TABLE `".$wpdb->prefix."penny_payment_transactions` (
					`id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
					`uid` INT NOT NULL ,
					`reason` TEXT NOT NULL ,
					`datemade` INT NOT NULL ,
					`amount` DOUBLE NOT NULL ,
					`tp` TINYINT NOT NULL DEFAULT '1',
					`uid2` INT NOT NULL
					) ENGINE = MYISAM ";
		$wpdb->query($ss); 
	
		
			 
			 $ss = " CREATE TABLE `".$wpdb->prefix."penny_watchlist` (
					`id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
					`uid` BIGINT NOT NULL DEFAULT '0',
					`pid` BIGINT NOT NULL DEFAULT '0'
					) ENGINE = MYISAM ";
			 $wpdb->query($ss);
		
}

?>