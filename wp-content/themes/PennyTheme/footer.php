<?php
/***************************************************************************
*
*	PennyTheme - copyright (c) - sitemile.com
*
*	Coder: Andrei Dragos Saioc
*	Email: sitemile[at]sitemile.com | andreisaioc[at]gmail.com
*	More info about the theme here: http://sitemile.com/p/penny
*	since v1.2
*
***************************************************************************/

?>

<?php
	global $wp;
	
	if(is_home()):
		$PennyTheme_adv_code_home_below_content = stripslashes(get_option('PennyTheme_adv_code_home_below_content'));
		if(!empty($PennyTheme_adv_code_home_below_content)):
		
			echo '<div class="full_width_a_div">';
			echo $PennyTheme_adv_code_home_below_content;
			echo '</div>';
		
		endif;
	endif;
	
	//-----------------------------------
	
    if( get_option('PennyTheme_adv_search_id') == get_the_ID() ){
    		$PennyTheme_adv_code_auction_page_below_content = stripslashes(get_option('PennyTheme_adv_code_auction_page_below_content'));
    		if(!empty($PennyTheme_adv_code_auction_page_below_content)):
    		
    			echo '<div class="full_width_a_div">';
    			echo $PennyTheme_adv_code_auction_page_below_content;
    			echo '</div>';
    		
    		endif;	    
    }
    
    if( get_option('PennyTheme_all_cats_id') == get_the_ID() ){
    		$PennyTheme_adv_code_cPT_page_below_content = stripslashes(get_option('PennyTheme_adv_code_cPT_page_below_content'));
    		if(!empty($PennyTheme_adv_code_cPT_page_below_content)):
    		
    			echo '<div class="full_width_a_div">';
    			echo $PennyTheme_adv_code_cPT_page_below_content;
    			echo '</div>';
    		
    		endif;	    
    }
    
    if( get_option('PennyTheme_my_account_page_id') == get_the_ID() || wp_get_post_parent_id(get_the_ID()) == get_option('PennyTheme_my_account_page_id') ){
    		$PennyTheme_adv_code_single_page_below_content = stripslashes(get_option('PennyTheme_adv_code_single_page_below_content'));
    		if(!empty($PennyTheme_adv_code_single_page_below_content)):
    		
    			echo '<div class="full_width_a_div">';
    			echo $PennyTheme_adv_code_single_page_below_content;
    			echo '</div>';
    		
    		endif;	    
    }
    
//	if ($wp->query_vars["post_type"] == "auction"):
//		$PennyTheme_adv_code_job_page_below_content = stripslashes(get_option('PennyTheme_adv_code_job_page_below_content'));
//		if(!empty($PennyTheme_adv_code_job_page_below_content)):
//		
//			echo '<div class="full_width_a_div">';
//			echo $PennyTheme_adv_code_job_page_below_content;
//			echo '</div>';
//		
//		endif;	
//	endif;
	
	//-------------------------------------
	
//	if(is_single() or is_page()):
//		$PennyTheme_adv_code_single_page_below_content = stripslashes(get_option('PennyTheme_adv_code_single_page_below_content'));
//		if(!empty($PennyTheme_adv_code_single_page_below_content)):
//		
//			echo '<div class="full_width_a_div">';
//			echo $PennyTheme_adv_code_single_page_below_content;
//			echo '</div>';
//		
//		endif;
//	endif;
	
	//-------------------------------------
	
//	if(is_tax()):
//		$PennyTheme_adv_code_cat_page_below_content = stripslashes(get_option('PennyTheme_adv_code_cat_page_below_content'));
//		if(!empty($PennyTheme_adv_code_cat_page_below_content)):
//		
//			echo '<div class="full_width_a_div">';
//			echo $PennyTheme_adv_code_cat_page_below_content;
//			echo '</div>';
//		
//		endif;
//	endif;
	
	//-----------------------------------
	
	?>

</div> 
</div> <!-- end some_wide_header -->
</div>
</div>

<div id="footer">
	<div id="colophon">	
	
	<?php
			get_sidebar( 'footer' );
	?>
	
	
		<div id="site-info">
				<div id="site-info-left">
					
					<h3><?php echo stripslashes(get_option('PennyTheme_left_side_footer')); ?></h3>
					
				</div>
				<div id="site-info-right">
					<?php echo stripslashes(get_option('PennyTheme_right_side_footer')); ?>
				</div>
			</div>
		</div>

</div>


</div>
<?php

	$PennyTheme_enable_google_analytics = get_option('PennyTheme_enable_google_analytics');
	if($PennyTheme_enable_google_analytics == "yes"):		
		echo stripslashes(get_option('PennyTheme_analytics_code'));	
	endif;
	
	//----------------
	
	$PennyTheme_enable_other_tracking = get_option('PennyTheme_enable_other_tracking');
	if($PennyTheme_enable_other_tracking == "yes"):		
		echo stripslashes(get_option('PennyTheme_other_tracking_code'));	
	endif;
    
    //echo date('Y-m-d H:i');  
    //global $wpdb;
    //$wpdb->query("TRUNCATE TABLE ".$wpdb->prefix."auctions_seats");
    //print_r( $wpdb->get_results("select * from ".$wpdb->prefix."auctions_seats") ); exit;
    
//    $wpdb->query("CREATE TABLE ".$wpdb->prefix."auctions_seats (
//                      `id` int(11) NOT NULL auto_increment,
//                      `pid` int(11) NOT NULL,
//                      `uid` int(11) NOT NULL,
//                      `seats` int(11) NOT NULL,
//                      PRIMARY KEY  (`id`)
//                    )");
//$wpdb->query( " INSERT INTO ".$wpdb->prefix."auctions_seats SET seats = '1', pid = '1', uid = '1'" );
//exit;

?>
<?php wp_footer(); ?>
</body>
</html>