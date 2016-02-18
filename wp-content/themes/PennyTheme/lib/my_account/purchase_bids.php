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

function PennyTheme_display_my_account_purchase_bids_fncs()
{

	ob_start();
	
	global $current_user, $wpdb;
	get_currentuserinfo();
	$uid = $current_user->ID;

	$ids = $_GET['bid_id'];
        
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
            
            	<div class="box_title"><?php _e("Pay and Purchase Bids",'PennyTheme'); ?></div>
                <div class="box_content">    
                
			    <?php 
                    $user_available_credits = get_user_available_credits( $uid );
                    
                    $sql = "select * from ".$wpdb->prefix."penny_packages where id='$ids'";
                	$res = $wpdb->get_results($sql);
                	$row = $res[0];
                    $total = $row->cost;
                    $show_gateways = true;
                    if( isset( $_GET['use_credit'] ) ){
                        if( $user_available_credits >= $total ){
                            $show_gateways = false;
                            $wpdb->query( " UPDATE ".$wpdb->prefix."user_available_credits SET credit = ( credit - $total ) WHERE uid = '$uid' LIMIT 1 " );
                            
                            $sql = "select * from ".$wpdb->prefix."penny_packages where id='$ids'";
                    		$res = $wpdb->get_results($sql);
                    		$row = $res[0];
                            
                            $datemade = current_time('timestamp',0);
                    		$opt = get_option("credit_purchase_".$uid.$datemade);
                    		if(empty($opt)):
                    			$cr = PennyTheme_get_credits($uid);
                    			update_user_meta($uid,'user_credits',$cr + $row->bids);
                    			update_option("credit_purchase_".$uid.$datemade, "Done");
                    			
                    			PennyTheme_send_email_when_bids_have_been_purchased($uid, $row->bids);
                    			PennyTheme_send_email_when_bids_have_been_purchased_admin($uid, $row->bids);
                    		endif;
                            $user_available_credits = get_user_available_credits( $uid );
                                
                        }else{
                            wp_redirect( get_bloginfo('siteurl').'/?a_action=purchase_bid&cu=1&uc=1&bid_id='.$ids );
                            exit;
                        }    
                    }
                         
                    if( $user_available_credits > 0 ){
                        _e("You have ".PennyTheme_currency()."$user_available_credits credits available in your wallet.<br /><br />",'PennyTheme');
                        ?>
                        <form method="get">
                            <input type="hidden" name="bid_id" value="<?php echo $_GET['bid_id']; ?>"/>
                            <input type="submit" value="Use Credits" name="use_credit"/>
                        </form><br /><strong>OR</strong><br /><br />
                        <?php
                    }
                ?>
               	
                <?php if( $show_gateways ){ ?>
                
                    <?php _e('Choose one of the payment methods below to pay for your bids package.','PennyTheme'); ?><br/><br/>
                    
                    <?php
    				
    				$PennyTheme_paypal_enable = get_option('PennyTheme_paypal_enable');
    				if($PennyTheme_paypal_enable == "yes"):
    				
    				?>
                    <a href="<?php bloginfo('siteurl') ?>/?a_action=purchase_bid&bid_id=<?php echo $ids; ?>" class="green_btn2"><?php _e('Pay by PayPal','PennyTheme'); ?></a>
                  	
                    <?php endif; ?>
                    
                    
                    <?php
    				
    				$PennyTheme_alertpay_enable = get_option('PennyTheme_alertpay_enable');
    				if($PennyTheme_alertpay_enable == "yes"):
    				
    				?>
                    <a href="<?php bloginfo('siteurl') ?>/?a_action=purchase_bid_payza&bid_id=<?php echo $ids; ?>" class="green_btn2"><?php _e('Pay by Payza','PennyTheme'); ?></a>
                  	
                    <?php endif; ?>
                    
                    
                    <?php
    				
    				$PennyTheme_moneybookers_enable = get_option('PennyTheme_moneybookers_enable');
    				if($PennyTheme_moneybookers_enable == "yes"):
    				
    				?>
                    <a href="<?php bloginfo('siteurl') ?>/?a_action=purchase_bid_moneybookers&bid_id=<?php echo $ids; ?>" class="green_btn2"><?php _e('Pay by Moneybookers','PennyTheme'); ?></a>
                  	
                    <?php endif; ?>
                    
                    
                    
                      <?php
    				
    				$PennyTheme_offline_payments = get_option('PennyTheme_offline_payments');
    				if($PennyTheme_offline_payments == "yes"):
    				
    				 
    				
    				?>
                   
                   
                     <a href="<?php bloginfo('siteurl') ?>/?a_action=purchase_bid_offline&bid_id=<?php echo $ids; ?>" class="green_btn2"><?php _e('Pay by Bank/Offline','PennyTheme'); ?></a>
                  	
                    <?php endif; ?>
                    
                    
                    <?php do_action('PennyTheme_payment_gateways_for_buy_bids'); ?>
                <?php }else{ ?>
                    <p>Your bids have been added into your account successfully.</p>
                    <a href="<?php echo get_permalink(get_option('PennyTheme_my_account_payments_page_id')); ?>" class="green_btn2"><?php _e('Back to auction','PennyTheme'); ?></a>
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