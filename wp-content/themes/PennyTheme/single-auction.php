<?php
ob_start();
	/*project theme v1.2
	*/
	
	function pennyTheme_colorbox_stuff()
	{	
	
		echo '<link media="screen" rel="stylesheet" href="'.get_bloginfo('template_url').'/css/colorbox.css" />';
		/*echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>'; */
	
		
?>
		
		<script>
		
		var $ = jQuery;
		
			$(document).ready(function(){
				
				$("a[rel='image_gal1']").colorbox();
				$("a[rel='image_gal2']").colorbox();
				
				
				
				
		});
		</script>

<?php
	}
	
	add_action('wp_head','pennyTheme_colorbox_stuff');	



	global $current_user;
	get_currentuserinfo();
	$uid = $current_user->ID;
	global $wpdb;




	get_header();

?>
<div class="clear10"></div>
<div id="content">

<?php 

			if(function_exists('bcn_display'))
		{
		    echo '<div class="my_box3"><div class="padd10">';	
		    bcn_display();
			echo '</div></div><div class="clear10"></div>';
		}

?>	
	
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<?php

	$ending     = get_post_meta(get_the_ID(), "ending", true);
	
	$views    	= get_post_meta(get_the_ID(), "views", true);
	$views 		= $views + 1;
	
	update_post_meta(get_the_ID(), "views", $views);
	$pid = get_the_ID();
	$rnd = rand(1,999);
	
	$rets_price = get_post_meta(get_the_ID(), 'retail_price', true);
	
	$retail_price 	= PennyTheme_get_show_price($rets_price);
	$time_increase 	= get_post_meta(get_the_ID(), 'time_increase', true);
	$price_increase = get_post_meta(get_the_ID(), 'price_increase', true);
	$current_bid 	= PennyTheme_get_show_price(get_post_meta(get_the_ID(), 'current_bid', true));
	$closed 		= get_post_meta(get_the_ID(), 'closed', true);
	$time_increase 	= get_post_meta(get_the_ID(), 'time_increase', true);
	
	$bidding_ended = 0;
	$ending = get_post_meta(get_the_ID(), 'ending', true);
	$sec = get_post_meta(get_the_ID(), 'ending', true) - current_time('timestamp',0);
	if($sec < 0) $bidding_ended = 1;
	//if($closed == "0") $bidding_ended = 1;
	
	//------------
		$hgb = PennyTheme_get_highest_bid_owner_obj($pid);
		$highest_bidder = PennyTheme_get_highest_bid_owner($pid);
		$user = get_userdata($highest_bidder);
			
		if($highest_bidder == false) $$highest_bidder = "0";
		else $highest_bidder = 	$user->user_login;
	
	//------------
	
?>	

<?php
    $show_auction_timer = true;
    $show_buy_seats_link = false;
    
    if( is_auction_seats_enabled( get_the_ID() ) && ( $bidding_ended != 1 ) ){
    
        $total_seats     = get_post_meta( get_the_ID(), 'seats', true );
        if( $total_seats != '' && $total_seats > 0 ){
            $purchased_seats = get_total_purchased_auction_seats( get_the_ID() );
            $remaining_seats = $total_seats - $purchased_seats;
            
            // if all seats not filled
            if( $remaining_seats > 0 ){
                $show_auction_timer = false;
                $user_message = 'Bidding Will Start Once All Seats Are Filled!';    
            }
                
            //if( $uid > 0 ){ // if user logged in
                $get_user_auction_seats = get_user_auction_seats( get_the_ID(), $uid );
                //if( $get_user_auction_seats == 0 ){ // if user dont buy any seat(s)
                    if( $remaining_seats > 0 ){
                        $total_seats_for_users = get_post_meta( get_the_ID(), 'seats_per_user', true );
                        $seats_loop = $remaining_seats;
                        if( $total_seats_for_users != '' && $total_seats_for_users > 0 ){
                            if( $remaining_seats > $total_seats_for_users ){
                                $seats_loop = $total_seats_for_users;    
                            }
                        }
                        $user_message = 'Bidding Will Start Once All Seats Are Filled!';
                        $show_buy_seats_link = true;
                        if( $get_user_auction_seats == $total_seats_for_users ){
                            $seats_loop = 0;
                            $user_message = 'Your seat limit is full!';
                            $show_buy_seats_link = false;
                        }            
                        $show_auction_timer = false;
                    }else{
                        if( $uid > 0 ){
                            if( $get_user_auction_seats == 0 ){
                                $show_auction_timer = false;
                                $user_message = 'All seats for this auction have been filled. Please try in other auction.';    
                            }    
                        } 
                    }
               // }    
          //  }
          
          // free seats
          if( get_per_seat_price( get_the_ID() ) == 0 ){
               if( $uid > 0 ){
                   if( $get_user_auction_seats > 0 ){
                        if( get_post_meta(get_the_ID(), 'starting_seats_filled', true) == 1 ){
                            $show_auction_timer = true;    
                        }
                   }else{
                        if( get_post_meta(get_the_ID(), 'starting_seats_filled', true) == 1 ){
                            if( $remaining_seats > 0 ){
                                $user_message = 'Buy seats to participate in auction.';    
                            }   
                        }
                   }
               }   
          } 
            
        }
    
    }
