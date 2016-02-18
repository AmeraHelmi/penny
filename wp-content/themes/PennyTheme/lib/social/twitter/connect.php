<?php
require_once(dirname(dirname(dirname(dirname(dirname(dirname(dirname(__FILE__))))))) . '/wp-load.php');
require_once(dirname(__FILE__) . '/EpiCurl.php' );
require_once(dirname(__FILE__) . '/EpiOAuth.php' );
require_once(dirname(__FILE__) . '/EpiTwitter.php' );

$twitter_enabled 	= get_option('PennyTheme_enable_twitter_login');
$consumer_key 		= get_option('PennyTheme_twitter_consumer_key');
$consumer_secret 	= get_option('PennyTheme_twitter_consumer_secret');

if($twitter_enabled == "yes" && $consumer_key && $consumer_secret) {
  $twitter_api = new EpiTwitter($consumer_key, $consumer_secret);
  wp_redirect($twitter_api->getAuthenticateUrl());
  exit();
}
?>
<p>PennyTheme plugin has not been configured for Twitter</p>

