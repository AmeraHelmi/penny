<?php
/***************************************************************************
*
*	PennyTheme - copyright (c) - sitemile.com

*	Coder: Andrei Dragos Saioc
*	Email: sitemile[at]sitemile.com | andreisaioc[at]gmail.com
*	More info about the theme here: http://sitemile.com/p/penny
*	since v4.4.7.1
*
***************************************************************************/
//$sql = "select seats from ".$wpdb->prefix."auctions_seats where pid='1' and uid = '1'";
//$res = $wpdb->get_results($sql);
//$row = $res[0];
//echo count($res);
//print_r($res);exit;
?>

	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes('xhtml'); ?> >
	<head>

	<title>
	<?php
		wp_title();
	?>
    </title>
    <style>
	.box_post
{
	border-right:1px solid transparent !important;
	box-shadow:0px 0px .3em #ccc;
}
ul.xoxo li{
	list-style:none !important;
	
	
	}
	ul.xoxo li a{
	text-decoration:none !important;
	
	}
	.logo-holder
{
	padding-left:0 !important;	
}

#main_header
{
	padding-top:0 !important;
	margin-bottom:0 !important;
}
.metaslider .caption {
padding: 15px 15px !important;
word-wrap: break-word;
position: absolute;
color: #000;
font-size: 3em;
font-weight: bold;
background: #ccc;
bottom: 300px;
left: 10px;
}
    
    </style>
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_enqueue_script("jquery"); ?>

	<?php

		wp_head();

	?>	

    <?php do_action('PennyTheme_before_head_tag_open'); ?>
     <script type="text/javascript" src="<?php echo get_bloginfo('template_url'); ?>/js/my-script.js"></script>
     <!-- ########################################### -->
     
             <script type="text/javascript">
			 
			 <?php
			 	
				global $wp_query, $wp_rewrite, $post;
				
				$watchlist_pid = get_option('PennyTheme_watch_list_id');
				
				if($post->ID == $watchlist_pid)
			 	$on_check_list = 1; else $on_check_list = 0;
				
			 
			 ?>
			 
			var SITE_URL 			= '<?php echo get_bloginfo('siteurl'); ?>';
			var is_on_check_list 	= '<?php echo $on_check_list; ?>';
			var minus_watchlist 	= "<?php echo __('Remove from watchlist','PennyTheme'); ?>";
			var plus_watchlist 		= "<?php echo __('Add to watchlist','PennyTheme'); ?>";
			var AUCTION_ENDED_THING = "<?php echo __('Auction Ended','PennyTheme'); ?>"; 
	function suggest(inputString){
	
		if(inputString.length == 0) {
			$('#suggestions').fadeOut();
		} else {  
		$('#big-search').addClass('load');
			$.post("<?php bloginfo('siteurl'); ?>/wp-admin/admin-ajax.php?action=autosuggest_it", {queryString: ""+inputString+""}, function(data){
				
				var stringa = data.charAt(data.length-1);
								if(stringa == '0') data = data.slice(0, -1);
								else data = data.slice(0, -2);
				
				
				if(data.length >0) {
					$('#suggestions').fadeIn();
					$('#suggestionsList').html(data);
					$('#big-search').removeClass('load');
				}
			});
		}
	}

	function fill(thisValue) {
		$('#big-search').val(thisValue);
		setTimeout("$('#suggestions').fadeOut();", 600);
	}
	 
	/*
	$(function(){
	  $('#slider2').bxSlider({
		auto: true,
		speed: 1000,
		pause: 5000,
		autoControls: false,
		 displaySlideQty: 5,
    	moveSlideQty: 1
	  });
	});	 */
		
	</script>
     <?php
	 	
		$PennyTheme_color_for_footer = get_option('PennyTheme_color_for_footer');
		if(!empty($PennyTheme_color_for_footer))
		{
			echo '<style> #footer { background:#'.$PennyTheme_color_for_footer.' }</style>';	
		}
		
		
		$PennyTheme_color_for_bk = get_option('PennyTheme_color_for_bk');
		if(!empty($PennyTheme_color_for_bk))
		{
			echo '<style> body { background:#'.$PennyTheme_color_for_bk.' }</style>';	
		}
		
		$PennyTheme_color_for_top_links = get_option('PennyTheme_color_for_top_links');
		$PennyTheme_color_for_top_links2 = get_option('PennyTheme_color_for_top_links2');
		
		if(!empty($PennyTheme_color_for_top_links))
		{
			echo '<style> .top-links ul li a:link, .top-links ul li a:visited { background:#'.$PennyTheme_color_for_top_links.' }
			.top-links ul li a:hover { background:#'.$PennyTheme_color_for_top_links2.' }
			
			</style>';	
		}
		
		//----------------------
		
		$PennyTheme_color_for_main_links = get_option('PennyTheme_color_for_main_links');
		$PennyTheme_color_for_main_links2 = get_option('PennyTheme_color_for_main_links2');
		
		if(!empty($PennyTheme_color_for_main_links))
		{
			echo '<style> 
			
			.main-thing-menu{ background:#'.$PennyTheme_color_for_main_links.' }
			.main-thing-menu ul li a:link, .main-thing-menu ul li a:visited { background:#'.$PennyTheme_color_for_main_links.' }
			.main-thing-menu ul li a:hover { background:#'.$PennyTheme_color_for_main_links2.' }
			
			</style>';	
		}
		
		//----------------------
		
		
		$PennyTheme_color_for_slider_bg = get_option('PennyTheme_color_for_slider_bg');
		
		if(!empty($PennyTheme_color_for_slider_bg))
		{
			echo '<style> 
			
			.scr_bk{ background:#'.$PennyTheme_color_for_slider_bg.' }
		 
			</style>';	
		}
		
		//----------------------
		
		$PennyTheme_color_for_text_footer = get_option('PennyTheme_color_for_text_footer');
		
		if(!empty($PennyTheme_color_for_text_footer))
		{
			echo '<style> 
			
			#footer-widget-area,#site-info, #footer-widget-area div ul li .widget-title, #footer .textwidget{ color:#'.$PennyTheme_color_for_text_footer.' }
			#footer a:link, #footer a:visited { color:#'.$PennyTheme_color_for_text_footer.' }
			#footer a:hover { color:#'.$PennyTheme_color_for_text_footer.' }
			#site-info { border-color: #'.$PennyTheme_color_for_text_footer.'  }
			
			</style>';	
		}
		
		
		
		//----------------------
		
	 	$PennyTheme_home_page_layout = get_option('PennyTheme_home_page_layout');
		if(PennyTheme_is_home()):
			if($PennyTheme_home_page_layout == "4"):
				echo '<style>#content { float:right; width:695px } #left-sidebar { float:left; }</style>';
			endif;
			
			if($PennyTheme_home_page_layout == "5"):
				echo '<style>#content { width:100%; }  </style>';
			endif;
			
			if($PennyTheme_home_page_layout == "3"):
				echo '<style>#content { width:410px } .title_holder { width:257px; margin-bottom:15px } #left-sidebar{	float:left;margin-right:15px;}
				 </style>';
			endif;
			
			
			if($PennyTheme_home_page_layout == "2"):
				echo '<style>#content { width:410px } #left-sidebar{ float:right } #left-sidebar{ margin-right:15px; } .title_holder { width:257px; margin-bottom:15px }
				 </style>';
			endif;
		
		endif;
	 
	 
	 ?>
     
     <!-- ########################################## -->
     
	</head>
	<body <?php body_class(); ?> >
    
    
  <?php  
    
    global $default_search;
		
		?>

        
		<div id="header">
			<div class="top-bar-bg">
			
					
			
			
            <div class="content_div">
            
            <div class="rss_icon_div"><a href="<?php bloginfo('siteurl') ?>/?feed=rss2&post_type=auction"><img src="<?php bloginfo('template_url') ?>/images/rss_icon.png" width="20" height="20" /></a></div>
            
            <div class="top-links">
							
                            <ul>
							<?php 
								
								if(current_user_can('level_10')) {?> <li><a href="<?php bloginfo('siteurl'); ?>/wp-admin"><?php 
								echo __("Wp-Admin","PennyTheme"); ?></a></li> <?php }
							
								if(is_home())
								$home_class_active = 'active';	
								
								global $wp_query, $pagenow;
								$vars = $wp_query->query_vars;
								$special_page = $vars['special_page'];
								
								if($special_page == "post-new") 	$post_new_class 	= 'active';	
								if($special_page == "adv-sea") 		$adv_sea_new_class 	= 'active';
								if($special_page == "account") 		$account_new_class 	= 'active';
								if($special_page == "blog") 		$blog_new_class 	= 'active';	
								if($special_page == "watch") 		$watch_class 		= 'active';									
								if($pagenow == "wp-login.php") 		$class_log 			= "active";	
								if($pagenow == "wp-register.php") 	$class_register 	= "active";	
								
								
									$PennyTheme_show_blue_menu = get_option('PennyTheme_show_main_menu');
									
									if($PennyTheme_show_blue_menu != "yes"):
							?>
							
							<li><a href="<?php bloginfo('siteurl') ?>" class="<?php echo $home_class_active; ?>"><?php echo __("Home","PennyTheme"); ?></a> </li>
                            
                            
                            <?php
							
							endif;
							
							$menu_name = 'primary-pennytheme-header';

							if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
							$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
						
							$menu_items = wp_get_nav_menu_items($menu->term_id);
					
						
							foreach ( (array) $menu_items as $key => $menu_item ) {
								$title = $menu_item->title;
								$url = $menu_item->url;
								if(!empty($title))
								echo '<li><a href="' . $url . '">' . $title . '</a></li>';
							}
								
							}
							
							
							?>
                            <li><a class="<?php echo $watch_class; ?>" href="<?php echo PennyTheme_watch_list(); ?>"><?php echo __("Watch List","PennyTheme"); ?></a> </li>
                            
							
							<?php if(get_option('auctionTheme_enable_blog') == "yes") { ?>
                            <li><a class="<?php echo $blog_new_class; ?>" href="<?php echo PennyTheme_blog_link(); ?>"><?php echo __("Blog","PennyTheme"); ?></a> </li>
							<?php } ?>
                            
                            <?php
							
							if($PennyTheme_show_blue_menu != "yes"):
							
							?>
                            
                         
                         
							<?php
							
								endif;
							
								if(is_user_logged_in())
								{
								
									global $current_user;
									get_currentuserinfo();
									$user = $current_user->user_login;
									?>
									
							<li><a href="<?php echo PennyTheme_my_account_link(); ?>" 
                            class="<?php echo $account_new_class; ?>"><?php echo __("MyAccount","PennyTheme"); ?> - <?php echo $user; ?></a></li>
							<li><a href="<?php echo wp_logout_url(); ?>"><?php echo __("Log Out","PennyTheme"); ?></a></li>
									
									<?php
								}
								else
									{
										
							
							?>
							
							<li><a class="<?php echo $class_register; ?>" href="<?php bloginfo('siteurl') ?>/wp-login.php?action=register"><?php echo __("Register","PennyTheme"); ?></a></li>
							<li><a class="<?php echo $class_log; ?>" href="<?php bloginfo('siteurl') ?>/wp-login.php"><?php echo __("Log In","PennyTheme"); ?></a></li>
							<?php } ?>
                            
                            </ul>
						</div>
            
            
            </div>
			</div> <!-- end top-bar-bg -->
		
			<div class="middle-header-bg">
				<div class="content_div" id="main_header">
						<div class="logo-holder">
                       
						<?php
							$logo = get_option('PennyTheme_logo_url');
							if(empty($logo)) $logo = get_bloginfo('template_url').'/images/logo.png';
						?>
						<a href="<?php bloginfo('siteurl'); ?>"><img id="logo" alt="<?php bloginfo('name'); ?> <?php bloginfo('description'); ?>" src="<?php echo $logo; ?>" /></a>
						</div>
                        
                        
                        <div id="suggest" >
                            <form method="get" action="<?php echo PennyTheme_advanced_search_link(); ?>/">
                            <?php
							
							if(PennyTheme_using_permalinks() == false)
							echo '<input type="hidden" value="'.get_option('PennyTheme_adv_search_id').'" name="page_id" />';
							
							?>
                            <input type="text"  id="big-search" name="term" autocomplete="off" onkeyup="suggest(this.value);" 
                              value="<?php if(isset($_GET['term'])) echo $_GET['term']; else echo $default_search; ?>" />
                         
                            <input type="image" id="srch_icon"  name="search_me" src="<?php bloginfo('template_url'); ?>/images/srch.png" />
                            </form>
                            
                            <div class="suggestionsBox" id="suggestions" style="z-index:999;display: none;"> 
                            <img src="<?php echo get_bloginfo('template_url');?>/images/arrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
                            <div class="suggestionList" id="suggestionsList"> &nbsp; </div>
                            </div>
                    	</div>
                      

                        
				</div>
				
			</div> <!-- middle-header-bg A6E6CF 000705 -->
            
			
			
		</div>
        
        <?php include 'top-main-menu.php'; ?>
       
         
        <?php include 'home-slider.php'; ?>
       
        
        
        
        <div id="main">

        