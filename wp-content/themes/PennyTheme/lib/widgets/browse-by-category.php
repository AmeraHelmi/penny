<?php

add_action('widgets_init', 'Penny_browse_by_category_widget_auction');
function Penny_browse_by_category_widget_auction() {
	register_widget('PennyTheme_browse_by_category');
}

class PennyTheme_browse_by_category extends WP_Widget {

	function PennyTheme_browse_by_category() {
		$widget_ops = array( 'classname' => 'browse-by-category', 'description' => 'Show all categories and browse by category' );
		$control_ops = array( 'width' => 200, 'height' => 250, 'id_base' => 'browse-by-category' );
		$this->WP_Widget( 'browse-by-category', 'PennyTheme - Browse by Category', $widget_ops, $control_ops );
	}

	function widget($args, $instance) {
		extract($args);
		
		echo $before_widget;
		
		if ($instance['title']) echo $before_title . apply_filters('widget_title', $instance['title']) . $after_title;
		
		$loc_per_row 	= $instance['loc_per_row'];
		$widget_id 		= $args['widget_id'];
		$nr_rows 		= $instance['nr_rows'];
		
		$nr = 4;
		
		if(!empty($loc_per_row)) $nr = $loc_per_row;
		echo '<style type="text/css">#'.$widget_id.' #location-stuff li ul { width: '.round(100/$nr).'%}</style>';
		
		if($nr_rows > 0) $jk = "&number=".($nr_rows * $loc_per_row);
		
		$terms_k = get_terms("auction_cat","parent=0&hide_empty=0");
		$terms = get_terms("auction_cat","parent=0&hide_empty=0".$jk);
		 
		 if(count($terms) < count($terms_k)) $disp_btn = 1;
		else $disp_btn = 0;
		 
		 
		$count = count($terms); $i = 0;
		if ( $count > 0 ){
		     echo "<ul id='location-stuff'>";
		     foreach ( $terms as $term ) {
		       
			   if($i%$nr == 0) echo "<li>";
		       $total_ads = 0;
			   $terms2 = '';
			   	$terms2 = get_terms("auction_cat","parent=".$term->term_id."&hide_empty=0");
			
				$mese = '';
				
					$mese .= '<ul>';
					$mese .= "<img src=\"".get_bloginfo('template_url')."/images/posted.png\" width=\"20\" height=\"20\" /> 
		       		<h3><a href='".get_term_link($term->slug,"auction_cat")."'>" . $term->name;
					
					//."</a></h3>";
			   
			   $total_ads = pennytheme_get_custom_taxonomy_count('auction',$term->slug);
			   
			   $mese2 = '';
			   if($terms2)
				{
					
					foreach ( $terms2 as $term2 ) 
					{
						$tt = pennytheme_get_custom_taxonomy_count('auction',$term2->slug);
		       			$total_auctions += $tt;
						$mese2 .= "<li><a href='".get_term_link($term2->slug,"auction_cat")."'>" . $term2->name." (".$tt.")</a></li>";
					}
				}
					
					echo $mese; 
					
					if($total_auctions > 0)
					echo "(".$total_auctions.")";
					
					echo "</a></h3>";
					echo $mese2;
					
					echo '</ul>';
				
				
		       if(($i+1) % $nr == 0) echo "</li>";
			   
			   $i++;
		        
		     }
				
			//	if(($i+1) % $nr != 0) echo "</li>";


		     echo "</ul>";
			 
		 }           
			
		if($disp_btn == 1)
		{
				echo '<br/><b><a href="'.get_bloginfo('siteurl').'/show-all-categories">'.__('See More Categories','PennyTheme').'</a></b>';		
		}		
			
			
				
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
	
		return $new_instance;
	}

	function form($instance) { ?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title'); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" 
			value="<?php echo esc_attr( $instance['title'] ); ?>" style="width:95%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('loc_per_row'); ?>"><?php _e('Number of Columns'); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id('loc_per_row'); ?>" name="<?php echo $this->get_field_name('loc_per_row'); ?>" 
			value="<?php echo esc_attr( $instance['loc_per_row'] ); ?>" style="width:20%;" />
		</p>
				
        <p>
			<label for="<?php echo $this->get_field_id('nr_rows'); ?>"><?php _e('Number of Rows'); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id('nr_rows'); ?>" name="<?php echo $this->get_field_name('nr_rows'); ?>" 
			value="<?php echo esc_attr( $instance['nr_rows'] ); ?>" style="width:20%;" />
		</p>
		         
                	
	<?php 
	}
}




?>