?>

			
 			<div class="my_box3">
            <div class="padd10">
            
            	<div class="box_title auction_page_title"><h1><?php the_title() ?></h1></div>
                <div class="box_content">
				
					<div class="auction-page-image-holder">
						<img class="img_class" src="<?php echo PennyTheme_get_first_post_image(get_the_ID(), 320, 220); ?>" alt="<?php the_title(); ?>" />
						
						<?php
				
				$arr = PennyTheme_get_post_images(get_the_ID(), 4);

				if($arr)
				{
					
				
				echo '<ul class="image-gallery" style="padding-top:10px">';
				foreach($arr as $image)
				{
					echo '<li><a href="'.PennyTheme_generate_thumb($image, -1,600).'" rel="image_gal1"><img 
					src="'.PennyTheme_generate_thumb($image, 72,60).'" class="img_class" /></a></li>';
				}
				echo '</ul>';
				
				
				}
				//else { echo __('No images.') ;}
				
				?>
						
					</div>
				
        
                
				<div class="auction-page-details-holder">
               	<?php
				    $show_buy_now = 1;
                    $show_bidding_area = 1;
					$buy_now = get_post_meta(get_the_ID(), 'buy_now', true);
                    if( get_post_meta(get_the_ID(), 'winner',true ) == $uid && $uid > 0 ){
                        $show_buy_now = 0;
                        if( $bidding_ended != 1 ){
                            $show_bidding_area = 0;    
                        }else{
                            $show_bidding_area = 1;
                        }
                    }
                    if( is_auction_seats_enabled( get_the_ID() ) ){
                        if( get_auction_remaining_seats( get_the_ID() ) > 0 ){
                            $show_buy_now = 0;    
                        }
                    }
					if( is_numeric($buy_now) and !empty($buy_now) && ( $show_buy_now == 1 ) ){
				?>
                	
                    <?php if( get_auction_item_buy_time( get_the_ID() ) > 0 ){ ?>
                    
                        <div class="auction-current-price">
                        <div class="padd10">
                        <ul>
                        	<li>
                        	<h3><?php _e("Buy Now","PennyTheme"); ?>:</h3>
                            <p><?php echo pennytheme_get_show_price($buy_now); ?></p>
                        	</li>
                        </ul>    
                        </div>
                   		</div>
                        
                        <div class="clear5"></div>
                        
                        
                        <div class="auction-current-bidnow">  
                        	<a href="<?php bloginfo('siteurl'); ?>/?a_action=buy_now&pid=<?php the_ID(); ?>" class="mm_bid_mm_buy" rel="<?php the_ID(); ?>"><?php _e("BUY NOW",'PennyTheme'); ?></a>
                        </div>
                        <div class="clear5"></div>
                    
                    <?php } ?>
                    
                    <?php
					
					}
					
					?>
                
                
                	<div class="auction-current-price">
                    <div class="padd10">
                    <ul>
                    	<li>
                    	<h3><?php _e("Current Price","PennyTheme"); ?>:</h3>
                        <p><span id="my-current-price_<?php the_ID(); ?>_<?php echo $rnd; ?>"><?php echo $current_bid; ?></span></p>
                    	</li>
                    </ul>    
                    </div>
               		</div>
                    
                    <div class="clear5"></div>
                    <?php if( $show_bidding_area ){ ?>
                        <?php if( $show_auction_timer ){ ?>
                        <div class="auction-current-time2"  >
                        <div class="auction-current-time" rel="curr_time" id="my-auction-time_<?php the_ID(); ?>_<?php echo $rnd; ?>"><?php
    					if($bidding_ended != 1):
    					
    					 echo $sec; endif;  ?></div></div>
               
                        <div class="clear5"></div>
                        <div class="auction-current-bidnow">  
                        <?php
                            $reserve_text = '';
    						if( get_post_meta( get_the_ID(), 'reserve_not_met', true ) == 1 ){
                                $reserve_text = '<br /><br /><br /><div style="line-height:31px;text-align:center;">Auction Reserve is not met, No one won the item</div>';    
                            }
    						if($bidding_ended == 1):
                            
    							_e('Bidding Ended','PennyTheme');
                                echo $reserve_text;
                                
                                
    						else:
    						
    					?>  
                        	<input type="hidden" class="my-total-ids-no-delete" value="<?php the_ID(); ?>_<?php echo $rnd; ?>" />
                            <?php if( get_post_meta(get_the_ID(), 'winner',true ) == $uid && $uid > 0 ){ ?>            	
                                <div style="font-weight: 30px;text-align: center;font-size: 30px;line-height: 30px;">You already bought this item</div>
                             <?php }else{ ?>
                                <a href="#" class="mm_bid_mm" rel="<?php the_ID(); ?>"><?php _e("BID NOW",'PennyTheme'); ?></a>
                            <?php } ?>
                        <?php endif; ?>    
                            
                        </div>
                        <?php }else{
                            // if user is not logged in
                            if( $uid == 0 ){
                                $redirect_url = urlencode( 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] );
                                $form_action = get_bloginfo('siteurl').'/wp-login.php?redirect_to='.$redirect_url;
                            }else{
                                $form_action = BUY_SEATS_PAGE_LINK;
                            }
                            ?>
                            <div class="auction-current-bidnow" style="line-height: 34px;"><?php echo $user_message; ?></div>
                            <?php if( $show_buy_seats_link ){ ?>
                                <br />
                                <fieldset>
                                    <legend>Buy seats</legend>
                                    <form method="post" action="<?php echo $form_action; ?>" style="text-align: center;">
                                        <select name="seats_no" id="myselect">
                                            <option value="">Buy Auction Seats</option>
                                            <?php 
                                                for( $i = 1; $i <= $seats_loop; $i++ ){
                                                    echo '<option value="'.$i.'">'.$i.'</option>'; 
                                                } 
                                            ?>
                                        </select>
                                        &nbsp;&nbsp;X&nbsp;&nbsp;
                                        <?php
                                            echo '<span class="seats_price_text">'.get_per_seat_price(get_the_ID()).PennyTheme_currency().'</span>'; 
                                        ?>
                                        <?php 
                                            if( get_auction_user_time_limit( get_the_ID() ) > 0 ){ 
                                                if( get_auction_timer_type( get_the_ID() ) == 'paid' ){?>
                                             <br /><br />
                                             <select name="time_count" id="time_token_select">
                                                <option value="0">Buy Time Token</option>
                                                <?php
                                                    
                                                    $user_timer = get_user_auction_timer( get_the_ID(), $uid );
                                                    $time_limit = get_auction_user_time_limit( get_the_ID() ) - $user_timer;  
                                                    for( $i = 1; $i <= $time_limit; $i++ ){
                                                    echo '<option value="'.$i.'">'.$i.'</option>';    
                                                } ?>
                                             </select>
                                             &nbsp;&nbsp;X&nbsp;&nbsp;<span class="time_cost_text"><?php echo get_auction_time_cost( get_the_ID() ).PennyTheme_currency(); ?></span>
                                             <br />
                                             <?php echo '<span class="time_token_detail_text">('.get_auction_time_increase( get_the_ID() ). ' seconds for '.get_auction_time_cost( get_the_ID() ).PennyTheme_currency().')</span>'; ?>
                                             <br /><br />   
                                        <?php }else{
                                                $user_timer = get_user_auction_timer( get_the_ID(), $uid );
                                                $time_limit = get_auction_user_time_limit( get_the_ID() ) - $user_timer;
                                                echo '<p>Includes '.$time_limit.' time token(s) of '.get_auction_time_increase( get_the_ID() ).' second each</p>';
                                                echo '<input type="hidden" value="'.get_auction_user_time_limit( get_the_ID() ).'" name="time_count"/>';
                                              }
                                            } 
                                        ?>
                                        <input type="hidden" value="<?php echo get_the_ID(); ?>" name="bid_id"/>
                                        <input id="submit_it" type="submit" value="<?php _e('Buy Seats','PennyTheme'); ?>"/>
                                    </form>
                                </fieldset>
                                
                            <?php } ?>    
                        <?php } ?>
                    <?php }else{ ?>
                        <div style="font-weight: 30px;text-align: center;font-size: 30px;line-height: 30px;">You already bought this item</div>
                    <?php } ?>
                    
                    <?php //if( $uid == 0 ){ ?>
                        <!--p style="text-align: center;">
                            <a style="background:#5aa644;padding: 6px 12px;color: white;text-decoration: none;" href="<?php //bloginfo('siteurl') ?>/wp-login.php">Buy Seats</a>
                        </p-->
                    <?php //} ?>
                    <div class="clear5"></div>
                    <div class="clear5"></div>
                    
                    <?php if( get_user_auction_timer( get_the_ID(), $uid ) > 0 && $show_auction_timer ){ ?>
                        <div style="text-align: center;">
                           <a href="#" rel="<?php echo $uid; ?>" id="inc_time" style="background: #3f88da;color: white;padding: 6px 10px;font-weight: bold;text-decoration: none;">Add time</a> 
                        </div><br />
                    <?php } ?>
                    
                    
                    <?php 
                        if( get_post_meta( get_the_ID(), 'free_auction', true ) == 1 || is_auction_seats_enabled( get_the_ID() ) ){
                            $price_increase = get_post_meta( get_the_ID(), 'price_increase', true );
                        ?>
                        <div class="auction-bid-increases">
                            <input type="checkbox" id="do_inc"/>&nbsp;
                        	Increase bid <?php echo PennyTheme_currency(); ?>&nbsp;<input id="uincb" type="number" value="<?php echo $price_increase != '' ? $price_increase : 1; ?>" min="<?php echo $price_increase != '' ? $price_increase : 1; ?>"/>
                            <br /><span id="bid_min_err" style="color: red;padding-top: 4px;display: block;"></span>
                        </div><br />
                    <?php } ?>
                    
                    <div class="auction-bid-increases">
                    	<?php printf(__("Each bid increases the auction price by %s", ""), PennyTheme_get_show_price($price_increase)); ?>
                    </div>
                    
                     <div class="clear5_1"></div>
                    <div class="auction-bid-increases" id="hghbdif" style="padding:4px"><input type="hidden" value="<?php echo $hgb->id; ?>" id="highest-bidder-bid-id" />
                    	<?php _e("Highest bidder",'PennyTheme'); ?>: <strong><span id="highest_bidder_<?php the_ID(); ?>_<?php echo $rnd; ?>">
                        <?php echo $highest_bidder != '' ? $highest_bidder : 'No bids placed yet.' ; ?></span></strong>
                    </div>
                    
                    
                    
                    <div class="clear10"></div>
              
                    
                    
                    <div class="auction-other-dets">
                    <div class="padd10">
                    <ul>
                    	<?php if(!empty($rets_price)): ?>
                    
                    	<li>
                    	<h3><?php _e("Retail Price",'PennyTheme'); ?>:</h3>
                        <p><?php echo $retail_price; ?></p>
                    	</li>
               			
                         <?php endif; ?>
                        
                        <?php if( $time_increase > 0 ){ ?>
                            <li>
                        	<h3><?php printf(__("Timer increase",'PennyTheme'), $savings); ?>:</h3>
                            <p><?php echo sprintf(__("%s seconds"), $time_increase);  ?></p>
                        	</li>
                        <?php } ?>
                    </ul>    
                    </div>
               		</div>
                    
                   
                    <!-- #### -->
                    
                   
				</div>
			</div>	
            </div>
			</div>	
			
			<div class="clear10"></div>
			
			<!-- ####################### -->
			
			<div class="my_box3">
            <div class="padd10">
            
            	<div class="box_title"><?php echo __("Description","PennyTheme"); ?></div>
                <div class="box_content description">
					<p><?php the_content(); ?></p>
				</div>
			</div>
			</div>
			
			<div class="clear10"></div>
            

			
			<!-- ####################### -->
			
			<div class="my_box3">
            <div class="padd10">
            
            	<div class="box_title"><?php echo __("Image Gallery",'PennyTheme'); ?></div>
                <div class="box_content">
				<?php
				
				$arr = PennyTheme_get_post_images(get_the_ID());
				
				if($arr)
				{
					
				
				echo '<ul class="image-gallery">';
				foreach($arr as $image)
				{
					echo '<li><a href="'.PennyTheme_generate_thumb($image, -1,600).'" class="cboxElement" rel="image_gal2"><img src="'.PennyTheme_generate_thumb($image, 100,80).'" 
					class="img_class" /></a></li>';
				}
				echo '</ul>';
				
				}
				else { echo __('No images.','PennyTheme') ;}
				
				?>
				
				
				</div>
			</div>
			</div>
			
	
			
			<!-- ####################### -->
			
	
