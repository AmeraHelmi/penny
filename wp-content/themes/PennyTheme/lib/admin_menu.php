<?php
ob_start();
/********************************************************************
*
*	Penny Auction Theme for WordPress - sitemile.com
*	http://sitemile.com/products/wordpress-penny-auction-theme/
*	Copyright (c) 2012 sitemile.com
*	Coder: Saioc Dragos Andrei
*	Email: andreisaioc@gmail.com
*
*********************************************************************/


function PennyTheme_theme_bullet($rn = '')
{
	global $menu_admin_PennyTheme_theme_bull;
	$menu_admin_PennyTheme_theme_bull = '<a href="#" class="tltp_cls" title="'.$rn.'"><img src="'.get_bloginfo('template_url') . '/images/qu_icon.png" /></a>';	
	echo $menu_admin_PennyTheme_theme_bull;
	
}

function PennyTheme_disp_spcl_cst_pic($pic)
{
	return '<img src="'.get_bloginfo('template_url').'/images/'.$pic.'" />';	
}

function PennyTheme_admin_main_menu_scr()
{
	$icn = get_bloginfo('template_url').'/images/auctionicon.gif';
	$capability = 10;
	 
	add_menu_page(__('PennyTheme'), __('PennyTheme','PennyTheme'), $capability,"PT_menu_", 'PennyTheme_site_summary', $icn, 0); 
	add_submenu_page("PT_menu_", __('Site Summary','PennyTheme'), PennyTheme_disp_spcl_cst_pic('overview_icon.png').__('Site Summary','PennyTheme'),$capability, "PT_menu_", 'PennyTheme_site_summary');
	add_submenu_page("PT_menu_", __('General Options','PennyTheme'), PennyTheme_disp_spcl_cst_pic('setup_icon.png').__('General Options','PennyTheme'),$capability, "general-options", 'PennyTheme_general_options'); 
	add_submenu_page("PT_menu_", __('Email Settings','PennyTheme'), PennyTheme_disp_spcl_cst_pic('email_icon.png').__('Email Settings','PennyTheme'),$capability, 'PT_email_set_', 'PennyTheme_email_settings');
	add_submenu_page("PT_menu_", __('Pricing Settings','PennyTheme'), PennyTheme_disp_spcl_cst_pic('dollar_icon.png').__('Pricing Settings','PennyTheme'),$capability, 'PT_pr_set_', 'PennyTheme_pricing_options');
	add_submenu_page("PT_menu_", __('Payment Gateways','PennyTheme'),PennyTheme_disp_spcl_cst_pic('gateway_icon.png'). __('Payment Gateways','PennyTheme'),$capability, 'PT_pay_gate_', 'PennyTheme_payment_gateways');
	add_submenu_page('PT_menu_', __('User Balances','PennyTheme'), PennyTheme_disp_spcl_cst_pic('bal_icon.png').__('User Balances','PennyTheme'),'10', 'PT_user_bal_', 'PennyTheme_user_balances');
	add_submenu_page("PT_menu_", __('InSite Transactions','PennyTheme'), PennyTheme_disp_spcl_cst_pic('list_icon.png').__('InSite Transactions','PennyTheme'),$capability, 'trans-sites', 'PennyTheme_hist_transact');
	add_submenu_page("PT_menu_", __('Orders','PennyTheme'), PennyTheme_disp_spcl_cst_pic('orders_icon.png').__('Orders','PennyTheme'),$capability, 'PT_orders_', 'PennyTheme_orders_main_screen');
	add_submenu_page("PT_menu_", __('Layout Settings','PennyTheme'), PennyTheme_disp_spcl_cst_pic('layout_icon.png').__('Layout Settings','PennyTheme'),$capability, 'PT_layout_', 'PennyTheme_layout_settings');
	add_submenu_page("PT_menu_", __('Advertising','PennyTheme'), PennyTheme_disp_spcl_cst_pic('adv_icon.png').__('Advertising','PennyTheme'),$capability, 'PT_adv_', 'PennyTheme_advertising_scr');
	add_submenu_page("PT_menu_", __('Tracking Tools','PennyTheme'), PennyTheme_disp_spcl_cst_pic('track_icon.png').__('Tracking Tools','PennyTheme'),$capability, 'PT_trck_', 'PennyTheme_tracking_tools_panel');
	add_submenu_page("PT_menu_", __('Info Stuff','PennyTheme'), PennyTheme_disp_spcl_cst_pic('info_icon.png').__('Info Stuff','PennyTheme'),$capability, 'PT_info_stuff', 'PennyTheme_info'); 
}


function PennyTheme_hist_transact()
{
		echo '<div class="wrap">';
	echo '<div class="icon32" id="icon-options-general"><br/></div>';	
	echo '<h2>PennyTheme Transaction History</h2>';
	
	echo '<div class="padding10">';
	
	
		global $wpdb;
	$s = "select * from ".$wpdb->prefix."penny_payment_transactions order by id desc";
	$r = $wpdb->get_results($s);
	
	if(count($r) > 0) {
	
?>	
	
    
        <table class="widefat post fixed" cellspacing="0">
    <thead>
    <tr>
    <th width="10%">Username</th>
    <th width="40%">Comment/Description</th>
    <th>Date Made</th>
    <th >Amount</th>
	<th >Auction</th>
    </tr>
    </thead>
    
    
    
    <tbody>


	<?php

	
	foreach($r as $row)
	{
		$user = get_userdata($row->uid);
		
		if($row->tp == 0) { $sign = '-'; $cl = 'redred'; }
		else
		{ $sign = '+'; $cl = 'greengreen'; }
		
		echo '<tr>';	
		echo '<th>'.$user->user_login.'</th>';
		echo '<th>'.$row->reason .'</th>';
		echo '<th>'.date('d-M-Y H:i:s',$row->datemade) .'</th>';
		echo '<th class="'.$cl.'">'.$sign.PennyTheme_get_show_price($row->amount,2).'</th>';
		echo '<th>#</th>';
	
		echo '</tr>';
	}
	
	?>



	</tbody></table>	
	<?php
	
	
	} else _e('Sorry there are no transactions yet.','PennyTheme'); echo '</div>';
}

