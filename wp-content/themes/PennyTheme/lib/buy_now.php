<?php
if(!is_user_logged_in()) { wp_redirect(get_bloginfo('siteurl')."/wp-login.php"); exit; }

	global $wpdb,$wp_rewrite,$wp_query;
	$pid = $_GET['pid'];
	$tm = current_time('timestamp',0);
	

	global $current_user;
	get_currentuserinfo();
	$uid = $current_user->ID;

	$post_auction = get_post($pid);
	
	if(isset($_POST['yes']))
	{
		//update_post_meta($pid, 'closed',"1");
		//update_post_meta($pid, 'closed_date',current_time('timestamp',0));
		$bid = get_post_meta($pid,'buy_now',true);
		//update_post_meta($pid, 'current_bid', $bid);
		
		
		$query = "insert into ".$wpdb->prefix."penny_bids (uid,bid, buy,buy_id,date_made) values('$uid','$bid','1','$pid','$tm')";
		$wpdb->query($query);
		
		$s = "select * from ".$wpdb->prefix."penny_bids where date_made='$tm' AND uid='$uid' AND buy = 1 AND buy_id = $pid";
		$r = $wpdb->get_results($s);
		$winner = $r[0];
		
		update_post_meta($pid, 'winner',$winner->uid);
		update_post_meta($pid, 'winner_bid',$winner->id);
        update_post_meta($pid, 'buy_this_item',$winner->id);
		update_post_meta($pid, 'winner_paid',"0");
		//update_post_meta($pid, 'ending',"0");
		
		PennyAuction_mark_bid_winner($winner->id);
					
					// send email to the winner -----
						
		PennyTheme_send_email_when_item_won($winner->uid, $pid, $winner->bid);
		PennyTheme_send_email_when_item_won_admin($winner->uid, $pid, $winner->bid);
		
		wp_redirect(get_permalink(get_option('PennyTheme_my_account_unpaid_auctions_page_id')));
		
		die();
	}
	
	if(isset($_POST['no']))
	{
		wp_redirect(get_permalink($pid));
		die();	
	}
	
	//----------
	
	get_header();
	
?>

<div class="clear10"></div>

	
			<div class="my_box3">
            	<div class="padd10">
            
            	<div class="box_title"><?php echo sprintf(__("Buy Now auction: %s",'PennyTheme'), $post_auction->post_title); ?></div>
                <div class="box_content">   
               <?php
			   
			 
			   echo sprintf(__("You are about to buy now auction: %s",'PennyTheme'), $post_auction->post_title);
			   
			   ?>
               <div class="clear10"></div>
               
               <form method="post" enctype="application/x-www-form-urlencoded"> 
         
               <input type="submit" name="yes" value="<?php _e("Yes, Buy Now!",'PennyTheme'); ?>" />
               <input type="submit" name="no"  value="<?php _e("No",'PennyTheme'); ?>" />
                
               </form>
    </div>
			</div>
			</div>
        
        
        <div class="clear10"></div>
            
            
<?php

get_footer();

?>                        