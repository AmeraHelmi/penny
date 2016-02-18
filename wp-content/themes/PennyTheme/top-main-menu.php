<?php
		
			$PennyTheme_show_main_menu = get_option('PennyTheme_show_main_menu');
			if($PennyTheme_show_main_menu != 'no'):
		?>
        <div class="content_div">
      	<div class="main-thing-menu main_wrapper_menu">
        <?php
		
							$menu_name = 'primary-penny-main-header';
							if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
							$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
						
							$menu_items = wp_get_nav_menu_items($menu->term_id);
							$skl = ''; $mns = 0;
						
							foreach ( (array) $menu_items as $key => $menu_item ) {
								$title = $menu_item->title;
								$url = $menu_item->url;
								if(!empty($title)) {
								$skl .= '<li><a href="' . $url . '">' . $title . '</a></li>'; $mns++; }
							}
								
							}
							
		
		?>
        
        <ul> <?php
		
			if($mns == 0):
		
		?>
            <li class="padded_menu"><a href="<?php bloginfo('siteurl'); ?>" class="hm_cls"><?php _e('Home','PennyTheme'); ?></a></li>
            <li class="padded_menu"><a href="<?php echo get_permalink(get_option('PennyTheme_about_us_page_id')); ?>" class="hm_cls"><?php _e('About Us','PennyTheme'); ?></a></li>
            <li class="padded_menu"><a href="<?php echo get_permalink(get_option('PennyTheme_how_it_works_page_id')); ?>" class="hm_cls"><?php _e('How it works?','PennyTheme'); ?></a></li>
            <li><a href="<?php echo get_permalink(get_option('PennyTheme_all_cats_id')); ?>"><?php _e('Auction Categories','PennyTheme'); ?></a></li>
            <!--li><a href="<?php //echo get_post_type_archive_link('auction'); ?>"><?php //_e('All Auctions','PennyTheme'); ?></a></li--> 
            <li><a href="<?php echo PennyTheme_advanced_search_link(); ?>"><?php _e('Available Auctions','PennyTheme'); ?></a></li> 
            <li class="padded_menu"><a href="<?php echo get_permalink(get_option('PennyTheme_watch_list_id')); ?>" class="hm_cls"><?php _e('Watch List','PennyTheme'); ?></a></li>
            <li><a href="<?php echo get_permalink(get_option('PennyTheme_closed_auctions_page_id')); ?>"><?php _e('Recently Closed Auctions','PennyTheme'); ?></a></li>
            <li><a href="<?php echo get_permalink(get_option('PennyTheme_my_account_page_id')); ?>"><?php _e('My Account','PennyTheme'); ?></a></li>
            <li><a href="<?php echo get_permalink(get_option('PennyTheme_contact_us_page_id')); ?>"><?php _e('Contact Us','PennyTheme'); ?></a></li> 
       
            
              <?php
							endif;
							
							echo $skl;
							
							?>
                            
                       
            </ul>
        
        
        </div> </div>  
        
        <?php	
		else:
		//--------
		
		
		
		endif;	?>  