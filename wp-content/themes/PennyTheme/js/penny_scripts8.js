function onExp(data) {

		
			var seconds 	= data[6];
			var hours	 	= data[4];
			var minutes 	= data[5];
			
			var thisDiv = $('.auction-current-time2');//$(this);
			
			//	console.log(data);		
			
			
			if(hours == "00" && minutes == "00")
			{
				
				if(seconds < 50) { 
				
						var color = thisDiv.css("background-color");
						thisDiv.animate({color:"red"}, 'fast');
						thisDiv.animate({color: "black"},'fast') ; 
					
						}	
						
						if(seconds == 0)
						{
							//$('.auction-current-time').countdown('destroy');
							//$('.auction-current-time2').html("Auction Ended");
							$(this).html(AUCTION_ENDED_THING);
							$(".mm_bid_mm").hide();
							 //alert("asd");	
						}
			}
			
			//$("#my-auction-time_" + pid + "_" + rnd).countdown('destroy'); 
	

}

var $ = jQuery;

$(document).ready(function() {
		
	var queryString = "";
	
	var balance2 = $(".balance2"); 
	if (balance2.length > 0){ 
	
	
	var my_pid_pid = $("#my_pid_pid");
	var pidipid;
	if(my_pid_pid.length > 0) pidipid = my_pid_pid.val();
	else pidipid = 0;
	
		$("#main").smartupdater({
					type: 'POST',
					url : MY_SITE_URL + "/wp-admin/admin-ajax.php",
					data:  'action=get_credits_act&pidipid='+pidipid,
					
					minTimeout: 6000
				}, function (data) { 
				
								var stringa = data.charAt(data.length-1);
								if(stringa == '0') data = data.slice(0, -1);
								else data = data.slice(0, -2);
								
								var myObj = eval("(" + data + ")");
								
								var credits_used = $(".credits-used");
								if(credits_used.length > 0) credits_used.html(myObj.remleft);
								
								balance2.html(myObj.crds);	
				
				}
				
				);
	
	
	}
	
	
	//---------------------------------------------------------
	
	$('.my-total-ids-no-delete').each(function(index) {
											   
		var values = $(this).val();	
		var myOb = values.split("_");
		var remaining_time = $("#my-auction-time_" + myOb[0] + "_" + myOb[1]).html();
		$("#my-auction-time_" + myOb[0] + "_" + myOb[1]).countdown({until: remaining_time, onTick: onExp, format: 'HMS', compact: true});
											    
    });
	
	
	function PTA_isEmpty(str) {
    return (!str || 0 === str.length);
}
	
	
	$('.my-total-ids-no-delete').each(function(index) {
											   
				var values = $(this).val();				
				queryString = queryString + 'my_values[]='+values+'&';

								   });

				var bidlist = $("#my_bid_list"); 
				var OKOK = 0;
				if (bidlist.length > 0){ OKOK = 1; }
				
				
				
				$("#main").smartupdater({
					type: 'POST',
					url : MY_SITE_URL + "/wp-admin/admin-ajax.php",
					data:  'action=my_ajax_small_stuff&OKOK='+OKOK+'&' + queryString,
					
					minTimeout: 2000
				}, function (data) { 
				
				
				var stringa = data.charAt(data.length-1);
								if(stringa == '0') data = data.slice(0, -1);
								else data = data.slice(0, -2);
									
				
				var myObj = eval("(" + data + ")");
				for (var i = 0; i < myObj.length; i++)
				{
					pid 				= myObj[i].pid;
					rnd 				= myObj[i].rnd;
					remaining_time 		= myObj[i].remaining_time;
					current_bid 		= myObj[i].current_bid;
					highest_bidder		= myObj[i].highest_bidder;
					highest_bidder_id	= myObj[i].highest_bidder_id;
                    user_added_time     = myObj[i].time_added_by_user;
					
					if(highest_bidder == "0") highest_bidder = NO_BIDS;
					
					var highest_bidder_bid_id = $("#highest-bidder-bid-id").val();
					
					if(highest_bidder_id != highest_bidder_bid_id && !PTA_isEmpty(highest_bidder_id) )
					{
						$("#hghbdif").animate({backgroundColor:"green"}, 'fast');
						$("#hghbdif").animate({backgroundColor: "white"},'fast') ;
						
						$("#hghbdif").animate({backgroundColor:"green"}, 'fast');
						$("#hghbdif").animate({backgroundColor: "white"},'fast') ;
						
						$("#highest-bidder-bid-id").val(highest_bidder_id);	
						
						// console.log(highest_bidder_id+ " " + highest_bidder_bid_id );
					}
					
					//---------------------------
					
					
					var old_current_bid = $("#my-current-price_" + pid + "_" + rnd).html();
					
					$("#my-current-price_" + pid + "_" + rnd).html(current_bid);
					
					if(current_bid != old_current_bid)
					{
						var color = $("#post-" + pid + "-" + rnd).css("background-color");
						$("#post-" + pid + "-" + rnd).animate({backgroundColor:"red"}, 'fast');
						$("#post-" + pid + "-" + rnd).animate({backgroundColor: color},'fast') ;
						
						if(OKOK == 1) {
							
						bidlist.html(myObj[i].bidders);	
							
						}
						
						$("#my-auction-time_" + pid + "_" + rnd).countdown('destroy'); 
						$("#my-auction-time_" + pid + "_" + rnd).countdown({until: remaining_time, onTick: onExp, format: 'HMS', compact: true});
						
					}
					
                    if( user_added_time > 0 ){
					   $("#my-auction-time_" + pid + "_" + rnd).countdown('destroy'); 
					   $("#my-auction-time_" + pid + "_" + rnd).countdown({until: remaining_time, onTick: onExp, format: 'HMS', compact: true});                        
                    }

					 
					$("#highest_bidder_" + pid + "_" + rnd).html(highest_bidder); 
	
	
					
					
				}
					
				});
				
    $("#inc_time").click(function(e) {
        var pid = $(".mm_bid_mm").attr('rel');
        var uid = $(this).attr('rel');
        $(this).html('Adding...');
        $.ajax({
			url: MY_SITE_URL + "/wp-admin/admin-ajax.php",
			type:'POST',
			data:'action=add_auction_timer&_pid='+ pid+'&_uid='+uid ,
			success: function (data) {  
			
				var stringa = data.charAt(data.length-1);
				if(stringa == '0') data = data.slice(0, -1);
				//else data = data.slice(0, -2);					
                $("#inc_time").html('Add Time');
                
                data = data.split('~~');
                var data_val  = data[0];
                var data_text = data[1]; 
                if( data[1] == '_hide_btn_time' ){
                    $("#inc_time").hide();
                }               
                $('div[rel="curr_time"]').countdown('destroy');
                $('div[rel="curr_time"]').countdown({until: data_val, onTick: onExp, format: 'HMS', compact: true}); 
				return false;
			  }
		 });
         
         e.preventDefault();
    })
	
	$(".mm_bid_mm").click(function() {
						
						var mypid  = $(this).attr('rel');
                        var uincb  = $('#uincb').val();
                        var do_inc = 'off';
                        if( $('#do_inc').is(':checked') ){
                            do_inc = 'on';
                        } 
						$('#do_inc').prop('checked',false);
							$.ajax({
							url: MY_SITE_URL + "/wp-admin/admin-ajax.php",
							type:'POST',
							data:'action=bid_now_live_me&_pid='+ mypid+'&uincb='+uincb+'&do_inc='+do_inc ,
							success: function (data) {  
							
								var stringa = data.charAt(data.length-1);
								if(stringa == '0') data = data.slice(0, -1);
								//else data = data.slice(0, -2);
									
									
									//alert(data);
									if(data == "NO_USER_LOGIN"){
									   $.colorbox({href: MY_SITE_URL + "/?_user_is_not_logged_in=1" });	
									}
									
									if(data == "NO_USER_CREDITS"){
										$.colorbox({href: MY_SITE_URL + "/?_user_has_no_credits=1" });	
									}
									
									if(data == "TIME_IS_UP"){
										$.colorbox({href: MY_SITE_URL + "/?_time_is_up=1" });	
									}
                                    
                                    if(data == "NO_FURTHER_BIDDING_ALLOWED"){
										$.colorbox({href: MY_SITE_URL + "/?_no_further_bidding_allowed=1" });	
									}
								    
									
												
							
								return false;
							  }
						 });
				
				
						return false;
						
	   });
	
	
	
				
});