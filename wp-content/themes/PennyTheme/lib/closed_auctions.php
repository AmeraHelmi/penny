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

function PennyTheme_display_closed_auctions()
{

	ob_start();
	
	global $current_user;
	get_currentuserinfo();
	$uid = $current_user->ID;


?>	


<div id="content">


<div class="my_box3">
            	<div class="padd10">
            
            	<div class="box_title"><?php _e("Closed Auctions",'PennyTheme'); ?></div>
                <div class="box_content">    
			
			
				<?php

				global $wp_query;
				$query_vars = $wp_query->query_vars;
				$post_per_page = 5;				
				$paged = $query_vars['paged'];
				
				$closed = array(
					'key' => 'closed',
					'value' => "1",
					//'type' => 'numeric',
					'compare' => '='
				);
				
				
				
				
				$args = array( 'posts_per_page' => 5, 'paged' => $paged, 'post_type' => 'auction', 
				'order' => 'DESC' , 'meta_query' => array($closed) ,'orderby'=>'ID');
				$the_query = new WP_Query( $args );
				
		
				
				if($the_query->have_posts()):
				while ( $the_query->have_posts() ) : $the_query->the_post();
					
					PennyTheme_get_post_big();
			
					
				endwhile;
				
				if(function_exists('wp_pagenavi')):
				wp_pagenavi(array( 'query' => $the_query )); endif;
				
				 else:
				
				_e("There are no auctions yet.",'PennyTheme');
				
				endif;
				
				wp_reset_query();
				
				?>
			
			
			</div>
			</div>
			</div>
			
            
            </div>

		
        <div id="right-sidebar">
    <ul class="xoxo">
        <?php dynamic_sidebar( 'single-widget-area' ); ?>
    </ul>
</div>
        
        
<?php

	 
	
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
	
}

?>