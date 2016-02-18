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

function PennyTheme_display_my_account_my_seats_fncs()
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
            
            	<div class="box_title"><?php _e("My seats",'PennyTheme'); ?></div>
                <div class="box_content">    
			
			
				<?php

				global $wpdb;
                
                $rs_seats = $wpdb->get_results( " SELECT p.post_title, s.seats, p.ID FROM $wpdb->posts p JOIN ".$wpdb->prefix."auctions_seats s ON s.pid = p.ID WHERE s.uid = '$uid' ORDER BY p.post_date DESC " );
                if( count( $rs_seats ) > 0 ){
                    foreach( $rs_seats as $seats_data ){
                        ?>
                        <div style="float: left;width: 45%;text-align: left;">
                            <div class="image_holder" style="margin-right: 20px;">
                            <a href="<?php get_permalink($seats_data->ID); ?>"><img width="75" height="65" class="image_class" src="<?php echo PennyTheme_get_first_post_image($seats_data->ID,75,65); ?>" /></a>
                            </div>
                            <h2 style="margin: 0;">
                                <a class="link" href="<?php echo get_permalink($seats_data->ID); ?>"><?php echo $seats_data->post_title; ?></a>
                            </h2>
                        </div>
                        <div style="float: right;width: 45%;text-align: left;">
                            <?php echo $seats_data->seats; ?> Seats
                        </div>
                        <div style="clear: both;border-bottom: 1px dotted;padding: 4px 0;"></div>
                        <?php
                    }
                }else{
                    echo 'No data available! ';
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