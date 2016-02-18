<?php
ob_start();
include 'paypal.class.php';
$action = $_GET['action'];

global $wpdb, $wp_rewrite, $wp_query;

$p = new paypal_class;             // initiate an instance of the class
$p->paypal_url = 'https://www.paypal.com/cgi-bin/webscr';   // testing paypal url
//$p->paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';     // paypal url

$auctionTheme_enable_paypal_sandbox = get_option('PennyTheme_paypal_enable_sdbx');

if($auctionTheme_enable_paypal_sandbox == "yes") 
$p->paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';

if(empty($action)) $action = 'process';

switch ($action) {

   case 'process':      // Process and order...
	
//---------------------------------------------	
      //$p->add_field('business', 'sitemile@sitemile.com');
      $p->add_field('business', $refund_email );	  
	  $p->add_field('currency_code', get_option('PennyTheme_currency'));
	  $p->add_field('return', $this_script.'&action=success&stage=paypal');
      $p->add_field('cancel_return', $this_script.'&action=cancel&stage=paypal');
      $p->add_field('notify_url', $this_script.'&action=ipn&stage=paypal');
      $p->add_field('item_name',__('Refund','PennyTheme'));
	  $p->add_field('custom', $refund_user.'|'.$refund_amnt.'|'.$this_script.'|'.current_time('timestamp',0));
      $p->add_field('amount', PennyTheme_formats_special($refund_amnt,2));
      
      $p->submit_paypal_post(); // submit the fields to paypal
        
      break;

   	case 'success':      // Order was successful...
        global $wpdb;
    	
		$cust 		 = $_POST['custom'];
		$cust 		 = explode("|",$cust);
		$refund_user = $cust[0];
		$refund_amnt = $cust[1];
        $url 	     = $cust[2];
        $datemade 	 = $cust[3];
		
        //$check = $wpdb->get_row(" SELECT uid FROM ".$wpdb->prefix."user_available_credits WHERE uid = '$refund_user' ");
//        if( $check->uid > 0 ){
//            $wpdb->query(" UPDATE ".$wpdb->prefix."user_available_credits SET credit = (credit+'$refund_amnt') WHERE uid = '$refund_user' LIMIT 1" );
//        }else{
//            $wpdb->query(" INSERT INTO ".$wpdb->prefix."user_available_credits SET uid = '$refund_user', credit = '$refund_amnt'" );    
//        }
        $wpdb->query(" INSERT INTO ".$wpdb->prefix."credit_refund_history SET uid = '$refund_user', credit = '$refund_amnt', method = 'paypal'" );
                       
    	wp_redirect($url.'&status=done');
                
    break; 
    
	case 'ipn':
			$cust 		 = $_POST['custom'];
			$cust 		 = explode("|",$cust);
			$refund_user = $cust[0];
			$refund_amnt = $cust[1];
            $url 	     = $cust[2];
            $datemade 	 = $cust[3];
    break;

   case 'cancel':       // Order was canceled...
	  wp_redirect(get_permalink(get_option('PennyTheme_my_account_page_id')));
   break;

 }     
?>