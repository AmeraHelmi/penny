<?php

if(isset($_POST['crds']))
{
	$uid = $_POST['uid'];
	if(!empty($_POST['increase_credits']))
	{
		if($_POST['increase_credits'] > 0)
		if(is_numeric($_POST['increase_credits']))
		{
			$cr = PennyTheme_get_credits($uid);
			update_user_meta($uid,'user_credits',$cr + $_POST['increase_credits']);
		}
	}
	else
	{
		if($_POST['decrease_credits'] > 0)
		if(is_numeric($_POST['decrease_credits']))
		{
			$cr = PennyTheme_get_credits($uid);
			update_user_meta($uid,'user_credits',$cr - $_POST['decrease_credits']);
		}
	
	}	

	echo $sign.PennyTheme_get_credits($uid); //." ".PennyTheme_currency() ;
	exit;
}

//===================================================

if(isset($_GET['_get_time_left']))
{
	$pid = $_GET['_get_time_left'];
	$ending = get_post_meta($pid, 'ending', true);
	$sec 	= $ending - current_time('timestamp',0);	
	echo $sec;
	exit;
}

if(isset($_GET['_get_current_price_left']))
{
	$pid 			= $_GET['_get_current_price_left'];
	$current_bid 	= get_post_meta($pid, 'current_bid', true);
	
	echo $current_bid;
	exit;
}

if(isset($_GET['_bid_now']))
{
	global $current_user, $wpdb;
	get_currentuserinfo();
	$uid = $current_user->ID;
	
	if(!is_user_logged_in()) { echo "NO_USER_LOGIN"; exit; }
	
	$user_credits = get_user_meta($uid, 'user_credits', true);
	if($user_credits <= 0 || empty($user_credits )) { echo "NO_USER_CREDITS"; exit; }
	

	$pid			= $_GET['_bid_now'];
	
	
	$old_ending = get_post_meta($pid, 'ending', 		true);
	
	if($old_ending < current_time('timestamp', 0)) { echo "TIME_IS_UP"; exit; }
	
	$price_increase = get_post_meta($pid, 'price_increase', true);
	$retail_price 	= get_post_meta($pid, 'retail_price', 	true);
	$time_increase 	= get_post_meta($pid, 'time_increase', 	true);
	$ending		 	= $old_ending + $time_increase;
	$tm 			= current_time('timestamp', 0);
	$bid			= PennyTheme_get_highest_bid($pid) +  $price_increase;
	
	update_post_meta($pid, 'ending', 		$ending);
	update_post_meta($pid, 'current_bid', 	$bid);
    if( is_auction_seats_enabled($pid) == 0 ){
        update_user_meta($uid, 'user_credits', 	$user_credits - 1);    
    }
	
	add_post_meta($pid, 'bidded_auction', $uid , 	true);
	
	
	$query = "insert into ".$wpdb->prefix."penny_bids (pid,uid,date_made,bid) values('$pid','$uid','$tm','$bid')";
	$wpdb->query($query);
	
	exit;
}



if(isset($_GET['_time_is_up']))
{
?>
	<div class="youneedtologin"><div class="padd10">
	
    <?php _e("Oups! The time for the auction is up!","PennyTheme"); ?>
    
 
    </div></div>

<?php
	exit;
}

if(isset($_GET['_user_has_no_credits']))
{
?>
	<div class="youneedtologin"><div class="padd10">
	
    <?php _e("To bid you need credits. There are no credits in your account.
    Click the button below to purchase credits.","PennyTheme"); ?>
    
    <br/>
    <br/>
    
    <a href="<?php echo get_permalink(get_option('PennyTheme_my_account_payments_page_id')); ?>" class="green_btn"><?php _e("Purchase Credits","PennyTheme"); ?></a>
	
    </div></div>

<?php
	exit;
}

if(isset($_GET['_user_is_not_logged_in']))
{
?>
	<div class="youneedtologin"><div class="padd10">
	
    <?php _e("To be able to use the bid feature you need to login first.
    You can login if you do not have an account you can register.","PennyTheme"); ?>
	
    <br/><br/>
    
    <a href="<?php bloginfo('siteurl'); ?>/wp-login.php" class="green_btn"><?php _e("Login","PennyTheme"); ?></a> 
    <a href="<?php bloginfo('siteurl'); ?>/wp-login.php?action=register" class="green_btn"><?php _e("Register","PennyTheme"); ?></a>
    
    </div></div>

<?php
	exit;
}

if(isset($_GET['_no_further_bidding_allowed']))
{
?>
	<div class="youneedtologin"><div class="padd10">
	
    <?php _e("Your bid limit for this auction has been reached.","PennyTheme"); ?>
    
    </div></div>

<?php
	exit;
}




?>