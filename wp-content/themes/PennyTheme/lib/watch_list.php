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

function PennyTheme_display_watch_list()
{

	ob_start();
	
	global $current_user;
	get_currentuserinfo();
	$uid = $current_user->ID;

 
?>


 <div id="content">
    
    		<div class="my_box3" >
                <div class="padd10">
                        
                <div class="box_title"><?php echo __("Watch List", 'PennyTheme'); ?></div>
                <div class="box_content">
    				
                    
                                <?php
				
				
				global $wpdb;
				$s = "select * from ".$wpdb->prefix."penny_watchlist where uid='$uid' order by id asc";	
				$r = $wpdb->get_results($s);

				$my_arr = array();
					
				if(count($r) > 0)
				foreach($r as $item)
				{
					$my_arr[] = $item->pid;	
				}					
				
				if(count($my_arr) == 0) $my_arr[0] = 0;		
				
				$args = array('post__in' => $my_arr,
				'post_type' 	=> 'auction', 
				'paged'			=> $wp_query->query_vars['paged']);
				
				$the_query = new WP_Query( $args );				
				
				if($the_query->have_posts()):
				// The Loop
				while ( $the_query->have_posts() ) : $the_query->the_post();
				
					PennyTheme_get_post();
					
				endwhile;
				
				if(function_exists('wp_pagenavi')):
		
					echo '<div class="navi-wrap">';
					wp_pagenavi( array( 'query' => $the_query ) );
					echo '</div>';
				
				endif;
				
				else:
					_e('There are no auctions in your watch list.','PennyTheme');
				endif;
				
				// Reset Post Data
				wp_reset_postdata();
								
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