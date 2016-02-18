<?php


	$opt = get_option('PennyTheme_new_emails_124_4');
	if(empty($opt)):
		
		update_option('PennyTheme_new_emails_124_4', 'DonE');
		
        update_option('PennyTheme_free_credit_empty_email_subject', 'Welcome to ##your_site_name##');
		update_option('PennyTheme_free_credit_empty_email_message', 'Dear ##username##,'.PHP_EOL.PHP_EOL. 
                                                                     'Your bid assistant has used the  maximum amount that you have predetermined.'.PHP_EOL.
                                                                      'Please go back to the auction: ##item_link## to add more money to your bid assistant or to bid manually to maintain your position as the higher bidder.'.PHP_EOL. 
                                                                      'We wish you a good luck!'.PHP_EOL.PHP_EOL. 
                                                                      'Thank You,'.PHP_EOL. 
                                                                      '##your_site_name##');
                                                                
		update_option('PennyTheme_new_user_email_subject', 'Welcome to ##your_site_name##');
		update_option('PennyTheme_new_user_email_message', 'Hello ##username##,'.PHP_EOL.PHP_EOL.
																'Welcome to our website.'.PHP_EOL.
																'Your username: ##username##'.PHP_EOL.
																'Your password: ##user_password##'.PHP_EOL.PHP_EOL.
																'Login here: ##site_login_url##'.PHP_EOL.PHP_EOL.
																'Thank you,'.PHP_EOL.
																'##your_site_name## Team');
	
		//-----------------------------------------------------------------------------------------------------------
		
		update_option('PennyTheme_new_user_email_admin_subject', 'New user registration on your site');
		update_option('PennyTheme_new_user_email_admin_message', 'Hello admin,'.PHP_EOL.PHP_EOL.
																	'A new user has been registered on your website.'.PHP_EOL.
																	'See the details below:'.PHP_EOL.PHP_EOL.
																	'Username: ##username##'.PHP_EOL.
																	'Email: ##user_email##');
																	

		//-----------------------------------------------------------------------------------------------------------
		
		update_option('PennyTheme_seats_purchase_user_email_subject', 'New seats package purchased: (##seats_number##)');
		update_option('PennyTheme_seats_purchase_user_email_message', 'Hello ##username##,'.PHP_EOL.PHP_EOL.
																	'You have been purchased ##seats_number## seats on our website.'.PHP_EOL.
																	'You can use the to bid on the items we have listed.'.PHP_EOL.
																	'Login to your account for more details: ##my_account_url##'.PHP_EOL.PHP_EOL.
																	'Thank you,'.PHP_EOL.
																	'##your_site_name## Team');																	
																	
		//-----------------------------------------------------------------------------------------------------------
        
		
		update_option('PennyTheme_seats_purchase_admin_email_subject', 'New seats package purchased: (##seats_number##) ##username##');
		update_option('PennyTheme_seats_purchase_admin_email_message', 'Hello admin,'.PHP_EOL.PHP_EOL.
																	'Your user ##username## has been purchased a number ##seats_number## seats on your website.'.PHP_EOL.
																	'Username: ##username##'.PHP_EOL.
																	'Email: ##username_email##'.PHP_EOL.PHP_EOL.
																	'Thank you,'.PHP_EOL.
																	'##your_site_name## Team');
                                                                    
        //-----------------------------------------------------------------------------------------------------------                                                            
		
		update_option('PennyTheme_bids_purchase_user_email_subject', 'New bid package purchased: (##bids_number##)');
		update_option('PennyTheme_bids_purchase_user_email_message', 'Hello ##username##,'.PHP_EOL.PHP_EOL.
																	'You have been purchased ##bids_number## bids on our website.'.PHP_EOL.
																	'You can use the to bid on the items we have listed.'.PHP_EOL.
																	'Login to your account for more details: ##my_account_url##'.PHP_EOL.PHP_EOL.
																	'Thank you,'.PHP_EOL.
																	'##your_site_name## Team');
																	
		//-----------------------------------------------------------------------------------------------------------
		
		update_option('PennyTheme_bids_purchase_admin_email_subject', 'New bid package purchased: (##bids_number##) ##username##');
		update_option('PennyTheme_bids_purchase_admin_email_message', 'Hello admin,'.PHP_EOL.PHP_EOL.
																	'Your user ##username## has been purchased a number ##bids_number## bids on your website.'.PHP_EOL.
																	'Username: ##username##'.PHP_EOL.
																	'Email: ##username_email##'.PHP_EOL.PHP_EOL.
																	'Thank you,'.PHP_EOL.
																	'##your_site_name## Team');	
																	
		//-----------------------------------------------------------------------------------------------------------
		
		update_option('PennyTheme_item_purchase_user_email_subject', 'Item Won: ##item_name##');
		update_option('PennyTheme_item_purchase_user_email_message', 'Hello ##username##,'.PHP_EOL.PHP_EOL.
																	'Your have won the item: ##item_name## ( ##item_link## ).'.PHP_EOL.
																	'The price you have to pay for this item is: ##item_price##'.PHP_EOL.
																	'Login to your account for payment: ##my_account_url##'.PHP_EOL.PHP_EOL.
																	'Thank you,'.PHP_EOL.
																	'##your_site_name## Team');		
																	
		//-----------------------------------------------------------------------------------------------------------
		
		update_option('PennyTheme_item_purchase_admin_email_subject', 'Item Won: ##item_name##');
		update_option('PennyTheme_item_purchase_admin_email_message', 'Hello admin,'.PHP_EOL.PHP_EOL.
																	'The user ##username## won the item: ##item_name## ( ##item_link## ).'.PHP_EOL.
																	'The price you have for this item is: ##item_price##'.PHP_EOL.PHP_EOL.
																	
																	'Thank you,'.PHP_EOL.
																	'##your_site_name## Team');		 																																												
																	
		endif;															
																	
																	?>