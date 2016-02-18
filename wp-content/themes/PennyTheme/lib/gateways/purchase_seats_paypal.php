<?php
session_start();
include 'paypal.class.php';
    global $current_user;
    get_currentuserinfo();
	$uid = $current_user->ID;
    
	global $wpdb, $wp_rewrite, $wp_query;
    $bid_id = (int) $wp_query->query_vars['bid_id'];
    $seats  = (int) $_GET['seats'];
    $timer  = (int) $_GET['time'];
    
    $use_credit = (int) $_GET['cu'];
    
    if( $bid_id == 0 || $seats == 0 ){
        wp_redirect( get_bloginfo('siteurl') );
    }
    $total_seats     = get_post_meta( $bid_id, 'seats', true );
    $purchased_seats = get_total_purchased_auction_seats( $bid_id );
    $remaining_seats = $total_seats - $purchased_seats;
    
    if( $seats > $remaining_seats ){
        $seats = $remaining_seats;
    }
    if( $timer > get_auction_user_time_limit( $bid_id ) ){
        $timer = get_auction_user_time_limit( $bid_id );
    }
    
    $per_seat_price = get_per_seat_price( $bid_id );
    
    $total = $per_seat_price * $seats;
    
    if( $timer > 0 ){
        if( get_auction_timer_type( $bid_id ) == 'paid' ){
            $timer_cost = $timer * get_auction_time_cost( $bid_id );
            $total = $timer_cost + $total;    
        }
    }
    
    if( $use_credit == 1 ){
        $user_available_credits = get_user_available_credits( $uid );
        if( $total > $user_available_credits && $user_available_credits > 0 ){
            $wpdb->query( " UPDATE ".$wpdb->prefix."user_available_credits SET credit = 0 WHERE uid = '$uid' LIMIT 1 " );
            $total = $total - $user_available_credits;
        }
    }

//--------------------------------------------------------------------------------------

$action = $_GET['action'];


$p = new paypal_class;             // initiate an instance of the class
$p->paypal_url = 'https://www.paypal.com/cgi-bin/webscr';   // testing paypal url
//$p->paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';     // paypal url

$auctionTheme_enable_paypal_sandbox = get_option('PennyTheme_paypal_enable_sdbx');

if($auctionTheme_enable_paypal_sandbox == "yes") 
$p->paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';


global $wpdb;
$this_script = get_bloginfo('siteurl').'/?a_action=purchase_seats&bid_id='.$bid_id;

if(empty($action)) $action = 'process';   

	global $current_user;
	get_currentuserinfo();
	
	$uid = $current_user->ID;

switch ($action) {

    

   case 'process':      // Process and order...
	

//---------------------------------------------	
      //$p->add_field('business', 'sitemile@sitemile.com');
      $p->add_field('business', trim(get_option('PennyTheme_payPal_email')));	  
	  $p->add_field('currency_code', get_option('PennyTheme_currency'));
	  $p->add_field('return', $this_script.'&action=success');
      $p->add_field('cancel_return', $this_script.'&action=cancel');
      $p->add_field('notify_url', $this_script.'&action=ipn');
      $p->add_field('item_name',__('Auction Seats','PennyTheme'). ": ".$row->package_name);
	  $p->add_field('custom', $bid_id.'|'.$uid.'|'.current_time('timestamp',0).'|'.$seats.'|'.$timer.'|'.PennyTheme_formats_special($total,2) );
      $p->add_field('amount', PennyTheme_formats_special($total,2));

      $p->submit_paypal_post(); // submit the fields to paypal

      break;

   	case 'success':      // Order was successful...
        global $wpdb;
        
        $cust 					= $_POST['custom'];
		$cust 					= explode("|",$cust);
		
		$bid_id					= $cust[0];
		$uid					= $cust[1];
		$datemade 				= $cust[2];
        $seats  				= $cust[3];
        $timer  				= $cust[4];
        $cost    				= $cust[5];
            
        $sql = "select seats from ".$wpdb->prefix."auctions_seats where pid='$bid_id' and uid = '$uid'";
		$res = $wpdb->get_results($sql);
        if( count( $res ) > 0 ){
            //$row = $res[0];
            $wpdb->query( " UPDATE ".$wpdb->prefix."auctions_seats SET seats = ( seats + $seats ), total_cost = ( total_cost + $cost ) WHERE pid = '$bid_id' AND uid = '$uid' LIMIT 1 " );
        }else{
            $wpdb->query( " INSERT INTO ".$wpdb->prefix."auctions_seats SET seats = '$seats', pid = '$bid_id', uid = '$uid', total_cost = '$cost'" );                 
        }
        
        if( $timer > 0 ){
            set_user_auction_timer( $bid_id, $uid, $timer );
        }else{
            set_user_auction_timer( $bid_id, $uid, 0 );
        }
        
        $remaining_seats = get_auction_remaining_seats($bid_id);
                 
        if( is_auction_seats_enabled( $bid_id ) ){
            if( $remaining_seats == 0 ){
                $add_time  = get_post_meta($bid_id, 'add_time', true);
                $add_hours = get_post_meta($bid_id, 'add_hours', true);
                $add_mins  = get_post_meta($bid_id, 'add_mins', true);
                $new_ending = strtotime( $add_time.' days '.$add_hours.' hours '.$add_mins.' minutes', current_time('timestamp',0) );
                update_post_meta($bid_id, 'ending', $new_ending);
                update_post_meta($bid_id, 'ending_admin_update', 1);
            }    
        }
        
        $using_perm = PennyTheme_using_permalinks();
    	if($using_perm){
    	   $ss2 =  get_permalink($bid_id). "?success=1" ;
    	}else{
    	   $ss2 =  get_bloginfo('siteurl'). "/?page_id=".$bid_id. "&success=1" ;
    	} 
        
        send_auction_start_email($bid_id);
        send_auction_start_email_admin($bid_id);
        
        PennyTheme_send_email_when_seats_have_been_purchased( $uid, $bid_id, $seats );
        PennyTheme_send_email_when_seats_have_been_purchased_admin( $uid, $bid_id, $seats );
        
    	wp_redirect($ss2);
            
    break;
	case 'ipn':
	

	
	
  if(isset($_POST['custom'])){
  	
  			$cust 					= $_POST['custom'];
    		$cust 					= explode("|",$cust);
    		
    		$bid_id					= $cust[0];
    		$uid					= $cust[1];
    		$datemade 				= $cust[2];
            $seats  				= $cust[3];
            $timer  				= $cust[4];
            $cost    				= $cust[5];
  			
            $total_seats     = get_post_meta( $bid_id, 'seats', true );
            $purchased_seats = get_total_purchased_auction_seats( $bid_id );
            $remaining_seats = $total_seats - $purchased_seats;

 	}
 

   break;

   case 'cancel':       // Order was canceled...

	wp_redirect(get_permalink(get_option('PennyTheme_my_account_page_id')));

       break;
     



 }     

?>