function PennyTheme_email_settings()
{
	
	$id_icon 		= 'icon-options-general-email';
	$ttl_of_stuff 	= 'PennyTheme - '.__('Email Settings','PennyTheme');
	global $menu_admin_PennyTheme_theme_bull;
	$arr = array( "yes" => 'Yes', "no" => "No");
	
	
		
	echo '<div class="wrap">';
	echo '<div class="icon32" id="'.$id_icon.'"><br/></div>';	
	echo '<h2 class="my_title_class_sitemile">'.$ttl_of_stuff.'</h2>';	
	
	//--------------------------------------------------------------------------
	
	if(isset($_POST['PennyTheme_save1']))
	{
		update_option('PennyTheme_email_name_from', 	trim($_POST['PennyTheme_email_name_from']));
		update_option('PennyTheme_email_addr_from', 	trim($_POST['PennyTheme_email_addr_from']));
		update_option('PennyTheme_allow_html_emails', trim($_POST['PennyTheme_allow_html_emails']));
        		
		echo '<div class="saved_thing">'.__('Settings saved!','PennyTheme').'</div>';		
	}
	
	if(isset($_POST['PennyTheme_save2']))
	{
		update_option('PennyTheme_new_user_email_subject', 	trim($_POST['PennyTheme_new_user_email_subject']));
		update_option('PennyTheme_new_user_email_message', 	trim($_POST['PennyTheme_new_user_email_message']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','PennyTheme').'</div>';		
	}
	
	if(isset($_POST['PennyTheme_save_new_user_email_admin']))
	{
		update_option('PennyTheme_new_user_email_admin_subject', 	trim($_POST['PennyTheme_new_user_email_admin_subject']));
		update_option('PennyTheme_new_user_email_admin_message', 	trim($_POST['PennyTheme_new_user_email_admin_message']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','PennyTheme').'</div>';		
	}
	
		if(isset($_POST['PennyTheme_save3']))
	{
		update_option('PennyTheme_new_item_email_not_approve_admin_enable', 	trim($_POST['PennyTheme_new_item_email_not_approve_admin_enable']));
		update_option('PennyTheme_new_item_email_not_approve_admin_subject', 	trim($_POST['PennyTheme_new_item_email_not_approve_admin_subject']));
		update_option('PennyTheme_new_item_email_not_approve_admin_message', 	trim($_POST['PennyTheme_new_item_email_not_approve_admin_message']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','PennyTheme').'</div>';		
	}

	if(isset($_POST['PennyTheme_save31']))
	{
		update_option('PennyTheme_new_item_email_approve_admin_enable', 	trim($_POST['PennyTheme_new_item_email_approve_admin_enable']));
		update_option('PennyTheme_new_item_email_approve_admin_subject', 	trim($_POST['PennyTheme_new_item_email_approve_admin_subject']));
		update_option('PennyTheme_new_item_email_approve_admin_message', 	trim($_POST['PennyTheme_new_item_email_approve_admin_message']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','PennyTheme').'</div>';		
	}
	
	if(isset($_POST['PennyTheme_save32']))
	{
		update_option('PennyTheme_new_item_email_not_approved_enable', 	trim($_POST['PennyTheme_new_item_email_not_approved_enable']));
		update_option('PennyTheme_new_item_email_not_approved_subject', 	trim($_POST['PennyTheme_new_item_email_not_approved_subject']));
		update_option('PennyTheme_new_item_email_not_approved_message', 	trim($_POST['PennyTheme_new_item_email_not_approved_message']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','PennyTheme').'</div>';		
	}
	
	if(isset($_POST['PennyTheme_save33']))
	{
		update_option('PennyTheme_new_item_email_approved_enable', 	trim($_POST['PennyTheme_new_item_email_approved_enable']));
		update_option('PennyTheme_new_item_email_approved_subject', 	trim($_POST['PennyTheme_new_item_email_approved_subject']));
		update_option('PennyTheme_new_item_email_approved_message', 	trim($_POST['PennyTheme_new_item_email_approved_message']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','PennyTheme').'</div>';		
	}
	
	if(isset($_POST['PennyTheme_bid_item_bidder_email_save']))
	{
		update_option('PennyTheme_bid_item_bidder_email_enable', 	trim($_POST['PennyTheme_bid_item_bidder_email_enable']));
		update_option('PennyTheme_bid_item_bidder_email_subject', 	trim($_POST['PennyTheme_bid_item_bidder_email_subject']));
		update_option('PennyTheme_bid_item_bidder_email_message', 	trim($_POST['PennyTheme_bid_item_bidder_email_message']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','PennyTheme').'</div>';		
	}
	
	if(isset($_POST['PennyTheme_bid_item_owner_email_save']))
	{
		update_option('PennyTheme_bid_item_owner_email_enable', 	trim($_POST['PennyTheme_bid_item_owner_email_enable']));
		update_option('PennyTheme_bid_item_owner_email_subject', 	trim($_POST['PennyTheme_bid_item_owner_email_subject']));
		update_option('PennyTheme_bid_item_owner_email_message', 	trim($_POST['PennyTheme_bid_item_owner_email_message']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','PennyTheme').'</div>';		
	}
	
	if(isset($_POST['PennyTheme_priv_mess_received_email_save']))
	{
		update_option('PennyTheme_priv_mess_received_email_enable', 	trim($_POST['PennyTheme_priv_mess_received_email_enable']));
		update_option('PennyTheme_priv_mess_received_email_subject', 	trim($_POST['PennyTheme_priv_mess_received_email_subject']));
		update_option('PennyTheme_priv_mess_received_email_message', 	trim($_POST['PennyTheme_priv_mess_received_email_message']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','PennyTheme').'</div>';		
	}
	
	if(isset($_POST['PennyTheme_completed_auction_bidder_email_save']))
	{
		update_option('PennyTheme_completed_auction_bidder_email_enable', 	trim($_POST['PennyTheme_completed_auction_bidder_email_enable']));
		update_option('PennyTheme_completed_auction_bidder_email_subject', 	trim($_POST['PennyTheme_completed_auction_bidder_email_subject']));
		update_option('PennyTheme_completed_auction_bidder_email_message', 	trim($_POST['PennyTheme_completed_auction_bidder_email_message']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','PennyTheme').'</div>';		
	}
	
	if(isset($_POST['PennyTheme_rated_user_email_save']))
	{
		update_option('PennyTheme_rated_user_email_enable', 	trim($_POST['PennyTheme_rated_user_email_enable']));
		update_option('PennyTheme_rated_user_email_subject', 	trim($_POST['PennyTheme_rated_user_email_subject']));
		update_option('PennyTheme_rated_user_email_message', 	trim($_POST['PennyTheme_rated_user_email_message']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','PennyTheme').'</div>';		
	}
	
	if(isset($_POST['PennyTheme_completed_auction_owner_email_save']))
	{
		update_option('PennyTheme_completed_auction_owner_email_enable', 		trim($_POST['PennyTheme_completed_auction_owner_email_enable']));
		update_option('PennyTheme_completed_auction_owner_email_subject', 	trim($_POST['PennyTheme_completed_auction_owner_email_subject']));
		update_option('PennyTheme_completed_auction_owner_email_message', 	trim($_POST['PennyTheme_completed_auction_owner_email_message']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','PennyTheme').'</div>';		
	}
	
	if(isset($_POST['PennyTheme_delivered_auction_owner_email_save']))
	{
		update_option('PennyTheme_delivered_auction_owner_email_enable', 		trim($_POST['PennyTheme_delivered_auction_owner_email_enable']));
		update_option('PennyTheme_delivered_auction_owner_email_subject', 	trim($_POST['PennyTheme_delivered_auction_owner_email_subject']));
		update_option('PennyTheme_delivered_auction_owner_email_message', 	trim($_POST['PennyTheme_delivered_auction_owner_email_message']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','PennyTheme').'</div>';		
	}
	
	
	if(isset($_POST['PennyTheme_delivered_auction_bidder_email_save']))
	{
		update_option('PennyTheme_delivered_auction_bidder_email_enable', 	trim($_POST['PennyTheme_delivered_auction_bidder_email_enable']));
		update_option('PennyTheme_delivered_auction_bidder_email_subject', 	trim($_POST['PennyTheme_delivered_auction_bidder_email_subject']));
		update_option('PennyTheme_delivered_auction_bidder_email_message', 	trim($_POST['PennyTheme_delivered_auction_bidder_email_message']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','PennyTheme').'</div>';		
	}
	
	if(isset($_POST['PennyTheme_won_item_owner_email_save']))
	{
		update_option('PennyTheme_won_item_owner_email_enable', 	trim($_POST['PennyTheme_won_item_owner_email_enable']));
		update_option('PennyTheme_won_item_owner_email_subject', 	trim($_POST['PennyTheme_won_item_owner_email_subject']));
		update_option('PennyTheme_won_item_owner_email_message', 	trim($_POST['PennyTheme_won_item_owner_email_message']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','PennyTheme').'</div>';		
	}
	
	if(isset($_POST['PennyTheme_won_item_winner_email_save']))
	{
		update_option('PennyTheme_won_item_winner_email_enable', 	trim($_POST['PennyTheme_won_item_winner_email_enable']));
		update_option('PennyTheme_won_item_winner_email_subject', 	trim($_POST['PennyTheme_won_item_winner_email_subject']));
		update_option('PennyTheme_won_item_winner_email_message', 	trim($_POST['PennyTheme_won_item_winner_email_message']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','PennyTheme').'</div>';		
	}
	
	if(isset($_POST['PennyTheme_won_item_loser_email_save']))
	{
		update_option('PennyTheme_won_item_loser_email_enable', 	trim($_POST['PennyTheme_won_item_loser_email_enable']));
		update_option('PennyTheme_won_item_loser_email_subject', 	trim($_POST['PennyTheme_won_item_loser_email_subject']));
		update_option('PennyTheme_won_item_loser_email_message', 	trim($_POST['PennyTheme_won_item_loser_email_message']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','PennyTheme').'</div>';		
	}
	
	//-------------------
	
	$arr_me_to = array('bids_purchase_user','bids_purchase_admin','item_purchase_user','item_purchase_admin', 'free_credit_empty', 'seats_purchase_user', 'seats_purchase_admin', 'reserve_not_met_user', 'reserve_not_met_admin');
	
	foreach ($arr_me_to as $amaz)
	{
		if(isset($_POST['PennyTheme_'.$amaz.'_email_save']))
		{
			update_option('PennyTheme_'.$amaz.'_email_enable', 		trim($_POST['PennyTheme_'.$amaz.'_email_enable']));
			update_option('PennyTheme_'.$amaz.'_email_subject', 	trim($_POST['PennyTheme_'.$amaz.'_email_subject']));
			update_option('PennyTheme_'.$amaz.'_email_message', 	trim($_POST['PennyTheme_'.$amaz.'_email_message']));
			
			echo '<div class="saved_thing">'.__('Settings saved!','PennyTheme').'</div>';		
			break;
		}
	}
	

	do_action('PennyTheme_save_emails_post');
	
	?>
    
	<div id="usual2" class="usual"> 
        <ul> 
            <li><a href="#tabs1"><?php _e('Email Settings','PennyTheme'); ?></a></li> 
            <li><a href="#new_user_email"><?php _e('New User Email','PennyTheme'); ?></a></li>
            <li><a href="#admin_new_user_email"><?php _e('New User Email (admin)','PennyTheme'); ?></a></li>
            <li><a href="#bids_purchase_user"><?php _e('Bids Purchase (user)','PennyTheme'); ?></a></li>
            <li><a href="#bids_purchase_admin"><?php _e('Bids Purchase (admin)','PennyTheme'); ?></a></li>
            
            <li><a href="#seats_purchase_user"><?php _e('Seats Purchase (user)','PennyTheme'); ?></a></li>
            <li><a href="#seats_purchase_admin"><?php _e('Seats Purchase (admin)','PennyTheme'); ?></a></li>
            
            <li><a href="#reserve_not_met_user"><?php _e('Reserve Not Met (user)','PennyTheme'); ?></a></li>
            <li><a href="#reserve_not_met_admin"><?php _e('Reserve Not Met (admin)','PennyTheme'); ?></a></li>
            
            <li><a href="#item_purchase_user"><?php _e('Item Purchase (user)','PennyTheme'); ?></a></li>
            <li><a href="#item_purchase_admin"><?php _e('Item Purchase (admin)','PennyTheme'); ?></a></li>
            <li><a href="#free_credit_empty_user"><?php _e('Free Auction Bid Assistant Credit Zero (user)','PennyTheme'); ?></a></li>

            <?php do_action('PennyTheme_save_emails_tabs'); ?>
            
        </ul> 
        
        
       <div id="tabs1" style="display: none; ">
        	<form method="post" action="<?php bloginfo('siteurl'); ?>/wp-admin/admin.php?page=PT_email_set_&active_tab=tabs1">
            <table width="100%" class="sitemile-table">
    				
                    <tr>
                    <td valign=top width="22"><?php PennyTheme_theme_bullet(); ?></td>
                    <td width="160">Email From Name:</td>
                    <td><input type="text" size="45" name="PennyTheme_email_name_from" value="<?php echo stripslashes(get_option('PennyTheme_email_name_from')); ?>"/></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php PennyTheme_theme_bullet(); ?></td>
                    <td >Email From Address:</td>
                    <td><input type="text" size="45" name="PennyTheme_email_addr_from" value="<?php echo stripslashes(get_option('PennyTheme_email_addr_from')); ?>"/></td>
                    </tr>
                    
                    
                    <tr>
                    <td valign=top width="22"><?php PennyTheme_theme_bullet(); ?></td>
                    <td >Allow HTML in emails:</td>
                    <td><?php echo PennyTheme_get_option_drop_down($arr, 'PennyTheme_allow_html_emails'); ?></td>
                    </tr>
                    
        
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="PennyTheme_save1" value="<?php _e('Save Options','PennyTheme'); ?>"/></td>
                    </tr>
            
            </table>      
          	</form>
        </div> 
          
        <!-- ################################ -->  
                
        <div id="new_user_email" style="display: none; ">
        	<div class="spntxt_bo"><?php _e('This email will be received by all new users who register on your website. 
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','PennyTheme'); ?> </div>
          
          
          <form method="post" action="<?php bloginfo('siteurl'); ?>/wp-admin/admin.php?page=PT_email_set_&active_tab=new_user_email">
            <table width="100%" class="sitemile-table">
    		
            	  	<tr>
                    <td valign=top width="22"><?php PennyTheme_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','PennyTheme'); ?></td>
                    <td><input type="text" size="90" name="PennyTheme_new_user_email_subject" value="<?php echo stripslashes(get_option('PennyTheme_new_user_email_subject')); ?>"/></td>
                    </tr>
                    

                    
                    <tr>
                    <td valign=top><?php PennyTheme_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','PennyTheme'); ?></td>
                    <td><textarea cols="92" rows="10" name="PennyTheme_new_user_email_message"><?php echo stripslashes(get_option('PennyTheme_new_user_email_message')); ?></textarea></td>
                    </tr>
                    
                    
                    
                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','PennyTheme'); ?><br/><br/>
                    
                    <strong>##username##</strong> - <?php _e("your new username",'PennyTheme'); ?><br/>
                    <strong>##username_email##</strong> - <?php _e("your new user's email",'PennyTheme'); ?><br/>
                    <strong>##user_password##</strong> - <?php _e("your new user's password",'PennyTheme'); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','PennyTheme'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","PennyTheme"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'PennyTheme'); ?>
                    
                    </div></td>
                    </tr>
            		
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="PennyTheme_save2" value="<?php _e('Save Options','PennyTheme'); ?>"/></td>
                    </tr>
            
            </table>
            </form>
          
        </div> 
        
        <!-- ################################ -->  
                
        <div id="admin_new_user_email" style="display: none; "> 
        	 <div class="spntxt_bo"><?php _e('This email will be received by the admin when a new user registers on the website. 
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','PennyTheme'); ?> </div>
          
          
          <form method="post" action="<?php bloginfo('siteurl'); ?>/wp-admin/admin.php?page=PT_email_set_&active_tab=admin_new_user_email">
            <table width="100%" class="sitemile-table">
    		
            	  	<tr>
                    <td valign=top width="22"><?php PennyTheme_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','PennyTheme'); ?></td>
                    <td><input type="text" size="90" name="PennyTheme_new_user_email_admin_subject" value="<?php echo stripslashes(get_option('PennyTheme_new_user_email_admin_subject')); ?>"/></td>
                    </tr>
                    

                    
                    <tr>
                    <td valign=top><?php PennyTheme_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','PennyTheme'); ?></td>
                    <td><textarea cols="92" rows="10" name="PennyTheme_new_user_email_admin_message"><?php echo stripslashes(get_option('PennyTheme_new_user_email_admin_message')); ?></textarea></td>
                    </tr>
                    
                    
                    
                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','PennyTheme'); ?><br/><br/>
                    
                    <strong>##username##</strong> - <?php _e('your new username',"PennyTheme"); ?><br/>
                    <strong>##username_email##</strong> - <?php _e("your new user's email","PennyTheme"); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','PennyTheme'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","PennyTheme"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'PennyTheme'); ?>
                    
                    </div></td>
                    </tr>
            		
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="PennyTheme_save_new_user_email_admin" value="<?php _e('Save Options','PennyTheme'); ?>"/></td>
                    </tr>
            
            </table>
            </form>
        </div> 
        
        
        
        <!-- ########################### -->
        
        <div id="bids_purchase_user" style="display: none; "> 
        	 <div class="spntxt_bo"><?php _e('This email will be received by the user when he purchases bids on your website. 
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','PennyTheme'); ?> </div>
          
          
          <form method="post" action="<?php bloginfo('siteurl'); ?>/wp-admin/admin.php?page=PT_email_set_&active_tab=bids_purchase_user">
            <table width="100%" class="sitemile-table">
    		
            	  	<tr>
                    <td valign=top width="22"><?php PennyTheme_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','PennyTheme'); ?></td>
                    <td><input type="text" size="90" name="PennyTheme_bids_purchase_user_email_subject" value="<?php echo stripslashes(get_option('PennyTheme_bids_purchase_user_email_subject')); ?>"/></td>
                    </tr>
                    

                    
                    <tr>
                    <td valign=top><?php PennyTheme_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','PennyTheme'); ?></td>
                    <td><textarea cols="92" rows="10" name="PennyTheme_bids_purchase_user_email_message"><?php echo stripslashes(get_option('PennyTheme_bids_purchase_user_email_message')); ?></textarea></td>
                    </tr>
                    
                    
                    
                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','PennyTheme'); ?><br/><br/>
                    
                    <strong>##username##</strong> - <?php _e('your new username',"PennyTheme"); ?><br/>
                    <strong>##username_email##</strong> - <?php _e("your new user's email","PennyTheme"); ?><br/>
                    <strong>##bids_value##</strong> - <?php _e("the actual number of bids","PennyTheme"); ?><br/>
                    <strong>##bids_cost##</strong> - <?php _e("the money spent on the bids","PennyTheme"); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','PennyTheme'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","PennyTheme"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'PennyTheme'); ?>
                    
                    </div></td>
                    </tr>
            		
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="PennyTheme_bids_purchase_user_email_save" value="<?php _e('Save Options','PennyTheme'); ?>"/></td>
                    </tr>
            
            </table>
            </form>
        </div>
        
        <!-- ########################### -->
        
        <div id="reserve_not_met_user" style="display: none; "> 
        	 <div class="spntxt_bo"><?php _e('This email will be received by the user when auction reserve not met. 
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','PennyTheme'); ?> </div>
          
          
          <form method="post" action="<?php bloginfo('siteurl'); ?>/wp-admin/admin.php?page=PT_email_set_&active_tab=reserve_not_met_user">
            <table width="100%" class="sitemile-table">
    		
            	  	<tr>
                    <td valign=top width="22"><?php PennyTheme_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','PennyTheme'); ?></td>
                    <td><input type="text" size="90" name="PennyTheme_reserve_not_met_user_email_subject" value="<?php echo stripslashes(get_option('PennyTheme_reserve_not_met_user_email_subject')); ?>"/></td>
                    </tr>
                    

                    
                    <tr>
                    <td valign=top><?php PennyTheme_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','PennyTheme'); ?></td>
                    <td><textarea cols="92" rows="10" name="PennyTheme_reserve_not_met_user_email_message"><?php echo stripslashes(get_option('PennyTheme_reserve_not_met_user_email_message')); ?></textarea></td>
                    </tr>
                    
                    
                    
                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','PennyTheme'); ?><br/><br/>
                    
                    <strong>##username##</strong> - <?php _e("username","PennyTheme"); ?><br/>
                    <strong>##auction_title##</strong> - <?php _e("auction_title","PennyTheme"); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','PennyTheme'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","PennyTheme"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'PennyTheme'); ?>
                    
                    </div></td>
                    </tr>
            		
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="PennyTheme_reserve_not_met_user_email_save" value="<?php _e('Save Options','PennyTheme'); ?>"/></td>
                    </tr>
            
            </table>
            </form>
        </div> 
        
<div id="reserve_not_met_admin" style="display: none; "> 
        	 <div class="spntxt_bo"><?php _e('This email will be received by the admin when auction reserve not met. 
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','PennyTheme'); ?> </div>
          
          
          <form method="post" action="<?php bloginfo('siteurl'); ?>/wp-admin/admin.php?page=PT_email_set_&active_tab=reserve_not_met_user">
            <table width="100%" class="sitemile-table">
    		
            	  	<tr>
                    <td valign=top width="22"><?php PennyTheme_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','PennyTheme'); ?></td>
                    <td><input type="text" size="90" name="PennyTheme_reserve_not_met_admin_email_subject" value="<?php echo stripslashes(get_option('PennyTheme_reserve_not_met_admin_email_subject')); ?>"/></td>
                    </tr>
                    

                    
                    <tr>
                    <td valign=top><?php PennyTheme_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','PennyTheme'); ?></td>
                    <td><textarea cols="92" rows="10" name="PennyTheme_reserve_not_met_admin_email_message"><?php echo stripslashes(get_option('PennyTheme_reserve_not_met_admin_email_message')); ?></textarea></td>
                    </tr>
                    
                    
                    
                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','PennyTheme'); ?><br/><br/>
                    
                    <strong>##auction_title##</strong> - <?php _e("auction_title","PennyTheme"); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','PennyTheme'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","PennyTheme"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'PennyTheme'); ?>
                    
                    </div></td>
                    </tr>
            		
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="PennyTheme_reserve_not_met_admin_email_save" value="<?php _e('Save Options','PennyTheme'); ?>"/></td>
                    </tr>
            
            </table>
            </form>
        </div> 
        
        <!-- ########################### -->
        
        
        <div id="seats_purchase_user" style="display: none; "> 
        	 <div class="spntxt_bo"><?php _e('This email will be received by the user when he purchases seats on your website. 
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','PennyTheme'); ?> </div>
          
          
          <form method="post" action="<?php bloginfo('siteurl'); ?>/wp-admin/admin.php?page=PT_email_set_&active_tab=seats_purchase_user">
            <table width="100%" class="sitemile-table">
    		
            	  	<tr>
                    <td valign=top width="22"><?php PennyTheme_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','PennyTheme'); ?></td>
                    <td><input type="text" size="90" name="PennyTheme_seats_purchase_user_email_subject" value="<?php echo stripslashes(get_option('PennyTheme_seats_purchase_user_email_subject')); ?>"/></td>
                    </tr>
                    

                    
                    <tr>
                    <td valign=top><?php PennyTheme_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','PennyTheme'); ?></td>
                    <td><textarea cols="92" rows="10" name="PennyTheme_seats_purchase_user_email_message"><?php echo stripslashes(get_option('PennyTheme_seats_purchase_user_email_message')); ?></textarea></td>
                    </tr>
                    
                    
                    
                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','PennyTheme'); ?><br/><br/>
                    
                    <strong>##username##</strong> - <?php _e('your new username',"PennyTheme"); ?><br/>
                    <strong>##username_email##</strong> - <?php _e("your new user's email","PennyTheme"); ?><br/>
                    <strong>##seats_value##</strong> - <?php _e("the actual number of seats","PennyTheme"); ?><br/>
                    <strong>##seats_cost##</strong> - <?php _e("the money spent on the seats","PennyTheme"); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','PennyTheme'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","PennyTheme"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'PennyTheme'); ?>
                    
                    </div></td>
                    </tr>
            		
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="PennyTheme_seats_purchase_user_email_save" value="<?php _e('Save Options','PennyTheme'); ?>"/></td>
                    </tr>
            
            </table>
            </form>
        </div>
        
        <!-- ########################### -->
        
        <div id="seats_purchase_admin" style="display: none; "> 
        	 <div class="spntxt_bo"><?php _e('This email will be received by the admin when the user pruchases seats on your website. 
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','PennyTheme'); ?> </div>
          
          
          <form method="post" action="<?php bloginfo('siteurl'); ?>/wp-admin/admin.php?page=PT_email_set_&active_tab=seats_purchase_admin">
            <table width="100%" class="sitemile-table">
    		
            	  	<tr>
                    <td valign=top width="22"><?php PennyTheme_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','PennyTheme'); ?></td>
                    <td><input type="text" size="90" name="PennyTheme_seats_purchase_admin_email_subject" value="<?php echo stripslashes(get_option('PennyTheme_seats_purchase_user_email_subject')); ?>"/></td>
                    </tr>
                    

                    
                    <tr>
                    <td valign=top><?php PennyTheme_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','PennyTheme'); ?></td>
                    <td><textarea cols="92" rows="10" name="PennyTheme_seats_purchase_admin_email_message"><?php echo stripslashes(get_option('PennyTheme_seats_purchase_admin_email_message')); ?></textarea></td>
                    </tr>
                    
                    
                    
                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','PennyTheme'); ?><br/><br/>
                    
                    <strong>##username##</strong> - <?php _e('your new username',"PennyTheme"); ?><br/>
                    <strong>##username_email##</strong> - <?php _e("your new user's email","PennyTheme"); ?><br/>
                    <strong>##seats_value##</strong> - <?php _e("the actual number of seats","PennyTheme"); ?><br/>
                    <strong>##seats_cost##</strong> - <?php _e("the money spent on the seats","PennyTheme"); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','PennyTheme'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","PennyTheme"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'PennyTheme'); ?>
                    
                    </div></td>
                    </tr>
            		
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="PennyTheme_seats_purchase_admin_email_save" value="<?php _e('Save Options','PennyTheme'); ?>"/></td>
                    </tr>
            
            </table>
            </form>
        </div>
        
        <!-- ########################### -->
        
        <div id="bids_purchase_admin" style="display: none; "> 
        	 <div class="spntxt_bo"><?php _e('This email will be received by the admin when the user pruchases bids on your website. 
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','PennyTheme'); ?> </div>
          
          
          <form method="post" action="<?php bloginfo('siteurl'); ?>/wp-admin/admin.php?page=PT_email_set_&active_tab=bids_purchase_admin">
            <table width="100%" class="sitemile-table">
    		
            	  	<tr>
                    <td valign=top width="22"><?php PennyTheme_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','PennyTheme'); ?></td>
                    <td><input type="text" size="90" name="PennyTheme_bids_purchase_admin_email_subject" value="<?php echo stripslashes(get_option('PennyTheme_bids_purchase_user_email_subject')); ?>"/></td>
                    </tr>
                    

                    
                    <tr>
                    <td valign=top><?php PennyTheme_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','PennyTheme'); ?></td>
                    <td><textarea cols="92" rows="10" name="PennyTheme_bids_purchase_admin_email_message"><?php echo stripslashes(get_option('PennyTheme_bids_purchase_admin_email_message')); ?></textarea></td>
                    </tr>
                    
                    
                    
                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','PennyTheme'); ?><br/><br/>
                    
                    <strong>##username##</strong> - <?php _e('your new username',"PennyTheme"); ?><br/>
                    <strong>##username_email##</strong> - <?php _e("your new user's email","PennyTheme"); ?><br/>
                    <strong>##bids_value##</strong> - <?php _e("the actual number of bids","PennyTheme"); ?><br/>
                    <strong>##bids_cost##</strong> - <?php _e("the money spent on the bids","PennyTheme"); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','PennyTheme'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","PennyTheme"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'PennyTheme'); ?>
                    
                    </div></td>
                    </tr>
            		
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="PennyTheme_bids_purchase_admin_email_save" value="<?php _e('Save Options','PennyTheme'); ?>"/></td>
                    </tr>
            
            </table>
            </form>
        </div> 
        
           <!-- ########################### -->
        
        <div id="item_purchase_user" style="display: none; "> 
        	 <div class="spntxt_bo"><?php _e('This email will be received by the user when he wins an item on your website. 
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','PennyTheme'); ?> </div>
          
          
          <form method="post" action="<?php bloginfo('siteurl'); ?>/wp-admin/admin.php?page=PT_email_set_&active_tab=item_purchase_user">
            <table width="100%" class="sitemile-table">
    		
            	  	<tr>
                    <td valign=top width="22"><?php PennyTheme_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','PennyTheme'); ?></td>
                    <td><input type="text" size="90" name="PennyTheme_item_purchase_user_email_subject" value="<?php echo stripslashes(get_option('PennyTheme_item_purchase_user_email_subject')); ?>"/></td>
                    </tr>
                    

                    
                    <tr>
                    <td valign=top><?php PennyTheme_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','PennyTheme'); ?></td>
                    <td><textarea cols="92" rows="10" name="PennyTheme_item_purchase_user_email_message"><?php echo stripslashes(get_option('PennyTheme_item_purchase_user_email_message')); ?></textarea></td>
                    </tr>
                    
                    
                    
                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','PennyTheme'); ?><br/><br/>
                    
                    <strong>##username##</strong> - <?php _e('your new username',"PennyTheme"); ?><br/>
                    <strong>##username_email##</strong> - <?php _e("your new user's email","PennyTheme"); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item name","PennyTheme"); ?><br/>
                    <strong>##item_link##</strong> - <?php _e("item link","PennyTheme"); ?><br/>
                    <strong>##item_price##</strong> - <?php _e("item list price","PennyTheme"); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','PennyTheme'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","PennyTheme"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'PennyTheme'); ?>
                    
                    </div></td>
                    </tr>
            		
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="PennyTheme_item_purchase_user_email_save" value="<?php _e('Save Options','PennyTheme'); ?>"/></td>
                    </tr>
            
            </table>
            </form>
        </div> 
        
        
         <!-- ########################### -->
        
        <div id="item_purchase_admin" style="display: none; "> 
        	 <div class="spntxt_bo"><?php _e('This email will be received by the admin when the user wins an item on your website. 
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','PennyTheme'); ?> </div>
          
          
          <form method="post" action="<?php bloginfo('siteurl'); ?>/wp-admin/admin.php?page=PT_email_set_&active_tab=item_purchase_admin">
            <table width="100%" class="sitemile-table">
    		
            	  	<tr>
                    <td valign=top width="22"><?php PennyTheme_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','PennyTheme'); ?></td>
                    <td><input type="text" size="90" name="PennyTheme_item_purchase_admin_email_subject" value="<?php echo stripslashes(get_option('PennyTheme_item_purchase_admin_email_subject')); ?>"/></td>
                    </tr>
                    

                    
                    <tr>
                    <td valign=top><?php PennyTheme_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','PennyTheme'); ?></td>
                    <td><textarea cols="92" rows="10" name="PennyTheme_item_purchase_admin_email_message"><?php echo stripslashes(get_option('PennyTheme_item_purchase_admin_email_message')); ?></textarea></td>
                    </tr>
                    
                    
                    
                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','PennyTheme'); ?><br/><br/>
                    
                    <strong>##username##</strong> - <?php _e('your new username',"PennyTheme"); ?><br/>
                    <strong>##username_email##</strong> - <?php _e("your new user's email","PennyTheme"); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item name","PennyTheme"); ?><br/>
                    <strong>##item_link##</strong> - <?php _e("item link","PennyTheme"); ?><br/>
                    <strong>##item_price##</strong> - <?php _e("item list price","PennyTheme"); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','PennyTheme'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","PennyTheme"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'PennyTheme'); ?>
                    
                    </div></td>
                    </tr>
            		
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="PennyTheme_item_purchase_admin_email_save" value="<?php _e('Save Options','PennyTheme'); ?>"/></td>
                    </tr>
            
            </table>
            </form>
        </div> 
    
        <div id="free_credit_empty_user" style="display: none; "> 
        	 <div class="spntxt_bo"><?php _e('This email will be received by the admin when the user\'s free auction bid assistant credit reaches to zero. 
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','PennyTheme'); ?> </div>
          
          
          <form method="post" action="<?php bloginfo('siteurl'); ?>/wp-admin/admin.php?page=PT_email_set_&active_tab=free_credit_empty_user">
            <table width="100%" class="sitemile-table">
    		
            	  	<tr>
                    <td valign=top width="22"><?php PennyTheme_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','PennyTheme'); ?></td>
                    <td><input type="text" size="90" name="PennyTheme_free_credit_empty_email_subject" value="<?php echo stripslashes(get_option('PennyTheme_free_credit_empty_email_subject')); ?>"/></td>
                    </tr>
                    

                    
                    <tr>
                    <td valign=top><?php PennyTheme_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','PennyTheme'); ?></td>
                    <td><textarea cols="92" rows="10" name="PennyTheme_free_credit_empty_email_message"><?php echo stripslashes(get_option('PennyTheme_free_credit_empty_email_message')); ?></textarea></td>
                    </tr>
                    
                    
                    
                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','PennyTheme'); ?><br/><br/>
                    
                    <strong>##username##</strong> - <?php _e('your new username',"PennyTheme"); ?><br/>
                    <strong>##username_email##</strong> - <?php _e("your new user's email","PennyTheme"); ?><br/>
                    <strong>##item_link##</strong> - <?php _e("item link","PennyTheme"); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","PennyTheme"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'PennyTheme'); ?>
                    
                    </div></td>
                    </tr>
            		
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="PennyTheme_free_credit_empty_email_save" value="<?php _e('Save Options','PennyTheme'); ?>"/></td>
                    </tr>
            
            </table>
            </form>
        </div>
        
        
         	<?php do_action('PennyTheme_save_emails_contents'); ?>
    
    </div> 
    
    
    <?php	
	
	echo '</div>';
}


function PennyTheme_site_summary()
{
	
	global $menu_admin_auction_theme_bull;
	echo '<div class="wrap">';
	echo '<div class="icon32" id="icon-options-general-summary"><br/></div>';	
	echo '<h2 class="my_title_class_sitemile">PennyTheme Site Summary</h2>';
	?>
    
        <div id="usual2" class="usual"> 
  <ul> 
    <li><a href="#tabs1" class="selected">General Overview</a></li> 
   <!-- <li><a href="#tabs2">More Information</a></li> -->
  </ul> 
  <div id="tabs1" style="display: block; ">
    	<table width="100%" class="sitemile-table">
          <tr>
          <td width="200">Total number of auctions</td>
          <td><?php echo PennyTheme_get_total_nr_of_auction(); ?></td>
          </tr>
          
          
          <tr>
          <td>Open Auctions</td>
          <td><?php echo PennyTheme_get_total_nr_of_open_auction(); ?></td>
          </tr>
          
          <tr>
          <td>Closed & Finished</td>
          <td><?php echo PennyTheme_get_total_nr_of_closed_auction(); ?></td>
          </tr>
          
<!--          
          <tr>
          <td>Disputed & Not Finished</td>
          <td>12</td>
          </tr>
  -->        
          
          <tr>
          <td>Total Users</td>
          <td><?php
			$result = count_users();
			echo 'There are ', $result['total_users'], ' total users';
			foreach($result['avail_roles'] as $role => $count)
				echo ', ', $count, ' are ', $role, 's';
			echo '.';
			?></td>
          </tr>
          
          </table>
        
          </div> 
          <div id="tabs2" style="display: none; ">More content in tab 2.</div> 
        </div> 
    
    
    <?php	
	
	echo '</div>';	
	
}


function PennyTheme_layout_settings()
{

	$id_icon 		= 'icon-options-general-layout';
	$ttl_of_stuff 	= 'PennyTheme - '.__('Layout Settings','PennyTheme');
	global $menu_admin_PennyTheme_theme_bull;
	
	//------------------------------------------------------
	
	$arr = array("yes" => __("Yes",'PennyTheme'), "no" => __("No",'PennyTheme'));
	
	echo '<div class="wrap">';
	echo '<div class="icon32" id="'.$id_icon.'"><br/></div>';	
	echo '<h2 class="my_title_class_sitemile">'.$ttl_of_stuff.'</h2>';	

		if(isset($_POST['PennyTheme_save4']))
		{
			update_option('PennyTheme_color_for_top_links', 			trim($_POST['PennyTheme_color_for_top_links']));
			update_option('PennyTheme_color_for_bk', 					trim($_POST['PennyTheme_color_for_bk']));
			update_option('PennyTheme_color_for_footer', 				trim($_POST['PennyTheme_color_for_footer']));
			update_option('PennyTheme_color_for_top_links2', 				trim($_POST['PennyTheme_color_for_top_links2']));
			
			update_option('PennyTheme_color_for_main_links', 				trim($_POST['PennyTheme_color_for_main_links']));
			update_option('PennyTheme_color_for_main_links2', 			trim($_POST['PennyTheme_color_for_main_links2']));
			update_option('PennyTheme_color_for_text_footer', 			trim($_POST['PennyTheme_color_for_text_footer']));
			update_option('PennyTheme_color_for_slider_bg', 			trim($_POST['PennyTheme_color_for_slider_bg']));
			
			
			
			echo '<div class="saved_thing">'.__('Settings saved!','PennyTheme').'</div>';
		}
		
		if(isset($_POST['PennyTheme_save1']))
		{
			update_option('PennyTheme_home_page_layout', 				trim($_POST['PennyTheme_home_page_layout']));
            
            update_option('PennyTheme_home_section1', trim($_POST['PennyTheme_home_section1']));
            update_option('PennyTheme_home_section2', trim($_POST['PennyTheme_home_section2']));
            update_option('PennyTheme_home_section3', trim($_POST['PennyTheme_home_section3']));
            update_option('PennyTheme_home_section4', trim($_POST['PennyTheme_home_section4']));
            
            update_option('show_bid_based_auctions', trim($_POST['show_bid_based_auctions']));
            update_option('show_seats_based_auctions', trim($_POST['show_seats_based_auctions']));
            update_option('show_free_auctions', trim($_POST['show_free_auctions']));	
			
			echo '<div class="saved_thing">'.__('Settings saved!','PennyTheme').'</div>';
		}
		
		if(isset($_POST['PennyTheme_save2']))
		{
			update_option('PennyTheme_logo_URL', 				trim($_POST['PennyTheme_logo_URL']));
			
			echo '<div class="saved_thing">'.__('Settings saved!','PennyTheme').'</div>';
		}
		
		if(isset($_POST['PennyTheme_save3']))
		{
			update_option('PennyTheme_left_side_footer', 				stripslashes(trim($_POST['PennyTheme_left_side_footer'])));
			update_option('PennyTheme_right_side_footer', 			stripslashes(trim($_POST['PennyTheme_right_side_footer'])));
			
			echo '<div class="saved_thing">'.__('Settings saved!','PennyTheme').'</div>';
		}
		
		
		//-----------------------------------------

	$PennyTheme_home_page_layout = get_option('PennyTheme_home_page_layout');
	if(empty($PennyTheme_home_page_layout)) $PennyTheme_home_page_layout = "1";
	
?>

	    <div id="usual2" class="usual"> 
          <ul> 
            <li><a href="#tabs1"><?php _e('HomePage','PennyTheme'); ?></a></li> 
            <li><a href="#tabs2"><?php _e('Header','PennyTheme'); ?></a></li> 
            <li><a href="#tabs3"><?php _e('Footer','PennyTheme'); ?></a></li>
            <li><a href="#tabs4"><?php _e('Change Colors','PennyTheme'); ?></a></li> 
          </ul>
           
          <div id="tabs4">
           <form method="post" action="<?php bloginfo('siteurl'); ?>/wp-admin/admin.php?page=PT_layout_&active_tab=tabs4">
            <table width="100%" class="sitemile-table">
            
                
        <tr>
        <td width="200"><?php _e('Color for background:','PennyTheme'); ?></td>
        <td><input type="text" id="colorpickerField1" name="PennyTheme_color_for_bk"  value="<?php echo get_option('PennyTheme_color_for_bk'); ?>"/>
				<script>
					$(document).ready(function() {
						
					$('#colorpickerField1, #colorpickerField2, #colorpickerField3, #colorpickerField5, #colorpickerField6, #colorpickerField7, #colorpickerField9 , #colorpickerField10').ColorPicker({
							onSubmit: function(hsb, hex, rgb, el) {
								$(el).val(hex);
								$(el).ColorPickerHide();
							},
							onBeforeShow: function () {
								$(this).ColorPickerSetColor(this.value);
							}
						})
						.bind('keyup', function(){
							$(this).ColorPickerSetColor(this.value);
						});
						
						});
					
				</script>

		</td>
        </tr>
        
        
        
        <tr>
        <td width="200"><?php _e('Color for footer:','PennyTheme'); ?></td>
        <td><input type="text" id="colorpickerField2" name="PennyTheme_color_for_footer" value="<?php echo get_option('PennyTheme_color_for_footer'); ?>" />
		</td>
        </tr>
        
        
         <tr>
        <td width="200"><?php _e('Color for text footer:','PennyTheme'); ?></td>
        <td><input type="text" id="colorpickerField9" name="PennyTheme_color_for_text_footer" value="<?php echo get_option('PennyTheme_color_for_text_footer'); ?>" />
		</td>
        </tr>
        
        
        <tr>
        <td width="200"><?php _e('Color for top links:','PennyTheme'); ?></td>
        <td><input type="text" id="colorpickerField3" name="PennyTheme_color_for_top_links" value="<?php echo get_option('PennyTheme_color_for_top_links'); ?>" />
		</td>
        </tr>
        
        <tr>
        <td width="200"><?php _e('Color for top links(hover):','PennyTheme'); ?></td>
        <td><input type="text" id="colorpickerField5" name="PennyTheme_color_for_top_links2" value="<?php echo get_option('PennyTheme_color_for_top_links2'); ?>" />
		</td>
        </tr>
        
        
        <tr>
        <td width="200"><?php _e('Color for main menu:','PennyTheme'); ?></td>
        <td><input type="text" id="colorpickerField6" name="PennyTheme_color_for_main_links" value="<?php echo get_option('PennyTheme_color_for_main_links'); ?>" />
		</td>
        </tr>
        
        
        <tr>
        <td width="200"><?php _e('Color for main menu(hover):','PennyTheme'); ?></td>
        <td><input type="text" id="colorpickerField7" name="PennyTheme_color_for_main_links2" value="<?php echo get_option('PennyTheme_color_for_main_links2'); ?>" />
		</td>
        </tr>
        
        
         <tr>
        <td width="200"><?php _e('Color for slider background:','PennyTheme'); ?></td>
        <td><input type="text" id="colorpickerField10" name="PennyTheme_color_for_slider_bg" value="<?php echo get_option('PennyTheme_color_for_slider_bg'); ?>" />
		</td>
        </tr>
            
            
            
            
             <tr>
                  
                    <td ></td>
                    <td><input type="submit" name="PennyTheme_save4" value="<?php _e('Save Options','PennyTheme'); ?>"/></td>
                    </tr>    
                
            
            </table>
            
            </form>
          
          
          </div>
           
          <div id="tabs1">
          
          <form method="post" action="<?php bloginfo('siteurl'); ?>/wp-admin/admin.php?page=PT_layout_&active_tab=tabs1">
            <table width="100%" class="sitemile-table">
    				
				<tr><td valign=top width="22"><?php PennyTheme_theme_bullet(__('The layout of the homepage.','PennyTheme')); ?></td>
					<td class="ttl"><strong><?php _e("Choose from the home page layouts available:","PennyTheme"); ?></strong> </td> <td></td></tr>
            
				<tr>
                <td valign=top width="22"></td>
					<td width="350"><?php _e("Content + Right Sidebar:","PennyTheme"); ?> </td>
					<td><input type="radio" name="PennyTheme_home_page_layout" value="1" <?php if($PennyTheme_home_page_layout == "1") echo 'checked="checked"'; ?> /> 
					 <img src="<?php bloginfo('template_url'); ?>/images/layout1.jpg" /></td>
                </tr>
                
                
                <tr>
                <td valign=top width="22"></td>
					<td><?php _e("Content + Left Sidebar + Right Sidebar:","PennyTheme"); ?> </td>
					<td><input type="radio" name="PennyTheme_home_page_layout" value="2" <?php if($PennyTheme_home_page_layout == "2") echo 'checked="checked"'; ?> /> 
					  <img src="<?php bloginfo('template_url'); ?>/images/layout2.jpg" /></td>
                </tr>
                
                
                <tr>
                <td valign=top width="22"></td>
					<td><?php _e("Left Sidebar + Content + Right Sidebar:","PennyTheme"); ?> </td>
					<td><input type="radio" name="PennyTheme_home_page_layout" value="3" <?php if($PennyTheme_home_page_layout == "3") echo 'checked="checked"'; ?>/>  
					  <img src="<?php bloginfo('template_url'); ?>/images/layout3.jpg" /></td>
                </tr>
                
                
                <tr>
                <td valign=top width="22"></td>
					<td><?php _e("Left Sidebar + Content:","PennyTheme"); ?> </td>
					<td><input type="radio" name="PennyTheme_home_page_layout" value="4" <?php if($PennyTheme_home_page_layout == "4") echo 'checked="checked"'; ?>/>  
					  <img src="<?php bloginfo('template_url'); ?>/images/layout4.jpg" /></td>
                </tr>
                
                
                <tr>
                <td valign=top></td>
					<td><?php _e("Content:","PennyTheme"); ?> </td>
					 <td><input type="radio" name="PennyTheme_home_page_layout" value="5" <?php if($PennyTheme_home_page_layout == "5") echo 'checked="checked"'; ?>/>  
					 <img src="<?php bloginfo('template_url'); ?>/images/layout5.jpg" /></td>
                </tr>
                
                
                <tr><td valign=top width="22"><?php PennyTheme_theme_bullet(__('Home section text.','PennyTheme')); ?></td>
					<td class="ttl"><strong><?php _e("Home section text:","PennyTheme"); ?></strong> </td> <td></td></tr>
                
                <tr>
                    <td width="22" valign="top"></td>
                    <td>Show Seats based auctions:</td>
                    <td><input checked="checked" type="radio" name="show_seats_based_auctions" value="1"/>Yes&nbsp;&nbsp;&nbsp;&nbsp;
                        <input <?php if(get_option('show_seats_based_auctions') == 0) echo 'checked="checked"'; ?> type="radio" name="show_seats_based_auctions" value="0"/>No</td>
                </tr>
                
                <tr>
                    <td width="22" valign="top"></td>
                    <td>Show Bids based auctions:</td>
                    <td><input checked="checked" type="radio" name="show_bid_based_auctions" value="1"/>Yes&nbsp;&nbsp;&nbsp;&nbsp;
                        <input <?php if(get_option('show_bid_based_auctions') == 0) echo 'checked="checked"'; ?> type="radio" name="show_bid_based_auctions" value="0"/>No</td>
                </tr>
                                
                <tr>
                    <td width="22" valign="top"></td>
                    <td>Show Free auctions:</td>
                    <td><input checked="checked" type="radio" name="show_free_auctions" value="1"/>Yes&nbsp;&nbsp;&nbsp;&nbsp;
                        <input <?php if(get_option('show_free_auctions') == 0) echo 'checked="checked"'; ?> type="radio" name="show_free_auctions" value="0"/>No</td>
                </tr>
                
                <tr>
                    <td width="22" valign="top"></td>
                    <td>Main text:</td>
                    <td><input type="text" value="<?php if(get_option('PennyTheme_home_section1')){ echo get_option('PennyTheme_home_section1');}else{echo 'Latest Posted Auctions';} ?>" name="PennyTheme_home_section1"/></td>
                </tr>
                
                <tr>
                    <td width="22" valign="top"></td>
                    <td>Bids based text:</td>
                    <td><input type="text" value="<?php if(get_option('PennyTheme_home_section2')){ echo get_option('PennyTheme_home_section2');}else{echo 'Bids-based Auctions';} ?>" name="PennyTheme_home_section2"/></td>
                </tr>
                
                <tr>
                    <td width="22" valign="top"></td>
                    <td>Seats based text:</td>
                    <td><input type="text" value="<?php if(get_option('PennyTheme_home_section3')){ echo get_option('PennyTheme_home_section3');}else{echo 'Seats-based Auctions';} ?>" name="PennyTheme_home_section3"/></td>
                </tr>
                
                <tr>
                    <td width="22" valign="top"></td>
                    <td>Free auction Text:</td>
                    <td><input type="text" value="<?php if(get_option('PennyTheme_home_section4')){ echo get_option('PennyTheme_home_section4');}else{echo 'Free Auctions';} ?>" name="PennyTheme_home_section4"/></td>
                </tr>
                
                
                        
                    <tr>
                   <td valign=top width="22"></td>
                    <td ></td>
                    <td><input type="submit" name="PennyTheme_save1" value="<?php _e('Save Options','PennyTheme'); ?>"/></td>
                    </tr>
            
            </table>      
          	</form>	
          	
          </div>
          
          <div id="tabs2">	
          
           <form method="post" action="<?php bloginfo('siteurl'); ?>/wp-admin/admin.php?page=PT_layout_&active_tab=tabs2">
            <table width="100%" class="sitemile-table">
    				
                  
                    <tr>
                    <td valign=top width="22"><?php PennyTheme_theme_bullet(__('Eg: http://your-site-url.com/images/logo.jpg','PennyTheme')); ?></td>
                    <td ><?php _e('Logo URL:','PennyTheme'); ?></td>
                    <td><input type="text" size="45" name="PennyTheme_logo_URL" value="<?php echo get_option('PennyTheme_logo_URL'); ?>"/></td>
                    </tr>
           
           
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="PennyTheme_save2" value="<?php _e('Save Options','PennyTheme'); ?>"/></td>
                    </tr>
            
            </table>      
          	</form>
          
          </div>
          
          <div id="tabs3">	
             <form method="post" action="<?php bloginfo('siteurl'); ?>/wp-admin/admin.php?page=PT_layout_&active_tab=tabs3">
            <table width="100%" class="sitemile-table">
    				
                 
          <tr>
                    <td valign=top width="22"><?php PennyTheme_theme_bullet(__('This will appear in the left side of the footer area.','PennyTheme')); ?></td>
                    <td valign="top" ><?php _e('Left side footer area content:','PennyTheme'); ?></td>
                    <td><textarea cols="65" rows="4" name="PennyTheme_left_side_footer"><?php echo stripslashes(get_option('PennyTheme_left_side_footer')); ?></textarea></td>
                    </tr>
                    
                    
                    <tr>
                    <td valign=top width="22"><?php PennyTheme_theme_bullet(__('This will appear in the right side of the footer area.','PennyTheme')); ?></td>
                    <td valign="top" ><?php _e('Right side footer area content:','PennyTheme'); ?></td>
                    <td><textarea cols="65" rows="4" name="PennyTheme_right_side_footer"><?php echo stripslashes(get_option('PennyTheme_right_side_footer')); ?></textarea></td>
                    </tr>
          
          
             <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="PennyTheme_save3" value="<?php _e('Save Options','PennyTheme'); ?>"/></td>
                    </tr>
            
            </table>      
          	</form>
          
          </div>
    

<?php
	echo '</div>';		
}

function PennyTheme_tracking_tools_panel()
{
	$id_icon 		= 'icon-options-general-track';
	$ttl_of_stuff 	= 'PennyTheme - '.__('Tracking Tools','PennyTheme');
	$arr = array("yes" => __("Yes",'PennyTheme'), "no" => __("No",'PennyTheme'));
	global $menu_admin_PennyTheme_theme_bull;
	
	//------------------------------------------------------
	
	echo '<div class="wrap">';
	echo '<div class="icon32" id="'.$id_icon.'"><br/></div>';	
	echo '<h2 class="my_title_class_sitemile">'.$ttl_of_stuff.'</h2>';	

	if(isset($_POST['PennyTheme_save1']))
		{
			update_option('PennyTheme_enable_google_analytics', 				trim($_POST['PennyTheme_enable_google_analytics']));
			update_option('PennyTheme_analytics_code', 						trim($_POST['PennyTheme_analytics_code']));
			
			echo '<div class="saved_thing">'.__('Settings saved!','PennyTheme').'</div>';
		}
		
	if(isset($_POST['PennyTheme_save2']))
		{
			update_option('PennyTheme_enable_other_tracking', 				trim($_POST['PennyTheme_enable_other_tracking']));
			update_option('PennyTheme_other_tracking_code', 						trim($_POST['PennyTheme_other_tracking_code']));
			
			echo '<div class="saved_thing">'.__('Settings saved!','PennyTheme').'</div>';
		}
			

?>

	    <div id="usual2" class="usual"> 
          <ul> 
            <li><a href="#tabs1" class="selected"><?php _e('Google Analytics','PennyTheme'); ?></a></li> 
            <li><a href="#tabs2"><?php _e('Other Tracking Tools','PennyTheme'); ?></a></li> 
          </ul> 
          <div id="tabs1">
          
          		
                 <form method="post" action="">
            <table width="100%" class="sitemile-table">
    				
                    <tr>
                    <td valign=top width="22"><?php PennyTheme_theme_bullet(); ?></td>
                    <td width="250"><?php _e('Enable Google Analytics:','PennyTheme'); ?></td>
                    <td><?php echo PennyTheme_get_option_drop_down($arr, 'PennyTheme_enable_google_analytics'); ?></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php PennyTheme_theme_bullet(); ?></td>
                    <td valign="top"><?php _e('Analytics Code:','PennyTheme'); ?></td>
                    <td><textarea rows="6" cols="80" name="PennyTheme_analytics_code"><?php echo stripslashes(get_option('PennyTheme_analytics_code')); ?></textarea></td>
                    </tr>
                    
             
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="PennyTheme_save1" value="<?php _e('Save Options','PennyTheme'); ?>"/></td>
                    </tr>
            
            </table>      
          	</form>
                
          	
          </div>
          
          <div id="tabs2">	
          
             <form method="post" action="">
            <table width="100%" class="sitemile-table">
    				
                    <tr>
                    <td valign=top width="22"><?php PennyTheme_theme_bullet(); ?></td>
                    <td width="250"><?php _e('Enable Other Tracking:','PennyTheme'); ?></td>
                    <td><?php echo PennyTheme_get_option_drop_down($arr, 'PennyTheme_enable_other_tracking'); ?></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php PennyTheme_theme_bullet(); ?></td>
                    <td valign="top"><?php _e('Other Tracking Code:','PennyTheme'); ?></td>
                    <td><textarea rows="6" cols="80" name="PennyTheme_other_tracking_code"><?php echo stripslashes(get_option('PennyTheme_other_tracking_code')); ?></textarea></td>
                    </tr>
                    
             
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="PennyTheme_save2" value="<?php _e('Save Options','PennyTheme'); ?>"/></td>
                    </tr>
            
            </table>      
          	</form>
                
          
          </div>
    

<?php
	echo '</div>';		
	
}

function PennyTheme_orders_main_screen()
{
	
	global $menu_admin_auction_theme_bull;
	echo '<div class="wrap">';
	echo '<div class="icon32" id="icon-options-general-orders"><br/></div>';	
	echo '<h2 class="my_title_class_sitemile">PennyTheme Orders</h2>';
	
	
	if(isset($_GET['mark_paid']))
	{
		global $wpdb;
		$s = "update ".$wpdb->prefix."penny_bids set paid='1' where id='".$_GET['mark_paid']."'";
		$wpdb->query($s);
		
		$s1 = "select * from ".$wpdb->prefix."penny_bids where id='".$_GET['mark_paid']."' "		;
		$r1 = $wpdb->get_results($s1);
		$row1 = $r1[0];
		
		
		
		update_post_meta($row1->pid, 'winner_paid' , 1); 
		update_post_meta($row1->pid, 'paid_on_' . $_GET['mark_paid'], current_time('timestamp',0)); 
		echo '<div class="saved_thing">The item was marked as paid.</div>';
	}
	
		if(isset($_GET['mark_shipped']))
	{
		global $wpdb;
		$s = "update ".$wpdb->prefix."penny_bids set shipped='1', shipped_on='".current_time('timestamp',0)."' where id='".$_GET['mark_shipped']."'";
		$wpdb->query($s);
		
		$s1 = "select * from ".$wpdb->prefix."penny_bids where id='".$_GET['mark_shipped']."' "		;
		$r1 = $wpdb->get_results($s1);
		$row1 = $r1[0];
		
		update_post_meta($row1->pid, 'shipped' , 1); 
		echo '<div class="saved_thing">The item was marked as shipped.</div>';
	}
	
	
	
	?>
    
        <div id="usual2" class="usual"> 
  <ul> 
    <li><a href="#tabs1" class="selected">Not Paid Orders</a></li> 
    <li><a href="#tabs2">Paid & Not Shipped Orders</a></li>
    <li><a href="#tabs3">Paid & Shipped Orders</a></li>
    <!-- <li><a href="#tabs4">Failed &amp; Disputed Orders</a></li> -->
    <?php do_action('PennyTheme_main_menu_orders_tabs'); ?>
  </ul> 
  <div id="tabs1" style="display: block; ">
    	
		
        
          <?php

		
					global $current_user;
					get_currentuserinfo();
					$uid = $current_user->ID;
					
					global $wp_query;
					$query_vars = $wp_query->query_vars;
					$nrpostsPage = 8;				
				
					$page = $_GET['pj'];
					if(empty($page)) $page = 1;
					
					//---------------------------------
					
					 
					
				 global $wpdb;	
				 $querystr2 = "
					SELECT distinct wposts.ID , bids.id bid_id, bids.uid winner_id, bids.bid bid, bids.date_choosen date_choosen, bids.buy_id
					FROM $wpdb->posts wposts, ".$wpdb->prefix."penny_bids bids 
					WHERE 
					
					( wposts.ID = bids.pid OR ( wposts.ID = bids.buy_id AND pid = 0 ) ) AND
					
					bids.winner='1' AND 
					bids.shipped='0' AND
					bids.paid='0' ";
				 
				 
				$pageposts2 = $wpdb->get_results($querystr2, OBJECT);	
				$total_count = count($pageposts2);
				$my_page = $page;	
				$pages_curent = $page;
			//-----------------------------------------------------------------------		
				
				$totalPages = ($total_count > 0 ? ceil($total_count / $nrpostsPage) : 0);
				$pagess = $totalPages;
			
					
				$querystr = "
					SELECT distinct wposts.* , bids.id bid_id, bids.uid winner_id, bids.bid bid, bids.date_made date_made, bids.buy_id 
					FROM $wpdb->posts wposts, ".$wpdb->prefix."penny_bids bids 
					WHERE 
					
					( wposts.ID = bids.pid OR ( wposts.ID = bids.buy_id AND pid = 0 ) ) AND
					 
					bids.winner='1' AND 
					bids.shipped='0' AND
					bids.paid='0'
					
					ORDER BY wposts.post_date DESC LIMIT ".($nrpostsPage * ($page - 1) ).",". $nrpostsPage ;	
					
				
				 $pageposts = $wpdb->get_results($querystr, OBJECT);
				 $posts_per = 7;
				 ?>
					
					 <?php $i = 0; if ($pageposts): ?>
                     
                    <table class="widefat post fixed">
				<thead> <tr>
					<th>Auction Title</th>
					<th>Seller</th>
                    <th>Buyer/Winner</th>
					<th>Winning Bid/Price</th>
           
                    <th>Shipping Cost</th>
                    <th>User Expenses</th>
                    <th>Total Cost</th>
					<th>Purchased On</th>
                    <th>Type</th>
                    <th>Options</th>
				</tr>
				</thead> <tbody>
                     
                     
					 <?php global $post; ?>
                     <?php foreach ($pageposts as $post): ?>
                     <?php setup_postdata($post); ?>
                     <?php
					 
					 
					 	$shp = get_post_meta(get_the_ID(), 'shipping', true); if(empty($shp)) $shp = 0;
						$shp1 = $shp;
						
                        $user_exp = get_user_auction_cost( $post->buy_id, $post->winner_id );
                        
					 	$seller = get_userdata($post->post_author);
					 	$winner = get_userdata($post->winner_id);
                        if( $post->buy_id > 0 ){
                            $type = 'Bought';
                            $bid  = pennyTheme_get_show_price( get_post_meta( $post->buy_id, 'buy_now', true ) );    
                        }else{
                            $type = 'Bid Won';
                            $bid = pennyTheme_get_show_price($post->bid);
                        }
					 	
                        
						$date_choosen = date_i18n('d-m-Y H:i:s', $post->date_made);
						$shp = pennyTheme_get_show_price($shp);
                        
						
						$ttl = pennyTheme_get_show_price( ( $shp1 + $post->bid ) - $user_exp );
						
					 ?>
                     
                    <tr>
					<th><a href="<?php echo get_permalink(get_the_ID()); ?>" target="_blank"><?php the_title(); ?></a></th>
					<th><?php echo $seller->user_login; ?></th>
                    <th><?php echo $winner->user_login; ?></th>
					<th><?php echo $bid; ?></th>
                
                    <th><?php echo $shp; ?></th>
                    <th><?php echo $user_exp; ?></th>
                    <th><?php echo $ttl; ?></th>
					<th><?php echo $date_choosen; ?></th>
                    <th><?php echo $type; ?></th>
                    <th><a href="<?php echo get_admin_url() ?>/admin.php?page=PT_orders_&mark_paid=<?php echo $post->bid_id; ?>">Mark as Paid</a></th>
				</tr

                     ><?php endforeach; ?>
                    </tbody> 
                    </table> 
                    
                     
                     <div class="nav">
                     <?php
					 	
		$batch = 10; //ceil($page / $nrpostsPage );
		$end = $batch * $nrpostsPage;


		if ($end > $pagess) {
			$end = $pagess;
		}
		$start = $end - $nrpostsPage + 1;
		
		if($start < 1) $start = 1;
		
		$links = '';
	
		
		$raport = ceil($my_page/$batch) - 1; if ($raport < 0) $raport = 0;
		
		$start 		= $raport * $batch + 1; 
		$end		= $start + $batch - 1;
		$end_me 	= $end + 1;
		$start_me 	= $start - 1;
		
		if($end > $totalPages) $end = $totalPages;
		if($end_me > $totalPages) $end_me = $totalPages;
		
		if($start_me <= 0) $start_me = 1;
		
		$previous_pg = $page - 1;
		if($previous_pg <= 0) $previous_pg = 1;
		
		$next_pg = $pages_curent + 1;
		if($next_pg > $totalPages) $next_pg = 1;
		
		
		
		//PricerrTheme_get_browse_jobs_link($job_tax, $job_category, 'new', $page)
		
		if($my_page > 1)
		{	
			echo '<a href="'.get_bloginfo('siteurl').'/wp-admin/admin.php?page=PT_orders_&pj='.$previous_pg.'"><< '.__('Previous','PennyTheme').'</a>';
			echo '<a href="'.get_bloginfo('siteurl').'/wp-admin/admin.php?page=PT_orders_&pj=' .$start_me.'"><<</a>';		
		}
		//------------------------
		//echo $start." ".$end;
		for($i = $start; $i <= $end; $i ++) {
			if ($i == $pages_curent) {
				echo '<a class="activee" href="#">'.$i.'</a>';
			} else {
	
				echo '<a href="'.get_bloginfo('siteurl').'/wp-admin/admin.php?page=PT_orders_&pj=' . $i.'">'.$i.'</a>';
				
			}
		}
		
		//----------------------
		
		if($totalPages > $my_page)
		echo '<a href="'.get_bloginfo('siteurl').'/wp-admin/admin.php?page=PT_orders_&pj=' . $end_me.'">>></a>';
		
		if($page < $totalPages)
		echo '<a href="'.get_bloginfo('siteurl').'/wp-admin/admin.php?page=PT_orders_&pj=' . $next_pg.'">'.__('Next','PennyTheme').' >></a>';						
				
					 ?>
                     </div>
                     
                     
                     
                     
                     <?php else: ?>
                     
                     <?php _e('There are no items yet','PennyTheme'); ?>
                     
                     <?php endif; ?>

					
					
					<?php
					
					wp_reset_query();
					
					?>
                
        
        
	
	
	
	
        
          </div> 
        
        
        <div id="tabs2" style="display: none; ">
        
     
          <?php

		
					global $current_user;
					get_currentuserinfo();
					$uid = $current_user->ID;
					
					global $wp_query;
					$query_vars = $wp_query->query_vars;
					$nrpostsPage = 8;				
				
					$page = $_GET['pj'];
					if(empty($page)) $page = 1;
					
					//---------------------------------
					
					
					
				 global $wpdb;	
				 $querystr2 = "
					SELECT distinct wposts.ID , bids.id bid_id, bids.uid winner_id, bids.bid bid, bids.date_made date_made 
					FROM $wpdb->posts wposts, ".$wpdb->prefix."penny_bids bids 
					WHERE 
					
                    ( wposts.ID = bids.pid OR ( wposts.ID = bids.buy_id AND pid = 0 ) ) AND
					
					bids.winner='1' AND 
					bids.shipped='0' AND
					bids.paid='1' ";
				
				
				$pageposts2 = $wpdb->get_results($querystr2, OBJECT);	
				$total_count = count($pageposts2);
				$my_page = $page;	
				$pages_curent = $page;
			//-----------------------------------------------------------------------		
				
				$totalPages = ($total_count > 0 ? ceil($total_count / $nrpostsPage) : 0);
				$pagess = $totalPages;
			
					
				$querystr = "
					SELECT distinct wposts.* , bids.id bid_id, bids.uid winner_id, bids.bid bid, bids.date_made date_made 
					FROM $wpdb->posts wposts, ".$wpdb->prefix."penny_bids bids 
					WHERE 
					
					( wposts.ID = bids.pid OR ( wposts.ID = bids.buy_id AND pid = 0 ) ) AND
					 
					bids.winner='1' AND 
					bids.shipped='0' AND
					bids.paid='1'
					
					ORDER BY wposts.post_date DESC LIMIT ".($nrpostsPage * ($page - 1) ).",". $nrpostsPage ;	
					
				
				 $pageposts = $wpdb->get_results($querystr, OBJECT);
				 $posts_per = 7;
				 ?>
					
					 <?php $i = 0; if ($pageposts): ?>
                     
                    <table class="widefat post fixed">
				<thead> <tr>
					<th>Auction Title</th>
					<th>Seller</th>
                    <th>Buyer/Winner</th>
					<th>Winning Bid</th>
                    
                    <th>Shipping Cost</th>
                    <th>Total Cost</th>
					<th>Purchased On</th>
                    <th>Paid On</th>
                    <th>Options</th>
				</tr>
				</thead> <tbody>
                     
                     
					 <?php global $post; ?>
                     <?php foreach ($pageposts as $post): ?>
                     <?php setup_postdata($post); ?>
                     <?php
					 
					 	$seller = get_userdata($post->post_author);
					 	$winner = get_userdata($post->winner_id);
					 	$bid = pennyTheme_get_show_price($post->bid);
						$date_choosen = date_i18n('d-M-Y H:i:s', $post->date_made);
						$date_paid = date_i18n('d-M-Y H:i:s', get_post_meta(get_the_ID(), 'paid_on_'.$post->bid_id, true));
						
						$shp = get_post_meta(get_the_ID(), 'shipping', true); if(empty($shp)) $shp = 0;
						$shp = pennyTheme_get_show_price($shp);
						
						$ttl = pennyTheme_get_show_price( get_post_meta(get_the_ID(), 'shipping', true) + $post->bid*$post->quant);
						
					 ?>
                     
                    <tr>
					<th><a href="<?php echo get_permalink(get_the_ID()); ?>" target="_blank"><?php the_title(); ?></a></th>
					<th><?php echo $seller->user_login; ?></th>
                    <th><?php echo $winner->user_login; ?></th>
					<th><?php echo $bid; ?></th>
                     
                    <th><?php echo $shp; ?></th>
                    <th><?php echo $ttl; ?></th>
					<th><?php echo $date_choosen; ?></th>
                    <th><?php echo $date_paid; ?></th>
                    <th><a href="<?php echo get_admin_url() ?>/admin.php?page=PT_orders_&mark_shipped=<?php echo $post->bid_id; ?>">Mark as Shipped</a></th>
				</tr

                     ><?php endforeach; ?>
                    </tbody> 
                    </table> 
                     
                     
                     <div class="nav">
                     <?php
					 	
		$batch = 10; //ceil($page / $nrpostsPage );
		$end = $batch * $nrpostsPage;


		if ($end > $pagess) {
			$end = $pagess;
		}
		$start = $end - $nrpostsPage + 1;
		
		if($start < 1) $start = 1;
		
		$links = '';
	
		
		$raport = ceil($my_page/$batch) - 1; if ($raport < 0) $raport = 0;
		
		$start 		= $raport * $batch + 1; 
		$end		= $start + $batch - 1;
		$end_me 	= $end + 1;
		$start_me 	= $start - 1;
		
		if($end > $totalPages) $end = $totalPages;
		if($end_me > $totalPages) $end_me = $totalPages;
		
		if($start_me <= 0) $start_me = 1;
		
		$previous_pg = $page - 1;
		if($previous_pg <= 0) $previous_pg = 1;
		
		$next_pg = $pages_curent + 1;
		if($next_pg > $totalPages) $next_pg = 1;
		
		
		
		//PricerrTheme_get_browse_jobs_link($job_tax, $job_category, 'new', $page)
		
		if($my_page > 1)
		{	
			echo '<a href="'.get_bloginfo('siteurl').'/wp-admin/admin.php?page=PT_orders_&pj='.$previous_pg.'"><< '.__('Previous','PennyTheme').'</a>';
			echo '<a href="'.get_bloginfo('siteurl').'/wp-admin/admin.php?page=PT_orders_&pj=' .$start_me.'"><<</a>';		
		}
		//------------------------
		//echo $start." ".$end;
		for($i = $start; $i <= $end; $i ++) {
			if ($i == $pages_curent) {
				echo '<a class="activee" href="#">'.$i.'</a>';
			} else {
	
				echo '<a href="'.get_bloginfo('siteurl').'/wp-admin/admin.php?page=PT_orders_&pj=' . $i.'">'.$i.'</a>';
				
			}
		}
		
		//----------------------
		
		if($totalPages > $my_page)
		echo '<a href="'.get_bloginfo('siteurl').'/wp-admin/admin.php?page=PT_orders_&pj=' . $end_me.'">>></a>';
		
		if($page < $totalPages)
		echo '<a href="'.get_bloginfo('siteurl').'/wp-admin/admin.php?page=PT_orders_&pj=' . $next_pg.'">'.__('Next','PennyTheme').' >></a>';						
				
					 ?>
                     </div>
                     
                     
                     
                     
                     <?php else: ?>
                     
                     <?php _e('There are no items yet','PennyTheme'); ?>
                     
                     <?php endif; ?>

					
					
					<?php
					
					wp_reset_query();
					
					?>
                
        
        
	
	
	
        
        </div> 
       
       
        
        
         <div id="tabs3" style="display: none; ">
         
       
          <?php

		
					global $current_user;
					get_currentuserinfo();
					$uid = $current_user->ID;
					
					global $wp_query;
					$query_vars = $wp_query->query_vars;
					$nrpostsPage = 8;				
				
					$page = $_GET['pj'];
					if(empty($page)) $page = 1;
					
					//---------------------------------
					
					
					
				 global $wpdb;	
				 $querystr2 = "
					SELECT distinct wposts.ID , bids.id bid_id, bids.uid winner_id, bids.bid bid, bids.date_made date_made , bids.shipped_on shipped_on
					FROM $wpdb->posts wposts, ".$wpdb->prefix."penny_bids bids 
					WHERE 
					
					( wposts.ID = bids.pid OR ( wposts.ID = bids.buy_id AND pid = 0 ) ) AND
					
					bids.winner='1' AND 
					bids.shipped='1' AND
					bids.paid='1' ";
				
				
				$pageposts2 = $wpdb->get_results($querystr2, OBJECT);	
				$total_count = count($pageposts2);
				$my_page = $page;	
				$pages_curent = $page;
			//-----------------------------------------------------------------------		
				
				$totalPages = ($total_count > 0 ? ceil($total_count / $nrpostsPage) : 0);
				$pagess = $totalPages;
			
					
				$querystr = "
					SELECT distinct wposts.* , bids.id bid_id, bids.uid winner_id, bids.bid bid, bids.date_made date_made , bids.shipped_on shipped_on
					FROM $wpdb->posts wposts, ".$wpdb->prefix."penny_bids bids 
					WHERE 
					
					( wposts.ID = bids.pid OR ( wposts.ID = bids.buy_id AND pid = 0 ) ) AND
					 
					bids.winner='1' AND 
					bids.shipped='1' AND
					bids.paid='1'
					
					ORDER BY wposts.post_date DESC LIMIT ".($nrpostsPage * ($page - 1) ).",". $nrpostsPage ;	
					
				
				 $pageposts = $wpdb->get_results($querystr, OBJECT);
				 $posts_per = 7;
				 ?>
					
					 <?php $i = 0; if ($pageposts): ?>
                     
                    <table class="widefat post fixed">
				<thead> <tr>
					<th>Auction Title</th>
					<th>Seller</th>
                    <th>Buyer/Winner</th>
					<th>Winning Bid</th>
                  
                    <th>Shipping Cost</th>
                    <th>Total Cost</th>
					<th>Purchased On</th>
                    <th>Paid On</th>
                    <th>Shipped On</th>
				</tr>
				</thead> <tbody>
                     
                     
					 <?php global $post; ?>
                     <?php foreach ($pageposts as $post): ?>
                     <?php setup_postdata($post); ?>
                     <?php
					 
					 	$seller = get_userdata($post->post_author);
					 	$winner = get_userdata($post->winner_id);
					 	$bid = pennyTheme_get_show_price($post->bid);
						$date_choosen = date_i18n('d-M-Y H:i:s', $post->date_made);
						$shipped_on = date_i18n('d-M-Y H:i:s', $post->shipped_on);
						$date_paid = date_i18n('d-M-Y H:i:s', get_post_meta(get_the_ID(), 'paid_on_'.$post->bid_id, true));
						$shp = get_post_meta(get_the_ID(), 'shipping', true); if(empty($shp)) $shp = 0;
						$shp = pennyTheme_get_show_price($shp);
						
						$ttl = pennyTheme_get_show_price( get_post_meta(get_the_ID(), 'shipping', true) + $post->bid );
						
					 ?>
                     
                    <tr>
					<th><a href="<?php echo get_permalink(get_the_ID()); ?>" target="_blank"><?php the_title(); ?></a></th>
					<th><?php echo $seller->user_login; ?></th>
                    <th><?php echo $winner->user_login; ?></th>
					<th><?php echo $bid; ?></th>
                    
                    <th><?php echo $shp; ?></th>
                    <th><?php echo $ttl; ?></th>
					<th><?php echo $date_choosen; ?></th>
                    <th><?php echo $date_paid; ?></th>
                    <th><?php echo $shipped_on; ?></th>
				</tr

                     ><?php endforeach; ?>
                    </tbody> 
                    </table> 
                     
                     
                     <div class="nav">
                     <?php
					 	
		$batch = 10; //ceil($page / $nrpostsPage );
		$end = $batch * $nrpostsPage;


		if ($end > $pagess) {
			$end = $pagess;
		}
		$start = $end - $nrpostsPage + 1;
		
		if($start < 1) $start = 1;
		
		$links = '';
	
		
		$raport = ceil($my_page/$batch) - 1; if ($raport < 0) $raport = 0;
		
		$start 		= $raport * $batch + 1; 
		$end		= $start + $batch - 1;
		$end_me 	= $end + 1;
		$start_me 	= $start - 1;
		
		if($end > $totalPages) $end = $totalPages;
		if($end_me > $totalPages) $end_me = $totalPages;
		
		if($start_me <= 0) $start_me = 1;
		
		$previous_pg = $page - 1;
		if($previous_pg <= 0) $previous_pg = 1;
		
		$next_pg = $pages_curent + 1;
		if($next_pg > $totalPages) $next_pg = 1;
		
		
		
		//PricerrTheme_get_browse_jobs_link($job_tax, $job_category, 'new', $page)
		
		if($my_page > 1)
		{	
			echo '<a href="'.get_bloginfo('siteurl').'/wp-admin/admin.php?page=PT_orders_&pj='.$previous_pg.'"><< '.__('Previous','PennyTheme').'</a>';
			echo '<a href="'.get_bloginfo('siteurl').'/wp-admin/admin.php?page=PT_orders_&pj=' .$start_me.'"><<</a>';		
		}
		//------------------------
		//echo $start." ".$end;
		for($i = $start; $i <= $end; $i ++) {
			if ($i == $pages_curent) {
				echo '<a class="activee" href="#">'.$i.'</a>';
			} else {
	
				echo '<a href="'.get_bloginfo('siteurl').'/wp-admin/admin.php?page=PT_orders_&pj=' . $i.'">'.$i.'</a>';
				
			}
		}
		
		//----------------------
		
		if($totalPages > $my_page)
		echo '<a href="'.get_bloginfo('siteurl').'/wp-admin/admin.php?page=PT_orders_&pj=' . $end_me.'">>></a>';
		
		if($page < $totalPages)
		echo '<a href="'.get_bloginfo('siteurl').'/wp-admin/admin.php?page=PT_orders_&pj=' . $next_pg.'">'.__('Next','PennyTheme').' >></a>';						
				
					 ?>
                     </div>
                     
                     
                     
                     
                     <?php else: ?>
                     
                     <?php _e('There are no items yet','PennyTheme'); ?>
                     
                     <?php endif; ?>

					
					
					<?php
					
					wp_reset_query();
					
					?>
                
        
        
         
         </div> </div> 
         

    	
        <?php do_action('PennyTheme_main_menu_orders_content'); ?>
    
    <?php	
	
	echo '</div>';	
	
}


function PennyTheme_info()
{
	$id_icon 		= 'icon-options-general-info';
	$ttl_of_stuff 	= 'PennyTheme - '.__('Information','PennyTheme');
	
	//------------------------------------------------------
	
	echo '<div class="wrap">';
	echo '<div class="icon32" id="'.$id_icon.'"><br/></div>';	
	echo '<h2 class="my_title_class_sitemile">'.$ttl_of_stuff.'</h2>';	

?>

	    <div id="usual2" class="usual"> 
          <ul> 
            <li><a href="#tabs1" class="selected"><?php _e('Main Information','PennyTheme'); ?></a></li> 
            <!--li><a href="#tabs2"><?php //_e('From SiteMile Blog','PennyTheme'); ?></a></li--> 
  
          </ul> 
          <div id="tabs1" style="display: block; ">	
          
          <table width="100%" class="sitemile-table">
    				

                    <tr>                    
                    <td width="260"><?php _e('PennyTheme Version:','PennyTheme'); ?></td>
                    <td><?php echo PENNYTHEME_VERSION; ?></td>
                    </tr>
                    
                    <tr>                    
                    <td width="160"><?php _e('PennyTheme Latest Release:','PennyTheme'); ?></td>
                    <td><?php echo PENNYTHEME_RELEASE; ?></td>
                    </tr>
                    
                    <tr>                    
                    <td width="160"><?php _e('WordPress Version:','PennyTheme'); ?></td>
                    <td><?php bloginfo('version'); ?></td>
                    </tr>
                    
                    
                    <tr>                    
                    <td width="160"><?php _e('Go to SiteMile official page:','PennyTheme'); ?></td>
                    <td><a class="festin" href="http://sitemile.com">SiteMile - Premium WordPress Themes</a></td>
                    </tr>
                    
                    <tr>                    
                    <td width="160"><?php _e('Go to PennyTheme\'s official page:','PennyTheme'); ?></td>
                    <td><a class="festin" href="http://sitemile.com/p/penny">SiteMile Penny Auction Theme</a></td>
                    </tr>
                    
                    <tr>                    
                    <td width="160"><?php _e('Go to support forums:','PennyTheme'); ?></td>
                    <td><a class="festin" href="http://sitemile.com/forums">SiteMile Support Forums</a></td>
                    </tr>
                    
                    <tr>                    
                    <td width="160"><?php _e('Contact SiteMile Team:','PennyTheme'); ?></td>
                    <td><a class="festin" href="http://sitemile.com/contact-us">Contact Form</a></td>
                    </tr>
                    
                    <tr>                    
                    <td width="160"><?php _e('Like us on Facebook:','PennyTheme'); ?></td>
                    <td><a class="festin" href="http://facebook.com/sitemile">SiteMile Facebook Fan Page</a></td>
                    </tr>
                    
                    
                     <tr>                    
                    <td width="160"><?php _e('Follow us on Twitter:','PennyTheme'); ?></td>
                    <td><a class="festin" href="http://twitter.com/sitemile">SiteMile Twitter Page</a></td>
                    </tr>
                    
                    
                    
           </table>         
          
          </div>
          
          <!--div id="tabs2" style="display: none; overflow:hidden ">	
          
          <?php
		   //echo '<div style="float:left;">';
//                     wp_widget_rss_output(array(
//                         'url' => 'http://sitemile.com/feed/',
//                         'title' => 'Latest news from SiteMile.com Blog',
//                         'items' => 10,
//                         'show_summary' => 1,
//                         'show_author' => 0,
//                         'show_date' => 1
//                     ));
//           echo "</div>";
 
 ?>
          
          </div-->
          
     

<?php
	echo '</div>';		
	
}

function PennyTheme_advertising_scr()
{
 
	$id_icon 		= 'icon-options-general-adve';
	$ttl_of_stuff 	= 'PennyTheme - '.__('Advertising Spaces','PennyTheme');
	
	//------------------------------------------------------
	
	echo '<div class="wrap">';
	echo '<div class="icon32" id="'.$id_icon.'"><br/></div>';	
	echo '<h2 class="my_title_class_sitemile">'.$ttl_of_stuff.'</h2>';	

	if(isset($_POST['PennyTheme_save1']))
	{
		update_option('PennyTheme_adv_code_home_above_content', 				trim($_POST['PennyTheme_adv_code_home_above_content']));
		update_option('PennyTheme_adv_code_home_below_content', 				trim($_POST['PennyTheme_adv_code_home_below_content']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','PennyTheme').'</div>';
	}
	
	if(isset($_POST['PennyTheme_save2']))
	{
		update_option('PennyTheme_adv_code_auction_page_above_content', 				trim($_POST['PennyTheme_adv_code_auction_page_above_content']));
		update_option('PennyTheme_adv_code_auction_page_below_content', 				trim($_POST['PennyTheme_adv_code_auction_page_below_content']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','PennyTheme').'</div>';
	}
	
	if(isset($_POST['PennyTheme_save3']))
	{
		update_option('PennyTheme_adv_code_cPT_page_above_content', 				trim($_POST['PennyTheme_adv_code_cPT_page_above_content']));
		update_option('PennyTheme_adv_code_cPT_page_below_content', 				trim($_POST['PennyTheme_adv_code_cPT_page_below_content']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','PennyTheme').'</div>';
	}
	
	if(isset($_POST['PennyTheme_save4']))
	{
		update_option('PennyTheme_adv_code_single_page_above_content', 				trim($_POST['PennyTheme_adv_code_single_page_above_content']));
		update_option('PennyTheme_adv_code_single_page_below_content', 				trim($_POST['PennyTheme_adv_code_single_page_below_content']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','PennyTheme').'</div>';
	}

?>

	    <div id="usual2" class="usual"> 
          <ul> 
            <li><a href="#tabs1"><?php _e('HomePage','PennyTheme'); ?></a></li> 
            <li><a href="#tabs2"><?php _e('Auction Page','PennyTheme'); ?></a></li> 
            <li><a href="#tabs3"><?php _e('Category Page','PennyTheme'); ?></a></li> 
            <li><a href="#tabs4"><?php _e('My Account','PennyTheme'); ?></a></li> 
          </ul> 
          <div id="tabs1">	
          <form method="post" action="<?php bloginfo('siteurl'); ?>/wp-admin/admin.php?page=PT_adv_&active_tab=tabs1">
          	  <table width="100%" class="sitemile-table">
    			<tr>
                <td valign="top"><?php _e('Above the content area:','PennyTheme'); ?></td>
                <td><textarea name="PennyTheme_adv_code_home_above_content" rows="6" cols="60"><?php echo stripslashes(get_option('PennyTheme_adv_code_home_above_content')); ?></textarea></td>
                </tr>
                
                
                <tr>
                <td valign="top"><?php _e('Below the content area:','PennyTheme'); ?></td>
                <td><textarea name="PennyTheme_adv_code_home_below_content" rows="6" cols="60"><?php echo stripslashes(get_option('PennyTheme_adv_code_home_below_content')); ?></textarea></td>
                </tr>	
                    
                  
                <tr>
                    <td ></td>
                    <td><input type="submit" name="PennyTheme_save1" value="<?php _e('Save Options','PennyTheme'); ?>"/></td>
                    </tr>  
                    
              </table>      
          </form>
          
          </div>
          
          <div id="tabs2">	
          <form method="post" action="<?php bloginfo('siteurl'); ?>/wp-admin/admin.php?page=PT_adv_&active_tab=tabs2">
          <table width="100%" class="sitemile-table">
    			<tr>
                <td valign="top"><?php _e('Above the content area:','PennyTheme'); ?></td>
                <td><textarea name="PennyTheme_adv_code_auction_page_above_content" rows="6" cols="60"><?php echo stripslashes(get_option('PennyTheme_adv_code_auction_page_above_content')); ?></textarea></td>
                </tr>
                
                
                <tr>
                <td valign="top"><?php _e('Below the content area:','PennyTheme'); ?></td>
                <td><textarea name="PennyTheme_adv_code_auction_page_below_content" rows="6" cols="60"><?php echo stripslashes(get_option('PennyTheme_adv_code_auction_page_below_content')); ?></textarea></td>
                </tr>	
                    
                  
                <tr>
                    <td ></td>
                    <td><input type="submit" name="PennyTheme_save2" value="<?php _e('Save Options','PennyTheme'); ?>"/></td>
                    </tr>  
                    
              </table>  
          </form>
          </div>
          
          <div id="tabs3">	
          <form method="post" action="<?php bloginfo('siteurl'); ?>/wp-admin/admin.php?page=PT_adv_&active_tab=tabs3">
          <table width="100%" class="sitemile-table">
    			<tr>
                <td valign="top"><?php _e('Above the content area:','PennyTheme'); ?></td>
                <td><textarea name="PennyTheme_adv_code_cPT_page_above_content" rows="6" cols="60"><?php echo stripslashes(get_option('PennyTheme_adv_code_cPT_page_above_content')); ?></textarea></td>
                </tr>
                
                
                <tr>
                <td valign="top"><?php _e('Below the content area:','PennyTheme'); ?></td>
                <td><textarea name="PennyTheme_adv_code_cPT_page_below_content" rows="6" cols="60"><?php echo stripslashes(get_option('PennyTheme_adv_code_cPT_page_below_content')); ?></textarea></td>
                </tr>	
                    
                  
                <tr>
                    <td ></td>
                    <td><input type="submit" name="PennyTheme_save3" value="<?php _e('Save Options','PennyTheme'); ?>"/></td>
                    </tr>  
                    
              </table>  
          	</form>
          </div> 
          
          <div id="tabs4">	
          <form method="post" action="<?php bloginfo('siteurl'); ?>/wp-admin/admin.php?page=PT_adv_&active_tab=tabs4">
          <table width="100%" class="sitemile-table">
    			<tr>
                <td valign="top"><?php _e('Above the content area:','PennyTheme'); ?></td>
                <td><textarea name="PennyTheme_adv_code_single_page_above_content" rows="6" cols="60"><?php echo stripslashes(get_option('PennyTheme_adv_code_single_page_above_content')); ?></textarea></td>
                </tr>
                
                
                <tr>
                <td valign="top"><?php _e('Below the content area:','PennyTheme'); ?></td>
                <td><textarea name="PennyTheme_adv_code_single_page_below_content" rows="6" cols="60"><?php echo stripslashes(get_option('PennyTheme_adv_code_single_page_below_content')); ?></textarea></td>
                </tr>	
                    
                  
                <tr>
                    <td ></td>
                    <td><input type="submit" name="PennyTheme_save4" value="<?php _e('Save Options','PennyTheme'); ?>"/></td>
                    </tr>  
                    
              </table>  
          	</form>
          </div>  

<?php 
	echo '</div>';		
	
}

function PennyTheme_general_options()
{
	$id_icon 		= 'icon-options-general2';
	$ttl_of_stuff 	= 'PennyTheme - '.__('General Settings','PennyTheme');
	global $menu_admin_PennyTheme_theme_bull;
	$arr = array("yes" => __("Yes",'PennyTheme'), "no" => __("No",'PennyTheme'));
	
	//------------------------------------------------------
	
	echo '<div class="wrap">';
	echo '<div class="icon32" id="'.$id_icon.'"><br/></div>';	
	echo '<h2 class="my_title_class_sitemile">'.$ttl_of_stuff.'</h2>';	
	
		if(isset($_POST['PennyTheme_save1']))
		{
			update_option('PennyTheme_show_views', 				trim($_POST['PennyTheme_show_views']));
			update_option('PennyTheme_admin_approve_auction', 		trim($_POST['PennyTheme_admin_approve_auction']));

			update_option('PennyTheme_enable_blog', 				trim($_POST['PennyTheme_enable_blog']));
			
			update_option('PennyTheme_enable_pay_credits', 				trim($_POST['PennyTheme_enable_pay_credits']));
			update_option('PennyTheme_max_time_to_wait', 			trim($_POST['PennyTheme_max_time_to_wait']));			
			update_option('PennyTheme_auction_time_listing',			 	trim($_POST['PennyTheme_auction_time_listing']));
			update_option('PennyTheme_auction_featured_time_listing', 		trim($_POST['PennyTheme_auction_featured_time_listing']));
			update_option('PennyTheme_show_limit_job_cnt', 				trim($_POST['PennyTheme_show_limit_job_cnt']));
			update_option('PennyTheme_listings_per_page_adv_search', 				trim($_POST['PennyTheme_listings_per_page_adv_search']));
			
			update_option('PennyTheme_location_permalink', 				trim($_POST['PennyTheme_location_permalink']));
			update_option('PennyTheme_category_permalink', 				trim($_POST['PennyTheme_category_permalink']));
			update_option('PennyTheme_auction_permalink', 				trim($_POST['PennyTheme_auction_permalink']));
			update_option('PennyTheme_enable_locations', 					trim($_POST['PennyTheme_enable_locations']));
			update_option('PennyTheme_show_front_slider', 				trim($_POST['PennyTheme_show_front_slider']));
			update_option('PennyTheme_show_main_menu', 					trim($_POST['PennyTheme_show_main_menu']));
			update_option('PennyTheme_show_stretch', 						trim($_POST['PennyTheme_show_stretch']));
			update_option('PennyTheme_only_admins_post_auctions', 						trim($_POST['PennyTheme_only_admins_post_auctions']));
			update_option('PennyTheme_dfff_tm', 						trim($_POST['PennyTheme_dfff_tm']));
			update_option('PennyTheme_home_page_nr_itms', 						trim($_POST['PennyTheme_home_page_nr_itms']));
			
			
			
			echo '<div class="saved_thing">'.__('Settings saved!','PennyTheme').'</div>';
		}
		
		if(isset($_POST['PennyTheme_save2']))
		{
			update_option('PennyTheme_filter_emails_private_messages', 				trim($_POST['PennyTheme_filter_emails_private_messages']));
			update_option('PennyTheme_filter_urls_private_messages', 					trim($_POST['PennyTheme_filter_urls_private_messages']));

			
			echo '<div class="saved_thing">'.__('Settings saved!','PennyTheme').'</div>';
		}
		
		if(isset($_POST['PennyTheme_save3']))
		{
			update_option('PennyTheme_enable_shipping', 						trim($_POST['PennyTheme_enable_shipping']));
			update_option('PennyTheme_enable_flPT_shipping', 					trim($_POST['PennyTheme_enable_flPT_shipping']));
			update_option('PennyTheme_enable_location_based_shipping', 		trim($_POST['PennyTheme_enable_location_based_shipping']));

			
			echo '<div class="saved_thing">'.__('Settings saved!','PennyTheme').'</div>';
		}
		

		
		if(isset($_POST['PennyTheme_save4']))
		{
			update_option('PennyTheme_enable_facebook_login', 	trim($_POST['PennyTheme_enable_facebook_login']));
			update_option('PennyTheme_facebook_app_id', 			trim($_POST['PennyTheme_facebook_app_id']));
			update_option('PennyTheme_facebook_app_secret', 		trim($_POST['PennyTheme_facebook_app_secret']));

			
			echo '<div class="saved_thing">'.__('Settings saved!','PennyTheme').'</div>';
		}
		
		
		if(isset($_POST['PennyTheme_save5']))
		{
			update_option('PennyTheme_enable_twitter_login', 			trim($_POST['PennyTheme_enable_twitter_login']));
			update_option('PennyTheme_twitter_consumer_key', 			trim($_POST['PennyTheme_twitter_consumer_key']));
			update_option('PennyTheme_twitter_consumer_secret', 		trim($_POST['PennyTheme_twitter_consumer_secret']));

			
			echo '<div class="saved_thing">'.__('Settings saved!','PennyTheme').'</div>';
		}
        
        if(isset($_POST['PennyTheme_save_regis_fields'])){
            for( $i = 1; $i <= 10; $i++ ){
                if( $_POST['registration_field'.$i] != '' ){
                    update_option('registration_field'.$i, trim($_POST['registration_field'.$i]));
                    if( $_POST['registration_field_reqd'.$i] == 1 ){
                        update_option('registration_field_reqd'.$i, trim($_POST['registration_field_reqd'.$i]));
                    }else{
                        update_option('registration_field_reqd'.$i, 0);
                    }    
                }else{
                    update_option('registration_field'.$i, '');
                    update_option('registration_field_reqd'.$i, 0);
                }
                update_option('registration_field_type'.$i, trim($_POST['registration_field_type'.$i]));
            }
            update_option('PennyTheme_show_tc', trim($_POST['PennyTheme_show_tc']) );
            update_option('PennyTheme_show_pv', trim($_POST['PennyTheme_show_pv']));
            update_option('PennyTheme_show_sr', trim($_POST['PennyTheme_show_sr']));
            
            update_option('PennyTheme_show_tc_reqd', trim($_POST['PennyTheme_show_tc_reqd']) );
            update_option('PennyTheme_show_pv_reqd', trim($_POST['PennyTheme_show_pv_reqd']));
            update_option('PennyTheme_show_sr_reqd', trim($_POST['PennyTheme_show_sr_reqd']));
            
            update_option('PennyTheme_auction_show_signin', trim($_POST['PennyTheme_auction_show_signin']));
            
        	echo '<div class="saved_thing">'.__('Settings saved!','PennyTheme').'</div>';		
        }
		
		do_action('PennyTheme_general_options_actions');
	
	?>
    
		  <div id="usual2" class="usual"> 
          <ul> 
            <li><a href="#tabs1"><?php _e('Main Settings','PennyTheme'); ?></a></li>
            <li><a href="#tabs2"><?php _e('User Registration Settings','PennyTheme'); ?></a></li> 
            <li><a href="#tabs4"><?php _e('Facebook Connect','PennyTheme'); ?></a></li>
            <li><a href="#tabs5"><?php _e('Twitter Connect','PennyTheme'); ?></a></li> 
          	<?php do_action('PennyTheme_general_options_tabs'); ?>
          </ul> 
          <div id="tabs1" >	
          
            <form method="post" action="">
            <table width="100%" class="sitemile-table">
    				
                    
                    <tr>
                    <td valign=top width="22"><?php PennyTheme_theme_bullet(); ?></td>
                    <td width="240"><?php _e('Number of Items on Homepage:','PennyTheme'); ?></td>
                    <td><input type="text" size="4" name="PennyTheme_home_page_nr_itms" value="<?php echo get_option('PennyTheme_home_page_nr_itms'); ?>"/></td>
                    </tr>
                    
                    
                    <tr>
                    <td valign=top width="22"><?php PennyTheme_theme_bullet(); ?></td>
                    <td width="240"><?php _e('Only increase timer in last:','PennyTheme'); ?></td>
                    <td><input type="text" size="4" name="PennyTheme_dfff_tm" value="<?php echo get_option('PennyTheme_dfff_tm'); ?>"/> seconds (*leave empty to always increase the timer)</td>
                    </tr>
                    
                    
                    <tr>
                    <td valign=top width="22"><?php PennyTheme_theme_bullet(); ?></td>
                    <td width="240"><?php _e('Show views in each auction page:','PennyTheme'); ?></td>
                    <td><?php echo PennyTheme_get_option_drop_down($arr, 'PennyTheme_show_views'); ?></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php PennyTheme_theme_bullet(); ?></td>
                    <td width="240"><?php _e('Admin approves each auction:','PennyTheme'); ?></td>
                    <td><?php echo PennyTheme_get_option_drop_down($arr, 'PennyTheme_admin_approve_auction'); ?></td>
                    </tr>
                    
                    
					<tr>
                    <td valign=top width="22"><?php PennyTheme_theme_bullet(); ?></td>
                    <td width="240"><?php _e('Enable Frontpage Slider:','PennyTheme'); ?></td>
                    <td><?php echo PennyTheme_get_option_drop_down($arr, 'PennyTheme_show_front_slider'); ?></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php PennyTheme_theme_bullet(); ?></td>
                    <td width="240"><?php _e('Enable Main Menu:','PennyTheme'); ?></td>
                    <td><?php echo PennyTheme_get_option_drop_down($arr, 'PennyTheme_show_main_menu'); ?></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php PennyTheme_theme_bullet(); ?></td>
                    <td width="240"><?php _e('Enable Stretch Area:','PennyTheme'); ?></td>
                    <td><?php echo PennyTheme_get_option_drop_down($arr, 'PennyTheme_show_stretch'); ?></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php PennyTheme_theme_bullet(); ?></td>
                    <td width="240"><?php _e('Enable Blog:','PennyTheme'); ?></td>
                    <td><?php echo PennyTheme_get_option_drop_down($arr, 'PennyTheme_enable_blog'); ?></td>
                    </tr>
                    

                    
                    <tr>
                    <td valign=top width="22"><?php PennyTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Auctions per Page:','PennyTheme'); ?></td>
                    <td><input type="text" size="6" name="PennyTheme_listings_per_page_adv_search" value="<?php echo get_option('PennyTheme_listings_per_page_adv_search'); ?>"/></td>
                    </tr>
                    
                    
                     <tr>
                    <td valign=top width="22"><?php PennyTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Slug for Auction Permalink:','PennyTheme'); ?></td>
                    <td><input type="text" size="30" name="PennyTheme_auction_permalink" value="<?php echo get_option('PennyTheme_auction_permalink'); ?>"/> *if left empty will show 'auctions'</td>
                    </tr>
                    

                    <tr>
                    <td valign=top width="22"><?php PennyTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Slug for Category Permalink:','PennyTheme'); ?></td>
                    <td><input type="text" size="30" name="PennyTheme_category_permalink" value="<?php echo get_option('PennyTheme_category_permalink'); ?>"/> *if left empty will show 'section'</td>
                    </tr>
        
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="PennyTheme_save1" value="<?php _e('Save Options','PennyTheme'); ?>"/></td>
                    </tr>
            
            </table>      
          	</form>
                    
          
          </div>
          
          <div id="tabs2">
                <form method="post" action="admin-menu-test.php">
                    <table width="55%" class="sitemile-table" style="text-align: center;">
                            <tr>
                                <th>&nbsp;</th>
                                <th>Field Name</th>
                                <th>Field Type</th>
                                <th>Required</th>
                            </tr>
                            
                            <tr>
                                <td valign=top width="22"><?php PennyTheme_theme_bullet(); ?></td>
                                <td><input style="width: 100%;" type="text" name="username" value="Username" /></td>
                                <td>
                                   <select style="width: 84px;">
                                    <option>Text</option>
                                    <option>Num</option>

                                     <option>Tel</option>
                                     <option>Email</option>

                                   </select>
                                </td>
                                <td><input type="checkbox" />
                                </td>
                            </tr>
                            <tr>
                                <td valign=top width="22"><?php PennyTheme_theme_bullet(); ?></td>
                                <td><input style="width: 100%;" type="text" id="firstname" value="First Name" /></td>
                                <td><select style="width: 84px;" >
                                     <option>Text</option>
                                     <option>Tel</option>
                                     <option>Email</option>
                                     <option>Num</option></select></td>
                                <td><input type="checkbox"/></td>
                            </tr>
                            <tr>
                                <td valign=top width="22"><?php PennyTheme_theme_bullet(); ?></td>
                                <td><input style="width: 100%;" type="text" id="lastname" value="Last Name" /></td>
                                <td><select style="width: 84px;" >
                                    <option>Text</option>
                                     <option>Tel</option>
                                     <option>Email</option>
                                     <option>Num</option></select></td>
                                <td><input type="checkbox" /></td>
                            </tr>
                            <tr>
                                <td valign=top width="22"><?php PennyTheme_theme_bullet(); ?></td>
                                <td><input style="width: 100%;" type="text" name="email" value="Email" /></td>
                                <td><select style="width: 84px;" >
                                 <option>Email</option>
                                 <option>Text</option>
                                     <option>Tel</option>

                                     <option>Num</option></select></td>
                                <td><input type="checkbox" /></td>
                            </tr>
                            
                            <?php for( $i = 1; $i <= 10; $i++ ){ ?>
                                <tr>
                                    <td valign=top width="22"><?php PennyTheme_theme_bullet(); ?></td>
                                    <td ><input style="width: 100%;" type="text" value="<?php echo get_option( 'registration_field'.$i ); ?>" name="<?php echo 'registration_field'.$i; ?>"/></td>
                                    <td>
                                        <select name="<?php echo 'registration_field_type'.$i; ?>">
                                            <option value="text" <?php if( get_option( 'registration_field_type'.$i ) == 'text' ) echo 'selected="selected"'; ?>>Text</option>
                                            <option value="textarea" <?php if( get_option( 'registration_field_type'.$i ) == 'textarea' ) echo 'selected="selected"'; ?>>Textbox</option>
                                        </select>
                                    </td>
                                    <td><input type="checkbox" value="1" name="<?php echo 'registration_field_reqd'.$i; ?>" <?php if( get_option( 'registration_field_reqd'.$i ) == 1 ) echo 'checked="checked"'; ?>/></td>
                                </tr>
                            <?php } ?>
                            
                            <tr>
                                <td valign=top width="22"><?php PennyTheme_theme_bullet(); ?></td>
                                <td style="text-align: left;"><?php _e('Show terms and conditions:','PennyTheme'); ?></td>
                                <td width="200">
                                    <input type="radio" name="PennyTheme_show_tc" value="1" <?php if( get_option('PennyTheme_show_tc') == 1 ) echo "checked='checked'"; ?>/>&nbsp;Yes&nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="PennyTheme_show_tc" value="0"  <?php if( get_option('PennyTheme_show_tc') == 0 ) echo "checked='checked'"; ?>/>&nbsp;No
                                </td>
                                <td><input type="checkbox" value="1" name="<?php echo 'PennyTheme_show_tc_reqd'; ?>" <?php if( get_option( 'PennyTheme_show_tc_reqd' ) == 1 ) echo 'checked="checked"'; ?>/></td>
                            </tr>
                            
                            <tr>
                                <td valign=top width="22"><?php PennyTheme_theme_bullet(); ?></td>
                                <td style="text-align: left;"><?php _e('Show privacy policy:','PennyTheme'); ?></td>
                                <td width="200">
                                    <input type="radio" name="PennyTheme_show_pv" value="1" <?php if( get_option('PennyTheme_show_pv') == 1 ) echo "checked='checked'"; ?>/>&nbsp;Yes&nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="PennyTheme_show_pv" value="0"  <?php if( get_option('PennyTheme_show_pv') == 0 ) echo "checked='checked'"; ?>/>&nbsp;No
                                </td>
                                <td><input type="checkbox" value="1" name="<?php echo 'PennyTheme_show_pv_reqd'; ?>" <?php if( get_option( 'PennyTheme_show_pv_reqd' ) == 1 ) echo 'checked="checked"'; ?>/></td>
                            </tr>
                            
                            <tr>
                                <td valign=top width="22"><?php PennyTheme_theme_bullet(); ?></td>
                                <td style="text-align: left;"><?php _e('Show site rules:','PennyTheme'); ?></td>
                                <td width="200">
                                    <input type="radio" name="PennyTheme_show_sr" value="1" <?php if( get_option('PennyTheme_show_sr') == 1 ) echo "checked='checked'"; ?>/>&nbsp;Yes&nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="PennyTheme_show_sr" value="0"  <?php if( get_option('PennyTheme_show_sr') == 0 ) echo "checked='checked'"; ?>/>&nbsp;No
                                </td>
                                <td><input type="checkbox" value="1" name="<?php echo 'PennyTheme_show_sr_reqd'; ?>" <?php if( get_option( 'PennyTheme_show_sr_reqd' ) == 1 ) echo 'checked="checked"'; ?>/></td>
                            </tr>
                            
                            <tr>
                                <td valign=top width="22"><?php PennyTheme_theme_bullet(); ?></td>
                                <td style="text-align: left;"><?php _e('Preview auctions:','PennyTheme'); ?></td>
                                <td width="400" colspan="2">
                                    <input type="radio" name="PennyTheme_auction_show_signin" value="0" <?php if( get_option('PennyTheme_auction_show_signin') == 0 ) echo "checked='checked'"; ?>/>&nbsp;Without sign-in&nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="PennyTheme_auction_show_signin" value="1"  <?php if( get_option('PennyTheme_auction_show_signin') == 1 ) echo "checked='checked'"; ?>/>&nbsp;After sign-in only
                                </td>
                            </tr>
                            
                            <tr>
                                <td ></td>
                                <td ></td>
                                <td><input type="submit" name="PennyTheme_save_regis_fields" value="<?php _e('Save Options','PennyTheme'); ?>"/></td>
                            </tr>
                    </table>
                </form>
          </div>
            
          <div id="tabs4">	
          <!--
          	<form method="post" action="<?php bloginfo('siteurl'); ?>/wp-admin/admin.php?page=general-options&active_tab=tabs4">
            <table width="100%" class="sitemile-table">
    				
                    <tr>
                    <td valign=top width="22"><?php PennyTheme_theme_bullet(); ?></td>
                    <td width="200"><?php _e('Enable Facebook Login:','PennyTheme'); ?></td>
                    <td><?php echo PennyTheme_get_option_drop_down($arr, 'PennyTheme_enable_facebook_login'); ?></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php PennyTheme_theme_bullet(); ?></td>
                    <td width="250"><?php _e('Facebook App ID:','PennyTheme'); ?></td>
                    <td><input type="text" size="35" name="PennyTheme_facebook_app_id" value="<?php echo get_option('PennyTheme_facebook_app_id'); ?>"/></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php PennyTheme_theme_bullet(); ?></td>
                    <td width="250"><?php _e('Facebook Secret Key:','PennyTheme'); ?></td>
                    <td><input type="text" size="35" name="PennyTheme_facebook_app_secret" value="<?php echo get_option('PennyTheme_facebook_app_secret'); ?>"/></td>
                    </tr>
  
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="PennyTheme_save4" value="<?php _e('Save Options','PennyTheme'); ?>"/></td>
                    </tr>
            
            </table>      
          	</form> --> For facebook connect, install this plugin: <a href="http://wordpress.org/extend/plugins/wordpress-social-login/">WordPress Social Login</a>
          
          </div>
           
          <div id="tabs5">	
          
         <!-- <form method="post" action="<?php bloginfo('siteurl'); ?>/wp-admin/admin.php?page=general-options&active_tab=tabs5">
            <table width="100%" class="sitemile-table">
    				
                    <tr>
                    <td valign=top width="22"><?php PennyTheme_theme_bullet(); ?></td>
                    <td width="200"><?php _e('Enable Twitter Login:','PennyTheme'); ?></td>
                    <td><?php echo PennyTheme_get_option_drop_down($arr, 'PennyTheme_enable_twitter_login'); ?></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php PennyTheme_theme_bullet(); ?></td>
                    <td width="250"><?php _e('Twitter Consumer Key:','PennyTheme'); ?></td>
                    <td><input type="text" size="35" name="PennyTheme_twitter_consumer_key" value="<?php echo get_option('PennyTheme_twitter_consumer_key'); ?>"/></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php PennyTheme_theme_bullet(); ?></td>
                    <td width="250"><?php _e('Twitter Consumer Secret:','PennyTheme'); ?></td>
                    <td><input type="text" size="35" name="PennyTheme_twitter_consumer_secret" value="<?php echo get_option('PennyTheme_twitter_consumer_secret'); ?>"/></td>
                    </tr>
  					
                    
                    
  						<tr>
                    <td valign=top width="22"><?php PennyTheme_theme_bullet(); ?></td>
                    <td width="250"><?php _e('Callback URL:','PennyTheme'); ?></td>
                    <td><?php echo get_bloginfo('template_url'); ?>/lib/social/twitter/callback.php</td>
                    </tr>
  
  
  
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="PennyTheme_save5" value="<?php _e('Save Options','PennyTheme'); ?>"/></td>
                    </tr>
            
            </table>      
          	</form> --> For twitter connect, install this plugin: <a href="http://wordpress.org/extend/plugins/wordpress-social-login/">WordPress Social Login</a>
          </div>
    		
          <?php do_action('PennyTheme_general_options_div_content'); ?>  

<?php
	echo '</div>';	
	
}

function PennyTheme_payment_gateways()
{
	
	$id_icon 		= 'icon-options-general4';
	$ttl_of_stuff 	= 'PennyTheme - Payment Methods';
	global $menu_admin_PennyTheme_theme_bull;
	$arr = array("yes" => __("Yes",'PennyTheme'), "no" => __("No",'PennyTheme'));
	
	//------------------------------------------------------
	
	echo '<div class="wrap">';
	echo '<div class="icon32" id="'.$id_icon.'"><br/></div>';	
	echo '<h2 class="my_title_class_sitemile">'.$ttl_of_stuff.'</h2>';	
	
	//--------------------------
	
	do_action('PennyTheme_payment_methods_action');
	if(isset($_POST['PennyTheme_save1']))
	{
		update_option('PennyTheme_paypal_enable', 		    trim($_POST['PennyTheme_paypal_enable']));
		update_option('PennyTheme_paypal_email', 			trim($_POST['PennyTheme_paypal_email']));
		update_option('PennyTheme_paypal_enable_sdbx', 	    trim($_POST['PennyTheme_paypal_enable_sdbx']));

        update_option('PennyTheme_paypal_enable_adaptive', 	trim($_POST['PennyTheme_paypal_enable_adaptive']));
        update_option('PennyTheme_paypal_checkout_screen', 	trim($_POST['PennyTheme_paypal_checkout_screen']));
        update_option('PennyTheme_paypal_payment_model', 	trim($_POST['PennyTheme_paypal_payment_model']));
        update_option('PennyTheme_paypal_signature', 	    trim($_POST['PennyTheme_paypal_signature']));
        update_option('PennyTheme_paypal_api_password', 	trim($_POST['PennyTheme_paypal_api_password']));
        update_option('PennyTheme_paypal_api_user', 	    trim($_POST['PennyTheme_paypal_api_user']));
        update_option('PennyTheme_paypal_application_id', 	trim($_POST['PennyTheme_paypal_application_id']));	
		
		echo '<div class="saved_thing">'.__('Settings saved!','PennyTheme').'</div>';		
	}
	
	if(isset($_POST['PennyTheme_save2']))
	{
		update_option('PennyTheme_alertpay_enable', trim($_POST['PennyTheme_alertpay_enable']));
		update_option('PennyTheme_alertpay_email', trim($_POST['PennyTheme_alertpay_email']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','PennyTheme').'</div>';		
	}
	
	if(isset($_POST['PennyTheme_save3']))
	{
		update_option('PennyTheme_moneybookers_enable', trim($_POST['PennyTheme_moneybookers_enable']));
		update_option('PennyTheme_moneybookers_email', trim($_POST['PennyTheme_moneybookers_email']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','PennyTheme').'</div>';		
	}
	
	if(isset($_POST['PennyTheme_save4']))
	{
		update_option('PennyTheme_ideal_enable', trim($_POST['PennyTheme_ideal_enable']));
		update_option('PennyTheme_ideal_email', trim($_POST['PennyTheme_ideal_email']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','PennyTheme').'</div>';		
	}
	
	?>


	    <div id="usual2" class="usual"> 
          <ul> 
            <li><a href="#tabs1">PayPal</a></li> 
            <li><a href="#tabs2">Payza</a></li> 
            <li><a href="#tabs3">Moneybookers/Skrill</a></li> 
            
            <li><a href="#tabs_offline"><?php _e('Bank Payment(offline)','PennyTheme'); ?></a></li>
            <?php do_action('PennyTheme_payment_methods_tabs'); ?>
             
          </ul> 
          <div id="tabs1"  >	
          
          <form method="post" action="<?php bloginfo('siteurl'); ?>/wp-admin/admin.php?page=PT_pay_gate_&active_tab=tabs1">
            <table width="100%" class="sitemile-table">
    				
                    <tr>
                    <td valign=top width="22"><?php PennyTheme_theme_bullet(); ?></td>
                    <td width="200"><?php _e('Enable:','PennyTheme'); ?></td>
                    <td><?php echo PennyTheme_get_option_drop_down($arr, 'PennyTheme_paypal_enable'); ?></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php PennyTheme_theme_bullet(); ?></td>
                    <td width="200"><?php _e('PayPal Enable Sandbox:','PennyTheme'); ?></td>
                    <td><?php echo PennyTheme_get_option_drop_down($arr, 'PennyTheme_paypal_enable_sdbx'); ?></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php PennyTheme_theme_bullet(); ?></td>
                    <td ><?php _e('PayPal Email Address:','PennyTheme'); ?></td>
                    <td><input type="text" size="45" name="PennyTheme_paypal_email" value="<?php echo get_option('PennyTheme_paypal_email'); ?>"/></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php PennyTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Enable Paypal Adaptive:','PennyTheme'); ?></td>
                    <td><?php echo PennyTheme_get_option_drop_down($arr, 'PennyTheme_paypal_enable_adaptive'); ?></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php PennyTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Checkout Screen:','PennyTheme'); ?></td>
                    <td>
                        <select name="PennyTheme_paypal_checkout_screen">
                            <option>Select checkout screen</option>
                            <option <?php if( get_option('PennyTheme_paypal_checkout_screen') == 'normal' ) echo 'selected="selected"'; ?> value="normal">Normal Checkout Screen</option>
                        </select>
                    </td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php PennyTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Payment Model:','PennyTheme'); ?></td>
                    <td>
                        <select name="PennyTheme_paypal_payment_model">
                            <option>Select payment model</option>
                            <option <?php if( get_option('PennyTheme_paypal_payment_model') == 'parallel' ) echo 'selected="selected"'; ?> value="parallel">Parallel Payments</option>
                        </select>
                    </td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php PennyTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Signature:','PennyTheme'); ?></td>
                    <td><input type="text" size="45" name="PennyTheme_paypal_signature" value="<?php echo get_option('PennyTheme_paypal_signature'); ?>"/></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php PennyTheme_theme_bullet(); ?></td>
                    <td ><?php _e('API Password:','PennyTheme'); ?></td>
                    <td><input type="text" size="45" name="PennyTheme_paypal_api_password" value="<?php echo get_option('PennyTheme_paypal_api_password'); ?>"/></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php PennyTheme_theme_bullet(); ?></td>
                    <td ><?php _e('API User:','PennyTheme'); ?></td>
                    <td><input type="text" size="45" name="PennyTheme_paypal_api_user" value="<?php echo get_option('PennyTheme_paypal_api_user'); ?>"/></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php PennyTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Application ID:','PennyTheme'); ?></td>
                    <td><input type="text" size="45" name="PennyTheme_paypal_application_id" value="<?php echo get_option('PennyTheme_paypal_application_id'); ?>"/></td>
                    </tr>
                
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="PennyTheme_save1" value="<?php _e('Save Options','PennyTheme'); ?>"/></td>
                    </tr>
            
            </table>      
          	</form>
          
          </div>
          
          <div id="tabs2" >	
          
          <form method="post" action="<?php bloginfo('siteurl'); ?>/wp-admin/admin.php?page=PT_pay_gate_&active_tab=tabs2">
            <table width="100%" class="sitemile-table">
    				
                    <tr>
                    <td valign=top width="22"><?php PennyTheme_theme_bullet(); ?></td>
                    <td width="200"><?php _e('Enable:','PennyTheme'); ?></td>
                    <td><?php echo PennyTheme_get_option_drop_down($arr, 'PennyTheme_alertpay_enable'); ?></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php PennyTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Payza/Alertpay Email:','PennyTheme'); ?></td>
                    <td><input type="text" size="45" name="PennyTheme_alertpay_email" value="<?php echo get_option('PennyTheme_alertpay_email'); ?>"/></td>
                    </tr>
                    
  
        
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="PennyTheme_save2" value="<?php _e('Save Options','PennyTheme'); ?>"/></td>
                    </tr>

            
            </table>      
          	</form>
          
          </div>
          
          <div id="tabs3">
          <form method="post" action="<?php bloginfo('siteurl'); ?>/wp-admin/admin.php?page=PT_pay_gate_&active_tab=tabs3">
            <table width="100%" class="sitemile-table">
    				
                    <tr>
                    <td valign=top width="22"><?php PennyTheme_theme_bullet(); ?></td>
                    <td width="200"><?php _e('Enable:','PennyTheme'); ?></td>
                    <td><?php echo PennyTheme_get_option_drop_down($arr, 'PennyTheme_moneybookers_enable'); ?></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php PennyTheme_theme_bullet(); ?></td>
                    <td ><?php _e('MoneyBookers Email:','PennyTheme'); ?></td>
                    <td><input type="text" size="45" name="PennyTheme_moneybookers_email" value="<?php echo get_option('PennyTheme_moneybookers_email'); ?>"/></td>
                    </tr>
                    
  
        
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="PennyTheme_save3" value="<?php _e('Save Options','PennyTheme'); ?>"/></td>
                    </tr>
            
            </table>      
          	</form>
          		
          </div> 
          
          <?php do_action('PennyTheme_payment_methods_content_divs'); ?>

<?php
	echo '</div>';	
  	
	
}

function PennyTheme_pricing_options()
{
	$id_icon 		= 'icon-options-general4';
	$ttl_of_stuff 	= 'PennyTheme - '.__('Pricing Settings','PennyTheme');
	$arr = array("yes" => __("Yes",'PennyTheme'), "no" => __("No",'PennyTheme'));
	$sep = array( "," => __('Comma (,)','PennyTheme'), "." => __("Point (.)",'PennyTheme'));
	$frn = array( "front" => __('In front of sum (eg: $50)','PennyTheme'), "back" => __("After the sum (eg: 50$)",'PennyTheme'));
	global $menu_admin_PennyTheme_theme_bull, $wpdb;
	
	$arr_currency = array("USD" => "US Dollars", "EUR" => "Euros", "CAD" => "Canadian Dollars", "CHF" => "Swiss Francs","GBP" => "British Pounds",
						  "AUD" => "Australian Dollars","NZD" => "New Zealand Dollars","BRL" => "Brazilian Real", 'PLN' => 'Polish zloty',
						  "SGD" => "Singapore Dollars","SEK" => "Swidish Kroner","NOK" => "Norwegian Kroner","DKK" => "Danish Kroner",
						  "MXN" => "Mexican Pesos","JPY" => "Japanese Yen","EUR" => "Euros", "ZAR" => "South Africa Rand", 'RUB' => 'Russian Ruble' , "TRY" => "Turkish Lyra",  "RON" => "Romanian Lei",
						  "PHP" => 'Philippine peso'  ,  'INR' => 'Indian Rupee', 'PKR' => 'Pakistani Rupee');
	
	//------------------------------------------------------
	
	echo '<div class="wrap">';
	echo '<div class="icon32" id="'.$id_icon.'"><br/></div>';	
	echo '<h2 class="my_title_class_sitemile">'.$ttl_of_stuff.'</h2>';	

	//-------------------
	
	if(isset($_POST['PennyTheme_save1']))
	{
		$PennyTheme_currency 						= trim($_POST['PennyTheme_currency']);
		$PennyTheme_currency_symbol 				= trim($_POST['PennyTheme_currency_symbol']);
		$PennyTheme_currency_position 			= trim($_POST['PennyTheme_currency_position']);
		$PennyTheme_decimal_sum_separator 		= trim($_POST['PennyTheme_decimal_sum_separator']);
		$PennyTheme_thousands_sum_separator 		= trim($_POST['PennyTheme_thousands_sum_separator']);

		update_option('PennyTheme_currency', 					$PennyTheme_currency);
		update_option('PennyTheme_currency_symbol', 			$PennyTheme_currency_symbol);
		update_option('PennyTheme_currency_position', 		$PennyTheme_currency_position);
		update_option('PennyTheme_decimal_sum_separator', 	$PennyTheme_decimal_sum_separator);
		update_option('PennyTheme_thousands_sum_separator', 	$PennyTheme_thousands_sum_separator);

	
		
		echo '<div class="saved_thing">'.__('Settings saved!','PennyTheme').'</div>';	
	}
	
	if(isset($_POST['PennyTheme_save2']))
	{

		$PennyTheme_new_auction_listing_fee 			= trim($_POST['PennyTheme_new_auction_listing_fee']);
		$PennyTheme_new_auction_fePT_listing_fee 		= trim($_POST['PennyTheme_new_auction_fePT_listing_fee']);
		$PennyTheme_withdraw_limit					= trim($_POST['PennyTheme_withdraw_limit']);
		$PennyTheme_percent_fee_taken					= trim($_POST['PennyTheme_percent_fee_taken']);
		$PennyTheme_solid_fee_taken					= trim($_POST['PennyTheme_solid_fee_taken']);
		$PennyTheme_new_auction_sealed_bidding_fee	= trim($_POST['PennyTheme_new_auction_sealed_bidding_fee']);
		
		update_option('PennyTheme_new_auction_listing_fee', 					$PennyTheme_new_auction_listing_fee);
		update_option('PennyTheme_new_auction_sealed_bidding_fee', 			$PennyTheme_new_auction_sealed_bidding_fee);
		update_option('PennyTheme_solid_fee_taken', 							$PennyTheme_solid_fee_taken);
		update_option('PennyTheme_percent_fee_taken', 						$PennyTheme_percent_fee_taken);
		update_option('PennyTheme_withdraw_limit', 							$PennyTheme_withdraw_limit);
		update_option('PennyTheme_new_auction_fePT_listing_fee', 				$PennyTheme_new_auction_fePT_listing_fee);
	
		
		echo '<div class="saved_thing">'.__('Settings saved!','PennyTheme').'</div>';	
	}
	
	
	if(isset($_POST['PennyTheme_save3']))
	{

		$PennyTheme_take_percent_fee 				= trim($_POST['PennyTheme_take_percent_fee']);
		$PennyTheme_take_flPT_fee 		= trim($_POST['PennyTheme_take_flPT_fee']);
		$auction_theme_min_withdraw			= trim($_POST['auction_theme_min_withdraw']);
	
		update_option('auction_theme_min_withdraw', 			$auction_theme_min_withdraw);
		update_option('PennyTheme_take_percent_fee', 			$PennyTheme_take_percent_fee);
		update_option('PennyTheme_take_flPT_fee', 	$PennyTheme_take_flPT_fee);
	
		
		echo '<div class="saved_thing">'.__('Settings saved!','PennyTheme').'</div>';	
	}
	
	
	if(isset($_POST['PennyTheme_addnewcost']))
	{
		$cost = trim($_POST['newcost']);
		$ss = "insert into ".$wpdb->prefix."job_var_costs (cost) values('$cost')";
		$wpdb->query($ss);
		
		echo '<div class="saved_thing">'.__('Settings saved!','PennyTheme').'</div>';	
	}


?>

	    <div id="usual2" class="usual"> 
          <ul> 
            <li><a href="#tabs1"><?php _e('Main Details','PennyTheme'); ?></a></li> 
            <li><a href="#tabs2"><?php _e('Bidding Packages','PennyTheme'); ?></a></li> 


            
          </ul> 
          <div id="tabs1">	
          
          	 <form method="post" action="<?php echo get_bloginfo('siteurl'); ?>/wp-admin/admin.php?page=PT_pr_set_&active_tab=tabs1">
            <table width="100%" class="sitemile-table">
    				
                     <tr>
                    <td valign=top width="22"><?php PennyTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Site currency:','PennyTheme'); ?></td>
                    <td><?php echo PennyTheme_get_option_drop_down($arr_currency, 'PennyTheme_currency'); ?></td>
                    </tr>
                    
                    
                    <tr>
                    <td valign=top width="22"><?php PennyTheme_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Currency symbol:','PennyTheme'); ?></td>
                    <td><input type="text" size="6" name="PennyTheme_currency_symbol" value="<?php echo get_option('PennyTheme_currency_symbol'); ?>"/> </td>
                    </tr>
                    
                     <tr>
                    <td valign=top width="22"><?php PennyTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Currency symbol position:','PennyTheme'); ?></td>
                    <td><?php echo PennyTheme_get_option_drop_down($frn, 'PennyTheme_currency_position'); ?></td>
                    </tr>
                    
                    
                     <tr>
                    <td valign=top width="22"><?php PennyTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Decimals sum separator:','PennyTheme'); ?></td>
                    <td><?php echo PennyTheme_get_option_drop_down($sep, 'PennyTheme_decimal_sum_separator'); ?></td>
                    </tr>
                    
                     <tr>
                    <td valign=top width="22"><?php PennyTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Thousands sum separator:','PennyTheme'); ?></td>
                    <td><?php echo PennyTheme_get_option_drop_down($sep, 'PennyTheme_thousands_sum_separator'); ?></td>
                    </tr>
      
                   
                    
        
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="PennyTheme_save1" value="<?php _e('Save Options','PennyTheme'); ?>"/></td>
                    </tr>
            
            </table>      
          	</form>
          
          
          </div>
          
          <div id="tabs2" style="display: none; ">
          
         			<h3>Define New Package</h3>
            
            
            <div class="MY_mo_gogo" id="">
                
                    <div class="go_go1">
                    <div class="go_go2_1">Package name:</div> <div class="go_go2_2"><input id="new_package_name" value="" /></div>
                    </div>
                    
                    
                    <div class="go_go1">
                    <div class="go_go2_1">Package cost(<?php echo PennyTheme_currency(); ?>):</div> 
                    <div class="go_go2_2"><input id="new_package_cost" value="" /></div>
                    </div>
                    
                    
                    <div class="go_go1">
                    <div class="go_go2_1">Package bids:</div> <div class="go_go2_2"><input id="new_package_bid" value="" /> </div>
                    </div>
                
                	<div class="go_go1"><a href="#" id="new_package_action" rel="" class="green_btn2">Add New Package</a>
                    </div>
                
                </div>
            
            
		<!-- ############### -->
        <h3>Current Defined Packages</h3>
        <div id="my_packages_stuff">
        
		<?php
		
		global $wpdb;
		$s = "select * from ".$wpdb->prefix."penny_packages order by cost asc";
		$r = $wpdb->get_results($s);
		
		foreach($r as $row)
		{
			?>
            	<div class="MY_mo_gogo" id="my_pkg_cell<?php echo $row->id; ?>">
                
                    <div class="go_go1">
                    <div class="go_go2_1">Package name:</div> <div class="go_go2_2"><input name="" id="new_package_name_cell<?php echo $row->id; ?>" 
                    value="<?php echo $row->package_name; ?>" /></div>
                    </div>
                    
                    
                    <div class="go_go1">
                    <div class="go_go2_1">Package cost(<?php echo PennyTheme_currency(); ?>):</div> 
                    <div class="go_go2_2"><input name="" id="new_package_cost_cell<?php echo $row->id; ?>" value="<?php echo $row->cost; ?>" /></div>
                    </div>
                    
                    
                    <div class="go_go1">
                    <div class="go_go2_1">Package bids:</div> <div class="go_go2_2"><input 
                    name="" id="new_package_bid_cell<?php echo $row->id; ?>" value="<?php echo $row->bids; ?>" /> </div>
                    </div>
                
                	<div class="go_go1"><a href="#" rel="<?php echo $row->id; ?>" class="update_package green_btn2">Update Package</a> 
                    <a href="#" rel="<?php echo $row->id; ?>" class="delete_package green_btn">Delete Package</a>
                    </div>
                
                </div>
            
            <?php
			
		}
		
		?>
		
		</div>
         
          </div>
          
          
         
         
          
    
       

<?php
	echo '</div>';		
	
	
}

function PennyTheme_user_balances()
{
    global $wpdb;  
    
    // add user in auction
    if( isset( $_POST['add_user_in_auction'] ) ){
        $add_user_in_auction_auction = $_POST['add_user_in_auction_auction'];
        $add_user_in_auction_user    = $_POST['add_user_in_auction_user'];
        $add_user_in_auction_seats   = $_POST['add_user_in_auction_seats'];
        
        if( $add_user_in_auction_auction > 0 && $add_user_in_auction_user > 0 && get_auction_remaining_seats($add_user_in_auction_auction) >= $add_user_in_auction_seats ){
            $wpdb->query(" INSERT INTO ".$wpdb->prefix."auctions_seats SET uid = '$add_user_in_auction_user', pid = '$add_user_in_auction_auction'
                             , seats = '$add_user_in_auction_seats' ");
            echo '<div class="saved_thing">Seat(s) added successfully!</div>';    
        }elseif( get_auction_remaining_seats($add_user_in_auction_auction) < $add_user_in_auction_seats ){
            echo '<div class="delete_thing">Please enter seats under available seats</div>';
        }
    }
    
    // refund  
    if( isset( $_POST['refund_submit'] ) OR $_GET['stage'] == 'paypal' ){
        $refund_amnt  = $_POST['refund_amnt_paypal'];
        $refund_user  = $_POST['refund_user_paypal'];
        $user_info    = get_userdata( $refund_user );
        $refund_email = $user_info->user_email;
        $this_script   = get_bloginfo('siteurl').$_SERVER['REQUEST_URI'];  
        
        $refund_medium   = $_POST['refund_medium'];
                
        if( $refund_medium == 'paypal_refund' ){
            
            include_once('gateways/refund_credits_paypal.php');
            
        }elseif( $refund_medium == 'website_refund' ){
            $refund_user     = $_POST['refund_user'];
            $keep_in_auction = $_POST['keep_in_auction'];
            $refund_auction  = $_POST['refund_auction'];
            $refund_amnt     = $_POST['refund_amnt'];
                    
            if( is_array( $refund_user ) && count($refund_user) > 0 ){
                foreach( $refund_user as $ref_user_id ){
                    if( $ref_user_id > 0 ){ 
                        $check = $wpdb->get_row(" SELECT uid FROM ".$wpdb->prefix."user_available_credits WHERE uid = '$ref_user_id' ");
                        if( $check->uid > 0 ){
                            $wpdb->query(" UPDATE ".$wpdb->prefix."user_available_credits SET credit = credit + '$refund_amnt' WHERE uid = '$ref_user_id' LIMIT 1" );
                        }else{
                            $wpdb->query(" INSERT INTO ".$wpdb->prefix."user_available_credits SET uid = '$ref_user_id', credit = '$refund_amnt'" );    
                        }
                        $wpdb->query(" INSERT INTO ".$wpdb->prefix."credit_refund_history SET uid = '$ref_user_id', credit = '$refund_amnt', method = 'manual'" );
                        if( $keep_in_auction == 0 ){
                            $get_user_auction_seats = get_user_auction_seats( $refund_auction, $ref_user_id ); 
                            $get_auction_seats = get_post_meta( $refund_auction, 'seats', true );
                            $new_total_seats = $get_user_auction_seats+$get_auction_seats;
                            update_post_meta( $refund_auction, 'seats', $new_total_seats );
                            $wpdb->query(" DELETE FROM ".$wpdb->prefix."auctions_seats WHERE uid = '$ref_user_id' AND pid = '$refund_auction' ");
                        }                        
                    }
                }
                echo '<div class="saved_thing">Amount refunded successfully!</div>';
            }
        }
        
        if( $_GET['stage'] == 'paypal' ){
            include_once('gateways/refund_credits_paypal.php');
        }     
    }
    
    
    if( $_GET['status'] == 'done' ){
        echo '<div class="saved_thing">Amount refunded successfully!</div>';
    }
    
	global $menu_admin_auction_theme_bull;
	echo '<div class="wrap">';
	echo '<div class="icon32" id="icon-options-general-bal"><br/></div>';	
	echo '<h2 class="my_title_class_sitemile">PennyTheme User Balances</h2>';
	?>
    
        <div id="usual2" class="usual"> 
  <ul> 
    <li><a href="#tabs1" class="selected">All Users</a></li> 
    <li><a href="#tabs2">Search User</a></li> 
    <li><a href="#tabs3">Refund Amount</a></li>
    <li><a href="#tabs4">Add user in Auction</a></li>
  </ul> 
  <div id="tabs1" style="display: none; ">
    	
        
	<?php
	
	$rows_per_page = 10;
	
	if(isset($_GET['pj'])) $pageno = $_GET['pj'];
	else $pageno = 1;
	
	global $wpdb;

	$s1 = "select ID from ".$wpdb->users." order by user_login asc ";
	$s = "select * from ".$wpdb->users." order by user_login asc ";
	$limit = 'LIMIT ' .($pageno - 1) * $rows_per_page .',' .$rows_per_page;
	
	
	$r = $wpdb->get_results($s1); $nr = count($r);
	$lastpage      = ceil($nr/$rows_per_page);
	
	$r = $wpdb->get_results($s.$limit);

	if($nr > 0)	
	{
		
		?>
		
		
		        <table class="widefat post fixed" cellspacing="0">
    <thead>
    <tr>
    <th width="15%">Username</th>
    <th width="20%">Email</th>
    <th width="20%">Date Registered</th>
    <th width="13%" >Cash Balance</th>
	<th >Options</th>
    </tr>
    </thead>
    
    <script>
	
	 jQuery(document).ready(function() {
  
  	jQuery('.update_btn*').click(function() {
	
	var id = jQuery(this).attr('alt');
	var increase_credits = jQuery('#increase_credits' + id).val();
	var decrease_credits = jQuery('#decrease_credits' + id).val();
	
	jQuery.ajax({
   type: "POST",
   url: "<?php echo get_bloginfo('siteurl'); ?>/",
   data: "crds=1&uid="+id+"&increase_credits="+increase_credits+"&decrease_credits="+decrease_credits,
   success: function(msg){
     
	 
	jQuery("#money" + id).html(msg);
	jQuery('#increase_credits' + id).val("");
	jQuery('#decrease_credits' + id).val(""); 
	 
   }
 });
	
	});
  
  
 });
	
	
	</script>
    
    <tbody>
		
		
		<?php 
		
		
	foreach($r as $row)
	{
		$user = get_userdata($row->ID);
		

		echo '<tr style="">';	
		echo '<th>'.$user->user_login.'</th>';
		echo '<th>'.$row->user_email .'</th>';
		echo '<th>'.$row->user_registered .'</th>';
		echo '<th class="'.$cl.'"><span id="money'.$row->ID.'">'.$sign. PennyTheme_get_credits($row->ID) .'</span></th>';
		echo '<th>'; 
		?>
		
        Increase Credits: <input type="text" size="4" id="increase_credits<?php echo $row->ID; ?>" rel="<?php echo $row->ID; ?>" /> <br/>
        Decrease Credits: <input type="text" size="4" id="decrease_credits<?php echo $row->ID; ?>" rel="<?php echo $row->ID; ?>" /> <br/>
        
        <input type="button" value="Update" class="update_btn" alt="<?php echo $row->ID; ?>" />
        
        
        <?php
		echo '</th>';
	
		echo '</tr>';
	}
	
	
	?>



	</tbody>
    
    </table>
    
    <?php 
    
	for($i=1;$i<=$lastpage;$i++)
		{
			if($pageno == $i) echo $i." | ";
			else			
			echo '<a href="'.get_bloginfo('siteurl').'/wp-admin/admin.php?page=PT_user_bal_&pj='.$i.'"
			>'.$i.'</a> | ';	
			
		}
		
	}
    
    ?>
          </div> 
          <div id="tabs2" >
          <form method="get" action="<?php echo get_bloginfo('siteurl'); ?>/wp-admin/admin.php">
          <input type="hidden" name="page" value="PT_user_bal_" />
          <input type="hidden" name="active_tab" value="tabs2" />
          Search User: <input type="text" size="35" value="<?php echo $_GET['src_usr']; ?>" name="src_usr" />
           <input type="submit" value="Submit" name="" />
          </form>
          
          <?php
		  if(!empty($_GET['src_usr'])):
		  
		  ?>
          
          <?php
	
	$rows_per_page = 10;
	
	if(isset($_GET['pj'])) $pageno = $_GET['pj'];
	else $pageno = 1;
	
	global $wpdb;
	$src_usr = $_GET['src_usr'];
	
	$s1 = "select ID from ".$wpdb->users." where user_login like '%$src_usr%' order by user_login asc ";
	$s = "select * from ".$wpdb->users." where user_login like '%$src_usr%' order by user_login asc ";
	$limit = 'LIMIT ' .($pageno - 1) * $rows_per_page .',' .$rows_per_page;
	
	
	$r = $wpdb->get_results($s1); $nr = count($r);
	$lastpage      = ceil($nr/$rows_per_page);
	
	$r = $wpdb->get_results($s.$limit);

	if($nr > 0)	
	{
		
		?>
		
		
		        <table class="widefat post fixed" cellspacing="0">
    <thead>
    <tr>
    <th width="15%">Username</th>
    <th width="20%">Email</th>
    <th width="20%">Date Registered</th>
    <th width="13%" >Cash Balance</th>
	<th >Options</th>
    </tr>
    </thead>
    
    <script>
	
	 $(document).ready(function() {
  
  	$('.update_btn*').click(function() {
	
	var id = $(this).attr('alt');
	var increase_credits = $('#increase_credits' + id).val();
	var decrease_credits = $('#decrease_credits' + id).val();
	
	$.ajax({
   type: "POST",
   url: "<?php echo get_bloginfo('siteurl'); ?>/",
   data: "crds=1&uid="+id+"&increase_credits="+increase_credits+"&decrease_credits="+decrease_credits,
   success: function(msg){
     
	 
	$("#money" + id).html(msg);
	$('#increase_credits' + id).val("");
	$('#decrease_credits' + id).val(""); 
	 
   }
 });
	
	});
  
  
 });
	
	
	</script>
    
    <tbody>
		
		
		<?php 
		
		
	foreach($r as $row)
	{
		$user = get_userdata($row->ID);
		

		echo '<tr style="">';	
		echo '<th>'.$user->user_login.'</th>';
		echo '<th>'.$row->user_email .'</th>';
		echo '<th>'.$row->user_registered .'</th>';
		echo '<th class="'.$cl.'"><span id="money'.$row->ID.'">'.$sign. (PennyTheme_get_credits($row->ID)) .'</span></th>';
		echo '<th>'; 
		?>
		
        Increase Credits: <input type="text" size="4" id="increase_credits<?php echo $row->ID; ?>" rel="<?php echo $row->ID; ?>" /> <br/>
        Decrease Credits: <input type="text" size="4" id="decrease_credits<?php echo $row->ID; ?>" rel="<?php echo $row->ID; ?>" /> <br/>
        
        <input type="button" value="Update" class="update_btn" alt="<?php echo $row->ID; ?>" />
        
        
        <?php
		echo '</th>';
	
		echo '</tr>';
	}
	
	
	?>



	</tbody>
    
    </table>
    
    <?php 
    
	for($i=1;$i<=$lastpage;$i++)
		{
			if($pageno == $i) echo $i." | ";
			else			
			echo '<a href="'.get_bloginfo('siteurl').'/wp-admin/admin.php?active_tab=tabs2&src_usr='.$_GET['src_usr'].'&page=PT_user_bal_&pj='.$i.'"
			>'.$i.'</a> | ';	
			
		}
		
	}
    
    ?>
          
          
          <?php endif; ?>
          
          </div>
          
          
          <div id="tabs3">
            <script type="text/javascript" >
                jQuery(function(){
                    jQuery('.refund_medium').find(':first').attr('checked','checked');
                    jQuery('.refund_medium').click(function(){
                        jQuery('#paypal_refund_wrapper').hide();
                        jQuery('#website_refund_wrapper').show();
                        if( jQuery(this).val() == 'paypal_refund' ){
                            jQuery('#paypal_refund_wrapper').show();
                            jQuery('#website_refund_wrapper').hide();    
                        }
                    })
                    
                    jQuery('#refund_auction').change(function() {
                        var pid = jQuery(this).val();
                        if( pid > 0 ){
                            jQuery('#refund_user').html('<option>loading...</option>');    
                        }
                        var data = {
                			'action': 'get_auction_users',
                			'pid': pid
                		};
                        var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
                		jQuery.post(ajaxurl, data, function(response) {
                		  if( response != '' ){
                		      jQuery('#refund_user').html(response);
                		  }else{
                		      jQuery('#refund_user').html('<option value="0" selected="selected">No data found!!</option>');
                		  }
                		});
                    })
                    
                	//jQuery('#refund_user').change(function() {
//                	    jQuery('#refund_amnt').val('loading...');
//                	    var uid = jQuery(this).val();
//            	        var data = {
//                			'action': 'get_user_available_creadits',
//                			'uid': uid
//                		};
//                        var ajaxurl = '<?php //echo admin_url('admin-ajax.php'); ?>';
//                		jQuery.post(ajaxurl, data, function(response) {
//                		  if( response > 0 ){
//                		      jQuery('#refund_amnt').val(response);
//                              jQuery('#hidden_refund').val(response);
//                		  }else{
//                		      jQuery('#refund_amnt').val(response);
//                              jQuery('#hidden_refund').val(response);
//                		  }
//                		});
//                	});
                });
        	</script>
            <form method="post">
                <input type="radio" class="refund_medium" checked="checked" name="refund_medium" value="website_refund" id="website_refund"/><label for="website_refund">Refund to user wallet</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" class="refund_medium" name="refund_medium" value="paypal_refund" id="paypal_refund"/><label for="paypal_refund">Refund to Paypal</label>
                <br /><br />
                <table class="widefat post fixed" cellspacing="0" width="100%" id="website_refund_wrapper">
                    <thead>
                        <tr>
                            <th width="10%">Select Auction</th>
                            <th width="15%">Refund to user</th>
                            <th width="20%">Amount</th>
                            <th width="30%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td width="10%">
                                <?php 
                                    $res_auctions = $wpdb->get_results(" SELECT p.post_title, p.ID FROM $wpdb->posts p 
                                                                            JOIN $wpdb->postmeta pm ON p.ID = pm.post_id
                                                                            WHERE pm.meta_key = 'enable_seats' AND pm.meta_value = 1 ");
                                    if( count( $res_auctions ) > 0 ){
                                        ?>
                                        <select name="refund_auction" id="refund_auction">
                                            <option value="0" selected="selected">Select Auction</option>
                                            <?php
                                            foreach( $res_auctions as $row ){
                                                echo '<option value="'.$row->ID.'">'.$row->post_title.'</option>';    
                                            }
                                            ?>
                                        </select>
                                        <?php
                                    }
                                ?>
                            </td>
                            <td width="15%">
                                <select name="refund_user[]" id="refund_user" multiple="multiple">
                                    <option value="0" selected="selected">Select user</option>
                                </select>
                            </td>
                            <td width="10%"><?php echo PennyTheme_get_currency(); ?><input value="0" type="text" name="refund_amnt" id="refund_amnt"/></td>
                            <td width="30%">
                                <!--input checked="checked" type="radio" name="refund_method" value="m"/>&nbsp;Manual&nbsp;&nbsp;&nbsp;&nbsp; 
                                <input checked="checked" type="radio" name="refund_method" value="p"/>&nbsp;Paypal-->
                                <input type="radio" checked="checked" name="keep_in_auction" value="1" id="keep_in_auction_yes"/><label for="keep_in_auction_yes">Keep seat(s) in auction</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="keep_in_auction" value="0" id="keep_in_auction_no"/><label for="keep_in_auction_no">Remove seat(s) from auction</label>
                                <input type="hidden" id="hidden_refund" value="0"/>
                            </td>
                        </tr>
                	</tbody>
                </table>
                <table class="widefat post fixed" cellspacing="0" width="100%" id="paypal_refund_wrapper" style="display: none;">
                    <thead>
                        <tr>
                            <th width="15%">Refund to user</th>
                            <th width="20%">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td width="10%">
                                <?php 
                                    $blogusers = get_users( 'blog_id=1&orderby=nicename&role=subscriber' );
                                    if( count( $blogusers ) > 0 ){
                                        ?>
                                        <select name="refund_user_paypal" id="refund_user_paypal">
                                            <option value="0" selected="selected">Select User</option>
                                            <?php
                                            foreach( $blogusers as $row ){
                                                echo '<option value="'.$row->ID.'">'.$row->display_name.'</option>';    
                                            }
                                            ?>
                                        </select>
                                        <?php
                                    }
                                ?>
                            </td>
                            <td width="10%"><?php echo PennyTheme_get_currency(); ?><input value="0" type="text" name="refund_amnt_paypal" id="refund_amnt_paypal"/></td>
                        </tr>
                	</tbody>
                </table>
                
                <input type="submit" name="refund_submit" id="refund_submit" value="Refund" class="update_btn" onclick="return confirm('Are you sure?')"/>
            </form>
          </div>
          
          <div id="tabs4">
            <script type="text/javascript" >
                jQuery(function(){
                    jQuery('#add_user_in_auction').click(function(e) {
                        e.preventDefault();
                        var pid = jQuery('#add_user_in_auction_auction').val();
                        var selected_seats = jQuery('#add_user_in_auction_seats').val();
                        var uid = jQuery('#add_user_in_auction_user').val();
                        if( pid > 0 && selected_seats > 0 && uid > 0 ){    
                            var data = {
                    			'action': 'check_auction_seats',
                    			'pid': pid,
                                'uid': uid,
                                'selected_seats': selected_seats,
                    		};
                            var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
                    		jQuery.post(ajaxurl, data, function(response) {
                    		  if( response != '' ){
                    		      alert('You have entered a number of seats that is more than the available seats in this auction. Please choose fewer seats that not exceed the available seats in this auction');
                                  return false;
                    		  }else{
                                  jQuery('#seats_added_mess').show();
                                  setInterval(function(){
                                      location.reload();  
                                  },3000) 		      
                    		  }
                    		});
                        }
                    })
                });
        	</script>
            <form method="post" id="add_user_in_auction_form">
                <div id="seats_added_mess" class="saved_thing" style="display: none;background: green;">Seat(s) added successfully!</div>
                <table class="widefat post fixed" cellspacing="0" width="100%" id="website_refund_wrapper">
                    <thead>
                        <tr>
                            <th width="30%">Auction</th>
                            <th width="15%">User</th>
                            <th width="15%">Seat(s)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td width="30%">
                                <?php 
                                    $res_auctions = $wpdb->get_results(" SELECT p.post_title, p.ID FROM $wpdb->posts p 
                                                                            JOIN $wpdb->postmeta pm ON p.ID = pm.post_id
                                                                            JOIN $wpdb->postmeta pm1 ON p.ID = pm.post_id
                                                                            WHERE pm.meta_key = 'enable_seats' AND pm.meta_value = 1 
                                                                            AND pm1.meta_key = 'seats' AND pm1.meta_value > 0 GROUP BY p.ID ");
                                    if( count( $res_auctions ) > 0 ){ ?>
                                        <select name="add_user_in_auction_auction" id="add_user_in_auction_auction">
                                            <option value="0" selected="selected">Select Auction</option>
                                            <?php
                                            foreach( $res_auctions as $row ){
                                                if( get_auction_remaining_seats( $row->ID ) > 0 ){
                                                    echo '<option value="'.$row->ID.'">'.$row->post_title.' ('.get_auction_remaining_seats( $row->ID ).' seats)</option>';    
                                                }    
                                            }
                                            ?>
                                        </select>
                                        <?php
                                    }
                                ?>
                            </td>
                            <td width="10%">
                                <?php 
                                    $blogusers = get_users( 'blog_id=1&orderby=nicename&role=subscriber' );
                                    if( count( $blogusers ) > 0 ){
                                        ?>
                                        <select name="add_user_in_auction_user" id="add_user_in_auction_user">
                                            <option value="0" selected="selected">Select User</option>
                                            <?php
                                            foreach( $blogusers as $row ){
                                                echo '<option value="'.$row->ID.'">'.$row->display_name.'</option>';    
                                            }
                                            ?>
                                        </select>
                                        <?php
                                    }
                                ?>
                            </td>
                            <td width="10%"><input value="0" min="0" type="number" name="add_user_in_auction_seats" id="add_user_in_auction_seats"/></td>
                        </tr>
                    </tbody>
                </table>
                <input type="submit" name="add_user_in_auction" id="add_user_in_auction" value="Add user in Auction" class="update_btn" onclick="return confirm('Are you sure?')"/>
            </form>
          </div>
           
        </div> 
    
    
    <?php	
	
	echo '</div>';
}

 

function PennyTheme_admin_style_sheet()
{
	?>
    <script>
	var SITE_CURRENCY 	= "<?php echo PennyTheme_currency(); ?>";
	var SITE_URL 		= "<?php echo get_bloginfo('siteurl'); ?>";
	
	</script>
    <script type="text/javascript" src="<?php echo get_bloginfo('template_url'); ?>/js/jquery.color.js"></script>
	<script type="text/javascript" src="<?php echo get_bloginfo('template_url'); ?>/js/admin.js"></script>
    
    <link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/css/admin.css" type="text/css" />
    
    <?php	

}


?>