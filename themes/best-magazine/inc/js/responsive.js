var window_cur_size = 'screen';

jQuery('document').ready(function(){

	jQuery('.cont_vat_tab ul.content > li').filter(function() { return jQuery(this).css("display")!='none'}).addClass('active');
	jQuery('#wd-categories-tabs > .tabs > li').eq(0).addClass('active');
	sliderHeight=parseInt(jQuery("#slider-wrapper").height());
	sliderWidth=parseInt(jQuery("#slider-wrapper").width());
	sliderIndex=sliderHeight/sliderWidth;
	

	if(matchMedia('only screen and (max-width : 767px)').matches){
		phone();		
	}
	else if (matchMedia('only screen and (min-width: 768px) and (max-width: 1024px)').matches){
		tablet();
	}
	else{checkMedia();}
	
	jQuery(window).resize(function(){checkMedia();});
	
	


	function checkMedia(){
		//################SCREEN
		if(matchMedia('only screen and (min-width: 1025px)').matches){screen();}
		//################TABLET
		if (matchMedia('only screen and (min-width: 768px) and (max-width: 1024px)').matches){tablet();}
		//################PHONE
		if(matchMedia('only screen and (max-width : 767px)').matches){phone(false);}

		if(typeof(wdwt_slider_resize)=='function'){
			wdwt_slider_resize();
		}

	}

	function screen(){
		if(best_magazine_full_width){
			screenSize='99%';
		}
		else
			screenSize=best_magazine_content_width+ "%";

		

		//w_w = jQuery(window).width() > screenSize ? screenSize : jQuery(window).width();		
		//jQuery(".container").css('width','');
		//jQuery(".container").css('max-width',w_w+'px');

		
		jQuery("#header .phone-menu-block").removeClass("container").css({width:"auto"});
		//jQuery(".container").width(jQuery("body").attr("screen-size"));

		//jQuery("body header, body footer,#top-nav > div > ul,#top-nav > div > div > ul").not(".container").width("100%");
		
		jQuery(".blog").css('width','');
		

		sHeight=sliderIndex*parseInt(jQuery("#slider-wrapper").width());
		sliderSize(sHeight);	
		if(window_cur_size == 'phone'){
			
			jQuery("#header").find("#menu-button-block").remove();
			jQuery("#top-nav").css({"display":"block"});
			jQuery("#top-nav").removeClass("open");
			
			
			jQuery("#header-top .container").append(jQuery("#social"));
			jQuery("#header-middle").prepend(jQuery("#logo"));
			jQuery("aside .sidebar-container .widget-area").removeClass("clear");
			jQuery(".top-posts-block").width("100%");
			
						
		}
		if(window_cur_size == 'phone' || window_cur_size == 'tablet'){
			jQuery("#top-nav > div > ul  li.addedli,#top-nav > div > div > ul  li.addedli").remove();
			jQuery('#sidebar1').after(jQuery('#content'));
			jQuery('.added_not_exsisted_footer_sidbar').remove();
		}

		var max_height=[];
		jQuery('.cont_vat_tab ul.content> li').each(function(){
		   max_height.push(jQuery(this).height());
		})
		max_heightli = Math.max.apply(Math, max_height);
		jQuery('.cont_vat_tab ul.content').height(max_heightli);
		inserting_div_float_problem(jQuery('#sidebar-footer'));
		jQuery("#top-posts-contents-nav").css({"display":"none"});
		

		

		window_cur_size	= 'screen';
	}
	
	function tablet(){
		
		
		jQuery("#header .phone-menu-block").removeClass("container").css({width:"auto"});

		//w_w = jQuery(window).width() > 768 ? 768 : jQuery(window).width();
		//jQuery('.container').css('width','');
		//jQuery(".container").width(w_w);
		//jQuery(".container").css('max-width',w_w+'px');

		//jQuery(".container, #top-nav > div > ul,#top-nav > div > div > ul").width(w_w);
		
				//jQuery("#blog,.blog,#top-posts .container,#header-top + .container").width(w_w);
				
	

		if(window_cur_size == 'phone'){
			
			jQuery("#header").find("#menu-button-block").remove();
			jQuery("#top-nav").removeClass("open");
			jQuery("#top-nav").css({"display":"block"});
			
			jQuery("#header-top .container").append(jQuery("#social"));
			jQuery("#header-middle").prepend(jQuery("#logo"));
			jQuery("aside .sidebar-container .widget-area").removeClass("clear");
			jQuery(".top-posts-block").width("100%");
			jQuery('.added_not_exsisted_footer_sidbar').remove();
		}
		if(window_cur_size == 'screen'){
			jQuery("#top-nav > div > ul  li:has(> ul),#top-nav > div > div > ul  li:has(> ul)").each(function(){

				var strtext=jQuery(this).children("a").html();
				var strhref=jQuery(this).children("a").attr("href");
				var strlink='<a href="'+strhref+'">'+strtext+'</a>';
				jQuery(this).children("ul").prepend('<li class="addedli">'+strlink+'</li>');
			});
			jQuery('#content').after(jQuery('#sidebar1'));
		}
		var max_height=[];
		jQuery('.cont_vat_tab ul.content> li').each(function(){
		   max_height.push(jQuery(this).height());
		})
		max_heightli = Math.max.apply(Math, max_height);
		jQuery('.cont_vat_tab ul.content').height(max_heightli);
		
		sHeight=sliderIndex*parseInt(jQuery("#slider-wrapper").width());
		sliderSize(sHeight);

		window_cur_size	= 'tablet';
	}
	
	function phone(full){
		jQuery("#header .phone-menu-block").addClass("container");
	


		//jQuery(".container, #top-nav > div > ul,#top-nav > div > div > ul").width("100%");
	
		
		//jQuery("#blog,.blog,#top-posts .container,#header-top + .container").width(width);


		sHeight=sliderIndex*parseInt(jQuery("#slider-wrapper").width());
		sliderSize(sHeight);
		
		//### PHONE UNIQUE STYLES
		jQuery("#top-nav > div > ul  li.addedli,#top-nav > div > div > ul  li.addedli").remove();
		jQuery("#top-nav > div > ul  li:has(> ul),#top-nav > div > div > ul  li:has(> ul)").each(function(){

				var strtext=jQuery(this).children("a").html();
				var strhref=jQuery(this).children("a").attr("href");
				var strlink='<a href="'+strhref+'">'+strtext+'</a>';
				jQuery(this).children("ul").prepend('<li class="addedli">'+strlink+'</li>');
		});
		if(window_cur_size != 'phone'){
			
			if(jQuery("#footer div").length){
				jQuery("#footer ").append(jQuery("#social"));
			}
			else{
				jQuery("#footer > div").prepend("<div class='footer-sidbar added_not_exsisted_footer_sidbar'><div id='sidebar-footer' class='added_not_exsisted_footer phone container footer-sidbar'></div></div>")

				jQuery("#footer > div").append(jQuery("#social"));
				if(jQuery('body').width()>320 && jQuery('body').width()<640){width="99%";}else if(jQuery('body').width()<=320){width="99%";}else{width="640px";}
					jQuery(".container").width(width);

			}
			jQuery("#header-top .container").prepend(jQuery("#logo"));
		}
		if(window_cur_size == 'screen'){
			jQuery('#content').after(jQuery('#sidebar1'));
		}
		for(var i=0;i<jQuery(" aside .sidebar-container .widget-area").length;i++){
			if (i%2 == 0){jQuery(" aside .sidebar-container .widget-area").eq(i).addClass("clear");}
 		}
		
		
		jQuery("#header").find("#menu-button-block").remove();
		jQuery("#header .phone-menu-block").append('<div id="menu-button-block"><a href="#">Menu</a></div>');
		
		
		if(!jQuery("#top-nav").hasClass("open")){jQuery("#top-nav").css({"display":"none"})};

		jQuery(" #site-description p").css({"width":(jQuery(".container").width()-120)+"px"});
		var w_w = jQuery(window).width();
		var top_posts_n  = jQuery("#top-posts-list li").length;
    top_posts_n = top_posts_n >= 4 ? top_posts_n : 4;
		jQuery(" .top-posts-block").width((top_posts_n * w_w*0.8)+"px");

		var max_height=[];

		jQuery('.cont_vat_tab ul.content> li').each(function(){
		   max_height.push(jQuery(this).height());
		})
		max_heightli = Math.max.apply(Math, max_height);
		jQuery('.cont_vat_tab ul.content').height(max_heightli);
		window_cur_size	= 'phone';
	}
	
	
	function sliderSize(sHeight) {
		jQuery("#slider-wrapper").css('height',sHeight);

		//jQuery("#slideshow").css('height',(sHeight+170));
	}	
	function inserting_div_float_problem(main_div){
		jQuery(main_div).children('.clear:not(:last-child)').remove();
		var iner_elements=jQuery(main_div).children();
		var main_width=jQuery(main_div).width();
		var summary_width=0;
		for(i=0;i<iner_elements.length;i++){
			summary_width=summary_width+jQuery(iner_elements[i]).outerWidth();
			if(summary_width >= main_width){
				jQuery(iner_elements[i]).before('<div class="clear"></div>')
				summary_width=jQuery(iner_elements[i]).outerWidth();
			}
		}
	}
	
});

