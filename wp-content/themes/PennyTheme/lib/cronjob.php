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


add_action('template_redirect', 'PennyTheme_close_auctions'); //wp_init - here

function PennyTheme_close_auctions()
{ 
	update_option('PennyTheme_set_cronjob_me_as','yes');
	
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
			'compare' => '<'
		);
		
		
	$args2 = array( 'posts_per_page' =>'-1', 'post_type' => 'auction', 'post_status' => 'publish', 'meta_query' => array($closed, $ending));
	$the_query = new WP_Query( $args2 );
	
	
		if($the_query->have_posts()):
		while ( $the_query->have_posts() ) : $the_query->the_post();
			
				$pid = get_the_ID();
				//echo $pid;
				
				update_post_meta(get_the_ID(), 'closed',"1");
				update_post_meta(get_the_ID(), 'closed_date',current_time('timestamp',0));
				
				$get_me_a_winner = true;
				$reserve = get_post_meta(get_the_ID(),'reserve',true);
				$winner = PennyTheme_get_highest_bid_owner_obj(get_the_ID());	
				
				if(!empty($reserve))
				{
					
					if($reserve >= $winner->bid) $get_me_a_winner = false;
                    update_post_meta(get_the_ID(), 'reserve_not_met', 1);
                    send_auction_reserve_not_met_email( get_the_ID() );
                    send_auction_reserve_not_met_email_admin( get_the_ID() );
				}
				
				
				if($get_me_a_winner == true)
				{
				    update_post_meta(get_the_ID(), 'reserve_not_met', 0);
					update_post_meta(get_the_ID(), 'winner', $winner->uid);
					update_post_meta(get_the_ID(), 'winner_bid', $winner->id);
					update_post_meta(get_the_ID(), 'winner_paid',"0");
				
					PennyAuction_mark_bid_winner($winner->id);
					
					// send email to the winner -----
						
					PennyTheme_send_email_when_item_won($winner->uid, get_the_ID(), $winner->bid);
					PennyTheme_send_email_when_item_won_admin($winner->uid, get_the_ID(), $winner->bid);
					 
					
				}
		
		endwhile;
		endif;
	
}


?>