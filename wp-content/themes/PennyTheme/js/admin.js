 
	jQuery(document).ready(function() {
		
		
		
	//-----------------------
	
	jQuery(".update_package").live("click", function(){ 
		
		var update_package = jQuery(this).attr('rel');
		
		var new_package_name_cell 	= jQuery("#new_package_name_cell"+update_package).val();	
		var new_package_cost_cell 	= jQuery("#new_package_cost_cell"+update_package).val();	
		var new_package_bid_cell	= jQuery("#new_package_bid_cell"+update_package).val();	
		
		
		
		jQuery.ajax({
						url: SITE_URL + "/wp-admin/admin-ajax.php",
						type:'POST',
						data:'action=update_package&id='+ update_package +'&new_package_name_cell=' + 
						new_package_name_cell + '&new_package_cost_cell=' + new_package_cost_cell + 
						'&new_package_bid_cell=' + new_package_bid_cell,
						success: function (text) {  
						
							//text = text.slice(0, -1);
							jQuery('#my_pkg_cell' + update_package).animate({ backgroundColor: "green" }, 'fast');
							jQuery('#my_pkg_cell' + update_package).animate({ backgroundColor: "white" }, 'fast');
							return false;
						  }
					 });
			
		return false;
	});
		
		
		//-----------------------
	
	jQuery(".delete_package").live("click", function(){ 
		
		var delete_package = jQuery(this).attr('rel');
	
		jQuery.ajax({
						url: SITE_URL + "/wp-admin/admin-ajax.php",
						type:'POST',
						data:'action=delete_package&id=' + delete_package,
						success: function (text) {  
						
							//text = text.slice(0, -1);
							jQuery('#my_pkg_cell' + delete_package).animate({ backgroundColor: "red" }, 'slow');
							jQuery("#my_pkg_cell" + delete_package).remove();
							return false;
						  }
					 });
			
		return false;
	});
	
	
	//----------------------
		
		
		jQuery("#new_package_action").live("click", function(){ 
	
	
	var new_package_name 	= jQuery("#new_package_name");	
	var new_package_cost 	= jQuery("#new_package_cost");	
	var new_package_bid 	= jQuery("#new_package_bid");	
	
	//if(specific_name == 0) { alert("Please input some name."); return false; }
	
	jQuery.ajax({
						url: SITE_URL + "/wp-admin/admin-ajax.php",
						type:'POST',
						data:'action=new_package_action&new_package_name='+ new_package_name.val() 
						+'&new_package_cost=' + new_package_cost.val() + '&new_package_bid=' + new_package_bid.val(),
						success: function (text) {  
						
							text = text.slice(0, -1);
							
							var myObject = eval('(' + text + ')');
							
							new_package_name.val("");
							new_package_cost.val("");
							new_package_bid.val("");
							
							var my_packages_stuff = jQuery("#my_packages_stuff");
							
							my_packages_stuff.append('<div class="MY_mo_gogo" id="my_pkg_cell'+myObject.id+'">' + 
                
								'<div class="go_go1">' +
								'<div class="go_go2_1">Package name:</div> <div class="go_go2_2"><input name="" id="new_package_name_cell'+myObject.id+'" value="'+myObject.new_package_name+'" /></div>' +
								'</div>' +
															
								'<div class="go_go1">' +
								'<div class="go_go2_1">Package cost('+ SITE_CURRENCY +'):</div>' +
								'<div class="go_go2_2"><input name="" id="new_package_cost_cell'+myObject.id+'" value="'+ myObject.new_package_cost +'" /></div>' +
								'</div>' +	
								
								'<div class="go_go1">' +
								'<div class="go_go2_1">Package bids:</div> <div class="go_go2_2"><input name="" id="new_package_bid_cell'+myObject.id+'" value="'+ myObject.new_package_bid +'" /> </div>' +
								'</div>' +
							
								'<div class="go_go1"><a href="" rel="'+ myObject.id +'" class="update_package green_btn2">Update Package</a>' + 
								'<a href="#" rel="'+ myObject.id +'" class="delete_package green_btn">Delete Package</a>' +
								'</div>' +
						
							'</div>');
							jQuery('#my_pkg_cell' + myObject.id).animate({ backgroundColor: "green" }, 'fast');
							jQuery('#my_pkg_cell' + myObject.id).animate({ backgroundColor: "white" }, 'fast');
							jQuery("#my_pkg_cell" + myObject.id).focus();
							
						
						  }
					 });
	
	
		});
		
		//-------------------------
		
		
		
		
	});