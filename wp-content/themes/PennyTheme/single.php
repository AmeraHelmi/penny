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


?>
<?php 

		if(function_exists('bcn_display'))
		{
		    echo '<div class="my_box3 breadcrumb-wrap"><div class="padd10">';	
		    bcn_display();
			echo '</div></div> ';
		}


	

?>	

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>



<div id="content">	
			<div class="my_box3">
            	<div class="padd10">
            
            	<div class="box_title"><?php  the_title(); ?></div>
                <div class="box_content post-content"> 


<?php the_content(); ?>			
<?php comments_template( '', true ); ?>

    </div>
			</div>
			</div>
            </div>
        

<?php endwhile; // end of the loop. ?>

<div id="right-sidebar">
    <ul class="xoxo">
        <?php dynamic_sidebar( 'single-widget-area' ); ?>
    </ul>
</div>

<?php get_footer(); ?>