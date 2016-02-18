<?php
session_start();
include 'paypal.class.php';

	global $wpdb, $wp_rewrite, $wp_query;
	$bid_id = $wp_query->query_vars['bid_id'];

	$sql = "select * from ".$wpdb->prefix."penny_packages where id='$bid_id'";
	$res = $wpdb->get_results($sql);
	
	$row = $res[0];


//--------------------------------------------------------------------------------------

$action = $_GET['action'];

$p = new paypal_class;             // initiate an instance of the class
$p->paypal_url = 'https://www.paypal.com/cgi-bin/webscr';   // testing paypal url
//$p->paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';     // paypal url

$auctionTheme_enable_paypal_sandbox = get_option('PennyTheme_paypal_enable_sdbx');

if($auctionTheme_enable_paypal_sandbox == "yes") 
$p->paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';


global $wpdb;
$this_script = get_bloginfo('siteurl').'/?a_action=purchase_bid&bid_id='.$bid_id;

if(empty($action)) $action = 'process';   

global $current_user;
get_currentuserinfo();

$uid = $current_user->ID;

$total = $row->cost;

if( $_GET['uc'] == 1 ){ // use credits
    $user_available_credits = get_user_available_credits( $uid );
    if( $total > $user_available_credits ){
        $total = $total - $user_available_credits;    
    } 
}

switch ($action) {

    

   case 'process':      // Process and order...
	

//---------------------------------------------	
 		
      //$p->add_field('business', 'sitemile@sitemile.com');
      $p->add_field('business', trim(get_option('PennyTheme_payPal_email')));	  
	  $p->add_field('currency_code', get_option('PennyTheme_currency'));
	  $p->add_field('return', $this_script.'&action=success');
      $p->add_field('cancel_return', $this_script.'&action=cancel');
      $p->add_field('notify_url', $this_script.'&action=ipn');
      $p->add_field('item_name',__('Bid package','PennyTheme'). ": ".$row->package_name);
	  $p->add_field('custom', $bid_id.'|'.$uid.'|'.current_time('timestamp',0));
      $p->add_field('amount', PennyTheme_formats_special($total,2));

      $p->submit_paypal_post(); // submit the fields to paypal

      break;

   	case 'success':      // Order was successful...
    case 'ipn':
	
    	if(isset($_POST['custom'])){
    	
    		$cust 					= $_POST['custom'];
    		$cust 					= explode("|",$cust);
    		
    		$bid_id					= $cust[0];
    		$uid					= $cust[1];
    		$datemade 				= $cust[2];
    		
            $wpdb->query( " UPDATE ".$wpdb->prefix."user_available_credits SET credit = 0 WHERE uid = '$uid' LIMIT 1 " );
            
    		$sql = "select * from ".$wpdb->prefix."penny_packages where id='$bid_id'";
    		$res = $wpdb->get_results($sql);
    		$row = $res[0];
    
    		$opt = get_option("credit_purchase_".$uid.$datemade);
    		        
    		if(empty($opt)):
    		
    			$cr = PennyTheme_get_credits($uid);
    			update_user_meta($uid,'user_credits',$cr + $row->bids);
    			update_option("credit_purchase_".$uid.$datemade, "Done");
    			
    			PennyTheme_send_email_when_bids_have_been_purchased($uid, $row->bids);
    			PennyTheme_send_email_when_bids_have_been_purchased_admin($uid, $row->bids);
    			
    		endif;
    	}
    
    	$using_perm = PennyTheme_using_permalinks();
    	if($using_perm)	$ss2 =  get_permalink(get_option('PennyTheme_my_account_payments_page_id')). "?success=1" ;
    	else $ss2 =  get_bloginfo('siteurl'). "/?page_id=". get_option('PennyTheme_my_account_payments_page_id'). "&success=1" ;	
    	
    	wp_redirect($ss2);
    break;

    case 'cancel':       // Order was canceled...

	wp_redirect(get_permalink(get_option('PennyTheme_my_account_page_id')));

       break;
     



 }     

?>