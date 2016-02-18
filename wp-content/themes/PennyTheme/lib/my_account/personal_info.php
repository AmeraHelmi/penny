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

function PennyTheme_display_my_account_pers_inf_fncs()
{

	ob_start();
	
	global $current_user;
	get_currentuserinfo();
	$uid = $current_user->ID;

    if( wp_get_post_parent_id(get_the_ID()) == get_option('PennyTheme_my_account_page_id') ){
    		$PennyTheme_adv_code_single_page_above_content = stripslashes(get_option('PennyTheme_adv_code_single_page_above_content'));
    		if(!empty($PennyTheme_adv_code_single_page_above_content)):
    		
    			echo '<div class="full_width_a_div">';
    			echo $PennyTheme_adv_code_single_page_above_content;
    			echo '</div>';
    		
    		endif;	    
    }
?>	

<div id="content">
		<!-- page content here -->	
			
            
            <div class="my_box3">
            	<div class="padd10">
            
            	<div class="box_title"><?php _e("Personal Information",'PennyTheme'); ?></div>
                <div class="box_content">    
				<?php
				
				if(isset($_POST['save-info']))
				{
					$personal_info = strip_tags(nl2br($_POST['personal_info']), '<br />');
					update_user_meta($uid, 'personal_info', $personal_info);
					
					$ship_inf = strip_tags(nl2br($_POST['ship_inf']), '<br />');
					update_user_meta($uid, 'ship_inf', $ship_inf);
					
					update_user_meta($uid, 'phone', trim($_POST['phone']));
					update_user_meta($uid, 'first_name', trim($_POST['first_name']));
					update_user_meta($uid, 'last_name', trim($_POST['last_name']));
					update_user_meta($uid, 'state', trim($_POST['state']));
					update_user_meta($uid, 'city', trim($_POST['city']));
					
					update_user_meta($uid, 'zip_code', trim($_POST['zip_code']));
					update_user_meta($uid, 'country', trim($_POST['country']));
					
					for( $i = 1; $i <= 10; $i++ ){
                        $field_name = get_option( 'registration_field'.$i );
                        $val = sanitize_user( $_POST['registration_field'.$i] );
                        if( $val == '' ) continue;
                        update_user_meta( $uid, 'registration_field'.$i, $val );
                        update_user_meta( $uid, 'registration_field'.$i.'_orig', $val );        
                    }
					
					if(isset($_POST['password']) && !empty($_POST['password']))
					{
						$p1 = trim($_POST['password']);
						$p2 = trim($_POST['reppassword']);
						
						if($p1 == $p2)
						{
							global $wpdb;
							$newp = md5($p1);
							$sq = "update ".$wpdb->prefix."users set user_pass='$newp' where ID='$uid'" ;
							$wpdb->query($sq);
						}
						else
						echo __("Passwords do not match!","ClassifiedTheme");
					}
					
					
					//$personal_info = trim($_POST['paypal_email']);
					//update_user_meta($uid, 'paypal_email', $personal_info);
					
					if(!empty($_FILES['avatar']["tmp_name"]))
					{
						$avatar = $_FILES['avatar'];
						
						$tmp_name 	= $avatar["tmp_name"];
        				$name 		= $avatar["name"];
        				
						$upldir = wp_upload_dir();
						$path = $upldir['path'];
						$url  = $upldir['url'];
						
						$name = str_replace(" ","",$name);
						if(getimagesize($tmp_name) > 0)
						{
							
							move_uploaded_file($tmp_name, $path."/".$name);
							update_user_meta($uid, 'avatar', $url."/".$name);
						}
					}
					
					echo '<div class="auction-saved"><div class="padd10">'.__('Your profile information was updated.','PennyTheme').'</div></div>';
					echo '<div class="clear10"></div>';
					
				}
				
				?>
                <form method="post"  enctype="multipart/form-data">
                  <ul class="post-new3">
     
        
        
        <!--li>
        	<h2><?php //echo __('Profile Description','PennyTheme'); ?>:</h2>
        	<p><textarea type="textarea" cols="40" class="do_input" rows="5" name="personal_info"><?php //echo get_user_meta($uid, 'personal_info', true); ?></textarea></p>
        </li-->
        
        
                
       
        
         <li>
        	<h2><?php echo __('First Name', "ClassifiedTheme"); ?>:</h2>
        	<p><input type="text" value="<?php echo get_user_meta($uid, 'first_name', true); ?>" class="do_input" name="first_name" size="35" /></p>
        </li>
        
        <li>
        	<h2><?php echo __('Last Name', "ClassifiedTheme"); ?>:</h2>
        	<p><input type="text" value="<?php echo get_user_meta($uid, 'last_name', true); ?>" class="do_input" name="last_name" size="35" /></p>
        </li>
        
        
         <!--li>
        	<h2><?php //echo __('Street Address','PennyTheme'); ?>:</h2>
        	<p><textarea type="textarea" cols="40" class="do_input" rows="3" name="ship_inf"><?php //echo get_user_meta($uid, 'ship_inf', true); ?></textarea></p>
        </li>
        
        
        <li>
        	<h2><?php //echo __('Suburb/City', "ClassifiedTheme"); ?>:</h2>
        	<p><input type="text" value="<?php //echo get_user_meta($uid, 'city', true); ?>" class="do_input" name="city" size="35" /></p>
        </li>
        
        <li>
        	<h2><?php //echo __('State', "ClassifiedTheme"); ?>:</h2>
        	<p><input type="text" value="<?php //echo get_user_meta($uid, 'state', true); ?>" class="do_input" name="state" size="35" /></p>
        </li>
        
        <li>
        	<h2><?php //echo __('Country', "ClassifiedTheme"); ?>:</h2>
        	<p><input type="text" value="<?php //echo get_user_meta($uid, 'country', true); ?>" class="do_input" name="country" size="35" /></p>
        </li>
        
        
        <li>
        	<h2><?php //echo __('Zip Code', "ClassifiedTheme"); ?>:</h2>
        	<p><input type="text" value="<?php //echo get_user_meta($uid, 'zip_code', true); ?>" class="do_input" name="zip_code" size="35" /></p>
        </li>
        
        
        <li>
        	<h2><?php //echo __('Contact Phone', "ClassifiedTheme"); ?>:</h2>
        	<p><input type="text" value="<?php //echo get_user_meta($uid, 'phone', true); ?>" class="do_input" name="phone" size="35" /></p>
        </li-->
        
        <?php 
            for( $i = 1; $i <= 10; $i++ ){
                $field_text = get_option('registration_field'.$i);
                if( $field_text == '' ) continue;
                $field_type = get_option('registration_field_type'.$i);
                $field_reqd = get_option('registration_field_reqd'.$i);
                $req = '';
                if( $field_reqd == 1 ){
                    //$req = '*';
                }
            ?>
            <li>							 
			    <h2><label for="register-phone"><?php _e($field_text.':',$current_theme_locale_name) ?><?php echo $req; ?></label></h2>
                <p>
                    <?php if( $field_type == 'text' ){ ?>
    			        <input type="text" value="<?php echo get_user_meta( $uid, 'registration_field'.$i, true ); ?>" class="do_input" name="<?php echo 'registration_field'.$i; ?>" id="<?php echo 'registration_field'.$i; ?>" size="30" maxlength="100" />
                    <?php }else{ ?>
                        <textarea name="<?php echo 'registration_field'.$i; ?>" id="<?php echo 'registration_field'.$i; ?>"><?php echo get_user_meta( $uid, 'registration_field'.$i, true ); ?></textarea>
                    <?php } ?>
                </p>
			</li>    
        <?php } ?>
        
         <li>
        	<h2><?php echo __('New Password', "ClassifiedTheme"); ?>:</h2>
        	<p><input type="password" value="" class="do_input" name="password" size="35" /></p>
        </li>
        
        
        <li>
        	<h2><?php echo __('Repeat Password', "ClassifiedTheme"); ?>:</h2>
        	<p><input type="password" value="" class="do_input" name="reppassword" size="35"  /></p>
        </li>
        
        
        <li>
        	<h2><?php echo __('Profile Avatar','PricerrTheme'); ?>:</h2>
        	<p> <input type="file" name="avatar" /> <br/>
            max file size: 1mb. Formats: jpeg, jpg, png, gif
            <br/>
            <img width="50" height="50" border="0" src="<?php echo PennyTheme_get_avatar($uid,50,50); ?>" /> 
            </p>
        </li>
                
        <li>
        <h2>&nbsp;</h2>
        <p><input type="submit" name="save-info" value="<?php _e("Save" ,'PennyTheme'); ?>" /></p>
        </li>
        
        </ul>
                </form>
                </div>
           </div>
           </div>     
            
            
		
		<!-- page content here -->	
		</div>		


<?php

	echo PennyTheme_get_users_links();
	
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
	
}

?><?php
/********************************************************************
*
*	Penny Auction Theme for WordPress - sitemile.com
*	http://sitemile.com/products/wordpress-penny-auction-theme/
*	Copyright (c) 2012 sitemile.com
*	Coder: Saioc Dragos Andrei
*	Email: andreisaioc@gmail.com
*
*********************************************************************/



?>