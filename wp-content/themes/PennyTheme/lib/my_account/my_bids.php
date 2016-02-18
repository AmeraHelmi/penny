<?php
/********************************************************************
*
*   Penny Auction Theme for WordPress - sitemile.com
*   http://sitemile.com/products/wordpress-penny-auction-theme/
*   Copyright (c) 2012 sitemile.com
*   Coder: Saioc Dragos Andrei
*   Email: andreisaioc@gmail.com
*
*********************************************************************/

function PennyTheme_display_my_account_my_bids_fncs()
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
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">

<html>
<head>
    <title></title>
</head>

<body>
    <div id="content">
    <div class="my_box3">
        <div class="box_title">
            <?php _e("My Active Bidding", 'PennyTheme'); ?>
        </div>

        <div class="box_content">
            <?php

                global $wp_query;
                $query_vars = $wp_query->query_vars;
                $post_per_page = 5;

                $closed = array(
                    'key' => 'closed',
                    'value' => "0",
                    //'type' => 'numeric',
                    'compare' => '=');

                $bidded_auction = array(
                    'key' => 'bidded_auction',
                    'value' => $uid,
                    //'type' => 'numeric',
                    'compare' => '=');


                $args = array(
                    'posts_per_page' => 5,
                    'paged' => 1,
                    'post_type' => 'auction',
                    'order' => 'DESC',
                    'meta_query' => array($closed, $bidded_auction),
                    'orderby' => 'post_date');
                $the_query = new WP_Query($args);


                if ($the_query->have_posts()):
                    while ($the_query->have_posts()):
                        $the_query->the_post();

                        PennyTheme_get_post_big();


                    endwhile;


                    else:

                        _e("There are no auctions yet.", 'PennyTheme');

                    endif;

                        wp_reset_query();

            ?>
        </div>
    </div>
    </div>
    <?php

                echo PennyTheme_get_users_links();

                $output = ob_get_contents();
                ob_end_clean();
                return $output.'</body></html>';

            }
?>