<?php
$get_seated_posts = (int)$_GET['seat'];
$bid_class = 'active_link';
$seat_class = ''; 
if( $get_seated_posts == 1 ){
    $seat_class = 'active_link';
    $bid_class = '';
}
echo '<h3 class="widget-title">'.__('Latest Posted Auctions','PennyTheme').'</h3>';

echo '<div><a class="'.$bid_class.' normal_link" href="'.get_bloginfo('url').'">Bid Auctions</a>&nbsp;<a class="'.$seat_class.' normal_link" href="'.get_bloginfo('url').'?seat=1">Seated Auctions</a></div><br />';
echo '<style>
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
      </style>'; 

$limit = 24;
$PennyTheme_home_page_nr_itms = get_option('PennyTheme_home_page_nr_itms');
if(!empty($PennyTheme_home_page_nr_itms)) $limit = $PennyTheme_home_page_nr_itms;	

$seats_check = " AND wpostmeta2.meta_key = 'enable_seats' AND wpostmeta2.meta_value = '0' ";
if( $get_seated_posts == 1 ){
    $seats_check = " AND wpostmeta2.meta_key = 'enable_seats' AND wpostmeta2.meta_value = '1' ";
}

 global $wpdb;	
 $querystr = "
            SELECT DISTINCT wposts. *
            FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta, $wpdb->postmeta wpostmeta2
            WHERE wposts.ID = wpostmeta.post_id
            AND wposts.ID = wpostmeta2.post_id
            AND wpostmeta.meta_key = 'closed'
            AND wpostmeta.meta_value = '0'
            $seats_check
            AND wposts.post_status = 'publish'
            AND wposts.post_type = 'auction'
            ORDER BY wposts.post_date DESC
	        LIMIT ".$limit;

 $pageposts = $wpdb->get_results($querystr, OBJECT);
 
 ?>
	
	 <?php $i = 0; if ($pageposts): ?>
	 <?php global $post; ?>
     <?php foreach ($pageposts as $post): ?>
     <?php setup_postdata($post); ?>
     
     
     <?php PennyTheme_get_post(); ?>
     
     
     <?php endforeach; ?>
     <?php else : ?> <?php $no_p = 1; ?>
       <div class="padd100"><p class="center"><?php _e("Sorry, there are no posted auctions yet","PennyTheme"); ?>.</p></div>
        
     <?php endif; ?>
