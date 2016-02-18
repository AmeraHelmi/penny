<?php
session_start();
include 'paypal.class.php';

global $wp_query;
$pid = $wp_query->query_vars['pid'];

$action = $_GET['action'];


$p = new paypal_class;             // initiate an instance of the class
$p->paypal_url = 'https://www.paypal.com/cgi-bin/webscr';   // testing paypal url
//$p->paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';     // paypal url
$auctionTheme_enable_paypal_sandbox = get_option('PennyTheme_paypal_enable_sdbx');

if($auctionTheme_enable_paypal_sandbox == "yes") 
$p->paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';

global $wpdb;
$this_script = get_bloginfo('siteurl').'/?a_action=pay_for_auction&pid='.$pid;

$post = get_post($pid);
$paypal_email = get_option('PennyTheme_payPal_email');


if(empty($action)) $action = 'process';   

switch ($action) {
	
    

   case 'process':      // Process and order...
	
	global $current_user;
	get_currentuserinfo();
	$uid = $current_user->ID;
	
	  
//------------------------------------------------------
        if( is_user_buy_this_auction( $pid, $uid ) ){
            $total = get_post_meta( get_the_ID(), 'buy_now', true ) - get_user_auction_cost( $pid, $uid );
        }else{
            $total = get_post_meta($pid, 'current_bid', true);    
        } 

		$ttla = $post->post_title;		
		

				$shipping = get_post_meta($pid, 'shipping', true);
					if(is_numeric($shipping) && $shipping > 0 && !empty($shipping))
						$shipping = $shipping;
					else $shipping = 0;
		

      $p->add_field('business', $paypal_email);
	  
	  $p->add_field('currency_code', get_option('PennyTheme_currency'));
	  $p->add_field('return', $this_script.'&action=success');
      $p->add_field('cancel_return', $this_script.'&action=cancel');
      $p->add_field('notify_url', $this_script.'&action=ipn');
      $p->add_field('item_name', $ttla);
	  $p->add_field('custom', $pid.'|'.current_time('timestamp',0)."|".$uid);
      $p->add_field('amount', PennyTheme_formats_special($total + $shipping,2));

      $p->submit_paypal_post(); // submit the fields to paypal

      break;

   case 'success':      // Order was successful...
   case 'ipn':
	
	if(isset($_POST['custom'])){
		global $current_user;
		get_currentuserinfo();
		
		$uid = $current_user->ID;
		
		$cust 					= $_POST['custom'];
		$cust 					= explode("|",$cust);
		$pid					= $cust[0];
		$datemade 				= $cust[1];
		$uid	 				= $cust[2];
		update_post_meta($pid, 'winner_paid', "1");
	}
	
	global $wpdb;
	$s = "update ".$wpdb->prefix."penny_bids set paid='1' where ( pid = '$pid' OR buy_id = '$pid' ) AND winner='1'";
	$wpdb->query($s);
	$winner = PennyTheme_get_highest_bid_owner_obj($pid);	
	update_post_meta($pid, 'paid_on_'.$winner->id, $datemade);  
    wp_redirect(get_permalink(get_option('PennyTheme_my_account_won_auctions_page_id')));
    break;

   case 'cancel':       // Order was canceled...
       wp_redirect(get_permalink(get_option('PennyTheme_my_account_won_auctions_page_id'))); 
       break;
     
 }
?>