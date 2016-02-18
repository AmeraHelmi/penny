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

	
	if(PennyTheme_is_home()):
	
	$PennyTheme_show_front_slider = get_option('PennyTheme_show_front_slider');
	if($PennyTheme_show_front_slider != "no"):

?>


    <div class="scr_bk"><div class="home_slider_inner">
    
    	<?php
					
				 global $wpdb;	
				 $querystr = "
					SELECT distinct wposts.* 
					FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta, $wpdb->postmeta wpostmeta2
					WHERE wposts.ID = wpostmeta.post_id AND
					wpostmeta.meta_key='closed' AND wpostmeta.meta_value='0'
					AND 
					
					wposts.ID = wpostmeta2.post_id AND
					wpostmeta2.meta_key='featured' AND wpostmeta2.meta_value='1'
					AND 
					
					wposts.post_status = 'publish' 
					AND wposts.post_type = 'auction' 
					ORDER BY wposts.post_date DESC LIMIT 5 ";
				
				 $pageposts = $wpdb->get_results($querystr, OBJECT);
				 $posts_per = 5;
				 ?>
					
					 <?php $i = 0; if ($pageposts): ?>
					 <?php global $post; ?>
                     <?php foreach ($pageposts as $post): ?>
                     <?php setup_postdata($post); ?>
                     
                     
                     <?php 

                      PennyTheme_slider_post();
                     
                     ?>
                     
                     
                     <?php endforeach; ?>
                  	
                  
                  	
                     <?php endif; ?>
        
        
    </div></div>



<?php endif; endif; ?>