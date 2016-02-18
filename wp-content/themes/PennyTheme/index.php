

<?php
/***************************************************************************
*
*	PennyTheme - copyright (c) - sitemile.com
*
*	Coder: Andrei Dragos Saioc
*	Email: sitemile[at]sitemile.com | andreisaioc[at]gmail.com
*	More info about the theme here: http://sitemile.com/p/penny
*	since v4.4.7.1
*
***************************************************************************/



get_header();

//-----------------------------------------------

	$PennyTheme_adv_code_home_above_content = stripslashes(get_option('PennyTheme_adv_code_home_above_content'));
		if(!empty($PennyTheme_adv_code_home_above_content)):
		
			echo '<div class="full_width_a_div">';
			echo stripslashes($PennyTheme_adv_code_home_above_content);
			echo '</div>';
		
		endif;
		
//----------------------------------------------		
		
		if(PennyTheme_is_home())
		{
			$opt = get_option('PennyTheme_show_stretch');
			
			if(	$opt == "yes"):
								
				echo '<div class="stretch-area"><div class="padd10"><ul class="xoxo">';
				dynamic_sidebar( 'main-stretch-area' );
				echo '</ul></div></div>';	
				
			endif;	
		}	
		
		
		
		
		
		$PennyTheme_home_page_layout = get_option('PennyTheme_home_page_layout');
		
		if($PennyTheme_home_page_layout == "3" or $PennyTheme_home_page_layout == "4" ):
			
			    echo '<div id="left-sidebar">';
					echo '<ul class="xoxo">';
				 		dynamic_sidebar( 'home-left-widget-area' ); 
					echo '</ul>';
				   echo '</div>';
		
		endif;
		
		
		

?>
	
    

</div>
 <div class="content_div"><?php
    if( class_exists( 'MetaSliderPlugin' ) ){
        echo do_shortcode( get_post_field( 'post_content', get_option('PennyTheme_home_slider_page_id') ) );
    }  
?>	</div>
        <div id="main">

	<div id="content" style="width: 980px;">
    	<ul class="xoxo">
        	<li class="widget-container latest-posted-auctions-big">
        		<?php
				
					include 'latest-posted-auctions.php';
				
				?>
        	</li>
            
            <?php dynamic_sidebar( 'main-page-widget-area' ); ?>
            
        </ul>   
    </div>
    
    <!-- ############################ -->
    
   <?php if($PennyTheme_home_page_layout != "5" && $PennyTheme_home_page_layout != "4"): ?>
	
    <div id="right-sidebar">
		<ul class="xoxo">
	 <?php dynamic_sidebar( 'home-right-widget-area' ); ?>
		</ul>
       </div>

	<?php endif; ?>
    
    
    <?php
	
		if($PennyTheme_home_page_layout == "2" ):
			
			    echo '<div id="left-sidebar">';
					echo '<ul class="xoxo">';
				 		dynamic_sidebar( 'home-left-widget-area' ); 
					echo '</ul>';
				   echo '</div>';
		
		endif;
		
	
	?>
    
    

<?php get_footer(); ?>