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

function PennyTheme_display_show_all_cats()
{

	ob_start();
	
	global $current_user;
	get_currentuserinfo();
	$uid = $current_user->ID;
    
    if( get_option('PennyTheme_all_cats_id') == get_the_ID() ){
    		$PennyTheme_adv_code_cPT_page_above_content = stripslashes(get_option('PennyTheme_adv_code_cPT_page_above_content'));
    		if(!empty($PennyTheme_adv_code_cPT_page_above_content)):
    		
    			echo '<div class="full_width_a_div">';
    			echo $PennyTheme_adv_code_cPT_page_above_content;
    			echo '</div>';
    		
    		endif;	    
    }
	
?>	

	<div id="content">
			<div class="my_box3">
            	<div class="padd10">
            
            	<div class="box_title"><?php _e("All Categories",'PennyTheme'); ?></div>
                <div class="box_content">   

       <?php            
                    

		$terms 		= get_terms("auction_cat","parent=0&hide_empty=0");

		global $wpdb;
		$arr = array();
		
		$count = count($terms); $i = 0;
		if ( $count > 0 ){
			
			
		$nr = 4;

		//=========================================================================

		
		$total_count = 0;
		$arr = array();        
        global $wpdb;
		$contor = 0;


		 
		 $count = count($terms); $i = 0;
		 if ( $count > 0 ){
		     
		     foreach ( $terms as $term ) {
		       

			
			$stuffy = '';
			$cnt	= 1;
			
		       	$stuffy .= "<ul id='location-stuff'><li>";
			   	$terms2 = get_terms("auction_cat","parent=".$term->term_id."&hide_empty=0");
				

				$mese = '';
				
					$mese .= '<ul>';
					$link = get_term_link($term->slug,"auction_cat");
					$mese .= "<li class='top-mark'>
		       		<h3><a href='".$link."'>" . $term->name;
					
				
			   
			   $total_ads = PennyTheme_get_custom_taxonomy_count('auction',$term->slug);
			   
			   if($terms2)
				{
					$mese2 = '';
					foreach ( $terms2 as $term2 ) 
					{
						++$cnt;
						$tt = PennyTheme_get_custom_taxonomy_count('auction',$term2->slug);
		       			///$total_ads += $tt;
						$link = get_term_link($term2->slug,"auction_cat");
						$mese2 .= "<li><a href='".$link."'>" . $term2->name." ". ($show_me_count == true ? "(".$tt.")" : "")."</a></li>
						";
						
						
						$terms3 = get_terms("auction_cat","parent=".$term2->term_id."&hide_empty=0");
						
						if($terms3)
						{
							$mese2 .= '<ul class="baca_loc">';
							foreach ( $terms3 as $term3 ) 
							{
								++$cnt;
								$tt = PennyTheme_get_custom_taxonomy_count('auction',$term3->slug);
								///$total_ads += $tt;
								$link = get_term_link($term3->slug,"auction_cat");
								$mese2 .= "<li><a href='".$link."'>" . $term3->name." ". ($show_me_count == true ? "(".$tt.")" : "")."</a></li>
								";
							
							}
							$mese2 .= '</ul>';
						}
						
					}
				}
					
					$stuffy .= $mese.($show_me_count == true ? "(".$total_ads.")" : "") ."</a></h3></li>
					";
					$stuffy .= $mese2;
					
					$mese2 = '';
					
					$stuffy .= '</ul></li>
					';
				$stuffy .= '</ul>
				';
				
			   
			   	$i++;
		        $arr[$contor]['content'] 	= $stuffy;
				$arr[$contor]['size'] 		= $cnt;
				$total_count 		= $total_count + $cnt;
				$contor++;
		     }

		 }   
         
        //=======================================

		 $i = 0; $k = 0;
		 $result = array();
		 
		 foreach($arr as $category)
		 {			

			$result[$k] .= $category['content'];
			//echo $k." ";
			$k++;
				
			if($k == $nr) $k=0;
	
		 }
		
		 foreach($result as $res)
		 echo "<div class='stuffa4'>".$res.'</div>
		 
		 '; 
		 
		
		 
		} ?>
		
        
        
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