<?php endwhile; // end of the loop. ?>



</div>

<?php

	echo '<div id="right-sidebar" class="page-sidebar">';
	echo '<ul class="xoxo">';
    
    $get_user_auction_seats = get_user_auction_seats( $pid, $uid );
	
	?>  
        <?php if( $total_seats != '' && $total_seats > 0 && $remaining_seats > 0 ){ ?>   
            <li class="widget-container widget_text">
                <h3 class="widget-title"><?php _e("Available Seats",'PennyTheme'); ?></h3>
                <p class="watch-list">Total - <?php echo $total_seats; ?></p>
                <p class="watch-list">Remaining - <?php echo $remaining_seats; ?></p>
                <p class="watch-list">My Seats - <?php echo $get_user_auction_seats; ?></p>
            </li>
        <?php } ?>
        
           <?php 
                $bid_per_user = get_post_meta( $pid, 'bid_per_user', true );
                if( $bid_per_user != '' && $bid_per_user > 0 ){
            ?>
            <li class="widget-container widget_text">
                <h3 class="widget-title"><?php _e("Your Bids",'PennyTheme'); ?></h3>
                <p class="watch-list">Total - 
                    <?php 
                        if( $get_user_auction_seats != '' && $get_user_auction_seats > 0 ){
                            $bid_per_user = $bid_per_user * $get_user_auction_seats; 
                        }
                        echo $bid_per_user; 
                    ?>
                </p>
                <p class="watch-list">Used - <?php echo get_user_bids( $pid, $uid ); ?></p>
                <p class="watch-list">Remaining - <?php echo $bid_per_user - get_user_bids( $pid, $uid ); ?></p>
            </li>
        <?php } ?>
    
    	<li class="widget-container widget_text" id="ad-other-details">
		<h3 class="widget-title"><?php _e("Bidding List",'PennyTheme'); ?></h3>
		<p >
        <div id="my_bid_list">
      <?php
		        $closed = get_post_meta($pid, 'closed', true);
				$post = get_post($pid);
				global $wpdb;
				
				$bids = "select * from ".$wpdb->prefix."penny_bids where pid='$pid' order by id DESC limit 13";
				$res  = $wpdb->get_results($bids);
			
				if(count($res) > 0){
					echo '<table width="100%">';
					echo '<thead><tr>';
						echo '<th>'.__('User','PennyTheme').'</th>';
						echo '<th>'.__('Amount','PennyTheme').'</th>';
						echo '<th>'.__('Date Made','PennyTheme').'</th>';
					
						
					echo '</tr></thead><tbody>';
					
					
					//-------------
					
					foreach($res as $row){
                                   
						$user = get_userdata($row->uid);
						echo '<tr>';
						echo '<td>'.$user->user_login.'</td>';
						echo '<td>'.PennyTheme_get_show_price($row->bid).'</td>';
                        if($row->winner == 1){
						  echo '<td>'.date("d-M-Y H:i:s", $row->date_made).'</td>';
                        }
						
						
						
						echo '</tr>';
						
					}
					
					echo '</tbody></table>';
				}
				else _e("No bids placed yet.",'PennyTheme');
			
	  ?>
        </div>
   		</p>
   </li>

