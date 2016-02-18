<?php
/*****************************************************************************
*
*	copyright(c) - sitemile.com - PennyTheme
*	More Info: http://sitemile.com/p/penny
*	Coder: Saioc Dragos Andrei
*	Email: andreisaioc@gmail.com
*
******************************************************************************/	
		
		function PennyTheme_do_register_scr()
		{
		  global $wpdb, $wp_query, $current_theme_locale_name;
		
		  if (!is_array($wp_query->query_vars))
			$wp_query->query_vars = array();
		
		header('Content-Type: '.get_bloginfo('html_type').'; charset='.get_bloginfo('charset'));
		
		session_start();
		  switch( $_REQUEST["action"] ) 
		  {
			
			case 'register':
			  require_once( ABSPATH . WPINC . '/registration-functions.php');
			  
				$user_login = sanitize_user( str_replace(" ","",$_POST['user_login']) );
				$user_email = trim($_POST['user_email']);
                
                $user_fname = sanitize_user( str_replace(" ","",$_POST['user_fname']) );
                $user_lname = sanitize_user( str_replace(" ","",$_POST['user_lname']) );
			
				$sanitized_user_login = $user_login;
		
			
				
				$errors = PennyTheme_register_new_user_sitemile($user_login, $user_email);
				
					if (!is_wp_error($errors)) 
					{	
						$ok_reg = 1;						
					}	
					
				
			  if ( 1 == $ok_reg ) 
			  {//continues after the break; 
				
                update_user_meta( $errors, 'user_ip', $_SERVER['REMOTE_ADDR'] );
                update_user_meta( $errors, 'first_name', $user_fname );
                update_user_meta( $errors, 'last_name', $user_lname );
                update_user_meta( $errors, 'show_admin_bar_front', 'false' );
                for( $i = 1; $i <= 10; $i++ ){
                    $field_name = get_option( 'registration_field'.$i );
                    $val = sanitize_user( $_POST['registration_field'.$i] );
                    if( $val == '' ) continue;
                    update_user_meta( $errors, 'registration_field'.$i, $val );
                    update_user_meta( $errors, 'registration_field'.$i.'_orig', $val );        
                }
                
				global $real_ttl;
				$real_ttl = __("Registration Complete", $current_theme_locale_name);			
				add_filter( 'wp_title', 'PennyTheme_sitemile_filter_ttl', 10, 3 );	
				
				get_header();
				global $current_theme_locale_name;	
				
		?>
				
				<div class="my_box3">
            	<div class="padd10">
    	            <div class="box_title"><?php _e('Registration Complete',$current_theme_locale_name) ?></div>
					<p><?php printf(__('Username: %s',$current_theme_locale_name), "<strong>" . wp_specialchars($user_login) . "</strong>") ?><br />
						<?php printf(__('Password: %s',$current_theme_locale_name), '<strong>' . __('emailed to you',$current_theme_locale_name) . '</strong>') ?> <br />
						<?php printf(__('E-mail: %s',$current_theme_locale_name), "<strong>" . wp_specialchars($user_email) . "</strong>") ?><br /><br />
						<?php _e("Please check your <strong>Junk Mail</strong> if your account information does not appear within 5 minutes.",$current_theme_locale_name); ?>
                    </p>
                     
					<p class="submit"><a href="wp-login.php"><?php _e('Login', $current_theme_locale_name); ?> &raquo;</a></p>
                </div>
                </div>
		<?php
								
				
				get_footer();
		
				die();
			break;
			  }//continued from the error check above
		
			default:
			
			global $real_ttl;
			$real_ttl = __("Register", $current_theme_locale_name);			
			add_filter( 'wp_title', 'PennyTheme_sitemile_filter_ttl', 10, 3 );	
			
			get_header();
			
		
				
				?>
				
				<div class="my_box3">
            	<div class="padd10">
            
            	<div class="box_title"><?php _e("Register",$current_theme_locale_name); ?> - <?php echo  get_bloginfo('name'); ?></div>
                <div class="box_content">                                          
						  
						  <?php if ( isset($errors) && isset($_POST['action']) ) : ?>
						  <div class="error">
							<ul>
							<?php 
							 
							$me = $errors->get_error_messages();
					 
						 	foreach($me as $mm)
							 echo "<li>".($mm)."</li>";
							
							
							 
							?>
							</ul>
						  </div>
						  <?php endif; ?>
						  <div class="login-submit-form">
                          
                          
                          <form method="post" id="loginform" style="width: 100%!important;">
						  <input type="hidden" name="action" value="register" />	
							
							<p>
                            <label for="register-username"><?php _e('Username:',$current_theme_locale_name) ?>*</label>
							<input type="text" class="do_input" name="user_login" id="user_login" size="30" maxlength="20" value="<?php echo wp_specialchars($user_login); ?>" />
							</p>							
					        
                            <p>							 
							<label for="register-fname"><?php _e('First Name:',$current_theme_locale_name) ?>*</label>
							<input type="text" class="do_input" name="user_fname" id="user_fname" size="30" maxlength="100" value="<?php echo wp_specialchars($user_fname); ?>" />
							</p>
                            
                            <p>							 
							<label for="register-lname"><?php _e('Last Name:',$current_theme_locale_name) ?>*</label>
							<input type="text" class="do_input" name="user_lname" id="user_lname" size="30" maxlength="100" value="<?php echo wp_specialchars($user_lname); ?>" />
							</p>
                               
							<p>							 
							<label for="register-email"><?php _e('E-mail:',$current_theme_locale_name) ?>*</label>
							<input type="text" class="do_input" name="user_email" id="user_email" size="30" maxlength="100" value="<?php echo wp_specialchars($user_email); ?>" />
							</p>
                            
                            <?php 
                                for( $i = 1; $i <= 10; $i++ ){
                                    $field_text = get_option('registration_field'.$i);
                                    if( $field_text == '' ) continue;
                                    $field_type = get_option('registration_field_type'.$i);
                                    $field_reqd = get_option('registration_field_reqd'.$i);
                                    $req = '';
                                    if( $field_reqd == 1 ){
                                        $req = '*';
                                    }
                                ?>
                                <p>							 
    							    <label style="float: none;" for="register-phone"><?php _e($field_text.':',$current_theme_locale_name) ?><?php echo $req; ?></label>
                                    <?php if( $field_type == 'text' ){ ?>
    							        <input type="text" class="do_input" name="<?php echo 'registration_field'.$i; ?>" id="<?php echo 'registration_field'.$i; ?>" size="30" maxlength="100" />
                                    <?php }else{ ?>
                                        <textarea name="<?php echo 'registration_field'.$i; ?>" id="<?php echo 'registration_field'.$i; ?>"></textarea>
                                    <?php } ?>
    							</p>    
                            <?php } ?>
                    
                            <p><small>(*) required fields</small></p>
							
                        
							<?php do_action('register_form'); ?>

							<p>
							<?php _e('A password will be emailed to you.',$current_theme_locale_name) ?></p>
							
                            <?php if( get_option('PennyTheme_show_tc') == 1 ){ ?>
                                <input type="checkbox" id="read_cond"/>&nbsp;<span class="cond_text">I agree and accept <a target="_blank" href="<?php echo get_permalink( get_option('PennyTheme_terms_conditions_page_id') ); ?>">terms and conditions</a></span><br />
                            <?php } ?>
                            <?php if( get_option('PennyTheme_show_pv') == 1 ){ ?>
                                <input type="checkbox" id="read_cond2"/>&nbsp;<span class="cond_text2">I agree and accept <a target="_blank" href="<?php echo get_permalink( get_option('PennyTheme_privacy_policy_page_id') ); ?>">privacy policy</a></span><br />
                            <?php } ?>
                            <?php if( get_option('PennyTheme_show_sr') == 1 ){ ?>
                                <input type="checkbox" id="read_cond3"/>&nbsp;<span class="cond_text3">I agree and accept <a target="_blank" href="<?php echo get_permalink( get_option('PennyTheme_site_rules_page_id') ); ?>">site rules</a></span>
                            <?php } ?>
                            </p>
                            
                            <script>
                                jQuery(function(){
                                    jQuery('#submits').click(function(){
                                        var err = '';
                                        jQuery('#user_login').css('border','1px solid #999');
                                        jQuery('#user_fname').css('border','1px solid #999');
                                        jQuery('#user_lname').css('border','1px solid #999');
                                        
                                        <?php 
                                            for( $i = 1; $i <= 10; $i++ ){
                                                $field_text = get_option('registration_field'.$i);
                                                $field_reqd = get_option('registration_field_reqd'.$i);
                                                if( $field_text == '' ) continue;
                                                if( $field_reqd == 0 ) continue;
                                                ?>
                                                    jQuery('#<?php echo 'registration_field'.$i; ?>').css('border','1px solid #999');
                                        <?php } ?>
                                                
                                        if( jQuery('#user_login').val() == '' ){
                                            jQuery('#user_login').css('border','1px solid red');
                                            err = 1;
                                        }
                                        if( jQuery('#user_fname').val() == '' ){
                                            jQuery('#user_fname').css('border','1px solid red');
                                            err = 1;
                                        }
                                        if( jQuery('#user_lname').val() == '' ){
                                            jQuery('#user_lname').css('border','1px solid red');
                                            err = 1;
                                        }
                                        if( jQuery('#user_email').val() == '' ){
                                            jQuery('#user_email').css('border','1px solid red');
                                            err = 1;
                                        }
                                        
                                        <?php
                                            if( get_option('PennyTheme_show_tc') == 1 ){
                                                ?>
                                                    if( jQuery('#read_cond').is(':checked') ){
                                                        jQuery('.cond_text').css('color','black');
                                                    }else{
                                                        <?php if( get_option('PennyTheme_show_tc_reqd') == 1 ){ ?>
                                                            jQuery('.cond_text').css('color','red');
                                                            err = 1
                                                        <?php } ?>
                                                    }
                                                <?php
                                            }
                                            if( get_option('PennyTheme_show_pv') == 1 ){
                                                ?>
                                                    if( jQuery('#read_cond2').is(':checked') ){
                                                        jQuery('.cond_text2').css('color','black');
                                                    }else{
                                                        <?php if( get_option('PennyTheme_show_pv_reqd') == 1 ){ ?>
                                                            jQuery('.cond_text2').css('color','red');
                                                            err = 1
                                                        <?php } ?>
                                                    }
                                                <?php
                                            }
                                            if( get_option('PennyTheme_show_sr') == 1 ){
                                                ?>
                                                    if( jQuery('#read_cond3').is(':checked') ){
                                                        jQuery('.cond_text3').css('color','black');
                                                    }else{
                                                        <?php if( get_option('PennyTheme_show_sr_reqd') == 1 ){ ?>
                                                            jQuery('.cond_text3').css('color','red');
                                                            err = 1
                                                        <?php } ?>
                                                    }
                                                <?php
                                            } 
                                            
                                            for( $i = 1; $i <= 10; $i++ ){
                                                $field_text = get_option('registration_field'.$i);
                                                $field_reqd = get_option('registration_field_reqd'.$i);
                                                if( $field_text == '' ) continue;
                                                if( $field_reqd == 0 ) continue;
                                                ?>
                                                if( jQuery('#<?php echo 'registration_field'.$i; ?>').val() == '' ){
                                                    jQuery('#<?php echo 'registration_field'.$i; ?>').css('border','1px solid red');
                                                    err = 1;
                                                }    
                                        <?php } ?>
                                        if( err == 1 ){
                                            return false;
                                        }
                                    })
                                })
                            </script>
                          
							
						<p class="submit">
                        
							 <input type="submit" class="submit_bottom" value="<?php _e('Register',$current_theme_locale_name) ?>" id="submits" name="submits" />
						</p>
                          
						  <ul id="logins" style="margin: 0;padding-left: 0;">
							<li><a href="<?php bloginfo('home'); ?>/" title="<?php _e('Are you lost?',$current_theme_locale_name) ?>"><?php _e('Home',$current_theme_locale_name) ?></a></li>
							<li><a href="<?php bloginfo('wpurl'); ?>/wp-login.php"><?php _e('Login',$current_theme_locale_name) ?></a></li>
							<li><a href="<?php bloginfo('wpurl'); ?>/wp-login.php?action=lostpassword" title="<?php _e('Password Lost?',$current_theme_locale_name) ?>"><?php _e('Lost your password?',$current_theme_locale_name) ?></a></li>
						  </ul>
						</div>
                        
                        
                        
                        </div>
                        </div>
                        </div>
                        
                        
		<?php
				
				
	 			  get_footer();
		
			  die();
			break;
			case 'disabled':
     
	 				global $real_ttl;
			$real_ttl = __("Registration Disabled", $current_theme_locale_name);			
			add_filter( 'wp_title', 'PennyTheme_sitemile_filter_ttl', 10, 3 );	
			
	 
	 			  get_header();
				
			
		?>
        <div class="clear10"></div>	
				<div class="my_box3">
            	<div class="padd10">

        <div class="box_title"><?php _e('Registration Disabled',$current_theme_locale_name) ?></div>
                <div class="box_content">
                                                  
							
							<p><?php _e('User registration is currently not allowed.',$current_theme_locale_name) ?><br />
							<a href="<?php echo get_settings('home'); ?>/" title="<?php _e('Go back to the blog',$current_theme_locale_name) ?>"><?php _e('Home',$current_theme_locale_name) ?></a>
							</p>
						</div></div></div>
		<?php
				
				 get_footer();
		
			  die();
			break;
		  }
		}




