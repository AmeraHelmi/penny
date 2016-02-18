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

function PennyTheme_display_my_account_unpaid_itms_fncs()
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
		<!-- page content here -->	
			
		                                <div class="my_box3">
            	<div class="padd10">
            
            	<div class="box_title"><?php _e("Unpaid Items",'PennyTheme'); ?></div>
                <div class="box_content">    
				
                
                <?php
				global $wp_query;
				$query_vars = $wp_query->query_vars;
				$post_per_page = 5;				
				
				$winner = 	array(
						'key' => 'winner',
						'value' => $uid,
						'compare' => '='
					);
		
				$paid = array(
						'key' => 'winner_paid',
						'value' => "0",
						'compare' => '='
					);	
				
                //$args = array('post_type' => 'auction', 'order' => 'DESC', 'orderby' => 'meta_value_num', 'meta_key' => 'closed_date', 'posts_per_page' => $post_per_page,
//				'paged' => $query_vars['paged'], 'meta_query' => array($winner));
                
				$args = array('post_type' => 'auction', 'order' => 'DESC', 'orderby' => 'closed_date',
                 'posts_per_page' => $post_per_page,'pages' => $query_vars['paged'], 'meta_query' => array($winner,$paid));
				
				
				query_posts( $args);

				if(have_posts()) :
				while ( have_posts() ) : the_post();
					PennyTheme_get_post_my_account_won();
				endwhile;
				
				if(function_exists('wp_pagenavi')) :
				wp_pagenavi(); endif;
				
				 else:
				
				_e("There are no auctions yet.",'PennyTheme');
				
				endif;
				
				wp_reset_query();
				
				?>
                
                
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