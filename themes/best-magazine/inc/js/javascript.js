jQuery(document).ready(function(){
	
	var cat_tab_is_animated = 0;
	jQuery('#top-nav li:has(> ul)').addClass('haschild');
	
	jQuery("#top-nav > div > ul  li,#top-nav > div > div > ul  li").hover(function(){

		if(matchMedia('only screen and (max-width : 1024px)').matches){return false;}
		jQuery(this).parent("ul").find("ul").slideUp(5);
		jQuery(this).parent("ul").children().removeClass("active");
		jQuery(this).addClass("active");
		if(jQuery(this).find("ul").length){jQuery(this).children("ul").stop().slideDown("slow").addClass("opensub");}
	},function(){

		if(matchMedia('only screen and (max-width : 1024px)').matches){return false;}

		jQuery(this).parent("ul").children().removeClass("active");
		jQuery(this).parent("ul").find("ul").stop().slideUp(50);
		jQuery(".opensub").removeClass("opensub");
	});
		

		jQuery("#top-nav > div > ul  li.haschild > a,#top-nav > div > div > ul  li.haschild > a").click(function(){
			
			if(matchMedia('only screen and (max-width : 1024px)').matches){
		
			if(jQuery(this).parent().hasClass("open")){
				jQuery(this).parent().parent().find(".haschild ul").slideUp(100);
				jQuery(this).parent().removeClass("open");
				return false;
			}
			jQuery(this).parent().parent().find(".haschild ul").slideUp(100);
			jQuery(this).parent().parent().find(".haschild").removeClass("open");
			jQuery(this).next("ul").slideDown("fast");
			jQuery(this).parent().addClass("open");
			return false;}
		});
		
		
		
		jQuery("#header .phone-menu-block").on("click","#menu-button-block", function(){
			if(jQuery("#top-nav").hasClass("open")){
				jQuery("#header #top-nav").slideUp("fast");
				jQuery("#top-nav").removeClass("open");
			}
			else{
				jQuery("#header #top-nav").slideDown("slow");
				jQuery("#top-nav").addClass("open");
			}
		});
		
		
		
		
	
		
		/*##########TOP POSTS#############*/
		
		
		function leftMove(){
			var wrap_offset_left = jQuery('.top-posts-wrapper').offset().left;
				
			var wrapper_width = jQuery('.top-posts-wrapper').width();
			var block_width = jQuery('.top-posts-block').width();
			var block_offset_left = jQuery('.top-posts-block').offset().left;
			var li_index = Math.round((jQuery('.top-posts-wrapper').offset().left - jQuery('.top-posts-block').offset().left)/jQuery('.top-posts-wrapper').width());
			var last_li = jQuery( ".top-posts-block ul li" ).last().index();
			
			if(li_index < last_li){
				jQuery(".top-posts-right").unbind(clickstart);
				jQuery('.top-posts-block').animate({'left': '-='+(wrapper_width+2)+'px'},  function() {
					jQuery(this).find('li').removeClass("active");
					var li_elem = jQuery(this).find('li')[li_index+1];
					jQuery(li_elem).addClass("active");
					jQuery(".top-posts-right").bind(clickstart,function(event){
						leftMove();
					});
				});
				
			}
		}
		
		function rightMove(){
			var wrapper_width=jQuery('.top-posts-wrapper').width();
			var li_index = Math.round((jQuery('.top-posts-wrapper').offset().left - jQuery('.top-posts-block').offset().left)/jQuery('.top-posts-wrapper').width());
			if(li_index>0){
				jQuery(".top-posts-left").unbind(clickstart);
				jQuery('.top-posts-block').animate({'left': '+='+(wrapper_width+2)+'px'}, function() {
					jQuery(this).find('li').removeClass("active");
					var li_elem = jQuery(this).find('li')[li_index-1];
					jQuery(li_elem).addClass("active");
					jQuery(".top-posts-left").bind(clickstart,function(event){
						rightMove();
					});
				});
					
			}
		}

		jQuery(window).resize(function() {
			if(jQuery('.top-posts-wrapper').length){
				if(matchMedia('only screen and (max-width : 767px)').matches){
					var elem_index = jQuery('.top-posts-wrapper').find('li.active').index() > -1 ? jQuery('.top-posts-wrapper').find('li.active').index() : 0;
					var left = jQuery('.top-posts-wrapper').offset().left - elem_index * jQuery('.top-posts-wrapper').width();
					jQuery('.top-posts-block').offset({left:left});
				}
				else{
					jQuery('.top-posts-block').css({left:0});
				}
			}
		});
		
		
		var mobile   = /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent); 
		
		var clickstart = mobile ? "touchstart" : "click";
		var clickend = mobile ? "touchend" : "mouseup";

		jQuery(".top-posts-right").bind(clickstart,function(event){
			leftMove();
		});
		
			
		jQuery(".top-posts-left").bind(clickstart,function(event){
			rightMove();
		});
		
		
		 
		
		/*##############CATEGORIES TABS####################*/
		
		jQuery("#wd-categories-tabs ul.tabs li a").click(function(){
				if(jQuery(this).closest("li").hasClass("active")){return false;}
				if(cat_tab_is_animated) return false;
				cat_tab_is_animated=1;
				jQuery("#wd-categories-tabs ul.tabs li").removeClass("active");
				var id=jQuery(this).attr("href").replace("#","");
				//if(width_of_catigory_tab_li=='undefined' || width_of_catigory_tab_li==0)
				var width_of_catigory_tab_li=jQuery("#wd-categories-tabs ul.content > li.active").eq(0).width();
				jQuery(this).closest("li").addClass("active");
				if(jQuery("#wd-categories-tabs ul.content > li.active").eq(0).index()>jQuery("#categories-tabs-content-"+id).index()){
					jQuery("#wd-categories-tabs ul.content > li.active").animate(
						{'left': width_of_catigory_tab_li+"px"},
						{duration:500,
							complete:function() {
								jQuery(this).removeClass("active");
								jQuery(this).css("display","none").css("left","0px");
								cat_tab_is_animated=0;}
						});
					jQuery("#categories-tabs-content-"+id).attr('style','left:-'+width_of_catigory_tab_li+'px');
					jQuery("#categories-tabs-content-"+id).show();
					jQuery("#categories-tabs-content-"+id).animate({'left':'0px'},{duration:500,complete:function() { jQuery(this).addClass("active")} });
				}
				else{
					jQuery("#wd-categories-tabs ul.content > li.active").animate({'left':"-" + width_of_catigory_tab_li+"px"},{duration:500,complete:function() { jQuery(this).removeClass("active");jQuery(this).css("display","none").css("left","0px");cat_tab_is_animated=0; } });
					jQuery("#categories-tabs-content-"+id).attr('style','left:'+width_of_catigory_tab_li+'px');
					jQuery("#categories-tabs-content-"+id).show();
					jQuery("#categories-tabs-content-"+id).animate({'left':'0px'},{duration:500,complete:function() { jQuery(this).addClass("active"); cat_tab_is_animated=0;} });
				}
						
				
			return false;
		}).stop();
		
		/*CATEGORIES TABS PHONE*/
		var count=jQuery("#wd-categories-tabs ul.tabs li").length;
		count=count-1;
		function prevTab(count){
			if(count==0) return false;
			var isactive=jQuery("#wd-categories-tabs ul.tabs li.active").next().index();
			var width_of_catigory_tab_li=jQuery("#wd-categories-tabs ul.content > li.active").eq(0).width();
			if(cat_tab_is_animated) return false;
				cat_tab_is_animated=1;
			if(isactive==-1){isactive=0;}
			

			
				jQuery("#wd-categories-tabs ul.tabs li").removeClass("active");
				jQuery("#wd-categories-tabs ul.tabs li").eq(isactive).addClass("active");
				
				
				jQuery("#wd-categories-tabs ul.content > li.active").animate({'left': width_of_catigory_tab_li+"px"},{duration:500,complete:function() { jQuery(this).removeClass("active");jQuery(this).css("display","none").css("left","0px"); cat_tab_is_animated=0; } });
				jQuery("#wd-categories-tabs ul.content > li").eq(isactive).attr('style','left:-'+width_of_catigory_tab_li+'px');
				jQuery("#wd-categories-tabs ul.content > li").eq(isactive).show();
				jQuery("#wd-categories-tabs ul.content > li").eq(isactive).animate({'left':'0px'},{duration:500,complete:function() { jQuery(this).addClass("active"); cat_tab_is_animated=0;} });
			//	jQuery("#wd-categories-tabs ul.content > li").removeClass("active").css({display:"none"});
			//	jQuery("#wd-categories-tabs ul.content > li").eq(isactive).addClass("active").css({display:"block"});
		}
		
		function nextTab(count){
			if(count==0) return false;
			var isactive=jQuery("#wd-categories-tabs ul.tabs li.active").prev().index();
			var width_of_catigory_tab_li=jQuery("#wd-categories-tabs ul.content > li.active").eq(0).width();
			if(cat_tab_is_animated) return false;
				cat_tab_is_animated=1;
			if(isactive==-1){isactive=count;}
				jQuery("#wd-categories-tabs ul.tabs li").removeClass("active");
				jQuery("#wd-categories-tabs ul.tabs li").eq(isactive).addClass("active");
				
				jQuery("#wd-categories-tabs ul.content > li.active").animate({'left':'-'+ width_of_catigory_tab_li+"px"},{duration:500,complete:function() { jQuery(this).removeClass("active");jQuery(this).css("display","none").css("left","0px");cat_tab_is_animated=0; } });
				jQuery("#wd-categories-tabs ul.content > li").eq(isactive).attr('style','left:'+width_of_catigory_tab_li+'px');
				jQuery("#wd-categories-tabs ul.content > li").eq(isactive).show();
				jQuery("#wd-categories-tabs ul.content > li").eq(isactive).animate({'left':'0px'},{duration:500,complete:function() { jQuery(this).addClass("active"); cat_tab_is_animated=0;} });

				//jQuery("#wd-categories-tabs ul.content > li").removeClass("active").css({display:"none"});
				//jQuery("#wd-categories-tabs ul.content > li").eq(isactive).addClass("active").css({display:"block"});
		}
				
		jQuery(".categories-tabs-right").click(function(){nextTab(count);});
		jQuery(".categories-tabs-left").click(function(){prevTab(count);});

		
				
});