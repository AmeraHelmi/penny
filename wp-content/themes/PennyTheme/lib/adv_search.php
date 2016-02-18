<?php 
function PennyTheme_get_adv_search_pagination_link($pg)
{
	$page_id = get_option('PennyTheme_adv_search_id');
	
	$using_perm = PennyTheme_using_permalinks();
	if($using_perm)	$ssk = get_permalink(($page_id)). "?pj=" . $pg ;
	else $ssk = get_bloginfo('siteurl'). "/?page_id=". ($page_id). "&pj=" . $pg ;		
	
	$trif = '';
	foreach($_GET as $key=>$value)
	{
		if($key != "pj" and $key != 'page_id' and $key != "custom_field_id")
		$trif .= '&'.$key."=".$value;
	}
	
	if(is_array($_GET['custom_field_id']))
	foreach($_GET['custom_field_id'] as $values)
	$trif .= "&custom_field_id[]=".$values;
	
	return $ssk.$trif;
}


	function pennyTheme_posts_where( $where ) {

			global $wpdb, $term;			
			$where .= " AND ({$wpdb->posts}.post_title LIKE '%$term%' OR {$wpdb->posts}.post_content LIKE '%$term%')";
	
		return $where;
	}
	
function PennyTheme_display_adv_search_fncs()
{
	
	ob_start();
    
    
    
	global $post;
	global $current_user;
	get_currentuserinfo();
	$uid = $current_user->ID;
	
	if(isset($_GET['pj'])) $pj = $_GET['pj'];
	else $pj = 1;
	
	$my_page = $pj;
	
	if(isset($_GET['order'])) $order = $_GET['order'];
	else $order = "DESC";
	
	if(isset($_GET['orderby'])) $orderby = $_GET['orderby'];
	else $orderby = "date";
	
	if(isset($_GET['meta_key'])) $meta_key = $_GET['meta_key'];
	else $meta_key = "";
	
	if(isset($_GET['price_max']) || isset($_GET['price_max'])) {
		
		if(!empty($_GET['price_max'])) $max =  $_GET['price_max']; else $max = 99999999;
		if(!empty($_GET['price_min'])) $min =  $_GET['price_min']; else $min = 0;
		
		$price_q = array(
			'key' => 'current_bid',
			'value' => array($min, $max),
			'type' => 'numeric',
			'compare' => 'BETWEEN'
		); 
		
	
		
	} else $price_q = '';
	
    
    $closed = array(
			'key' => 'closed',
			'value' => "0",
			'compare' => '='
	);
    
    $seats = array(
			'key' => 'enable_seats',
			'value' => "0",
			'compare' => '='
	);
    
    $free = array(
			'key' => 'free_auction',
			'value' => "0",
			'compare' => '='
	);
    
    $get_seated_posts = (int)$_GET['seat'];
    $get_closed_posts = (int)$_GET['close'];
    $get_free_posts   = (int)$_GET['free'];
    $bid_class = 'active_link';
    $seat_class = $close_class = $free_class = ''; 
    
    if( !get_option( 'show_bid_based_auctions' ) && get_option( 'show_seats_based_auctions' ) && !$_GET['free'] ){
        $get_seated_posts = 1;    
    }elseif( !get_option( 'show_bid_based_auctions' ) && !get_option( 'show_seats_based_auctions' ) && get_option( 'show_free_auctions' ) ){
        $get_free_posts = 1;
    }elseif( get_option( 'show_bid_based_auctions' ) && get_option( 'show_seats_based_auctions' ) && !$_GET['nr'] && !$_GET['free'] ){
        $get_seated_posts = 1;    
    }
        
    if( $get_seated_posts == 1 ){
        $seat_class = 'active_link';
        $bid_class = '';
        
        $seats = array(
			'key' => 'enable_seats',
			'value' => "1",
			'compare' => '='
		);
    }
    if( $get_closed_posts == 1 ){
        $close_class = 'active_link';
        $bid_class = '';
        $free = $seats = '';
        $closed = array(
    			'key' => 'closed',
    			'value' => "1",
    			'compare' => '='
    	);
    }
    
    if( $get_free_posts == 1 ){
        $free_class = 'active_link';
        $bid_class = '';
        $free = array(
    			'key' => 'free_auction',
    			'value' => "1",
    			'compare' => '='
    	);
    }
    
	
	if(!empty($_GET['auction_cat_cat'])) $adsads = array(
			'taxonomy' => 'auction_cat',
			'field' => 'slug',
			'terms' => $_GET['auction_cat_cat']
		
	);
	else $adsads = '';
	
	$nrpostsPage = 10;
	$PennyTheme_listings_per_page_adv_search = get_option('PennyTheme_listings_per_page_adv_search');
	if(!empty($PennyTheme_listings_per_page_adv_search)) $nrpostsPage = $PennyTheme_listings_per_page_adv_search;
	
	
	global $term;
	$term = trim(strip_tags($_GET['term']));
	
	if(!empty($_GET['term']))
	{
		add_filter( 'posts_where' , 'pennyTheme_posts_where' );
		
	}
	
    //print_r($price_q);echo '<br /><br />';
//    print_r($closed);echo '<br /><br />';
//    print_r($seats);echo '<br /><br />';
//    print_r($free);echo '<br /><br />';
//	exit;
    
	$args = array('posts_per_page' => $nrpostsPage, 'paged' => $pj, 'post_type' => 'auction',
                  'order' => $order , 'meta_query' => array($price_q, $closed, $seats, $free) ,'meta_key' => $meta_key, 
	              'orderby'=>$orderby,'tax_query' => array($adsads));
	$the_query = new WP_Query( $args );

	
 
	
	$nrposts = $the_query->found_posts;
	$totalPages = ceil($nrposts / $nrpostsPage);
	$pagess = $totalPages;
    
    if( get_option('PennyTheme_adv_search_id') == get_the_ID() ){
    		$PennyTheme_adv_code_auction_page_above_content = stripslashes(get_option('PennyTheme_adv_code_auction_page_above_content'));
    		if(!empty($PennyTheme_adv_code_auction_page_above_content)):
    		
    			echo '<div class="full_width_a_div">';
    			echo $PennyTheme_adv_code_auction_page_above_content;
    			echo '</div>';
    		
    		endif;	    
    }
	
?>	

	<div id="content">
			<div class="my_box3">
            	<div class="padd10">
            
            	<div class="box_title"><?php _e("Available Auctions",'PennyTheme'); ?></div><br />
                <div>
                    <?php if( get_option('show_seats_based_auctions') ){ ?>
                        <a class="<?php echo $seat_class; ?> normal_link" href="<?php get_bloginfo('url'); ?>?seat=1"><?php if(get_option('PennyTheme_home_section3')){ echo get_option('PennyTheme_home_section3');}else{echo 'Seats-based Auctions';} ?></a>&nbsp;
                    <?php } ?>
                    <?php if( get_option('show_bid_based_auctions') ){ ?>
                        <a class="<?php echo $bid_class; ?> normal_link" href="<?php echo get_permalink($post->ID); ?>?nr=1"><?php if(get_option('PennyTheme_home_section2')){ echo get_option('PennyTheme_home_section2');}else{echo 'Bid-based Auctions';} ?></a>&nbsp;
                    <?php } ?>
                    <?php if( get_option('show_free_auctions') ){ ?>
                        <a class="<?php echo $free_class; ?> normal_link" href="<?php get_bloginfo('url'); ?>?free=1"><?php if(get_option('PennyTheme_home_section4')){ echo get_option('PennyTheme_home_section4');}else{echo 'Free Auctions';} ?></a>&nbsp;
                    <?php } ?>
                    <!--a class="<?php //echo $close_class; ?> normal_link" href="<?php //get_bloginfo('url'); ?>?close=1">Closed Auctions</a-->
                </div><br />
                <style>
                  .active_link{
                     background:#86AC5F;
                     color:white!important;
                     padding:10px!important;
                  }
                  .normal_link{
                      padding:8px;
                      color:#86AC5F;
                      border:1px solid black;
                  }  
              </style>
                <div class="box_content">   

    
     <?php
	
		
		// The Loop
		$my_arr = array(); $i = 0;
		
		if($the_query->have_posts()):
		while ( $the_query->have_posts() ) : $the_query->the_post();
			
			pennyTheme_get_post($post, $i);
			$i++;
		endwhile;
		
		?>
		
		 <div class="nav">
                     <?php
					 	
		$batch = 10; //ceil($page / $nrpostsPage );
		$end = $batch * $nrpostsPage;
		$pages_curent = $my_page;

		if ($end > $pagess) {
			$end = $pagess;
		}
		$start = $end - $nrpostsPage + 1;
		
		if($start < 1) $start = 1;
		
		$links = '';
	
		
		$raport = ceil($my_page/$batch) - 1; if ($raport < 0) $raport = 0;
		
		$start 		= $raport * $batch + 1; 
		$end		= $start + $batch - 1;
		$end_me 	= $end + 1;
		$start_me 	= $start - 1;
		
		if($end > $totalPages) $end = $totalPages;
		if($end_me > $totalPages) $end_me = $totalPages;
		
		if($start_me <= 0) $start_me = 1;
		
		$previous_pg = $page - 1;
		if($previous_pg <= 0) $previous_pg = 1;
		
		$next_pg = $pages_curent + 1;
		if($next_pg > $totalPages) $next_pg = 1;
		
		
		
		//PricerrTheme_get_browse_jobs_link($job_tax, $job_category, 'new', $page)
		
		if($my_page > 1)
		echo '<a href="'.PennyTheme_get_adv_search_pagination_link($previous_pg).'"><< '.__('Previous','AuctionTheme').'</a>';
		echo '<a href="'.PennyTheme_get_adv_search_pagination_link($start_me).'"><<</a>';		
		
		//------------------------
		//echo $start." ".$end;
		for($i = $start; $i <= $end; $i ++) {
			if ($i == $pages_curent) {
				echo '<a class="activee" href="#">'.$i.'</a>';
			} else {
	
				echo '<a href="'.PennyTheme_get_adv_search_pagination_link($i).'">'.$i.'</a>';
				
			}
		}
		
		//----------------------
		
		if($totalPages > $my_page)
		echo '<a href="'.PennyTheme_get_adv_search_pagination_link($end_me).'">>></a>';
		echo '<a href="'.PennyTheme_get_adv_search_pagination_link($next_pg).'">'.__('Next','AuctionTheme').' >></a>';						
				
					 ?> 
                     </div> <?php
		else:
		
		_e('There are no auctions yet.','PennyTheme');
		
		endif;
		//********************** pagination ***********************************
		?>
        
        
        </div>
        </div>
        </div>
        </div>
        
        
                <!-- ################ -->
    
    <div id="right-sidebar">
    <ul class="xoxo">
        <?php dynamic_sidebar( 'other-page-area' ); ?>
    </ul>
    </div>
        
<?php

 
	
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
		
	
	
}


?>