//===================================================================

function PennyTheme_register_new_user_sitemile( $user_login, $user_email ) {
	$errors = new WP_Error();
	global $current_theme_locale_name;
	$sanitized_user_login = sanitize_user( $user_login );
	$user_email = apply_filters( 'user_registration_email', $user_email );

	// Check the username
	if ( $sanitized_user_login == '' ) {
		$errors->add( 'empty_username', __( '<strong>ERROR</strong>: Please enter a username.', $current_theme_locale_name ) );
	} elseif ( ! validate_username( $user_login ) ) {
		$errors->add( 'invalid_username', __( '<strong>ERROR</strong>: This username is invalid because it uses illegal characters. Please enter a valid username.', $current_theme_locale_name ) );
		$sanitized_user_login = '';
	} elseif ( username_exists( $sanitized_user_login ) ) {
		$errors->add( 'username_exists', __( '<strong>ERROR</strong>: This username is already registered, please choose another one.', $current_theme_locale_name ) );
	}

	// Check the e-mail address
	if ( $user_email == '' ) {
		$errors->add( 'empty_email', __( '<strong>ERROR</strong>: Please type your e-mail address.', $current_theme_locale_name ) );
	} elseif ( ! is_email( $user_email ) ) {
		$errors->add( 'invalid_email', __( '<strong>ERROR</strong>: The email address isn&#8217;t correct.', $current_theme_locale_name ) );
		$user_email = '';
	} elseif ( email_exists( $user_email ) ) {
		$errors->add( 'email_exists', __( '<strong>ERROR</strong>: This customer is already registered, please proceed to the <a href="'.bloginfo(wpurl).'/wp-login.php">login</a> page.', $current_theme_locale_name ) );
	}

	do_action( 'register_post', $sanitized_user_login, $user_email, $errors );

	$errors = apply_filters( 'registration_errors', $errors, $sanitized_user_login, $user_email );

	if ( $errors->get_error_code() )
		return $errors;

	$user_pass = wp_generate_password( 12, false);
	$user_id = wp_create_user( $sanitized_user_login, $user_pass, $user_email );
	if ( ! $user_id ) {
		$errors->add( 'registerfail', sprintf( __( '<strong>ERROR</strong>: Couldn&#8217;t register you... please contact the <a href="mailto:%s">webmaster</a> !', $current_theme_locale_name ), get_option( 'admin_email' ) ) );
		return $errors;
	}

	update_user_option( $user_id, 'default_password_nag', true, true ); //Set up the Password change nag.

	PennyTheme_new_user_notification($user_id, $user_pass );
	PennyTheme_new_user_notification_admin($user_id);
	
	return $user_id;
}

?>