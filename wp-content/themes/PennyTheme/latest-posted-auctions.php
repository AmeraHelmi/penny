<?php
if(get_option('PennyTheme_home_section1')){ 
    $text1 = get_option('PennyTheme_home_section1');
}else{
    $text1 ='Latest Posted Auctions';
}
echo '<h3 class="widget-title">'.__($text1,'PennyTheme').'</h3>';

if( get_option('show_seats_based_auctions') ){

    if(get_option('PennyTheme_home_section3')){ 
        $text3 = get_option('PennyTheme_home_section3');
    }else{
        $text3 ='Seats-based Auctions';
    }
    echo '<div><h3 class="widget-title" style="border-bottom:1px solid">'.$text3.'</h3></div><br />';
    
    $limit = 24;
    $PennyTheme_home_page_nr_itms = get_option('PennyTheme_home_page_nr_itms');
    if(!empty($PennyTheme_home_page_nr_itms)) $limit = $PennyTheme_home_page_nr_itms;	
    
     global $wpdb;	
     $querystr = "
                SELECT DISTINCT wposts. *
                FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta, $wpdb->postmeta wpostmeta2
                WHERE wposts.ID = wpostmeta.post_id
                AND wposts.ID = wpostmeta2.post_id
                AND wpostmeta.meta_key = 'closed' AND wpostmeta.meta_value = '0'
                AND wpostmeta2.meta_key = 'enable_seats' AND wpostmeta2.meta_value = '1'
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
       <div class="padd100"><p class="center"><?php _e("Sorry, there are no seat auction(s) yet","PennyTheme"); ?>.</p></div>
        
     <?php endif; ?>
    <div style="clear: both;">&nbsp;</div>
<?php } ?>
 
 
<?php

if( get_option('show_bid_based_auctions') ){
    
    if(get_option('PennyTheme_home_section2')){ 
        $text2 = get_option('PennyTheme_home_section2');
    }else{
        $text2 ='Bids-based Auctions';
    }
    echo '<div><h3 class="widget-title" style="border-bottom:1px solid">'.$text2.'</h3></div><br />';
    
    $limit = 24;
    $PennyTheme_home_page_nr_itms = get_option('PennyTheme_home_page_nr_itms');
    if(!empty($PennyTheme_home_page_nr_itms)) $limit = $PennyTheme_home_page_nr_itms;	
    
     global $wpdb;	
     $querystr = "
                SELECT DISTINCT wposts. *
                FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta, $wpdb->postmeta wpostmeta2, $wpdb->postmeta wpostmeta3 
                WHERE wposts.ID = wpostmeta.post_id
                AND wposts.ID = wpostmeta2.post_id
                AND wposts.ID = wpostmeta3.post_id
                AND wpostmeta.meta_key = 'closed' AND wpostmeta.meta_value = '0'
                AND wpostmeta2.meta_key = 'enable_seats' AND wpostmeta2.meta_value = '0'
                AND wpostmeta3.meta_key = 'free_auction' AND wpostmeta3.meta_value = '0'
                AND wposts.post_status = 'publish'
                AND wposts.post_type = 'auction'
                ORDER BY wposts.post_date DESC
    	        LIMIT ".$limit;
    
     $pageposts = $wpdb->get_results($querystr, OBJECT);
     
     $i = 0; if ($pageposts):
     global $post;
     foreach ($pageposts as $post): 
     setup_postdata($post);
     PennyTheme_get_post();
     endforeach;
     else : ?> <?php $no_p = 1; ?>
       <div class="padd100"><p class="center"><?php _e("Sorry, there are no posted auction(s) yet","PennyTheme"); ?>.</p></div>
        
     <?php endif; ?>
     
     <div style="clear: both;">&nbsp;</div>

<?php } ?>

 <?php
if( get_option('show_free_auctions') ){
    
    if(get_option('PennyTheme_home_section4')){ 
        $text4 = get_option('PennyTheme_home_section4');
    }else{
        $text4 ='Free Auctions';
    } 
    echo '<div><h3 class="widget-title" style="border-bottom:1px solid">'.$text4.'</h3></div><br />';
    
    $limit = 24;
    $PennyTheme_home_page_nr_itms = get_option('PennyTheme_home_page_nr_itms');
    if(!empty($PennyTheme_home_page_nr_itms)) $limit = $PennyTheme_home_page_nr_itms;	
    
     global $wpdb;	
     $querystr = "
                SELECT DISTINCT wposts. *
                FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta, $wpdb->postmeta wpostmeta2 
                WHERE wposts.ID = wpostmeta.post_id
                AND wposts.ID = wpostmeta2.post_id
                AND wpostmeta.meta_key = 'closed' AND wpostmeta.meta_value = '0'
                AND wpostmeta2.meta_key = 'free_auction' AND wpostmeta2.meta_value = '1'
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
       <div class="padd100"><p class="center"><?php _e("Sorry, there are no free auction(s) yet","PennyTheme"); ?>.</p></div>
        
     <?php endif; ?>
 
 <?php } ?>