<li class="widget-container widget_text">
		<h3 class="widget-title"><?php _e("Watch List",'PennyTheme'); ?></h3>
		<p class="watch-list">
        <?php 
								
								if(is_user_logged_in())
				{
					global $current_user;
					get_currentuserinfo();
					$uid = $current_user->ID;
					
					if(PennyTheme_check_if_pid_is_in_watchlist(get_the_ID(), $uid) == false) $isIn_watchlist = 0; else $isIn_watchlist = 1;
				}
				else
				{
					 $isIn_watchlist = 0;

				}
				
				if($isIn_watchlist == 1):				
				?>
                
                <a class="rem-to-watchlist" rel="<?php the_ID(); ?>" 
                href="<?php bloginfo('siteurl') ?>/?remove_from_watchlist=<?php the_ID() ?>&ret_url=<?php echo urlencode(PennyTheme_curPageURL()); ?>"><?php _e('Remove from watchlist','PennyTheme'); ?></a>
                
                <?php else: ?>
                
                <a class="add-to-watchlist" rel="<?php the_ID(); ?>" 
                href="<?php bloginfo('siteurl') ?>/?add_to_watchlist=<?php the_ID() ?>&ret_url=<?php echo urlencode(PennyTheme_curPageURL()); ?>"><?php _e('Add to watchlist','PennyTheme'); ?></a>
                <?php endif; ?>   
        </p>
        </li>

        <?php if( get_post_meta( get_the_ID(), 'free_auction', true ) == 1 || is_auction_seats_enabled( get_the_ID() ) ){ ?>

    		<li class="widget-container widget_text">
    		<h3 class="widget-title"><?php _e("Bid Assistant",'PennyTheme'); ?></h3>
    		<p >
            <?php
    		global $wpdb, $current_user;
    		get_currentuserinfo();
    		if(isset($_GET['delete_this'])):
    			if(is_user_logged_in()):
    				if($_GET['delete_this'] == $current_user->ID):
    					$sql = "delete from ".$wpdb->prefix."free_auction_bid_assistant where pid='$pid' AND uid='{$current_user->ID}'";
    					$wpdb->query($sql);
                        wp_redirect(get_permalink($pid));exit;
    				endif;		
    			endif;
    		endif;
    		
    		global $wpdb;
    		if(isset($_POST['set_bid_assistant'])){ 
    			if(is_user_logged_in()){
    			    $uid = $current_user->ID;
    				$cr = trim($_POST['max_credits']);
                     
                    $price_increase = get_post_meta( get_the_ID(), 'price_increase', true );
                    $retail_price   = get_post_meta( get_the_ID(), 'retail_price', true );
                    
                    $free_assis_err = '';
                    if( $cr < $cr ) $free_assis_err = 'Please enter value higher than auction bid price';
                    if( $retail_price != '' ){
                        if( $cr > $retail_price ) $free_assis_err = 'Please enter value lower than maximum auction bid price';
                    }
    				
                    if( $free_assis_err == '' ){
                        
        				$sj = "select * from ".$wpdb->prefix."free_auction_bid_assistant where pid='$pid' And uid='$uid'";
        				$r = $wpdb->get_results($sj);
        				
        				if(count($r) == 0){
        					$tm = current_time('timestamp',0);
        					$sj = "insert into ".$wpdb->prefix."free_auction_bid_assistant (pid,uid,date_made,credits_start,credits_current) 
        					values('$pid','$uid','$tm','$cr','$cr')";	
        					$wpdb->query($sj);
                            update_user_meta( $current_user->ID, get_the_ID().'free_auction_user_credits', $cr );
        					//PennyTheme_set_after_set_credits_to_use($pid);
        				}else{
        					$row = $r[0];
        					$sql = "update ".$wpdb->prefix."free_auction_bid_assistant set credits_start='$cr', credits_current='$cr', email_sent = 0 where  id='{$row->id}' ";	
        					$wpdb->query($sql);
        					//PennyTheme_set_after_set_credits_to_use($pid);
        				}
                        wp_redirect(get_permalink($pid));exit;
                    }else{
                        echo __( $free_assis_err,'PennyTheme').'<br/>';    
                    }
                    
    			}else{
    				echo __('You need to login to use the bid assistant!','PennyTheme').'<br/>';	
    			}
    		}
    		
    		global $wpdb, $current_user;
            get_currentuserinfo();
    		
    		$showfrm = 1;
    		if(is_user_logged_in()){
    			$sk = "select * from ".$wpdb->prefix."free_auction_bid_assistant where pid='$pid' And uid='$uid'";
    			$r = $wpdb->get_results($sk);	
    			if(count($r) > 0){
    			    $showfrm = 0; 
    				$rhm = $r[0];
    			}
   				//$crcr = get_user_meta($current_user->ID, 'free_auction_user_credits',true);
    		}
    		
    		?>
            
            <?php if($showfrm == 1): ?>
                <form method="post">
                    <?php echo __('Credits to use','PennyTheme'); ?>:
                    <?php 
                        $retail_price = get_post_meta( $pid, 'retail_price', true );
                        $price_increase = get_post_meta( $pid, 'price_increase', true );
                        if( $retail_price != '' ){
                            $max = 'max="'.$retail_price.'"';
                        }
                    ?> 
                    <input <?php echo $max; ?> name="max_credits" id="free_bid_input" type="number" value="<?php echo $price_increase != '' ? $price_increase : 1; ?>"  min="<?php echo $price_increase != '' ? $price_increase : 1; ?>"/>
                    <br /><span id="free_assis_min_err" style="color: red;padding-top: 4px;display: block;"></span> 
                    <input type="submit" name="set_bid_assistant" value="Submit" />
                </form>
            <?php endif; ?>
            
            <?php if($showfrm == 0): ?>
           <br/> 
           <?php  
    	   
    	   if(PennyTheme_using_permalinks()){
    		   $slnk = get_permalink($pid).'?delete_this='.$current_user->ID; 
    	   }else{
    	       $slnk = get_permalink($pid).'&delete_this='.$current_user->ID;    
    	   }
    	       	   
    	   echo '<input type="hidden" id="my_pid_pid" value="'.$pid.'"/>';
           echo sprintf(__('You have the bid assistant live with this auction.<br/><br/>
            				Total Credits to use: %s<br/>
            Credits Used: <span class="credits-used">%s</span><br/><br/>        
            <a href="%s">Delete This</a>', 'PennyTheme'), $rhm->credits_start, ($rhm->credits_start - $rhm->credits_current) , $slnk ); ?>
            
            <?php endif; ?>

            </p>
            </li>

    <?php } ?>
    

        <?php if( !is_auction_seats_enabled( get_the_ID() ) && get_post_meta( get_the_ID(), 'free_auction', true ) == 0 ){ ?>

    		<li class="widget-container widget_text">
    		<h3 class="widget-title"><?php _e("Bid Assistant",'PennyTheme'); ?></h3>
    		<p >
            <?php
    		global $wpdb, $current_user;
    		get_currentuserinfo();
    		if(isset($_GET['delete_this'])):
    			if(is_user_logged_in()):
    				if($_GET['delete_this'] == $current_user->ID):
    					$sql = "delete from ".$wpdb->prefix."penny_assistant where pid='$pid' AND uid='{$current_user->ID}'";
    					$wpdb->query($sql);
    					
    				endif;		
    			endif;
    		endif;
    		
    		global $wpdb;
    		if(isset($_POST['set_bid_assistant'])){
    			if(is_user_logged_in()){
    				$uid = $current_user->ID;
    				$cr = trim($_POST['max_credits']);
    				$sj = "select * from ".$wpdb->prefix."penny_assistant where pid='$pid' And uid='$uid'";
    				$r = $wpdb->get_results($sj);
    				
    				if(count($r) == 0){
    					$tm = current_time('timestamp',0);
    					$sj = "insert into ".$wpdb->prefix."penny_assistant (pid,uid,date_made,credits_start,credits_current) 
    					values('$pid','$uid','$tm','$cr','$cr')";	
    					$wpdb->query($sj);
    					//PennyTheme_set_after_set_credits_to_use($pid);
    				}else{
    					$row = $r[0];
    					$sql = "update ".$wpdb->prefix."penny_assistant set credits_start='$cr', credits_current='$cr'   where  id='{$row->id}' ";	
    					$wpdb->query($sql);
    					//PennyTheme_set_after_set_credits_to_use($pid);
    				}
    			}else{
    				echo __('You need to login to use the bid assistant!','PennyTheme').'<br/>';	
    			}
    		}
    		
    		global $wpdb, $current_user;
            get_currentuserinfo();
    		
    		$showfrm = 1;
    		if(is_user_logged_in())
    		{
    			
    			
    			$sk = "select * from ".$wpdb->prefix."penny_assistant where pid='$pid' And uid='$uid'";
    			$r = $wpdb->get_results($sk);	
    			
    			if(count($r) > 0) { $showfrm = 0;
    				$rhm = $r[0];
    			}
   				$crcr = get_user_meta($current_user->ID, 'user_credits',true);
    			echo 'Your credits: <span class="balance2">'.$crcr.'</span> <br/>';
    		}
    		
    		?>
            
            <?php //if($showfrm == 1): 
    		?>
            <form method="post">
            <?php echo __('Credits to use','PennyTheme'); ?>: <input type="text" size="4" name="max_credits" /> 
            <input type="submit" name="set_bid_assistant" value="Submit" />
            
            </form>
            <?php //endif; 
    		?>
            
            <?php if($showfrm == 0): ?>
           <br/> 
           <?php  
    	   
    	   
    	   if(PennyTheme_using_permalinks())
    	   {
    			$slnk =   get_permalink($pid).'?delete_this='.$current_user->ID; 
    	   }
    	   else $slnk =   get_permalink($pid).'&delete_this='.$current_user->ID; 
    	   
    	   
    	   echo '<input type="hidden" id="my_pid_pid" value="'.$pid.'"/>';
           echo sprintf(__('You have the bid assistant live with this auction.<br/><br/>
            				Max credits: %s<br/>
            Credits Used: <span class="credits-used">%s</span><br/><br/>        
            <a href="%s">Delete This</a>', 'PennyTheme'), $rhm->credits_start, ($rhm->credits_start - $rhm->credits_current) , $slnk ); ?>
            
            <?php endif; ?>
            
            
            
            </p>
            </li>

    <?php } ?>
    
	<li class="widget-container widget_text" id="ad-other-details">
		<h3 class="widget-title"><?php _e("Share Options",'PennyTheme'); ?></h3>
		<p>
        
        <div class="add-this">
						<!-- AddThis Button BEGIN -->
							<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
							<a class="addthis_button_preferred_1"></a>
							<a class="addthis_button_preferred_2"></a>
							<a class="addthis_button_preferred_3"></a>
							<a class="addthis_button_preferred_4"></a>
							<a class="addthis_button_compact"></a>
							<a class="addthis_counter addthis_bubble_style"></a>
							</div>
							<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4df68b4a2795dcd9"></script>
							<!-- AddThis Button END -->
						</div>	
        
   		</p>
   </li>
       
    

	
	<?php
	
						dynamic_sidebar( 'auction-widget-area' );
	echo '</ul>';
	echo '</div>';


	//classified theme v 6
	get_footer();
?>
<script>
    jQuery(function(){
        jQuery('#myselect').change(function(){
            jQuery('#myselect').css( 'border', '1px solid #ccc' );
            if( jQuery(this).val() == '' ){
                jQuery('#myselect').css( 'border', '1px solid red' );
            }
        })    
        jQuery('#submit_it').click(function(){
            if( jQuery('#myselect option:selected').val() == '' ){
                jQuery('#myselect').css( 'border', '1px solid red' );
                return false;
            } 
        })
        jQuery('#uincb').keyup(function(){
            var min = <?php echo get_post_meta( get_the_ID(), 'price_increase', true ); ?>;
            jQuery('#bid_min_err').html(''); 
            if( jQuery(this).val() < min ){
                jQuery('#bid_min_err').html('Your entered value is less than default bid value. If you continue, default value will be used.');       
            }
        })
        jQuery('#free_bid_input').keyup(function(){
            var min = <?php echo get_post_meta( get_the_ID(), 'price_increase', true ); ?>;
            var max = <?php echo get_post_meta( get_the_ID(), 'retail_price', true ); ?>;
            jQuery('#free_assis_min_err').html(''); 
            if( jQuery(this).val() < min ){
                jQuery('#free_assis_min_err').html('Your entered value is less than lowest value.');       
            }
            if( jQuery(this).val() > max ){
                jQuery('#free_assis_min_err').html('Your entered value is more than highest value.');       
            }
        })
    })
</script>