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

function PennyTheme_display_my_account_my_bid_balance_fncs()
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
            
            	<div class="box_title"><?php _e("My Bids Balance",'PennyTheme'); ?></div>
                
                <div class="box_content">    
			
				<?php
				$bal = PennyTheme_get_credits($uid);
				echo '<span class="balance">'.sprintf(__("Your Current Balance is: %s credits", "PennyTheme"), $bal)."</span>";
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