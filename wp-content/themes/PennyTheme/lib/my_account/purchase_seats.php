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

function PennyTheme_display_my_account_purchase_seats_fncs()
{

	ob_start();
	
	global $current_user;
	get_currentuserinfo();
	$uid = $current_user->ID;

	$ids      = $_POST['bid_id'];
    $seats_no = $_POST['seats_no']; 
    $timer_no = $_POST['time_count'];
        
    if( wp_get_post_parent_id(get_the_ID()) == get_option('PennyTheme_my_account_page_id') ){
    		$PennyTheme_adv_code_single_page_above_content = stripslashes(get_option('PennyTheme_adv_code_single_page_above_content'));
    		if(!empty($PennyTheme_adv_code_single_page_above_content)):
    		
    			echo '<div class="full_width_a_div">';
    			echo $PennyTheme_adv_code_single_page_above_content;
    			echo '</div>';
    		
    		endif;	    
    }
?>	
<div id="content">
		<!-- page content here -->	
		<div class="my_box3">
            	<div class="padd10">
                
            	<div class="box_title"><?php _e("Pay and Purchase Seats",'PennyTheme'); ?></div>
                <div class="box_content">    
                
                <?php
                    if( isset( $_POST['bid_id'] ) ){
                        
                        global $wpdb;
                        $time_cost = 0;
                        if( get_auction_timer_type( $ids ) == 'paid' ){
                            $time_cost = get_auction_time_cost( $ids );
                        }
                        
                        $per_seat_price = get_per_seat_price( $ids );
                        $total = ($per_seat_price * $seats_no) + ($time_cost * $timer_no);
                        
                        $show_gateways = true;
                        
                        // user available credits
                        $user_available_credits = get_user_available_credits( $uid );
                        if( isset( $_POST['use_credit'] ) ){
                            if( $user_available_credits >= $total ){
                                $show_gateways = false;
                                $wpdb->query( " UPDATE ".$wpdb->prefix."user_available_credits SET credit = ( credit - $total ) WHERE uid = '$uid' LIMIT 1 " );
                                $user_available_credits = get_user_available_credits( $uid );                    
                            }else{
                                wp_redirect( get_bloginfo('siteurl').'/?a_action=purchase_seats&cu=1&bid_id='.$ids.'&seats='.$seats_no.'&time='.$timer_no );
                                exit;
                            }    
                        }
                                                
                        // free case
                        if( $seats_no > 0 && get_custom_seat_price($ids) == 0 && $total == 0 ){
                            $show_gateways = false;
                        }
                        
                        if( ! $show_gateways ){
                            $show_gateways = false;
                            $sql = "select seats from ".$wpdb->prefix."auctions_seats where pid='$ids' and uid = '$uid'";
                    		$res = $wpdb->get_results($sql);
                            if( count( $res ) > 0 ){
                                $row = $res[0];
                                $user_seats = $row->seats;
                                $total_seats_for_users = get_post_meta( get_the_ID(), 'seats_per_user', true );
                                
                                if( $total_seats_for_users != '' && $total_seats_for_users > 0 ){
                                    if( $user_seats < $total_seats_for_users ){
                                        $wpdb->query( " UPDATE ".$wpdb->prefix."auctions_seats SET seats = ( seats + $seats_no ), total_cost = ( total_cost + $total ) WHERE pid = '$ids' AND uid = '$uid' LIMIT 1 " );
                                    }    
                                }else{
                                    $wpdb->query( " UPDATE ".$wpdb->prefix."auctions_seats SET seats = ( seats + $seats_no ), total_cost = ( total_cost + $total ) WHERE pid = '$ids' AND uid = '$uid' LIMIT 1 " );
                                }
                                    
                            }else{
                                $wpdb->query( " INSERT INTO ".$wpdb->prefix."auctions_seats SET seats = '$seats_no', pid = '$ids', uid = '$uid', total_cost = '$total' " );                
                            }
                            
                            $remaining_seats = get_auction_remaining_seats($ids);
                            if( is_auction_seats_enabled( $ids ) ){
                                if( $remaining_seats == 0 ){
                                    if( get_post_meta($ids, 'starting_seats_filled', true) == 0 ){ // additional added seats case
                                        $add_time  = get_post_meta($ids, 'add_time', true);
                                        $add_hours = get_post_meta($ids, 'add_hours', true);
                                        $add_mins  = get_post_meta($ids, 'add_mins', true);
                                        $new_ending = strtotime( $add_time.' days '.$add_hours.' hours '.$add_mins.' minutes', current_time('timestamp',0) );
                                        update_post_meta($ids, 'ending_admin_update', 1);
                                        update_post_meta($ids, 'ending', $new_ending);
                                        update_post_meta($ids, 'starting_seats_filled', 1);
                                   }    
                                }    
                            }
                            
                            if( get_auction_timer_type( $ids ) == 'free' ){
                                if( $timer_no > 0 ){
                                    set_user_auction_timer( $ids, $uid, $timer_no );
                                }else{
                                    set_user_auction_timer( $ids, $uid, $timer_no );
                                }
                            }
                            
                            send_auction_start_email($ids);
                            send_auction_start_email_admin($ids);
        
                            $ss2 = get_permalink($ids);
                            
                        }else{
                           echo '<div><strong>Amount to Pay</strong> - '.PennyTheme_currency().$total.'</div><br />'; 
                        }
                           
                    }
                ?>
                
                <?php if( $show_gateways ){ ?>
                    
                    <?php
                        if( $user_available_credits > 0 ){
                            _e("You have ".PennyTheme_currency()."$user_available_credits credits available in your wallet.<br /><br />",'PennyTheme');
                            ?>
                            <form method="post">
                                <input type="hidden" name="bid_id" value="<?php echo $_POST['bid_id']; ?>"/>
                                <input type="hidden" name="seats_no" value="<?php echo $_POST['seats_no']; ?>"/>
                                <input type="hidden" name="time_count" value="<?php echo $_POST['time_count']; ?>"/>
                                <input type="submit" value="Use Credits" name="use_credit"/>
                            </form><br /><strong>OR</strong><br /><br />
                            <?php
                        }
                    ?>
                    
                    <?php _e('Choose one of the payment methods below to pay for your seats.','PennyTheme'); ?><br/><br/>
                                    
                    <?php
                    
    				$PennyTheme_paypal_enable = get_option('PennyTheme_paypal_enable');
    				if($PennyTheme_paypal_enable == "yes"):
    				
    				?>
                    <a href="<?php bloginfo('siteurl') ?>/?a_action=purchase_seats&bid_id=<?php echo $ids; ?>&seats=<?php echo $seats_no; ?>&time=<?php echo $timer_no; ?>" class="green_btn2"><?php _e('Pay by PayPal','PennyTheme'); ?></a>
                  	
                    <?php endif; ?>
                    
                    <?php
    				
    					do_action('PennyTheme_payment_gateways_for_buy_seats');
    				
    				?>
                
                <?php }else{ ?>
                    <p>Your seats have been added into your account successfully.</p>
                    <a href="<?php echo $ss2; ?>" class="green_btn2"><?php _e('Back to auction','PennyTheme'); ?></a>
                <?php } ?>
                
                </div>
                
                
           </div>
           </div>    
		
		<!-- page content here -->	
		</div>		



<?php

	echo PennyTheme_get_users_links();
	
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
	
}

?>