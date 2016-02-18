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

function PennyTheme_display_my_available_credits_fncs()
{

	ob_start();
	
	global $current_user;
	get_currentuserinfo();
	$uid = $current_user->ID;

    
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


<div class="my_box3">
            	<div class="padd10">
            
            	<div class="box_title"><?php _e("My Wallet",'PennyTheme'); ?></div>
                
                <?php if( !get_option( 'show_bid_based_auctions' ) && get_option( 'show_seats_based_auctions' ) ){ ?>
                    <br />You can use wallet credit to buy new seat(s)<br /><br />
                <?php }elseif( get_option( 'show_bid_based_auctions' ) && !get_option( 'show_seats_based_auctions' ) ){ ?>
                    <br />You can use wallet credit to buy <a href="<?php echo get_permalink(get_option('PennyTheme_my_account_payments_page_id')) ?>">bids’ packages</a><br /><br />
                <?php }elseif( get_option( 'show_bid_based_auctions' ) && get_option( 'show_seats_based_auctions' ) ){ ?>
                <br />You can use wallet credit to buy either a new seat(s) or <a href="<?php echo get_permalink(get_option('PennyTheme_my_account_payments_page_id')) ?>">bids’ packages</a><br /><br />
                <?php } ?>
                <div class="box_content">    
			
				<?php
				global $wpdb;
                $rs_credits = $wpdb->get_results( " SELECT * FROM ".$wpdb->prefix."user_available_credits WHERE uid = '$uid' LIMIT 1 " );
                if( count( $rs_credits ) > 0 ){
                    foreach( $rs_credits as $credit_data ){
                        ?>
                        <div style="float: left;width: 45%;text-align: left;font-weight: bold;">My Credits</div>
                        <div style="float: right;width: 45%;text-align: left;">
                            <?php echo PennyTheme_get_currency().' '.$credit_data->credit; ?>
                        </div>
                        <div style="clear: both;border-bottom: 1px dotted;padding: 4px 0;"></div>
                        <?php
                    }
                }else{
                    echo 'No credit available! ';
                }
				
				?>
			
			
			</div>
			</div>
			</div>
			
            
            </div>


<?php

	echo PennyTheme_get_users_links();
	
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
	
}

?>