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

global $query_string;
	
$closed = array(
		'key' => 'closed',
		'value' => "0",
		//'type' => 'numeric',
		'compare' => '='
);
	
$prs_string_qu = wp_parse_args($query_string);
$prs_string_qu['meta_query'] = array($closed);
		
query_posts($prs_string_qu);

$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
$term_title = $term->name;
			
//======================================================

	get_header();
	
	$PennyTheme_adv_code_cat_page_above_content = stripslashes(get_option('PennyTheme_adv_code_cat_page_above_content'));
		if(!empty($PennyTheme_adv_code_cat_page_above_content)):
		
			echo '<div class="full_width_a_div">';
			echo $PennyTheme_adv_code_cat_page_above_content;
			echo '</div>';
		
		endif;
	

?>

<?php 

		if(function_exists('bcn_display'))
		{
		    echo '<div class="my_box3 breadcrumb-wrap"><div class="padd10">';	
		    bcn_display();
			echo '</div></div>';
		}

?>	

<div id="content">

<div class="my_box3">
            	<div class="padd10">            
            	<div class="box_title"><?php
						if(empty($term_title)) echo __("All Posted Items",'PennyTheme');
						else { echo sprintf( __("Latest Posted Items in %s",'PennyTheme'), $term_title);
						
						?>
                        
                        <a href="<?php bloginfo('siteurl'); ?>/?feed=rss2&<?php echo get_query_var( 'taxonomy' ); ?>=<?php echo get_query_var( 'term' ); ?>"><img src="<?php bloginfo('template_url'); ?>/images/rss_icon.png" 
                    border="0" width="19" height="19" alt="rss icon" /></a>
                        
                        <?php
						
						}
					?>
            		
            		
            		
            	</div> 
				<div class="box_content"> 

<?php if ( have_posts() ): while ( have_posts() ) : the_post(); ?>

<?php PennyTheme_get_post(); ?>

<?php  
 		endwhile; 
		
		if(function_exists('wp_pagenavi')):
		wp_pagenavi(); endif;
		                             
     	else:
		
		echo __('No items posted.',"PennyTheme");
		
		endif;
		// Reset Post Data
		wp_reset_postdata();
		 
		?>


</div></div></div></div>


<div id="right-sidebar">
    <ul class="xoxo">
        <?php dynamic_sidebar( 'other-page-area' ); ?>
    </ul>
</div>


<?php

	get_footer();

?>